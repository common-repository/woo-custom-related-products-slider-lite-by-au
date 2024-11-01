<?php
if (!function_exists('add_action')) {
    die('Silence is golden');
}


add_action('admin_menu', 'wccrps_admin_menu', 90);
function wccrps_admin_menu()
{
    add_submenu_page('woocommerce', __('WC Custom Related Products Slider by AU', 'wccrps'), __('Custom Related Products Slider', 'wccrps'), 'manage_options', 'wccrps-options-page', 'wccrps_option_page');
}


add_action('admin_init', 'wccrps_reg_settings');
function wccrps_reg_settings()
{
    register_setting('wccrps_options_group', 'wccrps_options');

    add_settings_section('wccrps_default_options_section', __('Default Settings', 'wccrps'), '', 'wccrps-options-page');

    add_settings_field('wccrps_default_rel_prods', __('Related Products By Default For All Products', 'wccrps'), 'wccrps_default_rel_prods_cb', 'wccrps-options-page', 'wccrps_default_options_section', array('label_for' => 'wccrps_default_rel_prods'));


    add_settings_field('wccrps_use_slider_by_def', __('Use Slider By Default For All Products', 'wccrps'), 'wccrps_use_slider_by_def_cb', 'wccrps-options-page', 'wccrps_default_options_section', array('label_for' => 'wccrps_use_slider_by_def'));


    add_settings_section('wccrps_output_options_section', __('Output Settings', 'wccrps'), '', 'wccrps-options-page');

    add_settings_field('wccrps_placement', __('Placement ', 'wccrps'), 'wccrps_placement_cb', 'wccrps-options-page', 'wccrps_output_options_section', array('label_for' => 'wccrps_placement'));

    add_settings_field('wccrps_max_prods', __('Maximum Number Of Products ', 'wccrps'), 'wccrps_max_prods_cb', 'wccrps-options-page', 'wccrps_output_options_section', array('label_for' => 'wccrps_max_prods'));

    add_settings_field('wccrps_number_of_columns', __('Number Of Columns', 'wccrps'), 'wccrps_number_of_columns_cb', 'wccrps-options-page', 'wccrps_output_options_section', array('label_for' => 'wccrps_number_of_columns'));

    add_settings_field('wccrps_orderby', __('Order By', 'wccrps'), 'wccrps_orderby_cb', 'wccrps-options-page', 'wccrps_output_options_section', array('label_for' => 'wccrps_orderby'));


    add_settings_section('wccrps_slider_settings_section', __('Slider Settings', 'wccrps'), '', 'wccrps-options-page');



    add_settings_field('wccrps_slide_speed', __('Slider Speed In Milliseconds', 'wccrps'), 'wccrps_slide_speed_cb', 'wccrps-options-page', 'wccrps_slider_settings_section', array('label_for' => 'wccrps_slide_speed'));

    add_settings_field('wccrps_navigation', __('Enable Navigation', 'wccrps'), 'wccrps_navigation_cb', 'wccrps-options-page', 'wccrps_slider_settings_section', array('label_for' => 'wccrps_navigation'));


	
    add_settings_field('wccrps_pagination', __('Enable Pagination', 'wccrps'), 'wccrps_pagination_cb', 'wccrps-options-page', 'wccrps_slider_settings_section', array('label_for' => 'wccrps_pagination'));


    add_settings_field('wccrps_add_to_cart_btn', __('Enable Add To Cart Button', 'wccrps'), 'wccrps_add_to_cart_btn_cb', 'wccrps-options-page', 'wccrps_slider_settings_section', array('label_for' => 'wccrps_add_to_cart_btn'));


    add_settings_field('wccrps_rating', __('Enable Rating', 'wccrps'), 'wccrps_rating_cb', 'wccrps-options-page', 'wccrps_slider_settings_section', array('label_for' => 'wccrps_rating'));

    add_settings_field('wccrps_price', __('Enable Price', 'wccrps'), 'wccrps_price_cb', 'wccrps-options-page', 'wccrps_slider_settings_section', array('label_for' => 'wccrps_price'));


    add_settings_field('wccrps_onsale_marker', __('Enable On Sale Marker', 'wccrps'), 'wccrps_onsale_marker_cb', 'wccrps-options-page', 'wccrps_slider_settings_section', array('label_for' => 'wccrps_onsale_marker'));



    add_settings_section('wccrps_slider_styling_section', __('Slider Styling', 'wccrps'), '', 'wccrps-options-page');


    add_settings_field('wccrps_slide_style', __('Slider Style', 'wccrps'), 'wccrps_slide_style_cb', 'wccrps-options-page', 'wccrps_slider_styling_section', array('label_for' => 'wccrps_slide_style'));


    add_settings_field('wccrps_add_to_cart_btn_style', __('Add To Cart Button Style', 'wccrps'), 'wccrps_add_to_cart_btn_style_cb', 'wccrps-options-page', 'wccrps_slider_styling_section', array('label_for' => 'wccrps_add_to_cart_btn_style'));


    add_settings_field('wccrps_pag_nav_color', __('Pagination And Navigation Color', 'wccrps'), 'wccrps_pag_nav_color_cb', 'wccrps-options-page', 'wccrps_slider_styling_section', array('label_for' => 'wccrps_pag_nav_color'));

    add_settings_field('wccrps_font_color', __('Font Color', 'wccrps'), 'wccrps_font_color_cb', 'wccrps-options-page', 'wccrps_slider_styling_section', array('label_for' => 'wccrps_font_color'));

    add_settings_field('wccrps_overlay_color', __('Overlay Color', 'wccrps'), 'wccrps_overlay_color_cb', 'wccrps-options-page', 'wccrps_slider_styling_section', array('label_for' => 'wccrps_overlay_color'));

    add_settings_field('wccrps_overlay_opacity', __('Overlay Opacity', 'wccrps'), 'wccrps_overlay_opacity_cb', 'wccrps-options-page', 'wccrps_slider_styling_section', array('label_for' => 'wccrps_overlay_opacity'));


    add_settings_field('wccrps_sale_price_bg', __('Sale Price Background Color', 'wccrps'), 'wccrps_sale_price_bg_cb', 'wccrps-options-page', 'wccrps_slider_styling_section', array('label_for' => 'wccrps_sale_price_bg'));


    add_settings_field('wccrps_prod_title_font_size', __('Product Title Font Size', 'wccrps'), 'wccrps_prod_title_font_size_cb', 'wccrps-options-page', 'wccrps_slider_styling_section', array('label_for' => 'wccrps_prod_title_font_size'));


    add_settings_field('wccrps_price_cart_font_size', __('Product Price And Cart Font Size', 'wccrps'), 'wccrps_price_cart_font_size_cb', 'wccrps-options-page', 'wccrps_slider_styling_section', array('label_for' => 'wccrps_price_cart_font_size'));



}

