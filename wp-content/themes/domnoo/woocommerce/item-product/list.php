<?php global $product; ?>
<li class="media product-block widget-product ">
	<div class="media-left">
		<a href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>" class="image">
			<?php domnoo_product_get_image(); ?>
		</a>
	</div>
	<div class="media-body">
		<div class="rating clearfix">
			<?php
            	if($rating_html = wc_get_rating_html( $product->get_average_rating() )){
            		echo trim( wc_get_rating_html( $product->get_average_rating() ) );

            	}else{
            		echo '<div class="star-rating"></div>';
            	}
        	?>
	    </div>
		<h3 class="name">
			<a href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>"><?php echo trim( $product->get_title() ); ?></a>
		</h3>
		<div class="price"><?php echo ($product->get_price_html()); ?></div>
	</div>
</li>