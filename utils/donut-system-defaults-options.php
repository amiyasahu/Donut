<?php

    if ( !defined( 'QA_VERSION' ) ) { // don't allow this page to be requested directly from browser
        header( 'Location: ../../' );
        exit;
    }

    return array(
        /**
         * Activate Prod Mode
         * Desc - Whether or not activate the prod mode ,
         * when set to true it uses minified css , JS and CDN to improve site performance
         * Note - If you using this on your local machine with out a internet connection then set it to false
         * Allowed values true | false
         * Default : false
         */
        'activate_prod_mode'                   => false,

        /**
         * Is RTL
         * Enable or disable the RTL mode
         * Allowed values true | false
         * Default : false
         */
        'is_rtl'                               => false,

        /**
         * Enable Top bar
         * Whether to enable the top header
         * Allowed values true | false
         * Default : false
         */
        'enable_top_bar'                       => true,

        /**
         * Text to be displayed at the top-left of the website , before the Navigation bar
         * Any Text / HTML allowed
         */
        'top_bar_left_text'                    => "Donut - Lightweight and Free responsive Q2A theme",

        /**
         * Text to be displayed at the top-right of the website , before Navigation
         * Any Text / HTML Allowed
         */
        'top_bar_right_text'                   => "",

        /**
         * Show Social Links at the top bar
         * Allowed values true | false
         * Default : false
         */
        'top_bar_add_social_links'             => false,

        /**
         * Enable Breadcrumbs , for perfect integration with the Breadcrumb plugin
         * Allowed values true | false
         * Default : false
         */
        'enable_breadcrumbs'                   => true,

        /**
         * Header sticks to the top of tha page if this option is enabled
         * Allowed values true | false
         * Default : true
         */
        'enable_stiky_header_upon_scroll'      => true,

        /**
         * Enable back to top button
         * Allowed values true | false
         * Default : true
         */
        'enable_back_to_top_button'            => true,

        /**
         * Enable home page banner
         * Allowed values true | false
         * Default : true
         */
        'show_home_page_banner'                => true,

        /**
         * Allow user to close the home page banner
         * Allowed values true | false
         * Default : false
         */
        'allow_user_to_close_home_page_banner' => false,

        /**
         * Allow site stats above footer
         * Allowed values true | false
         * Default : true
         */
        'allow_site_stats_above_footer'        => true,

        /**
         * Allow site stats above footer
         * Allowed values true | false
         * Default : true
         */
        'show_social_links_on_footer'          => true,

        /**
         * Show copyright at footer
         * Allowed values true | false
         * Default : true
         */
        'show_copy_right_at_footer'            => true,

        /**
         * Copyright text
         * Allowed values text/html
         * Default : '<span class="fa fa-copyright"></span> 2015 Donut Theme'
         */
        'copyright_text'                       => '<span class="fa fa-copyright"></span> 2015 Donut Theme',

        'social_links'                         => array(
            'facebook'    => array(
                'link'       => 'https://www.facebook.com/',
                'icon'       => 'facebook',
                'text'       => 'Facebook',
                'hover-text' => 'Follow us on facebook',
            ),
            'twitter'     => array(
                'link'       => 'https://www.twitter.com/',
                'icon'       => 'twitter',
                'text'       => 'Twitter',
                'hover-text' => 'Follow us on twitter',
            ),
            'email'       => array(
                'link'       => 'https://www.twitter.com/',
                'icon'       => 'envelope',
                'text'       => 'Email',
                'hover-text' => 'Send us an email',
            ),
            'pinterest'   => array(
                'link'       => 'https://www.pinterest.com/',
                'icon'       => 'pinterest',
                'text'       => 'Pinterest',
                'hover-text' => 'Follow us on pinterest',
            ),
            'google-plus' => array(
                'link'       => 'https://plus.google.com/',
                'icon'       => 'google-plus',
                'text'       => 'Google Plus',
                'hover-text' => 'Follow us on Google+',
            ),
            'vk'          => array(
                'link'       => 'https://www.vk.com/',
                'icon'       => 'vk',
                'text'       => 'vk',
                'hover-text' => 'Follow us on vk',
            ),
        ),
    );