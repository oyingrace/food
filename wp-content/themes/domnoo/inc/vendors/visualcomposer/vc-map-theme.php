<?php
if ( function_exists('vc_map') && class_exists('WPBakeryShortCode') ) {
	// custom wp
	$attributes = array(
	    'type' => 'dropdown',
	    'heading' => "Style Element",
	    'param_name' => 'style',
	    'value' => array( "one", "two", "three" ),
	    'description' => esc_html__( "New style attribute", "domnoo" )
	);
	vc_add_param( 'vc_facebook', $attributes ); // Note: 'vc_message' was used as a base for "Message box" element

	if ( !function_exists('domnoo_load_load_theme_element')) {
		function domnoo_load_load_theme_element() {
			$columns = array(1,2,3,4,6);
			// Heading Text Block
			vc_map( array(
				'name'        => esc_html__( 'Apus Widget Heading','domnoo'),
				'base'        => 'apus_title_heading',
				"class"       => "",
				"category" => esc_html__('Apus Elements', 'domnoo'),
				'description' => esc_html__( 'Create title for one Widget', 'domnoo' ),
				"params"      => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Sub Title', 'domnoo' ),
						'param_name' => 'sub_title',
						'description' => esc_html__( 'Enter Sub heading title.', 'domnoo' ),
						"admin_label" => true,
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Widget title', 'domnoo' ),
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
						"type" => "attach_image",
						"description" => esc_html__("Underline Title.", 'domnoo'),
						"param_name" => "image",
						"value" => '',
						'heading'	=> esc_html__('Image Underline', 'domnoo' )
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Style", 'domnoo'),
						"param_name" => "style",
						'value' 	=> array(
							esc_html__('Default White Center', 'domnoo') => 'default_center', 
							esc_html__('Default Dark', 'domnoo') => 'default_center_dark', 
							esc_html__('Default', 'domnoo') => 'default', 
							esc_html__('Small Center', 'domnoo') => 'small_center', 
						),
						'std' => ''
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'domnoo' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'domnoo' )
					)
				),
			));

			// calltoaction
			vc_map( array(
				'name'        => esc_html__( 'Apus Widget Call To Action','domnoo'),
				'base'        => 'apus_call_action',
				"class"       => "",
				"category" => esc_html__('Apus Elements', 'domnoo'),
				'description' => esc_html__( 'Create title for one Widget', 'domnoo' ),
				"params"      => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Sub title', 'domnoo' ),
						'param_name' => 'subtitle',
						'description' => esc_html__( 'Enter Sub title.', 'domnoo' ),
						"admin_label" => true
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Widget title', 'domnoo' ),
						'param_name' => 'title',
						'value'       => esc_html__( 'Title', 'domnoo' ),
						'description' => esc_html__( 'Enter heading title.', 'domnoo' ),
						"admin_label" => true
					),
					array(
						"type" => "textarea_html",
						'heading' => esc_html__( 'Description', 'domnoo' ),
						"param_name" => "content",
						"value" => '',
						'description' => esc_html__( 'Enter description for title.', 'domnoo' )
				    ),

				    array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Text Button 1', 'domnoo' ),
						'param_name' => 'textbutton1',
						'description' => esc_html__( 'Text Button', 'domnoo' ),
						"admin_label" => true
					),

					array(
						'type' => 'textfield',
						'heading' => esc_html__( ' Link Button 1', 'domnoo' ),
						'param_name' => 'linkbutton1',
						'description' => esc_html__( 'Link Button 1', 'domnoo' ),
						"admin_label" => true
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Button Style", 'domnoo'),
						"param_name" => "buttons1",
						'value' 	=> array(
							esc_html__('Default ', 'domnoo') => 'btn-default ', 
							esc_html__('Primary ', 'domnoo') => 'btn-primary ', 
							esc_html__('Success ', 'domnoo') => 'btn-success radius-0 ', 
							esc_html__('Info ', 'domnoo') => 'btn-info ', 
							esc_html__('Warning ', 'domnoo') => 'btn-warning ', 
							esc_html__('Theme Color ', 'domnoo') => 'btn-theme',
							esc_html__('Theme Gradient Color ', 'domnoo') => 'btn-theme btn-gradient',
							esc_html__('Second Color ', 'domnoo') => 'btn-theme-second',
							esc_html__('Danger ', 'domnoo') => 'btn-danger ', 
							esc_html__('Pink ', 'domnoo') => 'btn-pink ', 
							esc_html__('White Gradient ', 'domnoo') => 'btn-white btn-gradient', 
							esc_html__('Primary Outline', 'domnoo') => 'btn-primary btn-outline', 
							esc_html__('White Outline ', 'domnoo') => 'btn-white btn-outline ',
							esc_html__('Theme Outline ', 'domnoo') => 'btn-theme btn-outline ',
						),
						'std' => ''
					),

					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Text Button 2', 'domnoo' ),
						'param_name' => 'textbutton2',
						'description' => esc_html__( 'Text Button', 'domnoo' ),
						"admin_label" => true
					),

					array(
						'type' => 'textfield',
						'heading' => esc_html__( ' Link Button 2', 'domnoo' ),
						'param_name' => 'linkbutton2',
						'description' => esc_html__( 'Link Button 2', 'domnoo' ),
						"admin_label" => true
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Button Style", 'domnoo'),
						"param_name" => "buttons2",
						'value' 	=> array(
							esc_html__('Default ', 'domnoo') => 'btn-default ', 
							esc_html__('Primary ', 'domnoo') => 'btn-primary ', 
							esc_html__('Success ', 'domnoo') => 'btn-success radius-0 ', 
							esc_html__('Info ', 'domnoo') => 'btn-info ', 
							esc_html__('Warning ', 'domnoo') => 'btn-warning ', 
							esc_html__('Theme Color ', 'domnoo') => 'btn-theme',
							esc_html__('Second Color ', 'domnoo') => 'btn-theme-second',
							esc_html__('Danger ', 'domnoo') => 'btn-danger ', 
							esc_html__('Pink ', 'domnoo') => 'btn-pink ', 
							esc_html__('White Gradient ', 'domnoo') => 'btn-white btn-gradient',
							esc_html__('Primary Outline', 'domnoo') => 'btn-primary btn-outline', 
							esc_html__('White Outline ', 'domnoo') => 'btn-white btn-outline ',
							esc_html__('Theme Outline ', 'domnoo') => 'btn-theme btn-outline ',
						),
						'std' => ''
					),
					
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Style", 'domnoo'),
						"param_name" => "style",
						'value' 	=> array(
							esc_html__('Default', 'domnoo') => 'default',
							esc_html__('Style 2', 'domnoo') => 'style2',
						),
						'std' => ''
					),

					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'domnoo' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'domnoo' )
					)
				),
			));
			
			// Apus Counter
			vc_map( array(
			    "name" => esc_html__("Apus Counter",'domnoo'),
			    "base" => "apus_counter",
			    "class" => "",
			    "description"=> esc_html__('Counting number with your term', 'domnoo'),
			    "category" => esc_html__('Apus Elements', 'domnoo'),
			    "params" => array(
			    	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'domnoo'),
						"param_name" => "title",
						"value" => '',
						"admin_label"	=> true
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Number", 'domnoo'),
						"param_name" => "number",
						"value" => ''
					),
					array(
						"type" => "colorpicker",
						"heading" => esc_html__("Color Number", 'domnoo'),
						"param_name" => "text_color",
						'value' 	=> '',
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'domnoo'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'domnoo')
					)
			   	)
			));

			// Apus Banner
			vc_map( array(
			    "name" => esc_html__("Apus Banner",'domnoo'),
			    "base" => "apus_banner",
			    "class" => "",
			    "description"=> esc_html__('Counting number with your term', 'domnoo'),
			    "category" => esc_html__('Apus Elements', 'domnoo'),
			    "params" => array(
			    	array(
						"type" => "textfield",
						"heading" => esc_html__("Sub Title", 'domnoo'),
						"param_name" => "sub_title",
						"value" => '',
						"admin_label"	=> true
					),
			    	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'domnoo'),
						"param_name" => "title",
						"value" => '',
						"admin_label"	=> true
					),				
					array(
						"type" => "textarea",
						'heading' => esc_html__( 'Description', 'domnoo' ),
						"param_name" => "content",
						"value" => '',
						'description' => esc_html__( 'Enter description for title.', 'domnoo' )
				    ),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Read More", 'domnoo'),
						"param_name" => "readmore",
						"value" => '',
						"admin_label"	=> true
					),
					array(
						"type" => "attach_image",
						"description" => esc_html__("Background Image", 'domnoo'),
						"param_name" => "image",
						"value" => '',
						'heading'	=> esc_html__('Background Image', 'domnoo' )
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Style", 'domnoo'),
						"param_name" => "style",
						'value' 	=> array(
							esc_html__('Left Top', 'domnoo') => 'lefttop',
							esc_html__('Left Middle', 'domnoo') => 'leftmiddle',
							esc_html__('Left Small Middle', 'domnoo') => 'leftmiddle small',
							esc_html__('Center Top', 'domnoo') => 'centertop',
							esc_html__('Center Middle', 'domnoo') => 'centermiddle',
						),
						'std' => ''
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'domnoo'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'domnoo')
					)
			   	)
			));

			// Banner CountDown
			vc_map( array(
				'name'        => esc_html__( 'Apus Banner CountDown','domnoo'),
				'base'        => 'apus_banner_countdown',
				"class"       => "",
				"category" => esc_html__('Apus Elements', 'domnoo'),
				'description' => esc_html__( 'Show CountDown with banner', 'domnoo' ),
				"params"      => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Widget title', 'domnoo' ),
						'param_name' => 'title',
						'value'       => esc_html__( 'Title', 'domnoo' ),
						'description' => esc_html__( 'Enter heading title.', 'domnoo' ),
						"admin_label" => true
					),

					array(
						"type" => "textarea",
						'heading' => esc_html__( 'Description', 'domnoo' ),
						"param_name" => "descript",
						"value" => '',
						'description' => esc_html__( 'Enter description for title.', 'domnoo' )
				    ),
					array(
					    'type' => 'textfield',
					    'heading' => esc_html__( 'Date Expired', 'domnoo' ),
					    'param_name' => 'input_datetime'
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'domnoo' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'domnoo' )
					),
				),
			));
			// Apus Brands
			vc_map( array(
			    "name" => esc_html__("Apus Brands",'domnoo'),
			    "base" => "apus_brands",
			    "class" => "",
			    "description"=> esc_html__('Display brands on front end', 'domnoo'),
			    "category" => esc_html__('Apus Elements', 'domnoo'),
			    "params" => array(
			    	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'domnoo'),
						"param_name" => "title",
						"value" => '',
						"admin_label"	=> true
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Number", 'domnoo'),
						"param_name" => "number",
						"value" => ''
					),
				 	array(
						"type" => "dropdown",
						"heading" => esc_html__("Layout Type", 'domnoo'),
						"param_name" => "layout_type",
						'value' 	=> array(
							esc_html__('Carousel', 'domnoo') => 'carousel', 
							esc_html__('Grid', 'domnoo') => 'grid'
						),
						'std' => ''
					),
					array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Columns','domnoo'),
		                "param_name" => 'columns',
		                "value" => array(1,2,3,4,5,6),
		            ),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'domnoo'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'domnoo')
					)
			   	)
			));
			
			vc_map( array(
			    "name" => esc_html__("Apus Socials link",'domnoo'),
			    "base" => "apus_socials_link",
			    "description"=> esc_html__('Show socials link', 'domnoo'),
			    "category" => esc_html__('Apus Elements', 'domnoo'),
			    "params" => array(
			    	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'domnoo'),
						"param_name" => "title",
						"value" => '',
						"admin_label"	=> true
					),
					array(
						"type" => "textarea",
						"heading" => esc_html__("Description", 'domnoo'),
						"param_name" => "description",
						"value" => '',
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Facebook Page URL", 'domnoo'),
						"param_name" => "facebook_url",
						"value" => '',
						"admin_label"	=> true
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Twitter Page URL", 'domnoo'),
						"param_name" => "twitter_url",
						"value" => '',
						"admin_label"	=> true
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Youtube Page URL", 'domnoo'),
						"param_name" => "youtube_url",
						"value" => '',
						"admin_label"	=> true
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Pinterest Page URL", 'domnoo'),
						"param_name" => "pinterest_url",
						"value" => '',
						"admin_label"	=> true
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Google Plus Page URL", 'domnoo'),
						"param_name" => "google-plus_url",
						"value" => '',
						"admin_label"	=> true
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Instagram Page URL", 'domnoo'),
						"param_name" => "instagram_url",
						"value" => '',
						"admin_label"	=> true
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Align", 'domnoo'),
						"param_name" => "align",
						'value' 	=> array(
							esc_html__('Left', 'domnoo') => '', 
							esc_html__('Right', 'domnoo') => 'right'
						),
						'std' => ''
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'domnoo'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'domnoo')
					)
			   	)
			));
			// newsletter
			vc_map( array(
			    "name" => esc_html__("Apus Newsletter",'domnoo'),
			    "base" => "apus_newsletter",
			    "class" => "",
			    "description"=> esc_html__('Show newsletter form', 'domnoo'),
			    "category" => esc_html__('Apus Elements', 'domnoo'),
			    "params" => array(
			    	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'domnoo'),
						"param_name" => "title",
						"value" => '',
						"admin_label"	=> true
					),
					array(
						"type" => "textarea",
						"heading" => esc_html__("Description", 'domnoo'),
						"param_name" => "description",
						"value" => '',
					),
					array(
		                'type' => 'dropdown',
		                'heading' => esc_html__( 'Style', 'domnoo' ),
		                'param_name' => 'style',
		                'value' => array(
		                    esc_html__( 'Style 1', 'domnoo' ) 	=> 'style1',
		                    esc_html__( 'Style 2', 'domnoo' ) 	=> 'style2',
		                    esc_html__( 'Style 3', 'domnoo' ) 	=> 'style3',
		                )
		            ),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'domnoo'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'domnoo')
					)
			   	)
			));
			// google map
			$map_styles = array( esc_html__('Choose a map style', 'domnoo') => '' );
			if ( is_admin() && class_exists('Domnoo_Google_Maps_Styles') ) {
				$styles = Domnoo_Google_Maps_Styles::styles();
				foreach ($styles as $style) {
					$map_styles[$style['title']] = $style['slug'];
				}
			}
			vc_map( array(
			    "name" => esc_html__("Apus Google Map",'domnoo'),
			    "base" => "apus_googlemap",
			    "description" => esc_html__('Diplay Google Map', 'domnoo'),
			    "category" => esc_html__('Apus Elements', 'domnoo'),
			    "params" => array(
			    	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'domnoo'),
						"param_name" => "title",
						"admin_label" => true,
						"value" => '',
					),
					array(
		                "type" => "textarea",
		                "class" => "",
		                "heading" => esc_html__('Description','domnoo'),
		                "param_name" => "des",
		            ),
		            array(
		                'type' => 'googlemap',
		                'heading' => esc_html__( 'Location', 'domnoo' ),
		                'param_name' => 'location',
		                'value' => ''
		            ),
		            array(
		                'type' => 'hidden',
		                'heading' => esc_html__( 'Latitude Longitude', 'domnoo' ),
		                'param_name' => 'lat_lng',
		                'value' => '21.0173222,105.78405279999993'
		            ),
		            array(
						"type" => "textfield",
						"heading" => esc_html__("Map height", 'domnoo'),
						"param_name" => "height",
						"value" => '',
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Map Zoom", 'domnoo'),
						"param_name" => "zoom",
						"value" => '13',
					),
		            array(
		                'type' => 'dropdown',
		                'heading' => esc_html__( 'Map Type', 'domnoo' ),
		                'param_name' => 'type',
		                'value' => array(
		                    esc_html__( 'roadmap', 'domnoo' ) 		=> 'ROADMAP',
		                    esc_html__( 'hybrid', 'domnoo' ) 	=> 'HYBRID',
		                    esc_html__( 'satellite', 'domnoo' ) 	=> 'SATELLITE',
		                    esc_html__( 'terrain', 'domnoo' ) 	=> 'TERRAIN',
		                )
		            ),
		            array(
						"type" => "attach_image",
						"heading" => esc_html__("Custom Marker Icon", 'domnoo'),
						"param_name" => "marker_icon"
					),
					array(
		                'type' => 'dropdown',
		                'heading' => esc_html__( 'Custom Map Style', 'domnoo' ),
		                'param_name' => 'map_style',
		                'value' => $map_styles
		            ),
		            array(
						'type' => 'param_group',
						'heading' => esc_html__('Contact Infomations', 'domnoo' ),
						'param_name' => 'info',
						'description' => '',
						'value' => '',
						'params' => array(
							array(
								"type" => "textfield",
								"heading" => esc_html__("Material Design Icon and Awesome Icon", 'domnoo'),
								"param_name" => "icon",
								"value" => '',
								'description' => esc_html__( 'This support display icon from Material Design and Awesome Icon, Please click', 'domnoo' )
												. '<a href="' . ( is_ssl()  ? 'https' : 'http') . '://zavoloklom.github.io/material-design-iconic-font/icons.html" target="_blank">'
												. esc_html__( 'here to see the list', 'domnoo' ) . '</a>'
							),
				            array(
				                "type" => "textarea",
				                "class" => "",
				                "heading" => esc_html__('Short Description','domnoo'),
				                "param_name" => "des",
				            ),
						),
					),
					array(
						'type' => 'param_group',
						'heading' => esc_html__('Socials Settings', 'domnoo' ),
						'param_name' => 'socials',
						'description' => '',
						'value' => '',
						'params' => array(
							array(
								"type" => "textfield",
								"heading" => esc_html__("Material Design Icon and Awesome Icon", 'domnoo'),
								"param_name" => "icon",
								"value" => '',
								'description' => esc_html__( 'This support display icon from Material Design and Awesome Icon, Please click', 'domnoo' )
												. '<a href="' . ( is_ssl()  ? 'https' : 'http') . '://zavoloklom.github.io/material-design-iconic-font/icons.html" target="_blank">'
												. esc_html__( 'here to see the list', 'domnoo' ) . '</a>'
							),
				            array(
				                "type" => "textfield",
				                "class" => "",
				                "heading" => esc_html__('Url','domnoo'),
				                "param_name" => "url",
				            ),
						),
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'domnoo'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'domnoo')
					)
			   	)
			));
			// Testimonial
			vc_map( array(
	            "name" => esc_html__("Apus Testimonials",'domnoo'),
	            "base" => "apus_testimonials",
	            'description'=> esc_html__('Display Testimonials In FrontEnd', 'domnoo'),
	            "class" => "",
	            "category" => esc_html__('Apus Elements', 'domnoo'),
	            "params" => array(
	              	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'domnoo'),
						"param_name" => "title",
						"admin_label" => true,
						"value" => '',
					),
	              	array(
		              	"type" => "textfield",
		              	"heading" => esc_html__("Number", 'domnoo'),
		              	"param_name" => "number",
		              	"value" => '4',
		            ),
		            array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Layout Type','domnoo'),
		                "param_name" => 'layout_type',
		                'value' 	=> array(
		                	esc_html__('Layout 1 ', 'domnoo') => 'layout1', 
		                	esc_html__('Layout 2', 'domnoo') => 'layout2',
						),
						'std' => ''
		            ),
		            array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'domnoo'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'domnoo')
					)
	            )
	        ));
	        // Our Team
			vc_map( array(
	            "name" => esc_html__("Apus Our Team",'domnoo'),
	            "base" => "apus_ourteam",
	            'description'=> esc_html__('Display Our Team In FrontEnd', 'domnoo'),
	            "class" => "",
	            "category" => esc_html__('Apus Elements', 'domnoo'),
	            "params" => array(
	              	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'domnoo'),
						"param_name" => "title",
						"admin_label" => true,
						"value" => '',
					),
	              	array(
						'type' => 'param_group',
						'heading' => esc_html__('Members Settings', 'domnoo' ),
						'param_name' => 'members',
						'description' => '',
						'value' => '',
						'params' => array(
							array(
				                "type" => "textfield",
				                "class" => "",
				                "heading" => esc_html__('Name','domnoo'),
				                "param_name" => "name",
				            ),
				            array(
				                "type" => "textfield",
				                "class" => "",
				                "heading" => esc_html__('Short Description','domnoo'),
				                "param_name" => "des",
				            ),
							array(
								"type" => "attach_image",
								"heading" => esc_html__("Image", 'domnoo'),
								"param_name" => "image"
							),

				            array(
				                "type" => "textfield",
				                "class" => "",
				                "heading" => esc_html__('Facebook','domnoo'),
				                "param_name" => "facebook",
				            ),

				            array(
				                "type" => "textfield",
				                "class" => "",
				                "heading" => esc_html__('Twitter Link','domnoo'),
				                "param_name" => "twitter",
				            ),

				            array(
				                "type" => "textfield",
				                "class" => "",
				                "heading" => esc_html__('Google plus Link','domnoo'),
				                "param_name" => "google",
				            ),

				            array(
				                "type" => "textfield",
				                "class" => "",
				                "heading" => esc_html__('Linkin Link','domnoo'),
				                "param_name" => "linkin",
				            ),

						),
					),
					array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Columns','domnoo'),
		                "param_name" => 'columns',
		                "value" => array(1,2,3,4,5,6),
		            ),
		            array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'domnoo'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'domnoo')
					)
	            )
	        ));

	        // Gallery Images
			vc_map( array(
	            "name" => esc_html__("Apus Gallery",'domnoo'),
	            "base" => "apus_gallery",
	            'description'=> esc_html__('Display Gallery In FrontEnd', 'domnoo'),
	            "class" => "",
	            "category" => esc_html__('Apus Elements', 'domnoo'),
	            "params" => array(
	              	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'domnoo'),
						"param_name" => "title",
						"admin_label" => true,
						"value" => '',
					),
	              	array(
						"type" => "attach_images",
						"heading" => esc_html__("Images", 'domnoo'),
						"param_name" => "images"
					),
					array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Columns','domnoo'),
		                "param_name" => 'columns',
		                "value" => $columns
		            ),
		            array(
						"type" => "textarea",
						'heading' => esc_html__( 'Description', 'domnoo' ),
						"param_name" => "description",
						"value" => '',
						'description' => esc_html__( 'This field is used for Style 2.', 'domnoo' )
				    ),
					array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Layout','domnoo'),
		                "param_name" => 'style',
		                'value' 	=> array(
							esc_html__('Default ', 'domnoo') => 'default', 
						),
						'std' => ''
		            ),
		            array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'domnoo'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'domnoo')
					)
	            )
	        ));
	        // Gallery Images
			vc_map( array(
	            "name" => esc_html__("Apus Video",'domnoo'),
	            "base" => "apus_video",
	            'description'=> esc_html__('Display Video In FrontEnd', 'domnoo'),
	            "class" => "",
	            "category" => esc_html__('Apus Elements', 'domnoo'),
	            "params" => array(
	              	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'domnoo'),
						"param_name" => "title",
						"admin_label" => true,
						"value" => '',
					),
					array(
						"type" => "textarea_html",
						'heading' => esc_html__( 'Description', 'domnoo' ),
						"param_name" => "content",
						"value" => '',
						'description' => esc_html__( 'Enter description for title.', 'domnoo' )
				    ),
				    array(
						"type" => "attach_image",
						"heading" => esc_html__("Background Image", 'domnoo'),
						"param_name" => "image_bg"
					),
	              	array(
						"type" => "attach_image",
						"heading" => esc_html__("Icon Play Image", 'domnoo'),
						"param_name" => "image"
					),
					array(
		                "type" => "textfield",
		                "heading" => esc_html__('Youtube Video Link','domnoo'),
		                "param_name" => 'video_link'
		            ),
		            array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'domnoo'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'domnoo')
					)
	            )
	        ));
	        // Features Box
			vc_map( array(
	            "name" => esc_html__("Apus Features Box",'domnoo'),
	            "base" => "apus_features_box",
	            'description'=> esc_html__('Display Features In FrontEnd', 'domnoo'),
	            "class" => "",
	            "category" => esc_html__('Apus Elements', 'domnoo'),
	            "params" => array(
	            	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'domnoo'),
						"param_name" => "title",
						"admin_label" => true,
						"value" => '',
					),
					array(
						'type' => 'param_group',
						'heading' => esc_html__('Members Settings < 7 items', 'domnoo' ),
						'param_name' => 'items',
						'description' => '',
						'value' => '',
						'params' => array(
							array(
								"type" => "attach_image",
								"description" => esc_html__("Image for box.", 'domnoo'),
								"param_name" => "image",
								"value" => '',
								'heading'	=> esc_html__('Image', 'domnoo' )
							),
							array(
				                "type" => "textfield",
				                "class" => "",
				                "heading" => esc_html__('Title','domnoo'),
				                "param_name" => "title",
				            ),
				            array(
				                "type" => "textarea",
				                "class" => "",
				                "heading" => esc_html__('Description','domnoo'),
				                "param_name" => "description",
				            ),
							array(
								"type" => "textfield",
								"heading" => esc_html__("ionicons.com Icon and Awesome Icon", 'domnoo'),
								"param_name" => "icon",
								"value" => '',
								'description' => esc_html__( 'This support display icon from Material Design and Awesome Icon, Please click', 'domnoo' )
												. '<a href="' . ( is_ssl()  ? 'https' : 'http') . '://zavoloklom.github.io/material-design-iconic-font/icons.html" target="_blank">'
												. esc_html__( 'here to see the list', 'domnoo' ) . '</a>'
							),
							array(
								"type" => "colorpicker",
								"heading" => esc_html__("Background Color", 'domnoo'),
								"param_name" => "bg_color",
								'value' 	=> '',
							),
							array(
				                "type" => "textfield",
				                "class" => "",
				                "heading" => esc_html__('Read More (Url)','domnoo'),
				                "param_name" => "link",
				            ),
						),
					),
		           	array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Style Layout','domnoo'),
		                "param_name" => 'style',
		                'value' 	=> array(
		                	esc_html__('Default', 'domnoo') => 'default', 
							esc_html__('Default White', 'domnoo') => '', 
							esc_html__('Icon Images', 'domnoo') => 'icon',
						),
						'std' => ''
		            ),
		            array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'domnoo'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'domnoo')
					)
	            )
	        ));

			// information
			vc_map( array(
	            "name" => esc_html__("Apus Information history",'domnoo'),
	            "base" => "apus_information_box",
	            'description'=> esc_html__('Display Features In FrontEnd', 'domnoo'),
	            "class" => "",
	            "category" => esc_html__('Apus Elements', 'domnoo'),
	            "params" => array(
					array(
						'type' => 'param_group',
						'heading' => esc_html__('Members Settings', 'domnoo' ),
						'param_name' => 'items',
						'description' => '',
						'value' => '',
						'params' => array(
							array(
				                "type" => "textfield",
				                "class" => "",
				                "heading" => esc_html__('Title','domnoo'),
				                "param_name" => "title",
				            ),
				            array(
				                "type" => "textarea",
				                "class" => "",
				                "heading" => esc_html__('Description','domnoo'),
				                "param_name" => "description",
				            ),
							array(
								"type" => "attach_image",
								"description" => esc_html__("Image for box.", 'domnoo'),
								"param_name" => "image",
								"value" => '',
								'heading'	=> esc_html__('Image', 'domnoo' )
							),
							array(
								"type" => "textfield",
								"heading" => esc_html__("Shop Now URL", 'domnoo'),
								"param_name" => "shop_now",
								"value" => '',
								"admin_label"	=> true
							),
						),
					),
	             	array(
		              	"type" => "textfield",
		              	"heading" => esc_html__("Number Columns", 'domnoo'),
		              	"param_name" => "number",
		              	'value' => '1',
		            ),
		           	array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Style','domnoo'),
		                "param_name" => 'style',
		                'value' 	=> array(
							esc_html__('Default Box', 'domnoo') => '', 
						),
						'std' => ''
		            ),
		            array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'domnoo'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'domnoo')
					)
	            )
	        ));


			// FAQ
			vc_map( array(
	            "name" => esc_html__("Apus FAQ Box",'domnoo'),
	            "base" => "apus_faq_box",
	            'description'=> esc_html__('Display FAQ In FrontEnd', 'domnoo'),
	            "class" => "",
	            "category" => esc_html__('Apus Elements', 'domnoo'),
	            "params" => array(
	            	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'domnoo'),
						"param_name" => "title",
						"admin_label" => true,
						"value" => '',
					),
					array(
						'type' => 'param_group',
						'heading' => esc_html__('Members Settings', 'domnoo' ),
						'param_name' => 'items',
						'description' => '',
						'value' => '',
						'params' => array(
							array(
				                "type" => "textfield",
				                "class" => "",
				                "heading" => esc_html__('Title','domnoo'),
				                "param_name" => "title",
				            ),
				            array(
				                "type" => "textarea",
				                "class" => "",
				                "heading" => esc_html__('Description','domnoo'),
				                "param_name" => "description",
				            ),
						),
					),

		            array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'domnoo'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'domnoo')
					)
	            )
	        ));



			$custom_menus = array();
			if ( is_admin() ) {
				$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
				if ( is_array( $menus ) && ! empty( $menus ) ) {
					foreach ( $menus as $single_menu ) {
						if ( is_object( $single_menu ) && isset( $single_menu->name, $single_menu->slug ) ) {
							$custom_menus[ $single_menu->name ] = $single_menu->slug;
						}
					}
				}
			}
			// Menu
			vc_map( array(
			    "name" => esc_html__("Apus Custom Menu",'domnoo'),
			    "base" => "apus_custom_menu",
			    "class" => "",
			    "description"=> esc_html__('Show Custom Menu', 'domnoo'),
			    "category" => esc_html__('Apus Elements', 'domnoo'),
			    "params" => array(
			    	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'domnoo'),
						"param_name" => "title",
						"value" => '',
						"admin_label"	=> true
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Menu', 'domnoo' ),
						'param_name' => 'nav_menu',
						'value' => $custom_menus,
						'description' => empty( $custom_menus ) ? esc_html__( 'Custom menus not found. Please visit Appearance > Menus page to create new menu.', 'domnoo' ) : esc_html__( 'Select menu to display.', 'domnoo' ),
						'admin_label' => true,
						'save_always' => true,
					),
					array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Align','domnoo'),
		                "param_name" => 'align',
		                'value' 	=> array(
							esc_html__('Inherit', 'domnoo') => '', 
							esc_html__('Left', 'domnoo') => 'left', 
							esc_html__('Right', 'domnoo') => 'right', 
							esc_html__('Center', 'domnoo') => 'center', 
						),
						'std' => ''
		            ),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'domnoo'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'domnoo')
					)
			   	)
			));

			vc_map( array(
	            "name" => esc_html__("Apus Instagram",'domnoo'),
	            "base" => "apus_instagram",
	            'description'=> esc_html__('Display Instagram In FrontEnd', 'domnoo'),
	            "class" => "",
	            "category" => esc_html__('Apus Elements', 'domnoo'),
	            "params" => array(
	            	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'domnoo'),
						"param_name" => "title",
						"admin_label" => true,
						"value" => '',
					),
					array(
		              	"type" => "textfield",
		              	"heading" => esc_html__("Instagram Username", 'domnoo'),
		              	"param_name" => "username",
		            ),
					array(
		              	"type" => "textfield",
		              	"heading" => esc_html__("Number", 'domnoo'),
		              	"param_name" => "number",
		              	'value' => '1',
		            ),
	             	array(
		              	"type" => "textfield",
		              	"heading" => esc_html__("Number Columns", 'domnoo'),
		              	"param_name" => "columns",
		              	'value' => '1',
		            ),
		           	array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Layout Type','domnoo'),
		                "param_name" => 'layout_type',
		                'value' 	=> array(
							esc_html__('Grid', 'domnoo') => 'grid', 
							esc_html__('Carousel', 'domnoo') => 'carousel', 
						)
		            ),
		            array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Photo size','domnoo'),
		                "param_name" => 'size',
		                'value' 	=> array(
							esc_html__('Thumbnail', 'domnoo') => 'thumbnail', 
							esc_html__('Small', 'domnoo') => 'small', 
							esc_html__('Large', 'domnoo') => 'large', 
							esc_html__('Original', 'domnoo') => 'original', 
						)
		            ),
		            array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Open links in','domnoo'),
		                "param_name" => 'target',
		                'value' 	=> array(
							esc_html__('Current window (_self)', 'domnoo') => '_self', 
							esc_html__('New window (_blank)', 'domnoo') => '_blank',
						)
		            ),
		            array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'domnoo'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'domnoo')
					)
	            )
	        ));
		}
	}
	add_action( 'vc_after_set_mode', 'domnoo_load_load_theme_element', 99 );

	class WPBakeryShortCode_apus_title_heading extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_call_action extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_brands extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_socials_link extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_newsletter extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_googlemap extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_testimonials extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_banner_countdown extends WPBakeryShortCode {}

	class WPBakeryShortCode_apus_counter extends WPBakeryShortCode {
		public function __construct( $settings ) {
			parent::__construct( $settings );
			$this->load_scripts();
		}

		public function load_scripts() {
			wp_register_script('jquery-counterup', get_template_directory_uri().'/js/jquery.counterup.min.js', array('jquery'), false, true);
		}
	}
	class WPBakeryShortCode_apus_ourteam extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_banner extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_gallery extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_video extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_features_box extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_faq_box extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_information_box extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_custom_menu extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_instagram extends WPBakeryShortCode {}
}