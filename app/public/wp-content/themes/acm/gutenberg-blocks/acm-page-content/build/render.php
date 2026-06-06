<article class="has-edit-button columns large-8 medium-8 small-12 zone-1" id="SkipTarget" tabindex="-1">
	<div class="row">
		<div class="columns small-12">
			<?php
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					?>
			<section class="post">
				<div class="entrytext">
					<?php
					if ( get_the_content() === '' ) {
						echo '&nbsp;';
					} else {
						the_content();
					}
					?>
				</div>
			</section>
					<?php
				endwhile;
			endif;
			?>
		</div>
	</div>
</article>
