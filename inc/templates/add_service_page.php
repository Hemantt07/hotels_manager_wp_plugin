<?php//
// Admin page
?>
<div class="main wrap">
    <h1 class="wp-heading-inline">Add Service</h1>
    <a href="http://development.com/wp-admin/admin.php?page=services-manager" class="page-title-action">Services Dashboard</a>
    <form action="" id="add-services" class="location_service_form">

        <div class="form-group location-title">
            <label class="main-label" for="location-title">Service Title :</label>
            <input type="text" class="form-control" id="location-title" name="location-title">
        </div>
        
        <div class="form-group address">
            <label class="main-label" for="address">Address :</label>
            <input type="text" class="form-control" id="address" name="address">
        </div>

        <div class="checkbox form-group services-group">
            <label class="main-label">Choose Services :</label>
            <div class="services">
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

        <button type="submit" class="btn btn-default">Add Service</button>
    </form>
</div>