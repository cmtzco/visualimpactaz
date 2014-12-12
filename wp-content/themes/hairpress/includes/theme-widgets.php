<?php


/**************************************
 * Opening Time Widget
 * -----------------------------------
 * Adds the opening time, suitable for the sidebar or used above the slider 
 **************************************/

class Opening_Time extends WP_Widget {
	
	/**
	 * Days of the week, needed for display and $instance variable
	 */
	var $days;

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		false, // ID, auto generate when false
			__( "Hairpress: Opening Time" , 'proteusthemes'), // Name
			array(
				'description' => __( 'Opening Time Widget for placing it into the sidebar or above the slider' , 'proteusthemes'),
				'classname' => 'opening-time'
			)
		);
		
        // init the days
        $start_of_week = get_option( 'start_of_week ' ); // integer [0,6], 0 = Sunday, 1 = Monday ...
        $starting_time = strtotime('next Sunday +' . $start_of_week . ' days');
        $this->days = array();
        
        for( $i = 0; $i < 7; $i++ ) {
            $today = $starting_time + $i*86400;
            $this->days[date( 'D', $today )] = date_i18n( 'l', $today );
        }
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		$title = $instance['title'];
		
		$out = "";
		
        
		$out .= $before_widget;
		$out .= '<div class="time-table">' . "\n";
		
		if ( ! empty( $title ) ) {
			
			$out .= '<h3><span class="icon icons-ornament-left"></span> ' .  lighted_title( $title ) . ' <span class="icon icons-ornament-right"></span></h3>';
		}
		$out .= '<div class="inner-bg">' . "\n";
        $current_time = intval( time() + ( (double)get_option('gmt_offset') * 3600 ) );
		
		$i = 0;
		foreach( $this->days as $day_label => $day ) {
			$class = $i%2==0 ? "" : " light-bg";
			
			if ( "1" != $instance[$day_label . '_opened'] ) {
				$class .= " closed";
			}
			
			if ( date( 'D', $current_time ) == $day_label ) {
				$class .= " today";
			}
				
			$out .= '<dl class="week-day' . $class . '">' . "\n";
			$out .= '<dt>' . $day . '</dt>' . "\n";
			if ( "1" == $instance[$day_label . '_opened'] ) {
				$out .= '<dd>' . $instance[$day_label . '_from'] . $instance['separator'] . $instance[$day_label . '_to'] . '</dd>' . "\n";
			} else {
				$out .= '<dd>' . $instance['closed_text'] . '</dd>' . "\n";
			}
				
	                                    
	        $out .= '</dl>' . "\n";
	        $i++;
		}
			
		
		$out .= '</div>' . "\n"; // .inner-bg
		$out .= '</div>' . "\n"; // .time-table
		$out .= $after_widget;
		
		
		echo $out;
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		
		// title
		$instance['title'] = strip_tags( $new_instance['title'] );
		
		// days
		foreach( $this->days as $day_label => $day ) {
			$instance[$day_label . '_opened'] = strip_tags( $new_instance[$day_label . '_opened'] );
			$instance[$day_label . '_from'] = strip_tags( $new_instance[$day_label . '_from'] );
			$instance[$day_label . '_to'] = strip_tags( $new_instance[$day_label . '_to'] );
		}
		
		// separator
		$instance['separator'] = $new_instance['separator'];
		// closed text
		$instance['closed_text'] = $new_instance['closed_text'];

		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'Opening Time' , 'proteusthemes');
		}
		
		foreach ( $this->days as $day_label => $day ) {
			// opened/closed
			if ( isset( $instance[$day_label . '_opened'] ) ) {
				if ( "1" == $instance[$day_label . '_opened'] ) {
					$opened[$day_label] = 'checked="checked"';
				} else {
					$opened[$day_label] = '';
				}
			} else {
				$opened[$day_label] = 'checked="checked"';
			}
			// from time
			if ( isset( $instance[$day_label . '_from'] ) ) {
				$from[$day_label] = $instance[$day_label . '_from'];
			} else {
				$from[$day_label] = "8:00";
			}
			// to time
			if ( isset( $instance[$day_label . '_to'] ) ) {
				$to[$day_label] = $instance[$day_label . '_to'];
			} else {
				$to[$day_label] = "16:00";
			}
		}
		
		if ( isset( $instance[ 'separator' ] ) ) {
			$separator = $instance[ 'separator' ];
		}
		else {
			$separator = __( '-' , 'proteusthemes');
		}
		
		if ( isset( $instance[ 'closed_text' ] ) ) {
			$closed_text = $instance[ 'closed_text' ];
		}
		else {
			$closed_text = __( 'CLOSED' , 'proteusthemes');
		}
		
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' , 'proteusthemes'); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<?php // days
		foreach ( $this->days as $day_label => $day ) : ?>
		<p>
			<label for="<?php echo $this->get_field_id( $day_label . '_from' ); ?>"><b><?php echo $day; ?></b></label> <br />
			<input type="checkbox" id="<?php echo $this->get_field_id( $day_label . '_opened' ) ?>" name="<?php echo $this->get_field_name( $day_label . '_opened' ); ?>" value="1" <?php echo $opened[$day_label]; ?> /> <?php _e( 'opened' , 'proteusthemes'); ?> 
			<br />			<input type="text" id="<?php echo $this->get_field_id( $day_label . '_from' ) ?>" name="<?php echo $this->get_field_name( $day_label . '_from' ); ?>" value="<?php echo esc_attr( $from[$day_label] ); ?>" size="5" /> <?php _e( "to" , 'proteusthemes') ?> 
			<input type="text" id="<?php echo $this->get_field_id( $day_label . '_to' ) ?>" name="<?php echo $this->get_field_name( $day_label . '_to' ); ?>" value="<?php echo esc_attr( $to[$day_label] ) ?>" size="5" />
		</p>
		<?php endforeach; // end days ?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'separator' ); ?>"><?php _e( 'Separator between hours' , 'proteusthemes'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'separator' ); ?>" name="<?php echo $this->get_field_name( 'separator' ); ?>" type="text" value="<?php echo $separator; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'closed_text' ); ?>"><?php _e( 'Text used for closed days' , 'proteusthemes'); ?>:</label>
			<input id="<?php echo $this->get_field_id( 'closed_text' ); ?>" name="<?php echo $this->get_field_name( 'closed_text' ); ?>" type="text" value="<?php echo esc_attr( $closed_text ); ?>" />
		</p>
		
		<?php 
	}

} // class Opening_Time
add_action( 'widgets_init', create_function( '', 'register_widget( "Opening_Time" );' ) );






