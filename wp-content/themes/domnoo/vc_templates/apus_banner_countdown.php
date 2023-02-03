<?php 

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$time = strtotime( $input_datetime );
?>
<div class="banner-countdown-widget <?php echo esc_attr($el_class); ?>">
	<div class="inner">
		<?php if( isset($title) && $title ) : ?>
		<h3 class="title"><?php echo trim($title); ?></h3>
		<?php endif; ?>	
		<?php if( isset($descript) && $descript ) : ?>
		<div class="des" ><?php echo trim($descript); ?></div>
		<?php endif; ?>	
		<div class="countdown-wrapper">
		    <div class="apus-countdown" data-time="timmer"
		         data-date="<?php echo date('m',$time).'-'.date('d',$time).'-'.date('Y',$time).'-'. date('H',$time) . '-' . date('i',$time) . '-' .  date('s',$time) ; ?>">
		    </div>
		</div>
	</div>	
</div>