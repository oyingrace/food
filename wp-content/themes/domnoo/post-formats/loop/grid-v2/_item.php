<?php $thumbsize = !isset($thumbsize) ? domnoo_get_blog_thumbsize() : $thumbsize;?>

<article <?php post_class('post post-grid grid-v2'); ?>>
    <div class="top-blog has-img">
        <?php
            $thumb = domnoo_display_post_thumb($thumbsize);
            echo trim($thumb);
        ?>
        <div class="meta-blog">
            <span class="author"><i class="fa fa-user text-theme" aria-hidden="true"></i> <?php the_author_posts_link(); ?></span>
            <span class="comment"><i class="fa fa-commenting-o text-theme" aria-hidden="true"></i> <?php comments_number( '0 Comments', '1 Comment', '% Comments' ); ?></span>
            <span class="date"><i class="fa fa-calendar text-theme" aria-hidden="true"></i><?php the_time( get_option('date_format', 'd M, Y') ); ?></span>
        </div>
        <div class="more">
            <?php if (get_the_title()) { ?>
                <h4 class="entry-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h4>
            <?php } ?>
            <a class="btn btn-theme btn-sm" href="<?php the_permalink(); ?>"><?php echo esc_html__('read more','domnoo'); ?></a>
        </div>
    </div>
</article>