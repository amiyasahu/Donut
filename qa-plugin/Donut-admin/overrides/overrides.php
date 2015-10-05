<?php

    if ( !defined( 'QA_VERSION' ) ) { // don't allow this page to be requested directly from browser
        exit;
    }

    /**
     * adds few more routes for the default routing
     *
     * @return mixed
     */
    function qa_page_routing()
    {
        $pages = qa_page_routing_base();

        // add your additional pages here for loading the blogs
        $new_pages = donut_admin_page_routing();

        return $pages + $new_pages;
    }


    /**
     * adds few more navigation links for admin panel
     *
     * @return mixed
     */
    function qa_admin_sub_navigation()
    {

        $navigation = qa_admin_sub_navigation_base();
        $donut_navigation = donut_admin_sub_navigation();

        return $navigation + $donut_navigation;

    }

    /**
     * adds blog admin pages to the request handlers
     *
     * @return mixed
     */
    function qa_get_request_content()
    {

        $requestlower = strtolower( qa_request() );
        $requestparts = qa_request_parts();
        $firstlower = strtolower( @$requestparts[0] );
        $secondlower = strtolower( @$requestparts[1] );
        $routing = qa_page_routing();

        $route_part = '';

        if ( !empty( $firstlower ) && !empty( $secondlower ) ) {
            $route_part = $firstlower . '/' . $secondlower . '/';
        }

        if ( !isset( $routing[$requestlower] ) && $route_part === 'admin/donut-theme/' ) {
            //for loading the default setting file
            qa_set_template( $firstlower );
            $qa_content = require QA_INCLUDE_DIR . $routing[$route_part];

            if ( $firstlower == 'admin' ) {
                $_COOKIE['qa_admin_last'] = $requestlower; // for navigation tab now...
                setcookie( 'qa_admin_last', $_COOKIE['qa_admin_last'], 0, '/', QA_COOKIE_DOMAIN ); // ...and in future
            }

        } else {
            //otherwise load the original qa_get_request_content function
            $qa_content = qa_get_request_content_base();
        }

        return $qa_content;
    }
