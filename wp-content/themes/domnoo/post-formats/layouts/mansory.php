<?php
    wp_enqueue_script( 'isotope-pkgd', get_template_directory_uri().'/js/isotope.pkgd.min.js', array( 'jquery' ) );
    $columns = domnoo_get_config('blog_columns', 1);
	$bcol = floor( 12 / $columns );
?>

<div class="isotope-items" data-isotope-duration="400" data-columnwidth=".col-md-<?php echo esc_attr($bcol); ?>">
    <?php while ( have_posts() ) : the_post(); ?>
        <div class="isotope-item col-xs-12 col-md-<?php echo esc_attr($bcol); ?>">
            <?php get_template_part( 'post-formats/loop/grid/_item' ); ?>
        </div>
    <?php endwhile; ?>
</div>