<?php
/*
Plugin Name: Woo Custom Related Products Slider [Lite] by AU
Description: “Woo Custom Related Products Slider [Lite] by AU” is a WooCommerce WordPress plugin that provides you functionality of displaying for your customers default or custom related products with nice sliding and hover effects. Lite version.
Version: 1.0
Author: AUrumWP
Author URI: https://profiles.wordpress.org/ilnarkan
Text Domain: wccrps
Domain Path: /languages
*/

if(! function_exists('add_action')){
    die('Silence is golden');
}

//constants
define( 'WCCRPS_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define( 'WCCRPS_PLUGIN_NAME', trim( dirname( WCCRPS_PLUGIN_BASENAME ), '/' ) );
define( 'WCCRPS_PLUGIN_DIR',  dirname( __FILE__ )  );



add_action( 'init' , 'wccrps_add_and_remove' , 15 );
function wccrps_add_and_remove() {
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
}



//activation functions
require_once WCCRPS_PLUGIN_DIR . '\inc\activate.php';
//enqueueing scripts
require_once WCCRPS_PLUGIN_DIR . '\inc\enqueue.php';
//admin menu
require_once WCCRPS_PLUGIN_DIR . '\inc\admin-menu.php';
//all the magic
require_once WCCRPS_PLUGIN_DIR . '\inc\related-products.php';



//on a plugin activation
register_activation_hook(__FILE__, 'wccrps_activate');
add_action( 'activated_plugin', 'wccrps_after_activation_redirect' );



add_filter( 'plugin_action_links_' . WCCRPS_PLUGIN_BASENAME, 'wccrps_add_sett_link' );

function wccrps_add_sett_link ( $links ) {
    $links[] = '<a href="'. esc_url( get_admin_url(null, 'admin.php?page=wccrps-options-page') ) .'">'. __( 'Settings', 'wccrps' ) .'</a>';
    return $links;
}















