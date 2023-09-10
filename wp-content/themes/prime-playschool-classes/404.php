<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package prime_playschool_classes
 */

get_header(); ?>
	<main id="main" class="site-main" role="main">
		<div class="error-holder">
			<h1><?php esc_html_e( '404', 'prime-playschool-classes' ); ?></h1>
			<h2><?php esc_html_e( 'Sorry, that page can\'t be found!', 'prime-playschool-classes' ); ?></h2>
			<p class="btn-green mt-3 mb-0">
          		<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Homepage', 'prime-playschool-classes' ); ?></a>
            </p>
        </div>
	</main>
	<?php
get_footer();