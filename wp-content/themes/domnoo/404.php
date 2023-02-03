<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage Domnoo
 * @since Domnoo 1.0
 */
/*

*Template Name: 404 Page
*/
get_header();

?>
<section class="page-404">
	<div id="main-container" class="inner">
		
		<div id="main-content" class="main-page">

			<section class="error-404 not-found text-center clearfix">
				<div class="icon text-center"> <i class="ion-sad-outline"></i> </div>
				<h4 class="title-big"><?php echo domnoo_get_config('404_title', '404'); ?></h4>
				<h1 class="page-title"><?php echo domnoo_get_config('404_subtitle', 'Opps! Page Not Be Found'); ?></h1>
				<div class="page-content">
					<div class="sub-title">
						<?php echo domnoo_get_config('404_description', 'Sorry but the page you are looking for does not exist, have been removed, name changed or is temporarity unavailable.'); ?>
					</div>
					<?php get_search_form(); ?>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</div><!-- .content-area -->
			
	</div>
</section>
<?php get_footer(); ?>