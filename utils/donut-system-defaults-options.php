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
         */
        'activate_prod_mode'              => false,

        /**
         * Is RTL
         * Enable or disable the RTL mode
         * Allowed values true | false
         */
        'is_rtl'                          => false,

        /**
         * Enable Top bar
         * Whether to enable the top header
         * Allowed values true | false
         */
        'enable_top_bar'                  => true,

        'top_bar_left_text'               => "Donut - Lightweight and Free responsive Q2A theme",
        'top_bar_right_text'              => "clean theme",
        'top_bar_add_social_links'        => true,
        'enable_breadcrumbs'              => true,
        'enable_stiky_header_upon_scroll' => true,
        'enable_back_to_top_button'       => true,

        'social_links'                    => array(
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