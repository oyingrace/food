<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
?>
<div class="widget-video">
	<?php if ($title!=''): ?>
        <h3 class="widget-title">
            <span><?php echo trim($title); ?></span>
        </h3>
    <?php endif; ?>
    <div class="video-wrapper-inner <?php echo ( !empty($image_bg) && isset($image_bg[0]) )?'has-bg':''; ?>">
        <?php $image_bg = wp_get_attachment_image_src($image_bg,'full'); ?>
        <?php if ( !empty($image_bg) && isset($image_bg[0]) ): ?>
            <div class="bg-image">
                <img src="<?php echo esc_url_raw($image_bg[0]); ?>" alt="">
            </div>
        <?php endif; ?>
    	<div class="video">
            <?php if(wpb_js_remove_wpautop( $content, true )){ ?>
                <div class="description">
                    <?php echo wpb_js_remove_wpautop( $content, true ); ?>
                </div>
            <?php } ?>
            <?php $img = wp_get_attachment_image_src($image,'full'); ?>
    		<?php if ( !empty($img) && isset($img[0]) ): ?>
    			<a class="popup-video" href="<?php echo esc_url_raw($video_link); ?>">
            		<img src="<?php echo esc_url_raw($img[0]); ?>" alt="">
            	</a>
            <?php endif; ?>
    	</div>
	</div>
</div>