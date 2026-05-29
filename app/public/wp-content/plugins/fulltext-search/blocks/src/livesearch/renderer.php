<?php

/**
 * @package fulltext-search
 */

namespace WPFTS\LiveSearchBlock;

require_once dirname(__FILE__).'/../../../includes/widgets/wpfts_widget.class.php';

add_action( 'rest_api_init', __NAMESPACE__ . '\\register_wpfts_livesearch_block_route' );

function register_wpfts_livesearch_block_route() {
	register_rest_route( 'fulltext-search/v1', '/wpfts-livesearch-block-renderer', array(
		'methods'  => 'POST',
		'callback' => __NAMESPACE__ . '\\wpfts_render_block_livesearch_for_api',
		'permission_callback' => '__return_true',
	) );

	register_rest_route( 'fulltext-search/v1', '/wpfts-livesearch-get-presets', array(
		'methods'  => 'POST',
		'callback' => __NAMESPACE__ . '\\wpfts_blocks_get_presets',
		'permission_callback' => '__return_true',
	) );
}

function wpfts_blocks_get_presets(\WP_REST_Request $request)
{
	global $wpfts_core;

    // Get the post ID from the request (you'll need to adjust how you get this)
    $postId = $request->get_param('postId');

    //Check if a valid post ID is provided.  Adjust according to your needs
    if ( !isset($postId) || !is_numeric($postId) || !get_post($postId) ){
      return new \WP_Error( 'rest_invalid_param', __( 'Invalid or missing post ID.' ), array( 'status' => 400 ) );
    }

	// Check if the user can edit the post
	if ( ! current_user_can( 'edit_post', $postId ) ) {
		return new \WP_Error( 'rest_forbidden', __( 'You do not have permission to edit this post.' ), array( 'status' => 403 ) );
	}

	$widget_list = array(
		array(
			'value' => '',
			'label' => __('-- No Preset --', 'fulltext-search'),
		)
	);
	if (function_exists('WPFTS_Get_Widget_List')) {
		$prs = WPFTS_Get_Widget_List();
		foreach ($prs as $k => $d) {
			$widget_list[] = array('value' => $k, 'label' => $d['title']);
		}
	}

	return rest_ensure_response(array(
		'wpfts_special_tag_for_clean_html' => array(
			'presets' => $widget_list,
		),
	));
}

function wpfts_render_block_livesearch_for_api(\WP_REST_Request $request)
{
	$instance = array(
		'title' => $request->get_param( 'title' ),
		'preset' => $request->get_param( 'preset' ),
		'placeholder' => $request->get_param( 'placeholder' ),
		'buttonText' => $request->get_param( 'buttonText' ),
		'hideButton' => $request->get_param( 'hideButton' ),
		'cssClass' => $request->get_param( 'cssClass' ),
	);

    // Get the post ID from the request (you'll need to adjust how you get this)
    $postId = $request->get_param('postId');

    //Check if a valid post ID is provided.  Adjust according to your needs
    if ( !isset($postId) || !is_numeric($postId) || !get_post($postId) ){
      return new \WP_Error( 'rest_invalid_param', __( 'Invalid or missing post ID.' ), array( 'status' => 400 ) );
    }

	// Check if the user can edit the post
	if ( ! current_user_can( 'edit_post', $postId ) ) {
		return new \WP_Error( 'rest_forbidden', __( 'You do not have permission to edit this post.' ), array( 'status' => 403 ) );
	}

	$html = wpfts_render_block_livesearch($instance);

	return rest_ensure_response(array(
		'wpfts_special_tag_for_clean_html' => $html,
	));
}

function wpfts_render_block_livesearch( $instance ) 
{
	// Sanitize all instance values.  Crucial for security!
	$instance['title'] = sanitize_text_field( isset($instance['title']) ? $instance['title'] : '' );
	$instance['wpfts_wdgt'] = sanitize_text_field( isset($instance['preset']) ? $instance['preset'] : '' );
	$instance['placeholder'] = sanitize_text_field( isset($instance['placeholder']) ? $instance['placeholder'] : '' );
	$instance['button_text'] = sanitize_text_field( isset($instance['buttonText']) ? $instance['buttonText'] : '' );
	$instance['hide_button'] = (int) sanitize_text_field( isset($instance['hideButton']) ? $instance['hideButton'] : 0 ); //Ensure integer
	$instance['class'] = sanitize_text_field( isset($instance['cssClass']) ? $instance['cssClass'] : '' );

	$args = array(
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	);

	ob_start();

    // Simulate the widget's behavior using a dummy widget object.
    // This is necessary to leverage the original widget's logic and filters.
    $dummy_widget = new \WPFTS_Custom_Widget();

    //Call the original widget method with the sanitized instance and args
	$dummy_widget->widget( $args, $instance );

	$html = ob_get_clean();

	return $html;
}
