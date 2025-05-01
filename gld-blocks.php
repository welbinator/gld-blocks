<?php
/**
 * Plugin Name:       GLD Blocks
 * Description:       Custom Gutenberg blocks for GLD Commercial.
 * Version:           1.0.0
 * Author:            James Welbes
 * Text Domain:       gld-blocks
 * Domain Path:       /languages
 *
 * @package GLD_Blocks
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'GLD_BLOCKS_VERSION', '1.0.0' );

/**
 * Enqueue plugin-wide styles.
 */
function gld_blocks_enqueue_global_styles() {
    wp_enqueue_style(
        'gld-blocks-global-style',
        plugins_url( 'assets/style.css', __FILE__ ),
        array(),
        GLD_BLOCKS_VERSION
    );
}
add_action( 'wp_enqueue_scripts', 'gld_blocks_enqueue_global_styles', 20 );



/**
 * Registers all block assets for the plugin.
 */
function gld_blocks_register_blocks() {

    // Home Hero Block
    register_block_type(
        __DIR__ . '/build/home-hero',
        [
            'render_callback' => 'gld_blocks_render_home_hero',
        ]
    );
    if ( file_exists( plugin_dir_path( __FILE__ ) . 'build/home-hero/render.php' ) ) {
        include_once plugin_dir_path( __FILE__ ) . 'build/home-hero/render.php';
    }

    // Property Search Block
    register_block_type(
        __DIR__ . '/build/property-search',
        [
            'render_callback' => 'gld_blocks_render_property_search',
        ]
    );
    if ( file_exists( plugin_dir_path( __FILE__ ) . 'build/property-search/render.php' ) ) {
        include_once plugin_dir_path( __FILE__ ) . 'build/property-search/render.php';
    }

    // Featured Properties Block
    register_block_type(
		__DIR__ . '/build/featured-properties',
		[ 'render_callback' => 'gld_blocks_render_featured_properties' ]
	);

	if ( file_exists( plugin_dir_path(__FILE__) . 'build/featured-properties/render.php' ) ) {
		include_once plugin_dir_path(__FILE__) . 'build/featured-properties/render.php';
	}

    // Market Outlook Block
    register_block_type(
		__DIR__ . '/build/market-outlook',
		[ 'render_callback' => 'gld_blocks_render_market_outlook' ]
	);

	if ( file_exists( plugin_dir_path(__FILE__) . 'build/market-outlook/render.php' ) ) {
		include_once plugin_dir_path(__FILE__) . 'build/market-outlook/render.php';
	}

     // About Us Block
     register_block_type(
		__DIR__ . '/build/about-us',
		[ 'render_callback' => 'gld_blocks_render_about_us' ]
	);

	if ( file_exists( plugin_dir_path(__FILE__) . 'build/about-us/render.php' ) ) {
		include_once plugin_dir_path(__FILE__) . 'build/about-us/render.php';
	}

      // Testimonials Block
      register_block_type(
		__DIR__ . '/build/testimonials',
		[ 'render_callback' => 'gld_blocks_render_testimonials' ]
	);

	if ( file_exists( plugin_dir_path(__FILE__) . 'build/testimonials/render.php' ) ) {
		include_once plugin_dir_path(__FILE__) . 'build/testimonials/render.php';
	}

}
add_action( 'init', 'gld_blocks_register_blocks' );




