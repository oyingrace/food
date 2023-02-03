<?php
extract( $args );
extract( $instance );
$title = apply_filters('widget_title', $instance['title']);
?>
<div class="widget-about">
    <?php
    if ( $title ) {
        echo ($before_title)  . trim( $title ) . $after_title;
    }
    ?>
    <?php if ( $image ) { ?>
        <img src="<?php echo esc_attr( $image ); ?>" alt="">
    <?php } ?>
    <?php if ( $heading ) { ?>
        <h3 class="heading">
            <?php echo trim($heading); ?>
        </h3>
    <?php } ?>
    <?php if ( $description ) { ?>
        <div class="description">
            <?php echo trim($description); ?>
        </div>
    <?php } ?>
</div>