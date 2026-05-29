<?php

/**
 * Compatibility patch for OceanWP theme 
 */

add_action('init', function()
{
	global $wpfts_core;
 
	if ($wpfts_core && is_object($wpfts_core)) {
		// Okay
	} else {
		return;
	}
	
	function wpfts_addon_oceanwp_trim($text, $num_words, $more, $original_text)
	{
		global $wpfts_core;
		
		$out = $text;
	
		if ($wpfts_core && is_a($wpfts_core, 'WPFTS_Core')) {
			$is_smart_excerpts = intval($wpfts_core->get_option('is_smart_excerpts'));
			if ($is_smart_excerpts != 0) {
				$post = get_post();
				if (is_search() && in_the_loop()) {
					$ri = new WPFTS_Result_Item(0, $post);
					$query = get_search_query(false);
					$out = '<div class="wpfts-result-item">'.$ri->Excerpt($query).'</div>';
					return $out;
				} elseif ($wpfts_core->forced_se_query !== false) {
					$ri = new WPFTS_Result_Item(0, $post);
					$query = $wpfts_core->forced_se_query;
					$out = '<div class="wpfts-result-item">'.$ri->Excerpt($query).'</div>';
					return $out;
				} else {
					// Leave excerpt unchanged
				}
			}
		}
	
		return $out;
	}
	
	add_action('ocean_before_content_inner', function()
	{
		// Enable our hooks
		add_filter('wp_trim_words', 'wpfts_addon_oceanwp_trim', 10, 4);
	});
	
	add_action('ocean_after_content_inner', function()
	{
		// Disable our hooks
		remove_filter('wp_trim_words', 'wpfts_addon_oceanwp_trim');
	});
	
	global $wpfts_compat_installed;
	
	$wpfts_compat_installed = 1;
	
}, 10);

