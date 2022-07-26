<?php $inatan= new Sd_api_key;

$api_key = $inatan->generateApiKey( get_option('APP-key-input'), get_option('APP-secret-key-input') );?>

<div class="outwrapper">
<h1 class='display-5 fw-bold text-center'><?php _e('Email Campaign Table','sdmaildoll');?></h1>

<div class="text-center">
    <a href="<?php echo admin_url('admin.php?page=campaign&action=default') ?>" class='btn btn-primary listclass'><?php _e('Default','sdmaildoll');?></a>
    <!-- <a href="<?php echo admin_url('admin.php?page=campaign&action=new') ?>" class='btn btn-primary'><?php _e('Add Campaign','sdmaildoll');?></a> -->
    <a href="<?php echo admin_url('admin.php?page=campaign&action=addmail') ?>" class='btn btn-primary'><?php _e('Add email to campaign','sdmaildoll');?></a>
    <a href="<?php echo admin_url('admin.php?page=campaign&action=executecampaign') ?>" class='btn btn-primary'><?php _e('Execute a email campaign','sdmaildoll');?></a>
    <a href="<?php echo admin_url('admin.php?page=campaign&action=schedule') ?>" class='btn btn-primary'><?php _e('Schedule a campaign','sdmaildoll');?></a>
    <!-- <a href="<?php echo admin_url('admin.php?page=campaign&action=destroyshedule') ?>" class='btn btn-primary'><?php _e('Destroy a Schedule','sdmaildoll');?></a> -->

</div>

    <div class="form-group">
        <form action="" method="POST" id="addmailto">
            <table class="form-table">
                <tbody>
                    <tr>
                        <th>
                            <label for="campaignid"><?php _e('Campaign Id','sdmaildoll');?></label>
                        </th>
                        <td>
                            <select type="text" name="campaign_id" id="campaignid" class="regular-text" value="">
                            <div id="preloader"></div>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <th>
                            <label for="newemails"><?php _e('Name','sdmaildoll');?></label>
                        </th>
                        <td>
                            <input type="text" name="new_emails" id="newemails" class="regular-text" placeholder="" value="">
                        </td>
                    </tr>

                   
                </tbody>

            </table>
            <?php wp_nonce_field('new-data');?>
            <?php submit_button(__('Add Info','sdmaildoll'), 'primary', 'submit_data');?>
        </form>
    </div>

    <div id="postreport">

    </div>
    <div class="form-group">

    <form action="" method="POST">
        <button class="btn btn-primary" type=submit name="show_mails">Show Emails</button>
    </form>

    <form action="" method="POST">
        <label for="campaignid2"><?php _e('Campaign Id','sdmaildoll');?></label>
        <select type="text" name="campaign_id" id="campaignid2" class="regular-text" value="">
            <div id="preloader"></div>
        </select>

        <button type="submit" class="btn btn-primary" name="add_mails_to">Add emails to campaign</button>
    </form>


    <?php
    if(isset($_POST['show_mails'])){

    
        // Declaring $wpdb as global and using it to execute an SQL query statement that returns a PHP object
        global $wpdb;
        $results = $wpdb->get_results( "SELECT * FROM wp_wc_customer_lookup", OBJECT ); 

        $emailstoadd=" ";

        foreach ($results as $result){
                echo $result->email."<br>";
                $emailstoadd = $emailstoadd.$result->email.',';
        }


    

    }

    if(isset($_POST['add_mails_to'])){

    
        // Declaring $wpdb as global and using it to execute an SQL query statement that returns a PHP object
        global $wpdb;
        $results = $wpdb->get_results( "SELECT * FROM wp_wc_customer_lookup", OBJECT ); 
       
        $emailstoadd=NULL;
        $totalemails = count($results);
        
        $i=0;

        foreach ($results as $result){
            if(++$i === $totalemails){
                $emailstoadd = $emailstoadd.$result->email;
            }else
                $emailstoadd = $emailstoadd.$result->email.',';
        }

        $campaign_id = $_POST['campaign_id'];

        // 'http://localhost/maildoll/api/add-emails-to-campaign?emails=%5B\'huto@footo.com@coms.com,kototo@foto.com\'%5D&campaign_id=3'

       
     
        $customurl = "http://localhost/maildoll/api/add-emails-to-campaign?emails=['". $emailstoadd ."']&campaign_id=".$campaign_id;
       
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => $customurl,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => null,
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_HTTPHEADER => array(
                    'chirkut:'.$api_key
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;

    }


   
    ?>
   
   

  
    </div>

    
</div>
