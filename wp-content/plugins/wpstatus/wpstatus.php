<?php
/**
 * Plugin Name: WPSTATUS API
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

define( 'WPSTATUS_PLUGIN_URL', trailingslashit( plugins_url( '', __FILE__ ) ) );
define( 'WPSTATUS_PLUGIN_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );

if ( !class_exists('WPStatus') ):

class WPStatus{
    /**
     * BASE API PATH: http://wpstatus.local/wp-json/$api_base/$api_base_version/
     */
    private $api_base = 'wpstatus';
    private $api_base_version = 'v1';

	public function setup() {

        try {
            $this->load([
                'admin/settings',
                'server',

            ], WPSTATUS_PLUGIN_PATH);
        }
        catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }

	}

    function init_routes()
    {


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

function wpstatus_init() {
	return WPStatus::instance();
}

// Kick it off
wpstatus_init();

endif;


?>
