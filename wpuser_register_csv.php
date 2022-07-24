<?php
/**
 * @package wpuser_register_csv
 * @version 1.0.0
 */
/*
Plugin Name: User Register From CSV
Plugin URI: https://github.com/sarequl/wpuser-register-csv
Description: You can use this plugin to register user from csv file. Maybe you have a old website and you want transfer your user from old website to new website. you can use this plugin to register user from csv file.
Version: 1.0.0
Author: Sarequl Basar
Author URI: https://sarequl.me
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use. - https://sarequl.me
 */
define( 'wpuser_register_csv', '1.0.0' );

/**
 * The code that runs during plugin activation.
 */

if(!function_exists('activate_wpuser_register_csv')){
	function activate_wpuser_register_csv() {
		
	}
}

/**
 * The code that runs during plugin deactivation.
 */
if(!function_exists('deactivate_wpuser_register_csv')){
	function deactivate_wpuser_register_csv() {
		
	}
}


if(!function_exists('wpuser_register_csv_action_links')){
	function wpuser_register_csv_action_links( $links,$plugin ) {

		$plugin_path = plugin_dir_path(__FILE__);

		$new_link = array();
		if(basename($plugin_path).'/wpuser_register_csv.php' == $plugin){

			$new_link['settings'] = '<a href="'. esc_url( get_admin_url( null, 'users.php?page=user_register_from_csv' ) ) .'">'. __( 'Settings', 'wpuser_register_csv' ) .'</a>';
		}

		return array_merge($new_link,$links);
	}

	add_filter('plugin_action_links', 'wpuser_register_csv_action_links', 10, 2);
}





register_activation_hook( __FILE__, 'activate_wpuser_register_csv' );
register_deactivation_hook( __FILE__, 'deactivate_wpuser_register_csv' );


//admin panel
require plugin_dir_path( __FILE__ ) . 'admin/admin_options.php';



