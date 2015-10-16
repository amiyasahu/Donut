<?php
    if ( !defined( 'QA_VERSION' ) ) { // don't allow this page to be requested directly from browser
        header( 'Location: ../' );
        exit;
    }

    class donut_theme_install
    {
        const RESET_BTN = 'donut_admin_reset_btn';

        public function init_queries( $table_list )
        {

            $defauls_set = (int) qa_opt( 'donut_defaults_set_ok' );

            if ( !$defauls_set ) { //if default options are not set , set it up
                donut_reset_all_options();
                qa_opt( 'donut_defaults_set_ok', 1 );
            }

            $this->set_mandatory_options();

            return null;
        }

        private function donut_upgrade_tables( $current_db_version )
        {
            //currently we dont have anything to upgrade
            return false;
        }

        private function set_mandatory_options()
        {
            $current_opt_id = (int) qa_opt( 'donut_curr_db_version' );

            for ( $current_opt_id++ ; $current_opt_id <= DONUT_CURR_DB_VERSION ; $current_opt_id++ ) {
                $this->reset_options_for_id( $current_opt_id );
            }

            //set the current version to the databse
            qa_opt( 'donut_curr_db_version', DONUT_CURR_DB_VERSION );
        }

        private function reset_options_for_id( $id )
        {
            $reset_options = array();

            switch ( $id ) {
                case 1 :
                    //nothing to reset , already done with the ok module
                    break;
            }

            if ( count( $reset_options ) ) {
                donut_reset_options( $reset_options );
            }
        }

        public function admin_form( &$qa_content )
        {
            $saved = false;
            $error = false;

            if ( qa_clicked( self::RESET_BTN ) ) {
                if ( qa_check_form_security_code( 'donut/admin_options', qa_post_text( 'code' ) ) ) {
                    if ( donut_reset_all_options() ) {
                        $saved = true;
                        qa_opt( 'donut_defaults_set_ok', 1 );
                    }
                } else {
                    $error = qa_lang_html( 'admin/form_security_expired' );
                }
            }

            $form = array(
                'ok'      => $saved ? donut_lang( 'options_reset' ) : null,
                'fields'  => array(
                    'simple_note' => array(
                        'type'  => 'static',
                        'label' => donut_lang( 'admin_notes' ),
                        'error' => $error,
                    ),
                ),
                'buttons' => array(
                    array(
                        'label' => qa_lang_html( 'admin/reset_options_button' ),
                        'tags'  => 'NAME="' . self::RESET_BTN . '"',
                    ),
                ),
                'hidden'  => array(
                    'code' => qa_get_form_security_code( 'donut/admin_options' ),
                ),
            );

            return $form;
        }

    }


    /*
        Omit PHP closing tag to help avoid accidental output
    */
