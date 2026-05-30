<?php
/**
 * The template for the sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage ACM
 * @since ACM 1.0
 */
?>

<?php
if ( is_active_sidebar( 'content_right' ) ) :
	?>
<aside id="secondary" class="columns large-3 medium-3 small-12 reveal-on-scroll reveal-delay-2" role="complementary">
	
	<!-- LinkedIn Feed Widget (Automatically styled with glassmorphism) -->
	<div class="widget linkedin-feed-widget" style="margin-bottom: 2rem;">
		<h3 class="widget-title" style="font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; font-size: 1.2rem; color: #003049; border-bottom: 2px solid #b9dfe9; padding-bottom: 0.5rem; margin-bottom: 1rem;">Recent Updates</h3>
		
		<!-- ========================================================================= -->
		<!-- INSERT LINKEDIN EMBED SCRIPT OR WORDPRESS SHORTCODE DIRECTLY BELOW HERE   -->
		<!-- ========================================================================= -->
		
		<p style="font-size: 0.85rem; color: #666; font-style: italic;">
			[Your dynamic LinkedIn feed will appear here. Paste the script or shortcode in sidebar.php]
		</p>
		
		<!-- ========================================================================= -->
	</div>

	<?php dynamic_sidebar( 'content_right' ); ?>
</aside><!-- .sidebar .widget-area -->
<?php endif; ?>