$wccrps_options = get_option('wccrps_options');


function wccrps_slide_style_cb()
{
    global $wccrps_options;
    $selected_default = '';
    $selected_hover1 = '';
    $selected_hover2 = '';
    $selected_hover3 = '';
    if ($wccrps_options['wccrps_slide_style'] == 'hover1') {
        $selected_hover1 = 'selected';
    } elseif ($wccrps_options['wccrps_slide_style'] == 'hover2') {
        $selected_hover2 = 'selected';
    } else {
        $selected_default = 'selected';
    }
    ?>

    <select name="wccrps_options[wccrps_slide_style]" id="wccrps_options[wccrps_slide_style]">
        <option <?= $selected_default ?> value="default"><?php _e('Simple', 'wccrps'); ?></option>
        <option <?= $selected_hover1 ?> value="hover1"><?php _e('Hover Effect 1', 'wccrps'); ?></option>
        <option <?= $selected_hover2 ?> value="hover2"><?php _e('Hover Effect 2', 'wccrps'); ?></option>
    </select>


    <?
}

function wccrps_slide_speed_cb()
{
    global $wccrps_options;
    ?>
    <input type="number" name="wccrps_options[wccrps_slide_speed]" id="wccrps_options[wccrps_slide_speed]" min="0"
           max="100000" step="100" value="<?= $wccrps_options['wccrps_slide_speed'] ?>">ms
    <?
}

function wccrps_navigation_cb()
{
    global $wccrps_options;
    $selected_yes = '';
    $selected_no = '';
    if ($wccrps_options['wccrps_navigation'] == 'yes') {
        $selected_yes = 'selected';
    } else {
        $selected_no = 'selected';
    }
    ?>

    <select name="wccrps_options[wccrps_navigation]" id="wccrps_options[wccrps_navigation]">
        <option <?= $selected_yes ?> value="yes"><?php _e('Yes', 'wccrps'); ?></option>
        <option <?= $selected_no ?> value="no"><?php _e('No', 'wccrps'); ?></option>
    </select>


    <?
}

