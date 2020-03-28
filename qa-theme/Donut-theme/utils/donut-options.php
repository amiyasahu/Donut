<?php
    if ( !defined( 'QA_VERSION' ) ) { // don't allow this page to be requested directly from browser
        header( 'Location: ../../' );
        exit;
    }
    
    /**
     * This file will contain all the option names we are going to use in out theme
     */

    if ( !class_exists( 'Donut_Option_Keys' ) ) {
        class Donut_Option_Keys
        {
            const BS_CSS_CDN = '//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css';
            const FA_CDN = '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css';
            const BS_JS_CDN = '//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js';
            const OPEN_SANS_FONT_CDN = '//fonts.googleapis.com/css?family=Open+Sans:400,700,700italic,400italic';
        }
    }
