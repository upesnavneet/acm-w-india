<?php
// $attributes, $content, $block;

$inner_blocks_html = '';
foreach ( $block->inner_blocks as $inner_block ) {
	$inner_blocks_html .= $inner_block->render();
}
?>

<aside id="secondary" class="columns large-4 medium-4 small-12" role="complementary"
	<?php echo get_block_wrapper_attributes(); ?>>
	<?php echo $inner_blocks_html; ?>
</aside>
