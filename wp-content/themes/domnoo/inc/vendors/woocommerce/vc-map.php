<?php
if ( function_exists('vc_map') && class_exists('WPBakeryShortCode') ) {

	if ( !function_exists('domnoo_woocommerce_get_categories') ) {
	    function domnoo_woocommerce_get_categories() {
	        $return = array( esc_html__(' --- Choose a Category --- ', 'domnoo') );

	        $args = array(
	            'type' => 'post',
	            'child_of' => 0,
	            'orderby' => 'name',
	            'order' => 'ASC',
	            'hide_empty' => false,
	            'hierarchical' => 1,
	            'taxonomy' => 'product_cat'
	        );

	        $categories = get_categories( $args );
	        domnoo_get_category_childs( $categories, 0, 0, $return );

	        return $return;
	    }
	}

	if ( !function_exists('domnoo_get_category_childs') ) {
	    function domnoo_get_category_childs( $categories, $id_parent, $level, &$dropdown ) {
	        foreach ( $categories as $key => $category ) {
	            if ( $category->category_parent == $id_parent ) {
	                $dropdown = array_merge( $dropdown, array( str_repeat( "- ", $level ) . $category->name => $category->slug ) );
	                unset($categories[$key]);
	                domnoo_get_category_childs( $categories, $category->term_id, $level + 1, $dropdown );
	            }
	        }
	    }
	}

	if ( !function_exists('domnoo_vc_get_product_object')) {
		function domnoo_vc_get_product_object($term) {
			$vc_taxonomies_types = vc_taxonomies_types();

			return array(
				'label' => $term->post_title,
				'value' => $term->post_name,
				'group_id' => $term->post_type,
				'group' => isset( $vc_taxonomies_types[ $term->post_type ], $vc_taxonomies_types[ $term->post_type ]->labels, $vc_taxonomies_types[ $term->post_type ]->labels->name ) ? $vc_taxonomies_types[ $term->post_type ]->labels->name : esc_html__( 'Products', 'domnoo' ),
			);
		}
	}

	if ( !function_exists('domnoo_vc_product_field_search')) {
		function domnoo_vc_product_field_search( $search_string ) {
			$data = array();
			
			$args = array('s' => $search_string, 'post_type' => 'product', 'post_status' => 'publish');
			$vc_taxonomies = get_posts( $args );

			if ( is_array( $vc_taxonomies ) && ! empty( $vc_taxonomies ) ) {
				foreach ( $vc_taxonomies as $t ) {
					if ( is_object( $t ) ) {
						$data[] = domnoo_vc_get_product_object( $t );
					}
				}
			}
			return $data;
		}
	}

	if ( !function_exists('domnoo_vc_product_render')) {
		function domnoo_vc_product_render($query) {
			$args = array(
			  'name'        => $query['value'],
			  'post_type'   => 'product',
			  'numberposts' => 1
			);
			$posts = get_posts($args);
			if ( !empty($posts) ) {
				foreach ($posts as $post) {
					$data = array();
					$data['value'] = $post->post_name;
					$data['label'] = $post->post_title;
					return ! empty( $data ) ? $data : false;
				}
			}
			return false;
		}
	}

	$bases = array( 'apus_products_special' );
	foreach( $bases as $base ){   
		add_filter( 'vc_autocomplete_'.$base .'_products_callback', 'domnoo_vc_product_field_search', 10, 1 );
	 	add_filter( 'vc_autocomplete_'.$base .'_products_render', 'domnoo_vc_product_render', 10, 1 );
	}


	if ( !function_exists('domnoo_vc_get_term_object')) {
		function domnoo_vc_get_term_object($term) {
			$vc_taxonomies_types = vc_taxonomies_types();

			return array(
				'label' => $term->name,
				'value' => $term->slug,
				'group_id' => $term->taxonomy,
				'group' => isset( $vc_taxonomies_types[ $term->taxonomy ], $vc_taxonomies_types[ $term->taxonomy ]->labels, $vc_taxonomies_types[ $term->taxonomy ]->labels->name ) ? $vc_taxonomies_types[ $term->taxonomy ]->labels->name : esc_html__( 'Taxonomies', 'domnoo' ),
			);
		}
	}

	if ( !function_exists('domnoo_vc_category_field_search')) {
		function domnoo_vc_category_field_search( $search_string ) {
			$data = array();
			$vc_taxonomies_types = array('product_cat');
			$vc_taxonomies = get_terms( $vc_taxonomies_types, array(
				'hide_empty' => false,
				'search' => $search_string
			) );
			if ( is_array( $vc_taxonomies ) && ! empty( $vc_taxonomies ) ) {
				foreach ( $vc_taxonomies as $t ) {
					if ( is_object( $t ) ) {
						$data[] = domnoo_vc_get_term_object( $t );
					}
				}
			}
			return $data;
		}
	}

	if ( !function_exists('domnoo_vc_category_render')) {
		function domnoo_vc_category_render($query) {  
			$category = get_term_by('slug', $query['value'], 'product_cat');
			if ( ! empty( $query ) && !empty($category)) {
				$data = array();
				$data['value'] = $category->slug;
				$data['label'] = $category->name;
				return ! empty( $data ) ? $data : false;
			}
			return false;
		}
	}

	$bases = array( 'apus_products' );
	foreach( $bases as $base ){   
		add_filter( 'vc_autocomplete_'.$base .'_categories_callback', 'domnoo_vc_category_field_search', 10, 1 );
	 	add_filter( 'vc_autocomplete_'.$base .'_categories_render', 'domnoo_vc_category_render', 10, 1 );
	}

	function domnoo_load_woocommerce_element() {
		$categories = domnoo_woocommerce_get_categories();
		$types = array(
			esc_html__('Recent Products', 'domnoo' ) => 'recent_product',
			esc_html__('Best Selling', 'domnoo' ) => 'best_selling',
			esc_html__('Featured Products', 'domnoo' ) => 'featured_product',
			esc_html__('Top Rate', 'domnoo' ) => 'top_rate',
			esc_html__('On Sale', 'domnoo' ) => 'on_sale',
			esc_html__('Recent Review', 'domnoo' ) => 'recent_review'
		);

		vc_map( array(
		    "name" => esc_html__("Apus Products",'domnoo'),
		    "base" => "apus_products",
		    'description'=> esc_html__( 'Show products as bestseller, featured in block', 'domnoo' ),
		    'icon' => 'icon-wpb-woocommerce',
		   	"category" => esc_html__('Apus Woocommerce','domnoo'),
		    "params" => array(
		    	array(
				    'type' => 'autocomplete',
				    'heading' => esc_html__( 'Choose categories', 'domnoo' ),
				    'value' => '',
				    'param_name' => 'categories',
				    "admin_label" => true,
				    'description' => esc_html__( 'Choose categories to display', 'domnoo' ),
				    'settings' => array(
				     	'multiple' => true,
				     	'unique_values' => true
				    ),
			   	),
		    	array(
					"type" => "dropdown",
					"heading" => esc_html__("Type",'domnoo'),
					"param_name" => "type",
					"value" => $types,
					"admin_label" => true,
					"description" => esc_html__("Select Columns.",'domnoo')
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Products Layout Type",'domnoo'),
					"param_name" => "layout_type",
					"value" => array(
						esc_html__('Grid', 'domnoo' ) => 'grid',
						esc_html__('Carousel', 'domnoo' ) => 'carousel',
					)
				),
				array(
	                "type" => "dropdown",
	                "heading" => esc_html__('Columns','domnoo'),
	                "param_name" => 'columns',
	                "value" => array(2,3,4,5,6)
	            ),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Number of products to show",'domnoo'),
					"param_name" => "number",
					"value" => '4'
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra class name",'domnoo'),
					"param_name" => "el_class",
					"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.",'domnoo')
				)
		   	)
		));

		vc_map( array(
			'name' => esc_html__( 'Apus Products Categories Tabs ', 'domnoo' ),
			'base' => 'apus_categoriestabs',
			'icon' => 'icon-wpb-woocommerce',
			'category' => esc_html__( 'Apus Woocommerce', 'domnoo' ),
			'description' => esc_html__( 'Display products categories in Tabs', 'domnoo' ),
			'params' => array(
				array(
					'type' => 'param_group',
					'heading' => esc_html__( 'Categories Tabs', 'domnoo' ),
					'param_name' => 'categoriestabs',
					'params' => array(
						array(
							"type" => "dropdown",
							"heading" => esc_html__( 'Category', 'domnoo' ),
							"param_name" => "category",
							"value" => $categories
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Title', 'domnoo' ),
							'param_name' => 'title',
						),
						array(
							"type" => "attach_image",
							"param_name" => "icon_image",
							'heading'	=> esc_html__('Icon Image', 'domnoo' )
						),
					)
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Get Products By",'domnoo'),
					"param_name" => "type",
					"value" => $types,
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Number Products', 'domnoo' ),
					'value' => 10,
					'param_name' => 'number',
					'description' => esc_html__( 'Number products per page to show', 'domnoo' ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Products Layout Type",'domnoo'),
					"param_name" => "layout_type",
					"value" => array(
						esc_html__('Grid', 'domnoo' ) => 'grid',
						esc_html__('Carousel', 'domnoo' ) => 'carousel',
					)
				),
				array(
	                "type" => "dropdown",
	                "heading" => esc_html__('Columns','domnoo'),
	                "param_name" => 'columns',
	                "value" => array(2,3,4,5,6),
	            ),
	            array(
					"type" => "dropdown",
					"heading" => esc_html__("Tabs style",'domnoo'),
					"param_name" => "tabs_style",
					"value" => array(
						esc_html__('Horizontal', 'domnoo' ) => 'horizontal',
						esc_html__('Vertical', 'domnoo' ) => 'vertical',
					)
				),
	            array(
					"type" => "textfield",
					"heading" => esc_html__("Extra class name",'domnoo'),
					"param_name" => "el_class",
					"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.",'domnoo')
				)
			)
		) );

		vc_map( array(
			'name' => esc_html__( 'Apus Products Special', 'domnoo' ),
			'base' => 'apus_products_special',
			'icon' => 'icon-wpb-woocommerce',
			'category' => esc_html__( 'Apus Woocommerce', 'domnoo' ),
			'description' => esc_html__( 'Display products special', 'domnoo' ),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Sub Title', 'domnoo' ),
					'param_name' => 'sub_title',
					'description' => esc_html__( 'Enter Sub heading title.', 'domnoo' ),
					"admin_label" => true,
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Title', 'domnoo' ),
					'param_name' => 'title',
					'description' => esc_html__( 'Enter heading title.', 'domnoo' ),
					"admin_label" => true,
				),
				array(
					"type" => "textarea_html",
					'heading' => esc_html__( 'Description', 'domnoo' ),
					"param_name" => "content",
					"value" => '',
					'description' => esc_html__( 'Enter description for title.', 'domnoo' )
			    ),
				array(
				    'type' => 'autocomplete',
				    'heading' => esc_html__( 'Products', 'domnoo' ),
				    'value' => '',
				    'param_name' => 'products',
				    "admin_label" => true,
				    'description' => esc_html__( 'Choose products to display', 'domnoo' ),
				    'settings' => array(
				     	'multiple' => true,
				     	'unique_values' => true
				    ),
			   	),
			   	array(
					"type" => "attach_image",
					"description" => esc_html__("Label Image", 'domnoo'),
					"param_name" => "image",
					"value" => '',
					'heading'	=> esc_html__('Label Image', 'domnoo' )
				),
	            array(
					"type" => "textfield",
					"heading" => esc_html__("Extra class name", 'domnoo'),
					"param_name" => "el_class",
					"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'domnoo')
				)
			)
		) );
	}
	add_action( 'vc_after_set_mode', 'domnoo_load_woocommerce_element', 99 );

	class WPBakeryShortCode_apus_products extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_categoriestabs extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_products_special extends WPBakeryShortCode {}
}