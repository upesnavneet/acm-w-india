<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage ACM
 * @since ACM 1.0
 */
get_header();
?>

<?php
// Use banner.png from theme img folder as the default banner image.
$banner_image = get_template_directory_uri() . '/img/banner.png';
$geetangali_kale = get_template_directory_uri() . '/img/executives/geetanjali-kale.jpg';
$theme_banner = get_theme_mod('banner_bgimage', '');
if (!empty($theme_banner)) {
	$banner_image = $theme_banner;
}
$banner_top_title = get_theme_mod('banner_top_title', '');
$banner_title = get_theme_mod('banner_title', '');
$banner_desc = get_theme_mod('banner_description', '');
$has_text_overlay = (!empty($banner_top_title) || !empty($banner_title) || !empty($banner_desc));
?>
<div class="banner-container">
	<section class="acm-banner-container"
		style="background-image: url('<?php echo esc_url($banner_image); ?>'); background-size: cover; background-position: center;">
		<?php if ($has_text_overlay): ?>
			<div class="gradient-wrapper"></div>
			<div class="overlay"></div>
			<div class="row">
				<div class="columns large-12 medium-12 banner-content">
					<p class="banner-heading">
						<small><?php echo esc_html($banner_top_title); ?></small>
						<?php echo esc_html($banner_title); ?>
					</p>
					<p><?php echo esc_html($banner_desc); ?></p>
				</div>
			</div>
		<?php endif; ?>
	</section>
</div>

<div class="row breadcrumb-container">
	<div class="columns small-12">
		<ul class="breadcrumbs">
			<?php ACMUtils::the_breadcrumb(); ?>
		</ul>
	</div>
</div>

<?php
if (have_posts()):
	if (is_home() && !is_front_page()):
		?>
		<header>
			<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
		</header>
		<?php
	endif;
endif;
?>

