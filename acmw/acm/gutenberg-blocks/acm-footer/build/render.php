<?php
$inner_blocks_html = '';
foreach ( $block->inner_blocks as $inner_block ) {
	$inner_blocks_html .= $inner_block->render();
}

?>
<div class="row">


	<nav>
		<div class="footer-nav">
			<?php echo $inner_blocks_html; ?>
		</div>
		<style>
			@media only screen and (min-width: 460px) {
				.footer-nav {
					column-count: <?php echo $attributes['columnCountMobile'] ?? 2; ?>;
				}
			}

			@media only screen and (min-width: 760px) {
				.footer-nav {
					column-count: <?php echo $attributes['columnCountTablet'] ?? 2; ?>;
				}
			}

			@media only screen and (min-width: 1024px) {
				.footer-nav {
					column-count: <?php echo $attributes['columnCount'] ?? 2; ?>;
				}
			}
		</style>
	</nav>

	<div class="logo_social_group">
		<hr />
		<?php
		if ( isset( $attributes['mediaUrl'] ) && $attributes['mediaUrl'] ) {
			?>
			<img alt="ACM Logo" width="200" height="70" class="img-responsive" src="<?php echo $attributes['mediaUrl'] ?? get_template_directory_uri() . '/img/logo_footer_acm.png'; ?>">
			<?php
		} else {
			$logo = get_theme_mod( 'footer_logo' );
			if ( $logo ) {
				?>
				<img alt="ACM Logo" width="200" height="70" class="img-responsive" src="<?php echo esc_url( get_theme_mod( 'footer_logo' ) ); ?>">
				<?php
			} else {
				?>
				<img alt="ACM Logo" width="200" height="70" class="img-responsive" src="<?php echo get_template_directory_uri() . '/img/logo_footer_acm.png'; ?>">
				<?php
			}
		}


		?>
		

		<ul class="footer__social">
			<?php
			if ( isset( $attributes['links'] ) && count( $attributes['links'] ) > 0 ) :
				// Loop through the rows of data.
				foreach ( $attributes['links'] as $link ) :
					if ( $link['hide'] === false ) :
						?>
						<li>
							<a href="<?php echo esc_url( $link['href'] ?? '' ); ?>" class="acm_social-network " target='_blank'>
								<?php echo $link['svg'] ?? ''; ?>
							</a>
						</li>
						<?php
					endif;
				endforeach;
			endif;
			?>
		</ul>
	</div>
	<div class="footer-bottom-menu">
		<?php
		if ( isset( $attributes['footerBottom'] ) && $attributes['footerBottom'] ) {
			$footer_menu_array = array(
				'menu'        => $attributes['footerBottom'] ?? 1,
				'menu_class'  => 'right',
				'depth'       => 1,
				'link_before' => '<span class="">',
				'link_after'  => '</span>',
			);
		} else {
			$footer_menu_array = array(
				'theme_location' => 'footer',
				'menu_class'     => 'right',
				'depth'          => 1,
				'link_before'    => '<span class="">',
				'link_after'     => '</span>',
			);
		}
		wp_nav_menu(
			$footer_menu_array
		);
		?>
		<div><?php echo esc_attr( $attributes['bottomText'] ?? '' ); ?></div>
	</div>

</div>
