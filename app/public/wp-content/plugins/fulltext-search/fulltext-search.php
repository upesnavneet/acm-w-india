<?php

/*
Plugin Name: WP Fast Total Search - The Power of Indexed Search
Description: Extends the default search with relevance, jet speed and ability to search any posts, metadata, taxonomy, shortcode content and any piece of the wordpress data. No external software/service required.
Version: 1.80.280
Tested up to: 7.0
Author: Epsiloncool
Author URI: https://e-wm.org
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html
Text Domain: fulltext-search
Domain Path: /languages/
*/

/**
 *  Copyright 2013-2026 Epsiloncool
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 ******************************************************************************
 *  I am thank you for the help by buying PRO version of this plugin 
 *  at https://fulltextsearch.org/ 
 *  It will keep me working further on this useful product.
 ******************************************************************************
 * 
 *  @copyright 2013-2026
 *  @license GPLv3
 *  @version 1.80.280
 *  @package WP Fast Total Search
 *  @author Epsiloncool <info@e-wm.org>
 */

/**
 * ACE code editor
 * 
 * BSD License
 * Source: https://github.com/ajaxorg/ace
 * 
 */
/**
 * Json View
 * 
 * MIT license
 * Source: https://github.com/pgrabovets/json-view
 */
/**
 * PHP Stemmer
 * 
 * MIT License
 * Copyright (c) 2016 wamania
 */

define('WPFTS_VERSION', '1.80.280');

if (file_exists(dirname(__FILE__).'/extensions/index.php')) {
	require_once dirname(__FILE__).'/extensions/index.php';
}

require_once dirname(__FILE__).'/includes/wpfts_core.php';

add_action('cron_schedules', function($schedules)
{
	$schedules['wpfts_each_minute'] = array(
		'interval' => 60,	// 60 seconds
		'display' => __( 'Once a minute' )
	);

	$schedules['wpfts_each_hour'] = array(
		'interval' => 3600,	// 3600 seconds
		'display' => __( 'Once a hour' )
	);

	return $schedules;
});

global $wpfts_core;

$wpfts_core = new WPFTS_Core();
$wpfts_core->root_dir = dirname(__FILE__);
$wpfts_core->Init();

require_once dirname(__FILE__).'/blocks/src/livesearch/index.php';

register_activation_hook(__FILE__, array(&$wpfts_core, 'activate_plugin'));
register_deactivation_hook(__FILE__, array(&$wpfts_core, 'deactivate_plugin'));

add_action( 'wpmu_new_blog', function ($blog_id, $user_id, $domain, $path, $site_id, $meta)
{
    global $wpdb, $wpfts_core;
 
	if (!function_exists('is_plugin_active_for_network')) {
		require_once(ABSPATH.'/wp-admin/includes/plugin.php');
	}

    if (is_plugin_active_for_network(plugin_basename(__FILE__))) {
        $old_blog = $wpdb->blogid;
        switch_to_blog($blog_id);
        $wpfts_core->_activate_plugin();
        switch_to_blog($old_blog);
    }
}, 10, 6);

add_action('wpfts_indexer_event', function()
{
	global $wpfts_core;

	if (!$wpfts_core) {
		return;
	}

	if ($wpfts_core->_dev_debug) {
		$wpfts_core->_flare->SendFire(array(
			'pt' => 'inx_cron',
			'stats' => array(
				
			),
		));	
	}

	// Force indexer job to run
	$wpfts_core->IndexerStart();
});

add_action('wpfts_log_clean', function()
{
	global $wpfts_core;

	if (!$wpfts_core) {
		return;
	}

	$wpfts_core->ClearLogs();
});

add_action('wp_enqueue_scripts', function () 
{
	global $wpfts_core;
	
	if (($wpfts_core) && (intval($wpfts_core->get_option('is_smart_excerpts')) != 0)) {
		//wp_enqueue_style( 'wpfts_front_styles', $wpfts_core->root_url.'/style/wpfts_front_styles.css', array(), WPFTS_VERSION);
		echo '<style type="text/css">'.esc_html($wpfts_core->ReadSEStylesMinimized()).'</style>';
	}

	$version = (defined('WP_DEBUG') && WP_DEBUG) ? time() : WPFTS_VERSION;

	wp_enqueue_style('wpfts_jquery-ui-styles', $wpfts_core->root_url.'/style/wpfts_autocomplete.css', array(), $version);
	wp_enqueue_script('wpfts_frontend', plugins_url('js/wpfts_frontend.js', __FILE__), array('jquery', 'jquery-ui-autocomplete'), $version);
});

