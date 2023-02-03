<?php
/**
 *
 * The default template for displaying content
 * @since 1.0
 * @version 1.2.0
 *
 */

if ( !is_single() ) {
	get_template_part( 'post-formats/loop/grid/_item' );
} else {
	get_template_part( 'post-formats/single/_single' );
}