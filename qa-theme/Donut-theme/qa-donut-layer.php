<?php
    if ( !defined( 'QA_VERSION' ) ) { // don't allow this page to be requested directly from browser
        header( 'Location: ../../' );
        exit;
    }

    class qa_html_theme extends qa_html_theme_base
    {

        /**
         * Doctype function
         */
        function doctype()
        {
            if ( !property_exists( 'qa_html_theme_base', 'isRTL' ) ) {
                /*Fall back for the version 1.6.3*/
                $this->isRTL = isset( $this->content['direction'] ) && $this->content['direction'] === 'rtl';
            }

            parent::doctype();
        }

        function head()
        {
            $this->output(
                    '<head>',
                    '<meta http-equiv="content-type" content="' . $this->content['content_type'] . '"/>'
            );

            $this->donut_default_meta();
            $this->head_title();
            $this->head_metas();
            $this->head_css();
            $this->donut_utility_for_old_ie();
            $this->head_links();
            $this->head_lines();
            $this->head_script();
            $this->head_custom();

            $this->output( '</head>' );
        }

        /**
         * prints the default meta and view ports
         *
         * @return  null
         */
        function donut_default_meta()
        {
            $this->output_raw( '<meta charset="utf-8">' );
            $this->output_raw( '<meta name="viewport" content="width=device-width, initial-scale=1">' );
        }

        function head_css()
        {
            $css_paths = array(
                    'fonts'     => 'css/font-awesome.min.css?4.2.0',
                    'bootstrap' => 'css/bootstrap.min.css?3.3.5',
            );

            if ( qa_opt( 'donut_activate_prod_mode' ) ) {
                $cdn_css_paths = array(
                        'bootstrap' => Donut_Option_Keys::BS_CSS_CDN,
                        'fonts'     => Donut_Option_Keys::FA_CDN,
                );

                unset( $css_paths['bootstrap'] );
                unset( $css_paths['fonts'] );
                $this->donut_resources( $cdn_css_paths, 'css', true );
            }

            $this->donut_resources( $css_paths, 'css' );

            if( qa_opt('donut_use_local_font') ){
                $this->donut_resources( array( 'css/open-sans.css?' . DONUT_THEME_VERSION) );
            } else {
                $this->donut_resources( array( Donut_Option_Keys::OPEN_SANS_FONT_CDN ) , 'css' , true );
            }

            parent::head_css();
        }

        public function css_name()
        {
            if ( qa_opt( 'donut_activate_prod_mode' ) ) {
                return 'css/donut.min.css?' . DONUT_THEME_VERSION;
            }

            return 'css/donut.css?' . DONUT_THEME_VERSION;
        }

        /**
         * prints the CSS and JS links
         *
         * @param  array   $paths    list of the resources
         * @param  string  $type     type of the resource css or js
         * @param  boolean $external weather it is relative to the theme or a external to the theme
         *
         * @return null
         */
        function donut_resources( $paths, $type = 'css', $external = false )
        {
            if ( count( $paths ) ) {
                foreach ( $paths as $key => $path ) {
                    if ( $type === 'js' ) {
                        $this->donut_js( $path, $external );
                    } else if ( $type === 'css' ) {
                        $this->donut_css( $path, $external );
                    }
                }
            }
        }

        /**
         * prints the js path
         *
         * @param  string  $path     path of the js file
         * @param  boolean $external weather it is relative to the theme or a external to the theme
         *
         * @return null
         */
        function donut_js( $path, $external = false )
        {
            if ( $external ) {
                $full_path = $path;
            } else {
                $full_path = donut_theme_url() . '/' . $path;
            }

            if ( !empty( $path ) ) {
                $this->output( '<script src="' . $full_path . '" type="text/javascript"></script>' );
            }
        }

        /**
         * prints the css path
         *
         * @param  string  $path     path of the css file
         * @param  boolean $external weather it is relative to the theme or a external to the theme
         *
         * @return null
         */
        function donut_css( $path, $external = false )
        {
            if ( $external ) {
                $full_path = $path;
            } else {
                $full_path = donut_theme_url() . '/' . $path;
            }

            if ( !empty( $path ) ) {
                $this->output( '<link rel="stylesheet" type="text/css" href="' . $full_path . '"/>' );
            }
        }

        /**
         * adds support for old IE browsers
         *
         */
        function donut_utility_for_old_ie()
        {
            $this->output( '
					<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
					   <!--[if lt IE 9]>
					     <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
					     <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
					<![endif]-->
				' );
        }

        function head_script() // change style of WYSIWYG editor to match theme better
        {
            parent::head_script();

            $js_paths = array(
                    'bootstrap' => 'js/bootstrap.min.js?3.3.5',
                    'donut'     => 'js/donut.js?' . DONUT_THEME_VERSION,
            );

            if ( qa_opt( 'donut_activate_prod_mode' ) ) {
                $cdn_js_paths = array(
                        'bootstrap' => Donut_Option_Keys::BS_JS_CDN,
                );
                unset( $js_paths['bootstrap'] );
                $this->donut_resources( $cdn_js_paths, 'js', true );
            }

            $this->donut_resources( $js_paths, 'js' );

        }

        function body_content()
        {
            $sub_navigation = @$this->content['navigation']['sub'];

            if ( $this->template === 'admin' ) {
                unset( $this->content['navigation']['sub'] );
            }

            $navigation = &$this->content['navigation'];

            if ( isset( $navigation['cat'] ) ) {
                donut_remove_brackets( $navigation['cat'] );
            }

            $this->body_prefix();

            $this->output( '<div class="container">' );
            $this->output( '<div class="top-divider"></div>' );
            $this->output( '</div>' );

            $this->donut_site_header();

            $this->output( '<div class="container visible-xs">' );
            $this->output( '<div class="top-search-bar">' );
            $this->search();
            $this->output( '</div>' );
            $this->output( '</div>' );

            $extratags = isset($this->content['wrapper_tags']) ? $this->content['wrapper_tags'] : '';
            $this->output( '<div class="qa-body-wrapper"' . $extratags . '>', '' );

            $this->output( '<main class="donut-masthead">' );

            $this->output( '<div class="container">' );
            $this->notices();
            $this->output( '</div>' );

            $this->output( '<div class="container">' );

            $extra_title_class = $this->donut_page_has_favorite() ? ' has-favorite' : '';

            $this->output( '<div class="page-title' . $extra_title_class . '">' );
            $this->page_title_error();
            $this->output( '</div>' );

            $this->donut_breadcrumb();
            $this->output( '</div>' );

            $this->output( '</main>' );

            $this->output( '<div class="container">', '' );

            $this->widgets( 'full', 'top' );
            $this->header();
            $this->widgets( 'full', 'high' );

            if ( !empty( $sub_navigation ) ) {
                // create the left side bar
                $this->left_side_bar( $sub_navigation );
            }

            $this->main();

            if ( !$this->donut_do_hide_sidebar() ) {
                $this->sidepanel();
            }

            $this->widgets( 'full', 'low' );
            $this->footer();
            $this->widgets( 'full', 'bottom' );

            $this->output( '</div> <!-- END container -->' );
            $this->output( '</div> <!-- END body-wrapper -->' );

            $this->body_suffix();
        }

        function page_title_error()
        {
            $favorite = @$this->content['favorite'];

            if ( isset( $favorite ) )
                $this->output( '<form ' . $favorite['form_tags'] . '>' );

            $this->feed_link();

            $this->output( '<h1>' );
            $this->favorite();
            $this->title();
            $this->output( '</h1>' );

            if ( $this->template == 'not-found' && qa_opt( 'donut_show_custom_404_page' ) ) {
                $this->output( donut_include_template( 'page-not-found.php', false ) );
            } else if ( isset( $this->content['error'] ) )
                $this->error( @$this->content['error'] );

            if ( isset( $favorite ) ) {
                $this->form_hidden_elements( @$favorite['form_hidden'] );
                $this->output( '</form>' );
            }
        }

        /**
         * add RSS feed icon after the page title
         *
         * @return null
         */
        function feed_link()
        {
            if ( $this->donut_page_has_feed() ) {
                $feed = @$this->content['feed'];
                $this->output( '<a href="' . $feed['url'] . '" title="' . @$feed['label'] . '" class="qa-rss-feed"><i class="fa fa-rss qa-rss-icon" ></i></a>' );
            }
        }

        function header() // removes user navigation and search from header and replaces with custom header content. Also opens new <div>s
        {
            $this->output( '<div class="qa-header clearfix">' );
            $this->header_clear();
            $this->header_custom();
            $this->output( '</div> <!-- END qa-header -->', '' );
            $this->output( '<div class="qa-main-shadow clearfix">', '' );
            $this->output( '<div class="qa-main-wrapper clearfix row">', '' );
        }

        function header_custom() // allows modification of custom element shown inside header after logo
        {
            if ( isset( $this->content['body_header'] ) ) {
                $this->output( '<div class="header-banner">' );
                $this->output_raw( $this->content['body_header'] );
                $this->output( '</div>' );
            }
        }

        function left_side_bar( $sub_navigation )
        {

            $this->output( '<div class="qa-left-side-bar" id="sidebar" role="navigation">', '' );
            if ( count( $sub_navigation ) ) {

                $this->output( '<div class="list-group">', '' );

                foreach ( $sub_navigation as $key => $sub_navigation_item ) {
                    $this->donut_nav_side_bar_item( $sub_navigation_item );
                }
                $this->output( '</div>', '' );
                if ( $this->template === 'admin' ) {
                    unset( $this->content['navigation']['sub'] );
                }
            }
            $this->output( '</div>', '<!-- END of left-side-bar -->' );
        }

        /**
         * nav item for the sidebar
         *
         * @param  array $nav_item navigation item
         *
         * @return null
         */
        function donut_nav_side_bar_item( $nav_item )
        {
            $class = ( !!@$nav_item['selected'] ) ? ' active' : '';
            $icon = ( !!@$nav_item['icon'] ) ? donut_get_fa_icon( @$nav_item['icon'] ) : '';
            $this->output( '<a href="' . $nav_item['url'] . '" class="list-group-item ' . $class . '">' . $icon . $nav_item['label'] . '</a>' );
        }

        function main()
        {
            $content = $this->content;
            $width_class = ( $this->donut_do_hide_sidebar() && $this->template != 'admin' ) ? 'col-xs-12' : 'qa-main col-md-9 col-xs-12 pull-left';

            $extratags = isset($this->content['main_tags']) ? $this->content['main_tags'] : '';
            $this->output( '<div class="' . $width_class . ( @$this->content['hidden'] ? ' qa-main-hidden' : '' ) . '"'.$extratags.'>' );

            if ( !empty( $this->content['navigation']['sub'] ) || $this->template == 'admin' ) {
                $this->donut_sidebar_toggle_nav_btn();
            }

            $this->widgets( 'main', 'top' );

            if ( !empty( $this->content['navigation']['sub'] ) || $this->template == 'admin' ) {

                $this->output( '<div class="hidden-xs subnav-row clearfix">' );
                $this->nav_main_sub();
                $this->output( '</div>' );

            }

            $this->widgets( 'main', 'high' );

            $this->main_parts( $content );

            $this->widgets( 'main', 'low' );

            $this->page_links();
            $this->suggest_next();

            $this->widgets( 'main', 'bottom' );

            $this->output( '</div> <!-- END qa-main -->', '' );
        }

        /**
         * prints sidebar navigation
         *
         * @return  null
         */
        function donut_sidebar_toggle_nav_btn()
        {
            $this->output( '<div class="row">' );
            $this->output( '<div class="pull-left col-xs-12 visible-xs side-toggle-button">' );
            $this->output( '<button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">' );
            $this->output( '<i class="fa fa-chevron-right toggle-icon"></i>' );
            $this->output( '</button>' );
            $this->output( '</div>' );
            $this->output( '</div>' );
        }

        function sidepanel()
        {
            $this->output( '<div class="qa-sidepanel col-md-3 col-xs-12 pull-right">' );
            $this->output( '<div class="side-search-bar hidden-xs">' );
            $this->search();
            $this->output( '</div>' );
            $this->widgets( 'side', 'top' );
            $this->sidebar();
            $this->widgets( 'side', 'high' );
            $this->widgets( 'side', 'low' );
            $this->output_raw( @$this->content['sidepanel'] );
            $this->feed();
            $this->widgets( 'side', 'bottom' );
            $this->output( '</div>', '' );
        }

        /**
         * the feed icon with a link
         *
         * @return null
         */
        function feed()
        {
            $feed = @$this->content['feed'];

            if ( !empty( $feed ) ) {
                $icon = donut_get_fa_icon( 'rss' );
                $this->output( '<div class="qa-feed">' );
                $this->output( '<a href="' . $feed['url'] . '" class="qa-feed-link"> <span class="icon-wrapper"> <span class="qa-feed-icon">' . $icon . ' </span></span>' . @$feed['label'] . '</a>' );
                $this->output( '</div>' );
            }
        }

        /**
         * prevent display of regular footer content (see body_suffix()) and replace with closing new <div>s
         *
         * @return  null
         */
        function footer()
        {
            $this->output( '</div> <!-- END main-wrapper -->' );
            $this->output( '</div> <!-- END main-shadow -->' );
        }

        function body_suffix() // to replace standard Q2A footer
        {
            if ( qa_opt( 'donut_show_site_stats_above_footer' ) ) {
                $this->donut_site_stats_bottom();
            }

            $this->output( '<footer class="donut-footer">' );

            if ( qa_opt( 'donut_enable_back_to_top_btn' ) ) {
                $this->output( '<a class="donut-top"><span class="fa fa-chevron-up"></span></a>' );
            }

            $this->output( '<div class="container">' );
            parent::footer();
            $this->output( '</div> <!--END Container-->' );
            $this->output( '</footer> <!-- END footer -->', '' );
        }

        function logged_in()
        {
            if ( qa_is_logged_in() ) // output user avatar to login bar
                $this->output(
                        '<div class="qa-logged-in-avatar">',
                        QA_FINAL_EXTERNAL_USERS
                                ? qa_get_external_avatar_html( qa_get_logged_in_userid(), 24, true )
                                : qa_get_user_avatar_html( qa_get_logged_in_flags(), qa_get_logged_in_email(), qa_get_logged_in_handle(),
                                qa_get_logged_in_user_field( 'avatarblobid' ), qa_get_logged_in_user_field( 'avatarwidth' ), qa_get_logged_in_user_field( 'avatarheight' ),
                                24, true ),
                        '</div>'
                );

            parent::logged_in();

            if ( qa_is_logged_in() ) { // adds points count after logged in username
                $userpoints = qa_get_logged_in_points();

                $pointshtml = ( $userpoints == 1 )
                        ? qa_lang_html_sub( 'main/1_point', '1', '1' )
                        : qa_lang_html_sub( 'main/x_points', qa_html( number_format( $userpoints ) ) );

                $this->output(
                        '<span class="qa-logged-in-points">',
                        '(' . $pointshtml . ')',
                        '</span>'
                );
            }
        }

        function body_header() // adds login bar, user navigation and search at top of page in place of custom header content
        {
            if ( !empty( $this->content['navigation']['main'] ) ) {
                $this->output( $this->donut_nav_bar( $this->content['navigation'] ) );
                unset( $this->content['navigation']['main'] );
            }
        }

        /**
         * prints the complete navbar
         *
         * @param  $navigation
         *
         * @return text
         */
        function donut_nav_bar( $navigation )
        {
            ob_start();

            if ( qa_opt( 'donut_enable_top_bar' ) ) {
                donut_include_template( 'top-header.php' );
            }

            ?>
            <header id="nav-header">
                <nav id="nav" class="navbar navbar-static-top"
                     role="navigation" <?php echo( qa_opt( 'donut_enable_sticky_header' ) ? 'data-spy="affix" data-offset-top="120"' : '' ) ?>>
                    <div class="container">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                    data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="glyphicon glyphicon-menu-hamburger"></span>
                            </button>
                        </div>
                        <div class="col-sm-3 col-xs-8 logo-wrapper">
                            <?php $this->logo(); ?>
                        </div>
                        <div class="donut-navigation col-sm-2 col-xs-3 pull-right">
                            <?php $this->donut_user_drop_down(); ?>
                        </div>
                        <div class="col-sm-7 navbar-collapse collapse main-nav navbar-left">
                            <ul class="nav navbar-nav inner-drop-nav">
                                <?php $this->donut_nav_bar_main_links( $navigation['main'] ); ?>
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>
            <?php
            return ob_get_clean();
        }

        /**
         * prints the navbar search on the top
         *
         * @return null
         */
        function search()
        {
            $search = $this->content['search'];

            $this->output(
                    '<form class="search-form" role="form" ' . $search['form_tags'] . '>',
                    @$search['form_extra']
            );

            $this->search_field( $search );
            // $this->search_button($search);

            $this->output(
                    '</form>'
            );
        }

        /**
         * prints the search field
         *
         * @param  array $search
         *
         * @return null
         */
        function search_field( $search )
        {
            $this->output(
                    '<div class="input-group">',
                    '<input type="text" ' . $search['field_tags'] . ' value="' . @$search['value'] . '" class="qa-search-field form-control" placeholder="' . $search['button_label'] . '"/>' );
            $this->search_button( $search );
            $this->output( '</div>' );
        }

        public function form_password( $field, $style )
        {
            $this->output( '<input ' . @$field['tags'] . ' type="password" value="' . @$field['value'] . '" class="qa-form-' . $style . '-text form-control"/>' );
        }

        public function form_number( $field, $style )
        {
            $this->output( '<input ' . @$field['tags'] . ' type="text" value="' . @$field['value'] . '" class="qa-form-' . $style . '-number form-control"/>' );
        }


        public function form_text_single_row( $field, $style )
        {
            $this->output( '<input ' . @$field['tags'] . ' type="text" value="' . @$field['value'] . '" class="qa-form-' . $style . '-text form-control"/>' );
        }

        public function form_text_multi_row( $field, $style )
        {
            $this->output( '<textarea ' . @$field['tags'] . ' rows="' . (int) $field['rows'] . '" cols="40" class="qa-form-' . $style . '-text  form-control">' . @$field['value'] . '</textarea>' );
        }

        /**
         * Output a <select> element. The $field array may contain the following keys:
         *   options: (required) a key-value array containing all the options in the select.
         *   tags: any attributes to be added to the select.
         *   value: the selected value from the 'options' parameter.
         *   match_by: whether to match the 'value' (default) or 'key' of each option to determine if it is to be selected.
         */
        public function form_select( $field, $style )
        {
            $this->output( '<select ' . ( isset( $field['tags'] ) ? $field['tags'] : '' ) . ' class="qa-form-' . $style . '-select form-control">' );

            // Only match by key if it is explicitly specified. Otherwise, for backwards compatibility, match by value
            $matchbykey = isset( $field['match_by'] ) && $field['match_by'] === 'key';

            foreach ( $field['options'] as $key => $value ) {
                $selected = isset( $field['value'] ) && (
                                ( $matchbykey && $key === $field['value'] ) ||
                                ( !$matchbykey && $value === $field['value'] )
                        );
                $this->output( '<option value="' . $key . '"' . ( $selected ? ' selected' : '' ) . '>' . $value . '</option>' );
            }

            $this->output( '</select>' );
        }

        public function form_select_radio( $field, $style )
        {
            $radios = 0;

            foreach ( $field['options'] as $tag => $value ) {
                if ( $radios++ )
                    $this->output( '<br/>' );

                $this->output( '<input ' . @$field['tags'] . ' type="radio" value="' . $tag . '"' . ( ( $value == @$field['value'] ) ? ' checked' : '' ) . ' class="qa-form-' . $style . '-radio"/> ' . $value );
            }
        }

        /**
         * prints the aearch button
         *
         * @param  array $search
         *
         * @return null
         */
        function search_button( $search )
        {
            $this->output( '<span class="input-group-btn">' );
            $this->output( '<button type="submit" value="" class="btn qa-search-button" ><span class="fa fa-search"></span></button>' );
            $this->output( '</span>' );
        }

        /**
         * prints the drop down for the user
         *
         */
        function donut_user_drop_down()
        {
            if ( qa_is_logged_in() ) {
                require_once DONUT_THEME_BASE_DIR . '/templates/user-loggedin-drop-down.php';
            } else {
                require_once DONUT_THEME_BASE_DIR . '/templates/user-login-drop-down.php';
            }
        }

        /**
         * grabs the sub-nav links for the navigation items
         *
         * @param  array $navigation navigation links
         *
         * @return null
         */
        function donut_nav_bar_main_links( $navigation )
        {
            if ( count( $navigation ) ) {
                foreach ( $navigation as $key => $nav_item ) {
                    $this->donut_nav_bar_item( $nav_item );
                }
            }
        }

        /**
         * Prints the drop down menu
         *
         * @param  array $nav_item      the navigation item
         * @param  array $sub_nav_items sub-nav items to be displayed
         *
         * @return null
         */
        function donut_nav_bar_drop_down( $nav_item, $sub_nav_items )
        {
            $class = ( !!@$nav_item['selected'] ) ? 'active' : '';

            if ( !empty( $sub_nav_items ) && count( $sub_nav_items ) ) {
                $nav_item['class'] = "dropdown-split-left";
                $this->donut_nav_bar_item( $nav_item );
                $this->output( '<li class="dropdown dropdown-split-right hidden-xs ' . $class . '">' );
                $this->output( '<a href="#" class="dropdown-toggle transparent" data-toggle="dropdown"><i class="fa fa-caret-down"></i></a>' );
                $this->output( '<ul class="dropdown-menu" role="menu">' );
                foreach ( $sub_nav_items as $key => $sub_nav_item ) {
                    $this->donut_nav_bar_item( $sub_nav_item );
                }
                $this->output( '</ul>' );
                $this->output( '</li>' );
            } else {
                $this->donut_nav_bar_item( $nav_item );
            }
        }

        /**
         * prints a single nav-bar item
         *
         * @param  array $nav_item navigation item
         *
         * @return null
         */
        function donut_nav_bar_item( $nav_item )
        {
            $class = ( !!@$nav_item['class'] ) ? $nav_item['class'] . ' ' : '';
            $class .= ( !!@$nav_item['selected'] ) ? 'active' : '';

            if ( !empty( $class ) ) {
                $class = 'class="' . $class . '"';
            }

            $icon = ( !!@$nav_item['icon'] ) ? donut_get_fa_icon( @$nav_item['icon'] ) : '';

            $this->output( '<li ' . $class . '><a href="' . $nav_item['url'] . '">' . $icon . $nav_item['label'] . '</a></li>' );
        }

        function page_links_item( $page_link )
        {
            $active_class = ( @$page_link['type'] === 'this' ) ? ' active' : '';
            $disabled_class = ( @$page_link['type'] === 'ellipsis' ) ? ' disabled' : '';
            $this->output( '<li class="qa-page-links-item' . $active_class . $disabled_class . '">' );
            $this->page_link_content( $page_link );
            $this->output( '</li>' );
        }

        function a_selection( $post )
        {
            $this->output( '<div class="qa-a-selection">' );

            if ( isset( $post['select_tags'] ) )
                $this->post_hover_button( $post, 'select_tags', '', 'qa-a-select' );
            elseif ( isset( $post['unselect_tags'] ) )
                $this->post_hover_button( $post, 'unselect_tags', '', 'qa-a-unselect' );
            elseif ( $post['selected'] )
                $this->output( '<div class="qa-a-selected"> <span class="fa fa-check"></span> </div>' );

            if ( isset( $post['select_text'] ) )
                $this->output( '<div class="qa-a-selected-text">' . @$post['select_text'] . '</div>' );

            $this->output( '</div>' );
        }

        function post_hover_button( $post, $element, $value, $class )
        {
            if ( isset( $post[$element] ) ) {
                $icon = donut_get_voting_icon( $element );
                $this->output( '<button ' . $post[$element] . ' type="submit" value="' . $value . '" class="' . $class . '-button"> ' . $icon . '</button>' );
            }
        }

        public function q_list_item( $q_item )
        {
            $this->output( '<div class="qa-q-list-item row' . rtrim( ' ' . @$q_item['classes'] ) . '" ' . @$q_item['tags'] . '>' );

            $this->q_item_stats( $q_item );
            //$this->q_item_avatar( $q_item );
            $this->q_item_main( $q_item );
            $this->q_item_clear();

            $this->output( '</div> <!-- END qa-q-list-item -->', '' );
        }

        function q_item_avatar( $q_item )
        {
            $avatar = donut_get_post_avatar( $q_item, 60 );
            $this->output( '<div class="qa-q-item-avatar-warp">' );
            $this->output( $avatar );
            $this->output( '</div>' );
        }

        /**
         * add view count to question list
         *
         * @param  array $q_item
         *
         * @return null
         */
        function q_item_stats( $q_item )
        {
            $this->output( '<div class="qa-q-item-stats">' );

            $this->voting( $q_item );
            $this->a_count( $q_item );

            $this->output( '</div>' );
        }

        function post_meta( $post, $class, $prefix = null, $separator = '<br/>' )
        {
            $this->output( '<span class="' . $class . '-meta">' );

            if ( isset( $prefix ) )
                $this->output( $prefix );

            $order = explode( '^', @$post['meta_order'] );

            foreach ( $order as $element )
                switch ( $element ) {
                    case 'what':
                        $this->post_meta_what( $post, $class );
                        break;

                    case 'when':
                        $this->post_meta_when( $post, $class );
                        break;

                    case 'where':
                        $this->post_meta_where( $post, $class );
                        break;

                    case 'who':
                        $this->post_meta_who( $post, $class );
                        break;
                }

            $this->post_meta_flags( $post, $class );

            if ( !empty( $post['what_2'] ) ) {
                $this->output( $separator );

                foreach ( $order as $element )
                    switch ( $element ) {
                        case 'what':
                            $this->output( '<span class="' . $class . '-what">' . $post['what_2'] . '</span>' );
                            break;

                        case 'when':
                            $this->output_split( @$post['when_2'], $class . '-when' );
                            break;

                        case 'who':
                            $this->output_split( @$post['who_2'], $class . '-who' );
                            break;
                    }
            }
            $this->donut_view_count( $post );
            $this->output( '</span>' );
        }

        /**
         * prints the view count
         *
         * @param  array
         *
         * @return null
         */
        function donut_view_count( $post )
        {
            if ( !empty( $post['views'] ) ) {
                $this->output( '<span class="qa-q-item-view-count">' );
                $this->output( ' | <i class="fa fa-eye"></i>' );
                $this->output_split( @$post['views'], 'q-item-view' );
                $this->output( '</span>' );
            }
        }

        function view_count( $q_item ) // prevent display of view count in the usual place
        {
            if ( isset($q_item['content']) )
                parent::view_count( $q_item );
        }

        function post_disabled_button( $post, $element, $value, $class )
        {
            if ( isset( $post[$element] ) ) {
                $icon = donut_get_voting_icon( $element );
                $this->output( '<button ' . $post[$element] . ' type="submit" value="' . $value . '" class="' . $class . '-disabled" disabled="disabled"/> ' . $icon . '</button>' );
            }
        }

        function form_button_data( $button, $key, $style )
        {
            $baseclass = 'qa-form-' . $style . '-button qa-form-' . $style . '-button-' . $key;

            $this->output( '<button' . rtrim( ' ' . @$button['tags'] ) . ' title="' . @$button['popup'] . '" type="submit"' .
                    ( isset( $style ) ? ( ' class="' . $baseclass . '"' ) : '' ) . '>' . @$button['label'] . '</button>' );
        }

        /**
         * prints the favorite button
         *
         * @param  array $tags parameters
         * @param  [type] $class class
         *
         * @return null
         */
        function favorite_button( $tags, $class )
        {
            if ( isset( $tags ) ) {
                $icon = donut_get_fa_icon( 'heart' );
                $this->output( '<button ' . $tags . ' type="submit" value="" class="' . $class . '-button"/> ' . $icon . '</button>' );
            }
        }

        /**
         * Attribution link for the theme which adds the authors name
         *
         * @return null
         */
        function attribution()
        {
            if ( qa_opt( 'donut_show_social_links_at_footer' ) ) {
                $this->footer_social_links();
            }

            $this->output( '<div class="footer-bottom">' );
            $this->donut_attribution();
            parent::attribution();

            if ( qa_opt( 'donut_show_copyright_at_footer' ) ) {
                $this->donut_copyright();
            }

            $this->output( '</div>' );
        }

        /**
         * beautifies the default waiting template with a font aswome icon
         *
         * @return null
         */
        function waiting_template()
        {
            $this->output( '<span id="qa-waiting-template" class="qa-waiting fa fa-spinner fa-spin"></span>' );
        }

        /**
         * beautifies the default notice
         *
         * @param  array $notice notice parameters
         *
         * @return null
         */
        function notice( $notice )
        {
            $this->output( '<div class="qa-notice alert alert-info text-center alert-dismissible" role="alert" id="' . $notice['id'] . '">' );

            if ( isset( $notice['form_tags'] ) )
                $this->output( '<form ' . $notice['form_tags'] . '>' );

            $this->output( '<button ' . $notice['close_tags'] . ' type="submit" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>' );

            $this->output_raw( $notice['content'] );


            if ( isset( $notice['form_tags'] ) ) {
                $this->form_hidden_elements( @$notice['form_hidden'] );
                $this->output( '</form>' );
            }

            $this->output( '</div>' );
        }

        public function error( $error )
        {
            if ( strlen( $error ) ) {
                $this->output(
                        '<div class="donut-error alert alert-dismissible" role="alert">',
                        $error,
                        '<button class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>',
                        '</div>'
                );
            }
        }

        /**
         * prints the favicon icon
         *
         * @return  null
         */
        function donut_favicon()
        {
            $this->output_raw( '<link rel="shortcut icon" href="favicon.ico">' );
        }

        function ranking( $ranking )
        {
            $class = ( @$ranking['type'] == 'users' ) ? 'qa-top-users' : 'qa-top-tags';
            $item_count = min( $ranking['rows'], count( $ranking['items'] ) );

            if ( @$ranking['type'] == 'users' ) {


                if ( count( $ranking['items'] ) ) {
                    $this->output( '<div class="page-users-list clearfix"><div class="row">' );
                    $columns = qa_opt( 'columns_users' );
                    $pagesize = qa_opt( 'page_size_users' );
                    $start = qa_get_start();
                    $users = qa_db_select_with_pending( qa_db_top_users_selectspec( $start, qa_opt_if_loaded( 'page_size_users' ) ) );
                    $users = array_slice( $users, 0, $pagesize );
                    $usershtml = qa_userids_handles_html( $users );

                    foreach ( $ranking['items'] as $user ) {
                        $this->output( '<div class="user-box col-sm-' . ceil( 12 / $columns ) . ' col-xs-12">' );
                        $user_raw = !empty( $user['raw'] ) ? $user['raw'] : $user;
                        
                        $handle_html = @$usershtml[$user_raw['userid']];

                        if ( defined( 'QA_WORDPRESS_INTEGRATE_PATH' ) ) {
                            $level_html = $user['score'];
                            unset( $user['score'] );
                        } else {
                            if ( is_numeric( $user['score'] ) ) {
                                $user_level = donut_get_user_level( $user_raw['userid'] );
                                $level_html = qa_user_level_string( $user_level );
                            } else {
                                $level_html = $user['score'];
                                unset( $user['score'] );
                            }
                        }

                        if ( empty( $handle_html ) ) {
                            $handle_html = $user['label'];
                        }

                        $avatar = ( QA_FINAL_EXTERNAL_USERS
                                ? qa_get_external_avatar_html( @$user_raw['userid'], qa_opt( 'avatar_users_size' ), true )
                                : qa_get_user_avatar_html( @$user_raw['flags'], @$user_raw['email'], @$user_raw['handle'],
                                        @$user_raw['avatarblobid'], @$user_raw['avatarwidth'], @$user_raw['avatarheight'], 70, true )
                        );

                        if ( isset( $user['score'] ) ) {
                            $userpoints = $user['score'];
                            $pointshtml = ( $userpoints === 1 ) ? qa_lang_html_sub( 'main/1_point', '1', '1' )
                                    : qa_lang_html_sub( 'main/x_points', qa_html( $userpoints ) );
                            if ( !empty( $pointshtml ) ) {
                                $pointshtml = '<p class="score">' . $pointshtml . '</p>';
                            }
                        }

                        $this->output( '
								<div class="user-box-inner">
									<div class="user-avatar">
										' . $avatar . '
									</div>
									<div class="user-data">
										' . $handle_html . '
										<div class="user-level">
											' . $level_html . '
										</div>
										<div class="counts clearfix">
											' . @$pointshtml . '
										</div>
								</div>' );
                        $this->output( '</div>' );
                        $this->output( '</div>' );
                    }

                    $this->output( '</div>' );
                    $this->output( '</div>' );
                } else {
                    $title = isset( $this->content['ranking_users']['title'] ) ? $this->content['ranking_users']['title'] : @$this->content['title'];
                    $this->output( '
								<div class="no-items">
									<div class="alert alert-info"><span class="fa fa-warning"></span> ' . $title . '</div>
								</div>' );
                }


            } elseif ( @$ranking['type'] == 'tags' ) {

                if ( count( $ranking['items'] ) ) {
                    $this->output( '<div id="tags-list" class="row ' . $class . '">' );

                    $columns = qa_opt( 'columns_tags' );

                    for ( $column = 0 ; $column < $columns ; $column++ ) {
                        $this->set_context( 'ranking_column', $column );
                        $this->output( '<div class="col-md-' . ceil( 12 / $columns ) . ' col-xs-12" >' );
                        $this->output( '<ul class="donut-tags-list">' );

                        for ( $row = 0 ; $row < $item_count ; $row++ ) {
                            $this->set_context( 'ranking_row', $row );
                            $this->donut_tags_item( @$ranking['items'][$column * $item_count + $row], $class, $column > 0 );
                        }

                        $this->clear_context( 'ranking_column' );

                        $this->output( '</ul>' );
                        $this->output( '</div>' );
                    }

                    $this->clear_context( 'ranking_row' );

                    $this->output( '</div>' );
                } else {
                    $this->output( '
						<div class="no-items">
						<div class="alert alert-info"><span class="fa fa-warning"></span> ' . donut_lang('no_tags_message') . '</div>
						</div>' );
                }

            } else {
                parent::ranking( $ranking );
            }
        }

        function donut_tags_item( $item, $class, $spacer )
        {
            $content = qa_db_read_one_value( qa_db_query_sub( "SELECT ^tagmetas.content FROM ^tagmetas WHERE ^tagmetas.tag =$ ", strip_tags( $item['label'] ) ), true );

            if ( isset( $item ) )
                $this->output(
                        '<li class="tag-item">',
                        '<div class="tag-head clearfix">',
                        '<span> ' . $item['count'] . ' &#215;</span>',
                        '<div class="qa-tags-rank-tag-item">',
                        $item['label'],
                        '</div>',
                        '</div>'
                );
            if ( !empty( $content ) ) {
                $this->output( '<p class="desc">',
                        $this->truncate( $content, 150 ),
                        '</p>' );
            }
            $this->output( '</li>' );
        }

        function truncate( $string, $limit, $pad = "..." )
        {
            if ( strlen( $string ) <= $limit )
                return $string;
            else {
                $text = $string . ' ';
                $text = substr( $text, 0, $limit );
                $text = substr( $text, 0, strrpos( $text, ' ' ) );

                return $text . $pad;
            }
        }

        private function donut_breadcrumb()
        {
            if ( class_exists( 'Ami_Breadcrumb' ) && qa_opt( 'donut_show_breadcrumbs' ) ) {
                if ( !$this->is_home() && $this->template !== 'admin' ) {
                    $args = array(
                            'themeobject' => $this,
                            'content'     => $this->content,
                            'template'    => $this->template,
                            'request'     => qa_request(),
                    );
                    $breadcrumb = new Ami_Breadcrumb( $args );
                    $this->output( '<div class="donut-breadcrumb">' );
                    $breadcrumb->generate();
                    $this->output( '</div>' );
                }
                /*TODO: unset the breadcrumb if it exists*/
            }
        }

        public function message_content( $message )
        {
            if ( !empty( $message['content'] ) ) {
                $this->output( '<div class="qa-message-content-wrapper">' );
                $this->output( '<div class="qa-message-content">' );
                $this->output_raw( $message['content'] );
                $this->output( '</div>' );
                $this->output( '</div>' );
            }
        }

        public function vote_clear()
        {
            $this->output(
                    '<div class="qa-vote-clear clearfix">',
                    '</div>'
            );
        }

        public function page_links_clear()
        {
            $this->output(
                    '<div class="qa-page-links-clear clearfix">',
                    '</div>'
            );
        }

        public function q_view_clear()
        {
            $this->output(
                    '<div class="qa-q-view-clear clearfix">',
                    '</div>'
            );
        }

        public function a_item_clear()
        {
            $this->output(
                    '<div class="qa-a-item-clear clearfix">',
                    '</div>'
            );
        }

        public function c_item_clear()
        {
            $this->output(
                    '<div class="qa-c-item-clear clearfix">',
                    '</div>'
            );
        }

        public function nav_clear( $navtype )
        {
            $this->output(
                    '<div class="qa-nav-' . $navtype . '-clear clearfix">',
                    '</div>'
            );
        }

        public function header_clear()
        {
            $this->output(
                    '<div class="qa-header-clear clearfix">',
                    '</div>'
            );
        }

        public function footer_clear()
        {
            $this->output(
                    '<div class="qa-footer-clear clearfix">',
                    '</div>'
            );
        }

        public function q_item_clear()
        {
            $this->output(
                    '<div class="qa-q-item-clear clearfix">',
                    '</div>'
            );
        }

        /**
         * @return array
         */
        private function donut_hide_sidebar_for_template()
        {
            return array(
                    'users',
                /*'tags', 'categories' ,*/
                    'admin', 'user', 'account',
                    'favorites', 'user-wall', 'messages',
                    'user-activity', 'user-questions', 'user-answers' );
        }

        /**
         * @return bool
         */
        private function donut_do_hide_sidebar()
        {
            return in_array( $this->template, $this->donut_hide_sidebar_for_template() );
        }

        function donut_page_has_feed()
        {
            return !empty( $this->content['feed'] );
        }

        function donut_page_has_favorite()
        {
            return isset( $this->content['favorite'] );
        }

        /**
         * =================================================
         * Check if the current page is home page or not
         *
         * @return bool
         * =================================================
         */
        public function is_home()
        {
            return empty( $this->request ) || $this->request === array_search('', qa_get_request_map());
        }

        public function donut_site_header()
        {
            if ( $this->is_home() && qa_opt( 'donut_show_home_page_banner' ) ) {
                //check if user closed the header intentionally
                $user_hidden = qa_opt( 'donut_banner_closable' ) ?
                        @$_COOKIE['donut_hide_site_header'] : 'no';

                if ( $user_hidden !== 'yes' )
                    donut_include_template( 'site-header.php' );
            }
        }

        public function suggest_next()
        {
            $suggest = @$this->content['suggest_next'];

            if ( !empty( $suggest ) ) {
                $this->output( '<div class="qa-suggest-next col-xs-12 text-center clearfix alert">' );
                $this->output( $suggest );
                $this->output( '</div>' );
            }
        }

        private function donut_site_stats_bottom()
        {
            donut_include_template( 'site-stats-bottom.php' );
        }

        /**
         * Attribution for Donut theme
         * Please do not remove this as you are using this for free .
         * I will appreciate if you keep this on your site
         */
        private function donut_attribution()
        {
            $this->output(
                    '<div class="qa-attribution">',
                    '<a href="https://github.com/amiyasahu/Donut">Donut Theme</a> <span class="fa fa-code"></span> with <span class="fa fa-heart"></span> by <a href="http://amiyasahu.github.io">Amiya Sahu</a>',
                    '</div>'
            );
        }

        private function donut_copyright()
        {
            $this->output(
                    '<div class="donut-copyright">',
                    '<span class="fa fa-copyright"></span>',
                    qa_opt( 'donut_copyright_text' ),
                    '</div>'
            );
        }

        private function footer_social_links()
        {
            $this->output( '<div class="footer-social">' );
            $social_links = donut_generate_social_links();
            $this->output( '<ul>' );
            foreach ( $social_links as $key => $value ) {
                $this->output( '<li>' );
                $this->output( donut_get_social_link( $value, true ) );
                $this->output( '</li>' );
            }
            $this->output( '</ul>' );

            $this->output( '</div>' );
        }

        public function widgets( $region, $place )
            /*
                Output the widgets (as provided in $this->content['widgets']) for $region and $place
            */
        {
            if ( isset($this->content['widgets'][$region][$place]) && 
                  is_array($this->content['widgets'][$region][$place]) && 
                  !empty($this->content['widgets'][$region][$place]) ) {
                
                $col = ( $region == 'full' ) ? ' col-xs-12' : '';

                $this->output( '<div class="qa-widgets-' . $region . ' qa-widgets-' . $region . '-' . $place . $col . '">' );

                foreach ( $this->content['widgets'][$region][$place] as $module ) {
                    $this->output( '<div class="qa-widget-' . $region . ' qa-widget-' . $region . '-' . $place . '">' );
                    $module->output_widget( $region, $place, $this, $this->template, $this->request, $this->content );
                    $this->output( '</div>' );
                }

                $this->output( '</div>', '' );
            }
        }

        public function post_tags( $post, $class )
        {
            if ( !empty( $post['q_tags'] ) ) {
                $this->output( '<div class="' . $class . '-tags clearfix">' );
                $this->post_tag_list( $post, $class );
                $this->output( '</div>' );
            }
        }

        function donut_divide_array( &$original, $allowed_keys )
        {
            if ( count( $original ) && count( $allowed_keys ) ) {
                $copy = $original;

                foreach ( $original as $key => $btn ) {
                    if ( !in_array( $key, $allowed_keys ) ) {
                        unset( $original[$key] );
                    }
                }

                foreach ( $copy as $key => $btn ) {
                    if ( in_array( $key, $allowed_keys ) ) {
                        unset( $copy[$key] );
                    }
                }

                return $copy;
            }

            return $original;
        }

    }
/*
	Omit PHP closing tag to help avoid accidental output
*/
