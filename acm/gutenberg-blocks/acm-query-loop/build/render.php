<div class="columns large-9 medium-9 small-12 zone-1">
	<div class="articles">
		<div class="three-cols article-block">
			<div class="row" data-equalizer>
				<?php
				if ( have_posts() ) :
					while ( have_posts() ) :
						the_post();
						?>
				<div class="large-6 medium-6 small-12 columns">
					<div class="shadowed cta" data-equalizer-watch="">
						<div class="row acm__margin--inherit">
							<div class="medium-12 columns d-table">
								<div class="text-wrap">
									<a href="<?php the_permalink(); ?>">
										<?php
										if ( has_post_thumbnail() ) {
											the_post_thumbnail( 'home-excerpt-thumbnail' );
										}
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
