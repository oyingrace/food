<?php

if ( ! function_exists( 'domnoo_category' ) ) {
	function domnoo_category( $post ) {
		// format
		$post_format = get_post_format();
		$header_class = $post_format ? '' : 'border-left';
		echo '<span class="category "> ';
		$cat = wp_get_post_categories( $post->ID );
		$k   = count( $cat );
		foreach ( $cat as $c ) {
			$categories = get_category( $c );
			$k -= 1;
			if ( $k == 0 ) {
				echo '<a href="' . get_category_link( $categories->term_id ) . '" class="categories-name">' . $categories->name . '</a>';
			} else {
				echo '<a href="' . get_category_link( $categories->term_id ) . '" class="categories-name">' . $categories->name . '</a>';
			}
		}
		echo '</span>';
	}
}

if ( ! function_exists( 'domnoo_center_meta' ) ) {
	function domnoo_center_meta( $post ) {
		// format
		$post_format = get_post_format();
		$id = get_the_author_meta( 'ID' );
		echo '<div class="entry-meta">';
		if(!is_single()){
			the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' );
		} else {
			the_title( '<h4 class="entry-title">', '</h4>' );
		}
			echo "<div class='entry-create'>";
			echo "<span class='entry-date'>". get_the_date( 'M jS, Y' ).'</span>';
			echo "<span class='author'>".esc_html__( ' / By: ', 'domnoo' ).'<a href='.esc_url(get_author_posts_url( $id )).'>'.get_the_author().'</a>' .'</span>';
			echo '</div>';
		echo '</div>';
	}
}



if ( ! function_exists( 'domnoo_full_top_meta' ) ) {
	function domnoo_full_top_meta( $post ) {
		// format
		$post_format = get_post_format();
		$header_class = $post_format ? '' : 'border-left';
		echo '<header class="entry-create ' . $header_class . '">';
		if(!is_single()){
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		}
		// details
		$id = get_the_author_meta( 'ID' );
		echo '<span class="entry-date">' . esc_html( get_the_date( 'M jS, Y' ) ) . '</span><span class="entry-profile">
			
			
			<span class="entry-author-link">
				' . esc_html__( 'by:', 'domnoo' ) . '
				<span class="author vcard">
				<a class="url fn n" href="' . esc_url(get_author_posts_url( $id )) . '" rel="author">' . get_the_author() . '</a>
				</span>
			</span>
			
		</span>';
		// comments
		echo '<span class="entry-categories">in: ';
		$cat = wp_get_post_categories( $post->ID );
		$k   = count( $cat );
		foreach ( $cat as $c ) {
			$categories = get_category( $c );
			$k -= 1;
			if ( $k == 0 ) {
				echo '<a href="' . get_category_link( $categories->term_id ) . '" class="categories-name">' . $categories->name . '</a>';
			} else {
				echo '<a href="' . get_category_link( $categories->term_id ) . '" class="categories-name">' . $categories->name . ', </a>';
			}
		}
		echo '</span>';

		if ( ! is_search() ) {
			if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
				echo '<span class="entry-comments-link">';
				comments_popup_link( esc_html__( '0 Comments', 'domnoo' ), esc_html__( '1 Comment' , 'domnoo' ), esc_html__( '% Comments', 'domnoo' ) );
				echo '</span>';
			}
		}
		echo '</header>';
	}
}

if ( ! function_exists( 'domnoo_post_tags' ) ) {
	function domnoo_post_tags() {
		$posttags = get_the_tags();
		if ( $posttags ) {
			echo '<span class="entry-tags-list"><strong>'.'<i class="fa fa-tags" aria-hidden="true"></i>'.'</strong> ';
			$i = 1;
			$size = count( $posttags );
			foreach ( $posttags as $tag ) {
				echo '<a href="' . get_tag_link( $tag->term_id ) . '">';
				echo esc_attr($tag->name);
				echo '</a>';
				if ( $size != $i ) {
					echo '';
				}
				$i ++;
			}
			echo '</span>';
		}
	}
}

