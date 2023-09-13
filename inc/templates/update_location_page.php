<?php
// Location actions page
global $wpdb;

if ( isset($_GET['loc_id']) ) {
    $locations_table = $wpdb->prefix . 'locations_table';
    $query = "SELECT * FROM $locations_table WHERE `id` = " . $_GET['loc_id'];
    $location = $wpdb->get_results($query)[0];
} else {
    $location = [];
}

?>
<div class="main wrap">
    <h1 class="wp-heading-inline">Update (<?= $location->title ?>)</h1>
    <a href="http://development.com/wp-admin/admin.php?page=location-services-manager" class="page-title-action">Locations Dashboard</a>
    <div class="form-status"></div>

    <form id="update-location" class="location_service_form" data-id="<?= $_GET['loc_id'] ?>">    
        <div class="form-group location-title">
            <label class="main-label" for="location-title">Location Title :</label>
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
                <?php
                    $jsonString = '{"data": ' . $location->services . '}';
                    $services = json_decode($jsonString, true);
                    $servicesArr = $services['data'];
                ?>
                <label><input type="checkbox" value="service_1" <?= in_array('service_1', $servicesArr) ? 'checked' : '' ?> >Service 1</label>
                <label><input type="checkbox" value="service_2" <?= in_array('service_2', $servicesArr) ? 'checked' : '' ?> >Service 2</label>
                <label><input type="checkbox" value="service_3" <?= in_array('service_3', $servicesArr) ? 'checked' : '' ?> >Service 3</label>
                <label><input type="checkbox" value="service_4" <?= in_array('service_4', $servicesArr) ? 'checked' : '' ?> >Service 4</label>
                <label><input type="checkbox" value="service_5" <?= in_array('service_5', $servicesArr) ? 'checked' : '' ?> >Service 5</label>
                <label><input type="checkbox" value="service_6" <?= in_array('service_6', $servicesArr) ? 'checked' : '' ?> >Service 6</label>
            </div>
        </div>

        
        <div class="form-group status">
            <label class="main-label" for="status">Status</label>
            <div class="checkbox-wrapper">
                <input type="checkbox" id="status" class="switch" <?= ($location->status == '1' ) ? 'checked' : ''; ?>/><label for="status"></label>
            </div>

        </div>

        <div id="loader">
            <div></div>
        </div>
        <button type="submit" class="btn btn-default">Update location</button>
    </form>
</div>