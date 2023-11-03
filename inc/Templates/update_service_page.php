<?php
// Service actions page
global $wpdb;

if ( isset($_GET['service_id']) ) {
    $services_table = $wpdb->prefix . 'services_table';
    $query = "SELECT * FROM $services_table WHERE `id` = " . $_GET['service_id'];
    $service = $wpdb->get_results($query)[0];
} else {
    $service = [];
}
?>
<div class="main wrap">
    <h1 class="wp-heading-inline">Edit Service (<?= $service->service_data ?>)</h1>
    <a href="<?= admin_url('admin.php?page=services-manager') ?>" class="page-title-action">Services Dashboard</a>
    <div class="form-status"></div>
    <form id="update-service" class="location_service_form" data-id="<?= $service->id ?>">    
        <div style="width: 100%">
            <div class="form-group service-title">
                <label class="main-label" for="service-title">Service Title :</label>
                <input type="text" class="form-control" id="service-title" value="<?=$service->service_data?>" name="service-title" placeholder="Add service title">
                <div class="required">Required*</div>
            </div>

            <div class="d-flex">
                <div class="form-group facilities-group">
                    <label class="main-label">Add Facilties :</label><div class="required">Required*</div>
                    <input type="text" class="form-control" id="facility-title" name="facility-title" placeholder="Add Facility">
                    <div class="required">Required*</div>
                </div>
                <button class="btn btn-default mt-0" id="add-faciltiy" type="button">Add Facility</button>
            </div>

            <div class="form-group">
                <ul id="facilities-list">
                    <?php 
                        $facilities = explode(",", $service->facilities);
                        foreach ($facilities as $key => $facility) {
                            echo '<li class="facility">'.$facility.'<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAABJUlEQVR4nO3YT0sCQRyH8YeuUu0KG/RHUG8efAceetFBJ6noEKUI6iG1wHolxcIYg6wi67Qzs3w/IHga92F09zeCiIiIiMg/6QEPwKXDNRvAHXBLhYbADzAHLhysdwo8W2ueUJEMmJoPfj9yZ/KdeDRrfQNdKpYCY3MBC+DKQUQHT46JsSO+fEYUxSwPjMkjnkKKsGNGVsw1u50BLyFGFMWsdsQEH7GR7Ik534poE7hkK+YmxoiNJjAxF/4BvJr3n0CLyCTAmwnIX+uYdqJ2Ic06fLWSgjtXdD/2dM/tN5pnSHrA0z3Y0aTMvBVsTFpiAg5mfHc9xnuNyaxT4qLkKbFhzv7eTocZMHN41PUWM6zLnw99E+Miwo65BwYO1xQRERER4c8v6Th7MMbV15kAAAAASUVORK5CYII="></li>';
                        } 
                    ?>
                </ul>
            </div>

            <div class="form-group status">
                <label class="main-label" for="status">Status</label>
                <div class="checkbox-wrapper">
                    <input type="checkbox" id="status" class="switch"  <?= ($service->status == '1' ) ? 'checked' : ''; ?>/><label for="status"></label>
                </div>
            </div>
            <button type="submit" class="btn btn-default">Update location</button>
        </div>

        <div id="loader"><div></div></div>
    </form>
</div>