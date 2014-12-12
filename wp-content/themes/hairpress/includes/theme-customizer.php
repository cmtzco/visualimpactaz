<?php
/**
 * Contains methods for customizing the theme customization screen.
 * 
 * @link http://codex.wordpress.org/Theme_Customization_API
 */
class Hairpress_Customize
{
   
   /**
    * This hooks into 'customize_register' (available as of WP 3.4) and allows
    * you to add new sections and controls to the Theme Customize screen.
    * 
    * Note: To enable instant preview, we have to actually write a bit of custom
    * javascript. See live_preview() for more.
    *  
    * @see add_action('customize_register',$func)
    */
   public static function register ( $wp_customize )
   {
      // Register new settings to the WP database...
      $wp_customize->add_setting( 'hairpress[theme_clr]',
         array(
            'default' => '#ac6ed4', //Default setting/value to save
         ) 
      );      
      $wp_customize->add_setting( 'hairpress[btn_clr]',
         array(
            'default' => '#7d5daf', 
         ) 
      );      
      $wp_customize->add_setting( 'hairpress[titlearea_clr]',
         array(
            'default' => '#EAEAE5', 
         ) 
      );      
      $wp_customize->add_setting( 'hairpress[titleareatext_clr]',
         array(
            'default' => '#333333', 
         ) 
      );      
      $wp_customize->add_setting( 'hairpress[bodytext_clr]',
         array(
            'default' => '#727272', 
         ) 
      );      
      $wp_customize->add_setting( 'hairpress[navbar_clr]',
         array(
            'default' => '#000000', 
         ) 
      );      
      $wp_customize->add_setting( 'hairpress[footer_clr]',
         array(
            'default' => '#333333', 
         ) 
      );      
      $wp_customize->add_setting( 'logo_img',
         array(
            'default' => '', 
         ) 
      );      
      $wp_customize->add_setting( 'hairpress[favicon]',
         array(
            'default' => '', 
         ) 
      );      
      $wp_customize->add_setting( 'navbar_position',
         array(
            'default' => 'navbar-fixed-top', 
         ) 
      );      
      $wp_customize->add_setting( 'map_type',
         array(
            'default' => 'h', 
         ) 
      );      
      
      
      
      // add custom sections
      $wp_customize->add_section( 'customizr_images', array(
        'title' => __( 'Images', 'proteusthemes' ),
        'description' => __( 'Images for the Hairpress theme', 'proteusthemes' ),
        'priority' => 30
      ) );
      $wp_customize->add_section( 'contact_page', array(
        'title' => __( 'Contact Page', 'proteusthemes' ),
        'description' => __( 'Settings for contact page', 'proteusthemes' ),
        'priority' => 150
      ) );
      
            
      
      // Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
      $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'hairpress_theme_clr', //Set a unique ID for the control
         array(
            'label' => __( 'Main Theme Color' , 'proteusthemes'), //Admin-visible name of the control
            'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'settings' => 'hairpress[theme_clr]', //Which setting to load and manipulate (serialized is okay)
         ) 
      ) );
      $wp_customize->add_control( new WP_Customize_Color_Control( 
         $wp_customize, 
         'hairpress_btn_clr', 
         array(
            'label' => __( 'Buttons Color' , 'proteusthemes'), 
            'section' => 'colors', 
            'settings' => 'hairpress[btn_clr]',
         ) 
      ) );
      $wp_customize->add_control( new WP_Customize_Color_Control( 
         $wp_customize, 
         'hairpress_titlearea_clr', 
         array(
            'label' => __( 'Backgorund Color for Titles on Subpages' , 'proteusthemes'), 
            'section' => 'colors', 
            'settings' => 'hairpress[titlearea_clr]', 
         ) 
      ) );
      $wp_customize->add_control( new WP_Customize_Color_Control( 
         $wp_customize, 
         'hairpress_titleareatext_clr', 
         array(
            'label' => __( 'Color for Titles on Subpages' , 'proteusthemes'), 
            'section' => 'colors', 
            'settings' => 'hairpress[titleareatext_clr]', 
         ) 
      ) );
      $wp_customize->add_control( new WP_Customize_Color_Control( 
         $wp_customize, 
         'hairpress_bodytext_clr', 
         array(
            'label' => __( 'Base Text Color' , 'proteusthemes'), 
            'section' => 'colors', 
            'settings' => 'hairpress[bodytext_clr]', 
         ) 
      ) );
      $wp_customize->add_control( new WP_Customize_Color_Control( 
         $wp_customize, 
         'hairpress_navbar_clr', 
         array(
            'label' => __( 'Navbar Color' , 'proteusthemes'), 
            'section' => 'colors', 
            'settings' => 'hairpress[navbar_clr]', 
         ) 
      ) );
      $wp_customize->add_control( new WP_Customize_Color_Control( 
         $wp_customize, 
         'hairpress_footer_clr', 
         array(
            'label' => __( 'Footer Color' , 'proteusthemes'), 
            'section' => 'colors', 
            'settings' => 'hairpress[footer_clr]', 
         ) 
      ) );
      $wp_customize->add_control( new WP_Customize_Image_Control( 
         $wp_customize, 
         'hairpress_logo_img', 
         array(
            'label' => __( 'Logo image (recommended dimensions: 200(w) x 55(h))' , 'proteusthemes'), 
            'section' => 'customizr_images', 
            'settings' => 'logo_img', 
         ) 
      ) );
      $wp_customize->add_control( new WP_Customize_Upload_Control( 
         $wp_customize, 
         'hairpress_favicon', 
         array(
            'label' => __( 'Favicon image (16 x 16 px), format .ico' , 'proteusthemes'), 
            'section' => 'customizr_images', 
            'settings' => 'hairpress[favicon]', 
         ) 
      ) );
      $wp_customize->add_control( new WP_Customize_Control( 
         $wp_customize, 
         'hairpress_navbar_position', 
         array(
            'label' => __( 'Position of main Navbar' , 'proteusthemes'), 
            'section' => 'nav', 
            'settings' => 'navbar_position',
            'type' => 'radio',
            'choices' => array(
                'navbar-fixed-top' => __( 'Fixed when scrolling', 'proteusthemes'),
                'navbar-static-top' => __( 'Static position on the top', 'proteusthemes')
            )
         ) 
      ) );
      $wp_customize->add_control( new WP_Customize_Control( 
         $wp_customize, 
         'hairpress_map_type', 
         array(
            'label' => __( 'Type of Google Maps' , 'proteusthemes'), 
            'section' => 'contact_page', 
            'settings' => 'map_type',
            'type' => 'radio',
            'choices' => array(
                'm' => __( 'Normal map', 'proteusthemes'),
                'k' => __( 'Satellite', 'proteusthemes'),
                'h' => __( 'Hybrid', 'proteusthemes'),
                'p' => __( 'Terrain', 'proteusthemes'),
            )
         ) 
      ) );
      
   }

   
   /**
    * This will output the custom WordPress settings to the live theme's WP head.
    * 
    * Used by hook: 'wp_head'
    * 
    * @see add_action('wp_head',$func)
    */
   public static function header_output()
   {
       // customizer settings
   	  $theme_mods = get_theme_mod( 'hairpress' );
      
      // option tree settings
      $hair_bg_img = ot_get_option( 'hair_bg_img', 'on' );
      
      ?>
      <!--Customizer CSS--> 
      <style type="text/css">
      <?php if ( ! empty( $theme_mods['theme_clr'] ) ) : ?>
      	a,
      	.theme-clr,
      	.navbar .nav > li a:hover,
      	.navbar .nav > li.active > a:hover,
      	.dropdown-menu > li > a:hover,
      	.opening-time .week-day.today dt,
      	.sidebar-item.widget_nav_menu .nav-pills > li > a:hover,
      	.lined .meta-data a,
      	.table tbody .active td,
      	.foot a.tweet_user,
      	.foot a.read-more,
      	.foot .nav a:hover {
      		color: <?php echo $theme_mods['theme_clr']; ?>; 
      	}
      	a:hover {
      		color: <?php echo darken_css_color( $theme_mods['theme_clr'], 15 ) ; ?>;
      	}
      	.navbar .nav > li.active > a,
      	.navbar .nav > li.active:after {
  			border-bottom-color: <?php echo $theme_mods['theme_clr']; ?>;
		}
		.navbar .nav > li.dropdown.open > a:after, 
		.navbar .nav > li.dropdown.active > a:after, 
		.navbar .nav > li.dropdown.open.active > a:after, 
		.navbar .nav > li.dropdown:hover > a:after {
			border-top-color: <?php echo $theme_mods['theme_clr']; ?>;
		}
		.breadcrumbs-container .divider {
			border-left-color: <?php echo $theme_mods['theme_clr']; ?>;
		}
		#wp-calendar caption,
		.accordion-heading.open a .icon {
			background-color: <?php echo $theme_mods['theme_clr']; ?>;
		}
		select:focus,
		textarea:focus,
		input[type="text"]:focus,
		input[type="password"]:focus,
		input[type="datetime"]:focus,
		input[type="datetime-local"]:focus,
		input[type="date"]:focus,
		input[type="month"]:focus,
		input[type="time"]:focus,
		input[type="week"]:focus,
		input[type="number"]:focus,
		input[type="email"]:focus,
		input[type="url"]:focus,
		input[type="search"]:focus,
		input[type="tel"]:focus,
		input[type="color"]:focus,
		.uneditable-input:focus {
			border-color: <?php echo $theme_mods['theme_clr']; ?>;
		}
		.table tbody .active {
			border-left-color: <?php echo $theme_mods['theme_clr']; ?>;
			border-right-color: <?php echo $theme_mods['theme_clr']; ?>;
		}
		.table tbody .active td {
			border-top-color: <?php echo $theme_mods['theme_clr']; ?>;
			border-bottom-color: <?php echo $theme_mods['theme_clr']; ?>;
		}
		
	  <?php
	  	endif;
	  	if ( ! empty( $theme_mods['btn_clr'] ) ) : ?>
		.btn-theme,
		#comments-submit-button,
		.sidebar-item.widget_nav_menu .nav-pills > li.active > a,
		.sidebar-item.widget_nav_menu .nav-pills > li.active > a:hover,
		.sidebar-item.widget_nav_menu .nav-pills > li.current-menu-ancestor > a,
		.sidebar-item.widget_nav_menu .nav-pills > li.current-menu-ancestor > a:hover,
		.nav-tabs-theme > .active > a,
		.nav-tabs-theme > .active > a:hover,
		.navbar-inverse .btn-navbar {
			background-color: <?php echo $theme_mods['btn_clr']; ?>;
			background-image: -moz-linear-gradient(top, <?php echo $theme_mods['btn_clr']; ?>, <?php echo darken_css_color( $theme_mods['btn_clr'], 15 ) ; ?>);
			background-image: -webkit-gradient(linear, 0 0, 0 100%, from(<?php echo $theme_mods['btn_clr']; ?>), to(<?php echo darken_css_color( $theme_mods['btn_clr'], 15 ) ; ?>));
			background-image: -webkit-linear-gradient(top, <?php echo $theme_mods['btn_clr']; ?>, <?php echo darken_css_color( $theme_mods['btn_clr'], 15 ) ; ?>);
			background-image: -o-linear-gradient(top, <?php echo $theme_mods['btn_clr']; ?>, <?php echo darken_css_color( $theme_mods['btn_clr'], 15 ) ; ?>);
			background-image: linear-gradient(to bottom, <?php echo $theme_mods['btn_clr']; ?>, <?php echo darken_css_color( $theme_mods['btn_clr'], 15 ) ; ?>);
		}
		.btn-theme:hover, 
		.btn-theme:active, 
		.btn-theme.active, 
		.btn-theme.disabled, 
		.btn-theme[disabled],
		#comments-submit-button:hover,
		#comments-submit-button:active,
		#comments-submit-button.active {
			background-color: <?php echo darken_css_color( $theme_mods['btn_clr'], 15 ) ; ?>;
  			*background-color: <?php echo darken_css_color( $theme_mods['btn_clr'], 20 ) ; ?>;
		}
		.btn-theme:active, 
		.btn-theme.active,
		#comments-submit-button:active
		#comments-submit-button.active {
			background-color: <?php echo darken_css_color( $theme_mods['btn_clr'], 25 ) ; ?>;
		}
		
	<?php endif;
	   if( !empty($theme_mods['titlearea_clr']) ) : ?>
	   
	   .title-area,
	   .fullwidthbanner-container {
	       background-color: <?php echo $theme_mods['titlearea_clr']; ?>;
	   }
	   
	<?php endif;
	   if( !empty($theme_mods['titleareatext_clr']) ) : ?>
	   
	   .title-area h1 {
	       color: <?php echo $theme_mods['titleareatext_clr']; ?>;
	   }
	   
    <?php endif;
        if( !empty( $theme_mods['bodytext_clr'] ) ) : ?>
        
        body {
            color: <?php echo $theme_mods['bodytext_clr']; ?>;
        }
        
    <?php endif;
        if( !empty( $theme_mods['navbar_clr'] ) && '#000000' !== $theme_mods['navbar_clr'] ) : ?>
        
        .navbar-inner {
            background: <?php echo $theme_mods['navbar_clr']; ?>;
        }
        
    <?php endif;
        if( !empty( $theme_mods['footer_clr'] ) ) : ?>
        
        .foot {
            background: <?php echo $theme_mods['footer_clr']; ?>;
        }
        
    <?php endif;
        if( 'off' === $hair_bg_img ) : ?>
    
        @media (min-width: 1679px) {
          .main-content {
            background-image: none;
          }
        }
        
    <?php endif; ?>
    
        <?php echo ot_get_option( 'user_custom_css', '' ); ?>
      	
      </style> 
      <!--/Customizer CSS-->
      
      <!-- Fav icon -->
      <?php if( !empty( $theme_mods['favicon'] ) ) : ?>
        <link rel="shortcut icon" href="<?php echo $theme_mods['favicon']; ?>">
      <?php else : ?>
        <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/favicon.ico">  
      <?php endif; ?>
      
      <?php
   }
    
}

//Setup the Theme Customizer settings and controls...
add_action( 'customize_register' , array( 'Hairpress_Customize' , 'register' ) );

//Output custom CSS to live site
add_action( 'wp_head' , array( 'Hairpress_Customize' , 'header_output' ) );

