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
        'activate_prod_mode' => false,

        /**
         * Is RTL
         * Enable or disable the RTL mode
         * Allowed values true | false
         */
        'is_rtl'             => false,

        /**
         * Enable Top bar
         * Whether to enable the top header
         * Allowed values true | false
         */
        'enable_top_bar'     => true,
    );