<?php

class WPStatus_Server extends WPStatus {


    public function setup() {

        add_action('rest_api_init', [ $this, 'init_server_api' ]);

    }

    public function init_server_api(){

        $this->register_route( array(
            'route'=>'server',
            'method'=>WP_REST_Server::READABLE,
            'callback'=>'get_server_info',
        ));
        
    }

    public function get_server_info( WP_REST_Request $request ){


        $response = array(
            'SITE'=>get_site_url(),
//            'WP-ORG'=>$this->wp_org_info(),
            'PHP'=>PHP_VERSION,
            'MYSQL'=>$this->sql_info(),
            'WP'=>$this->wp_info()
        );

        return $this->rest_response($response);
    }

    protected function sql_info(){
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD);
        return $mysqli->server_info;
    }

    protected function wp_info(){
        global $wp_version;
        //https://codeseekah.com/2012/04/05/wordpress-org-apis/
        if ( ! function_exists( 'get_plugins' ) ) {
            require_once ABSPATH . 'wp-admin/includes/plugin.php';
        }

        $response = array(
            'version'=>$wp_version,
            'plugins'=>get_plugins(),
            'plugin_update'=>get_site_transient('update_plugins'),
            'info'=>wp_get_update_data()
        );
        return $response;
    }

    protected function wp_org_info(){
        $wp_org_response = wp_remote_get('http://api.wordpress.org/core/version-check/1.6/');
        $response = unserialize($wp_org_response['body']);
        $response = $response['offers'];
        return $response;
    }
}

$c = new WPStatus_Server();
$c->setup();
