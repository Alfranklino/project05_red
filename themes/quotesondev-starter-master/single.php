<?php
/**
 * The template for displaying all single posts.
 *
 * @package QOD_Starter_Theme
 */

get_header(); ?>

	<div id="primary" class="content-area">
	<section class="quote-left">
		<i class="fas fa-quote-left"></i>
	</section>
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/content', 'single' ); ?>

			<?php the_post_navigation(); ?>

		<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
		<section class="quote-right">
		<i class="fas fa-quote-right"></i>
	</section>
	</div><!-- #primary -->

<?php get_footer(); ?>
