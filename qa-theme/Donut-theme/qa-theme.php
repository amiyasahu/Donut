<?php
    if ( !defined( 'QA_VERSION' ) ) { // don't allow this page to be requested directly from browser
        header( 'Location: ../../' );
        exit;
    }

    /**
     * Define the base directory of the theme
     */
    @define( 'DONUT_THEME_BASE_DIR', dirname( __FILE__ ) );

    /**
     * Define the directory name of the theme directory
     */
    @define( 'DONUT_THEME_BASE_DIR_NAME', basename( DONUT_THEME_BASE_DIR ) );

    /**
     * Define the base directory of the theme
     */
    @define( 'DONUT_THEME_TEMPLATE_DIR', DONUT_THEME_BASE_DIR . '/templates/' );

    /**
     * Define the version of the theme that is installed
     */
    @define( 'DONUT_THEME_VERSION', "2.1.1" );

    /**
     * Include the required files for the theme
     */
    require_once DONUT_THEME_BASE_DIR . '/utils/qa-donut-utils.php';
    require_once DONUT_THEME_BASE_DIR . '/utils/donut-options.php';
    require_once DONUT_THEME_BASE_DIR . '/qa-donut-layer.php';
