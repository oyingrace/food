<?php   global $woocommerce; ?>
<div class="apus-topcart">
    <div id="cart" class="p-relative">
        <a class="dropdown-toggle mini-cart" data-toggle="dropdown" aria-expanded="true" role="button" aria-haspopup="true" data-delay="0" href="#" title="<?php esc_html_e('View your shopping cart', 'domnoo'); ?>">
            <span class="text-skin cart-icon">
            	<span class="count"><?php echo sprintf($woocommerce->cart->cart_contents_count); ?></span>
                <i class="ion-bag"></i>
            </span>
        </a>            
        <div class="dropdown-menu dropdown-menu-right"><div class="widget_shopping_cart_content">
            <?php woocommerce_mini_cart(); ?>
        </div></div>
    </div>
</div>