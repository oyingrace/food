<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$_id = domnoo_random_key();
$lat_lng = explode(',', $lat_lng);
if (count($lat_lng) == 2) {
	$lat = $lat_lng[0];
	$lng = $lat_lng[1];

	
	$style = '';
	if ($map_style) {
		$style = Domnoo_Google_Maps_Styles::get_style($map_style);
	}

	$icon_img = '';
	if ( $marker_icon ) {
		$img = wp_get_attachment_image_src($marker_icon,'full');
		if ( !empty($img) && isset($img[0]) ) {
			$icon_img = $img[0];
			$data_marker = 'data-marker_icon="'.esc_url($img[0]).'"';
		}
	}
?>
	<div class="widget-googlemap <?php echo esc_attr($el_class); ?>">
		<div class="widget-content">
			<div id="apus_gmap_canvas_<?php echo esc_attr( $_id ); ?>" class="map_canvas apus-google-map" style="width:100%; height:<?php echo esc_attr( $height ); ?>px;" data-lat="<?php echo esc_attr($lat); ?>" data-lng="<?php echo esc_attr($lng); ?>" data-zoom="<?php echo esc_attr($zoom); ?>"
				<?php echo trim($data_marker); ?> data-style="<?php echo esc_attr($style); ?>">
			</div>
			<?php if(!empty($title) || !empty($des) ) {?>
			<div class="map-content">
				<div class="container">
					<div class="col-md-6 hidden-sm hidden-xs">
					</div>
					<div class="col-md-6 col-xs-12">
						<div class="content-info">
							<?php if ($title!=''): ?>
						        <h3 class="widget-title">
						            <span><?php echo esc_attr( $title ); ?></span>
						            <?php if ( isset($subtitle) && $subtitle ): ?>
						                <span class="subtitle"><?php echo esc_html($subtitle); ?></span>
						            <?php endif; ?>
						        </h3>
						    <?php endif; ?>
						     <?php if ($des!=''): ?>
					            <div class="description"><?php echo trim( $des ); ?></div>
						    <?php endif; ?>
							<?php $info = (array) vc_param_group_parse_atts( $info );
							$socials = (array) vc_param_group_parse_atts( $socials );
							if ( !empty($info) || !empty($socials) ){
							?>
								<div class="contact-info">
									<div class="info-top">
									<?php
									if ( !empty($info) ){
									foreach ($info as $item) { ?>
										<div class="info-wrapper clearfix">
											<?php if (isset($item['icon']) && $item['icon']) { ?>
									        	<div class="icon">
									            	<i class="text-theme <?php echo esc_attr($item['icon']); ?>"></i>
									            </div>
										    <?php } ?>
										    <?php if (isset($item['des']) && $item['des']) { ?>
									        	<div class="des">
									            	<?php echo trim($item['des']); ?>
									            </div>
										    <?php } ?>
										</div>
									<?php }
									} ?>
									</div>
									<div class="info-bottom">
									<?php
									if ( !empty($socials) ){
									foreach ($socials as $item) { ?>
											<?php if (isset($item['url']) && $item['url']) { ?>
								        		<a href="<?php echo esc_url($item['url']); ?>">
								            		<i class="<?php echo esc_attr($item['icon']); ?>"></i>
							            		</a>
										    <?php } ?>
									<?php }
									} ?>
								</div>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
<?php } ?>