<?php
/**
 * The template for displaying the footer.
 *
 * @package QOD_Starter_Theme
 */

?>

</div><!-- #content -->

<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="site-info">

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php echo esc_html('Primary Menu'); ?></button>
			<?php wp_nav_menu(array('theme_location' => 'primary', 'menu_id' => 'primary-menu')); ?>
		</nav><!-- #site-navigation -->

		<section class="broughtToYou">
			<span>Brought to you by</span><span> <a href="<?php echo esc_url('www.linkedin.com/in/albert-franklin-mamvoula-nguiamba-a11202106/'); ?> class='link_brought'">Alfranklino</a></span>
		</section>

	</div><!-- .site-info -->
</footer><!-- #colophon -->
</div><!-- #page -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<?php wp_footer(); ?>

</body>

</html>