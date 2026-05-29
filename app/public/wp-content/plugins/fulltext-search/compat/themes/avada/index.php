<?php

/**
 * Compatibility patch for Avada theme and Fusion builder (the part of the Avada theme)
 */

add_action('plugins_loaded', function()
{
	global $wpfts_core;

	if ($wpfts_core && is_object($wpfts_core)) {
		// Okay
	} else {
		return;
	}

	if (!function_exists('fusion_builder_get_post_content_excerpt')) {
		// This function is a replacement for original "Fusion Builder's" function that is created excerpts by its own method
		// Credits to: Avada theme authors

		/**
		 * Do the actual custom excerpting for of post/page content.
		 *
		 * @param  string  $limit      Maximum number of words or chars to be displayed in excerpt.
		 * @param  boolean $strip_html Set to TRUE to strip HTML tags from excerpt.
		 * @return string               The custom excerpt.
		 **/
		function fusion_builder_get_post_content_excerpt($limit = 285, $strip_html = false)
		{
			// Init variables, cast to correct types.
			$content        = '';
			$limit          = intval( $limit );
		
			// If excerpt length is set to 0, return empty.
			if ( 0 === $limit ) {
				return $content;
			}

			ob_start();
			the_excerpt();	// This will trigger WPFTS Smart Excerpts to show
			$content = ob_get_clean();

			return $content;
		} 

		global $wpfts_compat_installed;

		$wpfts_compat_installed = 1;

	} else {
		// Unable to redefine Fusion Builder's function...
	}
}, -10000);

/*
// This code works for older version of Avada Theme (before 7.0)
// To activate this code, please put it to the top of functions.php of the Avada Theme
// Refer here: https://fulltextsearch.org/forum/topic/11/solved-avada-theme-excerpt-do-not-show

function fusion_get_post_content_excerpt( $limit = 285, $strip_html, $page_id = '' ) {
	ob_start();
	the_excerpt();
	return ob_get_clean();
}
*/

add_action('init', function()
{
	// Sorry, this hook makes wrong output (from the WPFTS's point of view :)
	remove_action( 'avada_blog_post_content', 'avada_render_search_post_content', 10 ); 

	// This is the correct function
	add_action( 'avada_blog_post_content', function()
	{
		if (is_search()) {
			the_excerpt();
		}
	}, 20 ); 

}, 10010);
