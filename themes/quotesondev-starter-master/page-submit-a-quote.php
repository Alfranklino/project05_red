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
		<h2>Submit a Quote</h2>
		<?php if (current_user_can('administrator')) : ?>
			<form name="post-form" class="post-form">
				<label for="author">Author of Quote</label>
				<input type="text" name="author" class="authorText">

				<label for="quote">Quote</label>
				<textarea name="quote" class="quoteTextarea"></textarea>

				<label for="findQuoteText">Where did you find this quote? (e.g. book name)</label>
				<input type="text" name="find-quote" class="findQuoteText">

				<label for="provideUrl">Provide the URL of the quote source, if available.</label>
				<input type="text" name="provide-url" class="provideUrl">

				<input type="submit" name="submit" value="Submit" class="submitPostBtn">
			</form>
		<?php else :
		echo ("<p>Sorry, you must be logged in to submit a quote!</p> <p><a href=");
		echo esc_url( wp_login_url() ); 
		echo(">Click here to login.</a></p>");

	endif ?>

	</main><!-- #main -->

	<section class="quote-right">
		<i class="fas fa-quote-right"></i>
	</section>
</div><!-- #primary -->

<?php get_footer(); ?>