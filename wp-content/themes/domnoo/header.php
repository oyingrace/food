<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Domnoo
 * @since Domnoo 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php
	if ( !function_exists( 'wp_site_icon' ) ) {
		$favicon = domnoo_get_config('media-favicon');
		if ( (isset($favicon['url'])) && (trim($favicon['url']) != "" ) ) {
	        if (is_ssl()) {
	            $favicon_image_img = str_replace("http://", "https://", $favicon['url']);		
	        } else {
	            $favicon_image_img = $favicon['url'];
	        }
		?>
	    	<link rel="shortcut icon" href="<?php echo esc_url($favicon_image_img); ?>" />
	    <?php } ?>
    <?php } ?>

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php if ( domnoo_get_config('preload', true) ) { ?>
	<div class="apus-page-loading">
	  	<div id="loader"></div>
	  	<div class="loader-section section-left"></div>
	  	<div class="loader-section section-right"></div>
	</div>
<?php } ?>
<div id="wrapper-container" class="wrapper-container">

	<?php get_template_part( 'headers/mobile/offcanvas-menu' ); ?>

	<?php get_template_part( 'headers/mobile/header-mobile' ); ?>

	<?php $header = apply_filters( 'domnoo_get_header_layout', domnoo_get_config('header_type') );
		if ( empty($header) ) {
			$header = 'v1';
		}
	?>
	<?php get_template_part( 'headers/'.$header ); ?>
    <div class="full-search">
        <div class="container">
            <?php get_template_part( 'page-templates/parts/productsearchform' ); ?>
        </div>
    </div>
    <div class="over-dark"></div>

	<div id="apus-main-content">