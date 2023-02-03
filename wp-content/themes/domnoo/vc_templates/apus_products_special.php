<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if ( empty($products) ) {
	return;
}
$products = array_map('trim', explode(',', $products));

$loop = domnoo_get_products( array(), '', 1, -1, '', '', $products );
$img = wp_get_attachment_image_src($image,'full');
if ( $loop->have_posts() ) {
?>
	<div class="widget widget-products-special <?php echo esc_attr($el_class); ?>">
		<div class="row">
			<div class="col-sm-5">
				<?php if ( trim($sub_title)!='' ) { ?>
			        <h4 class="sub_title text-theme">
			            <?php echo trim( $sub_title ); ?>
			        </h4>
			    <?php } ?>
			    <?php if ( trim($title)!='' ) { ?>
			        <h3 class="title">
			            <?php echo trim( $title ); ?>
			        </h3>
			    <?php } ?>
			    <?php if(wpb_js_remove_wpautop( $content, true )){ ?>
			        <div class="description">
			            <?php echo wpb_js_remove_wpautop( $content, true ); ?>
			        </div>
			    <?php } ?>
			    <div class="products-thumb">
			    	<?php while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
						<div class="product-thumb-item">
							<?php domnoo_product_image('full'); ?>
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
						</div>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
			    </div>
			</div>
			<div class="col-sm-1 hidden-xs">
			</div>
			<div class="col-sm-6">
				<div class="content-right">
				    <?php if ( !empty($img) && isset($img[0]) ): ?>
				        <img class="label-special" src="<?php echo esc_url_raw($img[0]); ?>" alt="">
				    <?php endif; ?>
					<?php wc_get_template( 'layout-products/carousel.php' , array( 'loop' => $loop, 'columns' => 1 ) ); ?>
				</div>
			</div>
		</div>
	</div>
<?php } ?>