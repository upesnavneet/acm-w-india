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
<?php
get_header();
?>

<style>
/* --- Homepage Glassmorphism Design System --- */
body.is_home #main {
	background: radial-gradient(circle at 10% 20%, rgba(0, 90, 131, 0.05) 0%, transparent 45%),
				radial-gradient(circle at 90% 80%, rgba(0, 140, 186, 0.05) 0%, transparent 45%),
				#f6fafc !important;
	padding-bottom: 4rem;
}

/* Glassmorphic Hero Banner */
.is_home .acm-banner-container {
	position: relative;
	min-height: 420px;
	display: flex;
	align-items: center;
	padding: 4rem 0;
	border-bottom: 4px solid rgba(0, 140, 186, 0.3);
}

.is_home .banner-content-glass {
	background: rgba(0, 48, 73, 0.55);
	backdrop-filter: blur(16px) saturate(140%);
	-webkit-backdrop-filter: blur(16px) saturate(140%);
	border: 1px solid rgba(255, 255, 255, 0.25);
	border-radius: 16px;
	padding: 3rem 2.5rem;
	max-width: 650px;
	box-shadow: 0 24px 50px rgba(0, 0, 0, 0.25);
	margin: 2rem 0;
	animation: bannerSlideUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}

@keyframes bannerSlideUp {
	from {
		opacity: 0;
		transform: translateY(30px);
	}
	to {
		opacity: 1;
		transform: translateY(0);
	}
}

.is_home .banner-content-glass h1 {
	color: #ffffff !important;
	font-family: 'Roboto Condensed', sans-serif;
	font-weight: 700;
	font-size: 2.8rem;
	margin: 0.5rem 0 1.2rem 0;
	line-height: 1.2;
	text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
}

.is_home .banner-content-glass p {
	color: #e5f1f4 !important;
	font-size: 1.15rem;
	line-height: 1.6;
	margin-bottom: 0;
	text-shadow: 0 1px 4px rgba(0, 0, 0, 0.15);
}

/* Glassmorphic Breadcrumbs */
.is_home .breadcrumb-container {
	margin-top: 2rem;
	margin-bottom: 2rem;
}

.is_home .breadcrumbs {
	background: rgba(255, 255, 255, 0.5) !important;
	backdrop-filter: blur(12px) saturate(180%);
	-webkit-backdrop-filter: blur(12px) saturate(180%);
	border: 1px solid rgba(255, 255, 255, 0.6) !important;
	border-radius: 30px !important;
	padding: 0.6rem 1.75rem !important;
	display: inline-flex;
	list-style: none;
	box-shadow: 0 4px 20px rgba(0, 90, 131, 0.03);
}

/* Homepage Glass Cards */
.is_home .glass-card {
	background: rgba(255, 255, 255, 0.5) !important;
	backdrop-filter: blur(20px) saturate(190%) !important;
	-webkit-backdrop-filter: blur(20px) saturate(190%) !important;
	border: 1px solid rgba(255, 255, 255, 0.65) !important;
	border-radius: 16px !important;
	box-shadow: 0 10px 30px 0 rgba(0, 48, 73, 0.04) !important;
	padding: 2.25rem !important;
	transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1) !important;
	margin-bottom: 2rem !important;
	position: relative;
	overflow: hidden;
}

.is_home .glass-card:hover {
	background: rgba(255, 255, 255, 0.75) !important;
	border-color: rgba(0, 140, 186, 0.45) !important;
	transform: translateY(-6px) scale(1.01) !important;
	box-shadow: 0 20px 40px 0 rgba(0, 48, 73, 0.08) !important;
}

.is_home .glass-card::after {
	content: '';
	position: absolute;
	bottom: 0;
	left: 0;
	width: 100%;
	height: 5px;
	background: linear-gradient(90deg, #005a83, #008cba);
	transform: scaleX(0);
	transform-origin: left;
	transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
}

.is_home .glass-card:hover::after {
	transform: scaleX(1);
}

/* Sidebar Glassmorphic Widgets */
.is_home #secondary .widget,
.is_home #secondary [class*="widget"] {
	background: rgba(255, 255, 255, 0.5) !important;
	backdrop-filter: blur(20px) saturate(190%) !important;
	-webkit-backdrop-filter: blur(20px) saturate(190%) !important;
	border: 1px solid rgba(255, 255, 255, 0.65) !important;
	border-radius: 16px !important;
	box-shadow: 0 10px 30px 0 rgba(0, 48, 73, 0.04) !important;
	padding: 2rem !important;
	margin-bottom: 2.25rem !important;
	transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1) !important;
}

