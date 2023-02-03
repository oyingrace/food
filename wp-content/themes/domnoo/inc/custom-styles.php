<?php
if ( !function_exists ('domnoo_custom_styles') ) {
	function domnoo_custom_styles() {
		global $post;	
		
		ob_start();	
		?>
		
			<?php
				$font_source = domnoo_get_config('font_source');
				$main_font = domnoo_get_config('main_font');
				$main_font = isset($main_font['font-family']) ? $main_font['font-family'] : false;
				$main_google_font_face = domnoo_get_config('main_google_font_face');
			?>
			<?php if ( ($font_source == "1" && $main_font) || ($font_source == "2" && $main_google_font_face) ): ?>
				h1, h2, h3, h4, h5, h6, .widget-title,.widgettitle
				{
					font-family: 
					<?php if ( $font_source == "2" ) echo '\'' . $main_google_font_face . '\','; ?>
					<?php if ( $font_source == "1" ) echo '\'' . $main_font . '\','; ?> 
					sans-serif;
				}
			<?php endif; ?>
			/* Second Font */
			<?php
				$secondary_font = domnoo_get_config('secondary_font');
				$secondary_font = isset($secondary_font['font-family']) ? $secondary_font['font-family'] : false;
				$secondary_google_font_face = domnoo_get_config('secondary_google_font_face');
			?>
			<?php if ( ($font_source == "1" && $secondary_font) || ($font_source == "2" && $secondary_google_font_face) ): ?>
				body,
				p
				{
					font-family: 
					<?php if ( $font_source == "2" ) echo '\'' . $secondary_google_font_face . '\','; ?>
					<?php if ( $font_source == "1" ) echo '\'' . $secondary_font . '\','; ?> 
					sans-serif;
				}			
			<?php endif; ?>

			/* Custom Color (skin) */ 

			/* check second color -------------------------*/ 	
			<?php if ( domnoo_get_config('second_color') != "" ) : ?>
				.text-theme-second
				{
					color: <?php echo esc_html( domnoo_get_config('second_color') ); ?>;
				}
				/* check second background color */
				.add-fix-top,
				.bg-theme-second
				{
					background-color: <?php echo esc_html( domnoo_get_config('second_color') ); ?>;
				}
				.contact-form.style2 .btn[type="submit"],
				.contact-form input:focus, .contact-form textarea:focus{
					border-color: <?php echo esc_html( domnoo_get_config('second_color') ); ?>;
				}
			<?php endif; ?>

			/* check main color */ 
			<?php if ( domnoo_get_config('main_color') != "" ) : ?>
				/* seting background main */
				.cart-icon .count,
				.widget-categoriestabs.horizontal .nav-tabs > li > a::before,
				.banner-countdown-widget .times,
				.widget-categoriestabs.vertical .nav-tabs > li:hover > a, .widget-categoriestabs.vertical .nav-tabs > li.active > a,
				.widget-categoriestabs.vertical .nav-tabs > li > a,
				.feature-box-inner .icon-inner,
				ul.apus-categories li a,
				.widget-ourteam .avarta::before,
				.widget-gallery .popup-image::before,
				.bg-theme
				{
					background-color: <?php echo esc_html( domnoo_get_config('main_color') ) ?> ;
				}
				/* setting color*/
				.cart_item:first-child,
				.display-mode .active,
				.list-about i,
				.widget-products-special .product-thumb-item .price,
				.widget-categoriestabs.horizontal .nav-tabs > li:hover > a, .widget-categoriestabs.horizontal .nav-tabs > li.active > a,
				.widget-text-heading .sub_title,
				.woocommerce div.product p.price, .woocommerce div.product span.price,
				.product-block.grid .image .onsale,
				.apus-pagination > span:hover, .apus-pagination > span.current, .apus-pagination > a:hover, .apus-pagination > a.current,
				.text-theme{
					color: <?php echo esc_html( domnoo_get_config('main_color') ) ?>;
				}
				.text-theme{
					color: <?php echo esc_html( domnoo_get_config('main_color') ) ?> !important;
				}

				/* setting border color*/
				.header-v2 .navbar-nav.megamenu > li:hover > a, .header-v2 .navbar-nav.megamenu > li.active > a,
				.widget-products-special .product-thumb-item.active .product-image, .widget-products-special .product-thumb-item:hover .product-image,
				.apus-pagination > span:hover, .apus-pagination > span.current, .apus-pagination > a:hover, .apus-pagination > a.current,
				.product-block.grid:hover,
				.border-theme{
					border-color: <?php echo esc_html( domnoo_get_config('main_color') ) ?> !important;
				}
			<?php endif; ?>

			<?php if ( domnoo_get_config('second_color') != ""  && domnoo_get_config('main_color') != "" ) : ?>
				.back-top .back-inner,
				.product-block-pricing .groups-button .added_to_cart.wc-forward,
				.commentform .title::before,
				.single-session .title::before,
				.sidebar .widget .widgettitle::before, .sidebar .widget .widget-title::before, .apus-sidebar .widget .widgettitle::before, .apus-sidebar .widget .widget-title::before,
				.primary-vertical > li:hover > a, .primary-vertical > li.active > a,
				.primary-vertical > li > a .fa, .primary-vertical > li > a img,
				.header-v4 .primary-vertical > li > a .fa, .header-v4 .primary-vertical > li > a img,
				.widget-gallery .popup-image::before,
				.widget-other-speaker .title::before,
				.speaker-grid .entry-thumb::before,
				.widget-testimonials .widget-title::before,
				.widget-gallery.default .owl-carousel .owl-controls .owl-nav .owl-next:hover, .widget-gallery.default .owl-carousel .owl-controls .owl-nav .owl-next:active,
				.widget-gallery.default .owl-carousel .owl-controls .owl-nav .owl-prev,
				.product-block-pricing:hover .woocommerce-Price-amount,
				.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt,
				.underline::before,
				.owl-carousel .owl-controls .owl-nav .owl-prev::before,
				.register.style-dashed [type="submit"],
				.widget-googlemap .widget-title::before,
				.widget-text-heading .title::before,
				.widget-features-box.default .item.odd::before,
				.widget-action .title::before,
				.scrollbar,
				.cart_totals > h2::before,
				.banner-countdown-widget .des::before,
				.btn-gradient:hover, .btn-gradient:active,
				.btn-gradient{
				   	background: -webkit-linear-gradient(left, <?php echo esc_html( domnoo_get_config('second_color') ) ?> , <?php echo esc_html( domnoo_get_config('main_color') ) ?>); /* For Safari 5.1 to 6.0 */
					background: -o-linear-gradient(right, <?php echo esc_html( domnoo_get_config('second_color') ) ?>, <?php echo esc_html( domnoo_get_config('main_color') ) ?>); /* For Opera 11.1 to 12.0 */
					background: -moz-linear-gradient(right, <?php echo esc_html( domnoo_get_config('second_color') ) ?>, <?php echo esc_html( domnoo_get_config('main_color') ) ?>); /* For Firefox 3.6 to 15 */
					background: linear-gradient(to right, <?php echo esc_html( domnoo_get_config('second_color') ) ?> , <?php echo esc_html( domnoo_get_config('main_color') ) ?>); /* Standard syntax */
				}
				.widget-gallery.default .owl-carousel .owl-controls .owl-nav .owl-prev:hover, .widget-gallery.default .owl-carousel .owl-controls .owl-nav .owl-prev:active,
				.widget-gallery.default .owl-carousel .owl-controls .owl-nav .owl-next,
				.owl-carousel .owl-controls .owl-nav .owl-next::before,
				.back-top .back-inner::before,
				.register.style-dashed [type="submit"]:hover,
				.register.style-dashed [type="submit"]:active,
				.widget-features-box.default .item::before,
				.product-block-pricing .groups-button .added_to_cart.wc-forward:hover,
				.product-block-pricing .groups-button .added_to_cart.wc-forward:active,
				.woocommerce #respond input#submit.alt:active, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:active, .woocommerce input.button.alt:hover,
				.scrollbar:hover,
				.scrollbar:active,
				.btn-gradient:before{
					background: -webkit-linear-gradient(left, <?php echo esc_html( domnoo_get_config('main_color') ) ?> , <?php echo esc_html( domnoo_get_config('second_color') ) ?>); /* For Safari 5.1 to 6.0 */
					background: -o-linear-gradient(right, <?php echo esc_html( domnoo_get_config('main_color') ) ?>, <?php echo esc_html( domnoo_get_config('second_color') ) ?>); /* For Opera 11.1 to 12.0 */
					background: -moz-linear-gradient(right, <?php echo esc_html( domnoo_get_config('main_color') ) ?>, <?php echo esc_html( domnoo_get_config('second_color') ) ?>); /* For Firefox 3.6 to 15 */
					background: linear-gradient(to right, <?php echo esc_html( domnoo_get_config('main_color') ) ?> , <?php echo esc_html( domnoo_get_config('second_color') ) ?>); /* Standard syntax */
				}
				.speaker-grid .entry-title::before,
				.widget-video .widget-title::before{
					background: -webkit-linear-gradient(top, <?php echo esc_html( domnoo_get_config('main_color') ) ?> , <?php echo esc_html( domnoo_get_config('second_color') ) ?>); /* For Safari 5.1 to 6.0 */
					background: -o-linear-gradient(bottom, <?php echo esc_html( domnoo_get_config('main_color') ) ?>, <?php echo esc_html( domnoo_get_config('second_color') ) ?>); /* For Opera 11.1 to 12.0 */
					background: -moz-linear-gradient(bottom, <?php echo esc_html( domnoo_get_config('main_color') ) ?>, <?php echo esc_html( domnoo_get_config('second_color') ) ?>); /* For Firefox 3.6 to 15 */
					background: linear-gradient(to bottom, <?php echo esc_html( domnoo_get_config('main_color') ) ?> , <?php echo esc_html( domnoo_get_config('second_color') ) ?>); /* Standard syntax */
				}
			<?php endif; ?>

			<?php if ( domnoo_get_config('button_color') != "" ) : ?>
				/* check second background color */
				#add_payment_method .wc-proceed-to-checkout a.checkout-button, .woocommerce-cart .wc-proceed-to-checkout a.checkout-button, .woocommerce-checkout .wc-proceed-to-checkout a.checkout-button,
				.widget-information-box .btn-shop,
				.owl-carousel .owl-controls .owl-nav .owl-prev, .owl-carousel .owl-controls .owl-nav .owl-next,
				.details-product .information .cart .btn,
				.add-fix-top,
				.widget-banner .readmore,
				.product-block.grid .infor .button, .product-block.grid .infor .add_to_cart_button,
				.btn.btn-theme
				{
					background-color: <?php echo esc_html( domnoo_get_config('button_color') ); ?>;
				}
				#add_payment_method .wc-proceed-to-checkout a.checkout-button, .woocommerce-cart .wc-proceed-to-checkout a.checkout-button, .woocommerce-checkout .wc-proceed-to-checkout a.checkout-button,
				.widget-banner .readmore,
				.product-block.grid .infor .button, .product-block.grid .infor .add_to_cart_button,
				.btn.btn-theme
				{
					border-color: <?php echo esc_html( domnoo_get_config('button_color') ); ?>;
				}

			<?php endif; ?>

			<?php if ( domnoo_get_config('button_hover_color') != "" ) : ?>
				/* check second background color */
				.btn-white:active, .btn-white:hover,
				#add_payment_method .wc-proceed-to-checkout a.checkout-button:hover, #add_payment_method .wc-proceed-to-checkout a.checkout-button:active, .woocommerce-cart .wc-proceed-to-checkout a.checkout-button:hover, .woocommerce-cart .wc-proceed-to-checkout a.checkout-button:active, .woocommerce-checkout .wc-proceed-to-checkout a.checkout-button:hover, .woocommerce-checkout .wc-proceed-to-checkout a.checkout-button:active,
				.widget-information-box .btn-shop:hover, .widget-information-box .btn-shop:active,
				.owl-carousel .owl-controls .owl-nav .owl-prev:active, .owl-carousel .owl-controls .owl-nav .owl-prev:hover, .owl-carousel .owl-controls .owl-nav .owl-next:active, .owl-carousel .owl-controls .owl-nav .owl-next:hover,
				.details-product .information .cart .btn:active, .details-product .information .cart .btn:hover,
				.add-fix-top:focus, .add-fix-top:active, .add-fix-top:hover,
				.widget-banner .readmore:hover, .widget-banner .readmore:active,
				.product-block.grid .infor .button:hover, .product-block.grid .infor .add_to_cart_button:hover,
				.btn-outline.btn-white:active, .btn-outline.btn-white:hover,
				.btn.btn-theme:hover, .btn.btn-theme:focus, .btn.btn-theme:active, .btn.btn-theme.active
				{
					background-color: <?php echo esc_html( domnoo_get_config('button_hover_color') ); ?>;
				}
				.cart_item a.remove:hover, .cart_item a.remove:active{
					background-color: <?php echo esc_html( domnoo_get_config('button_hover_color') ); ?> !important;
				}
				.btn-white:active, .btn-white:hover,
				.cart_item a.remove:hover, .cart_item a.remove:active,
				#add_payment_method .wc-proceed-to-checkout a.checkout-button:hover, #add_payment_method .wc-proceed-to-checkout a.checkout-button:active, .woocommerce-cart .wc-proceed-to-checkout a.checkout-button:hover, .woocommerce-cart .wc-proceed-to-checkout a.checkout-button:active, .woocommerce-checkout .wc-proceed-to-checkout a.checkout-button:hover, .woocommerce-checkout .wc-proceed-to-checkout a.checkout-button:active,
				.widget-banner .readmore:hover, .widget-banner .readmore:active,
				.product-block.grid .infor .button:hover, .product-block.grid .infor .add_to_cart_button:hover,
				.btn-outline.btn-white:active, .btn-outline.btn-white:hover,
				.btn.btn-theme:hover, .btn.btn-theme:focus, .btn.btn-theme:active, .btn.btn-theme.active
				{
					border-color: <?php echo esc_html( domnoo_get_config('button_hover_color') ); ?>;
				}

			<?php endif; ?>

			/***************************************************************/
			/* Top Bar *****************************************************/
			/***************************************************************/
			/* Top Bar Backgound */
			<?php $topbar_bg = domnoo_get_config('topbar_bg'); ?>
			<?php if ( !empty($topbar_bg) ) :
				$image = isset($topbar_bg['background-image']) ? str_replace(array('http://', 'https://'), array('//', '//'), $topbar_bg['background-image']) : '';
				$topbar_bg_image = $image && $image != 'none' ? 'url('.esc_url($image).')' : $image;
			?>
				#apus-topbar {
					<?php if ( isset($topbar_bg['background-color']) && $topbar_bg['background-color'] ): ?>
				    background-color: <?php echo esc_html( $topbar_bg['background-color'] ) ?>;
				    <?php endif; ?>
				    <?php if ( isset($topbar_bg['background-repeat']) && $topbar_bg['background-repeat'] ): ?>
				    background-repeat: <?php echo esc_html( $topbar_bg['background-repeat'] ) ?>;
				    <?php endif; ?>
				    <?php if ( isset($topbar_bg['background-size']) && $topbar_bg['background-size'] ): ?>
				    background-size: <?php echo esc_html( $topbar_bg['background-size'] ) ?>;
				    <?php endif; ?>
				    <?php if ( isset($topbar_bg['background-attachment']) && $topbar_bg['background-attachment'] ): ?>
				    background-attachment: <?php echo esc_html( $topbar_bg['background-attachment'] ) ?>;
				    <?php endif; ?>
				    <?php if ( isset($topbar_bg['background-position']) && $topbar_bg['background-position'] ): ?>
				    background-position: <?php echo esc_html( $topbar_bg['background-position'] ) ?>;
				    <?php endif; ?>
				    <?php if ( $topbar_bg_image ): ?>
				    background-image: <?php echo esc_html( $topbar_bg_image ) ?>;
				    <?php endif; ?>
				}
			<?php endif; ?>
			/* Top Bar Color */
			<?php if ( domnoo_get_config('topbar_text_color') != "" ) : ?>
				#apus-topbar {
					color: <?php echo esc_html(domnoo_get_config('topbar_text_color')); ?>;
				}
			<?php endif; ?>
			/* Top Bar Link Color */
			<?php if ( domnoo_get_config('topbar_link_color') != "" ) : ?>
				#apus-topbar a {
					color: <?php echo esc_html(domnoo_get_config('topbar_link_color')); ?>;
				}
			<?php endif; ?>

			/***************************************************************/
			/* Header *****************************************************/
			/***************************************************************/
			/* Header Backgound */
			<?php $header_bg = domnoo_get_config('header_bg'); ?>
			<?php if ( !empty($header_bg) ) :
				$image = isset($header_bg['background-image']) ? str_replace(array('http://', 'https://'), array('//', '//'), $header_bg['background-image']) : '';
				$header_bg_image = $image && $image != 'none' ? 'url('.esc_url($image).')' : $image;
			?>	
				<?php if ( isset($header_bg['background-color']) && $header_bg['background-color'] ): ?>
					.header-v1:before{
						background-image: none;
					}
			    <?php endif; ?>

				.header-v1:before,
				.header-transparent .header-v2 .header-middle,
				#apus-header {
					<?php if ( isset($header_bg['background-color']) && $header_bg['background-color'] ): ?>
				    background-color: <?php echo esc_html( $header_bg['background-color'] ) ?>;
				    <?php endif; ?>
				    <?php if ( isset($header_bg['background-repeat']) && $header_bg['background-repeat'] ): ?>
				    background-repeat: <?php echo esc_html( $header_bg['background-repeat'] ) ?>;
				    <?php endif; ?>
				    <?php if ( isset($header_bg['background-size']) && $header_bg['background-size'] ): ?>
				    background-size: <?php echo esc_html( $header_bg['background-size'] ) ?>;
				    <?php endif; ?>
				    <?php if ( isset($header_bg['background-attachment']) && $header_bg['background-attachment'] ): ?>
				    background-attachment: <?php echo esc_html( $header_bg['background-attachment'] ) ?>;
				    <?php endif; ?>
				    <?php if ( isset($header_bg['background-position']) && $header_bg['background-position'] ): ?>
				    background-position: <?php echo esc_html( $header_bg['background-position'] ) ?>;
				    <?php endif; ?>
				    <?php if ( $header_bg_image ): ?>
				    background-image: <?php echo esc_html( $header_bg_image ) ?>;
				    <?php endif; ?>
				}
			<?php endif; ?>
			/* Header Color */
			<?php if ( domnoo_get_config('header_text_color') != "" ) : ?>
				#apus-header {
					color: <?php echo esc_html(domnoo_get_config('header_text_color')); ?>;
				}
			<?php endif; ?>
			/* Header Link Color */
			<?php if ( domnoo_get_config('header_link_color') != "" ) : ?>
				#apus-header a {
					color: <?php echo esc_html(domnoo_get_config('header_link_color'));?> ;
				}
			<?php endif; ?>
			/* Header Link Color Active */
			<?php if ( domnoo_get_config('header_link_color_active') != "" ) : ?>
				#apus-header .active > a,
				#apus-header a:active,
				#apus-header a:hover {
					color: <?php echo esc_html(domnoo_get_config('header_link_color_active')); ?>;
				}
			<?php endif; ?>


			/* Menu Link Color */
			<?php if ( domnoo_get_config('main_menu_link_color') != "" ) : ?>
				.navbar-nav.megamenu > li > a{
					color: <?php echo esc_html(domnoo_get_config('main_menu_link_color'));?> !important;
				}
			<?php endif; ?>
			
			/* Menu Link Color Active */
			<?php if ( domnoo_get_config('main_menu_link_color_active') != "" ) : ?>
				.navbar-nav.megamenu > li:hover > a,
				.navbar-nav.megamenu > li.active > a,
				.navbar-nav.megamenu > li > a:hover,
				.navbar-nav.megamenu > li > a:active
				{
					color: <?php echo esc_html(domnoo_get_config('main_menu_link_color_active')); ?> !important;
				}
			<?php endif; ?>
			<?php if ( domnoo_get_config('main_menu_link_color_active') != "" ) : ?>
				.navbar-nav.megamenu > li.active > a,
				.navbar-nav.megamenu > li:hover > a{
					border-color: <?php echo esc_html(domnoo_get_config('main_menu_link_color_active'));?> !important;
				}
			<?php endif; ?>

			/***************************************************************/
			/* Footer *****************************************************/
			/***************************************************************/
			/* Footer Backgound */
			<?php $footer_bg = domnoo_get_config('footer_bg'); ?>
			<?php if ( !empty($footer_bg) ) :
				$image = isset($footer_bg['background-image']) ? str_replace(array('http://', 'https://'), array('//', '//'), $footer_bg['background-image']) : '';
				$footer_bg_image = $image && $image != 'none' ? 'url('.esc_url($image).')' : $image;
			?>
				#apus-footer {
					<?php if ( isset($footer_bg['background-color']) && $footer_bg['background-color'] ): ?>
				    background-color: <?php echo esc_html( $footer_bg['background-color'] ) ?>;
				    <?php endif; ?>
				    <?php if ( isset($footer_bg['background-repeat']) && $footer_bg['background-repeat'] ): ?>
				    background-repeat: <?php echo esc_html( $footer_bg['background-repeat'] ) ?>;
				    <?php endif; ?>
				    <?php if ( isset($footer_bg['background-size']) && $footer_bg['background-size'] ): ?>
				    background-size: <?php echo esc_html( $footer_bg['background-size'] ) ?>;
				    <?php endif; ?>
				    <?php if ( isset($footer_bg['background-attachment']) && $footer_bg['background-attachment'] ): ?>
				    background-attachment: <?php echo esc_html( $footer_bg['background-attachment'] ) ?>;
				    <?php endif; ?>
				    <?php if ( isset($footer_bg['background-position']) && $footer_bg['background-position'] ): ?>
				    background-position: <?php echo esc_html( $footer_bg['background-position'] ) ?>;
				    <?php endif; ?>
				    <?php if ( $footer_bg_image ): ?>
				    background-image: <?php echo esc_html( $footer_bg_image ) ?>;
				    <?php endif; ?>
				}
			<?php endif; ?>
			/* Footer Heading Color*/
			<?php if ( domnoo_get_config('footer_heading_color') != "" ) : ?>
				#apus-footer h1, #apus-footer h2, #apus-footer h3, #apus-footer h4, #apus-footer h5, #apus-footer h6 ,#apus-footer .widget-title {
					color: <?php echo esc_html(domnoo_get_config('footer_heading_color')); ?> !important;
				}
			<?php endif; ?>
			/* Footer Color */
			<?php if ( domnoo_get_config('footer_text_color') != "" ) : ?>
				#apus-footer {
					color: <?php echo esc_html(domnoo_get_config('footer_text_color')); ?>;
				}
			<?php endif; ?>
			/* Footer Link Color */
			<?php if ( domnoo_get_config('footer_link_color') != "" ) : ?>
				#apus-footer a {
					color: <?php echo esc_html(domnoo_get_config('footer_link_color')); ?>;
				}
			<?php endif; ?>

			/* Footer Link Color Hover*/
			<?php if ( domnoo_get_config('footer_link_color_hover') != "" ) : ?>
				#apus-footer a:hover {
					color: <?php echo esc_html(domnoo_get_config('footer_link_color_hover')); ?>;
				}
			<?php endif; ?>




			/***************************************************************/
			/* Copyright *****************************************************/
			/***************************************************************/
			/* Copyright Backgound */
			<?php $copyright_bg = domnoo_get_config('copyright_bg'); ?>
			<?php if ( !empty($copyright_bg) ) :
				$image = isset($copyright_bg['background-image']) ? str_replace(array('http://', 'https://'), array('//', '//'), $copyright_bg['background-image']) : '';
				$copyright_bg_image = $image && $image != 'none' ? 'url('.esc_url($image).')' : $image;
			?>
				.apus-copyright {
					<?php if ( isset($copyright_bg['background-color']) && $copyright_bg['background-color'] ): ?>
				    background-color: <?php echo esc_html( $copyright_bg['background-color'] ) ?> !important;
				    <?php endif; ?>
				    <?php if ( isset($copyright_bg['background-repeat']) && $copyright_bg['background-repeat'] ): ?>
				    background-repeat: <?php echo esc_html( $copyright_bg['background-repeat'] ) ?>;
				    <?php endif; ?>
				    <?php if ( isset($copyright_bg['background-size']) && $copyright_bg['background-size'] ): ?>
				    background-size: <?php echo esc_html( $copyright_bg['background-size'] ) ?>;
				    <?php endif; ?>
				    <?php if ( isset($copyright_bg['background-attachment']) && $copyright_bg['background-attachment'] ): ?>
				    background-attachment: <?php echo esc_html( $copyright_bg['background-attachment'] ) ?>;
				    <?php endif; ?>
				    <?php if ( isset($copyright_bg['background-position']) && $copyright_bg['background-position'] ): ?>
				    background-position: <?php echo esc_html( $copyright_bg['background-position'] ) ?>;
				    <?php endif; ?>
				    <?php if ( $copyright_bg_image ): ?>
				    background-image: <?php echo esc_html( $copyright_bg_image ) ?> !important;
				    <?php endif; ?>
				}
			<?php endif; ?>

			/* Footer Color */
			<?php if ( domnoo_get_config('copyright_text_color') != "" ) : ?>
				.apus-copyright {
					color: <?php echo esc_html(domnoo_get_config('copyright_text_color')); ?>;
				}
			<?php endif; ?>
			/* Footer Link Color */
			<?php if ( domnoo_get_config('copyright_link_color') != "" ) : ?>
				.apus-copyright a {
					color: <?php echo esc_html(domnoo_get_config('copyright_link_color')); ?>;
				}
			<?php endif; ?>

			/* Footer Link Color Hover*/
			<?php if ( domnoo_get_config('copyright_link_color_hover') != "" ) : ?>
				.apus-copyright a:hover {
					color: <?php echo esc_html(domnoo_get_config('copyright_link_color_hover')); ?>;
				}
			<?php endif; ?>

			/* Woocommerce Breadcrumbs */
			<?php if ( domnoo_get_config('breadcrumbs') == "0" ) : ?>
			.woocommerce .woocommerce-breadcrumb,
			.woocommerce-page .woocommerce-breadcrumb
			{
				display:none;
			}
			<?php endif; ?>

			/* Custom CSS */
			<?php if ( domnoo_get_config('custom_css') != "" ) : ?>
				<?php echo domnoo_get_config('custom_css') ?>
			<?php endif; ?>


	<?php
		$content = ob_get_clean();
		$content = str_replace(array("\r\n", "\r"), "\n", $content);
		$lines = explode("\n", $content);
		$new_lines = array();
		foreach ($lines as $i => $line) {
			if (!empty($line)) {
				$new_lines[] = trim($line);
			}
		}
		
		return implode($new_lines);
	}
}
