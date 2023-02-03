<?php

if ( ! function_exists( 'domnoo_body_classes' ) ) {
	function domnoo_body_classes( $classes ) {
		global $post;
		if ( is_page() && is_object($post) ) {
			$class = get_post_meta( $post->ID, 'apus_page_extra_class', true );
			if ( !empty($class) ) {
				$classes[] = trim($class);
			}
			$header_layout = domnoo_get_header_layout();
			if ( in_array($header_layout, array('v3', 'v4', 'v5')) ) {
				$classes[] = 'header_vertical_fixed';
			}
			$header_transparent = domnoo_page_header_transparent();
			if($header_transparent == 'yes'){
				$classes[] = ' header-transparent ';
			}
		}
		if ( domnoo_get_config('preload', true) ) {
			$classes[] = 'apus-body-loading';
		}
		if ( domnoo_get_config('image_lazy_loading') ) {
			$classes[] = 'image-lazy-loading';
		}
		return $classes;
	}
	add_filter( 'body_class', 'domnoo_body_classes' );
}

if ( ! function_exists( 'domnoo_get_shortcode_regex' ) ) {
	function domnoo_get_shortcode_regex( $tagregexp = '' ) {
		// WARNING! Do not change this regex without changing do_shortcode_tag() and strip_shortcode_tag()
		// Also, see shortcode_unautop() and shortcode.js.
		return
			'\\['                                // Opening bracket
			. '(\\[?)'                           // 1: Optional second opening bracket for escaping shortcodes: [[tag]]
			. "($tagregexp)"                     // 2: Shortcode name
			. '(?![\\w-])'                       // Not followed by word character or hyphen
			. '('                                // 3: Unroll the loop: Inside the opening shortcode tag
			. '[^\\]\\/]*'                   // Not a closing bracket or forward slash
			. '(?:'
			. '\\/(?!\\])'               // A forward slash not followed by a closing bracket
			. '[^\\]\\/]*'               // Not a closing bracket or forward slash
			. ')*?'
			. ')'
			. '(?:'
			. '(\\/)'                        // 4: Self closing tag ...
			. '\\]'                          // ... and closing bracket
			. '|'
			. '\\]'                          // Closing bracket
			. '(?:'
			. '('                        // 5: Unroll the loop: Optionally, anything between the opening and closing shortcode tags
			. '[^\\[]*+'             // Not an opening bracket
			. '(?:'
			. '\\[(?!\\/\\2\\])' // An opening bracket not followed by the closing shortcode tag
			. '[^\\[]*+'         // Not an opening bracket
			. ')*+'
			. ')'
			. '\\[\\/\\2\\]'             // Closing shortcode tag
			. ')?'
			. ')'
			. '(\\]?)';                          // 6: Optional second closing brocket for escaping shortcodes: [[tag]]
	}
}

if ( ! function_exists( 'domnoo_tagregexp' ) ) {
	function domnoo_tagregexp() {
		return apply_filters( 'domnoo_custom_tagregexp', 'video|audio|playlist|video-playlist|embed|domnoo_media' );
	}
}

if ( !function_exists('domnoo_class_container_vc') ) {
	function domnoo_class_container_vc($class, $isfullwidth, $post_type) {
		global $post;
		$fullwidth = false;
		if ( $post_type == 'apus_megamenu' ) {
			$fullwidth = false;
		} elseif ( $post_type == 'apus_footer' ) {
			$fullwidth = true;
		} else {
			if ( is_page() ) {
				$fullwidth  = get_post_meta( $post->ID, 'apus_page_fullwidth', true );
				if ( $fullwidth == 'no' ) {
					$fullwidth = false;
				} else {
					$fullwidth = true;
				}
			} elseif ( function_exists('is_woocommerce') && is_woocommerce() ) {
				if ( is_singular('product') ) {
					$fullwidth  = domnoo_get_config( 'product_single_fullwidth', false );
				} else {
					$fullwidth  = domnoo_get_config( 'product_archive_fullwidth', false );
				}
			} else {
				if ( is_singular('post') ) {
					$fullwidth  = domnoo_get_config( 'post_single_fullwidth', false );
				} else {
					$fullwidth  = domnoo_get_config( 'post_archive_fullwidth', false );
				}
			}
		}

		if ( !$fullwidth || !$isfullwidth ) {
			return 'apus-'.$class;
		}
		return $class;
	}
}
add_filter( 'domnoo_class_container_vc', 'domnoo_class_container_vc', 1, 3);

