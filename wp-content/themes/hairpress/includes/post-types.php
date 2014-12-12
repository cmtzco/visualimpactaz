<?php
//  ========== 
//  = Register custom post types = 
//  ========== 


function hairpress_custom_post_types() {
	// services
	$labels = array(
		'name' => __( 'Services' , 'proteusthemes'),
		'singular_name' => __( 'Service' , 'proteusthemes'),
		'add_new' => __( 'Add New' , 'proteusthemes'),
		'add_new_item' => __( 'Add New Service' , 'proteusthemes'),
		'edit_item' => __( 'Edit Service' , 'proteusthemes'),
		'new_item' => __( 'New Service' , 'proteusthemes'),
		'all_items' => __( 'All Services' , 'proteusthemes'),
		'view_item' => __( 'View Service' , 'proteusthemes'),
		'search_items' => __( 'Search Services' , 'proteusthemes'),
		'not_found' =>  __( 'No services found' , 'proteusthemes'),
		'not_found_in_trash' => __( 'No services found in Trash' , 'proteusthemes'),
		'menu_name' => __( 'Services' , 'proteusthemes'),
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'rewrite' => array( 'slug' => ot_get_option( 'services_url_slug', 'services' ) ),
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => false,
		'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' )
	);
	register_post_type( 'services', $args );
	
	// meet the team
	$labels = array(
		'name' => __( 'Team' , 'proteusthemes'),
		'singular_name' => __( 'Team Member' , 'proteusthemes'),
		'add_new' => __( 'Add New' , 'proteusthemes'),
		'add_new_item' => __( 'Add New Team Member' , 'proteusthemes'),
		'edit_item' => __( 'Edit Team Member' , 'proteusthemes'),
		'new_item' => __( 'New Team Member' , 'proteusthemes'),
		'all_items' => __( 'All Team Members' , 'proteusthemes'),
		'view_item' => __( 'View Team Member' , 'proteusthemes'),
		'search_items' => __( 'Search Team Members' , 'proteusthemes'),
		'not_found' =>  __( 'No team members found' , 'proteusthemes'),
		'not_found_in_trash' => __( 'No team members found in Trash' , 'proteusthemes'),
		'menu_name' => __( 'Team' , 'proteusthemes'),
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'rewrite' => array( 'slug' => ot_get_option( 'the_team_url_slug', 'the-team' ) ),
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => false,
		'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes' )
	);
	register_post_type( 'team', $args );
	
	// gallery
	$labels = array(
		'name' => __( 'Galleries' , 'proteusthemes'),
		'singular_name' => __( 'Gallery' , 'proteusthemes'),
		'add_new' => __( 'Add New' , 'proteusthemes'),
		'add_new_item' => __( 'Add New Gallery' , 'proteusthemes'),
		'edit_item' => __( 'Edit Gallery' , 'proteusthemes'),
		'new_item' => __( 'New Gallery' , 'proteusthemes'),
		'all_items' => __( 'All Galleries' , 'proteusthemes'),
		'view_item' => __( 'View Gallery' , 'proteusthemes'),
		'search_items' => __( 'Search Galleries' , 'proteusthemes'),
		'not_found' =>  __( 'No galleries found' , 'proteusthemes'),
		'not_found_in_trash' => __( 'No galleries found in Trash' , 'proteusthemes'),
		'menu_name' => __( 'Gallery' , 'proteusthemes'),
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'rewrite' => array( 'slug' => ot_get_option( 'gallery_url_slug', 'gallery' ) ),
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => false,
		'supports' => array( 'title', 'editor' )
	);
	register_post_type( 'gallery', $args );
	
	// slider
	$labels = array(
		'name' => __( 'Slider' , 'proteusthemes'),
		'singular_name' => __( 'Slide' , 'proteusthemes'),
		'add_new' => __( 'Add New' , 'proteusthemes'),
		'add_new_item' => __( 'Add New Slide' , 'proteusthemes'),
		'edit_item' => __( 'Edit Slide' , 'proteusthemes'),
		'new_item' => __( 'New Slide' , 'proteusthemes'),
		'all_items' => __( 'All Slides' , 'proteusthemes'),
		'view_item' => __( 'View Slide' , 'proteusthemes'),
		'search_items' => __( 'Search Slides' , 'proteusthemes'),
		'not_found' =>  __( 'No slides found' , 'proteusthemes'),
		'not_found_in_trash' => __( 'No slides found in Trash' , 'proteusthemes'),
		'menu_name' => __( 'Slider' , 'proteusthemes'),
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'capability_type' => 'post',
		'has_archive' => false,
		'hierarchical' => false,
		'supports' => array( 'title', 'thumbnail', 'page-attributes' )
	);
	register_post_type( 'slider', $args );
	
	// testimonials
	$labels = array(
		'name' => __( 'Testimonials' , 'proteusthemes'),
		'singular_name' => __( 'Testimonial' , 'proteusthemes'),
		'add_new' => __( 'Add New' , 'proteusthemes'),
		'add_new_item' => __( 'Add New Testimonial' , 'proteusthemes'),
		'edit_item' => __( 'Edit Testimonial' , 'proteusthemes'),
		'new_item' => __( 'New Testimonial' , 'proteusthemes'),
		'all_items' => __( 'All Testimonials' , 'proteusthemes'),
		'view_item' => __( 'View Testimonial' , 'proteusthemes'),
		'search_items' => __( 'Search Testimonials' , 'proteusthemes'),
		'not_found' =>  __( 'No testimonial found' , 'proteusthemes'),
		'not_found_in_trash' => __( 'No testimonial found in Trash' , 'proteusthemes'),
		'menu_name' => __( 'Testimonials' , 'proteusthemes'),
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'capability_type' => 'post',
		'has_archive' => false,
		'hierarchical' => false,
		'supports' => array( 'title', 'editor', 'page-attributes' )
	);
	register_post_type( 'testimonials', $args );
}
add_action( 'init', 'hairpress_custom_post_types' );
