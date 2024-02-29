<?php
/**
 * @package Hotel Manager
 */
namespace LSM;

use LSM\Base\Locations_widget;

final class Init 
{
	/**
	 * Store all the classes inside an array
	 * @return array Full list of classes
	 */
	public static function get_services() 
	{
		return [
            Pages\Admin::class,
			Base\Enqueue::class,
			Base\SettingLinks::class,
			Handlers\Register_widget::class,
			Handlers\CustomAjax::class,
			Handlers\Shortcodes::class,
		];
	}

    /**
	 * Loop through the classes, initialize them, 
	 * and call the register() method if it exists
	 * @return
	 */
	public static function register_services() 
	{
		foreach ( self::get_services() as $class ) 
		{
			$services = self::instantiate( $class );

			if ( method_exists( $services, 'register' ) ) 
			{
				$services->register();
			}
		}
	}

	/**
	 * Initialize the class
	 * @param  class $class class from the services array
	 * @return class instance new instance of Calculatorthe class
	 */
	private static function instantiate( $class ) 
	{
		$services = new $class();
		return $services;
	}
}