/**************************************
 * Home Page Services Widget
 * -----------------------------------
 * List of the services on the home page 
 **************************************/

class Home_Services extends WP_Widget {
	
	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		false, // ID, auto generate when false
			__( "Hairpress: Our Services" , 'proteusthemes'), // Name
			array(
				'description' => __( 'Use this widget only on the home page of the Hairpress theme' , 'proteusthemes'),
			)
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		$num = intval( $instance['num'] );
		
	    $services = new WP_Query( array(
	  		'post_type' => 'services',
	  		'posts_per_page' => $num,
	  		'orderby' => 'menu_order',
	  		'order' => 'ASC',
	  		'post_status' => 'publish',
	  		'meta_key' => 'show_front_page',
	  		'meta_value' => 'yes',
		) );
        $count = 0;
	  	if ( $services->have_posts() ) : 
	  		while( $services->have_posts() ) :
	  			$services->the_post();
	  			$count++;
	  			?>
	    <article class="span3"><!-- service -->
	        <div class="picture">
	            <a href="<?php the_permalink(); ?>">
	        	      <?php
		  			  	the_post_thumbnail( 'services-front' );
	  			  	  ?>
	              	  <span class="img-overlay">
	              	     <span class="btn btn-inverse"><?php _e( 'Read more' , 'proteusthemes'); ?></span>
	              	  </span>
	          	</a>
	        </div>
	        <div>
	        	<h3 class="size-16"><?php the_title(); ?></h3>
	        	<span class="bolded-line"></span>
	        </div>
	        <?php the_excerpt(); ?>
	        <a href="<?php the_permalink(); ?>" class="read-more"><?php _e( 'READ MORE' , 'proteusthemes'); ?> -</a>
	    </article><!-- /service -->
	    <?php if( $count % 4 == 0 ) : ?>
        <div class="clearfix"></div>
        <?php endif; ?>
	    <?php
    		endwhile;
		endif;
		wp_reset_postdata();
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		
		// number
		$instance['num'] = strip_tags( $new_instance['num'] );
		
		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'num' ] ) ) {
			$num = $instance[ 'num' ];
		} else {
			$num = '3';
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'num' ); ?>"><?php _e( 'Number of services to display:' , 'proteusthemes'); ?></label> 
			<input size="5" id="<?php echo $this->get_field_id( 'num' ); ?>" name="<?php echo $this->get_field_name( 'num' ); ?>" type="text" value="<?php echo esc_attr( $num ); ?>" />
		</p>
		
		<?php 
	}

} // class Home_Services
add_action( 'widgets_init', create_function( '', 'register_widget( "Home_Services" );' ) );