.is_home #secondary .widget:hover {
	background: rgba(255, 255, 255, 0.7) !important;
	border-color: rgba(0, 140, 186, 0.4) !important;
	transform: translateY(-4px) !important;
	box-shadow: 0 16px 32px 0 rgba(0, 48, 73, 0.07) !important;
}

.is_home #secondary .widget h2 {
	font-family: 'Roboto Condensed', sans-serif;
	color: #005a83;
	font-weight: 700;
	font-size: 1.35rem;
	border-bottom: 1.5px solid rgba(0, 90, 131, 0.15);
	padding-bottom: 0.6rem;
	margin-bottom: 1rem;
	text-transform: uppercase;
}

/* CTA Icon Styling */
.is_home .cta-icon-wrapper {
	display: inline-flex;
	align-items: center;
	justify-content: center;
	width: 60px;
	height: 60px;
	background: rgba(0, 140, 186, 0.1);
	color: #005a83;
	border-radius: 12px;
	margin-bottom: 1.5rem;
	transition: all 0.3s ease;
}

.is_home .glass-card:hover .cta-icon-wrapper {
	background: rgba(0, 140, 186, 0.2);
	transform: scale(1.05);
}
</style>

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
?>
<div class="banner-container">
	<section class="acm-banner-container"
		style="background-image: url('<?php echo esc_url( $banner_image ); ?>'); background-size: cover; background-position: center;">
		<div class="row">
			<div class="columns large-12 medium-12">
				<div class="banner-content-glass">
					<small style="text-transform: uppercase; color: #b9dfe9; font-weight: 700; letter-spacing: 2px; font-size: 0.9rem; display: block; font-family: 'Roboto Condensed', sans-serif;">
						<?php echo !empty($banner_top_title) ? esc_html($banner_top_title) : 'ACM-W India'; ?>
					</small>
					<h1>
						<?php echo !empty($banner_title) ? esc_html($banner_title) : 'Empowering Women in Computing'; ?>
					</h1>
					<p>
						<?php echo !empty($banner_desc) ? esc_html($banner_desc) : 'Supporting, celebrating, and advocating internationally for the full engagement of women in all aspects of the computing field.'; ?>
					</p>
				</div>
			</div>
		</div>
	</section>
</div>

<div class="row breadcrumb-container">
	<div class="columns small-12">
		<ul class="breadcrumbs">
			<?php ACMUtils::the_breadcrumb(); ?>
		</ul>
	</div>
</div>

