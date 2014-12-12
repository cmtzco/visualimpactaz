<?php

/**
 * Register sidebars for Hairpress
 */
 
function add_my_sidebars() {
	// blog sidebar
	if ( function_exists( 'ot_get_option' ) )
		$blog = ot_get_option( 'blog_layout', 'no' );
	if ( "no" != $blog ) {
		register_sidebar(
			array(
				'name'          => __( 'Blog Sidebar' , 'proteusthemes'),
				'id'            => 'blog-sidebar',
				'description'   => __( 'Sidebar in the blog layout' , 'proteusthemes'),
		        'class'         => 'blog sidebar',
				'before_widget' => '<div id="%1$s" class="sidebar-item %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="lined">',
				'after_title'   => '<span class="bolded-line"></span></div>'
			)
		);
	}
	
	// services sidebar
	if ( function_exists( 'ot_get_option' ) )
		$services = ot_get_option( 'services_layout', 'no' );
	if ( "no" != $services ) {
		register_sidebar(
			array(
				'name'          => __( 'Services Sidebar' , 'proteusthemes'),
				'id'            => 'services-sidebar',
				'description'   => __( 'Sidebar in the services layout' , 'proteusthemes'),
		        'class'         => 'services sidebar',
				'before_widget' => '<div id="%1$s" class="sidebar-item %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="lined">',
				'after_title'   => '<span class="bolded-line"></span></div>'
			)
		);
	}
		
	// gallery sidebar
	if ( function_exists( 'ot_get_option' ) )
		$services = ot_get_option( 'gallery_layout', 'no' );
	if ( "no" != $services ) {
		register_sidebar(
			array(
				'name'          => __( 'Gallery Sidebar' , 'proteusthemes'),
				'id'            => 'gallery-sidebar',
				'description'   => __( 'Sidebar in the gallery layout' , 'proteusthemes'),
		        'class'         => 'gallery sidebar',
				'before_widget' => '<div id="%1$s" class="sidebar-item %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="lined">',
				'after_title'   => '<span class="bolded-line"></span></div>'
			)
		);
	}
		
	// contact page
	register_sidebar(
		array(
			'name'          => __( 'Contact Page Sidebar' , 'proteusthemes'),
			'id'            => 'contact-sidebar',
			'description'   => __( 'Sidebar on the contact us and make an appointment page' , 'proteusthemes'),
	        'class'         => 'contact-us sidebar',
			'before_widget' => '<div id="%1$s" class="sidebar-item %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="lined">',
			'after_title'   => '<span class="bolded-line"></span></div>'
		)
	);
		
	
	// regular page
	register_sidebar(
		array(
			'name'          => __( 'Regular Page Sidebar' , 'proteusthemes'),
			'id'            => 'regular-page-sidebar',
			'description'   => __( 'Sidebar on the regular page' , 'proteusthemes'),
	        'class'         => 'regular-page sidebar',
			'before_widget' => '<div id="%1$s" class="sidebar-item %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="lined">',
			'after_title'   => '<span class="bolded-line"></span></div>'
		)
	);
		
	
	// opening time above the slider
	register_sidebar(
		array(
			'name'          => __( 'Above Slider' , 'proteusthemes'),
			'id'            => 'above-slider',
			'description'   => __( 'Sidebar above the slider on the homepage' , 'proteusthemes'),
			'before_widget' => '<div id="%1$s" class="%2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3><span class="icon icons-ornament-left"></span> ',
			'after_title'   => ' <span class="icon icons-ornament-right"></span></h3>'
		)
	);
	
	// home page - above dark stripe
	register_sidebar(
		array(
			'name'          => __( 'Home Page - above dark stripe' , 'proteusthemes'),
			'id'            => 'home-above-dark',
			'description'   => __( 'Sidebar above the dark stripe on the homepage' , 'proteusthemes'),
			'before_widget' => '<div class="span3">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="lined">',
			'after_title'   => '<span class="bolded-line"></span></div>'
		)
	);
	
	// home page - under dark stripe
	register_sidebar(
		array(
			'name'          => __( 'Home Page - under dark stripe' , 'proteusthemes'),
			'id'            => 'home-under-dark',
			'description'   => __( 'Sidebar under the dark stripe on the homepage' , 'proteusthemes'),
			'before_widget' => '<div class="span3">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="lined">',
			'after_title'   => '<span class="bolded-line"></span></div>'
		)
	);
	
	// footer
	register_sidebar(
		array(
			'name'          => __( 'Footer' , 'proteusthemes'),
			'id'            => 'footer-sidebar-area',
			'description'   => __( 'Sidebar in the dark area at the bottom of the website' , 'proteusthemes'),
			'before_widget' => '<div class="span3"><div class="%2$s">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<div class="lined">',
			'after_title'   => '<span class="bolded-line"></span></div>'
		)
	);
}
add_action( "widgets_init", "add_my_sidebars" );
