<?php
/**
 *
 *
 * @link              http://maxazarcon.com/
 * @since             1.0.0
 * @package           pixelytics
 *
 * @wordpress-plugin
 * Plugin Name:       Pixelytics
 * Plugin URI:        https://github.com/soulexpression/pixelytics
 * Description:       Adds Google Analytics and Facebook Pixels
 * Version:           1.0.0
 * Author:            Seven Ages Design
 * Author URI:        http://sevenagesdesign.com/
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       pixelytics
 * Domain Path:       /languages
 */

if (!defined('WP_CONTENT_URL'))
	define('WP_CONTENT_URL', get_option('siteurl').'/wp-content');
if (!defined('WP_CONTENT_DIR'))
	define('WP_CONTENT_DIR', ABSPATH.'wp-content');
if (!defined('WP_PLUGIN_URL'))
	define('WP_PLUGIN_URL', WP_CONTENT_URL.'/plugins');
if (!defined('WP_PLUGIN_DIR'))
	define('WP_PLUGIN_DIR', WP_CONTENT_DIR.'/plugins');


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-pixelytics-activator.php
 */

function activate_pixelytics() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pixelytics-activator.php';
	Pixelytics_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-pixelytics-deactivator.php
 */

function deactive_pixelytics() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pixelytics-deactivator.php';
	Pixelytics_Deactivator::deactivate();
}

/**
 * The code that registers settings in the plugin.
 * This action is documented in includes/registers.php
 */

function admin_init_pixelytics() {
	include plugin_dir_path( __FILE__ ) . 'includes/registers.php';
}

/**
 * Adds the plugin settings page to the Admin menu
 */

function admin_menu_pixelytics() {
	add_menu_page('Pixelytics Settings', 'Pixelytics', 'manage_options', 'pixelytics', 'options_page_pixelytics', 'dashicons-chart-area');
}

function options_page_pixelytics() {
	include(WP_PLUGIN_DIR.'/pixelytics/options.php');  
}

/**
 * Adds Google Analytics to the head of the page
 */

function pixelytics_analytics() {
	$web_property_id = get_option('web_property_id');
?>
<!-- Google Analytics Code -->
<script type="text/javascript">
	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', '<?php echo $web_property_id ?>']);
	_gaq.push(['_trackPageview']);
	(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();
</script>
<!-- End Google Analytics Code -->
<?php
}

/**
 * Adds Facebook Pixel to the head of the page
 */

function pixelytics_pixel() {
	$pixel_id = get_option('pixel_id');
?>
<!-- Facebook Pixel Code -->
<script>
	!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
	n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
	t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
	document,'script','https://connect.facebook.net/en_US/fbevents.js');

	fbq('init', '<?php echo $pixel_id ?>');
	fbq('track', "PageView");</script>
	<noscript><img height="1" width="1" style="display:none"
	src="https://www.facebook.com/tr?id=<?php echo $pixel_id ?>&ev=PageView&noscript=1"
	/></noscript>
	<!-- End Facebook Pixel Code -->
<?php
}

register_activation_hook(__FILE__, 'activate_pixelytics');
register_deactivation_hook(__FILE__, 'deactive_pixelytics');

/*
 * Load stylesheets, etc
 */

function style_pixelytics() {
	wp_enqueue_style( 'pixelytics_style', plugins_url('css/style.css', __FILE__ ) );
	wp_enqueue_script( 'pixelytics_js', plugins_url('js/pixelytics.js', __FILE__ ) );
}

if (is_admin()) {
	add_action( 'admin_init', 'admin_init_pixelytics' );
	add_action( 'admin_menu', 'admin_menu_pixelytics' );
	add_action( 'admin_enqueue_scripts', 'style_pixelytics' );
}

if (!is_admin()) {
	if( checked( '1', get_option( 'analytics_activate' ), false ) ){
		add_action( 'wp_head', 'pixelytics_analytics' );
	}
	if( checked( '1', get_option( 'pixel_activate' ), false ) ){
		add_action( 'wp_head', 'pixelytics_pixel' );
	}
}

?>