<?php
/*
Template Name: Contact Page Template
*/
?>

<?php get_header(); ?>

	<?php get_template_part( 'titlearea' ); ?>
    
    <?php get_template_part( 'breadcrumbs' ); ?>

    <?php
    $infowindow_title = ot_get_option( 'gm_infowindow_title' );
    $infowindow_desc = ot_get_option( 'gm_infowindow_desc' );
    $latlng = ot_get_option( 'gm_lat_lng' );
    $map_type = get_theme_mod( 'map_type' ) == false ? 'h' : get_theme_mod( 'map_type' );
	
	if ( ! empty( $latlng ) ) {
	    if( ! empty( $infowindow_title ) && ! empty( $infowindow_desc ) ) {
	        $title = "{$infowindow_desc}({$infowindow_title})@";
	    } else {
	        $title = '';
	    }
		$map_query = http_build_query( array(
			'q' => $title . "{$latlng}",
			't' => $map_type,
			'z' => 15,
			'output' => 'embed',
			'ie' => 'UTF8',
		), NULL, '&amp;' ); ?>
	    <iframe class="full-map" src="https://maps.google.com/maps?<?php echo $map_query; ?>"></iframe>
	<?php } ?>
    
    
    <div class="main-content">
    	<div class="container">
    		<div class="row">
    			
    			<div class="span3">
    				<div class="right sidebar">
    					<?php dynamic_sidebar( 'contact-sidebar' ); ?>
    				</div>
    			</div>
    			
    			<div class="span9">
    				<div class="row">
    					
    					<?php the_post(); ?>
    					
    					<div class="span9">
    						<div class="lined">
		    					<h2><?php the_title(); ?></h2>
		    					<?php
		    						$subtitle = get_post_meta( get_the_ID(), 'subtitle', true );
									if ( ! empty( $subtitle ) ) :
		    					?>
		    					<h5><?php echo $subtitle; ?></h5>
		    					<?php endif; ?>
		    					<span class="bolded-line"></span>
		    				</div>
		    				<div class="row">
		    					<div class="span9">
		    						<?php the_content(); ?>
	    						</div>
		    				</div>
    					</div>
    					
    				</div>
    			</div>
    			
    			
    			
    		</div><!-- / -->
    	</div><!-- /container -->
    </div>

<?php get_footer(); ?>
