<?php

/**
 * Compatibility patch for Sinatra theme 
 */

add_action('plugins_loaded', function()
{
	global $wpfts_core;
  
	if ($wpfts_core && is_object($wpfts_core)) {
		// Okay
	} else {
		return;
	}

	if (!function_exists( 'sinatra_excerpt')) {
		/**
		 * Get excerpt.
		 *
		 * @since 1.0.0
		 * @param int    $length the length of the excerpt.
		 * @param string $more What to append if $text needs to be trimmed.
		 */
		function sinatra_excerpt($length = null, $more = null)
		{
			//ob_start();
			the_excerpt();
			//echo ob_get_clean();
		}
	}
	
	global $wpfts_compat_installed;
	 
	$wpfts_compat_installed = 1; 
}, -10000);
 
 