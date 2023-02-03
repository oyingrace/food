<?php

if ( function_exists('vc_map') && class_exists('WPBakeryShortCode') ) {

    function domnoo_get_post_categories() {
        $return = array( esc_html__(' --- Choose a Category --- ', 'domnoo') => '' );

        $args = array(
            'type' => 'post',
            'child_of' => 0,
            'orderby' => 'name',
            'order' => 'ASC',
            'hide_empty' => false,
            'hierarchical' => 1,
            'taxonomy' => 'category'
        );

        $categories = get_categories( $args );
        domnoo_get_post_category_childs( $categories, 0, 0, $return );

        return $return;
    }

    function domnoo_get_post_category_childs( $categories, $id_parent, $level, &$dropdown ) {
        foreach ( $categories as $key => $category ) {
            if ( $category->category_parent == $id_parent ) {
                $dropdown = array_merge( $dropdown, array( str_repeat( "- ", $level ) . $category->name => $category->slug ) );
                unset($categories[$key]);
                domnoo_get_post_category_childs( $categories, $category->term_id, $level + 1, $dropdown );
            }
        }
	}

	function domnoo_load_post2_element() {
		$layouts = array(
			esc_html__('Grid', 'domnoo') => 'grid',
			esc_html__('List', 'domnoo') => 'list',
			esc_html__('Carousel', 'domnoo') => 'carousel',
		);
		$columns = array(1,2,3,4,6);
		$categories = array();
		if ( is_admin() ) {
			$categories = domnoo_get_post_categories();
		}
		vc_map( array(
			'name' => esc_html__( 'Apus Grid Posts', 'domnoo' ),
			'base' => 'apus_gridposts',
			'icon' => 'icon-wpb-news-12',
			"category" => esc_html__('Apus Post', 'domnoo'),
			'description' => esc_html__( 'Create Post having blog styles', 'domnoo' ),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Title', 'domnoo' ),
					'param_name' => 'title',
					'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'domnoo' ),
					"admin_label" => true
				),
				array(
	                "type" => "dropdown",
	                "heading" => esc_html__('Category','domnoo'),
	                "param_name" => 'category',
	                "value" => $categories
	            ),
	            array(
	                "type" => "dropdown",
	                "heading" => esc_html__('Order By','domnoo'),
	                "param_name" => 'orderby',
	                "value" => array(
	                	esc_html__('Date', 'domnoo') => 'date',
	                	esc_html__('ID', 'domnoo') => 'ID',
	                	esc_html__('Author', 'domnoo') => 'author',
	                	esc_html__('Title', 'domnoo') => 'title',
	                	esc_html__('Modified', 'domnoo') => 'modified',
	                	esc_html__('Parent', 'domnoo') => 'parent',
	                	esc_html__('Comment count', 'domnoo') => 'comment_count',
	                	esc_html__('Menu order', 'domnoo') => 'menu_order',
	                	esc_html__('Random', 'domnoo') => 'rand',
	                )
	            ),
	            array(
	                "type" => "dropdown",
	                "heading" => esc_html__('Sort order','domnoo'),
	                "param_name" => 'order',
	                "value" => array(
	                	esc_html__('Descending', 'domnoo') => 'DESC',
	                	esc_html__('Ascending', 'domnoo') => 'ASC',
	                )
	            ),
	            array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Limit', 'domnoo' ),
					'param_name' => 'posts_per_page',
					'description' => esc_html__( 'Enter limit posts.', 'domnoo' ),
					'std' => 4,
					"admin_label" => true
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show Pagination?', 'domnoo' ),
					'param_name' => 'show_pagination',
					'description' => esc_html__( 'Enables to show paginations to next new page.', 'domnoo' ),
					'value' => array( esc_html__( 'Yes, to show pagination', 'domnoo' ) => 'yes' )
				),
				array(
	                "type" => "dropdown",
	                "heading" => esc_html__('Grid Columns','domnoo'),
	                "param_name" => 'grid_columns',
	                "value" => $columns
	            ),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Layout Type", 'domnoo'),
					"param_name" => "layout_type",
					"value" => $layouts
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Thumbnail size', 'domnoo' ),
					'param_name' => 'thumbsize',
					'description' => esc_html__( 'Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height) . ', 'domnoo' )
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'domnoo' ),
					'param_name' => 'el_class',
					'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'domnoo' )
				)
			)
		) );
	}

	add_action( 'vc_after_set_mode', 'domnoo_load_post2_element', 99 );

	class WPBakeryShortCode_apus_gridposts extends WPBakeryShortCode {}
}