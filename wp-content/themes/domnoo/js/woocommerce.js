(function($) {
	"use strict";
    
    

    var apusWoo = {
        init: function(){
            var self = this;
            // login register
            self.loginRegister();
            // quickview
            self.quickviewInit();
            //detail
            self.productDetail();
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                self.loadImages();
            });
            $('body').on('click', '.apus-shop-header #apus-categories a', function(e) {
                e.preventDefault();
                self.getPageData($(this).attr('href'));
            });
            $('.apus-shop-header').on('click', '#apus-shop-sidebar .widget_product_categories a', function(e) {
                e.preventDefault();
                self.getPageData($(this).attr('href'));
            });
            $('.apus-shop-header').on('click', '#apus-shop-sidebar .widget_layered_nav a', function(e) {
                e.preventDefault();
                self.getPageData($(this).attr('href'));
            });
            $('.apus-shop-header').on('click', '#apus-shop-sidebar .widget_layered_nav_filters a', function(e) {
                e.preventDefault();
                self.getPageData($(this).attr('href'));
            });
            $('.apus-shop-header').on('click', '#apus-shop-sidebar .widget_price_filter a', function(e) {
                e.preventDefault();
                self.getPageData($(this).attr('href'));
            });
            $('.apus-shop-header').on('click', '#apus-shop-sidebar .apus_widget_product_sorting a', function(e) {
                e.preventDefault();
                self.getPageData($(this).attr('href'));
            });
            $('.apus-shop-header').on('click', '#apus-shop-sidebar .widget_product_tag_cloud a', function(e) {
                e.preventDefault();
                self.getPageData($(this).attr('href'), false, true);
            });
            $('.apus-shop-header').on('click', '#apus-shop-sidebar .widget_orderby a', function(e) {
                e.preventDefault();
                self.getPageData($(this).attr('href'), false, true);
            });
            // categories dropdown
            $('.apus-shop-header').on('click', '#apus-categories-dropdown a', function(e) {
                e.preventDefault();
                $('#apus-categories-dropdown .category-dropdown-label span').text($(this).text());
                self.getPageData($(this).attr('href'), false, true);
            });
            if ( $('.apus-shop-header #apus-categories-dropdown li.active').length > 0 ) {
                $('.apus-shop-header #apus-categories-dropdown .category-dropdown-label span').text($('.apus-shop-header #apus-categories-dropdown li.active').text());
            }
            // sortby
            $('.apus-shop-header').on('click', '#apus-orderby a', function(e) {
                e.preventDefault();
                $('#apus-orderby .orderby-label span').text($(this).text());
                self.getPageData($(this).attr('href'), false, true);
            });
            if ( $('#apus-orderby li.active').length > 0 ) {
                $('#apus-orderby .orderby-label span').text($('#apus-orderby li.active').text());
            }
            //reset
            $('body').on('click', '.apus-results a', function(e){
                e.preventDefault();
                self.getPageData($(this).attr('href'), false, true);
            });

            // ajax pagination
            if ( $('.ajax-pagination').length ) {
                setTimeout(function(){
                    self.initAjaxPaging();    
                }, 500);
            }
            // load image
            setTimeout(function(){
                self.loadImages();
            }, 300);

            // filter action
            $('body').on('click', '#apus-filter-menu .filter-action', function(e) {
                e.preventDefault();
                $('.apus-sidebar-header').slideToggle(300);
                if ( $(this).find('i').hasClass('icon-equalizer') ) {
                    $(this).find('i').removeClass('icon-equalizer').addClass('icon-close');
                } else {
                    $(this).find('i').removeClass('icon-close').addClass('icon-equalizer');
                }
                if ($('.apus-shop-header').hasClass('filter-active')) {
                    $('.apus-shop-header').removeClass('filter-active');
                } else {
                    $('.apus-shop-header').addClass('filter-active');
                }
            });

            if ( domnoo_woo_options.enable_search == '1') {
                self.searchProduct();
            }

            //
            
            $('.widget-products-special .products-thumb .product-thumb-item').each(function(e){
                $(this).click(function(event){
                    event.preventDefault();
                    $('.widget-products-special .owl-carousel').trigger("to.owl.carousel", [e, 0, true]);
                    
                    $('.widget-products-special .products-thumb .product-thumb-item').removeClass('active');
                    $(this).addClass('active');
                    return false;
                });
            });
            $('.widget-products-special .owl-carousel').on('changed.owl.carousel', function(event) {
                setTimeout(function(){
                    var index = 0;
                    $('.widget-products-special .owl-carousel .owl-item').each(function(i){
                        if ($(this).hasClass('active')){
                            index = i;
                        }
                    });
                    $('.widget-products-special .products-thumb .product-thumb-item').removeClass('active');
                    $('.widget-products-special .products-thumb .product-thumb-item').eq(index).addClass('active');
                    
                },50);
            });
        },
        loginRegister: function(){
            $('body').on( 'click', '.register-login-action', function(e){
                e.preventDefault();
                var href = $(this).attr('href');
                setCookie('domnoo_login_register', href, 0.5);
                $('.register_login_wrapper').removeClass('active');
                $(href).addClass('active');
            } );
        },
        searchProduct: function(){
            $('.apus-autocompleate-input').typeahead({
                    'hint': false,
                    'highlight': true
                }, {
                    name: 'search',
                    source: function (query, processSync, processAsync) {
                        processSync([domnoo_woo_options.empty_msg]);
                        $('.twitter-typeahead').addClass('loading');
                        return $.ajax({
                            url: domnoo_woo_options.ajaxurl, 
                            type: 'GET',
                            data: {'s': query, 'action': 'domnoo_autocomplete_search'},
                            dataType: 'json',
                            success: function (json) {
                                $('.twitter-typeahead').removeClass('loading');
                                return processAsync(json);
                            }
                        });
                    },
                    templates: {
                        empty : [
                            '<div class="empty-message">',
                            domnoo_woo_options.empty_msg,
                            '</div>'
                        ].join('\n'),
                        suggestion: Handlebars.compile( domnoo_woo_options.template )
                    }
                }
            );
        },
        productDetail: function(){
            // product thumbs
            $('.thumbnails-image-carousel .thumb-link, .thumbnails-image .thumb-link').each(function(e){
                $(this).click(function(event){
                    event.preventDefault();
                    $('.main-image-carousel').trigger("to.owl.carousel", [e, 0, true]);
                    
                    $('.thumbnails-image .thumb-link').removeClass('active');
                    $(this).addClass('active');
                    return false;
                });
            });
            $('.main-image-carousel').on('changed.owl.carousel', function(event) {
                setTimeout(function(){
                    var index = 0;
                    $('.main-image-carousel .owl-item').each(function(i){
                        if ($(this).hasClass('active')){
                            index = i;
                        }
                    });
                    $('.thumbnails-image .thumb-link').removeClass('active');
                    
                    if ( $('.thumbnails-image .lite-carousel-play').length > 0 ) {
                        $('.thumbnails-image li').eq(index).find('.thumb-link').addClass('active');
                    } else {
                        $('.thumbnails-image .owl-item').eq(index).find('.thumb-link').addClass('active');
                    }
                },50);
            });

            $('.product-images-owl .owl-carousel').each(function(){
                var self = $(this);
                var owl = $(this);
                
                setTimeout(function(){
                    owl.find('.owl-item .featured-image').removeClass('active');
                    owl.find('.owl-item.active').eq(1).find('.featured-image').addClass('active');
                }, 50);
                owl.on('changed.owl.carousel',function(property){
                    setTimeout(function(){
                        owl.find('.owl-item .featured-image').removeClass('active');
                        owl.find('.owl-item.active').eq(1).find('.featured-image').addClass('active');
                    }, 50);
                });
            });
            
            // review click link
            $('.woocommerce-review-link').click(function(){
                $('.woocommerce-tabs a[href="#tabs-list-reviews"]').click();
                $('html, body').animate({
                    scrollTop: $("#reviews").offset().top
                }, 1000);
                return false;
            });
        },
        quickviewInit: function(){
            $(document).on('click', 'a.quickview', function (e) {
                e.preventDefault();
                var self = $(this);
                self.parent().parent().parent().addClass('loading');
                var product_id = $(this).data('product_id');
                var url = domnoo_woo_options.ajaxurl + '?action=domnoo_quickview_product&product_id=' + product_id;
                
                $.get(url,function(data,status){
                    $.magnificPopup.open({
                        mainClass: 'apus-mfp-zoom-in',
                        items : {
                            src : data,
                            type: 'inline'
                        }
                    });
                    // variation
                    if ( typeof wc_add_to_cart_variation_params !== 'undefined' ) {
                        $( '.variations_form' ).each( function() {
                            $( this ).wc_variation_form().find('.variations select:eq(0)').change();
                        });
                    }

                    var config = {
                        loop: false,
                        nav: true,
                        dots: false,
                        items: 1,
                        navText: ['<span class="ion-ios-arrow-left"></span>', '<span class="ion-ios-arrow-right"></span>'],
                        responsive: {0:{items: 1}, 320:{items: 1}, 768:{items: 1}, 980:{items: 1}, 1280:{items: 1}}
                    };
                    $(".quickview-owl").owlCarousel( config );

                    self.parent().parent().parent().removeClass('loading');
                });
            });
        },
        getPageData: function(pageUrl, isBackButton, isProductTag){
            var self = this;
            if (self.loadAjax) {
                return false;
            }
            
            if (pageUrl) {
                self.setCurrentUrl(isProductTag);
                // loading
                self.showLoading();
                
                pageUrl = pageUrl.replace(/\/?(\?|#|$)/, '/$1');
                
                if ( !isBackButton ) {
                    self.pushState(pageUrl);
                }

                self.loadAjax = $.ajax({
                    url: pageUrl,
                    data: {load_type: 'full'},
                    dataType: 'html',
                    cache: false,
                    headers: {'cache-control': 'no-cache'},
                    method: 'POST',
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        console.log('Apus: AJAX error - getPageData() - ' + errorThrown);
                        self.hideLoading();
                        self.loadAjax = false;
                    },
                    success: function(response) {
                        // Update shop content
                        self.updateContent(response);
                        self.loadAjax = false;
                    }
                });
                
            }
        },
        hideLoading: function(){
            $('body').find('#apus-shop-products-wrapper').removeClass('loading');
        },
        showLoading: function(){
            $('body').find('#apus-shop-products-wrapper').addClass('loading');
        },
        pushState: function(pageUrl) {
            window.history.pushState({apusShop: true}, '', pageUrl);
        },
        setCurrentUrl: function(isProductTag) {
            var self = this;
            if (!self.isProductTagUrl) {
                self.searchAndTagsResetURL = window.location.href;
            }
            self.isProductTagUrl = (isProductTag) ? true : false;
        },
        updateContent: function(ajaxHTML) {
            var self = this,
                $ajaxHTML = $('<div>' + ajaxHTML + '</div>'),
                wpTitle = $ajaxHTML.find('#apus-wp-title').text(),
                $categories = $ajaxHTML.find('#apus-categories'),
                $categories_dropdown = $ajaxHTML.find('#apus-categories-dropdown'),
                $sidebar = $ajaxHTML.find('#apus-shop-sidebar .apus-sidebar-inner'),
                $orderby = $ajaxHTML.find('#apus-orderby'),
                $shop = $ajaxHTML.find('#apus-shop-products-wrapper');

            // Page title
            if (wpTitle.length) {
                document.title = wpTitle;
            }
                                         
            // replace categories
            if ($categories.length) { 
                var $shopCategories = $('#apus-categories');
                $shopCategories.replaceWith($categories); 
            }
            // Replace categories dropdown
            if ( $categories_dropdown.length ) {
                var $shopCategories = $('#apus-categories-dropdown');
                $shopCategories.replaceWith($categories_dropdown); 
            }
            // Replace orderby
            if ( $orderby.length ) {
                var $shopOrderby = $('#apus-orderby');
                $shopOrderby.replaceWith($orderby); 
            }

            // Prepare/replace sidebar filters
            if ($sidebar.length) {
                var $shopSidebar = $('#apus-shop-sidebar .apus-sidebar-inner');
                $shopSidebar.replaceWith($sidebar);
            }
            
            // Replace shop
            if ($shop.length) {
                $('#apus-shop-products-wrapper').replaceWith($shop);
            }

            // init categories
            if ( $('.apus-shop-header #apus-categories-dropdown li.active').length > 0 ) {
                $('.apus-shop-header #apus-categories-dropdown .category-dropdown-label span').text($('.apus-shop-header #apus-categories-dropdown li.active').text());
            }
            
            if ( $('.apus-shop-header #apus-orderby li.active').length > 0 ) {
                $('.apus-shop-header #apus-orderby .orderby-label span').text($('.apus-shop-header #apus-orderby li.active').text());
            }
            // load owl
            self.owlInit();
            // Isoto Load
            setTimeout(function(){
                self.isotopeInit();    
            }, 50);
            // Load images
            self.loadImages();
            // paging
            self.initAjaxPaging();

            setTimeout(function() {
                self.hideLoading();
            }, 100);
        },
        initAjaxPaging: function() {
            var self = this, $infiniteLoadControls = $('#apus-shop-products-wrapper .ajax-pagination');
            
            self.infiniteLoadScroll = false;
            if ( $infiniteLoadControls.hasClass('infinite-action') ) {
                 self.infiniteLoadScroll = true;
            }

            if (self.infiniteLoadScroll) {
                self.infscrollLock = false;
                
                var scrollBottomHeight,
                    bottomHeight = Math.round($(document).height() - $infiniteLoadControls.offset().top);
                
                var to = null;
                $(window).resize(function() {
                    if (to) { clearTimeout(to); }
                    to = setTimeout(function() {
                        bottomHeight = Math.round($(document).height() - $infiniteLoadControls.offset().top);
                    }, 100);
                });
                
                $(window).scroll(function(){
                    if (self.infscrollLock) {
                        return;
                    }
                    scrollBottomHeight = 0 + $(document).height() - ($(window).scrollTop()) - $(window).height();
                    if (scrollBottomHeight < bottomHeight) {
                        self.ajaxPaging();
                    }
                });
            } else {
                $('body').on('click', '#apus-shop-products-wrapper .apus-loadmore-btn', function(e) {
                    e.preventDefault();
                    self.ajaxPaging();
                });
            }
            
            if (self.infiniteLoadScroll) {
                $(window).trigger('scroll');
            }
        },
        ajaxPaging: function() {
            var self = this;
            
            if (self.loadAjax) {
                return false;
            }
            
            var $nextPageLink = $('.apus-pagination-next-link').find('a'),
                $infiniteLoadControls = $('.ajax-pagination'),
                nextPageUrl = $nextPageLink.attr('href');
            
            if (nextPageUrl) {
                // loader
                $infiniteLoadControls.addClass('apus-loader');
                
                self.loadAjax = $.ajax({
                    url: nextPageUrl,
                    data: {load_type: 'products'},
                    dataType: 'html',
                    cache: false,
                    headers: {'cache-control': 'no-cache'},
                    method: 'GET',
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        console.log('APUS: AJAX error - ajaxPaging() - ' + errorThrown);
                    },
                    complete: function() {
                        $infiniteLoadControls.removeClass('apus-loader');
                    },
                    success: function(res) {
                        var $response = $('<div>' + res + '</div>'), $moreProducts = $response.children('.apus-products');
                        
                        // add new products
                        if ( $('.apus-shop-products-wrapper').data('layout_type') == 'mansory' ) {
                            var $new = $moreProducts.find('.isotope-item').appendTo($('.apus-shop-products-wrapper .products .isotope-items'));
                            // load owl
                            self.owlInit();
                            setTimeout(function(){
                                $('.apus-shop-products-wrapper').find('.isotope-items').isotope( 'insert', $new );    
                            }, 50);
                            
                        } else {
                            $('.apus-shop-products-wrapper .products .row').append($moreProducts);
                            // load owl
                            self.owlInit();
                        }
                        
                        // load images
                        self.loadImages();
                        
                        nextPageUrl = $response.find('.apus-pagination-next-link').children('a').attr('href');
                        
                        if (nextPageUrl) {
                            $nextPageLink.attr('href', nextPageUrl);
                        } else {
                            $('.apus-shop-products-wrapper').addClass('all-products-loaded');
                            
                            if (self.infiniteLoadScroll) {
                                self.infscrollLock = true;
                            }
                            $infiniteLoadControls.find('.apus-loadmore-btn').addClass('hidden');
                            $nextPageLink.removeAttr('href');
                        }
                        
                        self.loadAjax = false;
                        
                        if (self.infiniteLoadScroll) {
                            $(window).trigger('scroll');
                        }
                    }
                });
            } else {
                if (self.infiniteLoadScroll) {
                    self.infscrollLock = true;
                }
            }
        },
        loadImages: function() {
            var self = this;
            $(window).off('scroll.unveil resize.unveil lookup.unveil');
            var $images = $('body').find('.product-image:not(.image-loaded) .unveil-image');
            
            if ($images.length) {
                $images.unveil(1, function() {
                    $(this).load(function() {
                        $(this).parents('.product-image').first().addClass('image-loaded');
                    });
                });
            }
        },
        isotopeInit: function() {
            $('.isotope-items').each(function(){  
                var $container = jQuery(this);
                setTimeout( function(){
                    $container.isotope({
                        itemSelector : '.isotope-item',
                        transformsEnabled: true,         // Important for videos
                        masonry: {
                            columnWidth: $container.data('columnwidth')
                        },
                        stagger: 30
                    }); 
                }, 100 );
            });
        },
        owlInit: function() {
            $(".owl-carousel[data-carousel=owl]").each( function(){
                var config = {
                    loop: false,
                    nav: $(this).data( 'nav' ),
                    dots: $(this).data( 'pagination' ),
                    items: 4,
                    navText: ['<span class="ion-ios-arrow-thin-left"></span>', '<span class="ion-ios-arrow-thin-right"></span>']
                };
            
                var owl = $(this);
                if( $(this).data('items') ){
                    config.items = $(this).data( 'items' );
                }
                if( $(this).data('loop') ){
                    config.loop = true;
                }

                if ($(this).data('large')) {
                    var desktop = $(this).data('large');
                } else {
                    var desktop = config.items;
                }
                if ($(this).data('medium')) {
                    var medium = $(this).data('medium');
                } else {
                    var medium = config.items;
                }
                if ($(this).data('smallmedium')) {
                    var smallmedium = $(this).data('smallmedium');
                } else {
                    var smallmedium = config.items;
                }
                if ($(this).data('extrasmall')) {
                    var extrasmall = $(this).data('extrasmall');
                } else {
                    var extrasmall = 2;
                }
                if ($(this).data('verysmall')) {
                    var verysmall = $(this).data('verysmall');
                } else {
                    var verysmall = 1;
                }
                config.responsive = {
                    0:{
                        items:verysmall
                    },
                    320:{
                        items:extrasmall
                    },
                    768:{
                        items:smallmedium
                    },
                    980:{
                        items:medium
                    },
                    1280:{
                        items:desktop
                    }
                }
                if ( $('html').attr('dir') == 'rtl' ) {
                    config.rtl = true;
                }
                $(this).owlCarousel( config );
                // owl enable next, preview
                var viewport = jQuery(window).width();
                var itemCount = jQuery(".owl-item", $(this)).length;

                if(
                    (viewport >= 1280 && itemCount <= desktop) //desktop
                    || ((viewport >= 980 && viewport < 1280) && itemCount <= medium) //desktop
                    || ((viewport >= 768 && viewport < 980) && itemCount <= smallmedium) //tablet
                    || ((viewport >= 320 && viewport < 768) && itemCount <= extrasmall) //mobile
                    || (viewport < 320 && itemCount <= verysmall) //mobile
                ) {
                    $(this).find('.owl-prev, .owl-next').hide();
                }
            } );
        }
    };

    apusWoo.init();
})(jQuery)

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires+";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    }
    return "";
}