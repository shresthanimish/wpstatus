<?php
/**
 * Plugin Name: WPSTATUS API
 * Plugin URI:  http://www.wpstatus.com.au/
 * Description: Rest Api Extension
 * Version:     1.0.0
 * Author:      wpstatus
 * Author URI:  http://www.wpstatus.com.au/
 * Donate link: http://www.wpstatus.com.au/
 * License:     GPLv2
 * Text Domain: wpstatus-api
 * Domain Path: /languages
 */

// https://www.cloudways.com/blog/setup-and-use-oauth-authentication-using-wp-rest-api/

// http://wpstatus.local/oauth1/request?oauth_consumer_key=SMD3X4SrEiAb&oauth_signature_method=HMAC-SHA1&oauth_timestamp=1507886644&oauth_nonce=sFubXd&oauth_version=1.0&oauth_signature=PMKBhHW+6U0NWQC1FWfkuVr+4x8=

//Authorize
//http://wpstatus.local/oauth1/authorize?oauth_token=BsYmnzF0LIYL6lRxdixxTB38&oauth_token_secret=53NMJ9rQxbVeAeVeKX3muhgWQBsBnYRYz7gbpUYX2OC0ojIX

//Verification token = xh1JlSPC5eaSOYkzVwud1Hwq

//oauth_token=6e5K7Y73Tob80kIdEAESZFXr&oauth_token_secret=gdouwixgSO9gzeENwNmf3MWTDQffLksLiK6acUY06X0NHpm6
// If this file is called directly, abort.
//if ( ! defined( 'WPINC' ) ) exit;

//define('WPSTATUS_API_KEY','apikey123');

define( 'WPSTATUS_API_PLUGIN_URL', trailingslashit( plugins_url( '', __FILE__ ) ) );
define( 'WPSTATUS_API_PLUGIN_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );

if ( !class_exists('WPStatus_Api') ):

class WPStatus_Api extends WP_REST_Controller{
    /**
     * BASE API PATH: http://wpstatus.local/wp-json/$api_base/$api_base_version/
     */
    private $api_base = 'wpstatus';
    private $api_base_version = 'v1';

	public function setup() {

        add_action( 'rest_api_init', [ $this, 'init_routes' ], 1 );

	}

    function init_routes()
    {

        try {
            $this->load([
                'server',

            ], WPSTATUS_API_PLUGIN_PATH);
        }
        catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    function register_route($params)
    {
        $params = (object)$params; //Cast as object

        register_rest_route( $this->api_route(), $params->route, array(
            'methods'  => $params->method,
            'callback' => array(
                $this,
                $params->callback
            ),
        ) );
    }

    function rest_response($data){
        return rest_ensure_response( $data );
    }

    private function api_route(){
        return $this->api_base . '/' . $this->api_base_version;
    }

	/**
     * Return static singleton instance of class
     * @return static
     */
    public static function instance() {

        static $instance = null;

        if ( null === $instance ) {
            $instance = new static();
            $instance->setup();
        }

        return $instance;

    }

    /**
     * Loads several files in one go
     *
     * @param $includes
     * @param $path
     */
    public function load($includes, $path){
        foreach( $includes as $include )
            include($path . "includes/$include.php");
    }

}//End of class

function wpstatus_api_init() {
	return WPStatus_Api::instance();
}

// Kick it off
wpstatus_api_init();

endif;


?>
