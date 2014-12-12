<?php

//  ========== 
//  = Helper functions = 
//  ========== 




/**
 * Adds theme color (width <span> element) to all the words except the first one
 * 
 * @param string $str The input string 
 * @return string The properly formatted string with class .theme-clr
 */
function colored_title( $str ) {
	$out = "";
	if ( str_word_count( $str) > 1 ) {
		$first_space = stripos( $str, " " ) + 1;
	}
	if ( $first_space ) {
		$out .= substr( $str, 0, $first_space );
		$out .= '<span class="theme-clr">';
		$out .= substr( $str, $first_space );
		$out .= '</span>';
		return $out;
	} else {
		return $str;
	}
}



/**
 * Adds light class (width <span> element) to the first word  
 * 
 * @param string $str The input string 
 * @return string The properly formatted string with class .light
 */
function lighted_title( $str ) {
	$out = "";
	$str = trim( strip_tags( $str ) );
	if ( strpos( $str, " " ) !== FALSE ) {
		$first_space = strpos( $str, " " );
	}
	if ( !empty( $first_space ) ) {
		$out .= '<span class="light">';
		$out .= substr( $str, 0, $first_space );
		$out .= '</span>';
		$out .= substr( $str, $first_space );
		return $out;
	} else {
		return $str;
	}
}



/**
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string Filtered title.
 */
function twentytwelve_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'proteusthemes' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'twentytwelve_wp_title' , 10, 2 );




/**
 * Function for creating breadcrumbs navigation 
 * 
 * @see http://dimox.net/wordpress-breadcrumbs-without-a-plugin/
 */
function dimox_breadcrumbs() {

	/* === OPTIONS === */
	$text['home']     = __( 'Home Page', 'proteusthemes' ); // text for the 'Home' link
	$text['category'] = __( 'Archive by Category &quot;%s&quot;', 'proteusthemes' ); // text for a category page
	$text['search']   = __( 'Search Results for &quot;%s&quot; Query', 'proteusthemes' ); // text for a search results page
	$text['tag']      = __( 'Posts Tagged &quot;%s&quot;', 'proteusthemes' ); // text for a tag page
	$text['author']   = __( 'Articles Posted by %s', 'proteusthemes' ); // text for an author page
	$text['404']      = __( 'Error 404', 'proteusthemes' ); // text for the 404 page

	$showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
	$showOnHome  = 1; // 1 - show breadcrumbs on the homepage, 0 - don't show
	$delimiter   = ' <li class="divider"></li> '; // delimiter between crumbs
	$before      = '<li class="current">'; // tag before the current crumb
	$after       = '</li>'; // tag after the current crumb
	/* === END OF OPTIONS === */

	global $post;
	$homeLink = home_url() . '/';
	$linkBefore = '<li>';
	$linkAfter = '</li>';
	$linkAttr = '';
	$link = $linkBefore . '<a' . $linkAttr . ' href="%1$s">%2$s</a>' . $linkAfter;

	if ( is_front_page() ) {

		if ($showOnHome == 1) echo '<ul class="breadcrumb"><a href="' . $homeLink . '">' . $text['home'] . '</a></ul>';

	} else {

		echo '<ul class="breadcrumb">' . sprintf($link, $homeLink, $text['home']) . $delimiter;

		if ( is_category() ) {
			$thisCat = get_category(get_query_var('cat'), false);
			if ($thisCat->parent != 0) {
				$cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
				$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
				$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
				echo $cats;
			}
			echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;

		} elseif ( is_search() ) {
			echo $before . sprintf($text['search'], get_search_query()) . $after;

		} elseif ( is_day() ) {
			echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
			echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
			echo $before . get_the_time('d') . $after;

		} elseif ( is_month() ) {
			echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
			echo $before . get_the_time('F') . $after;

		} elseif ( is_year() ) {
			echo $before . get_the_time('Y') . $after;

		} elseif ( is_single() && !is_attachment() ) {
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				printf($link, $homeLink . $slug['slug'] . '/', $post_type->labels->singular_name);
				if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;
			} else {
				$cat = get_the_category(); $cat = $cat[0];
				$cats = get_category_parents($cat, TRUE, $delimiter);
				if ($showCurrent == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
				$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
				$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
				echo $cats;
				if ($showCurrent == 1) echo $before . get_the_title() . $after;
			}

		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
			$post_type = get_post_type_object(get_post_type());
			echo $before . $post_type->labels->name . $after;

		} elseif ( is_attachment() ) {
			$parent = get_post($post->post_parent);
			$cat = @get_the_category($parent->ID);
            if( !empty( $cat ) ) {
                $cat = $cat[0];
                $cats = get_category_parents($cat, TRUE, $delimiter);
                $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
                $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
                echo $cats;
                printf($link, get_permalink($parent), $parent->post_title);
                if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;
            }
    			

		} elseif ( is_page() && !$post->post_parent ) {
			if ($showCurrent == 1) echo $before . get_the_title() . $after;

		} elseif ( is_page() && $post->post_parent ) {
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
				$parent_id  = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			for ($i = 0; $i < count($breadcrumbs); $i++) {
				echo $breadcrumbs[$i];
				if ($i != count($breadcrumbs)-1) echo $delimiter;
			}
			if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;

		} elseif ( is_tag() ) {
			echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

		} elseif ( is_author() ) {
	 		global $author;
			$userdata = get_userdata($author);
			echo $before . sprintf($text['author'], $userdata->display_name) . $after;

		} elseif ( is_404() ) {
			echo $before . $text['404'] . $after;
		
		} elseif ( is_home() && !is_front_page() ) {
			$blog_id = get_option( 'page_for_posts' );
			$blog = get_page( $blog_id );
			if ( 1 == $showCurrent ) echo $before . $blog->post_title . $after;
		}

		if ( get_query_var('paged') ) {
			echo $delimiter;
			echo $linkBefore . '(';
			echo __( 'Page', 'proteusthemes' ) . ' ' . get_query_var('paged');
			echo ')' . $linkAfter;
			
		}

		echo '</ul>';

	}
} // end dimox_breadcrumbs()




