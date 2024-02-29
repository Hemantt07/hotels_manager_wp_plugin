<?php
/**
 * @package Hotel Manager
 *
 */
namespace LSM\Base;

class Activate {

    public static function activate() {
        $thisClass = new Activate();
        $thisClass->createTable();
        flush_rewrite_rules();
    }

    public function createTable() {
        global $wpdb;
        $table1 = $wpdb->prefix . 'hotels_table';
        $table2 = $wpdb->prefix . 'services_table';

        $sql1 = "CREATE TABLE IF NOT EXISTS $table1 (
            id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
            title varchar(255) DEFAULT NULL,
            address varchar(255) DEFAULT NULL,
            services longtext DEFAULT NULL,
            image_url varchar(255) DEFAULT NULL,
            status tinyint(1) DEFAULT 0,
            PRIMARY KEY (id)
        );";

        $sql2 = "CREATE TABLE IF NOT EXISTS $table2 (
            id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
            service_data longtext DEFAULT NULL,
            facilties longtext DEFAULT NULL,
            status tinyint(1) DEFAULT 0,
            PRIMARY KEY (id)
        );";

        $wpdb->query($sql1);
        $wpdb->query($sql2);

    }
}