<?php//
// Admin page
?>
<div class="main wrap">
    <h1 class="wp-heading-inline">Add Location</h1>
    <a href="http://development.com/wp-admin/admin.php?page=location-services-manager" class="page-title-action">Locations Dashboard</a>
    <div class="form-status"></div>

    <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" id="add-locations" method="post" class="location_service_form" name='add_location_form' enctype="multipart/form-data">    
        <div class="form-group location-title">
            <label class="main-label" for="location-title">Location Title :</label>
            <input type="text" class="form-control" id="location-title" name="location-title">
            <div class="required">Required*</div>
        </div>

        
        <div class="form-group address">
            <label class="main-label" for="address">Address :</label>
            <textarea type="text" class="form-control" id="address" name="address"></textarea>
            <div class="required">Required*</div>
        </div>

        
        <div class="checkbox form-group services-group">
            <label class="main-label">Choose Services :</label><div class="required">Required*</div>
            <div class="services" id="services">
                <label><input type="checkbox" value="service_1"> Service 1</label>
                <label><input type="checkbox" value="service_2"> Service 2</label>
                <label><input type="checkbox" value="service_3"> Service 3</label>
                <label><input type="checkbox" value="service_4"> Service 4</label>
                <label><input type="checkbox" value="service_5"> Service 5</label>
                <label><input type="checkbox" value="service_6"> Service 6</label>
            </div>
        </div>

        
        <div class="form-group status">
            <label class="main-label" for="status">Status</label>
            <div class="checkbox-wrapper">
                <input type="checkbox" id="status" class="switch" /><label for="status"></label>
            </div>

        </div>

        <?php $new_loc_nonce = wp_create_nonce('new_location_nonce');  ?>
        <input type="hidden" name="new_loc_nonce" value="<?php echo $new_loc_nonce; ?>" />
        <div id="loader">
            <div></div>
        </div>
        <button type="submit" class="btn btn-default">Add Location</button>
    </form>
</div>