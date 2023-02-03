<?php
extract( $args );
extract( $instance );
$title = apply_filters('widget_title', $instance['title']);
?>
<div class="single-image">
	<?php
	if ( $title ) {
	    echo ($before_title)  . trim( $title ) . $after_title;
	}
	?>
	<?php if ( $single_image ) { ?>
		<img src="<?php echo esc_attr( $single_image ); ?>" alt="<?php echo esc_attr($alt); ?>">
	<?php } ?>

	<?php if ( $description ) { ?>
		<div class="description">
			<?php echo trim($description); ?>
		</div>
	<?php } ?>
</div>