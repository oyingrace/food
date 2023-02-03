<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$items = (array) vc_param_group_parse_atts( $items );
if ( !empty($items) ):
?>
	<div class="widget-information-box <?php echo esc_attr($el_class); ?> <?php echo esc_attr($style); ?>">
		    <div class="owl-carousel posts " data-smallmedium="2" data-extrasmall="1" data-items="<?php echo esc_attr($number); ?>" data-carousel="owl" data-pagination="false" data-nav="true">
			<?php foreach ($items as $item): ?>
				<?php if ( isset($item['image']) && $item['image'] ) $image_bg = wp_get_attachment_image_src($item['image'],'full'); ?>
				<div class="item">
					<div class="row">
						<div class="col-sm-6 col-xs-12">
							<div class="fbox-content ">  
						    	<?php if (isset($item['title']) && trim($item['title'])!='') { ?>
						            <h3 class="ourservice-heading"><?php echo trim($item['title']); ?></h3>
						        <?php } ?>
						         <?php if (isset($item['description']) && trim($item['description'])!='') { ?>
						            <div class="description"><?php echo trim( $item['description'] );?></div>  
						        <?php } ?>
						        <?php if (isset($item['shop_now']) && trim($item['shop_now'])!='') { ?>
						            <a class="btn-shop" href="<?php echo esc_url_raw($item['shop_now']); ?>"><?php echo esc_html__('shop now','domnoo'); ?></a>
						        <?php } ?>
						    </div>
					    </div>
					    <div class="col-sm-6 col-xs-12">
							<div class="fbox-icon">
								<?php if(isset( $image_bg[0]) && $image_bg[0] ) { ?>
									<img class="img" src="<?php echo esc_url_raw($image_bg[0]); ?>" alt="">
							    <?php } ?>
							</div>
						</div>
				    </div>
			    </div>
			<?php endforeach; ?>
		</div>
	</div>
<?php endif; ?>