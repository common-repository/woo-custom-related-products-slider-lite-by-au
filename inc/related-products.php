<?php
if (!function_exists('add_action')) {
    die('Silence is golden');
}
$wccrps_options = get_option('wccrps_options');

//Output on a product editing page in the admin area
add_action('woocommerce_product_options_related', 'wccrps_related_prods', 2);
function wccrps_related_prods()
{
    global $post;
    $selected_custom_rp = '';
    $selected_default_rp = '';
    $selected_use_slider = '';
    $selected_dont_use_slider = '';
    $selected_inherited_rp = '';
    $selected_inherited_use_slider = '';
    $wccrps_which_prods_use = get_post_meta($post->ID, '_wccrps_which_prods_use', true);
    $wccrps_use_slider = get_post_meta($post->ID, '_wccrps_use_slider', true);

    if ($wccrps_which_prods_use AND !empty($wccrps_which_prods_use)) {
        if ($wccrps_which_prods_use == 'custom_rp') {
            $selected_custom_rp = 'selected';
        } else {
            $selected_default_rp = 'selected';
        }
    } else {
        $selected_inherited_rp = 'selected';
    }


    if ($wccrps_use_slider AND !empty($wccrps_use_slider)) {
        if ($wccrps_use_slider == 'yes') {
            $selected_use_slider = 'selected';
        } else {
            $selected_dont_use_slider = 'selected';
        }
    } else {
        $selected_inherited_use_slider = 'selected';
    }
    ?>
    <p class="form-field">
        <label for="wccrps_which_prods_use"><?php _e('Custom Related Products', 'wccrps'); ?></label>
    </p>
    <p class="form-field">
        <label for="wccrps_which_prods_use"><?php _e('What to use', 'wccrps'); ?></label>
        <select style="width:100px;" name="wccrps_which_prods_use" id="wccrps_which_prods_use">
            <option id="inherited_rp" <?= $selected_inherited_rp ?>
                    value="inherited_rp"><?php _e('Inherited', 'wccrps'); ?></option>
            <option id="custom_rp" <?= $selected_custom_rp ?>
                    value="custom_rp"><?php _e('Custom Related Products', 'wccrps'); ?></option>
            <option id="default_rp" <?= $selected_default_rp ?>
                    value="default_rp"><?php _e('Default Related Products', 'wccrps'); ?></option>
        </select>

    </p>
    <p class="form-field">
        <label for="wccrps_enable_slider"><?php _e('Enable Slider', 'woocommerce'); ?></label>
        <select style="width:100px;" name="wccrps_enable_slider" id="wccrps_enable_slider">
            <option <?= $selected_inherited_use_slider ?>
                value="inherited"><?php _e('Inherited', 'wccrps'); ?></option>
            <option <?= $selected_use_slider ?> value="yes"><?php _e('Yes', 'wccrps'); ?></option>
            <option <?= $selected_dont_use_slider ?> value="no"><?php _e('No', 'wccrps'); ?></option>
        </select>
    </p>
    <!--
    <p class="form-field">
        <label for="wccrps_related_ids"><?php _e('Custom Related Products', 'wccrps'); ?></label>
        <input type="hidden" class="wc-product-search" style="width: 50%;" id="wccrps_related_ids"
               name="wccrps_related_ids"
               data-placeholder="<?php esc_attr_e('Search for a product&hellip;', 'wccrps'); ?>"
               data-action="woocommerce_json_search_products" data-multiple="true"
               data-exclude="<?php echo intval($post->ID); ?>" data-selected="<?php
    $product_ids = array_filter(array_map('absint', (array)get_post_meta($post->ID, '_wccrps_related_ids', true)));
    $json_ids = array();

    foreach ($product_ids as $product_id) {
        $product = wc_get_product($product_id);
        if (is_object($product)) {
            $json_ids[$product_id] = wp_kses_post(html_entity_decode($product->get_formatted_name(), ENT_QUOTES, get_bloginfo('charset')));
        }
    }

    echo esc_attr(json_encode($json_ids));
    ?>"
               value="<?php echo implode(',', array_keys($json_ids)); ?>"/> <?php
    if (function_exists('wc_help_tip')) {
        echo wc_help_tip(__('Custom Related Products are products which you promote in the related products area on a product detail page.', 'wccrps'));
    }
    ?>
    </p>
-->
    <?

    //For WC2.2 compatibility
    if (stripos(WC()->version, '2.2.') !== false OR stripos(WC()->version, '2.1.') !== false) {
        ?>
        <p class="form-field">
            <label for="wccrps_related_ids"><?php _e('Custom Related Products', 'woocommerce'); ?></label>

            <select id="wccrps_related_ids" name="wccrps_related_ids[]" class="ajax_chosen_select_products"
                    multiple="multiple" data-placeholder="<?php _e('Search for a product&hellip;', 'woocommerce'); ?>">
                <?php
                $crosssell_ids = get_post_meta($post->ID, '_wccrps_related_ids', true);
                $product_ids = !empty($crosssell_ids) ? array_map('absint', $crosssell_ids) : null;

                if ($product_ids) {

                    foreach ($product_ids as $product_id) {

                        $product = wc_get_product($product_id);

                        if ($product) {
                            echo '<option value="' . esc_attr($product_id) . '" selected="selected">' . esc_html($product->get_formatted_name()) . '</option>';
                        }
                    }
                }
                ?>
            </select>

            <img class="help_tip"
                 data-tip='<?php _e('Custom Related Products are products which you promote in the related products area on a product detail page.', 'woocommerce') ?>'
                 src="<?php echo WC()->plugin_url(); ?>/assets/images/help.png" height="16" width="16"/>
        </p>
        <?
    } else {
        ?>
        <p class="form-field">
            <label for="wccrps_related_ids"><?php _e('Custom Related Products', 'wccrps'); ?></label>

            <input type="hidden" class="wc-product-search" style="width: 50%;" id="wccrps_related_ids"
                   name="wccrps_related_ids"
                   data-placeholder="<?php esc_attr_e('Search for a product&hellip;', 'wccrps'); ?>"
                   data-action="woocommerce_json_search_products" data-multiple="true"
                   data-exclude="<?php echo intval($post->ID); ?>" data-selected="<?php
            $product_ids = array_filter(array_map('absint', (array)get_post_meta($post->ID, '_wccrps_related_ids', true)));
            $json_ids = array();

            foreach ($product_ids as $product_id) {
                $product = wc_get_product($product_id);
                if (is_object($product)) {
                    $json_ids[$product_id] = wp_kses_post(html_entity_decode($product->get_formatted_name(), ENT_QUOTES, get_bloginfo('charset')));
                }
            }

            echo esc_attr(json_encode($json_ids));
            ?>"
                   value="<?php echo implode(',', array_keys($json_ids)); ?>"/>


            <?php
            if (function_exists('wc_help_tip')) {
                echo wc_help_tip(__('Custom Related Products are products which you promote in the related products area on a product detail page.', 'wccrps'));
            }else{
                ?>
                <img class="help_tip"
                     data-tip='<?php _e('Custom Related Products are products which you promote in the related products area on a product detail page.', 'woocommerce') ?>'
                     src="<?php echo WC()->plugin_url(); ?>/assets/images/help.png" height="16" width="16"/>
                <?
            }
            ?>
        </p>
        <?
    }


}

