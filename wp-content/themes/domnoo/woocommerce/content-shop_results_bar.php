<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$show_reset = false;


if ( ! empty( $_REQUEST['s'] ) ) {
    $show_reset = true;
    $esc_button_text = sprintf( esc_html__( 'Search results for &ldquo;%s&rdquo;', 'domnoo' ), '<span>' . esc_html( $_REQUEST['s'] ) . '</span>' );
} elseif ( is_product_taxonomy() ) {
    if ( !is_product_category() ) {
        $show_reset = true;
        $current_term = $GLOBALS['wp_query']->get_queried_object();
        $esc_button_text = sprintf( esc_html__( 'Products tagged &ldquo;%s&rdquo;', 'domnoo' ), '<span>' . esc_html( $current_term->name ) . '</span>' );
    }
}

if ( $show_reset ) :
?>
    <div class="apus-results">
        <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="apus-results-reset">
            <i class="icon-close icons"></i>
            <?php echo trim($esc_button_text); ?>
        </a>
    </div>

<?php endif;

$filters = domnoo_count_filtered();

if ( $filters ): ?>
    <div class="apus-results">
        <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="apus-results-reset">
            <i class="icon-close icons"></i>
            <?php printf(__('Filters (%s)', 'domnoo'), $filters); ?>
        </a>
    </div>
<?php endif;