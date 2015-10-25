<?php
    /**
     * Reset the options in $names to their defaults
     *
     * @param $names
     */
    function donut_reset_options( $names )
    {
        foreach ( $names as $name )
            qa_set_option( $name, donut_default_option( $name ) );
    }

    /**
     * Return the default value for option $name
     *
     * @param $name
     *
     * @return bool|mixed|string
     */
    function donut_default_option( $name )
    {
        $fixed_defaults = array(
            'donut_activate_prod_mode'           => 0,
            'donut_use_local_font'               => 1,
            'donut_enable_top_bar'               => 1,
            'donut_show_top_social_icons'        => 1,
            'donut_enable_sticky_header'         => 1,
            'donut_enable_back_to_top_btn'       => 1,
            'donut_show_home_page_banner'        => 1,
            'donut_banner_closable'              => 1,
            'donut_banner_show_ask_box'          => 1,
            'donut_show_collapsible_btns'        => 1,
            'donut_show_breadcrumbs'             => 1,
            'donut_show_site_stats_above_footer' => 1,
            'donut_show_social_links_at_footer'  => 1,
            'donut_show_copyright_at_footer'     => 1,
            'donut_show_custom_404_page'         => 1,
            'donut_copyright_text'               => donut_lang( 'donut_theme' ),
            'donut_banner_head_text'             => donut_lang( 'donut_discussion_forum' ),
            'donut_banner_div1_text'             => donut_lang( 'search_answers' ),
            'donut_banner_div1_icon'             => 'fa fa-search-plus',
            'donut_banner_div2_text'             => donut_lang( 'one_destination' ),
            'donut_banner_div2_icon'             => 'fa fa-question-circle',
            'donut_banner_div3_text'             => donut_lang( 'get_expert_answers' ),
            'donut_banner_div3_icon'             => 'fa fa-check-square-o',
            'donut_top_bar_left_text'            => donut_lang( 'responsive_q2a_theme' ),
            'donut_top_bar_right_text'           => donut_lang( 'ask_us_anything' ),
            'donut_custom_404_text'              => donut_lang( 'page_not_found_default_text' ),
        );

        if ( isset( $fixed_defaults[$name] ) ) {
            $value = $fixed_defaults[$name];
        } else {
            switch ( $name ) {

                default: // call option_default method in any registered modules
                    $modules = qa_load_all_modules_with( 'option_default' );  // Loads all modules with the 'option_default' method

                    foreach ( $modules as $module ) {
                        $value = $module->option_default( $name );
                        if ( strlen( $value ) )
                            return $value;
                    }

                    $value = '';
                    break;
            }
        }

        return $value;
    }

    /**
     * Returns an array of all options used in Blog Tool
     *
     * @return array
     */
    function donut_get_all_options()
    {
        return array(
            'donut_activate_prod_mode',
            'donut_use_local_font',
            'donut_enable_top_bar',
            'donut_show_top_social_icons',
            'donut_enable_sticky_header',
            'donut_enable_back_to_top_btn',
            'donut_show_home_page_banner',
            'donut_banner_closable',
            'donut_banner_show_ask_box',
            'donut_show_collapsible_btns',
            'donut_show_breadcrumbs',
            'donut_show_site_stats_above_footer',
            'donut_show_social_links_at_footer',
            'donut_show_copyright_at_footer',
            'donut_copyright_text',
            'donut_banner_head_text',
            'donut_banner_div1_text',
            'donut_banner_div1_icon',
            'donut_banner_div2_text',
            'donut_banner_div2_icon',
            'donut_banner_div3_text',
            'donut_banner_div3_icon',
            'donut_top_bar_left_text',
            'donut_top_bar_right_text',
        );
    }

    /**
     * reset all blog options
     *
     * @return bool
     */
    function donut_reset_all_options()
    {
        donut_reset_options( donut_get_all_options() );

        return true;
    }

