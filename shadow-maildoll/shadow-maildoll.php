<?php


/**
 * Plugin Name:       Shadow of maildoll
 * Plugin URI:        https://kazimahmud.com/shadowmaildoll
 * Description:       Bring out some useful information from database.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Azad
 * Author URI:        https://kazimahmud.com
 * Text Domain:       sdmaildoll
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Update URI:        https://kazimahmud.com/shadowmaildoll/
 */



if ( ! defined( 'ABSPATH' ) ) {
	return;

}

// include files 

require_once dirname(__FILE__).'/get-information.php';
require_once dirname(__FILE__).'/sd-campaign.php';
require_once dirname(__FILE__).'/sd-sms-campaign.php';
require_once dirname(__FILE__).'/api-key.php';


// the main plugin class

final class Shadowmaildoll{

  // plugins version

  const version = '1.0.0';

  // class constructor

  private function __construct(){

    add_action('admin_init', array($this, 'sd_maildoll_settings'));
    add_action('admin_menu', array($this,'admin_menu_page'));
    // add_action('rest_api_init', array($this, 'productsJson'));
    add_action('init', array($this,'custom_style_scripts'));
    $this->define_constant();
    register_activation_hook(__FILE__,[$this,'activate']);
  

  }


  function custom_style_scripts(){
    wp_enqueue_style('bootetrap-style', SD_MAILDOLL_ASSETS.'/css/bootstrap.min.css');
    wp_enqueue_style('skeleton-style', SD_MAILDOLL_ASSETS.'/css/skeleton.css');
    wp_enqueue_style('custom-style', SD_MAILDOLL_ASSETS.'/css/style.css');

    // wp_enqueue_script('matrrial-ui', 'https://cdn.tailwindcss.com',array(),'', false);
    wp_enqueue_script('jquery-script', 'https://code.jquery.com/jquery-3.6.0.min.js',array(),'', true);

    wp_enqueue_script('bootstrap-script', SD_MAILDOLL_ASSETS.'/scripts/bootstrap.min.js',array('jquery-script'),'', true);

    wp_enqueue_script('skeleton-script', SD_MAILDOLL_ASSETS.'/scripts/skeleton.js',array('bootstrap-script'),'', true);

    wp_enqueue_script('materialui-script',' https://unpkg.com/@mui/material@latest/umd/material-ui.development.js',array('skeleton-script'),'', true);

    wp_enqueue_script('custom-script', SD_MAILDOLL_ASSETS.'/scripts/custom.js',array('materialui-script'),'', true);



  }

function sd_maildoll_settings(){
  
  // heading section
  add_settings_section('maildoll_settings_menu', 'Genarate API Key', 'maildoll_admin_settings','sd_maildoll_options');

  function maildoll_admin_settings() {
    echo '<p></p>';
  }

  // APP key 
  register_setting('add_settings_sec','APP-key-input');

  add_settings_field('APP-key-input','Insert your APP key',array($this,'app_key_input'),'sd_maildoll_options','maildoll_settings_menu');
  

  // APP secret key 
  register_setting('add_settings_sec','APP-secret-key-input');

  add_settings_field('APP-secret-key-input','Insert your APP secret key',array($this,'app_secret_key_input'),'sd_maildoll_options','maildoll_settings_menu');

}



function app_key_input(){
  echo '<input type="text" name="APP-key-input" class="regular-text" value="'.get_option('APP-key-input').'" />';
  echo '<p class="description" id="tagline-description">Find it in maildoll profile.</p>';
}
function app_secret_key_input(){
  echo '<input type="text" name="APP-secret-key-input" class="regular-text" value="'.get_option('APP-secret-key-input').'" />';
  echo '<p class="description" id="tagline-description">Find it in maildoll profile.</p>';
}




function admin_menu_page() {
  add_menu_page('Shadow maildoll','Shadow Maildoll Settings','manage_options','sd_maildoll_options',array($this,'api_options_format'));
 
  // add_submenu_page( string $parent_slug, string $page_title, string $menu_title, string $capability, string $menu_slug, callable $callback = '', int|float $position = null )
  add_submenu_page( 'sd_maildoll_options', 'Contacts', 'Contacts', 'manage_options', 'contacts', array($this,'sd_sub_menu') );

  // add_submenu_page( string $parent_slug, string $page_title, string $menu_title, string $capability, string $menu_slug, callable $callback = '', int|float $position = null )
  add_submenu_page( 'sd_maildoll_options', 'Email Campaign', 'Email Campaign', 'manage_options', 'campaign', array($this,'sd_campaign') );
  add_submenu_page( 'sd_maildoll_options', 'SMS Campaign', 'SMS Campaign', 'manage_options', 'sms_campaign', array($this,'sd_sms_campaign') );
}



function api_options_format() { ?>
  <div class="mainpagewrapper">
    <div class="menu-div">
      <h1 class="main-heading"> <?php _e('Shadow Maildoll', 'sdmaildoll'); ?></h1>
    </div>
      <form class="formclass" action="options.php" method="POST">
        <?php do_settings_sections('sd_maildoll_options'); ?>
        <?php settings_fields('add_settings_sec'); ?>
        <?php
      
      $appkey = get_option('APP-key-input');
      $appsecretkey = get_option('APP-secret-key-input');?>
        <?php
        $api_key_gene = new Sd_api_key;
        $apikey=$api_key_gene->generateApiKey($appkey,$appsecretkey);
       
        ?>

        <strong><?php echo "Use this API KEY: ".$apikey;?></strong>
        
        
        <input type="hidden" id="auth_token" name="api_key" value="<?php echo $apikey; ?>">
       
        <?php submit_button(); ?>
       
      </form>
    
   
  <div>
  
  <div> 

    


  </div>
  

<?php }




function sd_sub_menu(){

 
    $getinfomationpage = new Get_infomation;
    $getinfomationpage->get_page();

}


function sd_campaign(){
  $sdcampaign = new Sd_campaign;
  $sdcampaign->campaign_handle();

 
}

function sd_sms_campaign(){
  $sdsmscampaign = new Sd_sms_campaign;
  $sdsmscampaign->campaign_handle();

 
}



  // initializes a singletoninstance
  // return type: \Shadowmaildoll
public static function init(){
  static $instance = false;

  if(!$instance){
    $instance = new self();
  
  
  }

  return $instance;
}

public function define_constant(){
  define('SD_MAILDOLL_VERSION', self::version);
  define('SD_MAILDOLL_FILE',__FILE__);
  define('SD_MAILDOLL_PATH',__DIR__);
  define('SD_MAILDOLL_URL', plugins_url('',SD_MAILDOLL_FILE));
  define('SD_MAILDOLL_ASSETS', SD_MAILDOLL_URL.'/assets');

}

// when plugin installed and whice version 

public function activate(){
  // check whether it installed or not
  $installed = get_option('sd_maildoll_installed');

  // if not installed
  if(!$installed){
    update_option('sd_maildoll_installed', time());
  }
  
  update_option('sd_maildoll_version', SD_MAILDOLL_VERSION);
}

}

/*
 initialize the main plugins
 return \Shadowmaildoll
*/
function ini_shadowmaildoll(){
  return Shadowmaildoll::init();
}

// initialize function call

ini_shadowmaildoll();


if(file_exists('Get_infomation')){
  $getinfomation = new Get_infomation;
  $getinfomation->get_menu_options();
  
}



?>

