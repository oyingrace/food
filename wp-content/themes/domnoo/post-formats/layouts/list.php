<?php
	$columns = domnoo_get_config('blog_columns', 1);
	$bcol = floor( 12 / $columns );
?>
<div class="layout-blog style-list">
    <div class="row">
        <?php while ( have_posts() ) : the_post(); ?>
            <div class="col-md-<?php echo esc_attr($bcol); ?>">
                <?php get_template_part( 'post-formats/loop/list/_item' ); ?>
            </div>
        <?php endwhile; ?>
    </div>
</div>