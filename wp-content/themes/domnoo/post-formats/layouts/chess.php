<?php
	$columns = domnoo_get_config('blog_columns', 1);
	$bcol = floor( 12 / $columns );
?>
<div class="layout-blog style-grid">
    <div class="row">
        <?php $count = 0; while ( have_posts() ) : the_post(); ?>
            <div class="col-md-<?php echo esc_attr($bcol); ?>">
            	<?php
            	$post_format = get_post_format();
            	$prefix = '';
            	switch ($post_format) {
            		case 'gallery':
            			$prefix = '-gallery';
            			break;
            		case 'audio':
            			$prefix = '-media';
            			break;
        			case 'link':
            			$prefix = '-link';
            			break;
        			case 'video':
            			$prefix = '-media';
            			break;
            		default:
            			$prefix = '';
            			break;
            	}
            	?>
            	<?php if ($count%2 == 0): ?>
                	<?php get_template_part( 'post-formats/loop/list-left-image/_item'.$prefix ); ?>
	            <?php else: ?>
	            	<?php get_template_part( 'post-formats/loop/list-right-image/_item'.$prefix ); ?>
	            <?php endif; ?>
            </div>
        <?php $count++; endwhile; ?>
    </div>
</div>
