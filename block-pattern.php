<?php
/**
 * Plugin Name:       Block Pattern Builder For WordPress - Boost Up Gutenberg Patterns
 * Plugin URI:        https://wordpress.org/plugins/create-block-patterns
 * Description:       Create custom block patterns and browse ready-made patterns from the WordPress.org library to enhance your Gutenberg block pattern collection.
 * Version:           4.0.0
 * Requires at least: 6.4
 * Requires PHP:      7.2
 * WP tested up to:   6.6.2
 * Author:            Sadik Multani
 * Author URI:        https://profiles.wordpress.org/multanisadik/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       block-pattern
 * Domain Path:       /languages
 *
 * @package           block-pattern
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

if ( ! defined( 'SSBP_PLUGIN_VERSION' ) ) {
	define( 'SSBP_PLUGIN_VERSION', '4.0.0' );
}

if ( ! defined( 'SSBP_PLUGIN_URL' ) ) {
	define( 'SSBP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'SSBP_PLUGIN_DIR_PATH' ) ) {
	define( 'SSBP_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
}

require SSBP_PLUGIN_DIR_PATH . 'inc/custom-post-type.php';
require SSBP_PLUGIN_DIR_PATH . 'inc/load-pattern.php';
require SSBP_PLUGIN_DIR_PATH . 'inc/patterns-settings.php';
