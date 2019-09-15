<?php
    if ( !defined( 'QA_VERSION' ) ) { // don't allow this page to be requested directly from browser
        header( 'Location: ../../' );
        exit;
    }

    function donut_get_glyph_icon( $icon )
    {
        if ( !empty( $icon ) ) {
            return '<span class="glyphicon glyphicon-' . $icon . '"></span> ';
        } else {
            return '';
        }
    }

    function donut_get_fa_icon( $icon )
    {
        if ( !empty( $icon ) ) {
            return '<span class="fa fa-' . $icon . '"></span> ';
        } else {
            return '';
        }
    }

    function donut_get_voting_icon( $tags )
    {
        $icon = '';
        switch ( $tags ) {
            case 'vote_up_tags':
                $icon = 'chevron-up';
                break;
            case 'vote_down_tags':
                $icon = 'chevron-down';
                break;
            case 'unselect_tags':
            case 'select_tags':
                $icon = 'check';
                break;
            default:
                break;
        }

        return donut_get_fa_icon( $icon );
    }

    if ( !function_exists( 'starts_with' ) ) {
        function starts_with( $haystack, $needle )
        {
            return $needle === "" || strpos( $haystack, $needle ) === 0;
        }
    }

    if ( !function_exists( 'ends_with' ) ) {
        function ends_with( $haystack, $needle )
        {
            return $needle === "" || substr( $haystack, -strlen( $needle ) ) === $needle;
        }
    }

    function donut_remove_brackets( &$nav_cat )
    {
        if ( is_array( $nav_cat ) && count( $nav_cat ) ) {
            foreach ( $nav_cat as $key => &$nav_cat_item ) {
                if ( !empty( $nav_cat_item['note'] ) ) {
                    $nav_cat_item['note'] = str_replace( array( '(', ')' ), '', $nav_cat_item['note'] );
                }
                if ( !empty( $nav_cat_item['subnav'] ) ) {
                    donut_remove_brackets( $nav_cat_item['subnav'] );
                }
            }
        }
    }

    function donut_get_user_data( $handle )
    {
        $userid = qa_handle_to_userid( $handle );
        $identifier = QA_FINAL_EXTERNAL_USERS ? $userid : $handle;
        $user = array();
        if ( defined( 'QA_WORDPRESS_INTEGRATE_PATH' ) ) {
            $u_rank = qa_db_select_with_pending( qa_db_user_rank_selectspec( $userid, true ) );
            $u_points = qa_db_select_with_pending( qa_db_user_points_selectspec( $userid, true ) );

            $userinfo = array();
            $user_info = get_userdata( $userid );
            $userinfo['userid'] = $userid;
            $userinfo['handle'] = $handle;
            $userinfo['email'] = $user_info->user_email;

            $user[0] = $userinfo;
            $user[1]['rank'] = $u_rank;
            $user[2] = $u_points;
            $user = ( $user[0] + $user[1] + $user[2] );
        } else {
            $user['account'] = qa_db_select_with_pending( qa_db_user_account_selectspec( $userid, true ) );
            $user['rank'] = qa_db_select_with_pending( qa_db_user_rank_selectspec( $handle ) );
            $user['points'] = qa_db_select_with_pending( qa_db_user_points_selectspec( $identifier ) );

            $user['followers'] = qa_db_read_one_value( qa_db_query_sub( 'SELECT count(*) FROM ^userfavorites WHERE ^userfavorites.entityid = # and ^userfavorites.entitytype = "U" ', $userid ), true );

            $user['following'] = qa_db_read_one_value( qa_db_query_sub( 'SELECT count(*) FROM ^userfavorites WHERE ^userfavorites.userid = # and ^userfavorites.entitytype = "U" ', $userid ), true );
        }

        return $user;
    }

    function donut_user_profile( $handle, $field = null )
    {
        $userid = qa_handle_to_userid( $handle );
        if ( defined( 'QA_WORDPRESS_INTEGRATE_PATH' ) ) {
            return get_user_meta( $userid );
        } else {
            $query = qa_db_select_with_pending( qa_db_user_profile_selectspec( $userid, true ) );

            if ( !$field ) return $query;
            if ( isset( $query[$field] ) )
                return $query[$field];
        }

        return false;
    }

    function donut_get_user_level( $userid )
    {
        static $donut_userid_and_levels;

        if ( empty( $donut_userid_and_levels ) ) {
            $donut_userid_and_levels = qa_db_read_all_assoc( qa_db_query_sub( "SELECT userid , level from ^users" ), 'userid' );
        }

        if ( isset( $donut_userid_and_levels[$userid] ) ) {
            return $donut_userid_and_levels[$userid]['level'];
        } else {
            return 0;
        }
    }

    function donut_get_user_avatar_image($flags, $email, $handle, $blobId, $width, $height, $size, $padding = false){

        require_once QA_INCLUDE_DIR . 'app/format.php';

        if (strlen($handle) == 0) {
            return null;
        }

        $avatarSource = qa_get_user_avatar_source($flags, $email, $blobId);

        switch ($avatarSource) {
            case 'gravatar':
                $html = qa_get_gravatar_html($email, $size);
                break;
            case 'local-user':
                $html = qa_get_avatar_blob_html($blobId, $width, $height, $size, $padding);
                break;
            case 'local-default':
                $html = qa_get_avatar_blob_html(qa_opt('avatar_default_blobid'), qa_opt('avatar_default_width'), qa_opt('avatar_default_height'), $size, $padding);
                break;
            default:
                return null;
        }

        return $html;
    }

    function donut_get_user_avatar( $userid, $size = 40 )
    {
        if ( !defined( 'QA_WORDPRESS_INTEGRATE_PATH' ) ) {
            $useraccount = qa_db_select_with_pending( qa_db_user_account_selectspec( $userid, true ) );
            $user_avatar = donut_get_user_avatar_image(
                                $useraccount['flags'],
                                $useraccount['email'],
                                qa_get_logged_in_user_field('handle'),
                                $useraccount['avatarblobid'],
                                $useraccount['avatarwidth'],
                                $useraccount['avatarheight'],
                                $size );
        } else {
            $user_avatar = qa_get_external_avatar_html( $userid, qa_opt( 'avatar_users_size' ), true );
        }

        if ( empty( $user_avatar ) ) {
            // if the default avatar is not set by the admin , then take the default
            $user_avatar = donut_get_default_avatar( $size );
        }

        return $user_avatar;
    }

    function donut_get_post_avatar( $post, $size = 40, $html = false )
    {
        if ( !isset( $post['raw'] ) ) {
            $post['raw']['userid'] = $post['userid'];
            $post['raw']['flags'] = $post['flags'];
            $post['raw']['email'] = $post['email'];
            $post['raw']['handle'] = $post['handle'];
            $post['raw']['avatarblobid'] = $post['avatarblobid'];
            $post['raw']['avatarwidth'] = $post['avatarwidth'];
            $post['raw']['avatarheight'] = $post['avatarheight'];
        }

        if ( defined( 'QA_WORDPRESS_INTEGRATE_PATH' ) ) {
            $avatar = get_avatar( qa_get_user_email( $post['raw']['userid'] ), $size );
        }
        if ( QA_FINAL_EXTERNAL_USERS )
            $avatar = qa_get_external_avatar_html( $post['raw']['userid'], $size, false );
        else
            $avatar = qa_get_user_avatar_html( $post['raw']['flags'], $post['raw']['email'], $post['raw']['handle'],
                $post['raw']['avatarblobid'], $post['raw']['avatarwidth'], $post['raw']['avatarheight'], $size );

        if ( empty( $avatar ) ) {
            // if the default avatar is not set by the admin , then take the default
            $avatar = donut_get_default_avatar( $size );
        }

        if ( $html )
            return '<div class="avatar" data-id="' . $post['raw']['userid'] . '" data-handle="' . $post['raw']['handle'] . '">' . $avatar . '</div>';

        return $avatar;
    }

    function donut_get_default_avatar( $size = 40 )
    {
        return '<img src="' . donut_theme_url() . '/images/default-profile-pic.png" width="' . $size . '" height="' . $size . '" class="qa-avatar-image" alt="">';
    }

    /**
     * @param  boolean if set to true , it returns the absolute theme folder
     *
     * @return String
     */
    function donut_theme_folder( $absolute = false )
    {
        $path = basename( QA_THEME_DIR ) . '/' . DONUT_THEME_BASE_DIR_NAME;

        return $absolute ? ( QA_BASE_DIR . $path ) : $path;
    }

    /**
     * returns the base url for the theme
     *
     * @return string
     */
    function donut_theme_url()
    {
        return qa_path_to_root() . donut_theme_folder();
    }

    function donut_include_template( $template_file, $echo = true )
    {
        ob_start();
        require( DONUT_THEME_TEMPLATE_DIR . $template_file );
        $op = ob_get_clean();
        if ( $echo ) echo $op;

        return $op;
    }

    function donut_get_link( $params )
    {
        if ( !empty( $params['icon'] ) ) {
            $icon = '<span class="fa fa-' . $params['icon'] . '"></span> ';
        }

        if ( @$params['tooltips'] ) {
            $tooltips_data = 'data-toggle="tooltip" data-placement="' . @$params['hover-position'] . '" title="' . $params['hover-text'] . '"';
        }

        return sprintf( '<a href="%s" %s>%s %s</a>', @$params['link'], @$tooltips_data, @$icon, @$params['text'] );
    }

    function donut_get_social_link( $params, $icon_only = false )
    {
        if ( $icon_only ) $params['text'] = '';

        $params['tooltips'] = true;
        $params['hover-position'] = 'bottom';

        return donut_get_link( $params );
    }

    function donut_stats_output( $value, $langsingular, $langplural )
    {
        echo '<div class="count-item">';

        if ( $value == 1 )
            echo qa_lang_html_sub( $langsingular, '<span class="count-data">1</span>', '1' );
        else
            echo qa_lang_html_sub( $langplural, '<span class="count-data">' . number_format( (int) $value ) . '</span>' );

        echo '</div>';
    }

    function donut_generate_social_links()
    {

        $social_links = array(
            'facebook'    => array(
                'icon'       => 'facebook',
                'text'       => donut_lang( 'facebook' ),
                'hover-text' => donut_lang( 'follow_us_on_x', donut_lang( 'facebook' ) ),
            ),
            'twitter'     => array(
                'icon'       => 'twitter',
                'text'       => donut_lang( 'twitter' ),
                'hover-text' => donut_lang( 'follow_us_on_x', donut_lang( 'twitter' ) ),
            ),
            'email'       => array(
                'icon'       => 'envelope',
                'text'       => donut_lang( 'email' ),
                'hover-text' => donut_lang( 'send_us_an_email' ),
            ),
            'pinterest'   => array(
                'icon'       => 'pinterest',
                'text'       => donut_lang( 'pinterest' ),
                'hover-text' => donut_lang( 'follow_us_on_x', donut_lang( 'pinterest' ) ),
            ),
            'google-plus' => array(
                'icon'       => 'google-plus',
                'text'       => donut_lang( 'google-plus' ),
                'hover-text' => donut_lang( 'follow_us_on_x', donut_lang( 'google-plus' ) ),
            ),
            'vk'          => array(
                'icon'       => 'vk',
                'text'       => donut_lang( 'vk' ),
                'hover-text' => donut_lang( 'follow_us_on_x', donut_lang( 'vk' ) ),
            ),
        );

        foreach ( $social_links as $key => $s ) {

            if ( $key == 'email' ) {

                $address = qa_opt( 'donut_email_address' );
                
                if ( empty( $address ) ) {
                    unset( $social_links[$key] );
                    continue;
                }

                $social_links[$key]['link'] = 'mailto:' . $address ;
                continue;
            }

            $url = qa_opt( 'donut_' . $key . '_url' );

            if ( empty( $url ) ) {
                unset( $social_links[$key] );
                continue;
            }

            $social_links[$key]['link'] = $url;
        }

        return $social_links;
    }
