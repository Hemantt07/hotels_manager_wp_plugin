<?php
/**
 * @package Hotel Manager
 *
 * Services Dashboard
 */
global $wpdb;
$services_table = $wpdb->prefix . 'services_table';
$query = "SELECT * FROM $services_table";
$services = $wpdb->get_results($query);

?>
<div class="main wrap">
    <h1 class="wp-heading-inline">Services Manager</h1>
    <a href=<?= admin_url('admin.php?page=services-manager&req_type=new') ?> class="page-title-action">Add New Service</a>
    <table id="services-dashboard" class="wp-list-table widefat fixed striped table-view-list locations-services-table">
        <thead>
            <tr role="row">
                <th class="manage-column column-cb check-column">
                    <input id="cb-select-all-1" type="checkbox">
                </th>
                <th class="title">Service name</th>
                <th>Facilties</th>
                <th class="status">Status</th>
            </tr>
        </thead>
        <tbody id="the-list">
            <?php  if ($services) : ?>
                <?php foreach ($services as $key => $service) : ?>
                    <tr role="row" id="<?= $service->id ?>">
                        <td class="check-column">
                            <input class="cb-select-1" type="checkbox" name="post[]" value="<?= $service->id ?>">
                        </td>
                        <td class="dt-body-center title">
                            <a href="<?= admin_url('admin.php?page=services-manager&req_type=edit&service_id='.$service->id) ?>"
                                class="row-title">
                                <b><?= $service->service_data ?></b>
                            </a>
                            <div class="row-actions">
                                <span class="edit">
                                    <a href="<?= admin_url('admin.php?page=services-manager&req_type=edit&service_id='.$service->id) ?>">
                                        Edit
                                    </a>
                                </span> | 
                                <span class="trash">
                                    <a href="" class="submitdelete" data-id="<?= $service->id ?>" data-type="service">
                                        Trash
                                    </a>
                                </span>
                            </div>
                        </td>
                        <td class="dt-body-center services">
                            <?php
                                $facilities = explode(",", $service->facilities);
                                foreach ($facilities as $key => $facility) {
                                    echo $key !== count($facilities) - 1 ? $facility . ', ' : $facility;
                                }
                            ?>
                        </td>
                        <td class="dt-body-center status <?= ($service->status == '1') ? ('active') : ('inactive')?>">
                            <?= ($service->status == '1') ? ('Active') : ('Inactive') ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php else : ?>
                <tr role="row" class="no-data">
                    <td colspan="7">
                        <span>There are no Services registered</span>
                        <a href = <?= admin_url('admin.php?page=services-manager&req_type=new') ?>>Add New Service</a>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
        <tfoot>
            <tr role="row">
                <th class="manage-column column-cb check-column">
                    <input id="cb-select-all-2" type="checkbox">
                </th>
                <th>Sr No.</th>
                <th>Facilties</th>
                <th>Status</th
            </tr>
        </tfoot>
    </table>
</div>