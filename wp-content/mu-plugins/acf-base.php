<?php
/*
Plugin Name: WPStatus - Base
Plugin URI: http://www.wpstatus.com.au/
Description: Base Class for WPStatus Plugins
Version: 1.0
Author: WPStatus
Author URI: http://www.wpstatus.com.au/
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) exit;

if ( !class_exists('APP_Base') )
    require __DIR__.'/app-base.php';

if ( !class_exists('ACF_Base') ):

    /**
     * Class ACF_Base
     */
    class ACF_Base extends APP_Base
    {


        public function __construct() {
            add_filter( 'acf/settings/save_json', [ $this, 'save_json' ], 1000, 2 );
        }

        /**
         * Changes the json save path if an existing field group exists
         *
         */
        function save_json( $path ) {

            $key = "";

            //  work out key if we are saving field group
            if ( isset( $_POST['acf_field_group']['key'] ) ) {
                $key = $_POST['acf_field_group']['key'];
            }

            //  work out key if we are syncing field group
            if ( isset( $_GET['acfsync'] ) ) {
                $key = $_GET['acfsync'];
            }

            //  replace path if required
            if ( ! empty( $key ) ) {

                //  merge the main website theme path and our filtered load paths
                $paths = array_merge(
                    array(get_stylesheet_directory() . '/acf-json'),
                    apply_filters( 'acf/settings/load_json', array() )
                );

                foreach ( $paths as $load_path ) {

                    //  loop over each load path for json files
                    foreach ( glob( $load_path . "/*.json" ) as $filename ) {

                        $field_group = json_decode( file_get_contents( $filename ), true );

                        //  if the key matches a group in this plugin then return the path
                        if ( is_array( $field_group ) && $field_group['key'] == $key ) {
                            return $load_path;
                        }
                    }

                }

            }

            // return
            return $path;

        }

    }
    new ACF_Base();

endif;