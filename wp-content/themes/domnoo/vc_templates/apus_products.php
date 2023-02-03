<?php

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if ( !empty($categories) ) {
	$categories = array_map('trim', explode(',', $categories));
} else {
	$categories = array();
}

$loop = domnoo_get_products( $categories, $type, 1, $number );
if ( $loop->have_posts() ) {
	?>
	<div class="widget widget-products woocommerce  <?php echo esc_attr($el_class); ?>">
		<?php wc_get_template( 'layout-products/'.$layout_type.'.php' , array( 'loop' => $loop, 'columns' => $columns) ); ?>
	</div>
	<?php
}