// Save Fields
add_action('woocommerce_process_product_meta', 'wccrps_related_prods_fields_save');
function wccrps_related_prods_fields_save($post_id)
{

    $wccrps_which_prods_use = '';
    $wccrps_enable_slider = '';

    //$wccrps_related_ids = isset($_POST['wccrps_related_ids']) ? array_filter(array_map('intval', explode(',', $_POST['wccrps_related_ids']))) : array();

    //for WC2.2 compatibility
    if (isset($_POST['wccrps_related_ids'])) {
        if (is_array($_POST['wccrps_related_ids'])) {
            $wccrps_related_ids = array_filter(array_map('intval', $_POST['wccrps_related_ids']));
        } elseif (is_string($_POST['wccrps_related_ids'])) {
            $wccrps_related_ids = array_filter(array_map('intval', explode(',', $_POST['wccrps_related_ids'])));
        }
    } else {
        $wccrps_related_ids = array();
    }


    update_post_meta($post_id, '_wccrps_related_ids', $wccrps_related_ids);

    if (isset($_POST['wccrps_which_prods_use'])) {
        if ($_POST['wccrps_which_prods_use'] == 'custom_rp') {
            $wccrps_which_prods_use = 'custom_rp';
        } elseif ($_POST['wccrps_which_prods_use'] == 'default_rp') {
            $wccrps_which_prods_use = 'default_rp';
        } elseif ($_POST['wccrps_which_prods_use'] == 'inherited_rp') {
            $wccrps_which_prods_use = 'inherited_rp';
        }
    }

    if (!empty($wccrps_which_prods_use)) {
        if ($wccrps_which_prods_use != 'inherited_rp') {
            update_post_meta($post_id, '_wccrps_which_prods_use', $wccrps_which_prods_use);
        } else {
            delete_post_meta($post_id, '_wccrps_which_prods_use');
        }
    }


    if (isset($_POST['wccrps_enable_slider'])) {
        if ($_POST['wccrps_enable_slider'] == 'yes') {
            $wccrps_enable_slider = 'yes';
        } elseif ($_POST['wccrps_enable_slider'] == 'no') {
            $wccrps_enable_slider = 'no';
        } elseif ($_POST['wccrps_enable_slider'] == 'inherited') {
            $wccrps_enable_slider = 'inherited';
        }
    }
    if (!empty($wccrps_enable_slider)) {
        if ($wccrps_enable_slider != 'inherited') {
            update_post_meta($post_id, '_wccrps_use_slider', $wccrps_enable_slider);
        } else {
            delete_post_meta($post_id, '_wccrps_use_slider');
        }
    }

}