/** 
 * Here we need to deregister standard function that registers post-excerpt block and then register it with our own way 
*/
add_action('init', function(){
	remove_action('init', 'register_block_core_post_excerpt', 10);
	add_action('init', 'wpfts_register_block_core_post_excerpt', 10);
}, -32767);

/**
 * Registers the `core/post-excerpt` block on the server, BUT with WPFTS specific renderer
 *
 * @since WP 5.8.0
 */

function wpfts_register_block_core_post_excerpt()
{
	$wp_include_dir_blocks = ABSPATH . WPINC . '/blocks';
	register_block_type_from_metadata(
		$wp_include_dir_blocks . '/post-excerpt',
		array(
			'render_callback' => 'wpfts_render_block_core_post_excerpt',
		)
	);
}


/**
 * Renders the `core/post-excerpt` block on the server.
 * NOTICE: This is a modified function originally taken from WP CORE (wp-includes/blocks/post-excerpt.php)
 * WPFTS version does not use wp_trim_words, because it removes HTML tags from excerpts.
 *
 * SORRY, WP CORE DEVELOPERS, you had to think about filter that allow not to 
 *
 * @since 5.8.0
 *
 * @param array    $attributes Block attributes.
 * @param string   $content    Block default content.
 * @param WP_Block $block      Block instance.
 * @return string Returns the filtered post excerpt for the current post wrapped inside "p" tags.
 */
function wpfts_render_block_core_post_excerpt($attributes, $content, $block)
{
	global $wpfts_core;
	
	if ($wpfts_core && is_object($wpfts_core)) {
		if (!$wpfts_core->get_option('is_fix_blocks')) {
			// Call native WP Blocks renderer in case we disabled ours
			return render_block_core_post_excerpt($attributes, $content, $block);
		}
	} else {
		// Wrong call, WPFTS not exists
		return '';
	}

	if ( ! isset( $block->context['postId'] ) ) {
		return '';
	}

	/*
	* The purpose of the excerpt length setting is to limit the length of both
	* automatically generated and user-created excerpts.
	* Because the excerpt_length filter only applies to auto generated excerpts,
	* wp_trim_words is used instead.
	*/
	//$excerpt_length = $attributes['excerptLength'];				// This change was done for WPFTS
	$excerpt        = get_the_excerpt( $block->context['postId'] );
	
	/* This change was done for WPFTS
	if ( isset( $excerpt_length ) ) {
		$excerpt = wp_trim_words( $excerpt, $excerpt_length );
	}
	*/

	$more_text           = ! empty( $attributes['moreText'] ) ? '<a class="wp-block-post-excerpt__more-link" href="' . esc_url( get_the_permalink( $block->context['postId'] ) ) . '">' . wp_kses_post( $attributes['moreText'] ) . '</a>' : '';
	$filter_excerpt_more = static function ( $more ) use ( $more_text ) {
		return empty( $more_text ) ? $more : '';
	};
	/**
	 * Some themes might use `excerpt_more` filter to handle the
	 * `more` link displayed after a trimmed excerpt. Since the
	 * block has a `more text` attribute we have to check and
	 * override if needed the return value from this filter.
	 * So if the block's attribute is not empty override the
	 * `excerpt_more` filter and return nothing. This will
	 * result in showing only one `read more` link at a time.
	 */
	add_filter( 'excerpt_more', $filter_excerpt_more );
	$classes = array();
	if ( isset( $attributes['textAlign'] ) ) {
		$classes[] = 'has-text-align-' . $attributes['textAlign'];
	}
	if ( isset( $attributes['style']['elements']['link']['color']['text'] ) ) {
		$classes[] = 'has-link-color';
	}
	$wrapper_attributes = get_block_wrapper_attributes( array( 'class' => implode( ' ', $classes ) ) );

	$content               = '<p class="wp-block-post-excerpt__excerpt">' . $excerpt;
	$show_more_on_new_line = ! isset( $attributes['showMoreOnNewLine'] ) || $attributes['showMoreOnNewLine'];
	if ( $show_more_on_new_line && ! empty( $more_text ) ) {
		$content .= '</p><p class="wp-block-post-excerpt__more-text">' . $more_text . '</p>';
	} else {
		$content .= " $more_text</p>";
	}
	remove_filter( 'excerpt_more', $filter_excerpt_more );
	return sprintf( '<div %1$s>%2$s</div>', $wrapper_attributes, $content );

}

