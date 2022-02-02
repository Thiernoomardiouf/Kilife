<?php
/*
Plugin Name: Category Ajax Filter
Description: Filter posts/custom post types by category without page reload.Easy to sort/filter and display posts on page with Ajax. It Supports Divi, Elementor and other page builders.
Version: 1.9.2
Author: Trusty Plugins
Author URI: https://trustyplugins.com
License: GPL3
License URI: http://www.gnu.org/licenses/gpl.html
Text Domain: category-ajax-filter
Domain Path: /languages
*/
// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No tircks please!' );
/*---- CONFIGURATION >>>> DEFINE CURRENT VERSION ----*/
if (!defined('CAF_CURRENT_VERSION')){
    define('CAF_CURRENT_VERSION', '1.9.2');
}
if (!defined('CAF_OPTIONS')){
    define('CAF_OPTIONS', 'Category Ajax Filter');
}
if ( ! defined( 'TC_CAF_PATH' ) ) {
define( 'TC_CAF_PATH', plugin_dir_path( __FILE__ ) );
}
class TC_CAF_Plugin {
	public function __construct(){
	add_action( 'plugins_loaded', array( $this, 'tc_caf_load_plugin_textdomain' ) );
	$this->tc_caf_plugin_constants();
	require_once TC_CAF_PATH . 'admin/admin.php';
	/*---- UPDATE THE CURRENT ACTIVE VERSION OF THE PLUGIN ----*/ 	
	if(!get_option('tc_caf_plugin_version'))
	{
	update_option('tc_caf_plugin_version',TC_CAF_PLUGIN_VERSION);
	}
	}
	/*---- LOAD PLUGIN TEXTDOMAIN ----*/
	public function tc_caf_load_plugin_textdomain () {
	load_plugin_textdomain( 'category-ajax-filter', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );
    }
    /*---- set plugin constants ----*/
	public function tc_caf_plugin_constants(){
		if ( ! defined( 'TC_CAF_URL' ) ) {
			define( 'TC_CAF_URL', plugin_dir_url( __FILE__ ) );
		}
		if ( ! defined( 'TC_CAF_PATH' ) ) {
			define( 'TC_CAF_PATH', plugin_dir_path( __FILE__ ) );
		}
		if ( ! defined( 'TC_CAF_PLUGIN_VERSION' ) ) {
			define( 'TC_CAF_PLUGIN_VERSION','1.9.2' );
		}
	}
}
// Instantiate the plugin class.
$tc_caf_plugin = new TC_CAF_Plugin();
register_activation_hook( __FILE__, 'tc_caf_activate' );
register_deactivation_hook( __FILE__, 'tc_caf_deactivate' );
function tc_caf_activate() {	
}
function tc_caf_deactivate() {
}
?>