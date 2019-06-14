<?php
/**
 * Quotes on Dev Theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package QOD_Starter_Theme
 */

if (!function_exists('qod_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 */
	function qod_setup()
	{
		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		// Let WordPress manage the document title.
		add_theme_support('title-tag');

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(array(
			'primary' => esc_html('Primary Menu'),
		));

		// Switch search form, comment form, and comments to output valid HTML5.
		add_theme_support('html5', array('search-form'));
	}
endif; // qod_setup
add_action('after_setup_theme', 'qod_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * @global int $content_width
 */
function qod_content_width()
{
	$GLOBALS['content_width'] = apply_filters('qod_content_width', 640);
}
add_action('after_setup_theme', 'qod_content_width', 0);

/**
 * Filter the stylesheet_uri to output the minified CSS file.
 */
function qod_minified_css($stylesheet_uri, $stylesheet_dir_uri)
{
	if (file_exists(get_template_directory() . '/build/css/style.min.css')) {
		$stylesheet_uri = $stylesheet_dir_uri . '/build/css/style.min.css';
	}

	return $stylesheet_uri;
}
add_filter('stylesheet_uri', 'qod_minified_css', 10, 2);

/**
 * Enqueue scripts and styles.
 */
function qod_scripts()
{
	wp_enqueue_style('qod-style', get_stylesheet_uri());

	wp_enqueue_script('qod-starter-navigation', get_template_directory_uri() . '/build/js/navigation.min.js', array(), '20151215', true);
	wp_enqueue_script('qod-starter-skip-link-focus-fix', get_template_directory_uri() . '/build/js/skip-link-focus-fix.min.js', array(), '20151215', true);
}
add_action('wp_enqueue_scripts', 'qod_scripts');

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom metaboxes generated using the CMB2 library.
 */
require get_template_directory() . '/inc/metaboxes.php';

/**
 * Custom WP API modifications.
 */
require get_template_directory() . '/inc/api.php';





add_action('rest_api_init', function () {
	register_rest_route('api', '/any', array(
		'methods'   =>  'GET',
		'callback'  =>  'get_random',
	));
});
function get_random()
{
	return get_posts(array('orderby' => 'rand', 'posts_per_page' => 1));
}


function get_all_posts($data, $post, $context)
{
	// return [
	//     'id'        => $data->data['id'],
	//     'date'      => $data->data['date'],
	//     'date_gmt'  => $data->data['date_gmt'],
	//     'modified'  => $data->data['modified'],
	//     'title'     => $data->data['title']['rendered'],
	//     'content'   => $data->data['content']['rendered'],
	//     'excerpt'   => $data->data['excerpt']['rendered'],
	//     'category'  => get_the_category_by_ID( $data->data['categories'][0] ),
	//     'link'      => $data->data['link'],


	// ];
	$_data = $data->data;
	$category = get_the_category($post->ID);
	// $cat_id = $category[0]->cat_ID;
	// $category_link = get_category_link($cat_id);
	$cat_id = [];
	$category_link = [];

	for ($i = 0; $i <= count($category) - 1; $i++) {
		$cat_idx = $category[$i]->cat_ID;
		$category_linkx = get_category_link($cat_idx);

		array_push($cat_id, $cat_idx);
		array_push($category_link, $category_linkx);
	}


	$_data['category'] = $category;
	$_data['category_link'] = $category_link;
	$_data['cat_id'] = $cat_id;
	$data->data = $_data;

	return $data;
}
add_filter('rest_prepare_post', 'get_all_posts', 10, 3);




function red_scripts()
{
	$script_url = get_template_directory_uri() . '/build/js/api.min.js';
	wp_enqueue_script('jquery');
	wp_enqueue_script('red_comments', $script_url, array('jquery'), false, true);
	wp_localize_script('red_comments', 'red_vars', array(
		'rest_url' => esc_url_raw(rest_url()),
		'wpapi_nonce' => wp_create_nonce('wp_rest'),
		'post_id' => get_the_ID()
	));
}
add_action('wp_enqueue_scripts', 'red_scripts');
