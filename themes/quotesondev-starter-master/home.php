<?php
/**
 * The main template file.
 *
 * @package QOD_Starter_Theme
 */

get_header(); ?>

<div id="primary" class="content-area">
	<section class="quote-left">
		<i class="fas fa-quote-left"></i>
	</section>

	<main id="main" class="site-main" role="main">

		<section class="thePost">
			<h2 class="postContent"></h2>
			<p class="postAuthor"></p>
			<section class="postCategories"></section>
		</section>
		<button class="my_btn">Show Me Another!</button>
	</main><!-- #main -->

	<section class="quote-right">
		<i class="fas fa-quote-right"></i>
	</section>
</div><!-- #primary -->

<?php get_footer(); ?>