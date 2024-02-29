<?php
/**
 * 
 * Trigger this file on Plugin Uninstall
 * 
 * @package Hotel Manager
 * 
 */

if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

// Clear data stored in database

global $wpdb;
$table1 = $wpdb->prefix . 'hotels_table';
$wpdb->query("DROP TABLE IF EXISTS $table1");

$table2 = $wpdb->prefix . 'services_table';
$wpdb->query("DROP TABLE IF EXISTS $table2");