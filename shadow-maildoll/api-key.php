<?php

if ( ! defined( 'ABSPATH' ) ) {
	return;
}


class Sd_api_key{


	public function generateApiKey($arg, $arg1)
        {
        
        $apikeyall = hash_hmac('sha256',$arg.date('Y'),$arg1); 

        // return $apikeyall;
        // algorithm, data . year, key

        $sd_api_param = array(
                'API_key' => $apikeyall
              );
        
        wp_localize_script( 'custom-script', 'scriptParams', $sd_api_param );
              return $apikeyall;
        }

      
      
      

      
     
    
}