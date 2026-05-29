<?php
// var_dump($attributes);
// var_dump($content);
// var_dump($block);
$inner_blocks_html = '';
foreach ( $block->inner_blocks as $inner_block ) {
	$inner_blocks_html .= $inner_block->render();
}
?>


<main id="maincontent" class="article" tabindex="-1" <?php echo get_block_wrapper_attributes(); ?>>
	<div class="columns">
		<?php
		// esc_html_e('ACM Main Wrapper – hello from a dynamic block!', 'acm');
		echo $inner_blocks_html;
		?>
	</div>
</main>