if ( !function_exists('domnoo_get_header_layouts') ) {
	function domnoo_get_header_layouts() {
		$headers = array();
		$files = glob( get_template_directory() . '/headers/*.php' );
	    if ( !empty( $files ) ) {
	        foreach ( $files as $file ) {
	        	$header = str_replace( '.php', '', basename($file) );
	            $headers[$header] = $header;
	        }
	    }
		return $headers;
	}
}

if ( !function_exists('domnoo_get_header_layout') ) {
	function domnoo_get_header_layout() {
		global $post;
		if ( is_page() && is_object($post) && isset($post->ID) ) {
			return domnoo_page_header_layout();
		}
		return domnoo_get_config('header_type');
	}
	add_filter( 'domnoo_get_header_layout', 'domnoo_get_header_layout' );
}

if ( !function_exists('domnoo_get_footer_layouts') ) {
	function domnoo_get_footer_layouts() {
		$footers = array();
		$args = array(
			'posts_per_page'   => -1,
			'offset'           => 0,
			'orderby'          => 'date',
			'order'            => 'DESC',
			'post_type'        => 'apus_footer',
			'post_status'      => 'publish',
			'suppress_filters' => true 
		);
		$posts = get_posts( $args );
		foreach ( $posts as $post ) {
			$footers[$post->post_name] = $post->post_title;
		}
		return $footers;
	}
}

if ( !function_exists('domnoo_get_footer_layout') ) {
	function domnoo_get_footer_layout() {
		if ( is_page() ) {
			global $post;
			$footer = '';
			if ( is_object($post) && isset($post->ID) ) {
				$footer = get_post_meta( $post->ID, 'apus_page_footer_type', true );
				if ( empty($footer) || $footer == 'global' ) {
					return domnoo_get_config('footer_type', '');
				}
			}
			return $footer;
		}
		return domnoo_get_config('footer_type', '');
	}
	add_filter('domnoo_get_footer_layout', 'domnoo_get_footer_layout');
}

if ( !function_exists('domnoo_blog_content_class') ) {
	function domnoo_blog_content_class( $class ) {
		$page = 'archive';
		if ( is_singular( 'post' ) ) {
            $page = 'single';
        }
		if ( domnoo_get_config('blog_'.$page.'_fullwidth') ) {
			return 'container-fluid';
		}
		return $class;
	}
}
add_filter( 'domnoo_blog_content_class', 'domnoo_blog_content_class', 1 , 1  );


if ( !function_exists('domnoo_get_blog_layout_configs') ) {
	function domnoo_get_blog_layout_configs() {
		$page = 'archive';
		if ( is_singular( 'post' ) ) {
            $page = 'single';
        }
		$left = domnoo_get_config('blog_'.$page.'_left_sidebar');
		$right = domnoo_get_config('blog_'.$page.'_right_sidebar');

		switch ( domnoo_get_config('blog_'.$page.'_layout') ) {
		 	case 'left-main':
		 		$configs['left'] = array( 'sidebar' => $left, 'class' => 'col-md-4 col-sm-12 col-xs-12 hidden-sm hidden-xs'  );
		 		$configs['main'] = array( 'class' => 'col-md-8 col-sm-12 col-xs-12 pull-right' );
		 		break;
		 	case 'main-right':
		 		$configs['right'] = array( 'sidebar' => $right,  'class' => 'col-md-4 col-sm-12 col-xs-12 pull-right hidden-sm hidden-xs' ); 
		 		$configs['main'] = array( 'class' => 'col-md-8 col-sm-12 col-xs-12' );
		 		break;
	 		case 'main':
	 			$configs['main'] = array( 'class' => 'col-md-12 col-sm-12 col-xs-12' );
	 			break;
 			case 'left-main-right':
 				$configs['left'] = array( 'sidebar' => $left,  'class' => 'col-md-3 col-sm-12 col-xs-12'  );
		 		$configs['right'] = array( 'sidebar' => $right, 'class' => 'col-md-3 col-sm-12 col-xs-12' ); 
		 		$configs['main'] = array( 'class' => 'col-md-6 col-sm-12 col-xs-12' );
 				break;
		 	default:
		 		$configs['main'] = array( 'class' => 'col-md-12 col-sm-12 col-xs-12' );
		 		break;
		}

		return $configs; 
	}
}

