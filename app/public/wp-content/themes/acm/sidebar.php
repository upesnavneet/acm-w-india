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
<aside id="secondary" class="columns large-4 medium-4 small-12 reveal-on-scroll reveal-delay-2" role="complementary">
	
	<!-- Social Feed Widget (Automatically styled with glassmorphism) -->
	<div class="widget linkedin-feed-widget" style="margin-bottom: 2rem;">
		<h3 class="widget-title" style="font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; font-size: 1.2rem; color: #003049; border-bottom: 2px solid #b9dfe9; padding-bottom: 0.5rem; margin-bottom: 1rem;">Recent Updates</h3>
		
		<!-- ========================================================================= -->
		<div class="tagembed-widget" style="width:100%;height:600px;overflow:auto;" data-widget-id="326992" data-website="1"></div>
		<script src="https://widget.tagembed.com/embed.min.js" type="text/javascript"></script>
		<!-- ========================================================================= -->
	</div>

	<?php dynamic_sidebar( 'content_right' ); ?>
</aside><!-- .sidebar .widget-area -->
<?php endif; ?>
