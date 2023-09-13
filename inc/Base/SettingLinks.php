<?php
/**
 * @package Calculator
 *
 */

namespace CG\Base;

class SettingLinks{

    protected $plugin;

    public function __construct()
    {
        $this->plugin = ELEMENTOR_WIDGET_PLUGIN_NAME;
    }

    public function register()
    {
        add_filter( "plugin_action_links_$this->plugin", array( $this, 'setting_links' ) );
    }

    public function setting_links( $links )
    {
        $setting_link = '<a href="admin.php?page=location-services-manager">Configure</a>';
        array_push( $links, $setting_link );
        return $links;
    }

}
