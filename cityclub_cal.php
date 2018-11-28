<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              pospisk.me
 * @since             1.0.0
 * @package           Cityclub_cal
 *
 * @wordpress-plugin
 * Plugin Name:       CityClub Calendar
 * Plugin URI:        pospisk.me/plugin
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            pospisk
 * Author URI:        pospisk.me
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       cityclub_cal
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-cityclub_cal-activator.php
 */
function activate_cityclub_cal() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cityclub_cal-activator.php';
	Cityclub_cal_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-cityclub_cal-deactivator.php
 */
function deactivate_cityclub_cal() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cityclub_cal-deactivator.php';
	Cityclub_cal_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_cityclub_cal' );
register_deactivation_hook( __FILE__, 'deactivate_cityclub_cal' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-cityclub_cal.php';
require plugin_dir_path( __FILE__ ) . 'includes/class-calendar.php'; // calling class-calendar.php
/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_cityclub_cal() {

	$plugin = new Cityclub_cal();
	$plugin->run();

}
run_cityclub_cal();
