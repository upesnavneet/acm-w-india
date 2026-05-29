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
	<article class="has-edit-button columns" id="SkipTarget" tabindex="-1">
		<div class="row">
			<div class="columns large-9 medium-9 small-12 zone-1">
				<!-- Welcome / Intro Section -->
				<div class="acm-w-intro reveal-on-scroll reveal-delay-1" style="margin-bottom: 2.5rem; background: #ffffff; padding: 2rem; border-radius: 6px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); border-left: 5px solid #005a83;">
					<h2 style="font-family: 'Roboto Condensed', sans-serif; color: #005a83; font-weight: 700; margin-top: 0; margin-bottom: 1rem; text-transform: uppercase; letter-spacing: 0.5px;">Empowering Women in Computing</h2>
					<p style="font-size: 1.1rem; line-height: 1.6; color: #333; margin-bottom: 0;">
						<strong>ACM-W India</strong> (Association for Computing Machinery - Women, India) stands as a vibrant beacon dedicated to supporting, celebrating, and advocating internationally for the full engagement of women in all aspects of the computing field. We aim to inspire, motivate, and empower women computing professionals and students across India, fostering a growth-oriented community in both academia and industry.
					</p>
				</div>

				<h3 class="reveal-on-scroll reveal-delay-2" style="font-family: 'Roboto Condensed', sans-serif; color: #005a83; font-weight: 700; margin-bottom: 1.5rem; border-bottom: 1px solid #ddd; padding-bottom: 0.5rem; text-transform: uppercase; letter-spacing: 0.5px;">Our Core Focus & Aims</h3>

				<div class="articles">
					<div class="three-cols article-block">
						<div class="row" data-equalizer>
							
							<!-- Card 1: Professional Growth -->
							<div class="large-6 medium-6 small-12 columns reveal-on-scroll reveal-delay-2">
								<div class="shadowed cta" data-equalizer-watch="" style="padding: 1.75rem; min-height: 280px; display: flex; flex-direction: column; justify-content: space-between; margin-bottom: 1.5rem;">
									<div class="row acm__margin--inherit">
										<div class="medium-12 columns">
											<div style="margin-bottom: 1rem; color: #005a83;">
												<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trending-up"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg>
											</div>
											<div class="text-wrap">
												<h4 style="font-family: 'Roboto Condensed', sans-serif; color: #005a83; font-size: 1.25rem; margin-top: 0; margin-bottom: 0.75rem; font-weight: 700;">Professional Development</h4>
												<div class="dek" style="font-size: 0.95rem; line-height: 1.5; color: #555;">
													Advancing careers and research in computing by hosting national conferences, decennial celebrations, technical workshops, and talks by eminent experts to expose women to state-of-the-art technologies and research trends.
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<!-- Card 2: Student Chapters -->
							<div class="large-6 medium-6 small-12 columns reveal-on-scroll reveal-delay-3">
								<div class="shadowed cta" data-equalizer-watch="" style="padding: 1.75rem; min-height: 280px; display: flex; flex-direction: column; justify-content: space-between; margin-bottom: 1.5rem;">
									<div class="row acm__margin--inherit">
										<div class="medium-12 columns">
											<div style="margin-bottom: 1rem; color: #005a83;">
												<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
											</div>
											<div class="text-wrap">
												<h4 style="font-family: 'Roboto Condensed', sans-serif; color: #005a83; font-size: 1.25rem; margin-top: 0; margin-bottom: 0.75rem; font-weight: 700;">Student Chapters & Engagement</h4>
												<div class="dek" style="font-size: 0.95rem; line-height: 1.5; color: #555;">
													Fostering future generations of female computing professionals by supporting the establishment of ACM-W student chapters across India, organizing student coding contests, hackathons, and self-defense initiatives.
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<!-- Card 3: Mentorship & Networking -->
							<div class="large-6 medium-6 small-12 columns reveal-on-scroll reveal-delay-4">
								<div class="shadowed cta" data-equalizer-watch="" style="padding: 1.75rem; min-height: 280px; display: flex; flex-direction: column; justify-content: space-between; margin-bottom: 1.5rem;">
									<div class="row acm__margin--inherit">
										<div class="medium-12 columns">
											<div style="margin-bottom: 1rem; color: #005a83;">
												<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-git-pull-request"><circle cx="18" cy="18" r="3"></circle><circle cx="6" cy="6" r="3"></circle><circle cx="6" cy="18" r="3"></circle><path d="M18 15V9a4 4 0 0 0-4-4H9"></path><polyline points="12 15 8 18 4 15"></polyline></svg>
											</div>
											<div class="text-wrap">
												<h4 style="font-family: 'Roboto Condensed', sans-serif; color: #005a83; font-size: 1.25rem; margin-top: 0; margin-bottom: 0.75rem; font-weight: 700;">Mentorship & Networking</h4>
												<div class="dek" style="font-size: 0.95rem; line-height: 1.5; color: #555;">
													Connecting female students with experienced mentors in academia and industry. Providing networking platforms to exchange ideas, share resources, and build collaborative research initiatives.
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<!-- Card 4: Recognition & Support -->
							<div class="large-6 medium-6 small-12 columns reveal-on-scroll reveal-delay-5">
								<div class="shadowed cta" data-equalizer-watch="" style="padding: 1.75rem; min-height: 280px; display: flex; flex-direction: column; justify-content: space-between; margin-bottom: 1.5rem;">
									<div class="row acm__margin--inherit">
										<div class="medium-12 columns">
											<div style="margin-bottom: 1rem; color: #005a83;">
												<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-award"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>
											</div>
											<div class="text-wrap">
												<h4 style="font-family: 'Roboto Condensed', sans-serif; color: #005a83; font-size: 1.25rem; margin-top: 0; margin-bottom: 0.75rem; font-weight: 700;">Recognition & Scholarships</h4>
												<div class="dek" style="font-size: 0.95rem; line-height: 1.5; color: #555;">
													Celebrating women's achievements in computing through dedicated scholarships, travel grants for top-tier conferences, and awards recognizing outstanding technical contributions.
												</div>
											</div>
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
