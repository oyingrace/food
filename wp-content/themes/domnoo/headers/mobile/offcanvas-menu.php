<nav id="navbar-offcanvas" class="navbar" role="navigation">
    <ul>
        <?php
            $args = array(
                'theme_location' => 'primary',
                'container' => false,
                'menu_class' => 'nav navbar-nav',
                'fallback_cb'     => false,
                'menu_id' => 'main-mobile-menu',
                'walker' => new Domnoo_Mobile_Menu(),
                'items_wrap' => '%3$s',
            );
            wp_nav_menu($args);
        ?>
    </ul>
</nav>