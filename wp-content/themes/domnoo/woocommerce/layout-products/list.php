<?php
$product_item = isset($product_item) ? $product_item : 'list';
$woocommerce_loop['columns'] = $columns;
?>
<ul class="apus-products-list">
	<?php while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
		<?php wc_get_template_part( 'item-product/'.$product_item ); ?>
	<?php endwhile; ?>
</ul>
<?php wp_reset_postdata(); ?>