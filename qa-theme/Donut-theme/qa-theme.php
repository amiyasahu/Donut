<?php
    if ( !defined( 'QA_VERSION' ) ) { // don't allow this page to be requested directly from browser
        header( 'Location: ../../' );
        exit;
    }

    /**
     * Defines the base directory of the theme
     */
    @define( 'DONUT_THEME_BASE_DIR', dirname( __FILE__ ) );

    /**
     * define the directory name of the theme directory
     */
    @define( 'DONUT_THEME_BASE_DIR_NAME', basename( DONUT_THEME_BASE_DIR ) );

    /**
     * Defines the base directory of the theme
     */
    @define( 'DONUT_THEME_TEMPLATE_DIR', DONUT_THEME_BASE_DIR . '/templates/' );

    /**
     * define the version of the theme that is installed
     */
    @define( 'DONUT_THEME_VERSION', "1.6.2" );

    /**
     * include the required files for the theme
     */
    require_once DONUT_THEME_BASE_DIR . '/utils/qa-donut-utils.php';
    require_once DONUT_THEME_BASE_DIR . '/utils/donut-options.php';
    require_once DONUT_THEME_BASE_DIR . '/qa-donut-layer.php';

    /**
     * Declaring global variables for caching the userdata
     */
    $donut_userid_and_levels = array();
