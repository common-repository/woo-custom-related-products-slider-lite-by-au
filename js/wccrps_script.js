jQuery(document).ready(function ($) {
    $( "#wccrps-tabs" ).tabs();

    $('input[name*="wccrps_pag_nav_color"]').wpColorPicker();
    $('input[name*="wccrps_font_color"]').wpColorPicker();
    $('input[name*="wccrps_overlay_color"]').wpColorPicker();
    $('input[name*="wccrps_sale_price_bg"]').wpColorPicker();
    
});