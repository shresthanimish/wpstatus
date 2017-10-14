<?php
/**
 * Plugin Name: WPSTATUS_HUB API
 * Plugin URI:  http://www.wpstatus.com.au/
 * Description: Rest Api Extension
 * Version:     1.0
 * Author:      Nimish Shrestha
 * Author URI:  http://www.wpstatus.com.au/
 * Donate link: http://www.wpstatus.com.au/
 * License:     GPLv2
 * Text Domain: wpstatus
 * Domain Path: /languages
 */

// https://www.cloudways.com/blog/setup-and-use-oauth-authentication-using-wp-rest-api/

define( 'WPSTATUS_HUB_PLUGIN_URL', trailingslashit( plugins_url( '', __FILE__ ) ) );
define( 'WPSTATUS_HUB_PLUGIN_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );

if ( !class_exists('WPStatus_Hub') ):

class WPStatus_Hub extends APP_Base{


	public function setup() {

        add_action('init', [$this,'create_options_pages']);
        add_action( 'acf/settings/load_json', [ $this, 'load_json' ] );
//        try {
//            $this->load([
//                'admin/settings',
//                'server',
//
//            ], WPSTATUS_HUB_PLUGIN_PATH);
//        }
//        catch (Exception $e) {
//            echo 'Caught exception: ',  $e->getMessage(), "\n";
//        }

        
	}

    function create_options_pages(){

        $this->create_acf_options_page(
            'false', //redirect
            'wpstatus-hub-settings',
            'WPStatus Hub',
            'WPStatus Hub Settings'
        );

    }

    public function load_json( $paths ) {
        $paths[] = WPSTATUS_HUB_PLUGIN_PATH . '/acf-json';

        return $paths;
    }


}//End of class

function wpstatus_hub_init() {
	return WPStatus_Hub::instance();
}

// Kick it off
wpstatus_hub_init();

endif;


?>
