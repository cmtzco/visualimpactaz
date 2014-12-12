<?php get_header(); ?>

	<?php get_template_part( 'titlearea' ); ?>
    
    <?php get_template_part( 'breadcrumbs' ); ?>
    
    <div class="main-content">
    	<div class="container">
    		<div class="row">
    			<?php
    				$sidebar = ot_get_option( 'gallery_layout', 'left' );
					
					if ( "no" == $sidebar ) {
						$main_class_span = 12;
					} else {
						$main_class_span = 9;
					}
					
					if ( "left" == $sidebar ) {
				?>
    			<div class="span3">
    				<div class="left sidebar">
    					<?php dynamic_sidebar( 'gallery-sidebar' ); ?>
    				</div>
    			</div>
    			<?php } ?>
    			
    			<div class="span<?php echo $main_class_span; ?>">
    				<div class="row">
    					
    					<?php if ( have_posts() ) :
								while ( have_posts() ) : 
									the_post();
						?>
    					<div class="span<?php echo $main_class_span; ?>">
    						<div class="lined">
		    					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		    					<?php
		    						$subtitle = get_post_meta( get_the_ID(), 'subtitle', true );
									if ( ! empty( $subtitle ) ) :
		    					?>
		    					<h5><?php echo $subtitle; ?></h5>
		    					<?php endif; ?>
		    					<span class="bolded-line"></span>
		    				</div>
		    				
		    				<?php the_content(); ?>
		    				
		    				<div class="gallery clearfix">
		    					<?php
		    					$args = array(
								   'post_type' => 'attachment',
								   'nopaging' => true,
								   'post_status' => null,
								   'post_parent' => $post->ID
								 );
								
								 $attachments = get_posts( $args );
							     if ( $attachments ) {
							        foreach ( $attachments as $attachment ) { ?>
							        	<div class="picture">
											<a href="<?php echo $attachment->guid; ?>">
								        		<?php echo wp_get_attachment_image( $attachment->ID, 'thumbnail' ); ?>
												<span class="img-overlay"><span class="icon icons-zoom"></span></span>
											</a>
							        	</div>
							    <?php } // foreach
							    } // if
								?>
							</div>
		    				
    					</div><!-- /gallery -->
    					
    					<div class="span<?php echo $main_class_span; ?>">
		    				<div class="divide-line">
		    					<div class="icon icons-<?php echo $content_divider; ?>"></div>
		    				</div>
		    			</div>
    					
		    			<?php endwhile; else : ?>
		    				<p><?php _e( 'Gallery not found' , 'proteusthemes'); ?></p>
	    				<?php endif; ?>
	    				
	    				<div class="span<?php echo $main_class_span; ?>">
		    				<div class="row">
		    					<?php kriesi_pagination( $main_class_span ); ?>
		    				</div>
		    			</div>
    					
    				</div>
    			</div><!-- /galleries -->
    			
    			<?php
    				if ( "right" == $sidebar ) {
				?>
    			<div class="span3">
    				<div class="right sidebar">
    					<?php dynamic_sidebar( 'gallery-sidebar' ); ?>
    				</div>
    			</div>
    			<?php } ?>
    			
    			
    		</div><!-- / -->
    	</div><!-- /container -->
    </div>

<?php get_footer(); ?>