<div class="article" id="maincontent">
	<article class="has-edit-button" id="SkipTarget" tabindex="-1">
		<div class="row">
			<div class="columns large-8 medium-8 small-12 zone-1">
				<!-- Mission Statement (Plain Text) -->
				<div class="intro-section"
					style="margin-bottom: 3rem; color: #333333; font-family: Roboto, sans-serif;">
					<h2
						style="text-align: left; font-weight: 700; font-size: 24px; margin-top: 1rem; margin-bottom: 1.5rem; color: #1e293b; font-family: 'Roboto Condensed', Helvetica, Roboto, Arial, sans-serif;">
						About ACM-W India
					</h2>
					<p style="font-size: 0.875rem; line-height: 1.6; margin-bottom: 1.25rem;">
						ACM-W India drives the advancement of women across all aspects of computing. From research and
						academia to industry and innovation. As a standing committee of ACM India, we create tangible
						opportunities through mentorship programmes, skill-building events, professional chapters, and
						national recognition platforms that celebrate the work of technical women.
					</p>
					<p style="font-size: 0.875rem; line-height: 1.6; margin-bottom: 2.5rem;">
						ACM Women India (ACM-W India) is a standing committee of <a href="#"
							style="color: #0077b6; text-decoration: none;">ACM India <svg
								xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"
								fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
								stroke-linejoin="round" style="display:inline; margin-bottom:2px;">
								<path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
								<polyline points="15 3 21 3 21 9"></polyline>
								<line x1="10" y1="14" x2="21" y2="3"></line>
							</svg></a> and works to fulfill the <a href="#"
							style="color: #0077b6; text-decoration: none;">ACM-W <svg xmlns="http://www.w3.org/2000/svg"
								width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
								stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
								style="display:inline; margin-bottom:2px;">
								<path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
								<polyline points="15 3 21 3 21 9"></polyline>
								<line x1="10" y1="14" x2="21" y2="3"></line>
							</svg></a> mission in India.
					</p>
				</div>

				<!-- Welcome from the Chair Section -->
				<div
					style="margin-bottom: 3.5rem; padding-top: 2rem; border-top: 1px solid #e2e8f0; color: #333333; font-family: Roboto, sans-serif;">
					<h3
						style="text-align: left; font-family: 'Roboto Condensed', Helvetica, Roboto, Arial, sans-serif; color: #0f172a; font-weight: 700; margin-bottom: 1.5rem; font-size: 24px; letter-spacing: 0;">
						Welcome from the ACM-W India Chair
					</h3>

					<div class="row" style="margin-left: 0; margin-right: 0;">
						<div class="large-4 medium-4 small-12 columns"
							style="padding-left: 0; padding-right: 1.5rem; margin-bottom: 1.5rem;">
							<img src="<?php echo esc_url($geetangali_kale); ?>"
								alt="Dr. Geetanjali Kale, ACM-W India Chair"
								style="width: 100%; max-width: 320px; height: auto; border-radius: 8px; object-fit: cover; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08); border: 1px solid #e2e8f0; display: block; margin-bottom: 1rem;" />
							<p
								style="font-weight: 700; font-size: 0.95rem; color: #0f172a; margin-bottom: 0.25rem; font-family: 'Roboto Condensed', Helvetica, Roboto, Arial, sans-serif; line-height: 1.2;">
								Dr. Geetanjali Kale
							</p>
							<p
								style="font-size: 0.8rem; color: #64748b; margin-bottom: 0; font-family: Roboto, sans-serif; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">
								Chair, ACM-W India
							</p>
							<p style="font-size: 0.85rem; color: #94a3b8; margin-top: 0.15rem; margin-bottom: 0;">
								(2024 – Present)
							</p>
						</div>

						<div class="large-8 medium-8 small-12 columns" style="padding-left: 0; padding-right: 0;">
							<p style="font-size: 0.9rem; line-height: 1.7; color: #334155; margin-bottom: 1.25rem;">
								At ACM-W India, we believe that the full participation of women in computing is not just
								an aspiration. It is a necessity. Our initiatives span grassroots student chapters and
								high-impact national conferences, all driven by the conviction that diverse teams build
								stronger technology and a more equitable world for everyone.
							</p>
							<p style="font-size: 0.9rem; line-height: 1.7; color: #334155; margin-bottom: 0;">
								We invite every woman in computing whether it is a student, researcher, or professional
								to engage with our community. Write to us at <a href="mailto:chair@india.acm.org"
									style="color: #0077b6; text-decoration: none; font-weight: 600;">chair@india.acm.org</a>.
							</p>
						</div>
					</div>
				</div>

				<!-- Join & Volunteer Sections -->
				<div
					style="margin-bottom: 3.5rem; padding-top: 2rem; border-top: 1px solid #e2e8f0; color: #333333; font-family: Roboto, sans-serif;">
					<div style="margin-bottom: 2.5rem;">
						<h3
							style="text-align: left; font-family: 'Roboto Condensed', Helvetica, Roboto, Arial, sans-serif; color: #0f172a; font-weight: 700; margin-bottom: 1.25rem; font-size: 24px; letter-spacing: 0;">
							Become Part of ACM-W
						</h3>
						<p style="font-size: 0.875rem; line-height: 1.7; color: #334155; margin-bottom: 0;">
							Are you interested in being part of an organization that supports and promote women in the
							field? When you join ACM, or renew your membership, check the box for ACM-W. You will be
							added to the ACM-W email list and receive announcements as well as our ACM-W Connection
							newsletter.
						</p>
					</div>
				</div>

				<!-- Mission, Vision & Values -->
				<div style="text-align: center; margin-bottom: 3rem;">
					<p
						style="text-transform: uppercase; color: #3b82f6; font-size: 0.85rem; font-weight: 700; letter-spacing: 1px; margin-bottom: 0.5rem; display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
						<span
							style="display: inline-block; width: 24px; height: 2px; background-color: #3b82f6;"></span>
						OUR FOUNDATION
					</p>
					<h2
						style="font-family: 'Roboto Condensed', Helvetica, Roboto, Arial, sans-serif; font-size: 30px; font-weight: 700; color: #0f172a; margin-top: 0; letter-spacing: 0;">
						Mission, Vision & <span style="font-style: italic; color: #3b82f6;">Values</span>
					</h2>
				</div>

				<div
					style="border-radius: 12px; overflow: hidden; margin-bottom: 4rem; box-shadow: 0 10px 30px rgba(0,0,0,0.1); font-family: 'Roboto', sans-serif;">
					<!-- Row 1: Mission -->
					<div style="display: flex; flex-wrap: wrap;">
						<div
							style="width: 220px; background-color: #14294c; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 2.5rem 1rem; color: #fff;">
							<div
								style="width: 52px; height: 52px; border-radius: 50%; border: 1px solid rgba(255,255,255,0.2); display: flex; align-items: center; justify-content: center; margin-bottom: 1.25rem; background-color: rgba(255,255,255,0.05);">
								<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"
									fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
									stroke-linejoin="round">
									<circle cx="12" cy="12" r="4" />
									<path d="M12 2v2" />
									<path d="M12 20v2" />
									<path d="m4.93 4.93 1.41 1.41" />
									<path d="m17.66 17.66 1.41 1.41" />
									<path d="M2 12h2" />
									<path d="M20 12h2" />
									<path d="m6.34 17.66-1.41 1.41" />
									<path d="m19.07 4.93-1.41 1.41" />
								</svg>
							</div>
							<span style="font-size: 0.8rem; font-weight: 700; letter-spacing: 1.5px;">MISSION</span>
						</div>
						<div
							style="flex: 1; background-color: #194a9b; padding: 2.5rem 3rem; color: #fff; min-width: 300px; display: flex; flex-direction: column; justify-content: center;">
							<div
								style="width: 30px; height: 2px; background-color: rgba(255,255,255,0.4); margin-bottom: 1rem;">
							</div>
							<h3
								style="color: #fff; font-size: 1.05rem; font-weight: 700; margin-top: 0; margin-bottom: 0.75rem; font-family: 'Roboto Condensed', Helvetica, Roboto, Arial, sans-serif;">
								Empowering Women in Computing</h3>
							<p
								style="color: rgba(255,255,255,0.9); font-size: 0.85rem; line-height: 1.6; margin-bottom: 0;">
								To take forward the ACM community goals with a particular focus on the empowerment of
								women in computing in India — facilitating technical growth, providing networking
								platforms, and supporting women in their professional career journey.
							</p>
						</div>
					</div>

					<!-- Row 2: Vision -->
					<div style="display: flex; flex-wrap: wrap;">
						<div
							style="width: 220px; background-color: #2357b9; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 2.5rem 1rem; color: #fff;">
							<div
								style="width: 52px; height: 52px; border-radius: 50%; border: 1px solid rgba(255,255,255,0.3); display: flex; align-items: center; justify-content: center; margin-bottom: 1.25rem; background-color: rgba(255,255,255,0.1);">
								<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"
									fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
									stroke-linejoin="round">
									<path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" />
									<circle cx="12" cy="12" r="3" />
								</svg>
							</div>
							<span style="font-size: 0.8rem; font-weight: 700; letter-spacing: 1.5px;">VISION</span>
						</div>
						<div
							style="flex: 1; background-color: #2a6cfb; padding: 2.5rem 3rem; color: #fff; min-width: 300px; display: flex; flex-direction: column; justify-content: center;">
							<div
								style="width: 30px; height: 2px; background-color: rgba(255,255,255,0.4); margin-bottom: 1rem;">
							</div>
							<h3
								style="color: #fff; font-size: 1.05rem; font-weight: 700; margin-top: 0; margin-bottom: 0.75rem; font-family: 'Roboto Condensed', Helvetica, Roboto, Arial, sans-serif;">
								A Future of Full Engagement</h3>
							<p
								style="color: rgba(255,255,255,0.9); font-size: 0.85rem; line-height: 1.6; margin-bottom: 0;">
								A future where women in computing across India are fully engaged, recognised, and
								empowered — from rural communities gaining computer literacy to researchers and industry
								leaders shaping the future of technology.
							</p>
						</div>
					</div>

					<!-- Row 3: Values -->
					<div style="display: flex; flex-wrap: wrap;">
						<div
							style="width: 220px; background-color: #192e52; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 2.5rem 1rem; color: #fff;">
							<div
								style="width: 52px; height: 52px; border-radius: 50%; border: 1px solid rgba(255,255,255,0.2); display: flex; align-items: center; justify-content: center; margin-bottom: 1.25rem; background-color: rgba(255,255,255,0.05);">
								<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"
									fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
									stroke-linejoin="round">
									<polygon
										points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
								</svg>
							</div>
							<span style="font-size: 0.8rem; font-weight: 700; letter-spacing: 1.5px;">VALUES</span>
						</div>
						<div
							style="flex: 1; background-color: #112343; padding: 2.5rem 3rem; color: #fff; min-width: 300px; display: flex; flex-direction: column; justify-content: center;">
							<div
								style="width: 30px; height: 2px; background-color: rgba(255,255,255,0.4); margin-bottom: 1rem;">
							</div>
							<h3
								style="color: #fff; font-size: 1.05rem; font-weight: 700; margin-top: 0; margin-bottom: 0.75rem; font-family: 'Roboto Condensed', Helvetica, Roboto, Arial, sans-serif;">
								Inclusion, Excellence & Mentorship</h3>
							<p
								style="color: rgba(255,255,255,0.9); font-size: 0.85rem; line-height: 1.6; margin-bottom: 0;">
								Inclusion, technical excellence, mentorship, and community. We encourage women to
								participate in computing studies and research, face workplace challenges with
								confidence, and grow into leaders who inspire the next generation.
							</p>
						</div>
					</div>
				</div>

				<!-- Milestones & History Timeline -->
				<div style="margin-bottom: 4rem; padding-top: 2rem;">
					<h3
						style="font-family: 'Roboto Condensed', Helvetica, Roboto, Arial, sans-serif; text-align: left; color: #1e293b; font-weight: 700; margin-bottom: 2.5rem; font-size: 30px; letter-spacing: 0;">
						Milestones & <span style="font-style: italic; color: #3b82f6;">History</span>
					</h3>

					<div style="position: relative; padding-left: 40px;">
						<!-- Vertical Line -->
						<div class="timeline-line"
							style="position: absolute; left: 10px; top: 12px; bottom: 0; width: 2px; background-color: #3b82f6;">
						</div>

						<!-- Item 2008 -->
						<div class="timeline-item" style="position: relative; margin-bottom: 2.5rem;">
							<div class="timeline-dot"
								style="position: absolute; left: -35px; top: 6px; width: 12px; height: 12px; background-color: #3b82f6; border-radius: 50%; box-shadow: 0 0 0 4px #eff6ff;">
							</div>
							<div
								style="color: #3b82f6; font-weight: 700; font-size: 0.85rem; letter-spacing: 0.5px; margin-bottom: 0.25rem;">
								2008</div>
							<div
								style="font-weight: 700; font-family: 'Roboto Condensed', Helvetica, Roboto, Arial, sans-serif; font-size: 1.15rem; color: #0f172a; margin-bottom: 0.35rem;">
								ACM-W India Founded</div>
							<p>Established as India's regional chapter of ACM-W, with founding members from premier
								institutes across the country committed to advancing women in computing.</p>
						</div>

						<!-- Item 2011 -->
						<div class="timeline-item" style="position: relative; margin-bottom: 2.5rem;">
							<div class="timeline-dot"
								style="position: absolute; left: -35px; top: 6px; width: 12px; height: 12px; background-color: #3b82f6; border-radius: 50%; box-shadow: 0 0 0 4px #eff6ff;">
							</div>
							<div
								style="color: #3b82f6; font-weight: 700; font-size: 0.85rem; letter-spacing: 0.5px; margin-bottom: 0.25rem;">
								2011</div>
							<div
								style="font-weight: 700; font-family: 'Roboto Condensed', Helvetica, Roboto, Arial, sans-serif; font-size: 1.15rem; color: #0f172a; margin-bottom: 0.35rem;">
								First Annual Symposium</div>
							<p>Launched the flagship annual symposium attracting 400+ attendees, setting the template
								for the country's premier women-in-computing conference.</p>
						</div>

						<!-- Item 2014 -->
						<div class="timeline-item" style="position: relative; margin-bottom: 2.5rem;">
							<div class="timeline-dot"
								style="position: absolute; left: -35px; top: 6px; width: 12px; height: 12px; background-color: #3b82f6; border-radius: 50%; box-shadow: 0 0 0 4px #eff6ff;">
							</div>
							<div
								style="color: #3b82f6; font-weight: 700; font-size: 0.85rem; letter-spacing: 0.5px; margin-bottom: 0.25rem;">
								2014</div>
							<div
								style="font-weight: 700; font-family: 'Roboto Condensed', Helvetica, Roboto, Arial, sans-serif; font-size: 1.15rem; color: #0f172a; margin-bottom: 0.35rem;">
								Lady Ada Contest Launched</div>
							<p>Introduced the Lady Ada Programming Contest, named in honour of Ada Lovelace, giving
								women a dedicated national platform to showcase coding excellence.</p>
						</div>

						<!-- Item 2017 -->
						<div class="timeline-item" style="position: relative; margin-bottom: 2.5rem;">
							<div class="timeline-dot"
								style="position: absolute; left: -35px; top: 6px; width: 12px; height: 12px; background-color: #3b82f6; border-radius: 50%; box-shadow: 0 0 0 4px #eff6ff;">
							</div>
							<div
								style="color: #3b82f6; font-weight: 700; font-size: 0.85rem; letter-spacing: 0.5px; margin-bottom: 0.25rem;">
								2017</div>
							<div
								style="font-weight: 700; font-family: 'Roboto Condensed', Helvetica, Roboto, Arial, sans-serif; font-size: 1.15rem; color: #0f172a; margin-bottom: 0.35rem;">
								50+ Student Chapters</div>
							<p>Surpassed 50 active student chapters, marking a major expansion in grassroots community
								building and mentorship across India's engineering colleges.</p>
						</div>

						<!-- Item 2020 -->
						<div class="timeline-item" style="position: relative; margin-bottom: 2.5rem;">
							<div class="timeline-dot"
								style="position: absolute; left: -35px; top: 6px; width: 12px; height: 12px; background-color: #3b82f6; border-radius: 50%; box-shadow: 0 0 0 4px #eff6ff;">
							</div>
							<div
								style="color: #3b82f6; font-weight: 700; font-size: 0.85rem; letter-spacing: 0.5px; margin-bottom: 0.25rem;">
								2020</div>
							<div
								style="font-weight: 700; font-family: 'Roboto Condensed', Helvetica, Roboto, Arial, sans-serif; font-size: 1.15rem; color: #0f172a; margin-bottom: 0.35rem;">
								100+ Chapters &amp; Digital Pivot</div>
							<p>Surpassed 100 chapters and rapidly scaled online programming during the pandemic,
								reaching 3x more participants through virtual events and workshops.</p>
						</div>

						<!-- Item 2023 -->
						<div class="timeline-item" style="position: relative; margin-bottom: 2.5rem;">
							<div class="timeline-dot"
								style="position: absolute; left: -35px; top: 6px; width: 12px; height: 12px; background-color: #3b82f6; border-radius: 50%; box-shadow: 0 0 0 4px #eff6ff;">
							</div>
							<div
								style="color: #3b82f6; font-weight: 700; font-size: 0.85rem; letter-spacing: 0.5px; margin-bottom: 0.25rem;">
								2023</div>
							<div
								style="font-weight: 700; font-family: 'Roboto Condensed', Helvetica, Roboto, Arial, sans-serif; font-size: 1.15rem; color: #0f172a; margin-bottom: 0.35rem;">
								NariYukti Hackathon Launched</div>
							<p>Launched NariYukti, a flagship national-level all-women hackathon, empowering women to
								innovate and solve real-world problems through technology.</p>
						</div>
					</div>
				</div>

				<!-- Start a Student Chapter CTA (Modern Banner) -->

			</div>
			<?php get_sidebar('content_right'); ?>
		</div>
	</article>
</div>

</div>

<script>
	(function () {
		// IntersectionObserver for timeline scroll animations (both directions)
		var timelineItems = document.querySelectorAll('.timeline-item');
		if (timelineItems.length === 0) return;

		var observer = new IntersectionObserver(function (entries) {
			entries.forEach(function (entry) {
				if (entry.isIntersecting) {
					entry.target.classList.add('is-visible');
				} else {
					// Remove class when scrolling away so it re-animates on return
					entry.target.classList.remove('is-visible');
				}
			});
		}, {
			threshold: 0.15,
			rootMargin: '0px 0px -60px 0px'
		});

		timelineItems.forEach(function (item) {
			observer.observe(item);
		});
	})();
</script>

<?php get_footer(); ?>