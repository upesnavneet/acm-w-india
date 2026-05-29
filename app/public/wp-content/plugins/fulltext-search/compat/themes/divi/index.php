<?php

/**
 * Compatibility patch for Divi theme 
 */

add_action('init', function()
{
	global $wpfts_core;

	if ($wpfts_core && is_object($wpfts_core)) {
		// Okay
	} else {
		return;
	}
	
	// Sorry, Divi developers, this functionality is not compatible with WPFTS. Let me know if I can 
	// fix this using better way.
	remove_action( 'pre_get_posts', 'et_pb_custom_search');
}); 

add_action('plugins_loaded', function()
{
	global $wpfts_core;
 
	if ($wpfts_core && is_object($wpfts_core)) {
		// Okay
	} else {
		return;
	}

	// Sorry, Divi developers, this functionality is not compatible with WPFTS. Let me know if I can 
	// fix this by different way.
	remove_action( 'pre_get_posts', 'et_pb_custom_search');

	if (!function_exists('truncate_post')) {
		// This function is a replacement for original "Divi Theme's" function that is created excerpts by its own method
		// Credits to: Divi theme authors

		/**
		 * Truncate post content to generate post excerpt.
		 *
		 * @since ?? Add new paramter $is_words_length to cut the text based on words length.
		 *
		 * @param integer $amount           Amount of text that should be kept.
		 * @param boolean $echo             Whether to print the output or not.
		 * @param object  $post             Post object.
		 * @param boolean $strip_shortcodes Whether to strip the shortcodes or not.
		 * @param boolean $is_words_length  Whether to cut the text based on words length or not.
		 *
		 * @return string Generated post post excerpt.
		 */
		function truncate_post( $amount, $echo = true, $post = '', $strip_shortcodes = false, $is_words_length = false ) {
			global $shortname;
	
			if (empty($post)) {
				global $post;
			}
	
			if ( post_password_required($post)) {
				$post_excerpt = get_the_password_form();
	
				if ( $echo ) {
					echo et_core_intentionally_unescaped( $post_excerpt, 'html' );
					return;
				}
	
				return $post_excerpt;
			}

			ob_start();
			the_excerpt();
			$post_excerpt = ob_get_clean();

			if ( $echo ) {
				echo et_core_intentionally_unescaped( $post_excerpt, 'html' );
			} else {
				return $post_excerpt;
			}		

			// The block below is intentionally commented out, since WPFTS Smart Excerpt will be used for any post truncation

			/*
			if ('on' === et_get_option($shortname . '_use_excerpt')) {
				if ( $echo ) {
					echo et_core_intentionally_unescaped( $post_excerpt, 'html' );
				} else {
					return $post_excerpt;
				}				
			} else {
				// get the post content
				$truncate = $post->post_content;
	
				// remove caption shortcode from the post content
				$truncate = preg_replace( '@\[caption[^\]]*?\].*?\[\/caption]@si', '', $truncate );
	
				// remove post nav shortcode from the post content
				$truncate = preg_replace( '@\[et_pb_post_nav[^\]]*?\].*?\[\/et_pb_post_nav]@si', '', $truncate );
	
				// Remove audio shortcode from post content to prevent unwanted audio file on the excerpt
				// due to unparsed audio shortcode
				$truncate = preg_replace( '@\[audio[^\]]*?\].*?\[\/audio]@si', '', $truncate );
	
				// Remove embed shortcode from post content
				$truncate = preg_replace( '@\[embed[^\]]*?\].*?\[\/embed]@si', '', $truncate );
	
				// Remove script and style tags from the post content
				$truncate = wp_strip_all_tags( $truncate );
	
				if ( $strip_shortcodes ) {
					$truncate = et_strip_shortcodes( $truncate );
					$truncate = et_builder_strip_dynamic_content( $truncate );
				} else {
					// Check if content should be overridden with a custom value.
					$custom = apply_filters( 'et_truncate_post_use_custom_content', false, $truncate, $post );
					// apply content filters
					$truncate = false === $custom ? apply_filters( 'the_content', $truncate ) : $custom;
				}
	
				// **
				// * Filter automatically generated post excerpt before it gets truncated.
				// *
				// * @since 3.17.2
				// *
				// * @param string $excerpt
				// * @param integer $post_id
				// * /
				$truncate = apply_filters( 'et_truncate_post', $truncate, $post->ID );
	
				// decide if we need to append dots at the end of the string
				if ( strlen( $truncate ) <= $amount ) {
					$echo_out = '';
				} else {
					$echo_out = '...';
					// $amount = $amount - 3;
				}
	
				$trim_words = '';
	
				if ( $is_words_length ) {
					// Reset `$echo_out` text because it will be added by wp_trim_words() with
					// default WordPress `excerpt_more` text.
					$echo_out     = '';
					$excerpt_more = apply_filters( 'excerpt_more', ' [&hellip;]' );
					$trim_words   = wp_trim_words( $truncate, $amount, $excerpt_more );
				} else {
					$trim_words = et_wp_trim_words( $truncate, $amount, '' );
				}
	
				// trim text to a certain number of characters, also remove spaces from the end of a string ( space counts as a character ).
				$truncate = rtrim( $trim_words );
	
				// remove the last word to make sure we display all words correctly
				if ( ! empty( $echo_out ) ) {
					$new_words_array = (array) explode( ' ', $truncate );
					// Remove last word if word count is more than 1.
					if ( count( $new_words_array ) > 1 ) {
						array_pop( $new_words_array );
					}
	
					$truncate = implode( ' ', $new_words_array );
	
					// Dots should not add to empty string
					if ( '' !== $truncate ) {
						// append dots to the end of the string
						$truncate .= $echo_out;
					}
				}
	
				if ( $echo ) {
					echo et_core_intentionally_unescaped( $truncate, 'html' );
				} else {
					return $truncate;
				}
			};
			*/
		}

		global $wpfts_compat_installed;

		$wpfts_compat_installed = 1;
	
	} else {
		// Unable to install hook, because truncate_post() function was initialized earlier
	}
}, -10000);