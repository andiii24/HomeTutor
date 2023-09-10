<?php 
/**
 * Template part for displaying Featured Classes Section
 *
 * @package Prime Playschool Classes
 */

$prime_playschool_classes_args = array(
  'post_type' => 'post',
  'post_status' => 'publish',
  'category_name' =>  get_theme_mod('prime_playschool_classes_student_category'),
  'posts_per_page' => 6,
); 

$prime_playschool_classes_section_title = get_theme_mod( 'prime_playschool_classes_section_title' );
$prime_playschool_classes_section_text  = get_theme_mod( 'prime_playschool_classes_section_text' );

?>

<div class="our-classes">
    <div class="container">
        <?php if ( $prime_playschool_classes_section_title ){?>
            <h3><?php echo esc_html( $prime_playschool_classes_section_title );?></h3>
        <?php } ?>
        <?php if ( $prime_playschool_classes_section_text ){?>
            <p><?php echo esc_html( $prime_playschool_classes_section_text );?></p>
        <?php } ?>
        <div class="row">
            <?php $prime_playschool_classes_student_posts = new WP_Query( $prime_playschool_classes_args );
            if ( $prime_playschool_classes_student_posts->have_posts() ) :
              while ( $prime_playschool_classes_student_posts->have_posts() ) :
                $prime_playschool_classes_student_posts->the_post();
                ?>
                <div class="col-lg-4 col-md-6">
                    <div class="classes_inner_box">
                        <?php
                            if ( has_post_thumbnail() ) :
                              the_post_thumbnail();
                            endif;
                        ?>
                        <div class="classes_box">
                            <?php if( get_post_meta($post->ID, 'prime_playschool_classes_age', true) || get_post_meta($post->ID, 'prime_playschool_classes_size', true) || get_post_meta($post->ID, 'prime_playschool_classes_price', true) ) {?>
                                <div class="fund-box">
                                    <?php if( get_post_meta($post->ID, 'prime_playschool_classes_age', true) ) {?>
                                        <div class="raised-box">
                                            <p class="first-word mb-0"><?php esc_html_e('Age','prime-playschool-classes'); ?></p>
                                            <p><?php echo esc_html(get_post_meta($post->ID,'prime_playschool_classes_age',true)); ?></p>
                                        </div>
                                        |
                                    <?php }?>
                                    <?php if( get_post_meta($post->ID, 'prime_playschool_classes_size', true) ) {?>
                                        <div class="goal-box">
                                            <p class="first-word mb-0"><?php esc_html_e('Size','prime-playschool-classes'); ?></p>
                                            <p><?php echo esc_html(get_post_meta($post->ID,'prime_playschool_classes_size',true)); ?></p>
                                        </div>
                                        |
                                    <?php }?>
                                    <?php if( get_post_meta($post->ID, 'prime_playschool_classes_price', true) ) {?>
                                        <div class="goal-box">
                                            <p class="first-word mb-0"><?php esc_html_e('Price','prime-playschool-classes'); ?></p>
                                            <p><?php echo esc_html(get_post_meta($post->ID,'prime_playschool_classes_price',true)); ?></p>
                                        </div>
                                    <?php }?>
                                </div>
                            <?php }?>
                            <h4 class="my-3"><?php the_title(); ?></h4>
                            <p class="mb-0"><?php echo wp_trim_words( get_the_content(), 15 ); ?></p>
                            <p class="btn-green mt-3 mb-0">
                              <a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php esc_html_e('Read More','prime-playschool-classes'); ?></a>
                            </p>
                        </div>
                    </div>
                </div>
              <?php
            endwhile;
            wp_reset_postdata();
            endif; ?>
        </div>
    </div>
</div>