add_action('init', function () 
{
	global $wpfts_core;

	if ((is_object($wpfts_core)) && (is_callable(array($wpfts_core, 'set_hooks')))) {
	
		$wpfts_core->set_hooks();

		add_action('wp_ajax_nopriv_wpfts_autocomplete', 'wpfts_autocomplete_proc');
		add_action('wp_ajax_wpfts_autocomplete', 'wpfts_autocomplete_proc');

		add_action('wp_ajax_nopriv_wpfts_force_index', array($wpfts_core, 'ajax_force_index'));
		add_action('wp_ajax_wpfts_force_index', array($wpfts_core, 'ajax_force_index'));

		/** Sorry, but my HTML code sometimes has this */
		add_filter( 'safe_style_css', function( $styles ) {
			$styles[] = 'display';
			return $styles;
		});

		/**
		 * Small info row for Post Submit Meta Box
		 */
		add_action('post_submitbox_misc_actions', function($post)
		{
			global $wpfts_core;

			?>
			<div class="misc-pub-section curtime misc-pub-curtime wpfts_submitbox_block">
				<span class="dashicons-before dashicons-search wpfts_submitbox_icon">
					<?php echo esc_html(__('Index', 'fulltext-search')).':'; ?>
				<?php 
				
				// Get current post status
				if ($post && is_object($post) && isset($post->ID)) {
					$post_id = $post->ID;

					$st = $wpfts_core->GetPostIndexStatus(array($post_id));

					echo '<span class="wpfts_post_status" data-postid="'.esc_attr($post_id).'">'.esc_html($st['p'.$post_id]['status_text']).'</span>';
				}

				/*
				<a href="#edit_timestamp" class="edit-timestamp hide-if-no-js" role="button">
					<span aria-hidden="true"><?php echo __( 'More', 'fulltext-search' ); ?></span>
					<span class="screen-reader-text"><?php echo __( 'More actions', 'fulltext-search' ); ?></span>
				</a>
				<fieldset id="timestampdiv" class="hide-if-js">
					<legend class="screen-reader-text"><?php _e( 'Date and time' ); ?></legend>
					
				</fieldset>
				*/ ?>
				</span>
			</div>
			<?php
		});

		if (is_admin()) {

			add_action('admin_menu', 'wpfts_admin_menu');
			add_filter('plugin_row_meta', 'wpfts_plugin_links', 10, 2);
		
			load_plugin_textdomain( 'fulltext-search', false, basename(dirname(__FILE__)).'/languages/');
		
			add_action('admin_enqueue_scripts', 'wpfts_enqueues');
			
			add_action('wp_ajax_wpftsi_ping', array($wpfts_core, 'ajax_ping'));
			add_action('wp_ajax_wpftsi_set_pause', array($wpfts_core, 'ajax_set_pause'));
			add_action('wp_ajax_wpftsi_hide_notification', array($wpfts_core, 'ajax_hide_notification'));
			add_action('wp_ajax_wpftsi_se_style_preview', array($wpfts_core, 'ajax_se_style_preview'));
			add_action('wp_ajax_wpftsi_se_style_reset', array($wpfts_core, 'ajax_se_style_reset'));
			add_action('wp_ajax_wpftsi_try_updatedb', array($wpfts_core, 'ajax_try_updatedb'));

			$admin_actions = $wpfts_core->getAdminActions();

			add_action('wp_ajax_wpftsi_submit_testpost', array($admin_actions, 'ajax_submit_testpost'));
			add_action('wp_ajax_wpftsi_submit_testsearch', array($admin_actions, 'ajax_submit_testsearch'));
			add_action('wp_ajax_wpftsi_submit_rebuild', array($admin_actions, 'ajax_submit_rebuild'));
			add_action('wp_ajax_wpftsi_smartform', array($admin_actions, 'ajax_smartform'));
			add_action('wp_ajax_wpftsi_submit_upgradeindex', array($admin_actions, 'ajax_upgradeindex'));
			add_action('wp_ajax_wpftsi_add_user_irule', array($admin_actions, 'ajax_add_user_irule'));

			$wpfts_core->FeatureDetector();
		}

		do_action('wpfts_init_addons');
	}
});

