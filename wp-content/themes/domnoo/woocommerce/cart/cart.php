<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>
<div class="row">
	<div class="col-xs-12">
	<div class="widget right-30">

		<form action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">

		<?php do_action( 'woocommerce_before_cart_table' ); ?>

		<div class="table-responsive">

		<div class="cart">

				<?php do_action( 'woocommerce_before_cart_contents' ); ?>
				<div class="cart_item">
					<div class="media-left media-middle">
						<?php esc_html_e( 'Product Details', 'domnoo' ); ?>
					</div>
					<div class="media-body media-middle">
						<span class="transparent-color">
							<?php esc_html_e( 'removeaaaaa', 'domnoo' ); ?>
						</span>
					</div>
					<div class="media-body media-middle">
						<?php esc_html_e( 'Price', 'domnoo' ); ?>
					</div>
					<div class="media-body media-middle">
						<?php esc_html_e( 'Quantity', 'domnoo' ); ?>
					</div>
					<div class="media-body media-middle">
						<?php esc_html_e( 'Total', 'domnoo' ); ?>
					</div>
				</div>
				<?php
				foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
					$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
					$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

					if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
						?>
						<div class=" <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
						
							
							<div class="media-left media-middle">
								<div class="product-thumbnail media-left media-middle">
									<?php
										$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

										if ( ! $_product->is_visible() ) {
											echo trim($thumbnail);
										} else {
											printf( '<a href="%s">%s</a>', esc_url( $_product->get_permalink( $cart_item ) ), $thumbnail );
										}
									?>
								</div>
								<div class="content-left media-body media-middle">
									<div class="product-name">
										<?php
											if ( ! $_product->is_visible() ) {
												echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;';
											} else {
												echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s </a>', esc_url( $_product->get_permalink( $cart_item ) ), $_product->get_title() ), $cart_item, $cart_item_key );
											}

											// Meta data
											echo wc_get_formatted_cart_item_data( $cart_item );

											// Backorder notification
											if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
												echo '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'domnoo' ) . '</p>';
											}
										?>
									</div>
								</div>
							</div>
							<div class="media-body media-middle">
								<div class="product-remove">
									<?php
										echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
											'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">%s</a>',
											esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
											esc_html__( 'Remove this item', 'domnoo' ),
											esc_attr( $product_id ),
											esc_attr( $_product->get_sku() ),
											esc_html__( 'Remove', 'domnoo' )
										), $cart_item_key );
									?>
								</div>
							</div>
							<div class="media-body media-middle cart-price">
								<?php
									echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
								?>
							</div>
							<div class="media-body media-middle">
								<div class="product-quantity">
									<?php
										if ( $_product->is_sold_individually() ) {
											$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
										} else {
											$product_quantity = woocommerce_quantity_input( array(
												'input_name'  => "cart[{$cart_item_key}][qty]",
												'input_value' => $cart_item['quantity'],
												'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
												'min_value'   => '0'
											), $_product, false );
										}

										echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key );
									?>
								</div>
							</div>
							<div class="media-body media-middle cart-price">
								<div class="product-subtotal price">
									<?php
										echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
									?>
								</div>
							</div>
						</div>
						<?php
					}
				}

				do_action( 'woocommerce_cart_contents' );
				?>
				<tr>
					<td colspan="6" class="actions">
						<div class="clearfix">
							<?php if ( wc_coupons_enabled() ) { ?>
								<div class="coupon pull-left">
									<label for="coupon_code"><?php esc_html_e( 'Coupon', 'domnoo' ); ?>:</label> <input type="text" name="coupon_code" class="input-text " id="coupon_code" value="" placeholder="<?php esc_html_e( 'Coupon code', 'domnoo' ); ?>" /> <input type="submit" class="btn btn-white" name="apply_coupon" value="<?php esc_html_e( 'Apply Coupon', 'domnoo' ); ?>" />
									<?php do_action('woocommerce_cart_coupon'); ?>
								</div>
							<?php } ?>

							<div class="pull-right">
								<input type="submit" class="btn btn-white" name="update_cart" value="<?php esc_html_e( 'Update Cart', 'domnoo' ); ?>" />

						<?php do_action( 'woocommerce_cart_actions' ); ?>
								<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
							</div>
						</div>
					</td>
				</tr>

				<?php do_action( 'woocommerce_after_cart_contents' ); ?>
		</div>

		</div>

		<?php do_action( 'woocommerce_after_cart_table' ); ?>

		</form>
		</div>
	</div>
	<div class="col-xs-12">
		<div class="cart-collaterals widget">
			<?php do_action( 'woocommerce_theme_cart_collaterals' ); ?>
		</div>
	</div>
</div>
<?php do_action( 'woocommerce_after_cart' ); ?>
<div class="cart-collaterals widget related">
	<?php
		/**
		 * woocommerce_cart_collaterals hook.
		 *
		 * @hooked woocommerce_cross_sell_display
		 * @hooked woocommerce_cart_totals - 10
		 */
	 	do_action( 'woocommerce_cart_collaterals' );
	?>
</div>