/**
 * Check if we are on the login page
 */
function is_login_page() {
    return in_array( $GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php' ) );
}




/**
 * Pagination for WP
 * 
 * @see http://www.kriesi.at/archives/how-to-build-a-wordpress-post-pagination-without-plugin
 */
function kriesi_pagination($main_class_span, $range = 2) {  
     $showitems = ($range * 2)+1;
	 $pages = '';

     global $paged;
     if(empty($paged)) $paged = 1;

     if( $pages == '' ) {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         
         if(!$pages) {
             $pages = 1;
         }
     }   

     if( 1 != $pages )
     {
         echo '<div class="span2">';
         if( $paged > 1 ) {
         	echo '<a href="' . get_pagenum_link($paged - 1) . '" class="btn btn-theme no-bevel"><span class="icon icons-pagination-prev"></span> ' . __( 'Previous', 'proteusthemes' ) . '</a>';
         }
		 echo '</div>';
         	

		 echo '<div class="span' . ((int)$main_class_span - 4) . '"><div class="pagination-numbers">';
         for ( $i=1; $i <= $pages; $i++ ) {
             if ( 1 != $pages && ( ! ( $i >= $paged+$range+1 || $i <= $paged-$range-1 ) || $pages <= $showitems ) ) {
                 echo ( $paged == $i ) ? '<a href="' . get_pagenum_link($i) . '" class="btn btn-theme number no-bevel active" >' . $i . "</a> " : '<a href="' . get_pagenum_link($i) . '" class="btn btn-theme number no-bevel" >' . $i . "</a> ";
             }
         }
		 echo '</div></div>';
		 
		 echo '<div class="span2">';
         if ( $paged < $pages )
         	echo '<a href="' . get_pagenum_link($paged + 1) . '" class="btn btn-theme no-bevel pull-right">' . __( 'Next', 'proteusthemes' ) . ' <span class="icon icons-pagination-next"></span></a>';  
         echo "</div>\n";
     }
}




/**
 * Calculate darker hexdec color variant
 * 
 * @see http://stackoverflow.com/questions/3512311/how-to-generate-lighter-darker-color-with-php
 */

function darken_css_color( $color = '', $percent = 20 ) {
	// return if not specified 
	if ( empty( $color ) )
		return;
	
	$percent = 100 - $percent;
	
	// Extract the colors. I'd prefer to use regular expressions, though there are probably other more efficient ways too.
	if( !preg_match( '/^#?([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})$/i', $color, $parts ) )
		echo "#000000";
	
	// Now we have red in $parts[1], green in $parts[2] and blue in $parts[3]. Now, let's convert them from hexadecimal to integers:
	$out = ""; // Prepare to fill with the results
	for( $i = 1; $i <= 3; $i++ ) {
		$parts[$i] = hexdec( $parts[$i] );
		// Then we'll decrease them by 20 %:
		$parts[$i] = round( $parts[$i] * ( (int)$percent/100 ) ); // 80/100 = 80%, i.e. 20% darker
		// Increase or decrease it to fit your needs
		// Now, we'll turn them back into hexadecimal and add them to our output string
		
		$out .= str_pad( dechex( $parts[$i] ), 2, '0', STR_PAD_LEFT );
	}
	return "#" . $out;
}



/**
 * Create a style for the HTML attribute from the array of the CSS properties
 */
function create_style_attr($attrs) {
    $bg_style = '';
        
    if( !empty($attrs) ) {
       $bg_style = ' style="';
       foreach ($attrs as $key => $value) {
           if( 'background-image' === $key ) {
               $bg_style .= $key . ': url(\'' . $value . '\'); ';
               
           } else {
               $bg_style .= $key . ': ' . $value . '; ';
           }
       }
       $bg_style .= '"';
    }
    
    return $bg_style;
}
