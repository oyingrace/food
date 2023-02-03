<?php

if ( !function_exists( 'domnoo_footer_metaboxes' ) ) {
	function domnoo_footer_metaboxes(array $metaboxes) {
		$prefix = 'apus_footer_';
	    $fields = array(
			array(
				'name' => esc_html__( 'Footer Style', 'domnoo' ),
				'id'   => $prefix.'style_class',
				'type' => 'select',
				'options' => array(
					'lighting' => esc_html__('Lighting', 'domnoo'),
					'dark' => esc_html__('Dark', 'domnoo'),
					'boxed' => esc_html__('Boxed Light', 'domnoo')
				)
			),
    	);
		
	    $metaboxes[$prefix . 'display_setting'] = array(
			'id'                        => $prefix . 'display_setting',
			'title'                     => esc_html__( 'Display Settings', 'domnoo' ),
			'object_types'              => array( 'apus_footer' ),
			'context'                   => 'normal',
			'priority'                  => 'high',
			'show_names'                => true,
			'fields'                    => $fields
		);

	    return $metaboxes;
	}
}
add_filter( 'cmb2_meta_boxes', 'domnoo_footer_metaboxes' );
