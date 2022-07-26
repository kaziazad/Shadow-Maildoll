<?php

class Admin{

    function __construct(){
        $this->dispatch_actions();
    }


    public function dispatch_actions(){
        $get_infomation = new Get_infomation;
        add_action('admin_init', [$get_infomation, 'form_handler']);
    }
}