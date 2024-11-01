<?php
if(! function_exists('add_action')){
    die('Silence is golden');
}

function wccrps_activate(){
    $wccrps_options = array();
    $wccrps_options['wccrps_default_rel_prods'] = 'def_default_rp';
    $wccrps_options['wccrps_use_slider_by_def'] = 'yes';
    $wccrps_options['wccrps_max_prods'] = 10;
    $wccrps_options['wccrps_number_of_columns'] = 4;
    $wccrps_options['wccrps_slide_speed'] = 2500;
    $wccrps_options['wccrps_navigation'] = 'yes';
    $wccrps_options['wccrps_pagination'] = 'yes';
    $wccrps_options['wccrps_add_to_cart_btn'] = 'yes';
    $wccrps_options['wccrps_rating'] = 'no';
    $wccrps_options['wccrps_price'] = 'yes';
    $wccrps_options['wccrps_orderby'] = 'rand';
    $wccrps_options['wccrps_slide_style'] = 'hover2';
    $wccrps_options['wccrps_pag_nav_color'] = '#000';
    $wccrps_options['wccrps_font_color'] = '#fff';
    $wccrps_options['wccrps_sale_price_bg'] = '#007acc';
    $wccrps_options['wccrps_overlay_color'] = '#000';
    $wccrps_options['wccrps_overlay_opacity'] = 70;
    $wccrps_options['wccrps_prod_title_font_size'] = 16;
    $wccrps_options['wccrps_price_cart_font_size'] = 16;
    $wccrps_options['wccrps_placement'] = 'after_product_data_tabs';
    $wccrps_options['wccrps_onsale_marker'] = 'yes';
    $wccrps_options['wccrps_add_to_cart_btn_style'] = 'plugin';
    
    add_option( "wccrps_options", $wccrps_options );





}

function wccrps_after_activation_redirect($plg_name){
    if( $plg_name == WCCRPS_PLUGIN_BASENAME ) {
        if (get_option("wccrps_options")) {
            exit(wp_redirect(admin_url('admin.php?page=wccrps-options-page')));
        }
    }

}