if ( !function_exists('domnoo_page_content_class') ) {
	function domnoo_page_content_class( $class ) {
		global $post;
		if (is_object($post)) {
			$fullwidth = get_post_meta( $post->ID, 'apus_page_fullwidth', true );
			if ( !$fullwidth || $fullwidth == 'no' ) {
				return $class;
			}
		}
		return 'container-fluid';
	}
}
add_filter( 'domnoo_page_content_class', 'domnoo_page_content_class', 1 , 1  );

if ( !function_exists('domnoo_get_page_layout_configs') ) {
	function domnoo_get_page_layout_configs() {
		global $post;
		if ( is_object($post) ) {
			$left = get_post_meta( $post->ID, 'apus_page_left_sidebar', true );
			$right = get_post_meta( $post->ID, 'apus_page_right_sidebar', true );

			switch ( get_post_meta( $post->ID, 'apus_page_layout', true ) ) {
			 	case 'left-main':
			 		$configs['left'] = array( 'sidebar' => $left, 'class' => 'col-md-3 col-sm-3 col-xs-12'  );
			 		$configs['main'] = array( 'class' => 'col-md-9 col-sm-9 col-xs-12' );
			 		break;
			 	case 'main-right':
			 		$configs['right'] = array( 'sidebar' => $right,  'class' => 'col-md-3 col-sm-3 col-xs-12' ); 
			 		$configs['main'] = array( 'class' => 'col-md-9 col-sm-9 col-xs-12' );
			 		break;
		 		case 'main':
		 			$configs['main'] = array( 'class' => 'col-xs-12 clearfix' );
		 			break;
	 			case 'left-main-right':
	 				$configs['left'] = array( 'sidebar' => $left,  'class' => 'col-md-3 col-sm-3 col-xs-12'  );
			 		$configs['right'] = array( 'sidebar' => $right, 'class' => 'col-md-3 col-sm-3 col-xs-12' ); 
			 		$configs['main'] = array( 'class' => 'col-md-6 col-sm-6 col-xs-12' );
	 				break;
			 	default:
			 		$configs['main'] = array( 'class' => 'col-xs-12 clearfix' );
			 		break;
			}
		} else {
			$configs['main'] = array( 'class' => 'col-md-12' );
		}
		return $configs; 
	}
}

if ( !function_exists('domnoo_page_header_layout') ) {
	function domnoo_page_header_layout() {
		global $post;
		$header = get_post_meta( $post->ID, 'apus_page_header_type', true );
		if ( $header == 'global' ) {
			return domnoo_get_config('header_type');
		}
		return $header;
	}
}

if ( !function_exists('domnoo_page_header_transparent') ) {
	function domnoo_page_header_transparent() {
		global $post;
		$headertransparent = get_post_meta( $post->ID, 'apus_page_header_transparent', true );
		return $headertransparent;
	}
}

if ( ! function_exists( 'domnoo_get_first_url_from_string' ) ) {
	function domnoo_get_first_url_from_string( $string ) {
		$pattern = "/^\b(?:(?:https?|ftp):\/\/)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i";
		preg_match( $pattern, $string, $link );

		$link_return = ( ! empty( $link[0] ) ) ? $link[0] : false;
		$content = str_replace($link_return, "", $string);
        $content = apply_filters( 'the_content', $content);
        return array( 'link' => $link_return, 'content' => $content );
	}
}

