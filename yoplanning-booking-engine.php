<?php
/*
 * Plugin Name: Yoplanning Booking Engine
 * Plugin URI: https://yoplanning.pro/
 * Description: Loads the Yoplanning Booking Engine integration script.
 * Version: 1.0.1
 * Requires at least: 5.0
 * Requires PHP:      7.0
 * Author: Yoplanning
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
*/

function yop_add_script_in_header() {
    global $wp_version;
    $src = 'https://booking.yoplanning.pro/integration/script.js';
    $handle = 'yoplanning-booking-engine';

    // Check if the WordPress version supports the 'strategy' argument
    if ( version_compare( $wp_version, '6.3', '>=' ) ) {
        wp_enqueue_script($handle, $src, array(), null, array('strategy' => 'async'));
    } else {
        // For older versions, use a filter to add 'async' attribute
        wp_enqueue_script($handle, $src, array(), null, true);
        add_filter('script_loader_tag', function($tag, $handle, $src) {
            if ($handle === 'yoplanning-booking-engine') {
                return str_replace(' src', ' async="async" src', $tag);
            }
            return $tag;
        }, 10, 2);
    }
}

add_action('wp_enqueue_scripts', 'yop_add_script_in_header');


?>