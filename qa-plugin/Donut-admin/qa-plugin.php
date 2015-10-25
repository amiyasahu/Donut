<?php
    /*
        Plugin Name: Donut theme Admin Panel
        Plugin URI: https://github.com/amiyasahu/Donut/
        Plugin Description: Provides customization support for Donut theme
        Plugin Version: 1.6.3
        Plugin Date: 2015-10-25
        Plugin Author: Amiya Sahu
        Plugin Author URI: http://www.amiyasahu.com/
        Plugin License: GPLv2
        Plugin Minimum Question2Answer Version: 1.6
        Plugin Update Check URI: https://github.com/amiyasahu/Donut/blob/master/qa-plugin/Donut-admin/metadata.json
    */

    if ( !defined( 'QA_VERSION' ) ) { // don't allow this page to be requested directly from browser
        exit;
    }

    //Define global constants
    @define( 'DONUT_ADMIN_PLUGIN_DIR', dirname( __FILE__ ) );
    @define( 'DONUT_ADMIN_PLUGIN_FOLDER', basename( dirname( __FILE__ ) ) );

    @define( 'DONUT_CURR_DB_VERSION', 1 ); //Helps in updating new mandatory options

    require_once DONUT_ADMIN_PLUGIN_DIR . '/functions.php';
    require_once DONUT_ADMIN_PLUGIN_DIR . '/admin/options.php';
    require_once DONUT_ADMIN_PLUGIN_DIR . '/admin/admin-routing.php';

    //register override module
    qa_register_plugin_overrides( 'overrides/overrides.php' );

    qa_register_plugin_phrases( 'lang/donut-lang-*.php', 'donut' );
    qa_register_plugin_phrases( 'lang/donut-options-lang-*.php', 'donut_options' );

    qa_register_plugin_module( 'event', 'install/install.php', 'donut_theme_install', 'Donut theme Installation Module' );

    /*
        Omit PHP closing tag to help avoid accidental output
    */