// Output on the frontend of a site
if ($wccrps_options['wccrps_placement'] == 'before_product_data_tabs') {
    add_action('woocommerce_after_single_product_summary', 'wccrps_prods_frontend', 9);
} elseif ($wccrps_options['wccrps_placement'] == 'after_product_data_tabs') {
    add_action('woocommerce_after_single_product_summary', 'wccrps_prods_frontend', 14);
} else {
    add_action('woocommerce_after_single_product_summary', 'wccrps_prods_frontend', 20);
}

function wccrps_prods_frontend()
{
    global $product, $woocommerce_loop, $wccrps_options;
    $columns = $wccrps_options['wccrps_number_of_columns'];
    $orderby = $wccrps_options['wccrps_orderby'];
    $order = null;

    //if NOT rand we need $order param for query
    if ($orderby != 'rand') {
        if ($orderby == 'orderby_asc_date') {
            $orderby = 'date';
            $order = 'ASC';
        } elseif ($orderby == 'orderby_asc_title') {
            $orderby = 'title';
            $order = 'ASC';
        } elseif ($orderby == 'orderby_desc_date') {
            $orderby = 'date';
            $order = 'DESC';
        } elseif ($orderby == 'orderby_desc_title') {
            $orderby = 'title';
            $order = 'DESC';
        }
    }


    $wccrps_which_prods_use = get_post_meta($product->id, '_wccrps_which_prods_use', true);
    $wccrps_use_slider = get_post_meta($product->id, '_wccrps_use_slider', true);


    //if we are NOT using slider then we request in a query number of products equals to number of columns
    if ($wccrps_use_slider AND !empty($wccrps_use_slider)) {
        if ($wccrps_use_slider == 'yes') {
            $posts_per_page = $wccrps_options['wccrps_max_prods'];
        } else {
            $posts_per_page = $columns;
        }
    } else {
        if ($wccrps_options['wccrps_use_slider_by_def'] == 'yes') {
            $posts_per_page = $wccrps_options['wccrps_max_prods'];
        } else {
            $posts_per_page = $columns;
        }
    }


    //check if a current product has it's own parameter(selected on a single product EDIT page) of what related products to output - custom or default, or default with a custom selected products that will come first.
    if ($wccrps_which_prods_use AND !empty($wccrps_which_prods_use)) {
        if ($wccrps_which_prods_use == 'custom_rp') {
            $products = wccrps_custom_related_prods_frontend($posts_per_page, $orderby, $order);
        } else {
            $products = wccrps_default_rel_prods_frontend($posts_per_page, $orderby, $order);
        }
    } else {
        if ($wccrps_options['wccrps_default_rel_prods'] == 'def_custom_rp') {
            $products = wccrps_custom_related_prods_frontend($posts_per_page, $orderby, $order);
        } else {
            $products = wccrps_default_rel_prods_frontend($posts_per_page, $orderby, $order);
        }
    }

    $woocommerce_loop['columns'] = $columns;
    //loop
    if ($products) {
        //print_r($products);
//        echo $posts_per_page.'<br> ____________________ <br>';
//        //$products->post_count = 12;
//        if(is_array($products->posts)){
//            foreach ($products->posts as $my_post){
//                echo $my_post->ID.'<br>';
//            }
//        }


        if ($products->have_posts()) : ?>
		
			<div class="wccrps_related_main_wrapper">
				<h2><?php _e('Related Products', 'wccrps') ?></h2>

				<div class="wccrps_related_ids">
					<?php

					//check if we'r using a slider
					if ($wccrps_use_slider AND !empty($wccrps_use_slider)) {
						if ($wccrps_use_slider == 'yes') {
							wccrps_slider_style($products);
						} else {
							wccrps_default_style($products);
						}
					} else {
						if ($wccrps_options['wccrps_use_slider_by_def'] == 'yes') {
							wccrps_slider_style($products);
						} else {
							wccrps_default_style($products);
						}
					}

					?>
				</div>
            </div>

        <?php endif;
        //print_r($products);
    }
    wp_reset_postdata();
}

