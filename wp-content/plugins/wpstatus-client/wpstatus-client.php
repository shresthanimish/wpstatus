<?php
/**
 * Plugin Name: WPSTATUS CLIENT
 * Plugin URI:  http://www.wpstatus.com.au/
 * Description: Rest Api Extension
 * Version:     1.0.0
 * Author:      wpstatus
 * Author URI:  http://www.wpstatus.com.au/
 * Donate link: http://www.wpstatus.com.au/
 * License:     GPLv2
 * Text Domain: wpstatus-client
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) exit;

define( 'WPSTATUS_CLIENT_PLUGIN_URL', trailingslashit( plugins_url( '', __FILE__ ) ) );
define( 'WPSTATUS_CLIENT_PLUGIN_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );

if ( !class_exists('WPStatus_Client') ):

    class WPStatus_Client{

        function __construct(){
            require (__DIR__.'/vendor/oauth.php');
        }

    }//End of class

    function wpstatus_client_init_init() {
        return new WPStatus_Client();
    }

// Kick it off
    wpstatus_client_init_init();

endif;

add_shortcode( 'test_api_connection', 'my_test_api_connection' );
function my_test_api_connection() {

    $url = 'http://wpstatus.local/wp-json/wpstatus/v1/server';
//    $url = 'http://wpstatus.local/wp-json/myapiplugin/v2/greeting';

    //Verification EB2NdL70jqWsNqUwey3c2sJc

    $method = 'GET';
    $keys = array(
        'oauth_consumer_key'    => 'SMD3X4SrEiAb',
        'oauth_consumer_secret' => 'JxwRTqCmMepyY13bvWaItKz0mCw5MSq2OZh9OQ25JDNb3SO4',
        'oauth_token'           => '6e5K7Y73Tob80kIdEAESZFXr',
        'oauth_token_secret'    => 'gdouwixgSO9gzeENwNmf3MWTDQffLksLiK6acUY06X0NHpm6',
    );

//    die('inside');
    $oauth = new OAuth_Authorization_Header( $keys, $url, $method );

    $header = $oauth->get_header();

    $args = array( 'headers' => array( 'Authorization' => $header ) );

    $response = wp_remote_get( $url, $args );

    $api_response = json_decode( wp_remote_retrieve_body( $response ), true );

    return '<pre>' . print_r( $api_response, true ) . '</pre>';

}

?>
