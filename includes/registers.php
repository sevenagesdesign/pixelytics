<?php
register_setting('pixelytics', 'web_property_id');
register_setting('pixelytics', 'pixel_id');
register_setting('pixelytics', 'analytics_activate');
register_setting('pixelytics', 'pixel_activate');
register_setting('pixelytics', 'pixel_lead_tracking');

if( isset($_GET['settings-updated']) ) {
	add_action( 'admin_notices', 'save_alert' );
};
?>