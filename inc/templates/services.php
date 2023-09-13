<?php
/**
 * @package Custom Elementor Widget
 *
 * Services Dashboard
 */
global $wpdb;

$services_table = $wpdb->prefix . 'services_table';

$query = "SELECT * FROM $services_table";

$results = $wpdb->get_results($query);

?>
<div class="main wrap">
    <h1 class="wp-heading-inline">Services Manager</h1>
    <a href=<?= admin_url('admin.php?page=services-manager&service_type=new') ?> class="page-title-action">Add New Service</a>
    <table id="services-dashboard" class="wp-list-table widefat fixed striped table-view-list locations-services-table">
        <thead>
            <tr role="row">
                <th class="manage-column column-cb check-column">
                    <input id="cb-select-all-1" type="checkbox">
                </th>
                <th class="title">Service name</th>
                <th class="address">Address</th>
                <th class="services">Services</th>
                <th class="shortcode">Shortcode</th>
                <th class="status">Status</th>
                <th class="edit-action">Edit Service</th>
            </tr>
        </thead>
        <tbody id="the-list">
            <?php  if ($results) : ?>
                    <tr role="row" class="">
                        <td class=" check-column">
                            <input id="cb-select-1" type="checkbox" name="post[]" value="1">
                        </td>
                        <td class=" dt-body-center"></td>
                        <td class=" dt-body-center"></td>
                        <td class=" dt-body-center"></td>
                        <td class=" dt-body-center""></td>
                        <td class=" dt-body-center">
                            <a href="<?php admin_url() ?>" class="page-title-action ad-new-ad">Edit</a>
                        </td>
                    </tr>
            <?php else : ?>
                <tr role="row" class="no-data">
                    <td colspan="7">
                        <span>There are no Services registered</span>
                        <a href = <?= admin_url('admin.php?page=services-manager&service_type=new') ?>>Add New Service</a>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
        <tfoot>
            <tr role="row">
                <th class="manage-column column-cb check-column">
                    <input id="cb-select-all-1" type="checkbox">
                </th>
                <th>Sr No.</th>
                <th>Service name</th>
                <th>Service</th>
                <th>Services</th>
                <th>Status</th>
                <th>Edit Service</th>
            </tr>
        </tfoot>
    </table>
</div>