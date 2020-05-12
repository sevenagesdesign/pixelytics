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
 * Description:       Adds Google Analytics and Facebook Pixels to your WordPress website
 * Version:           1.2.5
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
 * Check for plugin updates
 */

function pixelytics_update() {
    /**
     * @since 1.2.1
     * @package pixelytics
     */

	require_once ('admin/class-pixelytics-update.php');
	$pixelytics_current_version = '1.2.5';
	$pixelytics_remote_path = 'http://www.sevenagesdesign.com/plugins/pixelytics/update.php';
	$pixelytics_slug = plugin_basename( __FILE__ );
	new wp_auto_update ($pixelytics_current_version, $pixelytics_remote_path, $pixelytics_slug);
}
add_action('init', 'pixelytics_update');

/**
 * Adds Google Analytics to the head of the page
 * This action is documented in admin/class-pixelytics-analytics.php
 */

function pixelytics_analytics() {
	include plugin_dir_path( __FILE__ ) . 'admin/class-pixelytics-analytics.php';
}

/**
 * Adds Facebook Pixel to the head of the page
 * This action is documented in admin/class-pixelytics-pixel.php
 */

function pixelytics_pixel() {
	include plugin_dir_path( __FILE__ ) . 'admin/class-pixelytics-pixel.php';
}

register_activation_hook(__FILE__, 'activate_pixelytics');
register_deactivation_hook(__FILE__, 'deactive_pixelytics');

/**
 * Load stylesheets, etc
 */

function style_pixelytics() {
	wp_enqueue_style( 'pixelytics_style', plugins_url('css/style.css', __FILE__ ) );
	wp_enqueue_script( 'pixelytics_js', plugins_url('js/pixelytics.js', __FILE__ ) );
}

/**
 * Set alert for saved settings
 */

function save_alert() {
    ?>
    <div class="updated notice">
        <p><?php _e( 'Settings saved.', 'pixelytics' ); ?></p>
    </div>
    <?php
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
