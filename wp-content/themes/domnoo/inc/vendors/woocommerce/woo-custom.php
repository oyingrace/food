<?php

if ( !class_exists("Domnoo_Woo_Custom") ) {
	class Domnoo_Woo_Custom {

		public static function init() {
			// brand
			$tax = domnoo_get_config( 'product_brand_attribute' );
			if ( !empty($tax) ) {
				add_filter( "manage_edit-{$tax}_columns", array( __CLASS__, 'brand_columns' ) );
				add_filter( "manage_{$tax}_custom_column", array( __CLASS__, 'brand_column' ), 10, 3 );
				add_action( "{$tax}_add_form_fields", array( __CLASS__, 'add_brand' ) );
				add_action( "{$tax}_edit_form_fields", array( __CLASS__, 'edit_brand' ) );
				add_action( 'create_term', array( __CLASS__, 'save_brand_image' )  );
				add_action( 'edit_term', array( __CLASS__, 'save_brand_image' ) );
			}
		}

		public static function orderby_list() {
			global $wp_query, $wp;
			// Base page URL
			$link = home_url( $wp->request );

			$output = '';
			
			if ( 1 != $wp_query->found_posts || woocommerce_products_will_display() ) {
				$output .= '<ul id="apus-product-sorting" class="apus-product-sorting">';
				
				$orderby = isset( $_GET['orderby'] ) ? wc_clean( $_GET['orderby'] ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
				$orderby == ( $orderby ===  'title' ) ? 'menu_order' : $orderby;
				
				$options = apply_filters( 'woocommerce_catalog_orderby', array(
					'menu_order'	=> esc_html__( 'Default', 'domnoo' ),
					'popularity' 	=> esc_html__( 'Popularity', 'domnoo' ),
					'rating'     	=> esc_html__( 'Average rating', 'domnoo' ),
					'date'       	=> esc_html__( 'Newness', 'domnoo' ),
					'price'      	=> esc_html__( 'Price: Low to High', 'domnoo' ),
					'price-desc'	=> esc_html__( 'Price: High to Low', 'domnoo' )
				) );
		
				if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' ) {
					unset( $options['rating'] );
				}
				
				// Unset query strings used for Ajax shop filters
				unset( $_GET['shop_load'] );
				unset( $_GET['_'] );
				
				if ( count( $_GET ) > 0 ) {
					$link .= '?';
					
					$i = 1; foreach ( $_GET as $key => $value ) {
						$link .= $key . '=' . $value . ($i != count( $_GET ) ? '&' : '');
					$i++; }
				}
				
	            foreach ( $options as $id => $name ) {
					if ( $orderby == $id ) {
						$output .= '<li class="active">' . esc_attr( $name ) . '</li>';
					} else {
						$link = add_query_arg( 'orderby', $id, $link );
						$output .= '<li><a href="' . esc_url( $link ) . '">' . esc_attr( $name ) . '</a></li>';
					}
	            }

	        	$output .= '</ul>';
			}

			return $output;
		}

		public static function add_brand() {
			?>
			<div class="form-field">
				<label><?php esc_html_e( 'Thumbnail', 'domnoo' ); ?></label>
				<?php self::brand_image_field(); ?>
			</div>
			<?php
		}

		public static function edit_brand( $term ) {
			$image = get_woocommerce_term_meta( $term->term_id, 'product_brand_image', true );
			?>
			<tr class="form-field">
				<th scope="row" valign="top"><label><?php esc_html_e( 'Thumbnail', 'domnoo' ); ?></label></th>
				<td>
					<?php self::brand_image_field($image); ?>
				</td>
			</tr>
			<?php
		}

		public static function brand_image_field( $image = '' ) {
			?>
			<div class="screenshot">
				<?php if ( $image ) { ?>
	                <img src="<?php echo esc_url($image); ?>" alt=""/>
	            <?php } ?>
			</div>
			<input type="hidden" id="product_brand_image" name="product_brand_image" value="<?php echo esc_attr( $image ); ?>" class="upload_image" />
			<div class="upload_image_action">
	            <input type="button" class="button add-image" value="<?php esc_html_e( 'Add', 'domnoo' ); ?>">
	            <input type="button" class="button remove-image" value="<?php esc_html_e( 'Remove', 'domnoo' ); ?>">
	        </div>
			<?php
		}

		public static function save_brand_image( $term_id ) {
			if ( isset($_POST['product_brand_image']) ) {
				update_woocommerce_term_meta( $term_id, 'product_brand_image', $_POST['product_brand_image'] );
			}
			delete_transient( 'wc_term_counts' );
		}

		public static function brand_columns( $columns ) {
			$new_columns = array();
			foreach ($columns as $key => $value) {
				if ( $key == 'name' ) {
					$new_columns['image'] = esc_html__( 'Image', 'domnoo' );
				}
				$new_columns[$key] = $value;
			}
			return $new_columns;
		}

		public static function brand_column( $columns, $column, $id ) {
			if ( $column == 'image' ) {
				$image = get_woocommerce_term_meta( $id, 'product_brand_image', true );
				$columns .= '<img style="max-width: 60px;" src="' . esc_url( $image ) . '" alt="'.esc_html__( 'Image', 'domnoo' ).'" class="wp-post-image" />';
			}

			return $columns;
		}

		public static function get_product_brands() {
		    global $product;
		    $brands_tax = domnoo_get_config( 'product_brand_attribute' );
		    $terms = get_the_terms( $product->get_id(), $brands_tax );
		    $brand_html = '';

		    if ( $terms && ! is_wp_error( $terms ) ) {
		    	$i = 0;
		        foreach ( $terms as $term ) {
		            $brand_html  .= '<a href="' . esc_url( get_term_link( $term ) ). '">' . esc_attr( $term->name ) . '</a>'.($i != count($terms - 1) ? ', ' : '');
		            $i++;
		        }
		    }
		    if ( ! empty( $brand_html ) ) { ?>
		        <div class="product-brand">
		            <?php echo wp_kses_post( $brand_html ); ?>
		        </div>
		    <?php }
		}

		public static function get_brands($number = 8) {
			$brands_tax = domnoo_get_config( 'product_brand_attribute' );
			$terms = array();
			if ( $brands_tax ) {
				$terms = get_terms( array(
				    'taxonomy' => $brands_tax,
				    'hide_empty' => true,
				    'number' => $number
				) );
			}
			return $terms;
		}
	}
	add_action( 'init', array('Domnoo_Woo_Custom', 'init') );
}