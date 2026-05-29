<?php

/**
 * Compatibility patch for Scientia theme 
 */

add_action('plugins_loaded', function () {
	global $wpfts_core;

	if ($wpfts_core && is_object($wpfts_core)) {
		// Okay
	} else {
		return;
	}

	if (!function_exists('scientia_excerpt')) {
		function scientia_excerpt($str, $maxlength, $add = '&hellip;')
		{
			ob_start();
			the_excerpt();
			return ob_get_clean();
		}
	}	

	global $wpfts_compat_installed;

	$wpfts_compat_installed = 1;
}, -10000);
