<?php
$ajax = isset($ajax) && $ajax ? true : false;
if ( !$ajax ) {
wp_enqueue_script( 'isotope-pkgd', get_template_directory_uri().'/js/isotope.pkgd.min.js', array( 'jquery' ) );
?>
<div class="mansory-wrapper isotope-items" data-isotope-duration="400" data-columnwidth=".col-sm-3">
	<div class="row-products grid-style-1 row">
<?php } ?>
	
		<?php $count = 0; while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
			<?php if ( in_array($count%10, array(0,5,8,9)) ) { ?>
				<div class="col-sm-6 isotope-item">
					<?php wc_get_template( 'item-product/inner.php', array('image_size' => 'domnoo-shop-horizontal') ); ?>
				</div>
			<?php } elseif ( in_array($count%10, array(1,4)) ) { ?>
				<div class="col-sm-6 isotope-item">
					<?php wc_get_template( 'item-product/inner.php', array('image_size' => 'domnoo-shop-vertical') ); ?>
				</div>
			<?php } elseif ( in_array($count%10, array(2,3,6,7)) ) { ?>
				<div class="col-sm-3 isotope-item">
					<?php wc_get_template( 'item-product/inner.php' ); ?>
				</div>
			<?php } ?>
		<?php $count++; endwhile; ?>
		<?php wp_reset_postdata(); ?>

<?php if ( !$ajax ) { ?>
	</div>
</div>
<?php }