<?php  global $woocommerce; ?>
<div class="apus-topcart">
    <div id="cart" class="dropdown version-1">
        <a class="dropdown-toggle mini-cart" data-toggle="dropdown" aria-expanded="true" role="button" aria-haspopup="true" data-delay="0" href="#" title="<?php esc_html_e('View your shopping cart', 'domnoo'); ?>">
            <i class="ion-bag"></i>
			<?php echo sprintf(_n(' <span class="mini-cart-items"> %d item - </span> ', ' <span class="mini-cart-items"> %d items - </span> ', $woocommerce->cart->cart_contents_count, 'domnoo'), $woocommerce->cart->cart_contents_count);?> <?php echo trim( $woocommerce->cart->get_cart_total() ); ?>        </a>      
        <div class="dropdown-menu dropdown-menu-right"><div class="widget_shopping_cart_content">
            <?php woocommerce_mini_cart(); ?>
        </div></div>
    </div>
</div>