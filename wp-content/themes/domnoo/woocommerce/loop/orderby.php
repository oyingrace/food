<?php
/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$output = '';
if ( class_exists('Domnoo_Woo_Custom') ) {
    $output = Domnoo_Woo_Custom::orderby_list();
}
?>
<div id="apus-orderby" class="dropdown apus-orderby apus-dropdown-custom">
    <div class="dropdown-toggle orderby-label" data-toggle="dropdown" aria-expanded="true" role="button">
        <?php echo esc_html__('Order By: ', 'domnoo'); ?> <span></span>
        <b class="caret"></b>
    </div>
    <div class="dropdown-menu">
        <?php echo trim($output); ?>
    </div>
</div>