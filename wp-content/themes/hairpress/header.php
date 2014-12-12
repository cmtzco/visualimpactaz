<?php
/**
 * The Header for Hairpress Theme
 */
?><!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
    <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    
    <!--  ================  --> 
    <!--  = Google Fonts =  -->
    <!--  ================  -->
	<script type="text/javascript">
	    WebFontConfig = {
	        google : {
	            families : ['PT+Sans:400,700:latin,latin-ext,cyrillic', 'Lobster::latin']
	        }
	    };
	    (function() {
	        var wf = document.createElement('script');
	        wf.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
	        wf.type = 'text/javascript';
	        wf.async = 'true';
	        var s = document.getElementsByTagName('script')[0];
	        s.parentNode.insertBefore(wf, s);
	    })();
    </script>
	
	
	<!--  ===================================================  -->
	<!--  = HTML5 shim, for IE6-8 support of HTML5 elements =  -->
	<!--  ===================================================  -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->
	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<header>
    	<div class="navbar navbar-inverse <?php echo get_theme_mod( 'navbar_position', 'navbar-fixed-top' ); ?>">
    	  <div class="navbar-inner">
    	    <div class="container">
    	      <!--  =========================================  -->
			  <!--  = Used for showing navigation on mobile =  -->
			  <!--  =========================================  -->
    	      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
    	        <span class="icon-bar"></span>
    	        <span class="icon-bar"></span>
    	        <span class="icon-bar"></span>
    	      </a>
    	      
    	      <!--  ==============================  -->
			  <!--  = Place for logo and tagline =  -->
			  <!--  ==============================  -->
    	      <a class="brand" href="<?php echo home_url(); ?>">
    	      	<?php
				  $logo = get_theme_mod( 'logo_img' );;
				  if ( empty( $logo ) ) :
				?>
    	      	<img src="<?php echo get_template_directory_uri() . "/assets/images/scissors.png"; ?>" alt="HairPress Logo" width="48" height="53" class="logo" />
    	      	<h1>
    	      		<?php echo colored_title( get_bloginfo( 'title' ) ); ?>
    	      	</h1>
    	      	<span class="tagline"><?php echo get_bloginfo( 'description' ); ?></span>
    	      	<?php else: ?>
    	      	<img src="<?php echo $logo; ?>" alt="<?php echo esc_attr( get_bloginfo( 'title' ) ); ?>" />
    	      	<?php endif; ?>
	      	  </a>
	      	  
	      	  <!--  =============================================  -->
		      <!--  = Main top navigation with drop-drown menus =  -->
			  <!--  =============================================  -->
    	      <div class="nav-collapse collapse">
    	      	<?php
    	      	if ( has_nav_menu( 'main-menu' ) ) {
			      	$args = array(
						'theme_location'  => 'main-menu',
						'container'       => false,
						'menu_class'      => 'nav',
						'echo'            => true,
						'depth'           => 3,
					);
    	      		wp_nav_menu( $args );
                }
    	      	?>
    	      	<?php
    	      		$btn_page_id = ot_get_option( 'appointment_button', null );
					if ( null != $btn_page_id ) :
						$btn_page = get_page( $btn_page_id ); ?>
    	        	<a href="<?php echo get_page_link( $btn_page->ID ); ?>" class="btn btn-theme btn-large pull-right"><?php echo $btn_page->post_title; ?></a>
    	        	<?php endif; ?>
	          </div><!-- /.nav-collapse-->
	        </div>
	      </div>
	    </div>
    </header>
