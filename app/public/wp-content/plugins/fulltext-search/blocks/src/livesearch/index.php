<?php

require_once dirname(__FILE__).'/renderer.php';

add_action('init', function () 
{
	global $wpfts_core;

	if ((is_object($wpfts_core)) && (is_callable(array($wpfts_core, 'set_hooks')))) {
		//register_block_type( __DIR__ . '/blocks/build/livesearch' );
		register_block_type(
			dirname(__FILE__).'/../../build/livesearch/',
			array(
				'render_callback' => 'WPFTS\\LiveSearchBlock\\wpfts_render_block_livesearch',
			)
		);

	}
});

add_action('wp_enqueue_script', function(){
	global $wpfts_core;

	if (is_object($wpfts_core) && $wpfts_core) {
		wp_localize_script( 'wp-api', 'wpfts_blocks', array(
			'wpfts_blocks_nonce' => wp_create_nonce( 'wp_rest' )
		));
	}
});