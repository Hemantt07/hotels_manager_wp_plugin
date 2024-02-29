<?php
/**
 * @package Hotel Manager
 *
 * Locations Dashboard
 */
global $wpdb;
$services_table = $wpdb->prefix . 'services_table';
$query = "SELECT * FROM $services_table";
$services = $wpdb->get_results($query);
?>
<div class="main wrap">
    <h1 class="wp-heading-inline">Add Hotel</h1>
    <a href="<?= admin_url('admin.php?page=our-hotels-manager') ?>" class="page-title-action">Hotels Dashboard</a>
    <div class="form-status"></div>

    <form id="add-locations" class="location_service_form" >    
        <div class="left">
            <div class="form-group location-title">
                <label class="main-label" for="location-title">Hotel Title :</label>
                <input type="text" class="form-control" id="location-title" name="location-title" placeholder="Add Hotel's title">
                <div class="required">Required*</div>
            </div>

            <div class="form-group address">
                <label class="main-label" for="address">Address :</label>
                <textarea type="text" class="form-control" id="address" name="address" placeholder="Add Hotel's address"></textarea>
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
            <button type="submit" class="button button-primary">Add location</button>
        </div>
        
        <div class="right">
            <div class="imageWrap">
                <img src="<?= ELEMENTOR_WIDGET_PLUGIN_URL . 'assets/images/default.jpg' ?>" alt="location_image">
                <input type="hidden" name="location_image"  id="location_image" value="<?= ELEMENTOR_WIDGET_PLUGIN_URL . 'assets/images/default.jpg' ?>">
                <button type="button" class="upload-picture page-title-action">Upload Image</button>    
            </div>
        </div>
        <div id="loader"><div></div></div>
    </form>
</div>