if ( ! function_exists( 'domnoo_post_format_link_helper' ) ) {
	function domnoo_post_format_link_helper( $content = null, $title = null, $post = null ) {
		if ( ! $content ) {
			$post = get_post( $post );
			$title = $post->post_title;
			$content = $post->post_content;
		}
		$link = domnoo_get_first_url_from_string( $content );
		if ( ! empty( $link ) ) {
			$title = '<a href="' . esc_url( $link ) . '" rel="bookmark">' . $title . '</a>';
			$content = str_replace( $link, '', $content );
		} else {
			$pattern = '/^\<a[^>](.*?)>(.*?)<\/a>/i';
			preg_match( $pattern, $content, $link );
			if ( ! empty( $link[0] ) && ! empty( $link[2] ) ) {
				$title = $link[0];
				$content = str_replace( $link[0], '', $content );
			} elseif ( ! empty( $link[0] ) && ! empty( $link[1] ) ) {
				$atts = shortcode_parse_atts( $link[1] );
				$target = ( ! empty( $atts['target'] ) ) ? $atts['target'] : '_self';
				$title = ( ! empty( $atts['title'] ) ) ? $atts['title'] : $title;
				$title = '<a href="' . esc_url( $atts['href'] ) . '" rel="bookmark" target="' . $target . '">' . $title . '</a>';
				$content = str_replace( $link[0], '', $content );
			} else {
				$title = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $title . '</a>';
			}
		}
		$out['title'] = '<h2 class="entry-title">' . $title . '</h2>';
		$out['content'] = $content;

		return $out;
	}
}

if ( !function_exists('domnoo_get_page_title') ) {
	function domnoo_get_page_title() {
		$title = '';
		if ( !is_front_page() || is_paged() ) {
			global $post;
			$homeLink = esc_url( home_url() );

			if ( is_home() ) {
				$title = esc_html__( 'The Blogs', 'domnoo' );
			} elseif (is_category()) {
				global $wp_query;
				$cat_obj = $wp_query->get_queried_object();
				$thisCat = $cat_obj->term_id;
				$thisCat = get_category($thisCat);
				$parentCat = get_category($thisCat->parent);
				$title = esc_html__( 'The Blogs', 'domnoo' );
			} elseif (is_day()) {
				$title = get_the_time('d');
			} elseif (is_month()) {
				$title = get_the_time('F');
			} elseif (is_year()) {
				$title = get_the_time('Y');
			} elseif (is_single() && !is_attachment()) {
				if ( get_post_type() != 'post' ) {
					$title = get_the_title();
				} else {
					$cat = get_the_category(); $cat = $cat[0];

					$title = '';
				}
			} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() && !is_author() ) {
				$post_type = get_post_type_object(get_post_type());
				if (is_object($post_type)) {
					$title = $post_type->labels->singular_name;
				}
			} elseif (is_attachment()) {
				$parent = get_post($post->post_parent);
				$cat = get_the_category($parent->ID); $cat = $cat[0];
				$title = get_the_title();
			} elseif ( is_page() && !$post->post_parent ) {
				$title = get_the_title();
			} elseif ( is_page() && $post->post_parent ) {
				$parent_id  = $post->post_parent;
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_page($parent_id);
					$breadcrumbs[] = '<a href="' . esc_url( get_permalink($page->ID) ) . '">' . get_the_title($page->ID) . '</a></li>';
					$parent_id  = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				$title = get_the_title();
			} elseif ( is_search() ) {
				$title = esc_html__('Search results for "','domnoo')  . get_search_query();
			} elseif ( is_tag() ) {
				$title = esc_html__('Posts tagged "', 'domnoo'). single_tag_title('', false) . '"';
			} elseif ( is_author() ) {
				global $author;
				$userdata = get_userdata($author);
				$title = $userdata->display_name;
			} elseif ( is_404() ) {
				$title = esc_html__('Error 404', 'domnoo');
			}
		}
		return $title;
	}
}

