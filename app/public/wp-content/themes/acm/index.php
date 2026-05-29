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
				<div class="articles">
					<div class="three-cols article-block">
						<div class="row" data-equalizer>
						<?php
						if ( have_posts() ) :
							$acm_count = 0;
							while ( have_posts() ) :
								the_post();
								$acm_delay_class = 'reveal-delay-' . ( ( $acm_count % 2 ) + 1 );
								$acm_count++;
								?>
							<div class="large-6 medium-6 small-12 columns reveal-on-scroll <?php echo esc_attr( $acm_delay_class ); ?>">
								<div class="shadowed cta" data-equalizer-watch="">
									<div class="row acm__margin--inherit">
										<div class="medium-12 columns d-table">
											<div class="text-wrap">
												<a href="<?php the_permalink(); ?>">
												<?php
												if ( has_post_thumbnail() ) {
													the_post_thumbnail( 'home-excerpt-thumbnail' ); }
												?>
													<h3><?php the_title(); ?></h3>
												</a>
												<div class="dek">
												<?php the_excerpt(); ?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
								<?php
								endwhile;
							endif;
						?>
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
