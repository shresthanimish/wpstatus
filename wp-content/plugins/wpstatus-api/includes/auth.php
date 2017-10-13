<?php

class WPStatus_Api_Auth extends WPStatus_Api {

    protected $registered_keys = array(
        'test123',
        'wpstatus123'
    );

    public function setup() {
        //
    }

    function is_registered_key($key){

        if( key_exists($key,$this->registered_keys) )
            return true;

        return false;

    }

    function get_registered_keys(){

        return $this->registered_keys;

    }


}

$c = new WPStatus_Api_Auth();
$c->setup();
