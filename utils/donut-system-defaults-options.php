<?php

    if ( !defined( 'QA_VERSION' ) ) { // don't allow this page to be requested directly from browser
        header( 'Location: ../../' );
        exit;
    }

    return array(
        /**
         * If this option is set to true , the theme will use advanced setups like CDN ,
         * caching to enhance the performance .
         * If you using this on your local machine with out a internet connection then set it to false
         */
        'activate_prod_mode' => false,
        'is_rtl'             => false,
    );