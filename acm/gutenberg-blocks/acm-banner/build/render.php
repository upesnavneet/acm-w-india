<?php



if ( is_home() || is_category() || is_archive() ) :
	?>
	<?php
	if ( isset( $attributes['mediaUrl'] ) && $attributes['mediaUrl'] ||
	isset( $attributes['textLine1'] ) && $attributes['textLine1'] ||
	isset( $attributes['textLine2'] ) && $attributes['textLine2'] ||
	isset( $attributes['textLine3'] ) && $attributes['textLine3'] ) {
		?>
		<div class="banner-container banner-contain-mode">
			<section class="acm-banner-container">
				<img class="banner-bg-img" src="<?php echo esc_url( $attributes['mediaUrl'] ?? get_template_directory_uri() . '/img/banner.png' ); ?>" alt="Banner" />
				<div class="gradient-wrapper"></div>
				<div class="overlay"></div>
				<div class="row">
					<div class="columns large-12 medium-12 banner-content">
						<p class="banner-heading">
							<small><?php echo esc_html( $attributes['textLine1'] ?? 'Association for Computing Machinery' ); ?></small>
							<?php echo esc_html( $attributes['textLine2'] ?? 'Advancing Computing as a Science & Profession' ); ?>
						</p>
						<p><?php echo esc_html( $attributes['textLine3'] ?? 'We see a world where computing helps solve tomorrow's problems – where we use our knowledge and skills to advance the profession and make a positive impact.' ); ?>
						</p>
					</div>
				</div>
			</section>
		</div>
		<?php
	} else {
		?>
		<div class="banner-container banner-contain-mode">
			<section class="acm-banner-container">
				<img class="banner-bg-img" src="<?php echo esc_url( get_theme_mod( 'banner_bgimage', get_template_directory_uri() . '/img/banner.png' ) ); ?>" alt="Banner" />
				<div class="gradient-wrapper"></div>
				<div class="overlay"></div>
				<div class="row">
					<div class="columns large-12 medium-12 banner-content">
						<p class="banner-heading">
							<small><?php echo esc_html( get_theme_mod( 'banner_top_title', 'Association for Computing Machinery' ) ); ?></small>
							<?php echo esc_html( get_theme_mod( 'banner_title' ), 'Advancing Computing as a Science & Profession' ); ?>
						</p>
						<p><?php echo esc_html( get_theme_mod( 'banner_description', 'We see a world where computing helps solve tomorrow's problems – where we use our knowledge and skills to advance the profession and make a positive impact.' ) ); ?></p>
					</div>
				</div>
			</section>
		</div>
		
		<?php
	}
	?>

	<?php
else :
	?>
	<?php
	$banner = ACMUtils::get_banner_data( get_the_ID() );
	// print_r($banner);
	// var_dump($banner);
	if ( '' !== $banner['title'] ) :
		?>
<div class="banner-container banner-contain-mode">
	<div class="acm-banner-container">
		<?php if ( $banner['image'] ) : ?>
		<img class="banner-bg-img" src="<?php echo esc_url( $banner['image'] ); ?>" alt="Banner" />
		<?php endif; ?>
		<div class="gradient-wrapper"></div>
		<div class="overlay"></div>
		<div class="row">
			<div class="columns large-12 medium-12 banner-content">
				<p class="banner-heading">
					<small><?php echo esc_html( $banner['title'] ); ?></small>
					<?php echo esc_html( $banner['sub_title'] ); ?>
				</p>
				<p><?php echo esc_html( $banner['description'] ); ?></p>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
<?php endif; ?>