// Collect all the irules data
// All the custom IRules should be defined in or before 'init' hook (fine for plugins and functions.php file)
add_action('init', function()
{
	global $wpfts_core;

	if ((is_object($wpfts_core)) && (is_callable(array($wpfts_core, 'collect_irules')))) {
		$wpfts_core->collect_irules();
		if (is_admin()) {
			$wpfts_core->FeatureDetectorAfterInitAdmin();
		}
	}
}, 32767);

function wpfts_custom_js()
{
	global $wpfts_core, $wpfts_gstatus;
	
	$wpfts_gstatus = $wpfts_core->get_status();
	$mid = $wpfts_core->get_option('flare_mid');

	$is_settings = $wpfts_core->is_wpfts_settings_page ? 1 : 0;

	$lang_texts = array(
		'save_changes' => esc_html(__('Save Changes', 'fulltext-search')),
		'changes_not_set' => esc_html(__('Changes was not saved - an error occured!', 'fulltext-search')),
		'link_follows' => esc_html(__("This link follows to\n\n%s", 'fulltext-search')),
		'reset_styles' => esc_html(__('This action will reset your custom CSS styles, are you sure?', 'fulltext-search')),
	);

	?><script type="text/javascript">
		var wpfts_pid = "<?php echo esc_html($wpfts_core->getPid()); ?>";
		var wpfts_pingtimeout = <?php echo intval($wpfts_core->get_option('ping_period')) * 1000; ?>;
		var wpfts_root_url = "<?php echo esc_html($wpfts_core->root_url); ?>";
		var switch_caution_txt = <?php echo wpfts_json_encode(__("The conversion process will take some time,\nduring which you should stay on this page of the browser.\n\nIf the progress value does not change for more than 2 minutes,\nrefresh the page manually.", 'fulltext-search')); ?>;
		var wpfts_is_settings_screen = <?php echo intval($is_settings); ?>;
		document.wpfts_settings_main_page = '<?php echo 'admin.php?page=wpfts-options'; ?>';
		document.wpfts_lang_texts = <?php echo wpfts_json_encode($lang_texts); ?>;
		document.wpfts_mid = "<?php echo esc_html(addslashes($mid)); ?>";
		document.wpfts_last_ts = <?php echo isset($wpfts_gstatus['ts']) ? intval($wpfts_gstatus['ts']) : 0; ?>;
		document.nonce_setpause = "<?php echo wp_create_nonce( 'setpause_nonce' ); ?>";

	</script><?php

	$version = (defined('WP_DEBUG') && WP_DEBUG) ? time() : WPFTS_VERSION;

	//$current_tab = isset($_GET['page']) ? $_GET['page'] : 'wpfts-options';
	//if ($current_tab == 'wpfts-options-search-relevance') {
		?>
		<script type="text/javascript">
		var wpfts_se_styles_editor = null;
		jQuery(document).ready(function()
		{
			if (jQuery('#wpfts_se_styles_editor').length > 0) {
				if (ace) {
					wpfts_se_styles_editor = ace.edit("wpfts_se_styles_editor");
					wpfts_se_styles_editor.setTheme("ace/theme/chrome");
					wpfts_se_styles_editor.session.setMode("ace/mode/css");

					if (wpfts_se_styles_editor && (jQuery('#wpfts_se_styles_editor_hidden').length > 0)) {
						wpfts_se_styles_editor.session.on('change', function()
						{
							jQuery('#wpfts_se_styles_editor_hidden').val(wpfts_se_styles_editor.session.getValue());
							jQuery('#wpfts_se_styles_editor_hidden').trigger('change');
						});
					}
				}
			}

		});
		</script>
		<?php
	//}
}
add_action('admin_head', 'wpfts_custom_js');