function wccrps_default_rel_prods_frontend($posts_per_page, $orderby, $order = null)
{

    global $product;

    if (empty($product) || !$product->exists()) {
        return;
    }

    if ($orderby == 'rand') {

        $related = $product->get_related($posts_per_page);

        if (sizeof($related) === 0) return;

        $args = apply_filters('woocommerce_related_products_args', array(
            'post_type' => 'product',
            'ignore_sticky_posts' => 1,
            'no_found_rows' => 1,
            'posts_per_page' => $posts_per_page,
            'orderby' => $orderby,
            'post__in' => $related,
            'post__not_in' => array($product->id)
        ));

    } else {

        $related = override_WC_Product_get_related($posts_per_page);

        if (sizeof($related) === 0) return;

        $args = apply_filters('woocommerce_related_products_args', array(
            'post_type' => 'product',
            'ignore_sticky_posts' => 1,
            'no_found_rows' => 1,
            'posts_per_page' => $posts_per_page,
            'orderby' => $orderby,
            'order' => $order,
            'post__in' => $related,
            'post__not_in' => array($product->id)
        ));
    }


    $products = new WP_Query($args);

    return $products;
}

function wccrps_custom_related_prods_frontend($posts_per_page, $orderby, $order = null)
{

    global $product;
    $related_ids = maybe_unserialize(get_post_meta($product->id, '_wccrps_related_ids', 1));


    if (empty($related_ids)) {
        return;
    }

    $meta_query = WC()->query->get_meta_query();


    if ($orderby == 'rand') {
        $args = array(
            'post_type' => 'product',
            'ignore_sticky_posts' => 1,
            'no_found_rows' => 1,
            'posts_per_page' => $posts_per_page,
            'orderby' => $orderby,
            'post__in' => $related_ids,
            'post__not_in' => array($product->id),
            'meta_query' => $meta_query
        );
    } else {
        $args = array(
            'post_type' => 'product',
            'ignore_sticky_posts' => 1,
            'no_found_rows' => 1,
            'posts_per_page' => $posts_per_page,
            'orderby' => $orderby,
            'order' => $order,
            'post__in' => $related_ids,
            'post__not_in' => array($product->id),
            'meta_query' => $meta_query
        );
    }

    $products = new WP_Query($args);


    return $products;
}

