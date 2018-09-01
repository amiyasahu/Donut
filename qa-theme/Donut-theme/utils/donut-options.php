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
            const THEME_VERSION = 'donut_theme_ver';
            const INSTALLED_THEME_VERSION = 'donut_theme_ver_instaled';
            const CDN_ENABLED = 'donut_cdn_active';
            const BS_CSS_CDN = '//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css';
            const BS_THEME_CSS_CDN = '//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css';
            const FA_CDN = '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css';
            const BS_JS_CDN = '//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js';
        }
    }
