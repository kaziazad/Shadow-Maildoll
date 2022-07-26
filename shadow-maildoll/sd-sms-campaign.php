<?php

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

class Sd_sms_campaign{

    public function campaign_handle(){

        $action = isset($_GET['action'])? $_GET['action']:'list';

        switch ($action) {
            case 'new_sms_cam':
                $template = __DIR__.'/sms-campaign/new-sms-campaign.php';
                break;
            case 'addphone':
                $template = __DIR__.'/sms-campaign/add-phone-to-campaign.php';
                break;
            case 'execute_sms_campaign':
                $template = __DIR__.'/sms-campaign/execute-sms-camp.php';
                break;
            case 'schedule_sms':
                $template = __DIR__.'/sms-campaign/schedule-sms-camp.php';
                break;
            case 'destroy_sms_shedule':
                $template = __DIR__.'/sms-campaign/destroy-sms-schedule.php';
                break;
            
            default:
                $template = __DIR__.'/sms-campaign/sms-campaign-list.php';
                break;
        }


        if(file_exists($template)){
            include $template;
        }
    }



}