/**************************************
 * Home Page Latest News Widget
 * -----------------------------------
 * List of the latest news on the home page 
 **************************************/

class Home_Last_News extends WP_Widget {
	
	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		false, // ID, auto generate when false
			__( "Hairpress: Latest News" , 'proteusthemes'), // Name
			array(
				'description' => __( 'Use this widget only on the home page of the Hairpress theme' , 'proteusthemes'),
			)
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		$num = intval( $instance['num'] );
		$link = $instance['link'];
		
		?>
		<div class="span<?php echo $num * 3; ?>"><!-- latest news -->
	          <div class="lined">
	          	<?php if( ! empty( $link ) ) { ?>
	              <a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>" class="btn btn-theme pull-right no-bevel"><?php echo $link; ?></a>
	              <?php }
		              $instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		              echo $instance['title'];
	              ?>
	              <span class="bolded-line"></span>
	          </div>
          
	          <div class="row">
	          	<?php
	    	    $news = new WP_Query( array(
					'posts_per_page' => $num,
				) );
	      	  	if ( $news->have_posts() ) : 
	      	  		while( $news->have_posts() ) :
      	  				$news->the_post(); ?>
	              <article class="span3">
	                  <h3 class="no-margin"><?php the_title(); ?></h3>
	                  <div class="meta-info">
	                      <span class="date"><?php the_time( get_option( 'date_format' ) ); ?></span>
	                  </div>
	                  <?php the_excerpt(); ?>
	                  <a href="<?php the_permalink(); ?>" class="read-more"><?php _e( 'READ MORE' , 'proteusthemes'); ?> -</a>
	              </article>
	    	              <?php
	    	      		endwhile;
					endif;
					wp_reset_postdata();
		      	  ?>
	          </div>
	    </div><!-- /latest news -->
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['num'] = strip_tags( $new_instance['num'] );
		$instance['link'] = strip_tags( $new_instance['link'] );
		
		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'Latest News // What is going on' , 'proteusthemes');
		}
		
		if ( isset( $instance[ 'num' ] ) ) {
			$num = $instance[ 'num' ];
		} else {
			$num = '2';
		}
		
		if ( isset( $instance[ 'link' ] ) ) {
			$link = $instance[ 'link' ];
		} else {
			$link = '';
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' , 'proteusthemes'); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'num' ); ?>"><?php _e( 'Number of news to display' , 'proteusthemes'); ?>:</label> 
			<input size="5" id="<?php echo $this->get_field_id( 'num' ); ?>" name="<?php echo $this->get_field_name( 'num' ); ?>" type="text" value="<?php echo esc_attr( $num ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e( 'Text for the all posts\'s link' , 'proteusthemes'); ?>:</label> <br />
			<input id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" type="text" value="<?php echo esc_attr( $link ); ?>" />
		</p>
		
		<?php 
	}

} // class Home_Last_News
add_action( 'widgets_init', create_function( '', 'register_widget( "Home_Last_News" );' ) );






/**************************************
 * Home Page Latest Galleries Widget
 * -----------------------------------
 * List of the latest news on the home page 
 **************************************/

