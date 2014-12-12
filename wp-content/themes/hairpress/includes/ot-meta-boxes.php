<?php

//  ========== 
//  = Meta Boxes for various data = 
//  ========== 

add_action( 'admin_init', 'custom_meta_boxes' );

function custom_meta_boxes() {
	// general
	$my_meta_box = array(
		'id'        => 'hairpress_options',
		'title'     => __( 'Hairpress Options' , 'proteusthemes'),
		'desc'      => __( 'Options specific to Hairpress theme' , 'proteusthemes'),
		'pages'     => array( 'page', 'gallery' ),
		'context'   => 'normal',
		'priority'  => 'high',
		'fields'    => array(
			array(
				'id'          => 'subtitle',
				'label'       => __( 'Subtitle' , 'proteusthemes'),
				'desc'        => __( 'Subtitle of this page (shown right below the main title). Leave blank if you don\'t want to show.' , 'proteusthemes'),
				'std'         => '',
				'type'        => 'text',
				'class'       => '',
				'choices'     => array()
			),
			array(
				'id'          => 'title_bg',
				'label'       => __( 'Background Image for Title Area' , 'proteusthemes'),
				'desc'        => __( 'You can upload a custom image for the background of the title area for individual page.' , 'proteusthemes'),
				'std'         => '',
				'type'        => 'background',
				'class'       => '',
				'choices'     => array()
			),
			array(
                'id'          => 'revo_slider_alias',
                'label'       => __( 'Slider Revolution alias' , 'proteusthemes'),
                'desc'        => __( 'Only applies to the templates "Front Page with Revolution Slider" and "Front page with content". Paste the alias of the slider you created in the Revolution Slider plugin to this box (only <a href="https://www.diigo.com/item/image/3rli1/s9bj?size=o">alias</a>, not the whole shortcode).' , 'proteusthemes'),
                'std'         => '',
                'type'        => 'text',
                'class'       => '',
                'choices'     => array()
            ),
		)
	);
	if ( function_exists( 'ot_get_option' ) )
		ot_register_meta_box( $my_meta_box );
	
	
	
	// services
	$my_meta_box = array(
		'id'        => 'hairpress_options',
		'title'     => __( 'Hairpress Options' , 'proteusthemes'),
		'desc'      => __( 'Options specific to Hairpress theme' , 'proteusthemes'),
		'pages'     => array( 'services' ),
		'context'   => 'normal',
		'priority'  => 'high',
		'fields'    => array(
			array(
				'id'          => 'subtitle',
				'label'       => __( 'Subtitle' , 'proteusthemes'),
				'desc'        => __( 'Subtitle of this page (shown right below the main title). Leave blank if you don\'t want to show.' , 'proteusthemes'),
				'std'         => '',
				'type'        => 'text',
				'class'       => '',
				'choices'     => array()
			),
			array(
				'id'          => 'show_front_page',
				'label'       => __( 'Show on front page' , 'proteusthemes'),
				'desc'        => __( 'Show this service on the front page?' , 'proteusthemes'),
				'std'         => '',
				'type'        => 'select',
				'class'       => '',
				'choices'     => array(
					array(
			            'value'       => 'yes',
			            'label'       => __( 'Yes' , 'proteusthemes'),
			            'src'         => ''
			        ),
					array(
			            'value'       => 'no',
			            'label'       => __( 'No' , 'proteusthemes'),
			            'src'         => ''
			        ),
				)
			),
            array(
                'id'          => 'title_bg',
                'label'       => __( 'Background Image for Title Area' , 'proteusthemes'),
                'desc'        => __( 'You can upload a custom image for the background of the title area for individual page.' , 'proteusthemes'),
                'std'         => '',
                'type'        => 'background',
                'class'       => '',
                'choices'     => array()
            ),
		)
	);
	if ( function_exists( 'ot_get_option' ) )
		ot_register_meta_box( $my_meta_box );
	
	
	
	
	// team
	$my_meta_box = array(
		'id'        => 'team_options',
		'title'     => __( 'Hairpress Options' , 'proteusthemes'),
		'desc'      => __( 'Options specific to Hairpress theme' , 'proteusthemes'),
		'pages'     => array( 'team' ),
		'context'   => 'normal',
		'priority'  => 'high',
		'fields'    => array(
			array(
				'id'          => 'subtitle',
				'label'       => __( 'Subtitle' , 'proteusthemes'),
				'desc'        => __( 'Subtitle of this page (shown right below the main title). Leave blank if you don\'t want to show.' , 'proteusthemes'),
				'std'         => '',
				'type'        => 'text',
				'class'       => '',
				'choices'     => array()
			),
			array(
				'id'          => 'team_custom_fields',
				'label'       => __( 'Team Member Custom Fields' , 'proteusthemes'),
				'desc'        => __( 'You can here define properties of the team member such as Age, Style, Education etc.' , 'proteusthemes'),
				'type'        => 'list-item',
			),
		)
	);
	if ( function_exists( 'ot_get_option' ) )
		ot_register_meta_box( $my_meta_box );
	
	
	// testimonials
	$my_meta_box = array(
		'id'        => 'testimonial_options',
		'title'     => __( 'Testimonial Options' , 'proteusthemes'),
		'desc'      => '',
		'pages'     => array( 'testimonials' ),
		'context'   => 'normal',
		'priority'  => 'high',
		'fields'    => array(
			array(
				'id'          => 'author_title',
				'label'       => __( 'Title of the author for this testimonial' , 'proteusthemes'),
				'desc'        => '',
				'std'         => '',
				'type'        => 'text',
				'class'       => '',
				'choices'     => array()
			),
		)
	);
	if ( function_exists( 'ot_get_option' ) )
		ot_register_meta_box( $my_meta_box );
}