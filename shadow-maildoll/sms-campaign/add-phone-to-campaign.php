<?php $inatan= new Sd_api_key;

$api_key = $inatan->generateApiKey( get_option('APP-key-input'), get_option('APP-secret-key-input') );?>

<div class="outwrapper">
<h1 class='display-5 fw-bold text-center'><?php _e('SMS Campaign Table','sdmaildoll');?></h1>

<div class="text-center">
    <a href="<?php echo admin_url('admin.php?page=sms_campaign&action=default') ?>" class='btn btn-primary'><?php _e('Default','sdmaildoll');?></a>
    <a href="<?php echo admin_url('admin.php?page=sms_campaign&action=new_sms_cam') ?>" class='btn btn-primary'><?php _e('Add Campaign','sdmaildoll');?></a>
    <a href="<?php echo admin_url('admin.php?page=sms_campaign&action=addphone') ?>" class='btn btn-primary'><?php _e('Add phone to campaign','sdmaildoll');?></a>
    <a href="<?php echo admin_url('admin.php?page=sms_campaign&action=execute_sms_campaign') ?>" class='btn btn-primary'><?php _e('Execute a sms campaign','sdmaildoll');?></a>
    <a href="<?php echo admin_url('admin.php?page=sms_campaign&action=schedule_sms') ?>" class='btn btn-primary'><?php _e('Schedule a sms campaign','sdmaildoll');?></a>
    <!-- <a href="<?php echo admin_url('admin.php?page=sms_campaign&action=destroy_sms_shedule') ?>" class='btn btn-primary'><?php _e('Destroy a sms Schedule','sdmaildoll');?></a> -->

</div>
<h1>phone</h1>
<div class="form-group">
        <form action="" method="POST" id="addphoneto">
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
                            <label for="newphoneno"><?php _e('New Phone Number','sdmaildoll');?></label>
                        </th>
                        <td>
                            <input type="text" name="new_phone_no" id="newphoneno" class="regular-text" placeholder="" value="">
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="countrycode"><?php _e('Country Code','sdmaildoll');?></label>
                        </th>
                        <td>
                            <input type="text" name="country_code" id="countrycode" class="regular-text" placeholder="" value="">
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

</div>