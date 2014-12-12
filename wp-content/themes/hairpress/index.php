<?php get_header(); ?>

	<?php get_template_part( 'titlearea' ); ?>
    
    <?php get_template_part( 'breadcrumbs' ); ?>
    
    <div class="main-content">
    	<div class="container">
    		<div class="row">
    			<?php
    				$sidebar = ot_get_option( 'blog_layout', 'left' );
					
					if ( "no" == $sidebar ) {
						$main_class_span = 12;
					} else {
						$main_class_span = 9;
					}
					
					if ( "left" == $sidebar ) {
				?>
    			<div class="span3">
    				<div class="left sidebar">
    					<?php dynamic_sidebar( 'blog-sidebar' ); ?>
    				</div>
    			</div>
    			<?php } ?>
    			
    			<div class="span<?php echo $main_class_span; ?>">
    				<div class="row">
    					
    					<?php if ( have_posts() ) :
								while ( have_posts() ) : 
									the_post();
						?>
    					<div <?php post_class( "span" . $main_class_span ); ?>>
    						<div class="post-inner">
    						    <div class="lined">
    		    					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    		    					<div class="meta-data">
    		    						<?php the_time( get_option( 'date_format' ) ); ?>  &nbsp; | &nbsp;
    		    						<?php _e( 'Author', 'proteusthemes' ); ?>: <?php the_author(); ?> &nbsp; | &nbsp;
    		    						<a href="<?php comments_link(); ?>"><?php comments_number( __( 'No comments', 'proteusthemes' ), __( 'One comment', 'proteusthemes' ), /*translators: % represents the number, you must include it */ __( '% comments', 'proteusthemes' ) ); ?></a> &nbsp; | &nbsp;
    		    						<?php _e( 'Categories' , 'proteusthemes'); ?>: <?php the_category(' &bull; '); ?><?php if( has_tag() ) { ?> &nbsp; | &nbsp; <?php _e( 'Tags', 'proteusthemes' ); ?>: <?php the_tags( '', ' &bull; ' ); ?>
    		    						    <?php } ?>
    								</div>
    		    					<span class="bolded-line"></span>
    		    				</div>
    		    				<?php if( has_post_thumbnail() ) : ?>
    		    				    <a href="<?php the_permalink(); ?>">
    		    				        <?php the_post_thumbnail(); ?>
		    				        </a>
    		    				<?php endif; ?>
		    				    <?php the_content( sprintf( '<span class="btn btn-theme no-bevel">%s</span>', __('Read More', 'proteusthemes') ) ); ?>
		    				    <?php if ( strlen( get_the_title() ) < 1 ) : ?>
		    				        <a href="<?php the_permalink(); ?>"><?php _e( 'Link to this post', 'proteusthemes' ); ?></a>
		    				    <?php endif; ?>
		    				    <div class="clearfix"></div>
		    				</div>
    					</div><!-- /blogpost -->
    					
    					<div class="span<?php echo $main_class_span; ?>">
		    				<div class="divide-line">
		    					<div class="icon icons-<?php echo $content_divider; ?>"></div>
		    				</div>
		    			</div>
		    			
		    			<?php endwhile; else : ?>
		    				<div class="span<?php echo $main_class_span; ?>">
		    					<div class="lined">
		    						<h2><?php _e( 'Not Found' , 'proteusthemes'); ?></a></h2>
		    						<span class="bolded-line"></span>
		    					</div>
		    					<p><?php _e( 'No posts found, sorry.' , 'proteusthemes'); ?></p>
		    				</div>
	    				<?php endif; ?>
	    				
	    				
	    				<div class="span<?php echo $main_class_span; ?>">
		    				<div class="row">
		    					<?php kriesi_pagination( $main_class_span ); ?>
		    				</div>
		    			</div>
    					
    				</div>
    			</div><!-- /blog -->
    			
    			<?php if ( "right" == $sidebar ) { ?>
    			<div class="span3">
    				<div class="right sidebar">
    					<?php dynamic_sidebar( 'blog-sidebar' ); ?>
    				</div>
    			</div>
    			<?php } ?>
    			
    		</div><!-- / -->
    	</div><!-- /container -->
    </div>

<?php get_footer(); ?>
