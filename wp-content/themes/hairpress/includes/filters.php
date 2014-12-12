<?php

//  ========== 
//  = Filters for Hairpress WP theme = 
//  ========== 

 
/**
 * Add the .light classes to the titles
 */
function my_title( $title ) {
	if ( ! is_admin() ) {
		return lighted_title( $title );
	} else {
		return $title;
	}
		
}
add_filter( "the_title", "my_title" );




/**
 * Add the subtitle to the widget titles
 */
function widget_subtitle( $title ) {
	if ( strstr( $title, "//" ) ) {
		$parts = explode( "//", $title);
		foreach( $parts as $part ) {
			$trimmed[] = trim( $part );
		}
		$h2 =  '<h2>';
		$h2 .= lighted_title( $trimmed[0] );
		$h2 .=  '</h2>';
		
		$h5 =  '<h5>';
		$h5 .= $trimmed[1];
		$h5 .=  '</h5>';
		
		return $h2 . $h5;
	} else {
		return '<h2>' . lighted_title( $title ) . '</h2>';
	}
}
add_filter( "widget_title", "widget_subtitle" );



/**
 * Change excerpt length
 */
function my_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'my_excerpt_length', 999 );



/**
 * Add custom menu walker to all the menus
 */
function bootstrap_menu_walker( $args ) {
	return array_merge( $args, array(
		'walker' => new twitter_bootstrap_nav_walker(),
	) );
}
add_filter( 'wp_nav_menu_args', 'bootstrap_menu_walker' );



/**
 * Add shortcodes in widgets
 */
add_filter( 'widget_text', 'do_shortcode' );