class Home_Last_Gallery extends WP_Widget {
	
	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		false, // ID, auto generate when false
			__( "Hairpress: Latest Galleries" , 'proteusthemes'), // Name
			array(
				'description' => __( 'Use this widget only on the home page of the Hairpress theme' , 'proteusthemes'),
			)
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		$num = intval( $instance['num'] );
		
		?>
		<div class="span3 gallery-widget"><!-- gallery -->
          <div class="lined">
              <nav class="arrows pull-right">
                  <a href="#" class="nav-left icon icons-arrow-left"></a>
                  <a href="#" class="nav-right icon icons-arrow-right"></a>
              </nav>
              <?php
	              $instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
	              echo $instance['title'];
              ?>
              <span class="bolded-line"></span>
          </div>
          <div class="carousel">
          	<?php
    	    $gallery = new WP_Query( array(
    	    	'post_type' => 'gallery',
    	    	'posts_per_page' => $num
			) );
      	  	if ( $gallery->have_posts() ) : 
      	  		while( $gallery->have_posts() ) :
  	  				$gallery->the_post(); ?>
          	<div class="slide">
          		<ul class="thumbnails">
          			<?php
          			$gallery_permalink = get_permalink();
          			
					$args = array(
					   'post_type' => 'attachment',
					   'posts_per_page' => 9,
					   'post_status' => null,
					   'post_parent' => get_the_ID()
					 );
					
					 $attachments = get_posts( $args );
				     if ( $attachments ) {
				        foreach ( $attachments as $attachment ) { ?>
		        	<li class="span1 picture">
          		        <a href="<?php echo $gallery_permalink; ?>">
          		            <?php echo wp_get_attachment_image( $attachment->ID, 'thumbnail' ); ?>
          		            <span class="img-overlay">
          		                <span class="icon icons-zoom"></span>
          		            </span>
          		        </a>
          		    </li>
				    <?php } // foreach
				    } //if
					?>
          		</ul>
          	</div><!-- /slide -->
          	<?php
	      		endwhile;
			endif;
			wp_reset_postdata();
	      	?>
          </div><!-- /carousel -->
        </div><!-- /gallery -->

		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['num'] = strip_tags( $new_instance['num'] );
		
		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'Gallery // From the studio' , 'proteusthemes');
		}
		
		if ( isset( $instance[ 'num' ] ) ) {
			$num = $instance[ 'num' ];
		} else {
			$num = '2';
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' , 'proteusthemes'); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'num' ); ?>"><?php _e( 'Number of galleries to display' , 'proteusthemes'); ?>:</label> 
			<input size="5" id="<?php echo $this->get_field_id( 'num' ); ?>" name="<?php echo $this->get_field_name( 'num' ); ?>" type="text" value="<?php echo esc_attr( $num ); ?>" />
		</p>
		
		<?php 
	}

} // class Home_Last_Gallery
add_action( 'widgets_init', create_function( '', 'register_widget( "Home_Last_Gallery" );' ) );






/**************************************
 * Home Page Three Columns Widget
 * -----------------------------------
 * List of the latest news on the home page 
 **************************************/

class Home_Three_Columns extends WP_Widget {
	
	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		false, // ID, auto generate when false
			__( "Hairpress: Three Columns" , 'proteusthemes'), // Name
			array(
				'description' => __( 'Use this widget only on the home page of the Hairpress theme' , 'proteusthemes'),
			),
			array( 'width' => 500 )
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		?>
		<div class="span12">
            <div class="lined">
            	<?php if( ! empty( $instance['link'] ) ) { ?>
                <a href="<?php echo $instance['link']; ?>" class="btn btn-theme pull-right no-bevel"><?php echo $instance['link_text']; ?></a>
                <?php } ?>
                <?php
	              $instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
	              echo $instance['title'];
              	?>
                <span class="bolded-line"></span>
            </div>
            <div class="row">
            	<?php for( $i=0; $i < 3; $i++ ) { ?>
            		<div class="span4">
                    <?php echo $instance["textblock_{$i}"]; ?>
                </div>
        		<?php } ?>
            </div>
        </div>
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['link'] = $new_instance['link'];
		$instance['link_text'] = strip_tags( $new_instance['link_text'] );
		
