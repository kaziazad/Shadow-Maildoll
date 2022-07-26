<?php

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

class Get_infomation{

   
    public function get_page(){

        $action = isset($_GET['action'])? $_GET['action']:'list';

        switch ($action) {
            case 'new':
                $template = __DIR__.'/view/new-info.php';
                break;
            case 'edit':
                $template = __DIR__.'/view/edit-info.php';
                break;
            case 'view':
                $template = __DIR__.'/view/view-info.php';
                break;
            case 'delete':
                $template = __DIR__.'/view/delete-info.php';
                break;
            default:
                $template = __DIR__.'/view/list-info.php';
                break;
        }

        if(file_exists($template)){
            include $template;
        }
       

    }

    // handle form validity 

    public function form_handler(){
        if(!isset($_POST['submit_data'])){
            return;
        }

        if(!wp_verify_nonce($_POST['_wpnonce'], 'new-data')){
            wp_die('Are you cheating?');
        }

        if(!current_user_can('manage_options')){
            wp_die('Are you cheating?');
        }

        var_dump($_POST);
        exit;
    }







}

// if(file_exists('Get_infomation')){
//     $getinfomation = new Get_infomation;
// }

