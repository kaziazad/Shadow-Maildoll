<?php $inatan= new Sd_api_key;

$api_key = $inatan->generateApiKey( get_option('APP-key-input'), get_option('APP-secret-key-input') );

?>
<div class="outwrapper">
   
    <div class="text-center menu-div" data-scheletrone="true">
        <h1 class='display-5 fw-bold text-center'><?php _e('Data Table','sdmaildoll');?></h1>
        <a href="<?php echo admin_url('admin.php?page=contacts&action=default') ?>" class='btn btn-primary list active'><?php _e('Default','sdmaildoll');?></a>
        <a href="<?php echo admin_url('admin.php?page=contacts&action=new') ?>" class='btn btn-primary newclass'><?php _e('Add new','sdmaildoll');?></a>
        <!-- <a href="<?php echo admin_url('admin.php?page=contacts&action=edit') ?>" class='btn btn-warning'><?php _e('Edit','sdmaildoll');?></a>
        <a href="<?php echo admin_url('admin.php?page=contacts&action=delete') ?>" class='btn btn-danger'><?php _e('Delete','sdmaildoll');?></a>
        <a href="<?php echo admin_url('admin.php?page=contacts&action=view') ?>" class='btn btn-success'><?php _e('View','sdmaildoll');?></a> -->
    </div>




<table class='table table-striped data-table text-left' id="tabledata">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
    </tr>
   
    <tbody id="data-table">
    
    </tbody>
   

    

</table>
<div id="preloader">

</div>

<!-- <div id="pagination" class="text-center">
<a href="" class="active" id="1">1</a>
<a href="" id="2">2</a>
<a href="" id="3">3</a>
</div> -->


</div>

