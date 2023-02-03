<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
?>
<?php $img = wp_get_attachment_image_src($image,'full'); ?>
<div class="widget widget-text-heading <?php echo esc_attr($el_class).' '.esc_attr($style); ?>">
    <?php if ( trim($sub_title)!='' ) { ?>
        <h4 class="sub_title">
            <?php echo trim( $sub_title ); ?>
        </h4>
    <?php } ?>
    <?php if ( trim($title)!='' ) { ?>
        <h3 class="title">
            <?php echo trim( $title ); ?>
        </h3>
    <?php } ?>
    <?php if ( !empty($img) && isset($img[0]) ): ?>
        <img src="<?php echo esc_url_raw($img[0]); ?>" alt="">
    <?php endif; ?>
    <?php if(wpb_js_remove_wpautop( $content, true )){ ?>
        <div class="description">
            <?php echo wpb_js_remove_wpautop( $content, true ); ?>
        </div>
    <?php } ?>
</div>