function wccrps_default_style($products)
{


    woocommerce_product_loop_start();

    while ($products->have_posts()) : $products->the_post();

        wc_get_template_part('content', 'product');

    endwhile; // end of the loop.

    woocommerce_product_loop_end();

}

function wccrps_slider_style($products)
{
    ?>
    <div id="wccrps-owl-ids">
        <?
        global $wccrps_options;
        while ($products->have_posts()) : $products->the_post();
            global $post, $product;
            $price = $product->get_price_html();


            if ($wccrps_options['wccrps_slide_style'] == 'default') {
                ?>

                <div class="wccrps-product default <?php echo implode(get_post_class(), " ") ?>">

                    <?php
                    if ($product->is_on_sale() AND $wccrps_options['wccrps_onsale_marker'] == 'yes') {
                        echo apply_filters('wccrps_sale_flash', '<span class="wccrps_is_onsale onsale">' . __('Sale!', 'wccrps') . '</span>', $post, $product);
                    }
                    ?>
                    <a href="<?php the_permalink(); ?>"
                       class="wccrps-img"><?php echo woocommerce_get_product_thumbnail(); ?></a>
                    <div class="wccrps-overlay"></div>
                    <div class="wccrps-prod-capt">

                        <div class="wccrps-prod-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </div>

                        <?php
                        if ($wccrps_options['wccrps_price'] == 'yes') {
                            echo($price ? '<div class="wccrps-price">' . $price . '</div>' : '');
                        }
                        ?>
                        <? if ($wccrps_options['wccrps_rating'] == 'yes') { ?>
                            <div class="wccrps-rating">
                                <? woocommerce_template_loop_rating(); ?>
                            </div>
                            <?
                        } ?>

                        <? if ($wccrps_options['wccrps_add_to_cart_btn'] == 'yes') { ?>
                            <div class="wccrps-add-to-cart">
                                <?php woocommerce_template_loop_add_to_cart(); ?>
                            </div>
                            <?
                        } ?>

                    </div>
                </div>
                <?
            } else {

                if ($wccrps_options['wccrps_slide_style'] == 'hover1') {
                    $hovereffect = 'hovereffect-1';
                } else {
                    $hovereffect = 'hovereffect-2';
                } 


                ?>

                <div
                    class="wccrps-product <?= $hovereffect ?> hovereffect <?php echo implode(get_post_class(), " ") ?>">

                    <?php
                    if ($product->is_on_sale() AND $wccrps_options['wccrps_onsale_marker'] == 'yes') {
                        echo apply_filters('wccrps_sale_flash', '<span class="wccrps_is_onsale onsale">' . __('Sale!', 'wccrps') . '</span>', $post, $product);
                    }
                    ?>
                    <div class="wccrpsss-img"></div>
                    <a href="<?php the_permalink(); ?>"
                       class="wccrps-img"><?php echo woocommerce_get_product_thumbnail(); ?></a>

                    <div class="wccrps-prod-capt overlay">

                        <div class="wccrps-prod-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </div>

                        <?php
                        if ($wccrps_options['wccrps_price'] == 'yes') {
                            echo($price ? '<div class="wccrps-price">' . $price . '</div>' : '');
                        }
                        ?>

                        <? if ($wccrps_options['wccrps_rating'] == 'yes') { ?>
                            <div class="wccrps-rating">
                                <? woocommerce_template_loop_rating(); ?>
                            </div>
                            <?
                        } ?>

                        <? if ($wccrps_options['wccrps_add_to_cart_btn'] == 'yes') {
                            if  ($wccrps_options['wccrps_add_to_cart_btn_style'] == 'plugin'){
                                ?>
                                <div class="wccrps-add-to-cart">
                                    <?
                                    echo sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="wccrps-btn">%s</a>',
                                        esc_url( $product->add_to_cart_url() ),
                                        esc_attr( isset( $quantity ) ? $quantity : 1 ),
                                        esc_attr( $product->id ),
                                        esc_attr( $product->get_sku() ),
                                        esc_html( $product->add_to_cart_text() )
                                    );
                                    ?>
                                </div>
                                <?

                            }else{
                                ?>
                                <div class="wccrps-add-to-cart">
                                    <?php woocommerce_template_loop_add_to_cart(); ?>
                                </div>
                                <?
                            }

                        } ?>
                    </div>
                </div>
                <?
            }
        endwhile; // end of the loop.

        ?>
    </div>
    <script>
        jQuery(document).ready(function ($) {

            var owl = $("#wccrps-owl-ids");

            owl.owlCarousel({
                items: <?=$wccrps_options['wccrps_number_of_columns']?>, //10 items above 1000px browser width
                itemsDesktop: [1100, 3],
                itemsDesktopSmall: [900, 2], // betweem 900px and 601px
                itemsTablet: [500, 2], //2 items between 500 and 0
                itemsMobile: false, // itemsMobile disabled - inherit from itemsTablet option


                autoPlay: <?=$wccrps_options['wccrps_slide_speed']?>,
                <?
                if ($wccrps_options['wccrps_navigation'] == 'yes'){
                ?>
                navigation: true,
                <?
                }else{
                ?>
                navigation: false,
                <?
                }
                ?>
                <?
                if ($wccrps_options['wccrps_pagination'] == 'yes'){
                ?>
                pagination: true,
                <?
                }else{
                ?>
                pagination: false,
                <?
                }
                ?>

                slideSpeed: 400,
                paginationSpeed: 800,
                rewindSpeed: 800,
                stopOnHover: true,
                navigationText: ["<div class='dashicons dashicons-arrow-left-alt2'></div>", "<div class='dashicons dashicons-arrow-right-alt2'></div>"]
            });
        });
    </script>

    <?

}


