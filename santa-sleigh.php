<?php
/**
 * Plugin Name:       Santa Sleigh
 * Description:       Santa and his reindeer fly across the screen, legs galloping. No settings: activate it and it flies. Hidden for visitors who prefer reduced motion.
 * Version:           1.0.0
 * Requires at least: 6.5
 * Requires PHP:      7.4
 * Author:            Studio Code
 * License:           GPLv2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       santa-sleigh
 *
 * @package santa-sleigh
 */

defined( 'ABSPATH' ) || exit;

/**
 * Enqueues the sleigh stylesheet on the front end.
 */
function santa_sleigh_enqueue_style(): void {
	wp_enqueue_style(
		'santa-sleigh',
		plugin_dir_url( __FILE__ ) . 'santa-sleigh.css',
		array(),
		'1.0.0'
	);
}
add_action( 'wp_enqueue_scripts', 'santa_sleigh_enqueue_style' );

/**
 * Prints the sleigh at the end of the page. The SVG is inline so it can take
 * the theme's colors through CSS custom properties.
 */
function santa_sleigh_print(): void {
	$svg = file_get_contents( __DIR__ . '/sleigh.svg' ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents -- Local, static plugin file.
	if ( false === $svg ) {
		return;
	}
	echo '<div class="santa-sleigh" aria-hidden="true">' . $svg . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Static SVG shipped with the plugin.
}
add_action( 'wp_footer', 'santa_sleigh_print', 100 );
