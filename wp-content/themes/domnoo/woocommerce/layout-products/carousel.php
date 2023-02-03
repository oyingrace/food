<?php
$product_item = isset($product_item) ? $product_item : 'inner';
$columns = isset($columns) ? $columns : 4;
?>
<div class="owl-carousel products <?php echo (!empty($related) && ($related == 'related') )? 'grid1' : ''; ?>" data-items="<?php echo esc_attr($columns); ?>" data-carousel="owl" data-medium="4" <?php if ($columns > 1 ) { ?> data-smallmedium="2" <?php } ?> data-extrasmall="1" data-pagination="false" data-nav="true">
    <?php while ( $loop->have_posts() ): $loop->the_post(); global $product; ?>
        <div class="item">
            <div class="products-grid product">
                <?php wc_get_template_part( 'item-product/'.$product_item ); ?>
            </div>
        </div>
    <?php endwhile; ?>
</div>
<?php wp_reset_postdata(); ?>