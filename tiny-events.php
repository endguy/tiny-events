<?php
/**
 * Plugin Name: Tiny Events
 * Plugin URI:  http://andyharris.com.au
 * Description: Provides an events Custom Post Type and displays events on a chosen URL
 * Author:      Andy Harris
 * Author URI:  http://andyharris.com.au
 * Version:     0.1
 * Text Domain: tiny-events
 */

// Plugin directory path and URL.
// ------------------------------

define( 'TINY_EVENTS_PATH', dirname( __FILE__ ) );
define( 'TINY_EVENTS_URL',  plugin_dir_url( __FILE__ ) );


// Plugin version.
// ---------------
define( 'TINY_EVENTS_VERSION', '0.1' );


// Register the events custom post type
// ------------------------------------
require_once( TINY_EVENTS_PATH . '/partials/custom-post-type.php' );


// Add custom taxonomies
// ---------------------
require_once( TINY_EVENTS_PATH . '/partials/taxonomies.php' );


// include advanced custom fields
// ------------------------------

// 1. customize ACF path 
function my_acf_settings_path( $path ) {
    $path = TINY_EVENTS_PATH . '/vendor/advanced-custom-fields/';
    return $path;   
}
add_filter('acf/settings/path', 'my_acf_settings_path');

// 2. customize ACF dir
function my_acf_settings_dir( $dir ) {
    $dir = TINY_EVENTS_PATH . '/vendor/advanced-custom-fields/';
    return $dir;
}
add_filter('acf/settings/dir', 'my_acf_settings_dir');

// 3. Include ACF
require_once(TINY_EVENTS_PATH. '/vendor/advanced-custom-fields/acf.php');

// 4. Hide ACF Menu Item
define( 'ACF_LITE', true );

// 5. Include ACF Fields
require_once(TINY_EVENTS_PATH . '/partials/acf-fields.php');


// Create options page / menu item
// -------------------------------
require_once(TINY_EVENTS_PATH . '/partials/options.php');


// Create shortcode to display events loop
// ---------------------------------------
require_once(TINY_EVENTS_PATH . '/partials/shortcode.php');



// Setup custom post single template
// ---------------------------------
function tiny_events_single_template($single_template) {
    global $wp_query, $post;

    if ($post->post_type == 'event'){
        $single_template = TINY_EVENTS_PATH . '/templates/single-event.php';
    }

    return $single_template;
}
add_filter( 'single_template', 'tiny_events_single_template' ) ;


// Add scripts & styles to Site
// ----------------------------
function tiny_events_custom_scripts_styles() {

    // grid css
    wp_enqueue_style( 'tiny_events_grid', plugins_url('/vendor/foundation/grid.css', __FILE__) );

    // events css
    wp_enqueue_style( 'tiny_events_css', plugins_url('/css/tiny-events.css', __FILE__) );

    // events css
    wp_enqueue_script( 'tiny_events_js', plugins_url('/js/tiny-events.js', __FILE__) );

}
add_action('init', 'tiny_events_custom_scripts_styles');