if ( ! function_exists( 'domnoo_breadcrumbs' ) ) {
	function domnoo_breadcrumbs() {

		$delimiter = ' ';
		$home = esc_html__('Home', 'domnoo');
		$before = '<li><span class="active">';
		$after = '</span></li>';
		$title = domnoo_get_page_title();
		if ( !is_front_page() || is_paged()) {
			global $post;
			$homeLink = esc_url( home_url() );
			
			echo '<div class="breadscrumb-inner">';
			echo (!empty($title))?'<h2 class="bread-title">'.$title.'</h2>':'';
			echo '<ol class="breadcrumb">';


			echo '<li><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . '</li> ';

			if (is_category()) {
				global $wp_query;
				$cat_obj = $wp_query->get_queried_object();
				$thisCat = $cat_obj->term_id;
				$thisCat = get_category($thisCat);
				$parentCat = get_category($thisCat->parent);
				echo '<li>';
				if ($thisCat->parent != 0)
					echo get_category_parents($parentCat, TRUE, '</li><li>');
				echo '<span class="active">'.single_cat_title('', false) . $after;
			} elseif (is_day()) {
				echo '<li><a href="' . esc_url( get_year_link(get_the_time('Y')) ) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
				echo '<li><a href="' . esc_url( get_month_link(get_the_time('Y'),get_the_time('m')) ) . '">' . get_the_time('F') . '</a></li> ' . $delimiter . ' ';
				echo trim($before) . get_the_time('d') . $after;
			} elseif (is_month()) {
				echo '<a href="' . esc_url( get_year_link(get_the_time('Y')) ) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
				echo trim($before) . get_the_time('F') . $after;
			} elseif (is_year()) {
				echo trim($before) . get_the_time('Y') . $after;
			} elseif (is_single() && !is_attachment()) {
				if ( get_post_type() != 'post' ) {
					$post_type = get_post_type_object(get_post_type());
					$slug = $post_type->rewrite;
					
					echo '<li><a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a></li> ' . $delimiter . ' ';
					echo trim($before) . get_the_title() . $after;
				} else {
					$cat = get_the_category(); $cat = $cat[0];
					echo '<li>'.get_category_parents($cat, TRUE, '</li><li>');
					echo '<span class="active">'.get_the_title() . $after;
				}
			} elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
				$post_type = get_post_type_object(get_post_type());
				if ( get_post_type() == 'give_forms' ) {
					echo trim($before) . esc_html__( 'Our Campaigns', 'domnoo' ) . $after;
				} elseif ( get_post_type() == 'simple_event' ) {
					echo trim($before) . esc_html__( 'Our Events', 'domnoo' ) . $after;
				} elseif (is_object($post_type)) {
					echo trim($before) . $post_type->labels->singular_name . $after;
				}
			} elseif (is_attachment()) {
				$parent = get_post($post->post_parent);
				$cat = get_the_category($parent->ID);
				echo '<li>';
				if ( !empty($cat) ) {
					$cat = $cat[0];
					echo get_category_parents($cat, TRUE, '</li><li>');
				}
				if ( !empty($parent) ) {
					echo '<a href="' . esc_url( get_permalink($parent) ) . '">' . $parent->post_title . '</a></li><li>';
				}
				echo '<span class="active">'.get_the_title() . $after;
			} elseif ( is_page() && !$post->post_parent ) {
				echo trim($before) . get_the_title() . $after;
			} elseif ( is_page() && $post->post_parent ) {
				$parent_id  = $post->post_parent;
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_page($parent_id);
					$breadcrumbs[] = '<li><a href="' . esc_url( get_permalink($page->ID) ) . '">' . get_the_title($page->ID) . '</a></li>';
					$parent_id  = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				foreach ($breadcrumbs as $crumb) {
					echo trim($crumb) . ' ' . $delimiter . ' ';
				}
				echo trim($before) . get_the_title() . $after;
			} elseif ( is_search() ) {
				echo trim($before) . esc_html__('Search results for "','domnoo')  . get_search_query() . '"' . $after;
			} elseif ( is_tag() ) {
				echo trim($before) . esc_html__('Posts tagged "', 'domnoo'). single_tag_title('', false) . '"' . $after;
			} elseif ( is_author() ) {
				global $author;
				$userdata = get_userdata($author);
				echo trim($before) . esc_html__('Articles posted by ', 'domnoo') . $userdata->display_name . $after;
			} elseif ( is_404() ) {
				echo trim($before) . esc_html__('Error 404', 'domnoo') . $after;
			} elseif ( is_home() ) {
				echo trim($before) . esc_html__('The Blogs', 'domnoo') . $after;
			}

			echo '</ol>';
			echo '</div>';
			
		}
	}
}

