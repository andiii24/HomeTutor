<?php
/**
 * Banner Section
 * 
 * @package prime_playschool_classes
 */

$prime_playschool_classes_args = array(
  'post_type' => 'post',
  'post_status' => 'publish',
  'category_name' =>  get_theme_mod('prime_playschool_classes_blog_slide_category'),
  'posts_per_page' => 3,
); ?>

<div class="banner">
  <div class="owl-carousel">
    <?php $prime_playschool_classes_arr_posts = new WP_Query( $prime_playschool_classes_args );
    if ( $prime_playschool_classes_arr_posts->have_posts() ) :
      while ( $prime_playschool_classes_arr_posts->have_posts() ) :
        $prime_playschool_classes_arr_posts->the_post();
        ?>
        <div class="banner_inner_box">
          <?php
            if ( has_post_thumbnail() ) :
              the_post_thumbnail();
            endif;
          ?>
          <div class="banner_box">
            <h3 class="my-3"><?php the_title(); ?></a></h3>
            <p class="mb-0"><?php echo wp_trim_words( get_the_content(), 30 ); ?></p>
            <p class="btn-green mt-4">
              <a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php esc_html_e('Enroll Your Child','prime-playschool-classes'); ?></a>
            </p>
          </div>
        </div>
      <?php
    endwhile;
    wp_reset_postdata();
    endif; ?>
  </div>
</div>