<?php $inatan= new Sd_api_key;

$api_key = $inatan->generateApiKey( get_option('APP-key-input'), get_option('APP-secret-key-input') );?>

<div class="outwrapper">
    <h1 class='display-5 fw-bold text-center'><?php _e('Add new Email','sdmaildoll');?></h1>

    <div class="text-center">
        <a href="<?php echo admin_url('admin.php?page=contacts&action=default') ?>" class='btn btn-primary listclass'><?php _e('Default','sdmaildoll');?></a>
        <a href="<?php echo admin_url('admin.php?page=contacts&action=new') ?>" class='btn btn-primary newclass'><?php _e('Add new','sdmaildoll');?></a>
        <!-- <a href="<?php echo admin_url('admin.php?page=contacts&action=edit') ?>" class='btn btn-warning'><?php _e('Edit','sdmaildoll');?></a>
        <a href="<?php echo admin_url('admin.php?page=contacts&action=delete') ?>" class='btn btn-danger'><?php _e('Delete','sdmaildoll');?></a>
        <a href="<?php echo admin_url('admin.php?page=contacts&action=view') ?>" class='btn btn-success'><?php _e('View','sdmaildoll');?></a> -->
    </div>

    <form action="" method="POST" id="adddataform">
    <table class="form-table">
        <tbody>
            <tr>
                <th>
                    <label for="name"><?php _e('Name','sdmaildoll');?></label>
                </th>
                <td>
                    <input type="text" name="name" id="name" class="regular-text" value="">
                </td>
            </tr>

            <tr>
                <th>
                    <label for="email"><?php _e('Email','sdmaildoll');?></label>
                </th>
                <td>
                    <input type="text" name="email" id="email" class="regular-text" value="">
                </td>
            </tr>

            <tr>
                <th>
                    <label for="phone"><?php _e('Phone','sdmaildoll');?></label>
                </th>
                <td>
                    <input type="number" name="phone" id="phone" class="regular-text" value="">
                </td>
            </tr>

        </tbody>

    </table>
    <?php wp_nonce_field('new-data');?>
    <?php submit_button(__('Add Info','sdmaildoll'), 'primary', 'submit_data');?>
    </form>

    <?php
// Declaring $wpdb as global and using it to execute an SQL query statement that returns a PHP object
// global $wpdb;
// $results = $wpdb->get_results( "SELECT * FROM wp_wc_customer_lookup", OBJECT ); 

// print_r ($results);

// foreach ($results as $result){
//     echo $result->email."<br>";
// }


// maildoll data
// $curl = curl_init();

// curl_setopt_array($curl, array(
//   CURLOPT_URL => 'http://localhost/maildoll/api/contacts',
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => '',
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 0,
//   CURLOPT_FOLLOWLOCATION => true,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => 'GET',
//   CURLOPT_HTTPHEADER => array(
//     'chirkut: a621e3a4b646b74a961007077e901c229168c29972242d3fe4b6220025464c43'
//   ),
// ));

// $response = curl_exec($curl);

// curl_close($curl);
// echo $response;
// $emailsonmaildoll = array();
// $jsonarray = json_decode($response);
// foreach($jsonarray as $akti){
//     // echo "<br>".$akti->email."<br>";
//     $emailsonmaildoll[] = $akti->email;
    
// }
// print_r($emailsonmaildoll);

// maildoll data ends



?>



    


</div>