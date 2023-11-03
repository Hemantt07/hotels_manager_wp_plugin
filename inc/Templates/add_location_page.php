<?php
/**
 * @package Custom Elementor Widget
 *
 * Locations Dashboard
 */
global $wpdb;
$services_table = $wpdb->prefix . 'services_table';
$query = "SELECT * FROM $services_table";
$services = $wpdb->get_results($query);
?>
<div class="main wrap">
    <h1 class="wp-heading-inline">Add Location</h1>
    <a href="<?= admin_url('admin.php?page=location-services-manager') ?>" class="page-title-action">Locations Dashboard</a>
    <div class="form-status"></div>

    <form id="add-locations" class="location_service_form" >    
        <div class="left">
            <div class="form-group location-title">
                <label class="main-label" for="location-title">Location Title :</label>
                <input type="text" class="form-control" id="location-title" name="location-title" placeholder="Add Location title">
                <div class="required">Required*</div>
            </div>

            <div class="form-group address">
                <label class="main-label" for="address">Address :</label>
                <textarea type="text" class="form-control" id="address" name="address" placeholder="Add Location address"></textarea>
                <div class="required">Required*</div>
            </div>

            <div class="checkbox form-group services-group">
                <label class="main-label">Choose Services :</label><div class="required">Required*</div>
                <div class="services" id="services">
                    <?php foreach ($services as $key => $service):?>
                        <label><input type="checkbox" value="<?=$service->service_data?>"><?=$service->service_data?></label>
                    <?php endforeach ?>
                </div>
            </div>

            <div class="form-group status">
                <label class="main-label" for="status">Status</label>
                <div class="checkbox-wrapper">
                    <input type="checkbox" id="status" class="switch"/><label for="status"></label>
                </div>
            </div>
            <button type="submit" class="btn btn-default">Add location</button>
        </div>
        
        <div class="right">
            <div class="imageWrap">
                <img src="<?= ELEMENTOR_WIDGET_PLUGIN_URL . 'assets/images/default.webp' ?>" alt="location_image">
                <input type="file" name="location_image" id="location_image"  accept='.jpeg, .gif, .png, .apng, .svg, .bmp, .bmp, .png , .webp'>
                <label for="location_image" class="upload-picture btn-default">Upload Image</label>    
            </div>
        </div>
        <div id="loader"><div></div></div>
    </form>
</div>