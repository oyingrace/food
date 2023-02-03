<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$bcol = 12/$columns;

if($columns == 5) $bcol='c5';

if ( !class_exists('Domnoo_Woo_Custom') ) {
	return;
}
$brands = Domnoo_Woo_Custom::get_brands($number);
?>
<div class="widget-brands <?php echo esc_attr($el_class); ?>">
    <?php if ($title!=''): ?>
        <h3 class="widget-title text-center">
            <span><?php echo esc_attr( $title ); ?></span>
            <?php if ( isset($subtitle) && $subtitle ): ?>
                <span class="subtitle"><?php echo esc_html($subtitle); ?></span>
            <?php endif; ?>
        </h3>
    <?php endif; ?>
    <div class="widget-content">
    	<?php if ( !empty($brands) && count($brands) > 0 ): ?>
    		<?php if ( $layout_type == 'carousel' ): ?>
    			<div class="owl-carousel products" data-items="<?php echo esc_attr($columns); ?>" data-smallmedium="2" data-extrasmall="1" data-carousel="owl" data-pagination="false" data-nav="true">
		    		<?php $count=0; foreach ($brands as $brand) { ?>
    					<div class="item-wrapper">
							<a href="<?php echo esc_url( get_term_link( $brand ) ); ?>">
								<?php
								$image = get_woocommerce_term_meta( $brand->term_id, 'product_brand_image', true );
								?>
								<img src="<?php echo esc_url( $image ); ?>" alt="" />
							</a>
						</div>
		    		<?php $count++; } ?>
	    		</div>
	    	<?php else: ?>
	    		<div class="row no-margin">
		    		<?php $count=1; foreach ($brands as $brand) { ?>
    					<div class="item col-md-<?php echo esc_attr($bcol); ?> col-xs-6 <?php if($count%$columns == 1) echo 'first-child'; if($count%$columns == 0) echo 'last-child'; ?>">
							<a href="<?php echo esc_url( get_term_link( $brand ) ); ?>">
								<?php
								$image = get_woocommerce_term_meta( $brand->term_id, 'product_brand_image', true );
								?>
								<img src="<?php echo esc_url( $image ); ?>" alt="" />
							</a>
						</div>
		    		<?php $count++; } ?>
	    		</div>
	    	<?php endif; ?>
    	<?php endif; ?>
    </div>
</div>