<div class="article" id="maincontent">
	<article class="has-edit-button columns" id="SkipTarget" tabindex="-1">
		<div class="row">
			<div class="columns large-9 medium-9 small-12 zone-1">
				
				<!-- Welcome / Intro Glass Card -->
				<div class="glass-card reveal-on-scroll reveal-delay-1" style="border-left: 6px solid #005a83 !important;">
					<h2 style="font-family: 'Roboto Condensed', sans-serif; color: #005a83; font-weight: 700; margin-top: 0; margin-bottom: 1rem; text-transform: uppercase; letter-spacing: 0.5px;">Empowering Women in Computing</h2>
					<p style="font-size: 1.1rem; line-height: 1.6; color: #333; margin-bottom: 0;">
						<strong>ACM-W India</strong> (Association for Computing Machinery - Women, India) stands as a vibrant beacon dedicated to supporting, celebrating, and advocating internationally for the full engagement of women in all aspects of the computing field. We aim to inspire, motivate, and empower women computing professionals and students across India, fostering a growth-oriented community in both academia and industry.
					</p>
				</div>

				<h3 class="reveal-on-scroll reveal-delay-2" style="font-family: 'Roboto Condensed', sans-serif; color: #005a83; font-weight: 700; margin-top: 2rem; margin-bottom: 1.5rem; border-bottom: 1.5px solid rgba(0, 90, 131, 0.15); padding-bottom: 0.6rem; text-transform: uppercase; letter-spacing: 0.5px;">Our Core Focus & Aims</h3>

				<div class="articles">
					<div class="three-cols article-block">
						<div class="row" data-equalizer>
							
							<!-- Card 1: Professional Growth -->
							<div class="large-6 medium-6 small-12 columns reveal-on-scroll reveal-delay-2">
								<div class="glass-card" data-equalizer-watch="" style="min-height: 290px; display: flex; flex-direction: column; justify-content: space-between;">
									<div>
										<div class="cta-icon-wrapper">
											<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg>
										</div>
										<h4 style="font-family: 'Roboto Condensed', sans-serif; color: #005a83; font-size: 1.25rem; margin-top: 0; margin-bottom: 0.75rem; font-weight: 700;">Professional Development</h4>
										<div class="dek" style="font-size: 0.95rem; line-height: 1.55; color: #555;">
											Advancing careers and research in computing by hosting national conferences, decennial celebrations, technical workshops, and talks by eminent experts to expose women to state-of-the-art technologies and research trends.
										</div>
									</div>
								</div>
							</div>

							<!-- Card 2: Student Chapters -->
							<div class="large-6 medium-6 small-12 columns reveal-on-scroll reveal-delay-3">
								<div class="glass-card" data-equalizer-watch="" style="min-height: 290px; display: flex; flex-direction: column; justify-content: space-between;">
									<div>
										<div class="cta-icon-wrapper">
											<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
										</div>
										<h4 style="font-family: 'Roboto Condensed', sans-serif; color: #005a83; font-size: 1.25rem; margin-top: 0; margin-bottom: 0.75rem; font-weight: 700;">Student Chapters & Engagement</h4>
										<div class="dek" style="font-size: 0.95rem; line-height: 1.55; color: #555;">
											Fostering future generations of female computing professionals by supporting the establishment of ACM-W student chapters across India, organizing student coding contests, hackathons, and self-defense initiatives.
										</div>
									</div>
								</div>
							</div>

							<!-- Card 3: Mentorship & Networking -->
							<div class="large-6 medium-6 small-12 columns reveal-on-scroll reveal-delay-4">
								<div class="glass-card" data-equalizer-watch="" style="min-height: 290px; display: flex; flex-direction: column; justify-content: space-between;">
									<div>
										<div class="cta-icon-wrapper">
											<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="18" cy="18" r="3"></circle><circle cx="6" cy="6" r="3"></circle><circle cx="6" cy="18" r="3"></circle><path d="M18 15V9a4 4 0 0 0-4-4H9"></path><polyline points="12 15 8 18 4 15"></polyline></svg>
										</div>
										<h4 style="font-family: 'Roboto Condensed', sans-serif; color: #005a83; font-size: 1.25rem; margin-top: 0; margin-bottom: 0.75rem; font-weight: 700;">Mentorship & Networking</h4>
										<div class="dek" style="font-size: 0.95rem; line-height: 1.55; color: #555;">
											Connecting female students with experienced mentors in academia and industry. Providing networking platforms to exchange ideas, share resources, and build collaborative research initiatives.
										</div>
									</div>
								</div>
							</div>

							<!-- Card 4: Recognition & Support -->
							<div class="large-6 medium-6 small-12 columns reveal-on-scroll reveal-delay-5">
								<div class="glass-card" data-equalizer-watch="" style="min-height: 290px; display: flex; flex-direction: column; justify-content: space-between;">
									<div>
										<div class="cta-icon-wrapper">
											<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>
										</div>
										<h4 style="font-family: 'Roboto Condensed', sans-serif; color: #005a83; font-size: 1.25rem; margin-top: 0; margin-bottom: 0.75rem; font-weight: 700;">Recognition & Scholarships</h4>
										<div class="dek" style="font-size: 0.95rem; line-height: 1.55; color: #555;">
											Celebrating women's achievements in computing through dedicated scholarships, travel grants for top-tier conferences, and awards recognizing outstanding technical contributions.
										</div>
									</div>
								</div>
							</div>

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
