<header id="apus-header" class="apus-header header-v2 hidden-sm hidden-xs" role="banner">
    <div class="header-top">
        <div class="container">
            <div class="row table-visiable">
                <div class="col-md-3 col-xs-12">
                    <?php if ( is_active_sidebar( 'sidebar-contact' ) ) : ?>
                        <div class="contact pull-left">
                            <?php dynamic_sidebar( 'sidebar-contact' ); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-6 col-xs-12">
                    <div class="logo-in-theme text-center">
                        <?php get_template_part( 'page-templates/parts/logo-yellow' ); ?>
                    </div>
                </div>
                <div class="col-md-3 col-xs-12">
                    <div class="pull-right right-cart">
                        <?php if ( domnoo_get_config('show_searchform') ): ?>
                            <div class="pull-right">
                                <div class="apus-search-top dropdown clearfix">
                                    <button type="button" class="button-show-search dropdown-toggle" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ion-android-search"></i></button>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ( defined('DOMNOO_WOOCOMMERCE_ACTIVED') && domnoo_get_config('show_cartbtn') ): ?>
                            <div class="pull-right">
                                <?php get_template_part( 'woocommerce/cart/mini-cart-button-2' ); ?>
                            </div>
                        <?php endif; ?>

                        <?php if ( domnoo_get_config('show_settingmenu') && has_nav_menu( 'top-menu' ) ): ?>
                            <div class="pull-right menu-top dropdown">
                                <button class="show-menu-top dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <span class="show-top-menu"><i class="fa fa-user-o"></i></span>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <nav data-duration="400" class="hidden-xs hidden-sm slide animate navbar" role="navigation">
                                        <?php
                                            $args = array(
                                                'theme_location'  => 'top-menu',
                                                'menu_class'      => 'nav navbar-nav top-menu',
                                                'fallback_cb'     => '',
                                                'menu_id'         => 'top-menu'
                                            );
                                            wp_nav_menu($args);
                                        ?>
                                    </nav>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>  
    </div>
    <div class="<?php echo (domnoo_get_config('keep_header') ? 'main-sticky-header-wrapper' : ''); ?>">
        <div class="<?php echo (domnoo_get_config('keep_header') ? 'main-sticky-header' : ''); ?>">
            <div class="header-middle">
                <div class="container p-relative">
                    <?php if ( has_nav_menu( 'primary' ) ) : ?>
                        <div class="main-menu menu-center">
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
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</header>