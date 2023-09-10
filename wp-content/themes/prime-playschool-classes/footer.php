<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package prime_playschool_classes
 */
$prime_playschool_classes_scroll_to_top = get_theme_mod( 'prime_playschool_classes_footer_scroll_to_top',true );
?>
      
      </div>
      </div>
      </div>
      </div>
           
      <footer class="site-footer">
	     <?php if( is_active_sidebar( 'footer-one' ) || is_active_sidebar( 'footer-two' ) || is_active_sidebar( 'footer-three' ) || is_active_sidebar( 'footer-four' ) ){ ?>
      		<div class="footer-t">
      			<div class="container">
      				<div class="row">
      					<?php 
                                          if( is_active_sidebar( 'footer-one') ) {
                                          	echo '<div class="col">';
                                          	dynamic_sidebar( 'footer-one' ); 
                                          	echo '</div>';
                                          }
                                          
                                          if( is_active_sidebar( 'footer-two') ) {
                                          	echo '<div class="col">';
                                          	dynamic_sidebar( 'footer-two' );
                                          	echo '</div>';
                                          }
                                          
                                          if( is_active_sidebar( 'footer-three') ) {
                                          	echo '<div class="col">';
                                          	dynamic_sidebar( 'footer-three' );
                                          	echo '</div>';
                                          }
                                          
                                          if( is_active_sidebar( 'footer-four' ) ) {
                                          	echo '<div class="col">';
                                          	dynamic_sidebar( 'footer-four' );
                                          	echo '</div>';
      						}
                                    ?>
      				</div>
      			</div>
      		</div>
      	<?php } 
		    do_action( 'prime_playschool_classes_footer' );
	      ?>
             <?php if ( $prime_playschool_classes_scroll_to_top ){?>
                  <a id="button"><i class="fas fa-arrow-up"></i></a>
            <?php } ?>
	</footer>
      </div>
</div>

<?php wp_footer(); ?>

</body>
</html>
