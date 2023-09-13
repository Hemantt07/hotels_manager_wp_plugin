<?php
/**
 * @package Custom Elementor Widget
 *
 * Location Dashboard
 */
global $wpdb;

$locations_table = $wpdb->prefix . 'locations_table';
$query = "SELECT * FROM $locations_table";
$locations = $wpdb->get_results($query);

?>
<div class="main wrap">
    <h1 class="wp-heading-inline">Locations Manager</h1>
    <a href = <?= admin_url('admin.php?page=location-services-manager&loc_type=new') ?> class="page-title-action">Add New Location</a>
    <div class="form-status"></div>
    <table id="locations-dashboard" class="wp-list-table widefat fixed striped table-view-list locations-services-table">
        <thead>
            <tr role="row">
                <th class="manage-column column-cb check-column">
                    <input id="cb-select-all-1" type="checkbox">
                </th>
                <th class="title">Location name</th>
                <th class="address">Address</th>
                <th class="services">Services</th>
                <th class="shortcode">Shortcode</th>
                <th class="status">Status</th>
                <th class="image">Image</th>
            </tr>
        </thead>
        <tbody id="the-list">
            <?php  if ($locations) : ?>
                <?php foreach ($locations as $key => $location) : ?>
                    <tr role="row" id="<?= $location->id ?>">
                            <td class="check-column">
                                <input id="cb-select-1" type="checkbox" name="post[]" value="<?= $location->id ?>">
                            </td>
                            <td class="dt-body-center title">
                                <a href="<?= admin_url('admin.php?page=location-services-manager&loc_type=edit&loc_id='.$location->id) ?>"
                                    class="row-title">
                                    <b><?= $location->title ?></b>
                                </a>
                                <div class="row-actions">
                                    <span class="edit">
                                        <a href="<?= admin_url('admin.php?page=location-services-manager&loc_type=edit&loc_id='.$location->id) ?>">
                                            Edit
                                        </a>
                                    </span> | 
                                    <span class="trash">
                                        <a href="" class="submitdelete" data-id="<?= $location->id ?>">
                                            Trash
                                        </a>
                                    </span>
                                </div>
                            </td>
                            <td class="dt-body-center address"><?= $location->address ?></td>
                            <td class="dt-body-center services">
                                <?php
                                    $jsonString = '{"data": ' . $location->services . '}';
                                    $services = json_decode($jsonString, true);
                                    $servicesArr = $services['data'];
                                    for( $i = 0 ; $i < count($servicesArr) ; $i++ ) {
                                        echo $servicesArr[$i].', ';
                                    } 
                                ?>
                            </td>
                            <td class="dt-body-center shortcode">
                                <strong><code class="shortcode"><?= '[loc_single_'.$location->id.']' ?></code></strong>
                            </td>
                            <td class="dt-body-center status <?= ($location->status == '1') ? ('active') : ('inactive')?>">
                                <?= ($location->status == '1') ? ('Active') : ('Inactive') ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
            <?php else : ?>
                <tr role="row" class="no-data">
                    <td colspan="7">
                        <span>There are no Locations registered</span>
                        <a href = <?= admin_url('admin.php?page=location-services-manager&loc_type=new') ?>>Add New Location</a>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
        <tfoot>
            <tr role="row">
                <th class="manage-column column-cb check-column">
                    <input id="cb-select-all-1" type="checkbox">
                </th>
                <th class="title">Location name</th>
                <th class="address">Address</th>
                <th class="services">Services</th>
                <th class="shortcode">Shortcode</th>
                <th class="status">Status</th>
                <th class="shortcode">Image</th>
            </tr>
        </tfoot>
    </table>
    <div id="loader"><div></div></div>
</div>