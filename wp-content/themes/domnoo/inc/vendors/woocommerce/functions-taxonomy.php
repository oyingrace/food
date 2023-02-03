<?php

function domnoo_woo_enable_tax_fields($return) {
	return true;
}
add_filter( 'apus_framework_enable_tax_fields', 'domnoo_woo_enable_tax_fields' );

function domnoo_woo_types_metaboxes() {
	if ( function_exists('new_cmb2_box') && class_exists('Taxonomy_MetaData_CMB2') ) {
	    $metabox_id = 'domnoo_types_options';

	    $cmb = new_cmb2_box( array(
			'id'           => $metabox_id,
			'title'        => '',
			'object_types' => array( 'page' ),
		) );

	    $cmb->add_field( array(
		    'name'    => esc_html__( 'Icon', 'domnoo' ),
		    'id'      => 'icon',
		    'type'    => 'file',
		    'options' => array(
		        'url' => false,
		    ),
		    'text'    => array(
		        'add_upload_file_text' => esc_html__( 'Add Icon', 'domnoo' )
		    )
		) );

	    $cats = new Taxonomy_MetaData_CMB2( 'product_cat', $metabox_id );
	}
}
add_action( 'cmb2_init', 'domnoo_woo_types_metaboxes' );


function domnoo_woo_get_term_icon_url( $term_id ) {
	return Taxonomy_MetaData_CMB2::get( 'product_cat', $term_id, 'icon' );
}