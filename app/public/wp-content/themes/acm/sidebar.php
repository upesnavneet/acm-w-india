<?php
/**
 * The template for the sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage ACM
 * @since ACM 1.0
 */
?>

<aside id="secondary" class="columns large-4 medium-4 small-12 reveal-on-scroll reveal-delay-2" role="complementary">

		<!-- Search Widget -->
		<div class="widget widget_search" style="margin-bottom: 2.5rem;">
			<?php get_search_form(); ?>
		</div>

		<!-- LinkedIn Feed Widget -->
		<div class="widget linkedin-feed-widget" style="margin-bottom: 2.5rem;">
			<h3 class="widget-title"
				style="font-family: 'Roboto Condensed', Helvetica, Roboto, Arial, sans-serif; font-size: 20px; font-weight: 700; letter-spacing: 0; color: #0f172a; border-bottom: 2px solid #00b4d8; padding-bottom: 0.5rem; margin-bottom: 1rem;">
				Recent Updates</h3>

			<div class="linkedin-feed-scroll"
				style="max-height: 600px; overflow-y: auto; border-radius: 12px; scrollbar-width: thin; scrollbar-color: #00b4d8 #f1f5f9; position: relative;">
				
				<iframe src="https://www.linkedin.com/embed/feed/update/urn:li:share:7463776506826108928?collapsed=1" frameborder="0" allowfullscreen="" title="Embedded post" style="width: 100%; max-width: 504px; height: 669px; display: block; margin: 0 auto 1rem auto; border: none; border-radius: 8px; background: #f8fafc;"></iframe>

				<iframe src="https://www.linkedin.com/embed/feed/update/urn:li:share:7463451893990600705?collapsed=1" frameborder="0" allowfullscreen="" title="Embedded post" style="width: 100%; max-width: 504px; height: 669px; display: block; margin: 0 auto 1rem auto; border: none; border-radius: 8px; background: #f8fafc;"></iframe>

				<iframe src="https://www.linkedin.com/embed/feed/update/urn:li:share:7462452276243218433?collapsed=1" frameborder="0" allowfullscreen="" title="Embedded post" style="width: 100%; max-width: 504px; height: 669px; display: block; margin: 0 auto 1rem auto; border: none; border-radius: 8px; background: #f8fafc;"></iframe>

				<iframe src="https://www.linkedin.com/embed/feed/update/urn:li:share:7461777667067973632?collapsed=1" frameborder="0" allowfullscreen="" title="Embedded post" style="width: 100%; max-width: 504px; height: 669px; display: block; margin: 0 auto 1rem auto; border: none; border-radius: 8px; background: #f8fafc;"></iframe>

				<iframe src="https://www.linkedin.com/embed/feed/update/urn:li:share:7461019607055646720?collapsed=1" frameborder="0" allowfullscreen="" title="Embedded post" style="width: 100%; max-width: 504px; height: 669px; display: block; margin: 0 auto 0 auto; border: none; border-radius: 8px; background: #f8fafc;"></iframe>

			</div>
		</div>

		<!-- Newsletter Subscription Panel -->
		<div class="widget newsletter-widget"
			style="margin-bottom: 2rem; background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 1.5rem; text-align: center; color: #0f172a; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
			<div
				style="width: 48px; height: 48px; background-color: #eff6ff; color: #3b82f6; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
					stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
					<path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
					<polyline points="22,6 12,13 2,6"></polyline>
				</svg>
			</div>
			<h4
				style="font-family: 'Roboto Condensed', Helvetica, Roboto, Arial, sans-serif; font-size: 20px; font-weight: 700; color: #0f172a; margin-bottom: 0.75rem;">
				Stay Connected</h4>
			<p style="font-size: 0.85rem; line-height: 1.5; color: #334155; margin-bottom: 1.25rem;">
				Subscribe to the ACM-W Connection newsletter to receive the latest updates, event announcements, and more.
			</p>
			<a href="https://women.acm.org/contact/" target="_blank" rel="noopener noreferrer"
				style="display: inline-block; background-color: #0f172a; color: #fff; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; padding: 0.75rem 1.5rem; border-radius: 6px; text-decoration: none; transition: background-color 0.2s;">
				Subscribe Now
			</a>
		</div>

	</aside><!-- .sidebar .widget-area -->