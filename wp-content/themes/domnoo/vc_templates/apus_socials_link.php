<?php

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$socials = array('facebook' => esc_html__('Facebook', 'domnoo'), 'twitter' => esc_html__('Twitter', 'domnoo'),
	'youtube' => esc_html__('Youtube', 'domnoo'), 'pinterest' => esc_html__('Pinterest', 'domnoo'),
	'google-plus' => esc_html__('Google Plus', 'domnoo'), 'instagram' => esc_html__('Instagram', 'domnoo'));
?>
<div class="widget widget-social <?php echo esc_attr($el_class.' '.$align); ?>">
    <?php if ($title!=''): ?>
        <h3 class="widget-title">
            <span><?php echo esc_attr( $title ); ?></span>
            <?php if ( isset($subtitle) && $subtitle ): ?>
                <span class="subtitle"><?php echo esc_html($subtitle); ?></span>
            <?php endif; ?>
        </h3>
    <?php endif; ?>
    <div class="widget-content">
    	<?php if ($description != ''): ?>
	        <?php echo trim($description); ?>
	    <?php endif; ?>
		<ul class="social">
		    <?php foreach( $socials as $key=>$social):
		            if( isset($atts[$key.'_url']) && !empty($atts[$key.'_url']) ): ?>
		                <li>
		                    <a href="<?php echo esc_url($atts[$key.'_url']);?>" class="<?php echo esc_attr($key); ?>">
		                        <i class="fa fa-<?php echo esc_attr($key); ?> "></i>
		                    </a>
		                </li>
		    <?php
		            endif;
		        endforeach;
		    ?>
		</ul>
	</div>
</div>