<?php

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$_id = domnoo_random_key();

if (isset($categoriestabs) && !empty($categoriestabs)):
    $categoriestabs = (array) vc_param_group_parse_atts( $categoriestabs );
    $i = 0;
?>

    <div class="widget widget-categoriestabs <?php echo esc_attr($el_class.' '.$tabs_style); ?>">
        <div class="widget-content woocommerce tab-selector clearfix">
            <div class="top">
                <ul role="tablist" class="nav nav-tabs" data-load="ajax">
                    <?php foreach ($categoriestabs as $tab) : ?>
                        <?php $category = get_term_by( 'slug', $tab['category'], 'product_cat' ); ?>
                        <li<?php echo ($i == 0 ? ' class="active"' : ''); ?>>
                            <a href="#tab-<?php echo esc_attr($_id);?>-<?php echo esc_attr($tab['category']); ?>">
                                <?php
                                    if ( !empty($tab['icon_image']) ) {
                                        $icon = wp_get_attachment_image_src($tab['icon_image'], 'full');
                                        domnoo_display_image($icon);
                                    }
                                ?>
                                <?php if ( !empty($tab['title']) ) { ?>
                                    <?php echo trim($tab['title']); ?>
                                <?php } else { ?>
                                    <?php echo trim($category->name); ?>
                                <?php } ?>
                            </a>
                        </li>
                    <?php $i++; endforeach; ?>
                </ul>
            </div>
            <div class="widget-inner">
                <div class="tab-content">
                    <?php $i = 0; foreach ($categoriestabs as $tab) : ?>
                        <div id="tab-<?php echo esc_attr($_id);?>-<?php echo esc_attr($tab['category']); ?>" class="tab-pane <?php echo ($i == 0 ? 'active' : ''); ?>" data-loaded="<?php echo ($i == 0 ? 'true' : 'false'); ?>" data-number="<?php echo esc_attr($number); ?>" data-categories="<?php echo esc_attr($tab['category']); ?>" data-columns="<?php echo esc_attr($columns); ?>" data-product_type="<?php echo esc_attr($type); ?>" data-page="1" data-layout_type="<?php echo esc_attr($layout_type); ?>">

                            <div class="tab-content-products">
                                <?php if ( $i == 0 ): ?>
                                    <?php $loop = domnoo_get_products( array($tab['category']), $type, 1, $number ); $max_pages = $loop->max_num_pages; ?>
                                    <?php wc_get_template( 'layout-products/'.$layout_type.'.php' , array( 'loop' => $loop, 'columns' => $columns, 'number' => $number ) ); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php $i++; endforeach; ?>
                </div>
            </div>
            
        </div>
    </div>
<?php endif; ?>