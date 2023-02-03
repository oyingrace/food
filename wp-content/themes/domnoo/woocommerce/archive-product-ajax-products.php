<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( have_posts() ) {
	?>
	<div class="apus-products">
		<?php
		$page = get_query_var('paged') ? get_query_var('paged') : 1;

		while ( have_posts() ) { 
			the_post();
			wc_get_template( 'content-product.php', array( 'current_page' => $page ) );
		}
		?>
	</div>
	<div class="apus-infinite-load-link"><?php next_posts_link( '&nbsp;' ); ?></div>
	<?php
}
