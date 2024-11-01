<?php
if (!function_exists('add_action')) {
    die('Silence is golden');
}

//frontend
add_action('wp_enqueue_scripts', 'wccrps_plugin_scripts_styles');
function wccrps_plugin_scripts_styles()
{

    wp_register_script('wccrps_owl_script', plugins_url(WCCRPS_PLUGIN_NAME . '/js/owl.carousel.min.js'), array('jquery'), '', true);
    wp_register_script('wccrps_script_fr', plugins_url(WCCRPS_PLUGIN_NAME . '/js/wccrps_script_fr.js'), array('jquery'), '', true);
    wp_register_style('wccrps_owl_css', plugins_url(WCCRPS_PLUGIN_NAME . '/css/owl.carousel.css'));
    wp_register_style('wccrps_style_css', plugins_url(WCCRPS_PLUGIN_NAME . '/css/wccrps_style.css'));

    //only on product pages
    if (function_exists('is_product')){
		if (is_product()) {

			wp_enqueue_script('wccrps_script_fr');
			wp_enqueue_script('wccrps_owl_script');
			wp_enqueue_style('wccrps_owl_css');
			wp_enqueue_style('wccrps_style_css');
			wp_enqueue_style('dashicons');

			$wccrps_options = get_option('wccrps_options');
			$wccrps_pag_nav_color = $wccrps_options['wccrps_pag_nav_color'] ? $wccrps_options['wccrps_pag_nav_color'] : '#eee';
			$wccrps_font_color = $wccrps_options['wccrps_font_color'] ? $wccrps_options['wccrps_font_color'] : '#000';
			$wccrps_overlay_color = $wccrps_options['wccrps_overlay_color'] ? $wccrps_options['wccrps_overlay_color'] : '#000';
			$wccrps_overlay_opacity = $wccrps_options['wccrps_overlay_opacity'] ? $wccrps_options['wccrps_overlay_opacity'] : 40;
			$wccrps_sale_price_bg = $wccrps_options['wccrps_sale_price_bg'] ? $wccrps_options['wccrps_sale_price_bg'] : '#007acc';
			$wccrps_prod_title_font_size = $wccrps_options['wccrps_prod_title_font_size'] ? $wccrps_options['wccrps_prod_title_font_size'] : '16';
			$wccrps_price_cart_font_size = $wccrps_options['wccrps_price_cart_font_size'] ? $wccrps_options['wccrps_price_cart_font_size'] : '16';
			$wccrps_navigation_pos = $wccrps_options['wccrps_navigation_pos'] ? $wccrps_options['wccrps_navigation_pos'] : '3';

			$final_arr = array(
				'wccrps_pag_nav_color' => $wccrps_pag_nav_color,
				'wccrps_font_color' => $wccrps_font_color,
				'wccrps_overlay_color' => $wccrps_overlay_color,
				'wccrps_overlay_opacity' => $wccrps_overlay_opacity,
				'wccrps_sale_price_bg' => $wccrps_sale_price_bg,
				'wccrps_prod_title_font_size' => $wccrps_prod_title_font_size,
				'wccrps_price_cart_font_size' => $wccrps_price_cart_font_size,
			);
			wp_localize_script('wccrps_script_fr', 'wccrps_loc', $final_arr);
		}
    }
}

//backend
add_action('admin_enqueue_scripts', 'wccrps_admin_plugin_scripts_styles');
function wccrps_admin_plugin_scripts_styles()
{
	if ($_GET['page'] == 'wccrps-options-page') {
		wp_register_style('wccrps_admin_style_css', plugins_url(WCCRPS_PLUGIN_NAME . '/css/wccrps_admin_style.css'));
		wp_enqueue_script('jquery-ui-tabs');
		wp_register_script('wccrps_script', plugins_url(WCCRPS_PLUGIN_NAME . '/js/wccrps_script.js'), array('jquery', 'wp-color-picker'), '', true);

		wp_enqueue_style('wccrps_admin_style_css');
		wp_enqueue_style('wp-color-picker');
		wp_enqueue_script('wp-color-picker');
		wp_enqueue_script('wccrps_script');
	}

}











