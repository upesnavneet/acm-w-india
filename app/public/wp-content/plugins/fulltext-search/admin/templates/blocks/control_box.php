<?php

/**
 * Copyright 2013-2024 Epsiloncool
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
 *  @copyright 2013-2024
 *  @license GPLv3
 *  @package WP Fast Total Search
 *  @author Epsiloncool <info@e-wm.org>
 */

global $wpfts_core;

if (!($wpfts_core && is_object($wpfts_core))) {
	exit();
}

require_once dirname(__FILE__).'/../../../includes/wpfts_htmltools.php';

$enabled = intval($wpfts_core->get_option('enabled'));
$autoreindex = intval($wpfts_core->get_option('autoreindex'));
$is_fixmariadb = intval($wpfts_core->get_option('is_fixmariadb'));
$is_optimizer = intval($wpfts_core->get_option('is_optimizer'));
	
$t = $wpfts_core->get_option('preset_selector');
$is_wpadmin = ($t && is_array($t) && isset($t['wpmainsearch_admin']) && ($t['wpmainsearch_admin'] === 'backend_default')) ? 1 : 0;

$is_wpblocks = ($t && is_array($t) && isset($t['wpblockquery']) && ($t['wpblockquery'] === 'frontend_default')) ? 1 : 0;

global $wpfts_compat_installed;

$is_use_theme_compat = intval($wpfts_core->get_option('is_use_theme_compat'));

$is_hook_available = 0;

$theme_props = $wpfts_core->get_option('theme_options');

$theme_string = '';
if ($theme_props && is_array($theme_props)) {
	if (isset($theme_props['is_child_theme']) && ($theme_props['is_child_theme'])) {
		$theme_string = '<b>'.esc_html($theme_props['name']).' '.esc_html($theme_props['version']).'</b> ('.esc_html(__('child theme of ', 'fulltext-search')).' <b>'.esc_html($theme_props['base_name']).' '.esc_html($theme_props['base_version']).'</b>)';
	} else {
		$theme_string = '<b>'.esc_html($theme_props['base_name']).' '.esc_html($theme_props['base_version']).'</b>';
	}
	if (isset($theme_props['is_hook_available'])) {
		$is_hook_available = intval($theme_props['is_hook_available']);
	}
}

$theme_string .= ', '.esc_html(__('hook status', 'fulltext-search')).': ';

if ($is_hook_available > 0) {
	$theme_string .= ' <span class="text-success">'.esc_html(__('Available', 'fulltext-search')).'</span>';

	if ($wpfts_compat_installed) {
		$theme_string .= ', <span class="text-success">'.esc_html(__('Installed', 'fulltext-search')).'</span>';
	} else {
		$theme_string .= ', <span class="text-danger">'.esc_html(__('Disabled', 'fulltext-search')).'</span>';
	}
} elseif ($is_hook_available == -1) {
	$theme_string .= ' <span class="text-success">'.esc_html(__('Not required', 'fulltext-search')).'</span>';
} else {
	$theme_string .= ' <a href="admin.php?page=wpfts-options-support" class="text-warning" style="text-decoration: underline;" title="'.esc_html(__('Please let us know if you have any issues with your theme or Smart Excerpts', 'fulltext-search')).'">'.esc_html(__('Not Available', 'fulltext-search')).'</a>';
}


