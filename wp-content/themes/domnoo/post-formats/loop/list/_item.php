<?php $thumbsize = !isset($thumbsize) ? domnoo_get_blog_thumbsize() : $thumbsize; $thumb = domnoo_display_post_thumb($thumbsize);?>
<article <?php post_class('post list-default'); ?>>
    <div class="row list-inner">
        
        <div class="col-sm-<?php echo esc_attr(!empty($thumb) ? '5' : '12'); ?> info">
            <div class="date">
                <?php the_time( get_option('date_format', 'M d, Y') ); ?>
            </div>
             <?php
                if (get_the_title()) {
                ?>
                    <h4 class="entry-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h4>
                <?php
            }
            ?>
        </div>
        <?php
            if ( !empty($thumb) ) {
                ?>
                <div class="col-sm-7 image">
                    <?php echo trim($thumb); ?>
                </div>
                <?php
            }
        ?>
    </div>
</article>