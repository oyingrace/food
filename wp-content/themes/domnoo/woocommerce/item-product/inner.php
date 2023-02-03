<?php 
global $product;

?>
<div class="product-block grid" data-product-id="<?php echo esc_attr($product->get_id()); ?>">
    <div class="grid-inner">
    <div class="block-inner">
        <figure class="image">
            <?php
                if ( function_exists('woocommerce_show_product_loop_sale_flash') ) {
                    woocommerce_show_product_loop_sale_flash();
                }
                $image_size = isset($image_size) ? $image_size : 'shop_catalog';
                domnoo_product_image($image_size);
            ?>
            
        </figure>
        <div class="groups-button clearfix">
            <?php
                if ( class_exists( 'YITH_WCWL' ) ) {
                    echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
                } elseif ( domnoo_is_woosw_activated() && get_option('woosw_button_position_archive') == "0" ) {
                    echo do_shortcode('[woosw]');
                }
            ?>
            
            <?php if (domnoo_get_config('show_quickview', true)) { ?>
                <div class="quick-view">
                    <a href="#" class="quickview" data-product_id="<?php echo esc_attr($product->get_id()); ?>" data-toggle="modal" data-target="#apus-quickview-modal">
                       <i class="ion-ios-search-strong"></i>
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="caption">
        <div class="meta">
            <h3 class="name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <div class="infor clearfix">
                <?php
                    /**
                    * woocommerce_after_shop_loop_item_title hook
                    *
                    * @hooked woocommerce_template_loop_rating - 5
                    * @hooked woocommerce_template_loop_price - 10
                    */
                    remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating',5);
                    do_action( 'woocommerce_after_shop_loop_item_title');
                ?>
                <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
            </div>
        </div>    
    </div>
    </div>
</div>