<?php
/**
 * The main template file.
 *
 * @package QOD_Starter_Theme
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<button class="my_btn">Click on me</button>
		<?php if (have_posts()) : ?>

			<?php $args = array(
				'posts_per_page' => '1',
				'orderby'		=>	'rand',
			);	?>
			<?php $the_query = new WP_Query($args); ?>

			<?php /* Start the Loop */ ?>
			
			<article>
				<?php echo '<section class="post_content">';
				while ($the_query->have_posts()) {
					$the_query->the_post();
					echo the_content();
					echo '</section>';
					echo '<h5 class="author">';
					echo get_the_author();
					echo '</h5>';
				} ?>

				<?php wp_reset_postdata(); ?>
			</article>


		<?php endif; ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>