<?php
/**
 * @package Custom Elementor Widget
 *
 * Location Dashboard
 */
global $wpdb;

$locations_table = $wpdb->prefix . 'locations_table';
$query = "SELECT * FROM $locations_table";
$results = $wpdb->get_results($query);

?>
<div class="main wrap">
    <h1 class="wp-heading-inline">Locations Manager</h1>
    <a href = <?= admin_url('admin.php?page=location-services-manager&loc_type=new') ?> class="page-title-action">Add New Location</a>
    <table id="locations-dashboard" class="wp-list-table widefat fixed striped table-view-list locations">
        <thead>
            <tr role="row">
                <th class="manage-column column-cb check-column">
                    <input id="cb-select-all-1" type="checkbox">
                </th>
                <th>Sr No.</th>
                <th>Location name</th>
                <th>Address</th>
                <th>Services</th>
                <th>Shortcode</th>
                <th>Status</th>
                <th>Edit Location</th>
            </tr>
        </thead>
        <tbody id="the-list">
            <?php  if ($results) : ?>
                <?php foreach ($results as $key => $result) : ?>
                    <tr role="row" class="">
                            <td class=" check-column">
                                <input id="cb-select-1" type="checkbox" name="post[]" value="<?= $result->id ?>">
                            </td>
                            <td class="dt-body-center"><?= $result->id ?></td>
                            <td class="dt-body-center"><?= $result->title ?></td>
                            <td class="dt-body-center"><?= $result->address ?></td>
                            <td class="dt-body-center">
                                <?php
                                    $jsonString = '{"data": ' . $result->services . '}';
                                    $services = json_decode($jsonString, true);
                                    $servicesArr = $services['data'];
                                    for( $i = 0 ; $i < count($servicesArr) ; $i++ ) {
                                        echo $servicesArr[$i].', ';
                                    } 
                                ?>
                            </td>
                            <td class="dt-body-center">
                                <strong><code class="shortcode"><?= '[loc_single_'.$result->id.']' ?></code></strong>
                            </td>
                            <td class="dt-body-center <?= ($result->status == '1') ? ('active') : ('inactive')?>">
                                <?= ($result->status == '1') ? ('Active') : ('Inactive') ?>
                            </td>
                            <td class="dt-body-center">
                                <a href="<?= admin_url('admin.php?page=location-services-manager&loc_type=edit&id='.$result->id) ?>" class="page-title-action ad-new-ad">Edit</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
            <?php else : ?>
                <tr role="row" class="no-data">
                    <div>Add new locations</div>
                    <a href = <?= admin_url('admin.php?page=location-services-manager&loc_type=new') ?>>Add New Location</a>
                </tr>
            <?php endif; ?>
        </tbody>
        <tfoot>
            <tr role="row">
                <th class="manage-column column-cb check-column">
                    <input id="cb-select-all-1" type="checkbox">
                </th>
                <th>Sr No.</th>
                <th>Location name</th>
                <th>Location</th>
                <th>Services</th>
                <th>Shortcode</th>
                <th>Status</th>
                <th>Edit Location</th>
            </tr>
        </tfoot>
    </table>
</div>