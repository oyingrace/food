<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
$sidebar_configs = domnoo_get_woocommerce_layout_configs();

$display_mode = domnoo_woocommerce_get_display_mode();
$layout_type = $display_mode;

?>


<div id="main-container">
	<?php do_action( 'domnoo_woo_template_main_before' ); ?>

	<?php if ( domnoo_get_config('product_archive_top_sidebar', true) ) : ?>
		<!-- header for full -->
		<?php
			get_template_part( 'woocommerce/content-shop_header' );
			
			remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
			remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
			remove_action( 'woocommerce_before_shop_loop', 'domnoo_filter_before' , 1 );
			remove_action( 'woocommerce_before_shop_loop', 'domnoo_filter_after' , 40 );
			remove_action( 'woocommerce_before_shop_loop', 'domnoo_woocommerce_display_modes' , 2 );
		?>
	<?php endif; ?>
	
	<section class="<?php echo apply_filters('domnoo_woocommerce_content_class', 'container');?>">
		
		<div class="row">
			<?php if ( isset($sidebar_configs['left']) ) : ?>
				<div class="<?php echo esc_attr($sidebar_configs['left']['class']) ;?>">
				  	<aside class="sidebar sidebar-left" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
				   		<?php if ( is_active_sidebar( $sidebar_configs['left']['sidebar'] ) ): ?>
					   		<?php dynamic_sidebar( $sidebar_configs['left']['sidebar'] ); ?>
					   	<?php endif; ?>
				  	</aside>
				</div>
			<?php endif; ?>

			<div id="main-content" class="archive-shop col-xs-12 <?php echo esc_attr($sidebar_configs['main']['class']); ?>">

				<div id="primary" class="content-area">
					<div id="content" class="site-content" role="main">

						<div id="apus-shop-products-wrapper" class="apus-shop-products-wrapper" data-layout_type="<?php echo esc_attr($layout_type); ?>">
							<?php
	                            // Results bar/button
	                            get_template_part( 'woocommerce/content-shop_results_bar' );
	                        ?>

	                        <!-- product content -->
							<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
								<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>
							<?php endif; ?>

							<?php do_action( 'woocommerce_archive_description' ); ?>

							<?php if ( have_posts() ) : ?>

								<?php do_action( 'woocommerce_before_shop_loop' ); ?>

								<?php woocommerce_product_loop_start(); ?>
									
									<?php woocommerce_product_subcategories( array( 'before' => '<div class="row subcategories-wrapper">', 'after' => '</div>' ) ); ?>
									
									<?php
										
										$attr = 'class="products-wrapper-'.esc_attr($display_mode).'"';
										
									?>
									<div <?php echo trim($attr); ?>>
										<div class="row">
											<?php while ( have_posts() ) : the_post(); ?>
												<?php wc_get_template_part( 'content', 'product' ); ?>
											<?php endwhile; // end of the loop. ?>
										</div>
									</div>

								<?php woocommerce_product_loop_end(); ?>

								<?php do_action( 'woocommerce_after_shop_loop' ); ?>

							<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>
								<?php do_action( 'woocommerce_no_products_found' ); ?>
							<?php endif; ?>


						</div>
					</div><!-- #content -->
				</div><!-- #primary -->
			</div><!-- #main-content -->
			<?php if ( isset($sidebar_configs['right']) ) : ?>
				<div class="<?php echo esc_attr($sidebar_configs['right']['class']) ;?>">
				  	<aside class="sidebar sidebar-right" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
				   		<?php if ( is_active_sidebar( $sidebar_configs['right']['sidebar'] ) ): ?>
					   		<?php dynamic_sidebar( $sidebar_configs['right']['sidebar'] ); ?>
					   	<?php endif; ?>
				  	</aside>
				</div>
			<?php endif; ?>
			
		</div>

	</section>

	<section class="container">
		<?php do_action('domnoo_woocommerce_archive_description'); ?>
	</section>
</div>
<?php

get_footer();
