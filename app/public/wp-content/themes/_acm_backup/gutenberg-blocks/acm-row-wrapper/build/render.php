<?php
$inner_blocks_html = '';
foreach ( $block->inner_blocks as $inner_block ) {
	$inner_blocks_html .= $inner_block->render();
}
?>
<div class="row" <?php echo get_block_wrapper_attributes(); ?>>
	<?php echo $inner_blocks_html; ?>
</div>
