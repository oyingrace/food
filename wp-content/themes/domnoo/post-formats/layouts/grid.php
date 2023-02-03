<?php
	$columns = domnoo_get_config('blog_columns', 1);
	$bcol = floor( 12 / $columns );
	$count = 1;
?>
<div class="layout-blog style-grid">
    <div class="row">
        <?php while ( have_posts() ) : the_post(); ?>
            <div class="col-sm-<?php echo esc_attr($bcol); ?> col-xs-12 <?php echo (($count%$columns)==1)?'sm-clearfix md-clearfix':''; ?>">
                <?php get_template_part( 'post-formats/content', get_post_format() ); ?>
            </div>
        <?php $count++; endwhile; ?>
    </div>
</div>