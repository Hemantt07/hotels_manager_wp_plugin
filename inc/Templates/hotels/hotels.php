<?php
/**
 * @package Hotel Manager
 *
 * Location Dashboard
 */
global $wpdb;

$hotels_table = $wpdb->prefix . 'hotels_table';
$query = "SELECT * FROM $hotels_table";
$locations = $wpdb->get_results($query);


?>
<div class="main wrap">
    <h1 class="wp-heading-inline">Hotels List</h1>
    <a href = <?= admin_url('admin.php?page=our-hotels-manager&req_type=new') ?> class="page-title-action">
        Add New Hotel
    </a>
    <div class="form-status"></div>
    <p>Use shortcode <code class="shortcode">[hotels]</code> to display all the hotels</p>
    <table id="locations-dashboard" class="wp-list-table widefat fixed striped table-view-list locations-services-table">
        <thead>
            <tr role="row">
                <th class="manage-column column-cb check-column">
                    <input id="cb-select-all-1" type="checkbox">
                </th>
                <th class="image">Image</th>
                <th class="title">Hotel name</th>
                <th class="address">Address</th>
                <th class="services">Services</th>
                <th class="shortcode">Shortcode</th>
                <th class="status">Status</th>
            </tr>
        </thead>
        <tbody id="the-list">
            <?php  if ($locations) : ?>
                <?php foreach ($locations as $key => $location) : 
                        $img_url = $location->image_url ?? ELEMENTOR_WIDGET_PLUGIN_URL . 'assets/images/default.jpg';
                ?>
                    <tr role="row" id="<?= $location->id ?>">
                            <td class="check-column">
                                <input class="cb-select-1" type="checkbox" name="post[]" value="<?= $location->id ?>">
                            </td>

                            <td class="dt-body-center image">
                                <img src="<?= $img_url ?>" alt="location_image">
                            </td>

                            <td class="dt-body-center title">
                                <a href="<?= admin_url('admin.php?page=our-hotels-manager&req_type=edit&loc_id='.$location->id) ?>"
                                    class="row-title">
                                    <b><?= $location->title ?></b>
                                </a>
                                <div class="row-actions">
                                    <span class="edit">
                                        <a href="<?= admin_url('admin.php?page=our-hotels-manager&req_type=edit&loc_id='.$location->id) ?>">
                                            Edit
                                        </a>
                                    </span> | 
                                    <span class="trash">
                                        <a href="" class="submitdelete" data-id="<?= $location->id ?>" data-type="location">
                                            Trash
                                        </a>
                                    </span>
                                </div>
                            </td>

                            <td class="dt-body-center address"><?= $location->address ?></td>

                            <td class="dt-body-center services">
                                <?php 
                                    $services = explode(',',$location->services); 
                                    foreach ($services as $key => $facility) {
                                        echo $key !== count($services) - 1 ? $facility . ', ' : $facility;
                                    }    
                                ?>
                            </td>

                            <td class="dt-body-center shortcode">
                                <strong>
                                    <code class="shortcode"><?= '[location id='.$location->id.' width=auto]' ?></code>
                                </strong>
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
                        <a href = <?= admin_url('admin.php?page=our-hotels-manager&req_type=new') ?>>Add New Location</a>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
        <tfoot>
            <tr role="row">
                <th class="manage-column column-cb check-column">
                    <input id="cb-select-all-2" type="checkbox">
                </th>
                <th class="shortcode">Image</th>
                <th class="title">Hotel name</th>
                <th class="address">Address</th>
                <th class="services">Services</th>
                <th class="shortcode">Shortcode</th>
                <th class="status">Status</th>
            </tr>
        </tfoot>
    </table>
    <div id="loader"><div></div></div>
</div>