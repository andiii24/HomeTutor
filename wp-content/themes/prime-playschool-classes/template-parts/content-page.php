<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package prime_playschool_classes
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<div class="post-thumbnail">
 		 <?php the_post_thumbnail(); ?>
    	</div>
		<?php

			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'prime-playschool-classes' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
