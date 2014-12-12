<?php
/**
 * The template for displaying the footer.
 */
?>

	<div class="foot">
        <div class="container">
            
            <div class="row">
            	
            	<?php dynamic_sidebar( 'footer-sidebar-area' ); ?>
            	
        	</div><!-- /row -->
        </div><!-- /container -->
    </div><!-- /foot -->
    
    <footer>
        <a href="#" id="to-the-top">
            <span class="icon icons-to-top-arrow"></span>
        </a>
        <div class="container">
        	<div class="row">
        		<div class="span6">
    				<?php echo ot_get_option( 'footer_left', '&copy; Copyright 2013' ); ?>
    		    </div>
        		<div class="span6">
        			<div class="pull-right">
        			<?php echo ot_get_option( 'footer_right', 'Hairpress Theme by <a href="http://www.proteusthemes.com">ProteusThemes</a>' ); ?>
    				</div>
    		    </div>
        	</div>
        </div>
    </footer>

<?php echo ot_get_option('footer_scripts', ''); ?>

<?php wp_footer(); ?>
</body>
</html>