if ( ! function_exists( 'domnoo_render_breadcrumbs' ) ) {
	function domnoo_render_breadcrumbs() {
		global $post;

		$show = true;
		$style = array();
		if ( is_page() && is_object($post) ) {
			$show = get_post_meta( $post->ID, 'apus_page_show_breadcrumb', true );
			if ( $show == 'no' ) {
				return ''; 
			}
			$bgimage = get_post_meta( $post->ID, 'apus_page_breadcrumb_image', true );
			$bgcolor = get_post_meta( $post->ID, 'apus_page_breadcrumb_color', true );
			$style = array();
			if ( $bgcolor ) {
				$style[] = 'background-color:'.$bgcolor;
			}
			if ( $bgimage ) { 
				$style[] = 'background-image:url(\''.esc_url($bgimage).'\')';
			}

		} elseif ( is_singular('post') || is_category() || is_home() ) {
			$show = domnoo_get_config('show_blog_breadcrumbs', true);
			if ( !$show  ) {
				return ''; 
			}
			$breadcrumb_img = domnoo_get_config('blog_breadcrumb_image');
	        $breadcrumb_color = domnoo_get_config('blog_breadcrumb_color');
	        $style = array();
	        if ( $breadcrumb_color ) {
	            $style[] = 'background-color:'.$breadcrumb_color;
	        }
	        if ( isset($breadcrumb_img['url']) && !empty($breadcrumb_img['url']) ) {
	            $style[] = 'background-image:url(\''.esc_url($breadcrumb_img['url']).'\')';
	        }
		}
		$estyle = !empty($style)? ' style="'.implode(";", $style).'"':"";

		echo '<section id="apus-breadscrumb" class="breadcrumb-page apus-breadscrumb"'.$estyle.'><div class="container"><div class="wrapper-breads"><div class="wrapper-breads-inner">';
			domnoo_breadcrumbs();
		echo '</div></div></div></section>';
	}
}

if ( !function_exists( 'domnoo_print_style_footer' ) ) {
	function domnoo_print_style_footer() {
    	$footer = domnoo_get_footer_layout();
    	if ( $footer ) {
    		$args = array(
				'name'        => $footer,
				'post_type'   => 'apus_footer',
				'post_status' => 'publish',
				'numberposts' => 1
			);
			$posts = get_posts($args);
			foreach ( $posts as $post ) {
	    		$shortcodes_custom_css = get_post_meta( $post->ID, '_wpb_shortcodes_custom_css', true );
		      	if ( ! empty( $shortcodes_custom_css ) ) {
		      		return $shortcodes_custom_css;
		 	 	}
	 	 	}
    	}
    	return '';
	}
}

if ( ! function_exists( 'domnoo_paging_nav' ) ) {
	function domnoo_paging_nav() {
		global $wp_query, $wp_rewrite;

		if ( $wp_query->max_num_pages < 2 ) {
			return;
		}

		$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
		$pagenum_link = html_entity_decode( get_pagenum_link() );
		$query_args   = array();
		$url_parts    = explode( '?', $pagenum_link );

		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}

		$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
		$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

		$format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
		$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

		// Set up paginated links.
		$links = paginate_links( array(
			'base'     => $pagenum_link,
			'format'   => $format,
			'total'    => $wp_query->max_num_pages,
			'current'  => $paged,
			'mid_size' => 1,
			'add_args' => array_map( 'urlencode', $query_args ),
			'prev_text' => esc_html__( '', 'domnoo' ),
			'next_text' => esc_html__( '', 'domnoo' ),
		) );

		if ( $links ) :

		?>
		<nav class="navigation paging-navigation" role="navigation">
			<h1 class="screen-reader-text hidden"><?php esc_html_e( 'Posts navigation', 'domnoo' ); ?></h1>
			<div class="apus-pagination">
				<?php echo trim($links); ?>
			</div><!-- .pagination -->
		</nav><!-- .navigation -->
		<?php
		endif;
	}
}

if ( ! function_exists( 'domnoo_post_nav' ) ) {
	function domnoo_post_nav() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}

		?>
		<nav class="navigation post-navigation" role="navigation">
			<h3 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'domnoo' ); ?></h3>
			<div class="nav-links clearfix">
				<?php
				if ( is_attachment() ) :
					previous_post_link( '%link','<div class="col-lg-6"><span class="meta-nav">'. esc_html__('Published In', 'domnoo').'</span></div>');
				else :
					previous_post_link( '%link','<div class="pull-left"><span class="meta-nav">'. esc_html__('Previous Post', 'domnoo').'</span></div>' );
					next_post_link( '%link', '<div class="pull-right"><span class="meta-nav">' . esc_html__('Next Post', 'domnoo').'</span><span></span></div>');
				endif;
				?>
			</div><!-- .nav-links -->
		</nav><!-- .navigation -->
		<?php
	}
}

