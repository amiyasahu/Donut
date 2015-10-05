<?php
    /**
     * Returns additional routing elements
     *
     * @return array
     */
    function donut_admin_page_routing()
    {

        $plugin_folder = '..' . DIRECTORY_SEPARATOR . donut_admin_plugin_folder();
        $donut_admin_default = 'admin/donut-theme/';
        $donut_theme_settings = 'admin/donut-theme/general-settings';

        $new_pages = array(
            $donut_admin_default  => $plugin_folder . '/admin/admin-panel.php',
            $donut_theme_settings => $plugin_folder . '/admin/admin-panel.php',
        );

        return $new_pages;
    }


    /**
     * Adds few more links in the admin subnavigation
     *
     * @return array
     */
    function donut_admin_sub_navigation()
    {
        $navigation = array();
        $level = qa_get_logged_in_level();

        if ( $level >= QA_USER_LEVEL_ADMIN ) {

            $url = 'admin/donut-theme/general-settings';

            $navigation[$url] = array(
                'label' => donut_lang( 'donut_theme_settings' ),
                'url'   => qa_path_html( $url ),
            );

        }

        return $navigation;
    }