function wpfts_frontend_js()
{
	?><script type="text/javascript">
		document.wpfts_ajaxurl = "<?php echo esc_url(admin_url('admin-ajax.php')); ?>";
	</script><?php
}
add_action('wp_head', 'wpfts_frontend_js');

add_action('widgets_init', function()
{
	require_once dirname(__FILE__).'/includes/widgets/wpfts_widget.class.php';
	register_widget('WPFTS_Custom_Widget');
});

function wpfts_autocomplete_proc()
{
	$res = array();

	$form_data = isset($_POST['form_data']) ? $_POST['form_data'] : array();

	if (is_array($form_data)) {
		$widget_code = isset($form_data['wpfts_wdgt']) ? $form_data['wpfts_wdgt'] : '';
		$s = isset($form_data['s']) ? $form_data['s'] : '';

		$params = $form_data;
		$params['wpfts_is_force'] = 1;	// Force WPFTS
		$params['wpfts_source'] = 'wpfts_autocomplete_ajax';	// Specify that we are calling from here

		if (strlen($widget_code) > 0) {
			$params['wpfts_wdgt'] = $widget_code;
		} else {
			// Set default parameters like WP does (for Main Query)
			$params['post_status'] = 'publish';
		}
		$loop = new WP_Query($params);
		
		global $wpfts_core;
	
		if ($wpfts_core) {
			$wpfts_core->ForceSmartExcerpts($s);
		}		
		
		while ($loop->have_posts()) {
			$loop->the_post();
			
			$res[] = array(
				'label' => get_the_title(),
				'link' => get_permalink(),
			);
		}
		wp_reset_query();
	}

	echo wpfts_json_encode($res);
	exit();
}

add_action('plugins_loaded', 'wpfts_load_plugin_textdomain');
function wpfts_load_plugin_textdomain() {
	load_plugin_textdomain( 'fulltext-search', false, dirname(plugin_basename(__FILE__)).'/languages/');
}

function wpfts_plugin_links($links, $file)
{
	if (basename($file) == basename(__FILE__)) {
		//$links[] = '<a href="admin.php?page=wpfts-options">'.__('Settings', 'fulltext-search').'</a>';
	}
	return $links;
}

add_filter('plugin_action_links_'.plugin_basename(__FILE__), function($links)
{
	array_unshift($links, '<a href="'.admin_url('admin.php?page=wpfts-options').'">'.__('Settings', 'fulltext-search').'</a>');
	return $links;
});

function wpfts_admin_menu()
{
	global $wpfts_core;

	//$position = ( ++$GLOBALS['_wp_last_object_menu'] );
	$position = ( ++$GLOBALS['_wp_last_utility_menu'] );
	
	$parent_menu = add_menu_page(__('Fast Total Search', 'fulltext-search'), __('Fast Total Search', 'fulltext-search'), 'manage_options', 'wpfts-options', 'wpfts_option_page', 'dashicons-search', $position);

	$wpfts_core->SetTopLevelScreen($parent_menu);

	$menu_items = array(
		'wpfts-options' => array(__('Main Configuration', 'fulltext-search')),
		'wpfts-options-indexing-engine' => array(__('Indexing Engine Settings', 'fulltext-search'), __('Indexing Engine', 'fulltext-search')),
		'wpfts-options-search-relevance' => array(__('Search & Output', 'fulltext-search')),
		'wpfts-options-sandbox-area' => array(__('Sandbox Area', 'fulltext-search')),
		'wpfts-options-analytics' => array(__('Analytics', 'fulltext-search')),
		//'wpfts-options-addons' => array(__('Addons', 'fulltext-search')),
		'wpfts-options-support' => array(__('Support & Docs', 'fulltext-search')),
	);
	$ps1_start = $wpfts_core->get_option('ps1_start_dt');
	if ((strlen($ps1_start) > 0) && ((strtotime($ps1_start) + 24 * 3600 * 14) < current_time('timestamp'))) {
		$menu_items['wpfts-options-ps'] =  array(__('Partnership', 'fulltext-search'));
	}

	$menu_items = apply_filters('wpfts_admin_menu_items', $menu_items);

	$matches = array();
	$is_set_prefix = false;
	foreach ($menu_items as $k => $d) {
		$tt = add_submenu_page('wpfts-options', $d[0], (isset($d[1]) && $d[1]) ? $d[1] : $d[0], 'manage_options', $k, (isset($d[2]) && function_exists($d[2])) ? $d[2] : 'wpfts_option_page');
		if ((substr($tt, 0, 8) != 'toplevel') && (!$is_set_prefix)) {
			if (preg_match('~^(.+_wpfts\-options).*~u', $tt, $matches)) {
				$is_set_prefix = true;
				$wpfts_core->SetPrefixScreen($matches[1]);	
			}
		}
	}

	add_filter('plugin_action_links', 'wpfts_settings_link', 10, 2);

	do_action('wpfts_admin_menu');
}

