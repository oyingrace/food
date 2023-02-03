<div id="apus-header-mobile" class="header-mobile hidden-lg hidden-md clearfix">    
    <div class="container table-visiable">
        <div class="row">
            <div class="col-xs-6">
                <a href="#navbar-offcanvas" class="btn btn-showmenu"><i class="fa fa-bars"></i></a>
            </div>
            <?php if ( defined('DOMNOO_WOOCOMMERCE_ACTIVED') && DOMNOO_WOOCOMMERCE_ACTIVED ): ?>
                <div class="col-xs-6">
                    <!-- Setting -->
                    <div class="top-cart pull-right">
                        <?php get_template_part( 'woocommerce/cart/mini-cart-button' ); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <?php
            $logo = domnoo_get_config('media-mobile-logo');
        ?>
        <?php if( isset($logo['url']) && !empty($logo['url']) ): ?>
            <div class="logo text-center">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" >
                    <img src="<?php echo esc_url( $logo['url'] ); ?>" alt="<?php bloginfo( 'name' ); ?>">
                </a>
            </div>
        <?php else: ?>
            <div class="logo logo-theme text-center">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" >
                    <img src="<?php echo esc_url_raw( get_template_directory_uri().'/images/logo.jpg'); ?>" alt="<?php bloginfo( 'name' ); ?>">
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>