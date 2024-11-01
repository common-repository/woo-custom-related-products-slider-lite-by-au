
jQuery(document).ready(function ($) {


    var wccrps_overlay_opacity_dec = wccrps_loc.wccrps_overlay_opacity / 100;
    var obj_wccrps_overlay_color = hexToRgb(wccrps_loc.wccrps_overlay_color);
    var wccrps_overlay_color = 'rgba('+obj_wccrps_overlay_color.r+','+obj_wccrps_overlay_color.g+','+obj_wccrps_overlay_color.b+','+wccrps_overlay_opacity_dec+')';
    
    $('.wccrps_related_ids .owl-controls .owl-buttons > div').css('color',wccrps_loc.wccrps_pag_nav_color).css('border','1px solid '+wccrps_loc.wccrps_pag_nav_color+'');
    $('.wccrps_related_ids .owl-controls .owl-buttons div div').css('color',wccrps_loc.wccrps_pag_nav_color);
    $('.wccrps_related_ids .owl-theme .owl-controls .owl-page span').css('background-color',wccrps_loc.wccrps_pag_nav_color);

	 
	 

    $('.wccrps-product.hovereffect .wccrps-prod-title a').css('color',wccrps_loc.wccrps_font_color);
    $('.wccrps_related_ids #wccrps-owl-ids .wccrps-product.hovereffect .wccrps-price span, .wccrps_related_ids #wccrps-owl-ids .wccrps-product.hovereffect .wccrps-price small').css('color',wccrps_loc.wccrps_font_color);
    $('.wccrps_related_ids #wccrps-owl-ids .wccrps-product.hovereffect button.button, .wccrps_related_ids #wccrps-owl-ids .wccrps-product.hovereffect .wccrps-add-to-cart a').css('color',wccrps_loc.wccrps_font_color).css('border','1px solid '+wccrps_loc.wccrps_font_color+'');
    $('.woocommerce .wccrps-product.default button.button.alt, .wccrps-product.default .wccrps-add-to-cart a').css('color',wccrps_loc.wccrps_font_color).css('border','1px solid '+wccrps_loc.wccrps_font_color+'');
    $('.wccrps-product.default .wccrps-prod-title a, .wccrps-product.default .wccrps-price span, .wccrps-product.default .wccrps-price small').css('color',wccrps_loc.wccrps_font_color);

    $('#wccrps-owl-ids .wccrps-product .wccrps-rating .star-rating span').css('color',wccrps_loc.wccrps_font_color);


    $('.wccrps_related_ids #wccrps-owl-ids .wccrps-product.hovereffect.hovereffect-1 .wccrpsss-img, .wccrps_related_ids #wccrps-owl-ids .wccrps-product.hovereffect.hovereffect-2 .overlay').css('background-color',wccrps_overlay_color);

    $('#wccrps-owl-ids .wccrps-price ins').css('background-color',wccrps_loc.wccrps_sale_price_bg);

    $('#wccrps-owl-ids .wccrps-product.hovereffect').css('font-size',wccrps_loc.wccrps_price_cart_font_size+ 'px');
    $('#wccrps-owl-ids .wccrps-product .wccrps-prod-title a').css('font-size',wccrps_loc.wccrps_prod_title_font_size + 'px');


    $('.wccrps-add-to-cart a.add_to_cart_button').click(function(){
        $(this).hide();
    });

});


function hexToRgb(hex) {
    // Expand shorthand form (e.g. "03F") to full form (e.g. "0033FF")
    var shorthandRegex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
    hex = hex.replace(shorthandRegex, function(m, r, g, b) {
        return r + r + g + g + b + b;
    });

    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
    return result ? {
        r: parseInt(result[1], 16),
        g: parseInt(result[2], 16),
        b: parseInt(result[3], 16)
    } : null;
}

