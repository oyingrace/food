<header id="apus-header" class="apus-header header-v1 hidden-sm hidden-xs" role="banner">
    <div class="<?php echo (domnoo_get_config('keep_header') ? 'main-sticky-header-wrapper' : ''); ?>">
        <div class="<?php echo (domnoo_get_config('keep_header') ? 'main-sticky-header' : ''); ?>">
            <div class="header-middle">
                    <div class="p-relative">
                        <div class="clearfix table-visiable">
                            <div class="pull-left logo-left">
                                <div class="logo-in-theme pull-left">
                                    <?php get_template_part( 'page-templates/parts/logo' ); ?>
                                </div>
                            </div>

                            <?php if ( is_active_sidebar( 'sidebar-contact' ) ) : ?>
                                <div class="contact pull-left">
                                    <?php dynamic_sidebar( 'sidebar-contact' ); ?>
                                </div>
                            <?php endif; ?>
                            <div class="pull-right right-cart visibled-1700">
                                <?php if ( defined('DOMNOO_WOOCOMMERCE_ACTIVED') && domnoo_get_config('show_cartbtn') ): ?>
                                    <div class="pull-right">
                                        <?php get_template_part( 'woocommerce/cart/mini-cart-button' ); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if ( domnoo_get_config('show_searchform') ): ?>
                                    <div class="pull-right">
                                        <div class="apus-search-top dropdown clearfix">
                                            <button type="button" class="button-show-search dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ion-android-search"></i></button>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <?php if ( has_nav_menu( 'primary' ) ) : ?>
                            <div class="pull-left p-static content-menu">
                                <div class="main-menu">
                                    <nav data-duration="400" class="hidden-xs hidden-sm apus-megamenu slide animate navbar p-static" role="navigation">
                                    <?php   $args = array(
                                            'theme_location' => 'primary',
                                            'container_class' => 'collapse navbar-collapse no-padding',
                                            'menu_class' => 'nav navbar-nav megamenu',
                                            'fallback_cb' => '',
                                            'menu_id' => 'primary-menu',
                                            'walker' => new Domnoo_Nav_Menu()
                                        );
                                        wp_nav_menu($args);
                                    ?>
                                    </nav>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="pull-left account">
                                <?php if ( is_user_logged_in() ) { ?>
                                    <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php esc_html_e('My Account','domnoo'); ?>"><?php esc_html_e('My Account','domnoo'); ?></a>
                                 <?php } 
                                 else { ?>
                                    <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php esc_html_e('Login / Register','domnoo'); ?>"><?php esc_html_e('Login / Register','domnoo'); ?></a>
                                <?php } ?>
                            </div>
                            <div class="pull-right right-cart hidden-1700">
                                <?php if ( defined('DOMNOO_WOOCOMMERCE_ACTIVED') && domnoo_get_config('show_cartbtn') ): ?>
                                    <div class="pull-right">
                                        <?php get_template_part( 'woocommerce/cart/mini-cart-button' ); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if ( domnoo_get_config('show_searchform') ): ?>
                                    <div class="pull-right">
                                        <div class="apus-search-top dropdown clearfix">
                                            <button type="button" class="button-show-search dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ion-android-search"></i></button>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</header>