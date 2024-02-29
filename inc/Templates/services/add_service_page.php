<?php
// Add Location page
?>
<div class="main wrap">
    <h1 class="wp-heading-inline">Add Service</h1>
    <a href="<?= admin_url('admin.php?page=services-manager') ?>" class="page-title-action">Services Dashboard</a>
    <div class="form-status"></div>

    <form id="add-services" class="location_service_form" >    
        <div style="width: 100%">
            <div class="form-group service-title">
                <label class="main-label" for="service-title">Service Title :</label>
                <input type="text" class="form-control" id="service-title" name="service-title" placeholder="Add service title">
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
                <ul id="facilities-list"></ul>
            </div>

            <div class="form-group status">
                <label class="main-label" for="status">Status</label>
                <div class="checkbox-wrapper">
                    <input type="checkbox" id="status" class="switch"/><label for="status"></label>
                </div>
            </div>
            <button type="submit" class="button button-primary">Add location</button>
        </div>

        <div id="loader"><div></div></div>
    </form>
</div>