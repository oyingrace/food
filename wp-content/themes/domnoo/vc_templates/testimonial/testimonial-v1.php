<?php
   $job = get_post_meta( get_the_ID(), 'apus_testimonial_job', true );
   $link = get_post_meta( get_the_ID(), 'apus_testimonial_link', true );
?>
<div class="testimonial-body layout1">
    <div class="image">
       <?php the_post_thumbnail('widget'); ?>
    </div>
    <div class="testimonial-meta">
      <div class="info">
          <?php if (!empty($link)) { ?>
            <h3 class="name-client"><a href="<?php echo esc_url_raw($link); ?>"><?php the_title(); ?></a></h3>
          <?php } else { ?>
            <h3 class="name-client"><?php the_title(); ?></h3>
          <?php } ?>
          <span class="job"><?php echo sprintf(__('%s', 'domnoo'), $job); ?></span>
      </div>
    </div>
    <div class="description">
        <?php the_content(); ?>      
    </div>
</div>