function override_WC_Product_get_related($posts_per_page)
{
    //$related = $product->get_related( $posts_per_page );
    /* Start  WC_Product->get_related($posts_per_page)*/
    global $wpdb;
    global $product;
    $limit = $posts_per_page;

    $transient_name = 'wc_related_' . $product->id;
    $related_posts = get_transient($transient_name);

    // We want to query related posts if they are not cached, or we don't have enough
    if (false === $related_posts || sizeof($related_posts) < $limit) {
        // Related products are found from category and tag


        //$tags_array = $product->get_related_terms( 'product_tag' );
        //$cats_array = $product->get_related_terms( 'product_cat' );
        /* Start  WC_Product->get_related_terms()*/
        $terms_array = array(0);
        $term = 'product_tag';
        $terms = apply_filters('woocommerce_get_related_' . $term . '_terms', wp_get_post_terms($product->id, $term), $product->id);
        foreach ($terms as $term) {
            $terms_array[] = $term->term_id;
        }

        $tags_array = array_map('absint', $terms_array);
        /* END  WC_Product->get_related_terms()*/

        /* Start  WC_Product->get_related_terms()*/
        $terms_array = array(0);
        $term = 'product_cat';
        $terms = apply_filters('woocommerce_get_related_' . $term . '_terms', wp_get_post_terms($product->id, $term), $product->id);
        foreach ($terms as $term) {
            $terms_array[] = $term->term_id;
        }

        $cats_array = array_map('absint', $terms_array);
        /* END  WC_Product->get_related_terms()*/


        // Don't bother if none are set
        if (1 === sizeof($cats_array) && 1 === sizeof($tags_array)) {
            $related_posts = array();
        } else {
            // Sanitize
            $exclude_ids = array_map('absint', array_merge(array(0, $product->id), $product->get_upsells()));

            // CHANGED TO NO RAND!!!  (Generate query - but query an extra 10 results to give the appearance of random results)


            //$query = $product->build_related_query( $cats_array, $tags_array, $exclude_ids, $limit );

            /* Start  WC_Product->build_related_query()*/

            function wccrps_build_related_query($cats_array, $tags_array, $exclude_ids, $limit)
            {
                global $wpdb;
                global $product;

                $limit = absint($limit);

                $query = array();
                $query['fields'] = "SELECT DISTINCT ID FROM {$wpdb->posts} p";
                $query['join'] = " INNER JOIN {$wpdb->postmeta} pm ON ( pm.post_id = p.ID AND pm.meta_key='_visibility' )";
                $query['join'] .= " INNER JOIN {$wpdb->term_relationships} tr ON (p.ID = tr.object_id)";
                $query['join'] .= " INNER JOIN {$wpdb->term_taxonomy} tt ON (tr.term_taxonomy_id = tt.term_taxonomy_id)";
                $query['join'] .= " INNER JOIN {$wpdb->terms} t ON (t.term_id = tt.term_id)";

                if (get_option('woocommerce_hide_out_of_stock_items') === 'yes') {
                    $query['join'] .= " INNER JOIN {$wpdb->postmeta} pm2 ON ( pm2.post_id = p.ID AND pm2.meta_key='_stock_status' )";
                }

                $query['where'] = " WHERE 1=1";
                $query['where'] .= " AND p.post_status = 'publish'";
                $query['where'] .= " AND p.post_type = 'product'";
                $query['where'] .= " AND p.ID NOT IN ( " . implode(',', $exclude_ids) . " )";
                $query['where'] .= " AND pm.meta_value IN ( 'visible', 'catalog' )";

                if (get_option('woocommerce_hide_out_of_stock_items') === 'yes') {
                    $query['where'] .= " AND pm2.meta_value = 'instock'";
                }

                if (apply_filters('woocommerce_product_related_posts_relate_by_category', true, $product->id)) {
                    $query['where'] .= " AND ( tt.taxonomy = 'product_cat' AND t.term_id IN ( " . implode(',', $cats_array) . " ) )";
                    $andor = 'OR';
                } else {
                    $andor = 'AND';
                }

                // when query is OR - need to check against excluded ids again
                if (apply_filters('woocommerce_product_related_posts_relate_by_tag', true, $product->id)) {
                    $query['where'] .= " {$andor} ( ( tt.taxonomy = 'product_tag' AND t.term_id IN ( " . implode(',', $tags_array) . " ) )";
                    $query['where'] .= " AND p.ID NOT IN ( " . implode(',', $exclude_ids) . " ) )";
                }

                $query['limits'] = " LIMIT {$limit} ";
                $query = apply_filters('woocommerce_product_related_posts_query', $query, $product->id);

                return $query;
            }

            $query = wccrps_build_related_query($cats_array, $tags_array, $exclude_ids, $limit);

            /* End  WC_Product->build_related_query()*/


            // Get the posts
            $related_posts = $wpdb->get_col(implode(' ', $query));
        }

        set_transient($transient_name, $related_posts, DAY_IN_SECONDS);
    }

    // DO NOT Randomise the results
    //shuffle( $related_posts );

    // Limit the returned results
    $related = array_slice($related_posts, 0, $limit);
    return $related;

    /* END  WC_Product->get_related($posts_per_page)*/
}
