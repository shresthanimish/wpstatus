<?php

class WPStatus_Settings extends WPStatus{

    public function __construct() {
        // Hook into the admin menu
        add_action( 'admin_menu', array( $this, 'create_plugin_settings_page' ) );

        // Add Settings and Fields
        add_action( 'admin_init', array( $this, 'setup_sections' ) );
        add_action( 'admin_init', array( $this, 'setup_fields' ) );

        add_action( 'admin_enqueue_scripts', function(){
            wp_enqueue_script( 'wpstatus_script', plugin_dir_url(__FILE__). '/js/script.js' ,  array('jquery'));
        } );

        add_action( 'wp_ajax_generate_password', [$this,'generate_password'] );

    }

    public function create_plugin_settings_page() {
        // Add the menu item and page
        $page_title = 'WPStatus Settings Page';
        $menu_title = 'WPStatus';
        $capability = 'manage_options';
        $slug = 'wpstatus';
        $callback = array( $this, 'plugin_settings_page_content' );
        $icon = 'dashicons-admin-plugins';
        $position = 100;

        add_menu_page( $page_title, $menu_title, $capability, $slug, $callback, $icon, $position );
    }

    public function plugin_settings_page_content() {

        //Load template
        $this->load(array(
           'admin/template/_settings'
        ),WPSTATUS_PLUGIN_PATH);

    }

    public function admin_notice() { ?>
            <div class="notice notice-success is-dismissible">
                <p>Your settings have been updated!</p>
            </div><?php
    }

    public function setup_sections() {
        add_settings_section( 'basic_authentication', 'Basic Authentication', array( $this, 'section_callback' ), 'wpstatus_fields' );
//        add_settings_section( 'our_second_section', 'My Second Section Title', array( $this, 'section_callback' ), 'wpstatus_fields' );
//        add_settings_section( 'our_third_section', 'My Third Section Title', array( $this, 'section_callback' ), 'wpstatus_fields' );
    }

    public function section_callback( $arguments ) {
        switch( $arguments['id'] ){
            case 'basic_authentication':
                echo 'Setup your basic authentication credentials here. This will be used by WPStatus Hub to access the API.';
                break;
            case 'our_second_section':
                echo 'This one is number two';
                break;
            case 'our_third_section':
                echo 'Third time is the charm!';
                break;
        }
    }

    public function setup_fields() {
        $fields = array(
            array(
                'uid' => 'wpstatus_username',
                'label' => 'Username',
                'section' => 'basic_authentication',
                'type' => 'text',
                'placeholder' => 'Username',
                'helper' => '',
                'supplimental' => '',
            ),
            array(
                'uid' => 'wpstatus_password',
                'label' => 'Password',
                'section' => 'basic_authentication',
                'type' => 'text',
                'placeholder' => 'Password',
                'helper' => '',
                'supplimental' => '',
//                'default' => wp_generate_password( 16, false ),
                'password_generator'=>true
            ),
//            array(
//                'uid' => 'awesome_number_field',
//                'label' => 'Sample Number Field',
//                'section' => 'basic_authentication',
//                'type' => 'number',
//            ),
//            array(
//                'uid' => 'awesome_textarea',
//                'label' => 'Sample Text Area',
//                'section' => 'basic_authentication',
//                'type' => 'textarea',
//            ),
        );
        foreach( $fields as $field ){

            add_settings_field( $field['uid'], $field['label'], array( $this, 'field_callback' ), 'wpstatus_fields', $field['section'], $field );
            register_setting( 'wpstatus_fields', $field['uid'] );
        }
    }

    public function field_callback( $arguments ) {

        $value = get_option( $arguments['uid'] );

        isset($arguments['placeholder'])?:$arguments['placeholder']="";
        isset($arguments['helper'])?:$arguments['helper']="";
        isset($arguments['supplimental'])?:$arguments['supplimental']="";

        if( ! $value ) {
            $value = isset($arguments['default'])?$arguments['default']:'';
        }

        switch( $arguments['type'] ){
            case 'text':
            case 'password':
            case 'number':
                printf( '<input name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" />', $arguments['uid'], $arguments['type'], $arguments['placeholder'], $value );
                break;
            case 'textarea':
                printf( '<textarea name="%1$s" id="%1$s" placeholder="%2$s" rows="5" cols="50">%3$s</textarea>', $arguments['uid'], $arguments['placeholder'], $value );

                break;

        }

        if(isset($arguments['password_generator']) && $arguments['password_generator']){
            print('<div id="wpstatus_password_generator" class="button" value="Generate" data-cmp="passwordGenerator" data-target="'.$arguments['uid'].'">Generate</button>');
        }

        if( $helper = $arguments['helper'] ){
            printf( '<span class="helper"> %s</span>', $helper );
        }

        if( $supplimental = $arguments['supplimental'] ){
            printf( '<p class="description">%s</p>', $supplimental );
        }

    }



    function generate_password() {
        // Handle request then generate response using WP_Ajax_Response

        // Don't forget to stop execution afterward.
        echo wp_generate_password(16,true,true);

        wp_die();
    }

}
new WPStatus_Settings();