<?php

    /**
     * Returns the language value as defined in lang/donut-lang-*.php
     *
     * @param      $identifier
     * @param null $subs
     *
     * @return mixed|string
     */
    function donut_lang( $identifier, $subs = null )
    {
        if ( !is_array( $subs ) )
            return empty( $subs ) ? qa_lang( 'donut/' . $identifier ) : qa_lang_sub( 'donut/' . $identifier, $subs );
        else
            return strtr( qa_lang( 'donut/' . $identifier ), $subs );
    }

    function donut_lang_html( $identifier, $subs = null )
    {
        return qa_html( donut_lang( $identifier, $subs ) );
    }

    /**
     * Returns the language value as defined in lang/donut-options-lang-*.php
     *
     * @param      $indentifier
     * @param null $subs
     *
     * @return mixed|string
     */
    function donut_options_lang( $indentifier, $subs = null )
    {
        if ( !is_array( $subs ) )
            return empty( $subs ) ? qa_lang( 'donut_options/' . $indentifier ) : qa_lang_sub( 'donut_options/' . $indentifier, $subs );
        else
            return strtr( qa_lang( 'donut_options/' . $indentifier ), $subs );
    }

    function donut_options_lang_html( $identifier, $subs = null )
    {
        return qa_html( donut_options_lang( $identifier, $subs ) );
    }

    function donut_admin_plugin_folder( $absolute = false )
    {
        $path = basename( QA_PLUGIN_DIR ) . DIRECTORY_SEPARATOR . DONUT_ADMIN_PLUGIN_FOLDER;

        return $absolute ? ( QA_BASE_DIR . $path ) : $path;
    }

    /*
        Omit PHP closing tag to help avoid accidental output
    */