?>
	<div class="card mb-2 mt-4 wpfts_smartform" data-name="form_controlbox">
		<?php wp_nonce_field( 'wpfts_options_controlbox', 'wpfts_options-nonce_controlbox' ); ?>
		<div class="card-header bg-light"><div class="row"><span class="col-9"><?php echo esc_html(__('Control Panel', 'fulltext-search')); ?></span><span class="col-3 text-right sf_savelink_place"></span></div></div>
		<div class="card-body">
			<div class="row">
				<div class="col fixed-200 font-weight-bolder">
					<?php echo esc_html(__('Enable Fast Total Search', 'fulltext-search')); ?>
				</div>
				<div class="col fixed-150">
					<?php
					WPFTS_Htmltools::displayLabelledCheckbox('wpfts_enabled', 1, esc_html(__('Enabled', 'fulltext-search')), $enabled);
					?>
				</div>
				<div class="col d-xl-none text-right">
					<p><a data-toggle="collapse" href="#wf_hint1" role="button" aria-expanded="false" aria-controls="wf_hint1"><i class="fa fa-info-circle"></i></a></p>
				</div>
				<div class="col col-xl col-12 d-xl-block collapse" id="wf_hint1">
					<p class="text-secondary"><i><?php echo esc_html(__('If not enabled, the regular integrated "not indexed" WordPress search will be used', 'fulltext-search')); ?></i></p>
				</div>
			</div>

			<div class="row">
				<div class="col fixed-200 font-weight-bolder">
					<?php echo esc_html(__('Auto-Index', 'fulltext-search')); ?>
				</div>
				<div class="col fixed-150">
					<?php
					WPFTS_Htmltools::displayLabelledCheckbox('wpfts_autoreindex', 1, __('Enabled', 'fulltext-search'), $autoreindex);
					?>
				</div>	
				<div class="col d-xl-none text-right">
					<p><a data-toggle="collapse" href="#wf_hint2" role="button" aria-expanded="false" aria-controls="wf_hint2"><i class="fa fa-info-circle"></i></a></p>
				</div>
				<div class="col col-xl col-12 d-xl-block collapse" id="wf_hint2">
					<p class="text-secondary"><i><?php echo esc_html(__('Normally, WP Fast Total Search will auto index any new post or post changes even if you disabled the previous option. Disabling this option will completely stop all plugin functions. However, you probably have to do a full index rebuild, if you activate the plugin again.', 'fulltext-search')); ?></i><br>
					<?php echo wp_kses(__('<strong>WARNING</strong>: Disabling this option is NOT recommended!', 'fulltext-search'), array('strong' => array(), 'b' => array())); ?></p>
				</div>
			</div>

			<div class="row">
				<div class="col fixed-200 font-weight-bolder">
				</div>
				<div class="col fixed-150 font-weight-bolder">
					<button type="button" class="btn btn-info btn-sm wpfts_btn_rebuild" name="wpfts_btn_rebuild" data-confirm="<?php echo esc_attr(__('This action will completely rebuild the search index completely, which could take some time. Are you sure?', 'fulltext-search')); ?>" data-rebuild_nonce="<?php echo wp_create_nonce('index_rebuild_nonce'); ?>"><?php echo esc_html(__('Rebuild Index', 'fulltext-search')); ?></button>
					<span class="wpfts_show_resetting"><img src="<?php echo esc_url($wpfts_core->root_url); ?>/style/waiting16.gif" alt="">&nbsp;<?php echo esc_html(__('Resetting', 'fulltext-search')); ?></span>
				</div>
				<div class="col d-xl-none text-right">
					<p><a data-toggle="collapse" href="#wf_hint3" role="button" aria-expanded="false" aria-controls="wf_hint3"><i class="fa fa-info-circle"></i></a></p>
				</div>
				<div class="col col-xl col-12 d-xl-block collapse" id="wf_hint3">
					<p class="text-secondary"><i><?php echo wp_kses(sprintf(__('Use this button when you need to completely rebuild search index database, for example, when you changed custom <b>wpfts_index_post</b> filter function. Remember that this operation could take a long time. Please refer for %1s documentation %2s for more information.', 'fulltext-search'), '<a href="'.esc_url($wpfts_core->_wpfts_domain.$wpfts_core->_documentation_link).'" target="_blank">', '</a>'), array('b' => array(), 'a' => array('href' => array(), 'target' => array()))); ?></i></p>
				</div>
			</div>

			<div class="row">
				<div class="col col-12 mb-3">
					<hr>
					<h5><?php echo esc_html(__('Experimental Options', 'fulltext-search')); ?></h5>
				</div>
			</div>

			<div class="row">
				<div class="col fixed-200 font-weight-bolder">
					<?php echo esc_html(__('Use Theme Compatibility Hook', 'fulltext-search')); ?>
				</div>
				<div class="col fixed-150">
					<?php
					WPFTS_Htmltools::displayLabelledCheckbox('wpfts_is_use_theme_compat', 1, __('Enabled', 'fulltext-search'), $is_use_theme_compat);
					?>
				</div>
				<div class="col d-xl-none text-right">
					<p><a data-toggle="collapse" href="#wf_hint9" role="button" aria-expanded="false" aria-controls="wf_hint9"><i class="fa fa-info-circle"></i></a></p>
				</div>
				<div class="col col-xl col-12 d-xl-block collapse" id="wf_hint9">
					<p><?php echo esc_html(__('Current theme', 'fulltext-search')).': '.$theme_string; ?></p>
					<p class="text-secondary"><i><?php echo esc_html(__('Using theme compatibility hook allows WPFTS to virtually patch your current theme so it become compatible with WPFTS special features, for example, display Smart Excerpts. Your theme files become not modified.', 'fulltext-search')); ?></i></p>
				</div>
			</div>
			
			<div class="row">
				<div class="col fixed-200 font-weight-bolder">
					<?php echo esc_html(__('Use in WP Admin', 'fulltext-search')); ?>
				</div>
				<div class="col fixed-150">
					<?php
					WPFTS_Htmltools::displayLabelledCheckbox('wpfts_is_wpadmin', 1, __('Enabled', 'fulltext-search'), $is_wpadmin);
					?>
				</div>
				<div class="col d-xl-none text-right">
					<p><a data-toggle="collapse" href="#wf_hint4" role="button" aria-expanded="false" aria-controls="wf_hint4"><i class="fa fa-info-circle"></i></a></p>
				</div>
				<div class="col col-xl col-12 d-xl-block collapse" id="wf_hint4">
					<p class="text-secondary"><i><?php echo esc_html(__('You can let the WPFTS plugin make searches inside WP Admin, however, this is an EXPERIMENTAL feature and can make some issues.', 'fulltext-search')); ?></i></p>
				</div>
			</div>
			
			<div class="row">
				<div class="col fixed-200 font-weight-bolder">
					<?php echo esc_html(__('Use for Blocks', 'fulltext-search')); ?>
				</div>
				<div class="col fixed-150">
					<?php
					WPFTS_Htmltools::displayLabelledCheckbox('wpfts_is_wpblocks', 1, __('Enabled', 'fulltext-search'), $is_wpblocks);
					?>
				</div>	
				<div class="col d-xl-none text-right">
					<p><a data-toggle="collapse" href="#wf_hint8" role="button" aria-expanded="false" aria-controls="wf_hint8"><i class="fa fa-info-circle"></i></a></p>
				</div>
				<div class="col col-xl col-12 d-xl-block collapse" id="wf_hint8">
					<p class="text-secondary"><i><?php echo esc_html(__('Some modern (block) themes are using Gutenberg "wp:query" blocks to render search results. This checkbox should be ON to let WPFTS work with them.', 'fulltext-search')); ?></i></p>
				</div>
			</div>
			
			<div class="row">
				<div class="col fixed-200 font-weight-bolder">
					<?php echo esc_html(__('Fix MariaDB bug', 'fulltext-search')); ?>
				</div>
				<div class="col fixed-150">
					<?php
					WPFTS_Htmltools::displayLabelledCheckbox('wpfts_is_fixmariadb', 1, __('Enabled', 'fulltext-search'), $is_fixmariadb);
					?>
				</div>
				<div class="col d-xl-none text-right">
					<p><a data-toggle="collapse" href="#wf_hint5" role="button" aria-expanded="false" aria-controls="wf_hint5"><i class="fa fa-info-circle"></i></a></p>
				</div>
				<div class="col col-xl col-12 d-xl-block collapse" id="wf_hint5">
					<p class="text-secondary"><i><?php echo wp_kses(sprintf(__('The server MariaDB v10.3+ has a known bug %s where searches may sometimes give incorrect results or no results at all. This option fixes the problem by disabling the corresponding MariaDB algorithm. The option is irrelevant if your hosting uses a MySQL server.', 'fulltext-search'), '<a href="https://jira.mariadb.org/browse/MDEV-21614" target="_blank">#21614</a>'), array('a' => array('href' => array(), 'target' => array()))); ?></i></p>
				</div>
			</div>
			
			<div class="row">
				<div class="col fixed-200 font-weight-bolder">
					<?php echo esc_html(__('Enable Index Optimizer', 'fulltext-search')); ?>
				</div>
				<div class="col fixed-150">
					<?php
					WPFTS_Htmltools::displayLabelledCheckbox('wpfts_is_optimizer', 1, __('Enabled', 'fulltext-search'), $is_optimizer);
					?>
				</div>
				<div class="col d-xl-none text-right">
					<p><a data-toggle="collapse" href="#wf_hint6" role="button" aria-expanded="false" aria-controls="wf_hint6"><i class="fa fa-info-circle"></i></a></p>
				</div>
				<div class="col col-xl col-12 d-xl-block collapse" id="wf_hint6">
					<p class="text-secondary"><i><?php echo esc_html(__('The Index Optimizer may increase search speed by 30-50%, but it takes additional time for indexing and consumes an essential part of DB space, CPU, and RAM. If you have any hosting limitations on those resources, do not enable this option.', 'fulltext-search')); ?></i></p>
				</div>
			</div>
			
			<div class="sf_savebtn_place"></div>
		</div>
	</div>
	<?php