if ( !function_exists( 'domnoo_get_link_attributes' ) ) {
	function domnoo_get_link_attributes( $string ) {
		preg_match( '/<a href="(.*?)">/i', $string, $atts );

		return ( ! empty( $atts[1] ) ) ? $atts[1] : '';
	}
}

if ( !function_exists( 'domnoo_post_media' ) ) {
	function domnoo_post_media( $content ) {
		$is_video = ( get_post_format() == 'video' ) ? true : false;
		$media = domnoo_get_first_url_from_string( $content );
		$media = $media['link'];
		if ( ! empty( $media ) ) {
			global $wp_embed;
			$content = do_shortcode( $wp_embed->run_shortcode( '[embed]' . $media . '[/embed]' ) );
		} else {
			$pattern = domnoo_get_shortcode_regex( domnoo_tagregexp() );
			preg_match( '/' . $pattern . '/s', $content, $media );
			if ( ! empty( $media[2] ) ) {
				if ( $media[2] == 'embed' ) {
					global $wp_embed;
					$content = do_shortcode( $wp_embed->run_shortcode( $media[0] ) );
				} else {
					$content = do_shortcode( $media[0] );
				}
			}
		}
		if ( ! empty( $media ) ) {
			$output = '<div class="entry-media">';
			$output .= ( $is_video ) ? '<div class="pro-fluid"><div class="pro-fluid-inner">' : '';
			$output .= $content;
			$output .= ( $is_video ) ? '</div></div>' : '';
			$output .= '</div>';

			return $output;
		}

		return false;
	}
}

if ( !function_exists( 'domnoo_post_gallery' ) ) {
	function domnoo_post_gallery( $content, $args = array() ) {
		$output = '';
		$defaults = array( 'size' => 'large' );
		$args = wp_parse_args( $args, $defaults );
	    $gallery_filter = domnoo_gallery_from_content( $content );
	    if (count($gallery_filter['ids']) > 0) {
        	$output .= '<div class="owl-carousel post-gallery-owl" data-smallmedium="1" data-extrasmall="1" data-items="1" data-carousel="owl" data-pagination="true" data-nav="true">';
                foreach($gallery_filter['ids'] as $attach_id) {
                    $output .= '<div class="gallery-item">';
                    $output .= wp_get_attachment_image($attach_id, $args['size'] );
                    $output .= '</div>';
                }
            $output .= '</div>';
        }
        return $output;
	}
}

if (!function_exists('domnoo_gallery_from_content')) {
    function domnoo_gallery_from_content($content) {

        $result = array(
            'ids' => array(),
            'filtered_content' => ''
        );

        preg_match('/\[gallery.*ids=.(.*).\]/', $content, $ids);
        if(!empty($ids)) {
            $result['ids'] = explode(",", $ids[1]);
            $content =  str_replace($ids[0], "", $content);
            $result['filtered_content'] = apply_filters( 'the_content', $content);
        }

        return $result;

    }
}

if ( !function_exists( 'domnoo_random_key' ) ) {
    function domnoo_random_key($length = 5) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $return = '';
        for ($i = 0; $i < $length; $i++) {
            $return .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $return;
    }
}

if ( !function_exists('domnoo_substring') ) {
    function domnoo_substring($string, $limit, $afterlimit = '[...]') {
        if ( empty($string) ) {
        	return $string;
        }
       	$string = explode(' ', strip_tags( $string ), $limit);

        if (count($string) >= $limit) {
            array_pop($string);
            $string = implode(" ", $string) .' '. $afterlimit;
        } else {
            $string = implode(" ", $string);
        }
        $string = preg_replace('`[[^]]*]`','',$string);
        return strip_shortcodes( $string );
    }
}
function domnoo_is_wc_quantity_increment_activated() {
	return class_exists( 'WooCommerce_Quantity_Increment' ) ? true : false;
}

function domnoo_is_woosw_activated() {
	return function_exists('woosw_init') ? true : false;
}