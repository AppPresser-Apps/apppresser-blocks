<?php
/**
 * Plugin Name:       AppPresser Blocks
 * Plugin URI:        https://wordpress.org/plugins/apppresser-blocks/
 * Description:       Mobile optimized blocks.
 * Requires at least: 6.5
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            AppPresser
 * Author URI:        https://apppresser.com
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       apppresser-blocks
 * Domain Path: /languages
 *
 * @package Blobs
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'APPPRESSER_BLOCKS_DIR', plugin_dir_path( __FILE__ ) );
define( 'APPPRESSER_BLOCKS_URL', plugins_url( basename( __DIR__ ) ) );

require_once __DIR__ . '/helpers/icons.php';
require_once __DIR__ . '/filters/selects.php';

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function apppresser_blocks_init() {

	// Register blocks in the format $dir => $render_callback.
	$blocks = array(
		'chip'         => '', // Dynamic block with a callback.
		'image-slider' => '', // Static block. Doesn't need a callback.
	);

	foreach ( $blocks as $dir => $render_callback ) {
		$args = array();
		if ( ! empty( $render_callback ) ) {
			$args['render_callback'] = $render_callback;
		}
		register_block_type( __DIR__ . '/build/' . $dir, $args );
	}
}
add_action( 'init', 'apppresser_blocks_init' );

/**
 * Adds a new block category called "AppPresser" with a smartphone icon.
 *
 * @param array $categories The existing block categories.
 * @return array The modified block categories.
 */
function apppresser_block_categories( $categories ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug'  => 'apppresser',
				'title' => 'AppPresser',
				'icon'  => 'smartphone',
			),
		)
	);
}
add_filter( 'block_categories_all', 'apppresser_block_categories' );



/**
 * Plugin updater. Gets new version from Github.
 */
if ( is_admin() ) {

	function apppresser_blocks_updater() {

		require 'plugin-update/plugin-update-checker.php';
		$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
			'https://github.com/AppPresser-Apps/apppresser-blocks',
			__FILE__,
			'apppresser-blocks'
		);

		// Set the branch that contains the stable release.
		$myUpdateChecker->setBranch( 'main' );
		$myUpdateChecker->getVcsApi()->enableReleaseAssets();
	}
	apppresser_blocks_updater();
}