		for( $i = 0; $i < 3; $i++ ) {
			$instance["textblock_{$i}"] = $new_instance["textblock_{$i}"];
		}
		
		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		} else {
			$title = __( 'About Us // Our interesting story' , 'proteusthemes');
		}
		
		if ( isset( $instance['link'] ) ) {
			$link = $instance['link'];
		} else {
			$link = '';
		}
		
		if ( isset( $instance[ 'link_text' ] ) ) {
			$link_text = $instance['link_text'];
		} else {
			$link_text = '';
		}
		
		$textblock = array();
		for( $i = 0; $i < 3; $i++ ) {
			if ( isset( $instance["textblock_{$i}"] ) ) {
				$textblock[$i] = $instance["textblock_{$i}"];
			} else {
				$textblock[$i] = '';
			}
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' , 'proteusthemes'); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'link_text' ); ?>"><?php _e( 'Link text' , 'proteusthemes'); ?>:</label> <br />
			<input id="<?php echo $this->get_field_id( 'link_text' ); ?>" name="<?php echo $this->get_field_name( 'link_text' ); ?>" type="text" value="<?php echo esc_attr( $link_text ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e( 'Link' , 'proteusthemes'); ?>:</label> <br />
			<input id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" type="text" value="<?php echo esc_attr( $link ); ?>" />
		</p>
		<?php
		for( $i = 0; $i < 3; $i++ ) { ?>
		<p>
			<label for="<?php echo $this->get_field_id( "textblock_{$i}" ); ?>"><?php _e( "Text block" , 'proteusthemes'); ?> <?php echo ( $i + 1 ); ?>:</label> <br />
			<textarea id="<?php echo $this->get_field_id( "textblock_{$i}" ); ?>" name="<?php echo $this->get_field_name( "textblock_{$i}" ); ?>" rows="5" style="width: 100%;"><?php echo esc_attr( $textblock[$i] ); ?></textarea>
		</p>
		<?php } 
	}

} // class Home_Three_Columns
add_action( 'widgets_init', create_function( '', 'register_widget( "Home_Three_Columns" );' ) );






/**************************************
 * Home Page Testimonials Widget
 * -----------------------------------
 * List of the latest news on the home page 
 **************************************/

class Home_Testimonials extends WP_Widget {
	
	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		false, // ID, auto generate when false
			__( "Hairpress: Testimonials" , 'proteusthemes'), // Name
			array(
				'description' => __( 'Use this widget only on the home page of the Hairpress theme' , 'proteusthemes'),
			)
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		?>
		<div class="span3"><!-- testimonials -->
          <div class="lined">
              <nav class="arrows pull-right">
                  <a href="#" class="nav-left icon icons-arrow-left"></a>
                  <a href="#" class="nav-right icon icons-arrow-right"></a>
              </nav>
              <?php
	              $instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
	              echo $instance['title'];
              ?>
              <span class="bolded-line"></span>
          </div>
          <div class="carousel">
          	<?php
          	$testimonials = new WP_Query( array(
		  		'post_type' => 'testimonials',
		  		'nopaging' => true,
		  		'orderby' => 'menu_order',
		  		'order' => 'ASC'
			) );
	      	  if ( $testimonials->have_posts() ) : 
	      	  	while( $testimonials->have_posts() ) :
      	  			$testimonials->the_post(); ?>
          	<div class="slide">
          		<div class="quote">
          			<blockquote>
          				<?php the_content(); ?>
          			</blockquote>
          			<div class="author">
          			    <div class="person theme-clr"><?php echo strip_tags ( get_the_title() ); ?></div>
          			    <div class="title"><?php echo get_post_meta( get_the_ID(), 'author_title', true ); ?></div>
          			</div>
          		</div>
          	</div>
	        <?php
	      		endwhile;
			endif;
			wp_reset_postdata();
      	    ?>
          </div>
        </div><!-- /testimonials -->
        
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		
		$instance['title'] = strip_tags( $new_instance['title'] );
		
		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'Testimonials // What other said about us' , 'proteusthemes');
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' , 'proteusthemes'); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		
		<?php 
	}

} // class Home_Testimonials
add_action( 'widgets_init', create_function( '', 'register_widget( "Home_Testimonials" );' ) );






