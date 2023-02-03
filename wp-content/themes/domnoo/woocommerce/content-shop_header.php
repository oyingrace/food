<?php
/**
 *	The template for displaying the shop header
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<div class="apus-shop-header style-<?php echo domnoo_get_config('product_archive_top_categories_style', 'horizontal'); ?>">
    <div class="apus-shop-menu">
        
        <?php if ( domnoo_get_config('product_archive_top_categories', true) ) { ?>
            <div class="top">
                <ul id="apus-categories" class="apus-categories">
                    <?php domnoo_category_menu(); ?>
                </ul>
            </div>
        <?php } ?>
        <div class="filter-wrapper">
            <div class="container">
                <?php woocommerce_result_count(); ?>

                <?php if ( domnoo_get_config('product_archive_filter_sidebar', true) ) { ?>
                    <div class="pull-right">
                        <ul id="apus-filter-menu" class="apus-filter-menu">
                            <li>
                                <a class="filter-action" href="#" title="<?php esc_html_e('Filter', 'domnoo'); ?>"><i class="ion-funnel"></i> <?php esc_html_e( 'Filter ', 'domnoo' ); ?><b class="caret"></b></a>
                            </li>
                        </ul>
                    </div>
                <?php } ?>
                <?php if ( domnoo_get_config('product_archive_orderby', true) ) {
                    $output = '';
                    if ( class_exists('Domnoo_Woo_Custom') ) {
                        $output = Domnoo_Woo_Custom::orderby_list();
                    }
                    ?>
                    <div class="pull-right">
                        <div id="apus-orderby" class="dropdown apus-orderby apus-dropdown-custom">
                            <div class="dropdown-toggle orderby-label" data-toggle="dropdown" aria-expanded="true" role="button">
                                <?php echo esc_html__('Order By: ', 'domnoo'); ?> <span></span>
                                <b class="caret"></b>
                            </div>
                            <div class="dropdown-menu dropdown-menu-right">
                                <?php echo trim($output); ?>
                            </div>
                        </div>
                    </div>
                    <?php
                } ?>
                <div class="pull-right">
                    <?php domnoo_woocommerce_display_modes(); ?>
                </div>
            </div>
        </div>
    </div>
    <?php if ( domnoo_get_config('product_archive_filter_sidebar', true) ) { ?>
        <div id="apus-shop-sidebar" class="apus-shop-sidebar apus-sidebar-header">
            <div class="apus-sidebar-inner">
                <div id="apus-widgets-wrapper" class="row">
                    <?php
                        if ( is_active_sidebar( 'shop-top-filter-sidebar' ) ) {
                            dynamic_sidebar( 'shop-top-filter-sidebar' );
    					}
                    ?>
                </div>
            </div>
            
            <div id="apus-sidebar-layout-indicator"></div> <!-- Don't remove (used for testing sidebar/filters layout in JavaScript) -->
        </div>
    <?php } ?>
</div>
