<?php

/**
 * Fired during plugin deactivation
 *
 * @package    pixelytics
 * @subpackage pixelytics/includes
 */

class Pixelytics_Deactivator {

	public static function deactivate() {
		delete_option('web_property_id');
		delete_option('pixel_id');
		delete_option('analytics_activate');
		delete_option('pixel_activate');
	}

}
