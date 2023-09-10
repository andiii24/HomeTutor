<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package prime_playschool_classes
 */

if ( ! function_exists( 'prime_playschool_classes_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function prime_playschool_classes_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';

	$byline = '<span class="author vcard" itemprop="author"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';
    
	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function prime_playschool_classes_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'prime_playschool_classes_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'prime_playschool_classes_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so prime_playschool_classes_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so prime_playschool_classes_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in prime_playschool_classes_categorized_blog.
 */
function prime_playschool_classes_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'prime_playschool_classes_categories' );
}
add_action( 'edit_category', 'prime_playschool_classes_category_transient_flusher' );
add_action( 'save_post',     'prime_playschool_classes_category_transient_flusher' );


if ( ! function_exists( 'prime_playschool_classes_category_list' ) ) :
/**
 * Prints Categories lists
*/
function prime_playschool_classes_category_list(){
    // Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'prime-playschool-classes' ) );
		if ( $categories_list && prime_playschool_classes_categorized_blog() ) {
			echo '<span class="category">' . $categories_list . '</span>';
		}
	}
}
endif;

// Custom meta fields
function prime_playschool_classes_custom_goal_raised() {
  add_meta_box( 'bn_meta', __( 'Kindergartan Meta Feilds', 'prime-playschool-classes' ), 'prime_playschool_classes_meta_goal_raised_callback', 'post', 'normal', 'high' );
}
if (is_admin()){
  add_action('admin_menu', 'prime_playschool_classes_custom_goal_raised');
}

function prime_playschool_classes_meta_goal_raised_callback( $post ) {
  wp_nonce_field( basename( __FILE__ ), 'prime_playschool_classes_goal_raised_meta' );
  $bn_stored_meta = get_post_meta( $post->ID );
  $prime_playschool_classes_age = get_post_meta( $post->ID, 'prime_playschool_classes_age', true );
  $prime_playschool_classes_size = get_post_meta( $post->ID, 'prime_playschool_classes_size', true );
  $prime_playschool_classes_price = get_post_meta( $post->ID, 'prime_playschool_classes_price', true );
  ?>
  <div id="custom_meta_feilds">
    <table id="list">
      <tbody id="the-list" data-wp-lists="list:meta">
        <tr id="meta-8">
          <td class="left">
            <?php esc_html_e( 'Age', 'prime-playschool-classes' )?>
          </td>
          <td class="left">
            <input type="text" name="prime_playschool_classes_age" id="prime_playschool_classes_age" value="<?php echo esc_attr($prime_playschool_classes_age); ?>" />
          </td>
        </tr>
        <tr id="meta-8">
          <td class="left">
            <?php esc_html_e( 'Size', 'prime-playschool-classes' )?>
          </td>
          <td class="left">
            <input type="text" name="prime_playschool_classes_size" id="prime_playschool_classes_size" value="<?php echo esc_attr($prime_playschool_classes_size); ?>" />
          </td>
        </tr>
        <tr id="meta-8">
          <td class="left">
            <?php esc_html_e( 'Price', 'prime-playschool-classes' )?>
          </td>
          <td class="left">
            <input type="text" name="prime_playschool_classes_price" id="prime_playschool_classes_price" value="<?php echo esc_attr($prime_playschool_classes_price); ?>" />
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <?php
}

function prime_playschool_classes_save( $post_id ) {
  if (!isset($_POST['prime_playschool_classes_goal_raised_meta']) || !wp_verify_nonce( strip_tags( wp_unslash( $_POST['prime_playschool_classes_goal_raised_meta']) ), basename(__FILE__))) {
      return;
  }

  if (!current_user_can('edit_post', $post_id)) {
    return;
  }
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return;
  }

  if( isset( $_POST[ 'prime_playschool_classes_age' ] ) ) {
    update_post_meta( $post_id, 'prime_playschool_classes_age', strip_tags( wp_unslash( $_POST[ 'prime_playschool_classes_age' ]) ) );
  }
  if( isset( $_POST[ 'prime_playschool_classes_size' ] ) ) {
    update_post_meta( $post_id, 'prime_playschool_classes_size', strip_tags( wp_unslash( $_POST[ 'prime_playschool_classes_size' ]) ) );
  }
  if( isset( $_POST[ 'prime_playschool_classes_price' ] ) ) {
    update_post_meta( $post_id, 'prime_playschool_classes_price', strip_tags( wp_unslash( $_POST[ 'prime_playschool_classes_price' ]) ) );
  }
}
add_action( 'save_post', 'prime_playschool_classes_save' );