function wpfts_enqueues($hook_suffix)
{
	global $wpfts_core;

	$version = (defined('WP_DEBUG') && WP_DEBUG) ? time() : WPFTS_VERSION;

	$wpfts_core->set_is_settings_page();

	wp_enqueue_style('wpfts_style', plugins_url('style/wpfts_main.css', __FILE__), array(), $version);
	wp_enqueue_script('wpfts_script', plugins_url('js/wpfts_script.js', __FILE__), array(), $version);
	wp_enqueue_script('wpfts_jsonview', plugins_url('js/jsonview.js', __FILE__), array(), $version);

	if ($wpfts_core->is_wpfts_settings_page) {

		wp_enqueue_style('wpfts_style_bs', plugins_url('style/bs_wpfts.css', __FILE__), array(), $version);
		wp_enqueue_style('wpfts_style_ui', plugins_url('style/ui_main.css', __FILE__), array(), $version);
		wp_enqueue_style('wpfts_style_fa', plugins_url('style/fontawesome-all.css', __FILE__), array(), $version);
		wp_enqueue_style('wpfts_style_s2', plugins_url('style/select2/select2.min.css', __FILE__), array(), $version);

		wp_enqueue_script('wpfts_script_bs', plugins_url('js/bootstrap.min.js', __FILE__), array('jquery'), $version);
		wp_enqueue_script('wpfts_script_ui', plugins_url('js/ui_main.js', __FILE__), array(), $version);
		wp_enqueue_script('wpfts_script_s2', plugins_url('js/select2/select2.min.js', __FILE__), array(), $version);
	
		wp_enqueue_script('wpfts_ace_script', plugins_url('classes/ace/ace.js', __FILE__), array('jquery'), $version);

		// Remove welcome_message
		$wpfts_core->set_option('is_welcome_message', '');

		wp_enqueue_style('wp-pointer');

		wp_enqueue_script('postbox');
		wp_enqueue_script('wp-pointer');
	}

	do_action('wpfts_admin_scripts');
}

function wpfts_settings_link($links, $file)
{
	$this_plugin = dirname(plugin_basename(dirname(__FILE__))) . '/fulltext-search.php';
	if ($file == $this_plugin) {
		$links[] = '<a href="admin.php?page=wpfts-options">' . __('Settings', 'fulltext-search' ) . '</a>';
	}
	return $links;
}

function wpfts_option_page()
{
	global $wpfts_core;

	if (!current_user_can('manage_options')) {
		wp_die(esc_html(__('Sorry, but you do not have permissions to change settings.', 'fulltext-search')));
	}

	/* Make sure post was from this page */
	if (isset($_POST) && (count($_POST) > 0)) {
		check_admin_referer('wpfts-options');
	}

	$wpfts_core->set_option('is_welcome_message', '');

	require dirname(__FILE__).'/admin/admin_page.php';
}

function WPFTS_Get_Widget_List() 
{
	global $wpfts_core;

	if ($wpfts_core && is_object($wpfts_core) && (is_a($wpfts_core, 'WPFTS_Core'))) {
		return $wpfts_core->GetWidgetPresets();
	}

	return array();
}

/**
 * Called when any post/page/etc updated or created
 * 
 * We need to reindex the post by this action
 */
function wpfts_save_post_action($post_id)
{
	wpfts_post_reindex($post_id);
}
add_action('save_post', 'wpfts_save_post_action', 99);

