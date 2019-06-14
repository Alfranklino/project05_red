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
		<section class="thePost">
			<h2 class="postContent"></h2>
			<p class="postAuthor"></p>
			<section class="postCategories"></section>
		</section>
	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>