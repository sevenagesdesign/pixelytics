<?php

/**
 * Fired during plugin activation
 *
 * @package    pixelytics
 * @subpackage pixelytics/includes
 */

class Pixelytics_Activator {

	public static function activate() {
		add_option('web_property_id');
		add_option('pixel_id');
		add_option('analytics_activate');
		add_option('pixel_activate');
	}
	
}
