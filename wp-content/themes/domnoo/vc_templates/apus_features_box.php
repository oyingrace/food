<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$items = (array) vc_param_group_parse_atts( $items );
if ( !empty($items) ):
$count = 0;
?>
	<div class="widget widget-features-box <?php echo esc_attr($el_class); ?> <?php echo esc_attr($style); ?>">
		<?php if ($title!=''): ?>
        <h3 class="widget-title">
            <span><?php echo esc_attr( $title ); ?></span>
	    </h3>
	    <?php endif; ?>
		<div class="content clearfix">
			<?php foreach ($items as $item): ?>
				<?php if ( isset($item['image']) && $item['image'] ) $image_bg = wp_get_attachment_image_src($item['image'],'full'); ?>
				<?php $bg_color = !empty($item['bg_color']) ? 'style="background-color:'. $item['bg_color'] .';"' : ""; ?>
					<div class="feature-box-inner colums-<?php echo count($items); ?>" <?php echo trim($bg_color); ?>>
						<div class="fbox-icon">
							<div class="icon-inner">
								<?php if (isset($item['link']) && trim($item['link'])!='') { ?>
									<a href="<?php echo esc_url_raw($item['link']); ?>">
								<?php } ?>
								<?php if(isset( $image_bg[0]) && $image_bg[0] ) { ?>
										<img class="img" src="<?php echo esc_url_raw($image_bg[0]); ?>" alt="">
								<?php }elseif (isset($item['icon']) && $item['icon']) { ?>
							           	<i class="<?php echo esc_attr($item['icon']); ?>"></i>
							    <?php } ?>
							    <?php if (isset($item['link']) && trim($item['link'])!='') { ?>
							    	</a>
								<?php } ?>
						    </div>
						</div>
					    <div class="fbox-content ">  
					    	<?php if (isset($item['title']) && trim($item['title'])!='') { ?>
					            <h3 class="ourservice-heading">
					            	<?php if (isset($item['link']) && trim($item['link'])!='') { ?>
										<a href="<?php echo esc_url_raw($item['link']); ?>">
									<?php } ?>
					            	<?php echo trim($item['title']); ?>
					            	<?php if (isset($item['link']) && trim($item['link'])!='') { ?>
								    	</a>
									<?php } ?>
					            </h3>
					        <?php } ?>
					         <?php if (isset($item['description']) && trim($item['description'])!='') { ?>
					            <div class="description"><?php echo trim( $item['description'] );?></div>  
					        <?php } ?>
					    </div> 
				    </div>
			<?php endforeach; ?>
		</div>
	</div>
<?php endif; ?>