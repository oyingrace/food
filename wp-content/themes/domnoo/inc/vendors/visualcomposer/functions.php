<?php

if ( function_exists('apus_framework_add_param') ) {
	apus_framework_add_param();
}

function domnoo_admin_init_scripts(){
	wp_enqueue_script('google-maps-api', '//maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places&amp;key=' . domnoo_get_config('google_map_api_key', '') );
	wp_enqueue_script('jquery-geocomplete', get_template_directory_uri().'/js/admin/jquery.geocomplete.min.js');

	wp_enqueue_script('jquery-ui-datepicker');
	wp_enqueue_style('jquery-ui-css', '//ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
	wp_enqueue_script( 'domnoo-admin-scripts', get_template_directory_uri() . '/js/admin/custom.js', array( 'jquery'  ), '20131022', true );
}
add_action( 'admin_enqueue_scripts', 'domnoo_admin_init_scripts' );

function domnoo_map_init_scripts() {
	wp_enqueue_script('google-maps-api', '//maps.google.com/maps/api/js?key=' . domnoo_get_config('google_map_api_key', '') );
	wp_enqueue_script('gmap3', get_template_directory_uri().'/js/gmap3.js', array( 'jquery' ), '6.0.0', true);
}
add_action('wp_enqueue_scripts', 'domnoo_map_init_scripts');
