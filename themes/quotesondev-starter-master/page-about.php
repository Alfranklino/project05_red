<?php
/**
 * The template for displaying all pages.
 *
 * @package QOD_Starter_Theme
 */

get_header(); ?>

<div id="primary" class="content-area">

	<section class="quote-left">
		<i class="fas fa-quote-left"></i>
	</section>

	<main id="main" class="site-main" role="main">
		<?php while (have_posts()) : the_post(); ?>

			<?php get_template_part('template-parts/content', 'page'); ?>

		<?php endwhile; 
	?>


	</main><!-- #main -->

	<section class="quote-right">
		<i class="fas fa-quote-right"></i>
	</section>
</div><!-- #primary -->

<?php get_footer(); ?>