<?php
$post_format = get_post_format();
global $post;

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="top-blog <?php echo  (!has_post_thumbnail() ? 'no-img' : 'has-img'); ?>">
        <?php if ( $post_format == 'gallery' ) {
            $gallery = domnoo_post_gallery( get_the_content(), array( 'size' => 'full' ) );
        ?>
            <div class="entry-thumb <?php echo  (empty($gallery) ? 'no-thumb' : ''); ?>">
                <?php echo trim($gallery); ?>
            </div>
        <?php } elseif( $post_format == 'link' ) {
                $format = domnoo_post_format_link_helper( get_the_content(), get_the_title() );
                $title = $format['title'];
                $link = domnoo_get_link_attributes( $title );
                $thumb = domnoo_post_thumbnail('', $link);
                echo trim($thumb);
            } else { ?>
            <div class="entry-thumb <?php echo  (!has_post_thumbnail() ? 'no-thumb' : ''); ?>">
                <?php
                    $thumb = domnoo_post_thumbnail();
                    echo trim($thumb);
                ?>
            </div>
        <?php } ?>
        <div class="meta-blog">
            <span class="author"><i class="fa fa-user text-theme" aria-hidden="true"></i> <?php the_author_posts_link(); ?></span>
            <span class="comment"><i class="fa fa-commenting-o text-theme" aria-hidden="true"></i> <?php comments_number( '0 Comments', '1 Comment', '% Comments' ); ?></span>
            <span class="date"><i class="fa fa-calendar text-theme" aria-hidden="true"></i><?php the_time( get_option('date_format', 'd M, Y') ); ?></span>
        </div>
    </div>
    <?php if (get_the_title()) { ?>
        <h4 class="entry-title detail-title">
            <?php the_title(); ?>
        </h4>
    <?php } ?>
	<div class="entry-content-detail">
    	<div class="single-info info-bottom">
            <div class="entry-description">
                <?php
                    if ( $post_format == 'gallery' ) {
                        $gallery_filter = domnoo_gallery_from_content( get_the_content() );
                        echo trim($gallery_filter['filtered_content']);
                    } else {
                        the_content();
                    }
                ?>
            </div><!-- /entry-content -->
    		<?php
    		wp_link_pages( array(
    			'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'domnoo' ) . '</span>',
    			'after'       => '</div>',
    			'link_before' => '<span>',
    			'link_after'  => '</span>',
    			'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'domnoo' ) . ' </span>%',
    			'separator'   => '',
    		) );
    		?>
    		<div class="tag-social clearfix">
    			<?php domnoo_post_tags(); ?>
    			<?php if( domnoo_get_config('show_blog_social_share', false) ) {
    					get_template_part( 'page-templates/parts/sharebox' );
    				} ?>
    		</div>
    	</div>
    </div>
</article>