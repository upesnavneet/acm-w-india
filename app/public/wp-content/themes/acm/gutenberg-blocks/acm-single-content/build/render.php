<?php
// $attributes,$content,$block

$inner_blocks_html = '';
foreach ( $block->inner_blocks as $inner_block ) {
	$inner_blocks_html .= $inner_block->render();
}
while ( have_posts() ) :
	the_post();
	?>

<article class="columns large-8 medium-8 small-12 blocks has-edit-button" id="SkipTarget" tabindex="-1"
	<?php echo get_block_wrapper_attributes(); ?>>
	<h1><?php the_title(); ?></h1>
	<?php
		the_post_thumbnail(
			'post-thumbnail',
			array(
				'class' => 'featuredimage',
			)
		);
	?>
	<section>
		<?php the_content(); ?>
	</section>
	<hr />
	<?php
	// If comments are open or we have at least one comment, load up the comment template.
	echo $inner_blocks_html;
	if ( is_singular( 'attachment' ) ) {
		// Parent post navigation.
		the_post_navigation(
			array(
				'prev_text' => _x(
					'<span class="meta-nav">Published in</span><span class="post-title">%title</span>',
					'Parent post link',
					'acm'
				),
			)
		);
	} elseif ( is_singular( 'post' ) ) {
		// Previous/next post navigation.
		the_post_navigation(
			array(
				'next_text' => '<span class="meta-nav" aria-hidden="true">&rarr;</span> ' .
					__( 'Next post:', 'acm' ) . ' %title',
				'prev_text' => '<span class="meta-nav" aria-hidden="true">&larr;</span> ' .
					__( 'Previous post:', 'acm' ) . ' %title',
			)
		);
	}
	// End of the loop.
endwhile;
?>
</article>