if ( !function_exists('domnoo_pagination') ) {
    function domnoo_pagination($per_page, $total, $max_num_pages = '') {
    	global $wp_query, $wp_rewrite;
        ?>
        <div class="apus-pagination">
        	<?php
        	$prev = esc_html__('<','domnoo');
        	$next = esc_html__('>','domnoo');
        	$pages = $max_num_pages;
        	$args = array('class'=>'');

        	$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
	        if ( empty($pages) ) {
	            global $wp_query;
	            $pages = $wp_query->max_num_pages;
	            if ( !$pages ) {
	                $pages = 1;
	            }
	        }
	        $pagination = array(
	            'base' => @add_query_arg('paged','%#%'),
	            'format' => '',
	            'total' => $pages,
	            'current' => $current,
	            'prev_text' => $prev,
	            'next_text' => $next,
	            'type' => 'array'
	        );

	        if( $wp_rewrite->using_permalinks() ) {
	            $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
	        }
	        
	        if ( isset($_GET['s']) ) {
	            $cq = $_GET['s'];
	            $sq = str_replace(" ", "+", $cq);
	        }
	        
	        if ( !empty($wp_query->query_vars['s']) ) {
	            $pagination['add_args'] = array( 's' => $sq);
	        }
	        $paginations = paginate_links( $pagination );
	        if ( !empty($paginations) ) {
	            echo '<ul class="pagination '.esc_attr( $args["class"] ).'">';
	                foreach ($paginations as $key => $pg) {
	                    echo '<li>'. $pg .'</li>';
	                }
	            echo '</ul>';
	        }
        	?>
            
        </div>
    <?php
    }
}

if ( !function_exists('domnoo_comment_form') ) {
	function domnoo_comment_form($arg, $class = 'btn-theme ') {
		global $post;
		if ('open' == $post->comment_status) {
			ob_start();
	      	comment_form($arg);
	      	$form = ob_get_clean();
	      	?>
	      	<div class="commentform row reset-button-default">
		    	<div class="col-sm-12">
			    	<?php
			      	echo str_replace('id="submit"','id="submit" class="btn '.$class.'"', $form);
			      	?>
		      	</div>
	      	</div>
	      	<?php
	      }
	}
}

if (!function_exists('domnoo_list_comment') ) {
	function domnoo_list_comment($comment, $args, $depth) {
		if ( is_file(get_template_directory().'/list_comments.php') ) {
	        require get_template_directory().'/list_comments.php';
      	}
	}
}

function domnoo_display_footer_builder($footer) {
	global $footer_builder;
	$footer_builder = true;
	$args = array(
		'name'        => $footer,
		'post_type'   => 'apus_footer',
		'post_status' => 'publish',
		'numberposts' => 1
	);
	$posts = get_posts($args);
	foreach ( $posts as $post ) {
		$class = get_post_meta( $post->ID, 'apus_footer_style_class', true );
		echo '<div class="footer-builder-wrapper '. esc_attr($class) .'">';
		echo do_shortcode( $post->post_content );
		echo '</div>';
	}
	$footer_builder = false;
}

function domnoo_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	return $fields;
}
add_filter( 'comment_form_fields', 'domnoo_comment_field_to_bottom' );

function domnoo_get_blogs_layout_type() {
	$layout = domnoo_get_config( 'blog_display_mode', 'grid' );
	$layout = !empty($layout) ? $layout : 'grid';
	return $layout;
}

function domnoo_get_blog_thumbsize() {
	$thumbsize = domnoo_get_config( 'blog_item_thumbsize', 'full' );
	return $thumbsize;
}

/*
 * create placeholder
 * var size: array( width, height )
 */
function domnoo_create_placeholder($size) {
	if ( class_exists('Apus_Create_Placeholder') ) {
		return Apus_Create_Placeholder::create($size);
	} else {
		return "data:image/svg+xml;charset=utf-8,%3Csvg xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg' viewBox%3D'0 0 ".$size[0]." ".$size[1]."'%2F%3E";
	}
}

function domnoo_display_image($img) {
	if ( !empty($img) && isset($img[0]) ) {
		if (domnoo_get_config('image_lazy_loading')) {
			$placeholder_image = domnoo_create_placeholder(array($img[1], $img[2]));
			?>
			<div class="image-wrapper">
				<img src="<?php echo trim($placeholder_image); ?>" data-src="<?php echo esc_url_raw($img[0]); ?>" alt="" class="unveil-image">
			</div>
			<?php
		} else {
			?>
			<div class="image-wrapper">
				<img src="<?php echo esc_url_raw($img[0]); ?>" alt="">
			</div>
			<?php
		}
	}
}