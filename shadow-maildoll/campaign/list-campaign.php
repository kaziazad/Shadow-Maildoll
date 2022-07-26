<?php $inatan= new Sd_api_key;

$api_key = $inatan->generateApiKey( get_option('APP-key-input'), get_option('APP-secret-key-input') );?>

<div class="outwrapper">
<h1 class='display-5 fw-bold text-center'><?php _e('Email Campaign Table','sdmaildoll');?></h1>

<div class="text-center">
    <a href="<?php echo admin_url('admin.php?page=campaign&action=default') ?>" class='btn btn-primary'><?php _e('Default','sdmaildoll');?></a>
    <!-- <a href="<?php echo admin_url('admin.php?page=campaign&action=new') ?>" class='btn btn-primary'><?php _e('Add Campaign','sdmaildoll');?></a> -->
    <a href="<?php echo admin_url('admin.php?page=campaign&action=addmail') ?>" class='btn btn-primary'><?php _e('Add email to campaign','sdmaildoll');?></a>
    <a href="<?php echo admin_url('admin.php?page=campaign&action=executecampaign') ?>" class='btn btn-primary'><?php _e('Execute a email campaign','sdmaildoll');?></a>
    <a href="<?php echo admin_url('admin.php?page=campaign&action=schedule') ?>" class='btn btn-primary'><?php _e('Schedule a campaign','sdmaildoll');?></a>
    <!-- <a href="<?php echo admin_url('admin.php?page=campaign&action=destroyshedule') ?>" class='btn btn-primary'><?php _e('Destroy a Schedule','sdmaildoll');?></a> -->

</div>

<table class='table table-striped data-table text-left' id="campaigntable">
    <tr>
        <th>ID</th>
        <th>Type</th>
        <th>Campaign Name</th>
        <th>Mail/SMS Provider</th>
        <th>Template</th>
        <th>Status</th>
        <th>Craeted</th>
        <th>Action</th>
    </tr>


    <tbody id="campaign-table">
    
    </tbody>
   

    

</table>
<div id="preloader">

</div>


<div class="aitime"></div>

</div>