function wccrps_pagination_cb()
{
    global $wccrps_options;
    $selected_yes = '';
    $selected_no = '';
    if ($wccrps_options['wccrps_pagination'] == 'yes') {
        $selected_yes = 'selected';
    } else {
        $selected_no = 'selected';
    }
    ?>

    <select name="wccrps_options[wccrps_pagination]" id="wccrps_options[wccrps_pagination]">
        <option <?= $selected_yes ?> value="yes"><?php _e('Yes', 'wccrps'); ?></option>
        <option <?= $selected_no ?> value="no"><?php _e('No', 'wccrps'); ?></option>
    </select>


    <?
}


function wccrps_pag_nav_color_cb()
{
    global $wccrps_options;

    ?>
    <input name="wccrps_options[wccrps_pag_nav_color]" type="text"
           value="<?= $wccrps_options['wccrps_pag_nav_color'] ?>"/>
    <?
}

function wccrps_font_color_cb()
{
    global $wccrps_options;

    ?>
    <input name="wccrps_options[wccrps_font_color]" type="text" value="<?= $wccrps_options['wccrps_font_color'] ?>"/>
    <?
}


function wccrps_onsale_marker_cb(){
    global $wccrps_options;
    $selected_yes = '';
    $selected_no = '';
    if ($wccrps_options['wccrps_onsale_marker'] == 'yes') {
        $selected_yes = 'selected';
    } else {
        $selected_no = 'selected';
    }
    ?>

    <select name="wccrps_options[wccrps_onsale_marker]" id="wccrps_options[wccrps_onsale_marker]">
        <option <?= $selected_yes ?> value="yes"><?php _e('Yes', 'wccrps'); ?></option>
        <option <?= $selected_no ?> value="no"><?php _e('No', 'wccrps'); ?></option>
    </select>


    <?
}

function wccrps_sale_price_bg_cb()
{
    global $wccrps_options;

    ?>
    <input name="wccrps_options[wccrps_sale_price_bg]" type="text"
           value="<?= $wccrps_options['wccrps_sale_price_bg'] ?>"/>
    <?
}

function wccrps_overlay_color_cb()
{
    global $wccrps_options;

    ?>
    <input name="wccrps_options[wccrps_overlay_color]" type="text"
           value="<?= $wccrps_options['wccrps_overlay_color'] ?>"/>
    <?
}

function wccrps_overlay_opacity_cb()
{
    global $wccrps_options;
    ?>
    <input type="number" name="wccrps_options[wccrps_overlay_opacity]" id="wccrps_options[wccrps_overlay_opacity]"
           min="0" max="100" step="10" value="<?= $wccrps_options['wccrps_overlay_opacity'] ?>">%
    <?
}

function wccrps_add_to_cart_btn_cb()
{
    global $wccrps_options;
    $selected_yes = '';
    $selected_no = '';
    if ($wccrps_options['wccrps_add_to_cart_btn'] == 'yes') {
        $selected_yes = 'selected';
    } else {
        $selected_no = 'selected';
    }
    ?>

    <select name="wccrps_options[wccrps_add_to_cart_btn]" id="wccrps_options[wccrps_add_to_cart_btn]">
        <option <?= $selected_yes ?> value="yes"><?php _e('Yes', 'wccrps'); ?></option>
        <option <?= $selected_no ?> value="no"><?php _e('No', 'wccrps'); ?></option>
    </select>


    <?
}

function wccrps_add_to_cart_btn_style_cb(){
    global $wccrps_options;
    $selected_theme = '';
    $selected_plugin = '';
    if ($wccrps_options['wccrps_add_to_cart_btn_style'] == 'theme') {
        $selected_theme = 'selected';
    } else {
        $selected_plugin = 'selected';
    }
    ?>

    <select name="wccrps_options[wccrps_add_to_cart_btn_style]" id="wccrps_options[wccrps_add_to_cart_btn_style]">
        <option <?= $selected_theme ?> value="theme"><?php _e('Theme Style', 'wccrps'); ?></option>
        <option <?= $selected_plugin ?> value="plugin"><?php _e('Plugin Style', 'wccrps'); ?></option>
    </select>


    <?
}





function wccrps_rating_cb()
{
    global $wccrps_options;
    $selected_yes = '';
    $selected_no = '';
    if ($wccrps_options['wccrps_rating'] == 'yes') {
        $selected_yes = 'selected';
    } else {
        $selected_no = 'selected';
    }
    ?>

    <select name="wccrps_options[wccrps_rating]" id="wccrps_options[wccrps_rating]">
        <option <?= $selected_yes ?> value="yes"><?php _e('Yes', 'wccrps'); ?></option>
        <option <?= $selected_no ?> value="no"><?php _e('No', 'wccrps'); ?></option>
    </select>


    <?
}