/**************************************
 * Home Page Divier Widget
 * -----------------------------------
 * Divided the content blocks vertically 
 **************************************/

class Home_Divider extends WP_Widget {
	
	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		false, // ID, auto generate when false
			__( "Hairpress: Divider" , 'proteusthemes'), // Name
			array(
				'description' => __( 'Use this widget only on the home page of the Hairpress theme' , 'proteusthemes'),
				'classname' => 'our-services'
			)
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		global $content_divider;
		?>
		<div class="span12">
			<div class="divide-line">
			<div class="icon icons-<?php echo $content_divider; ?>"></div>
			</div>
		</div>
		<?php
	}
    
    

} // class Home_Divider
add_action( 'widgets_init', create_function( '', 'register_widget( "Home_Divider" );' ) );







/**************************************
 * Footer Facebook Widget
 * -----------------------------------
 * List of the latest news on the home page 
 **************************************/

class Footer_Facebook extends WP_Widget {
	
	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		false, // ID, auto generate when false
			__( "Hairpress: Facebook" , 'proteusthemes'), // Name
			array(
				'description' => __( 'Use this widget only in the footer of the Hairpress theme' , 'proteusthemes'),
			)
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		?>
			<div class="lined">
    	        <?php
	              $instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
	              echo $instance['title'];
              	?>
    	        <span class="bolded-line"></span>
    	    </div>
	    	<div id="fb-root"></div>
	    	<script>(function(d, s, id) {
	    	  var js, fjs = d.getElementsByTagName(s)[0];
	    	  if (d.getElementById(id)) return;
	    	  js = d.createElement(s); js.id = id;
	    	  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=317322608312190";
	    	  fjs.parentNode.insertBefore(js, fjs);
	    	}(document, 'script', 'facebook-jssdk'));</script>
	    	<div class="fb-like-box" data-href="<?php echo $instance['like_link']; ?>" data-width="268" data-show-faces="true" data-colorscheme="dark" data-stream="false" data-border-color="#000000" data-header="false"></div>

		<?php
		echo $args['after_widget'];
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['like_link'] = strip_tags( $new_instance['like_link'] );
		
		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'Facebook // Like us' , 'proteusthemes');
		}
		
		if ( isset( $instance[ 'like_link' ] ) ) {
			$like = $instance[ 'like_link' ];
		} else {
			$like = '';
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' , 'proteusthemes'); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'like_link' ); ?>"><?php _e( 'FB Page to like' , 'proteusthemes'); ?>:</label> <br /> 
			<input style="width: 100%;" id="<?php echo $this->get_field_id( 'like_link' ); ?>" name="<?php echo $this->get_field_name( 'like_link' ); ?>" type="text" value="<?php echo $like; ?>" />
		</p>
		
		<?php 
	}

} // class Footer_Facebook
add_action( 'widgets_init', create_function( '', 'register_widget( "Footer_Facebook" );' ) );










/**************************************
 * Boostrap menu
 * -----------------------------------
 * Extends the original WP Menu Widget 
 **************************************/

class Bootstrap_Menu extends WP_Nav_Menu_Widget {
	function widget($args, $instance) {
		// Get menu
		$nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;

		if ( !$nav_menu )
			return;

		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo $args['before_widget'];

		if ( !empty($instance['title']) )
			echo $args['before_title'] . $instance['title'] . $args['after_title'];

		wp_nav_menu( array(
			'fallback_cb' => '',
			'menu' => $nav_menu,
			'menu_class' => 'nav nav-pills nav-stacked',
			'depth' => 3,
		) );

		echo $args['after_widget'];
	}
} // class Bootstrap_Menu
unregister_widget( 'WP_Nav_Menu_Widget' ); // unregister default widget and only register the new one
add_action( 'widgets_init', create_function( '', 'register_widget( "Bootstrap_Menu" );' ) );