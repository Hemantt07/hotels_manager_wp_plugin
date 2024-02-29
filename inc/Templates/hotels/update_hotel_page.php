<?php
// Location actions page
global $wpdb;

if ( isset($_GET['loc_id']) ) {
    $hotels_table = $wpdb->prefix . 'hotels_table';
    $query = "SELECT * FROM $hotels_table WHERE `id` = " . $_GET['loc_id'];
    $location = $wpdb->get_results($query)[0];
} else {
    $location = [];
}
$img_url = $location->image_url ?? ELEMENTOR_WIDGET_PLUGIN_URL . 'assets/images/default.jpg';
$services_table = $wpdb->prefix . 'services_table';
$query = "SELECT * FROM $services_table";
$services = $wpdb->get_results($query);
?>
<div class="main wrap">
    <h1 class="wp-heading-inline">Update (<?= $location->title ?>)</h1>
    <a href="http://development.com/wp-admin/admin.php?page=our-hotels-manager" class="page-title-action">Hotels Dashboard</a>
    <div class="form-status"></div>

    <form id="update-location" class="location_service_form" data-id="<?= $_GET['loc_id'] ?>">
        <div class="left">
            <div class="form-group location-title">
                <label class="main-label" for="location-title">Hotel Title :</label>
                <input type="text" class="form-control" id="location-title" name="location-title" value="<?= $location->title ?>">
                <div class="required">Required*</div>
            </div>
            
            <div class="form-group address">
                <label class="main-label" for="address">Address :</label>
                <textarea type="text" class="form-control" id="address" name="address" ><?= $location->address ?></textarea>
                <div class="required">Required*</div>
            </div>

            <div class="checkbox form-group services-group">
                <label class="main-label">Choose Services :</label><div class="required">Required*</div>
                <div class="services" id="services">
                    <?php   $selectedServices = explode(',',$location->services); 
                            foreach ($services as $key => $service):?>
                                <label><input type="checkbox" <?= in_array($service->service_data, $selectedServices) ? 'checked' : ''; ?> value="<?=$service->service_data?>"><?=$service->service_data?></label>
                    <?php   endforeach ?>
                </div>
            </div>
            
            <div class="form-group status">
                <label class="main-label" for="status">Status</label>
                <div class="checkbox-wrapper">
                    <input type="checkbox" id="status" class="switch" <?= ($location->status == '1' ) ? 'checked' : ''; ?>/><label for="status"></label>
                </div>
            </div>
            <button type="submit" class="button button-primary">Update location</button>
        </div>
        <div class="right">
            <div class="imageWrap">
                <img src="<?= $img_url ?>" alt="location_image">
                <input type="hidden" name="location_image"  id="location_image" value="<?= $img_url ?>">
                <button type="button" class="upload-picture page-title-action">Upload Image</button>    
            </div>
        </div>

        <div id="loader"><div></div></div>
    </form>
</div>