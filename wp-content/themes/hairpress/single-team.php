<?php get_header(); ?>

	<?php get_template_part( 'titlearea' ); ?>
    
    <?php get_template_part( 'breadcrumbs' ); ?>
    
    <div class="main-content">
    	<div class="container">
    		<?php
			$params = array_merge( $wp_query->query_vars, array(
				'orderby' => 'menu_order',
				'nopaging' => true,
				'order' => 'ASC'
			) );
			query_posts( $params );
    		
    		?>
    		
    		<?php if ( have_posts() ) :
					$member_num = 1;
					while ( have_posts() ) : 
						the_post();
			?>
    		<div class="row">
    			<div class="team-member">
    				<div class="span3">
    					<div class="picture">
    						<?php the_post_thumbnail( 'team-large' ); ?>
    						<div class="shine-overlay"></div>
    					</div>
    				</div>
    				<div class="span6">
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
    					<?php the_content(); ?>
    				</div>
    				<div class="span3">
    					<div class="member-details">
    						<div class="lined"><div class="bolded-line"></div></div>
    						
    						<?php $age = get_post_meta( get_the_ID(), 'team_age', true );
    						if ( ! empty( $age ) ) : ?>
    						<p><strong><?php _e( 'Age' , 'proteusthemes'); ?>:</strong> <?php echo $age; ?></p>
    						<div class="bolded-line"></div>
    						<?php endif; ?>
    						
    						<?php $zodiac = get_post_meta( get_the_ID(), 'team_zodiac', true );
    						if ( ! empty( $zodiac ) ) : ?>
    						<p><strong><?php _e( 'Zodiac sign' , 'proteusthemes'); ?>:</strong> <?php echo $zodiac; ?></p>
    						<div class="bolded-line"></div>
    						<?php endif; ?>
    						
    						<?php $education = get_post_meta( get_the_ID(), 'team_education', true );
    						if ( ! empty( $education ) ) : ?>
    						<p><strong><?php _e( 'Education' , 'proteusthemes'); ?>:</strong> <?php echo $education; ?></p>
    						<div class="bolded-line"></div>
    						<?php endif; ?>
    						
    						<?php $experience = get_post_meta( get_the_ID(), 'team_experience', true );
    						if ( ! empty( $experience ) ) : ?>
    						<p><strong><?php _e( 'Experience' , 'proteusthemes'); ?>:</strong> <?php echo $experience; ?></p>
    						<div class="bolded-line"></div>
    						<?php endif; ?>
    						
    						<?php $style = get_post_meta( get_the_ID(), 'team_style', true );
    						if ( ! empty( $style ) ) : ?>
    						<p><strong><?php _e( 'Style' , 'proteusthemes'); ?>:</strong> <?php echo $style; ?></p>
    						<div class="bolded-line"></div>
    						<?php endif; ?>
    						
    					</div>
    				</div>
    			</div><!-- /team-member -->
    		</div>
    		
    		<div class="row">
				<div class="span12">
					<div class="divide-line">
						<span class="icon icons-<?php echo $content_divider; ?>"></span>
					</div>
				</div>
			</div>
    			    		
    		<?php endwhile; else : ?>
    			<p>No members yet</p>
			<?php endif; ?>
    		
    	</div><!-- /container -->
    </div>

<?php get_footer(); ?>