function wccrps_price_cb()
{
    global $wccrps_options;
    $selected_yes = '';
    $selected_no = '';
    if ($wccrps_options['wccrps_price'] == 'yes') {
        $selected_yes = 'selected';
    } else {
        $selected_no = 'selected';
    }
    ?>

    <select name="wccrps_options[wccrps_price]" id="wccrps_options[wccrps_price]">
        <option <?= $selected_yes ?> value="yes"><?php _e('Yes', 'wccrps'); ?></option>
        <option <?= $selected_no ?> value="no"><?php _e('No', 'wccrps'); ?></option>
    </select>


    <?
}

function wccrps_prod_title_font_size_cb()
{
    global $wccrps_options;
    ?>
    <input type="number" name="wccrps_options[wccrps_prod_title_font_size]"
           id="wccrps_options[wccrps_prod_title_font_size]" min="0.1" max="100" step="0.1"
           value="<?= $wccrps_options['wccrps_prod_title_font_size'] ?>">

    <?
}

function wccrps_price_cart_font_size_cb()
{
    global $wccrps_options;
    ?>
    <input type="number" name="wccrps_options[wccrps_price_cart_font_size]"
           id="wccrps_options[wccrps_price_cart_font_size]" min="0.1" max="100" step="0.1"
           value="<?= $wccrps_options['wccrps_price_cart_font_size'] ?>">
    <?
}




function wccrps_default_rel_prods_cb()
{
    global $wccrps_options;
    $selected_def_custom_rp = '';
    $selected_def_default_rp = '';
    if ($wccrps_options['wccrps_default_rel_prods'] == 'def_custom_rp') {
        $selected_def_custom_rp = 'selected';
    } else {
        $selected_def_default_rp = 'selected';
    }
    ?>

    <select class="wccrps_default_rel_prods" name="wccrps_options[wccrps_default_rel_prods]" id="wccrps_default_rel_prods">
        <option id="def_custom_rp" <?= $selected_def_custom_rp ?>
                value="def_custom_rp"><?php _e('Custom Related Products', 'wccrps'); ?></option>
        <option id="def_default_rp" <?= $selected_def_default_rp ?>
                value="def_default_rp"><?php _e('Default Related Products', 'wccrps'); ?></option>
    </select>


    <?
}

function wccrps_use_slider_by_def_cb()
{
    global $wccrps_options;

    $selected_use_slider = '';
    $selected_dont_use_slider = '';

    if ($wccrps_options['wccrps_use_slider_by_def'] == 'yes') {
        $selected_use_slider = 'selected';
    } else {
        $selected_dont_use_slider = 'selected';
    }
    ?>

    <select name="wccrps_options[wccrps_use_slider_by_def]" id="wccrps_options[wccrps_use_slider_by_def]">
        <option id="wccrps_use_slider" <?= $selected_use_slider ?> value="yes"><?php _e('Yes', 'wccrps'); ?></option>
        <option id="wccrps_dont_use_slider" <?= $selected_dont_use_slider ?>
                value="no"><?php _e('No', 'wccrps'); ?></option>
    </select>


    <?
}



function wccrps_max_prods_cb()
{
    global $wccrps_options;
    ?>
    <input type="number" name="wccrps_options[wccrps_max_prods]" id="wccrps_options[wccrps_max_prods]" min="1" max="100"
           step="1" value="<?= $wccrps_options['wccrps_max_prods'] ?>">
    <?

}

function wccrps_number_of_columns_cb()
{
    global $wccrps_options;
    ?>
    <input type="number" name="wccrps_options[wccrps_number_of_columns]" id="wccrps_options[wccrps_number_of_columns]"
           min="1" max="100" step="1" value="<?= $wccrps_options['wccrps_number_of_columns'] ?>">
    <?
}

