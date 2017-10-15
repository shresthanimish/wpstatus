<?php

if ( !class_exists('WPStatus_Hub_Cron') ):

    class WPStatus_Hub_Cron extends APP_Base{

        protected $shell_exec = false;

        public function setup() {

//            $this->shell_exec = ($this->is_shell_exec_available())?true:false;

            add_filter( 'cron_schedules', [$this,'register_additional_schedules'] );
            add_filter('acf/load_field/name=wps_schedule_frequency', [$this,'populate_schedule_frequency']);

            if(!$this->shell_exec){
                add_filter('acf/load_field', [$this,'enable_read_only']);
                add_action( 'current_screen', [$this, 'admin_no_shell_exec_notice'] );
            }
            
        }

        function populate_schedule_frequency($field){

            // reset choices
            $field['choices'] = array();

            $schedules = $this->get_registered_schedules(false);

            foreach($schedules as $key => $schedule){

                $field['choices'][ $key ] = $schedule['display'];

            }

            return $field;

        }

        function enable_read_only($field){

            $fields_to_disable = array(
                'wps_email',
                'wps_schedule_frequency',
                'wps_schedule_time'
            );

            if(in_array($field['name'],$fields_to_disable)){
                $field['disabled'] = 1;
            }

            return $field;

        }


        function admin_no_shell_exec_notice(){

            $currentScreen = get_current_screen();
            if(strpos($currentScreen->id,'wpstatus-hub-settings')){

                $this->load(array(
                    'template/notice-no-shell-exec'
                ),WPSTATUS_HUB_PLUGIN_PATH);

            }

        }
        
        function register_additional_schedules($schedules){

            $schedules['monthly'] = array(
                'interval' => 2635200,
                'display' => __('Once a month')
            );

            $schedules['weekly'] = array(
                'interval' => 604800,
                'display' => __('Once Weekly')
            );

            return $schedules;

        }

        function get_registered_crons(){
            return get_option( 'cron' );
        }

        function get_registered_schedules( $all=false ){

            $schedules = array();

            foreach(wp_get_schedules() as $key=>$schedule){

                if( ($schedule['interval'] < 1) && !$all )
                    continue;

                $schedules[$key] = $schedule;

            }

            return $schedules;
        }

        function is_shell_exec_available() {
            $func = 'shell_exec';
            return is_callable($func) && false === stripos(ini_get('disable_functions'), $func);
        }

    }//End of class

    WPStatus_Hub_Cron::instance();

endif;


?>
