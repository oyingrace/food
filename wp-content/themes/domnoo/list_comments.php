<?php

$GLOBALS['comment'] = $comment;
$add_below = '';
$avatar = get_avatar($comment, 92);
?>
<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">

	<div class="the-comment media">
		<?php if(!empty($avatar)) {?>
			<div class="avatar media-left">
				<?php echo $avatar; ?>
			</div>
		<?php } ?>
		<div class="comment-box media-body">
			<div class="comment-author meta">
				<span class="name-user"><i class="fa fa-user-o text-theme" aria-hidden="true"></i><?php echo get_comment_author_link() ?></span>
				<span class="date"><i class="fa fa-calendar text-theme" aria-hidden="true"></i><?php printf(esc_html__('%1$s', 'domnoo'), get_comment_date()) ?></span>
				<?php edit_comment_link(esc_html__('Edit', 'domnoo'),'  ','') ?>
				<span class="pull-right"><?php comment_reply_link(array_merge( $args, array( 'reply_text' => esc_html__(' Reply', 'domnoo'), 'add_below' => 'comment', 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?></span>
			</div>
			<div class="comment-text">
				<?php if ($comment->comment_approved == '0') : ?>
				<em><?php esc_html_e('Your comment is awaiting moderation.', 'domnoo') ?></em>
				<br />
				<?php endif; ?>
				<?php comment_text() ?>
			</div>
			
		</div>
	</div>