function wccrps_orderby_cb()
{
    global $wccrps_options;
    $selected_rand = '';
    $selected_orderby_asc_date = '';
    $selected_orderby_asc_title = '';
    $selected_orderby_desc_date = '';
    $selected_orderby_desc_title = '';

    if ($wccrps_options['wccrps_orderby'] == 'orderby_asc_date') {
        $selected_orderby_asc_date = 'selected';
    } elseif ($wccrps_options['wccrps_orderby'] == 'orderby_asc_title') {
        $selected_orderby_asc_title = 'selected';
    } elseif ($wccrps_options['wccrps_orderby'] == 'orderby_desc_date') {
        $selected_orderby_desc_date = 'selected';
    } elseif ($wccrps_options['wccrps_orderby'] == 'orderby_desc_title') {
        $selected_orderby_desc_title = 'selected';
    } else {
        $selected_rand = 'selected';
    }
    ?>

    <select name="wccrps_options[wccrps_orderby]" id="wccrps_options[wccrps_orderby]">
        <option <?= $selected_rand ?> value="rand"><?php _e('Random', 'wccrps'); ?></option>
        <option <?= $selected_orderby_desc_date ?>
            value="orderby_desc_date"><?php _e('By Date - Newest First', 'wccrps'); ?></option>
        <option <?= $selected_orderby_asc_date ?>
            value="orderby_asc_date"><?php _e('By Date - Oldest First', 'wccrps'); ?></option>
        <option <?= $selected_orderby_asc_title ?>
            value="orderby_asc_title"><?php _e('By Title - A-Z', 'wccrps'); ?></option>

        <option <?= $selected_orderby_desc_title ?>
            value="orderby_desc_title"><?php _e('By Title - Z-A', 'wccrps'); ?></option>
    </select>


    <?
}

function wccrps_placement_cb()
{
    global $wccrps_options;
    $selected_before_product_data_tabs = 'before_product_data_tabs';
    $selected_after_product_data_tabs = 'after_product_data_tabs';
    $selected_after_all_product_information = 'after_all_product_information';

    if ($wccrps_options['wccrps_placement'] == 'before_product_data_tabs') {
        $selected_before_product_data_tabs = 'selected';
    } elseif ($wccrps_options['wccrps_placement'] == 'after_product_data_tabs') {
        $selected_after_product_data_tabs = 'selected';
    } else{
        $selected_after_all_product_information = 'selected';
    }
    ?>

    <select name="wccrps_options[wccrps_placement]" id="wccrps_options[wccrps_placement]">
        <option <?= $selected_before_product_data_tabs ?> value="before_product_data_tabs"><?php _e('Before Product Data Tabs', 'wccrps'); ?></option>
        <option <?= $selected_after_product_data_tabs ?> value="after_product_data_tabs"><?php _e('After Product Data Tabs', 'wccrps'); ?></option>
        <option <?= $selected_after_all_product_information ?> value="selected_after_all_product_information"><?php _e('After All Product Information', 'wccrps'); ?></option>
    </select>


    <?
}


function wccrps_option_page()
{
    ?>
    <div class="wrap">
        <h2><? _e('Custom Related Products - Options Page', 'wccrps') ?></h2>
        <form action="options.php" method="post">

            <div id="wccrps-tabs-wrapper">
                <div id="wccrps-tabs">
                    <ul>
                        <li><a href="#fragment-1"><? _e('Main Settings', 'wccrps') ?></a></li>
                        <li><a href="#fragment-2"><? _e('Slider Settings', 'wccrps') ?></a></li>
                    </ul>
                    <div id="fragment-1">
                        <?
                        global $wp_settings_sections;

                        echo "<div class='wccrps-admin-tb'>";
                        echo "<h2>{$wp_settings_sections['wccrps-options-page']['wccrps_default_options_section']['title']}</h2>\n";
                        echo '<table class="form-table">';
                        do_settings_fields('wccrps-options-page', 'wccrps_default_options_section');
                        echo '</table>';
                        echo "</div>";

                        echo "<div class='wccrps-admin-tb'>";
                        echo "<h2>{$wp_settings_sections['wccrps-options-page']['wccrps_output_options_section']['title']}</h2>\n";
                        echo '<table class="form-table">';
                        do_settings_fields('wccrps-options-page', 'wccrps_output_options_section');
                        echo '</table>';
                        echo "</div>";
                        ?>
                    </div>
                    <div id="fragment-2">
                        <?
                        echo "<div class='wccrps-admin-tb'>";
                        echo "<h2>{$wp_settings_sections['wccrps-options-page']['wccrps_slider_settings_section']['title']}</h2>\n";
                        echo '<table class="form-table">';
                        do_settings_fields('wccrps-options-page', 'wccrps_slider_settings_section');
                        echo '</table>';
                        echo "</div>";
                        echo "<div class='wccrps-admin-tb'>";
                        echo "<h2>{$wp_settings_sections['wccrps-options-page']['wccrps_slider_styling_section']['title']}</h2>\n";
                        echo '<table class="form-table">';
                        do_settings_fields('wccrps-options-page', 'wccrps_slider_styling_section');
                        echo '</table>';
                        echo "</div>";
                        ?>
                    </div>
                </div>
            </div>
            <?php settings_fields('wccrps_options_group'); ?>
            <?php //do_settings_sections('wccrps-options-page'); 
            ?>
            <?php submit_button(); ?>
        </form>
    </div>
    <?
}



