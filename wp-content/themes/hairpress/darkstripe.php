<?php
$query_members = new WP_Query( array(
    'post_type' => 'team',
    'nopaging' => true
) );
$num_of_members = (int)$query_members->post_count;
if ( 0 < $num_of_members ) :
?>
    
    <div class="dark-stripe">
        <div class="container">
            <div class="row">
                
                <div class="span12">
                    <div class="lined">
                        <h2>
                            <a href="#" class="nav-left icon icons-arrow-left-white"></a>
                            <a href="<?php echo get_post_type_archive_link( 'team' ); ?>"><?php echo lighted_title( ot_get_option( 'team_page_title', __( 'Meet the Team' , 'proteusthemes') ) ); ?></a>
                            <a href="#" class="nav-right icon icons-arrow-right-white"></a>
                        </h2>
                        <?php
                        $subtitle = ot_get_option( 'fp_team_subtitle', '' );
                        if( ! empty( $subtitle ) ) { ?>
                        <h5><?php echo $subtitle; ?></h5>
                        <?php } ?>
                        <span class="bolded-line"></span>
                    </div>
                    <div class="carousel carousel-wide">
                        <div class="slide">
                            <ul class="thumbnails">
                                
                                <?php if( $num_of_members < 6  ) {
                                    $span_n = round( ( 12 - ( $num_of_members * 2 ) ) / 2 );
                                    echo '<li class="span' . $span_n . '"></li>';
                                } ?>
                                
                                <?php
                                $team = new WP_Query( array(
                                    'post_type' => 'team',
                                    'nopaging' => true,
                                    'order' => 'ASC',
                                    'orderby' => 'menu_order'
                                ) );
                                if ( $team->have_posts() ) : 
                                    $team_count = -1;
                                    while( $team->have_posts() ) :
                                        $team->the_post();
                                        $team_count++;
                                        
                                        if ( 0 !== $team_count && $team_count % 6 == 0 ) {
                                ?>
                            </ul>
                        </div><!-- /slide -->
                        <div class="slide">
                            <ul class="thumbnails">
                                        <?php } ?>
                                
                                <li class="span2"><!-- team member -->
                                    <div class="picture hidden-phone">
                                        <a href="<?php echo get_post_type_archive_link( 'team' ); ?>#member-id-<?php the_ID(); ?>">
                                            <?php the_post_thumbnail( 'team-small', array( 'class' => 'grayscale-img' ) ); ?>
                                            <span class="shine-overlay"></span>
                                        </a>
                                    </div>
                                    <div class="caption">
                                        <h4 class="theme-clr">
                                            <a href="<?php echo get_post_type_archive_link( 'team' ); ?>#member-id-<?php the_ID(); ?>">
                                            <?php echo strip_tags( get_the_title() ); ?>
                                            </a>
                                        </h4>
                                        <?php
                                            $subtitle = get_post_meta( get_the_ID(), 'subtitle', true );
                                            if ( ! empty( $subtitle ) ) :
                                        ?>
                                        <p class="title no-margin"><?php echo $subtitle; ?></p>
                                        <?php endif; ?>
                                    </div>
                                </li><!-- /team member -->
                                
                                <?php
                                    endwhile;
                                endif;
                                wp_reset_postdata();
                                ?>
                                
                            </ul>
                        </div><!-- /slide -->
                    </div>
                </div>
                
                    
                
            </div><!-- /row -->
        </div><!-- /container -->
    </div>
    
<?php endif; ?>