<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$images = $images ? explode(',', $images) : array();
if ( !empty($images) ):
?>	
	<div class="widget widget-gallery <?php echo esc_attr($el_class.' '.$style);?>">
	    <?php if ($title!=''): ?>
	        <h3 class="widget-title">
	            <span><?php echo esc_attr( $title ); ?></span>
	        </h3>
	    <?php endif; ?>
	    <div class="widget-content">
	    	<div class="row">
				<?php foreach ($images as $image): ?>
					<?php $img = wp_get_attachment_image_src($image,'full'); ?>
					<?php if ( !empty($img) && isset($img[0]) ): ?>
						<div class="col-xs-12 col-sm-<?php echo (12/$columns); ?>">
							<div class="image">
								<a href="<?php echo esc_url_raw($img[0]); ?>" class="popup-image">
		                    		<img src="<?php echo esc_url_raw($img[0]); ?>" alt="">
		                    	</a>
	                    	</div>
                    	</div>
	                <?php endif; ?>
				<?php  endforeach; ?>
			</div>
		</div>
	</div>
<?php endif; ?>