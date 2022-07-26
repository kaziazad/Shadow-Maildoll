<?php

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

class Sd_campaign{

    public function campaign_handle(){

        $action = isset($_GET['action'])? $_GET['action']:'list';

        switch ($action) {
            case 'new':
                $template = __DIR__.'/campaign/new-campaign.php';
                break;
            case 'addmail':
                $template = __DIR__.'/campaign/addmail.php';
                break;
            case 'executecampaign':
                $template = __DIR__.'/campaign/execute-campaign.php';
                break;
            case 'schedule':
                $template = __DIR__.'/campaign/schedule.php';
                break;
                case 'destroyshedule':
            $template = __DIR__.'/campaign/destroyschedule.php';
                break;
            default:
                $template = __DIR__.'/campaign/list-campaign.php';
                break;
        }


        if(file_exists($template)){
            include $template;
        }
    }



}

// if(file_exists('Sd_campaign')){
//     $sdcampaign = new Sd_campaign;
//     $sdcampaign->campaign_handle();

// }