/**
 * Called when any post/page/etc was deleted
 * 
 * We need to delete the post from the index by this action
 */
function wpfts_deleted_post_action($post_id)
{
	wpfts_post_reindex($post_id);
}
add_action('after_delete_post', 'wpfts_deleted_post_action', 99);

function wpfts_post_reindex($post_id, $is_force_remove = false, $is_raw_cache_remove = false)
{
	global $wpfts_core;
	
	if ($is_raw_cache_remove) {
		$wpfts_core->removeRawCache($post_id);
	}

	// First, let's force sync
	$wpfts_core->MakePostsSync(true);

	// Make some magic to force this post indexed first
	$q = 'update `wpftsi_index` set force_rebuild = 2 where tid = "'.addslashes($post_id).'" and tsrc = "wp_posts"';
	$wpfts_core->db->query($q);

	// Force status recalculation
	$wpfts_core->set_option('status_next_ts', 0);

	// Break current loop to start over
	$wpfts_core->set_option('is_break_loop', 1);

	// Ensure loop is starting
	$wpfts_core->CallIndexerStartNoBlocking();

	/*
	$res = $wpfts_core->reindex_post($post_id, $is_force_remove);
	
	if (!$res) {
		trigger_error('Error reindex post ID='.$post_id.': '.$wpfts_core->index_error, E_USER_NOTICE);
		return false;
	}
	*/
	
	return true;
}

function wpfts_set_pause($is_on = true, $is_start_indexer = false)
{
	global $wpfts_core;

	if ($wpfts_core) {
		return $wpfts_core->SetPause($is_on, $is_start_indexer);
	}

	return false;
}

/** Smart Excerpts filters */
add_filter('the_title', function($out)
{
	global $wpfts_core;

	if ($wpfts_core && is_a($wpfts_core, 'WPFTS_Core')) {
		$is_smart_excerpts = intval($wpfts_core->get_option('is_smart_excerpts'));
		if ($is_smart_excerpts != 0) {
		
			$loop_or_block = in_the_loop();
			if (!$loop_or_block) {
				if (class_exists('WP_Block_Supports')) {
					if (isset(WP_Block_Supports::$block_to_render['blockName'])) {
						$bn = WP_Block_Supports::$block_to_render['blockName'];
						if (preg_match('~\/post\-title$~', $bn)) {
							$loop_or_block = true;
						}
					}
				}
			}
			
			if ((is_search() && !is_admin() && $loop_or_block) || ($wpfts_core->forced_se_query !== false)) {
				$post = get_post();
				$ri = new WPFTS_Result_Item(0, $post);
				return $ri->TitleText($out);
			}
		}
	}

	return $out;
});

add_filter('attachment_link', function($link, $post_id)
{
	global $wpfts_core;

	if ($wpfts_core && is_a($wpfts_core, 'WPFTS_Core')) {
		$is_smart_excerpts = intval($wpfts_core->get_option('is_smart_excerpts'));
		if ($is_smart_excerpts != 0) {
		
			$loop_or_block = in_the_loop();
			if (!$loop_or_block) {
				if (class_exists('WP_Block_Supports')) {
					if (isset(WP_Block_Supports::$block_to_render['blockName'])) {
						$bn = WP_Block_Supports::$block_to_render['blockName'];
						if (preg_match('~\/post\-title$~', $bn)) {
							$loop_or_block = true;
						}
					}
				}
			}			
		
			if ((is_search() && !is_admin() && $loop_or_block) || ($wpfts_core->forced_se_query !== false)) {
				$ri = new WPFTS_Result_Item($post_id);
				return $ri->TitleLink($link);
			}
		}
	}

	return $link;
}, 10, 2);

