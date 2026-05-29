<?php

/**
 * Compatibility patch for Storefront theme 
 */

add_action('plugins_loaded', function()
{
	global $wpfts_core;

	if ($wpfts_core && is_object($wpfts_core)) {
		// Okay
	} else {
		return;
	}
 
	if (!function_exists('storefront_post_content')) {

		function storefront_post_content()
		{
			global $wp_query;
	
			?>
			<div class="entry-content">
			<?php
	
			/**
			 * Functions hooked in to storefront_post_content_before action.
			 *
			 * @hooked storefront_post_thumbnail - 10
			 */
			do_action( 'storefront_post_content_before' );
	
			if ($wp_query && $wp_query->is_main_query() && $wp_query->is_search) {
				// We are using the_excerpt() for search result always!
				the_excerpt();
			} else {
				// We are using old method for all other pages
				the_content(
					sprintf(
						__( 'Continue reading %s', 'storefront' ),
						'<span class="screen-reader-text">' . get_the_title() . '</span>'
					)
				);
			}
	
			do_action( 'storefront_post_content_after' );
	
			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'storefront' ),
					'after'  => '</div>',
				)
			);
			?>
			</div><!-- .entry-content -->
			<?php	
		}
	
	}
	 
	global $wpfts_compat_installed;
	  
	$wpfts_compat_installed = 1; 
}, -10000);
  
