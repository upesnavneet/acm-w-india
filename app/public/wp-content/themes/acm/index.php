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
	$theme_banner = get_theme_mod( 'banner_bgimage', '' );
	if ( ! empty( $theme_banner ) ) {
		$banner_image = $theme_banner;
	}
	$banner_top_title  = get_theme_mod( 'banner_top_title', '' );
	$banner_title      = get_theme_mod( 'banner_title', '' );
	$banner_desc       = get_theme_mod( 'banner_description', '' );
	$has_text_overlay   = ( ! empty( $banner_top_title ) || ! empty( $banner_title ) || ! empty( $banner_desc ) );
?>
<div class="banner-container">
	<section class="acm-banner-container"
		style="background-image: url('<?php echo esc_url( $banner_image ); ?>'); background-size: cover; background-position: center;">
		<?php if ( $has_text_overlay ) : ?>
		<div class="gradient-wrapper"></div>
		<div class="overlay"></div>
		<div class="row">
			<div class="columns large-12 medium-12 banner-content">
				<p class="banner-heading">
					<small><?php echo esc_html( $banner_top_title ); ?></small>
					<?php echo esc_html( $banner_title ); ?>
				</p>
				<p><?php echo esc_html( $banner_desc ); ?></p>
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
if ( have_posts() ) :
	if ( is_home() && ! is_front_page() ) :
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
			<div class="columns large-9 medium-9 small-12 zone-1">
				<!-- Mission Statement (Plain Text) -->
				<div class="intro-section" style="margin-bottom: 3rem; color: #333333; font-family: Roboto, sans-serif;">
					<h2 style="text-align: left; font-weight: 700; font-size: 1.45rem; margin-top: 1rem; margin-bottom: 1.5rem; color: #1e293b; font-family: 'Roboto Condensed', sans-serif;">
						About ACM-W India
					</h2>
					<p style="font-size: 0.875rem; line-height: 1.6; margin-bottom: 1.25rem;">
						ACM-W India drives the advancement of women across all aspects of computing — from research and academia to industry and innovation. As a standing committee of ACM India, we create tangible opportunities through mentorship programmes, skill-building events, professional chapters, and national recognition platforms that celebrate the work of technical women.
					</p>
					<p style="font-size: 0.875rem; line-height: 1.6; margin-bottom: 2.5rem;">
						ACM Women India (ACM-W India) is a standing committee of <a href="#" style="color: #0077b6; text-decoration: none;">ACM India <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:inline; margin-bottom:2px;"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg></a> and works to fulfill the <a href="#" style="color: #0077b6; text-decoration: none;">ACM-W <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:inline; margin-bottom:2px;"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg></a> mission in India.
					</p>
				</div>

				<!-- Welcome from the Chair Section -->
				<div style="margin-bottom: 3.5rem; padding-top: 2rem; border-top: 1px solid #e2e8f0; color: #333333; font-family: Roboto, sans-serif;">
					<h3 style="text-align: left; font-family: 'Roboto Condensed', sans-serif; color: #0f172a; font-weight: 800; margin-bottom: 1.5rem; font-size: 1.45rem; letter-spacing: -0.5px;">
						Welcome from the ACM-W India Chair
					</h3>
					
					<div class="row" style="margin-left: 0; margin-right: 0;">
						<div class="large-4 medium-4 small-12 columns" style="padding-left: 0; padding-right: 1.5rem; margin-bottom: 1.5rem;">
							<img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&q=80&w=400&h=300" alt="Dr. Geetanjali Kale, ACM-W India Chair" style="width: 100%; max-width: 320px; height: auto; border-radius: 8px; object-fit: cover; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08); border: 1px solid #e2e8f0; display: block; margin-bottom: 1rem;" />
							<p style="font-weight: 700; font-size: 0.95rem; color: #0f172a; margin-bottom: 0.25rem; font-family: 'Roboto Condensed', sans-serif; line-height: 1.2;">
								Dr. Geetanjali Kale
							</p>
							<p style="font-size: 0.8rem; color: #64748b; margin-bottom: 0; font-family: Roboto, sans-serif; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">
								Chair, ACM-W India
							</p>
							<p style="font-size: 0.85rem; color: #94a3b8; margin-top: 0.15rem; margin-bottom: 0;">
								(2024 – Present)
							</p>
						</div>
						
						<div class="large-8 medium-8 small-12 columns" style="padding-left: 0; padding-right: 0;">
							<p style="font-size: 0.9rem; line-height: 1.7; color: #334155; margin-bottom: 1.25rem;">
								At ACM-W India, we believe that the full participation of women in computing is not just an aspiration — it is a necessity. Our initiatives span grassroots student chapters and high-impact national conferences, all driven by the conviction that diverse teams build stronger technology and a more equitable world for everyone.
							</p>
							<p style="font-size: 0.9rem; line-height: 1.7; color: #334155; margin-bottom: 0;">
								We invite every woman in computing — student, researcher, or professional — to engage with our community. Write to us at <a href="mailto:chair@india.acm.org" style="color: #0077b6; text-decoration: none; font-weight: 600;">chair@india.acm.org</a>.
							</p>
						</div>
					</div>
				</div>

				<!-- Join & Volunteer Sections -->
				<div style="margin-bottom: 3.5rem; padding-top: 2rem; border-top: 1px solid #e2e8f0; color: #333333; font-family: Roboto, sans-serif;">
					<div style="margin-bottom: 2.5rem;">
						<h3 style="text-align: left; font-family: 'Roboto Condensed', sans-serif; color: #0f172a; font-weight: 800; margin-bottom: 1.25rem; font-size: 1.3rem; letter-spacing: -0.5px;">
							Become Part of ACM-W
						</h3>
						<p style="font-size: 0.875rem; line-height: 1.7; color: #334155; margin-bottom: 0;">
							Joining ACM-W is simple — when you sign up or renew your ACM membership, check the ACM-W box. You'll instantly connect with a global community of advocates and gain access to exclusive newsletters, early event registration, and networks designed to amplify your voice and accelerate your career in computing.
						</p>
					</div>
				</div>

				<!-- Core Pillars & Initiatives (Styled like Latest Updates) -->
				<h3 id="initiatives" style="font-family: 'Roboto Condensed', sans-serif; text-align: left; color: #1e293b; font-weight: 700; margin-bottom: 2.5rem; font-size: 1.45rem; scroll-margin-top: 100px;">
					Core Pillars & Initiatives
				</h3>

				<div class="row eq-row-flex" style="margin-bottom: 3.5rem; margin-left: -0.5rem; margin-right: -0.5rem;">
					<!-- Card 1 -->
					<div class="large-6 medium-6 small-12 columns" style="margin-bottom: 1.5rem; padding-left: 0.5rem; padding-right: 0.5rem;">
						<div class="glass-grid-card">
							<div style="margin-bottom: 1.25rem; color: #00b4d8; background: rgba(0, 180, 216, 0.1); width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; border-radius: 12px; border: 1px solid rgba(0, 180, 216, 0.2);">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
							</div>
							<h4 style="font-family: 'Roboto Condensed', sans-serif; color: #0f172a; font-size: 1rem; font-weight: 700; margin-top: 0; margin-bottom: 0.75rem;">Professional Growth & DSP</h4>
							<p class="text-muted-glass" style="margin-bottom: 0;">
								From invited lectures by industry leaders to intensive skill-building workshops, we foster environments where women grow as technical professionals. Our Distinguished Speaker Program connects campuses across India with globally recognised computing pioneers.
							</p>
						</div>
					</div>

					<!-- Card 2 -->
					<div class="large-6 medium-6 small-12 columns" style="margin-bottom: 1.5rem; padding-left: 0.5rem; padding-right: 0.5rem;">
						<div class="glass-grid-card">
							<div style="margin-bottom: 1.25rem; color: #00b4d8; background: rgba(0, 180, 216, 0.1); width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; border-radius: 12px; border: 1px solid rgba(0, 180, 216, 0.2);">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
							</div>
							<h4 style="font-family: 'Roboto Condensed', sans-serif; color: #0f172a; font-size: 1rem; font-weight: 700; margin-top: 0; margin-bottom: 0.75rem;">Student Chapters & Outreach</h4>
							<p class="text-muted-glass" style="margin-bottom: 0;">
								We support passionate students in launching ACM-W chapters at their institutions, cultivating local ecosystems of learning, leadership, and community. Technical bootcamps, coding contests, and national hackathons give young women the stage to excel.
							</p>
						</div>
					</div>

					<!-- Card 3 -->
					<div class="large-6 medium-6 small-12 columns" style="margin-bottom: 1.5rem; padding-left: 0.5rem; padding-right: 0.5rem;">
						<div class="glass-grid-card">
							<div style="margin-bottom: 1.25rem; color: #00b4d8; background: rgba(0, 180, 216, 0.1); width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; border-radius: 12px; border: 1px solid rgba(0, 180, 216, 0.2);">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
							</div>
							<h4 style="font-family: 'Roboto Condensed', sans-serif; color: #0f172a; font-size: 1rem; font-weight: 700; margin-top: 0; margin-bottom: 0.75rem;">Mentorship & Grad Cohorts</h4>
							<p class="text-muted-glass" style="margin-bottom: 0;">
								Our Graduate Cohort programme pairs women researchers with seasoned mentors from academia and industry, providing peer support, publishing guidance, and career navigation tools critical to thriving in graduate-level computing.
							</p>
						</div>
					</div>

					<!-- Card 4 -->
					<div class="large-6 medium-6 small-12 columns" style="margin-bottom: 1.5rem; padding-left: 0.5rem; padding-right: 0.5rem;">
						<div class="glass-grid-card">
							<div style="margin-bottom: 1.25rem; color: #00b4d8; background: rgba(0, 180, 216, 0.1); width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; border-radius: 12px; border: 1px solid rgba(0, 180, 216, 0.2);">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>
							</div>
							<h4 style="font-family: 'Roboto Condensed', sans-serif; color: #0f172a; font-size: 1rem; font-weight: 700; margin-top: 0; margin-bottom: 0.75rem;">Scholarships & Travel Grants</h4>
							<p class="text-muted-glass" style="margin-bottom: 0;">
								Financial barriers should never limit a talented woman's reach. Our scholarships and travel grants fund participation in premier international computing conferences, spotlighting India's brightest women technologists.
							</p>
						</div>
					</div>
				</div>

				<!-- Flagship Events Highlights -->
				<h3 style="font-family: 'Roboto Condensed', sans-serif; color: #0f172a; font-weight: 800; margin-bottom: 2rem; font-size: 1.45rem; letter-spacing: -0.5px; border-left: 4px solid #00b4d8; padding-left: 1rem;">
					Flagship Celebrations & Competitions
				</h3>

				<div class="glass-card" style="padding: 2.2rem !important; margin-bottom: 3.5rem;">
					<div class="row">
						<div class="large-6 columns" style="margin-bottom: 1.5rem;">
							<div style="border-left: 3px solid #00b4d8; padding-left: 1.25rem;">
								<span class="glass-tag" style="background: rgba(144, 224, 239, 0.1) !important; color: #90e0ef !important;">Annual Conference</span>
								<h4 style="font-family: 'Roboto Condensed', sans-serif; color: #0f172a; font-size: 1.05rem; font-weight: 700; margin-top: 0; margin-bottom: 0.75rem;">AICWiC: Celebration of Women</h4>
								<p class="text-muted-glass" style="margin-bottom: 0; font-size: 0.85rem !important;">
									India's premier women-in-computing conference, uniting researchers, industry leaders, and students for an immersive day of keynotes, paper presentations, and career panels that celebrate and elevate the work of women in tech.
								</p>
							</div>
						</div>
						<div class="large-6 columns">
							<div style="border-left: 3px solid #00b4d8; padding-left: 1.25rem;">
								<span class="glass-tag" style="background: rgba(144, 224, 239, 0.1) !important; color: #90e0ef !important;">National Coding Event</span>
								<h4 style="font-family: 'Roboto Condensed', sans-serif; color: #0f172a; font-size: 1.05rem; font-weight: 700; margin-top: 0; margin-bottom: 0.75rem;">ACM-W India Hackathon</h4>
								<p class="text-muted-glass" style="margin-bottom: 0; font-size: 0.85rem !important;">
									A high-stakes, innovation-first hackathon where women engineers tackle real-world challenges in sustainability, health, and digital inclusion — building impactful prototypes under the mentorship of leading industry experts.
								</p>
							</div>
						</div>
					</div>
				</div>

				<!-- Start a Student Chapter CTA (Modern Banner) -->
				<div class="glass-card" style="background: linear-gradient(135deg, rgba(0, 119, 182, 0.08) 0%, rgba(255, 255, 255, 0.01) 100%) !important; border: 1px solid rgba(0, 180, 216, 0.15) !important; padding: 2.5rem !important; margin-bottom: 0;">
					<div class="row">
						<div class="large-8 columns">
							<span class="glass-tag">Empower Your Campus</span>
							<h3 style="font-family: 'Roboto Condensed', sans-serif; color: #0f172a; font-weight: 800; font-size: 1.35rem; margin-top: 0; margin-bottom: 1rem; letter-spacing: -0.5px;">
								Bring ACM-W India to Your Campus
							</h3>
							<p class="text-lead" style="font-size: 0.85rem !important; margin-bottom: 2rem;">
								Launching an ACM-W student chapter is the most direct way to foster a culture of inclusion at your institution. Chapters unlock access to lectures, project grants, mentors, and an international network of women in computing — from day one.
							</p>
							<div class="row" style="margin-bottom: 2rem;">
								<div class="large-4 columns" style="margin-bottom: 1rem;">
									<div class="step-bubble">1</div>
									<h5 style="color: #0f172a; font-weight: 700; font-size: 0.8rem; margin-bottom: 0.25rem; font-family: 'Roboto Condensed', sans-serif;">Assemble Team</h5>
									<p class="text-muted-glass" style="font-size: 0.78rem !important; margin: 0; line-height: 1.4;">10+ student members and 1 faculty sponsor.</p>
								</div>
								<div class="large-4 columns" style="margin-bottom: 1rem;">
									<div class="step-bubble">2</div>
									<h5 style="color: #0f172a; font-weight: 700; font-size: 0.8rem; margin-bottom: 0.25rem; font-family: 'Roboto Condensed', sans-serif;">Charter Online</h5>
									<p class="text-muted-glass" style="font-size: 0.78rem !important; margin: 0; line-height: 1.4;">Submit the official application via ACM Portal.</p>
								</div>
								<div class="large-4 columns" style="margin-bottom: 1rem;">
									<div class="step-bubble">3</div>
									<h5 style="color: #0f172a; font-weight: 700; font-size: 0.8rem; margin-bottom: 0.25rem; font-family: 'Roboto Condensed', sans-serif;">Launch & Grow</h5>
									<p class="text-muted-glass" style="font-size: 0.78rem !important; margin: 0; line-height: 1.4;">Receive expert resources and chapter support.</p>
								</div>
							</div>
							<a href="/start-chapter/" class="btn-primary-glass" style="box-shadow: 0 4px 15px rgba(0, 180, 216, 0.4) !important;">Read Starter Guide</a>
						</div>
						<div class="large-4 columns show-for-large-up" style="display: flex; align-items: center; justify-content: center; padding-left: 2rem; height: 320px;">
							<svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" viewBox="0 0 24 24" fill="none" stroke="#00b4d8" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" style="opacity: 0.8; filter: drop-shadow(0 0 10px rgba(0, 180, 216, 0.45));"><path d="M22 10v6M2 10l10-5 10 5-10 5z"></path><path d="M6 12v5c0 2 2 3 6 3s6-1 6-3v-5"></path></svg>
						</div>
					</div>
				</div>
			</div>
			<?php get_sidebar( 'content_right' ); ?>
		</div>
	</article>
</div>

</div>

<?php get_footer(); ?>