add_filter('page_link', function($link, $post_id, $leavename)
{
	global $wpfts_core;

	if ($wpfts_core && is_a($wpfts_core, 'WPFTS_Core')) {
		$is_smart_excerpts = intval($wpfts_core->get_option('is_smart_excerpts'));
		if ($is_smart_excerpts != 0) {
		
			$loop_or_block = in_the_loop();
			if (!$loop_or_block) {
				if (class_exists('WP_Block_Supports')) {
					if (isset(WP_Block_Supports::$block_to_render['blockName'])) {
						$bn = WP_Block_Supports::$block_to_render['blockName'];
						if (preg_match('~\/post\-title$~', $bn)) {
							$loop_or_block = true;
						}
					}
				}
			}			
		
			if ((is_search() && !is_admin() && $loop_or_block) || ($wpfts_core->forced_se_query !== false)) {
				$ri = new WPFTS_Result_Item($post_id);
				return $ri->TitleLink($link);
			}
		}
	}

	return $link;
}, 10, 3);

add_filter('post_type_link', function($link, $post, $leavename)
{
	global $wpfts_core;

	if ($wpfts_core && is_a($wpfts_core, 'WPFTS_Core')) {
		$is_smart_excerpts = intval($wpfts_core->get_option('is_smart_excerpts'));
		if ($is_smart_excerpts != 0) {
		
			$loop_or_block = in_the_loop();
			if (!$loop_or_block) {
				if (class_exists('WP_Block_Supports')) {
					if (isset(WP_Block_Supports::$block_to_render['blockName'])) {
						$bn = WP_Block_Supports::$block_to_render['blockName'];
						if (preg_match('~\/post\-title$~', $bn)) {
							$loop_or_block = true;
						}
					}
				}
			}
					
			if ((is_search() && !is_admin() && $loop_or_block) || ($wpfts_core->forced_se_query !== false)) {
				$ri = new WPFTS_Result_Item(0, $post);
				return $ri->TitleLink($link);
			}
		}
	}

	return $link;
}, 10, 3);

add_filter('post_link', function($link, $post, $leavename)
{
	global $wpfts_core;

	if ($wpfts_core && is_a($wpfts_core, 'WPFTS_Core')) {
		$is_smart_excerpts = intval($wpfts_core->get_option('is_smart_excerpts'));
		if ($is_smart_excerpts != 0) {
		
			$loop_or_block = in_the_loop();
			if (!$loop_or_block) {
				if (class_exists('WP_Block_Supports')) {
					if (isset(WP_Block_Supports::$block_to_render['blockName'])) {
						$bn = WP_Block_Supports::$block_to_render['blockName'];
						if (preg_match('~\/post\-title$~', $bn)) {
							$loop_or_block = true;
						}
					}
				}
			}
					
			if ((is_search() && !is_admin() && $loop_or_block) || ($wpfts_core->forced_se_query !== false)) {
				$ri = new WPFTS_Result_Item(0, $post);
				return $ri->TitleLink($link);
			}
		}
	}

	return $link;
}, 10, 3);

add_filter('get_the_excerpt', function($out)
{
	global $wpfts_core;

	if ($wpfts_core && is_a($wpfts_core, 'WPFTS_Core')) {

		$is_smart_excerpts = intval($wpfts_core->get_option('is_smart_excerpts'));
		if ($is_smart_excerpts != 0) {

			$post = get_post();
			
			$loop_or_block = in_the_loop();
			if (!$loop_or_block) {
				if (class_exists('WP_Block_Supports')) {
					if (isset(WP_Block_Supports::$block_to_render['blockName'])) {
						$bn = WP_Block_Supports::$block_to_render['blockName'];
						if (preg_match('~\/post\-excerpt$~', $bn)) {
							$loop_or_block = true;
						}
					}
				}
			}

			if (is_search() && !is_admin() && $loop_or_block) {

				$ri = new WPFTS_Result_Item(0, $post);
				$query = get_search_query(false);
				$out = '<div class="wpfts-result-item">'.$ri->Excerpt($query).'</div>';
				return $out;
			} elseif ($wpfts_core->forced_se_query !== false) {
				$ri = new WPFTS_Result_Item(0, $post);
				$query = $wpfts_core->forced_se_query;
				$out = '<div class="wpfts-result-item">'.$ri->Excerpt($query).'</div>';
				return $out;
			} else {
				// Leave excerpt unchanged
			}
		}
	}

	return $out;
});

/**
 * Convert HTML "<" and ">" and also quotes to unicode entities to prevent XSS attacks
 */
function wpfts_json_encode($data)
{
	return wp_json_encode($data, JSON_HEX_TAG | JSON_HEX_QUOT);
}
