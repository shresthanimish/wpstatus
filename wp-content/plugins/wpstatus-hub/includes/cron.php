<?php

if ( !class_exists('WPStatus_Hub_Cron') ):

    class WPStatus_Hub_Cron extends APP_Base{

        protected $shell_exec = false;
        protected $cron_log_file = '~/projects/wpstatus.local/wp-content/uploads/cron.log';
        protected $cron_path = '~/projects/wpstatus.local/wp-content/uploads/cron.log';

        public function setup() {




            //Check if shell exec is available
            $this->shell_exec = ($this->is_shell_exec_available())?true:false;

            add_filter( 'cron_schedules', [$this,'register_additional_schedules'] );
            add_filter('acf/load_field/name=wps_schedule_frequency', [$this,'populate_schedule_frequency']);

            add_filter('acf/load_field', [$this,'handle_admin_field_info']);
            add_action( 'admin_enqueue_scripts', [$this,'admin_script']);
            add_action( 'wp_ajax_add_cronjob', [$this,'add_cron_job'] );
            
            if(!$this->shell_exec){
                add_filter('acf/load_field', [$this,'enable_read_only']);
                add_action( 'current_screen', [$this, 'admin_no_shell_exec_notice'] );
            }

            if($this->shell_exec) {

                try {
                    $this->load([
//                        'vendor/autoload',
                        'vendor/class.crontab'
                    ], WPSTATUS_HUB_PLUGIN_PATH);
                } catch (Exception $e) {
                    echo 'Caught exception: ', $e->getMessage(), "\n";
                }


//
//                $this->add_cron_job('* * * * * ~/projects/wpstatus.local/wp-content/uploads mkdir test > '.$this->cron_log_file);
//                $this->add_cron_job('* * * * * ~/projects/wpstatus.local/wp-content/uploads mkdir hello > '.$this->cron_log_file);

//                $this->remove_cron_job('* * * * * ~/projects/wpstatus.local/wp-content/uploads mkdir test > '.$this->cron_log_file);
//                $this->remove_cron_job('* * * * * ~/projects/wpstatus.local/wp-content/uploads mkdir hello > '.$this->cron_log_file);

//                $this->remove_cron_job();

            }
        }

        function admin_script(){
            wp_enqueue_script( 'wpstatus_script', WPSTATUS_HUB_PLUGIN_URL. '/includes/js/cron.js' ,  array('jquery'));
        }

        function add_cron_job($command=false){

            if(isset($_POST['wps_schedule_submit']) && $_POST['wps_schedule_submit']){

                //If triggerred through ajax
                $data = $_POST['wps_schedule'];

                $path = get_field('wps_schedule_path','option');

                //Add Cron
                $cron = new Crontab();
                $line = $data['minute'].' '.
                        $data['hour'].' '.
                        $data['date'].' '.
                        $data['day'].' '.
                        $data['month'].' '.
                        $path.$data['command'].' '.
                        '#CRON_NAME';

                $cron->addJob($line);

                //Reply to AJAX call
                echo json_encode($line);

                wp_die(); //do not run further

            }


            if(!$command)
                return;

            $cron = new Crontab();
            $cron->addJob($command);

        }

        function remove_cron_job($command=false){

            if(!$command)
                return;

            $cron = new Crontab();
            $cron->removeJob($command);
//            $cron->addJob('');

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

        function handle_admin_field_info($field){

            $label = $field['label'];
            
            if($field['label'] === 'Cron Job Schedules'){

                $field['instructions'] = $this->requireToVar(WPSTATUS_HUB_PLUGIN_PATH.'/includes/template/message/cron-job-schedules.php');

            }

            if($field['label'] === 'Register Schedule'){

                $field['instructions'] = $this->requireToVar(WPSTATUS_HUB_PLUGIN_PATH.'/includes/template/register-schedule.php');

            }
            
            return $field;



        }

        function enable_read_only($field){

            $test = $field;

            $fields_to_disable = array(
                'wps_email',
                'wps_schedule_frequency',
                'wps_schedule_time',
                'wps_schedule_time_second',
                'wps_schedule_time_minute',
                'wps_schedule_time_hour',
                'wps_schedule_time_day',
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
                    'template/message/notice-no-shell-exec'
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

        function get_registered_wp_cron(){
            return get_option( 'cron' );
        }
        
        function get_registered_crontabs(){

            $jobs_list = shell_exec('crontab -l');
            $jobs = explode(PHP_EOL, $jobs_list);

            if(count($jobs) < 1)
                return "No cronjobs found for current PHP user.";

            $response = '';
            foreach($jobs as $job){

                if(trim($job) == '' )
                    continue;

                $response.="
                            <div class='acf-tab-group'>
                                <h4 class=''>
                                    $job
                                </h4>
                                <div>
                                    <p>Information to be displayed here</p>
                                </div>
                                <br/>
                            </div>
                            ";
            }



            return $response;
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

        function requireToVar($file){
            ob_start();
            require($file);
            return ob_get_clean();
        }

        function sayHi(){
            return "Helloworld";
        }
    }//End of class

    WPStatus_Hub_Cron::instance();

endif;


?>
