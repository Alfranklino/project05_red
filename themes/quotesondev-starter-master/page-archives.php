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


		<section class="archivesSection">
			<section class="authorsSection">
				<h3>Quote Authors</h3>
				<section class="authorsList">

				</section>
			</section>
			<!-- End authors -->
			<section class="categoriesSection">
				<h3>Categories</h3>
				<section class="catgList">

				</section>
			</section>
			<!-- End categories -->
			<section class="tagsSection">
				<h3>Tags</h3>
				<section class="tagsList">

				</section>
			</section>
			<!-- End tags -->
		</section>
	</main><!-- #main -->

	<section class="quote-right">
		<i class="fas fa-quote-right"></i>
	</section>
</div><!-- #primary -->

<?php get_footer(); ?>