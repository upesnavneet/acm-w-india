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

$version_text = 'v'.WPFTS_VERSION.'';

?>
<div class="wrap">
	<h2><?php echo esc_html(__('WP Fast Total Search Options', 'fulltext-search'));?></h2>
	<div class="bs-wpfts">

	<?php

	// Do we need to show an invitation message?
	$upds = $wpfts_core->GetUpdates();

	if ($upds['is_new'] && $wpfts_core->is_wpfts_settings_page) {
	?>
	<div class="row">
		<div class="col-12">
	<div class="notice notice-warning wpfts-notice">
		<hr>
		<?php

		$s1 = sprintf(__('<h2>Important Notice Before You Start</h2>
		<p>Everything is ready to index the contents of your site. When creating a Search Index, the plugin will use its own tables in the database, no your data will be affected.</p>
		<p>The process may take a long time (it depends on the amount of data on the site) and the site may work a little slower. There is no reason to worry - this slowness will end with the end of the indexing process. To reduce the time to build the index, please <b>do not close</b> the plugin settings page.</p>
		<p>If you didn’t install WPFTS Add-ons and didn’t set up your own <code>wpfts_index_post</code> hook, then this time only the Titles and the main Content of the publications will be included in the index. If you want other data to participate in the search (such as <b>post meta data</b>), now is the time to read the %1s WPFTS Documentation %2s and make the necessary changes.</p>

		<p>We wish you a pleasant work with the WP Fast Total Search plugin.</p>
		<p>We also thank you for your %3s comments and suggestions %4s.</p>
		<p><i>WPFTS plugin development team.</i></p>', 'fulltext-search'), 
			'<a href="https://fulltextsearch.org/documentation" target="_blank">',
			'</a>',
			'<a href="https://fulltextsearch.org/contact/" target="_blank">',
			'</a>'
		);
		$intro_text = apply_filters('wpfts_intro_text', $s1);

		echo wp_kses($intro_text, array(
			'h2' => array(),
			'p' => array(),
			'a' => array(
				'href' => array(),
				'target' => array(),
			),
			'b' => array(),
			'i' => array(),
			'br' => array(),
		));

		?>
		<p style="text-align: center;">
			<button type="button" class="button-primary btn_start_indexing" data-rebuild_nonce="<?php echo esc_html(wp_create_nonce('index_rebuild_nonce')); ?>"><?php echo esc_html(__('Start Indexing', 'fulltext-search')); ?></button>&nbsp;<span class="wpfts_show_resetting"><img src="<?php echo esc_url($wpfts_core->root_url); ?>/style/waiting16.gif" alt="">&nbsp;<?php echo esc_html(__('Resetting', 'fulltext-search')); ?></span>
		</p>
		<hr>
	</div>
			</div>
		</div>
	<?php
	}

	require dirname(__FILE__).'/templates/blocks/status_box_top.php';


	global $wpfts_core;

	$irules_stats = (array)$wpfts_core->getCurrentIRulesStats();

	$n_req_reset = isset($irules_stats['n_req_reset']) ? intval($irules_stats['n_req_reset']) : 0;

	if ($n_req_reset > 0) {
		?>
		<div>
			<div class="bd-callout bd-callout-warning bg-white">
				<p><?php echo wp_kses(sprintf(__('Important warning: There are currently %1s entries in the search index that do not meet the %2s indexing rules%3s. You should run a partial index upgrade on these entries to resolve this warning.', 'fulltext-search'), '<b>'.$n_req_reset.'</b>', '<a href="/wp-admin/admin.php?page=wpfts-options-indexing-engine">', '</a>'), array('p' => array(), 'b' => array(), 'a' => array('href' => array(), 'br' => array()))); ?></p>
				<div class="btn btn-sm btn-warning wpfts_btn_upgrade_index" data-upgradeindex_nonce="<?php echo esc_html(wp_create_nonce('upgradeindex_nonce')); ?>"><?php echo esc_html(__('Upgrade Index', 'fulltext-search')); ?></div>
			</div>
		</div>
		<?php
	}
	?>
	<div class="row">
		<div class="col-xl-3 col-lg-4 col-md-5 col-1 wpfts_col1_60" style="padding-right: 0;">
			<ul class="nav nav-tabs flex-column wpfts_tabs">
			<?php

	$tabs = array(
		'wpfts-options' => array(__('Main Configuration', 'fulltext-search'), 'fa fa-cog'),
		'wpfts-options-indexing-engine' => array(__('Indexing Engine Settings', 'fulltext-search'), 'fa fa-table'),
		'wpfts-options-search-relevance' => array(__('Search & Output', 'fulltext-search'), 'fa fa-search'),
		'wpfts-options-sandbox-area' => array(__('Sandbox Area', 'fulltext-search'), 'fa fa-flask'),
		'wpfts-options-analytics' => array(__('Analytics', 'fulltext-search'), 'fa fa-chart-line'),
		//'wpfts-options-addons' => array(__('Addons', 'fulltext-search'), 'fa fa-plus'),
		'wpfts-options-support' => array(__('Support & Docs', 'fulltext-search'), 'fa fa-life-ring'),
	);

	$ps1_start = $wpfts_core->get_option('ps1_start_dt');
	if ((strlen($ps1_start) > 0) && ((strtotime($ps1_start) + 24 * 3600 * 14) < current_time('timestamp'))) {
		$tabs['wpfts-options-ps'] = array(__('Partnership', 'fulltext-search'), 'far fa-handshake');
	}

	$tabs = apply_filters('wpfts_admin_tabs', $tabs);

	$tt = array();

	$kses_params = array(
		'i' => array('class' => array()),
		'b' => array(),
		'u' => array(),
		'sub' => array(),
		'sup' => array(),
	);

	$current_tab = isset($_GET['page']) ? $_GET['page'] : 'wpfts-options';
	foreach ($tabs as $tab_key => $tab_caption) {
		$active = ($current_tab == $tab_key) ? ' active' : '';
		echo '<li class="nav-item" data-name="'.esc_attr($tab_key).'"><a class="nav-link'.esc_attr($active).'" href="?page='.esc_attr($tab_key).'" id="wpfts_mainmenu_tab_'.esc_attr($tab_key).'"><i class="'.esc_attr($tab_caption[1]).'"></i><span class="wpfts_menu_text"> '.wp_kses($tab_caption[0], $kses_params).'</span></a></li>';

		// Tab content
		ob_start();
		switch ($tab_key) {
			case 'wpfts-options':
				require dirname(__FILE__).'/templates/main-configuration.php';
				break;
			case 'wpfts-options-indexing-engine':
				require dirname(__FILE__).'/templates/indexing-engine.php';
				break;
			case 'wpfts-options-search-relevance':
				require dirname(__FILE__).'/templates/search-relevance.php';
				break;
			case 'wpfts-options-sandbox-area':
				require dirname(__FILE__).'/templates/sandbox-area.php';
				break;
			case 'wpfts-options-analytics':
				require dirname(__FILE__).'/templates/analytics.php';
				break;
			case 'wpfts-options-addons':
				require dirname(__FILE__).'/templates/addons.php';
				break;
			case 'wpfts-options-support':
				require dirname(__FILE__).'/templates/support.php';
				break;
			case 'wpfts-options-ps':
				require dirname(__FILE__).'/templates/ps-page.php';
				break;
			default:
				// Custom tab added by addon
				if (isset($tab_caption[2])) {
					if (is_callable($tab_caption[2])) {
						echo call_user_func($tab_caption[2]);
					} else {
						if (is_string($tab_caption[2]) && (function_exists($tab_caption[2]))) {
							echo call_user_func($tab_caption[2]);
						}
					}
				}
				break;
		}
		$tab_content = ob_get_clean();
		$tt[] = '<div class="tab-pane'.$active.'" role="tabpanel" data-tabname="'.$tab_key.'">'.$tab_content.'</div>';
	}
	?>
	</ul>
	</div>
	<div class="col-xl-9 col-lg-8 col-md-7 col-11 wpfts_col11_60" style="padding-left: 0;">
		<div class="tab-content wpfts_tabs_content bg-white p-3">
		<?php echo implode('', $tt); ?>
	</div>
	<script type="text/javascript">
	jQuery(document).ready(function()
	{
		jQuery('ul.wpfts_tabs > li > a').on('click', function(e)
		{
			e.preventDefault();

			var li = jQuery(this).closest('li');
			var sel = li.attr('data-name');
			// Hide all tabs except current one
			jQuery('.tab-content.wpfts_tabs_content > .tab-pane').each(function()
			{
				if (jQuery(this).attr('data-tabname') == sel) {
					jQuery(this).addClass('active');
				} else {
					jQuery(this).removeClass('active');
				}
			});
			// Make tab highlighted
			jQuery('ul.wpfts_tabs > li').each(function()
			{
				if (jQuery(this).attr('data-name') == sel) {
					jQuery('a.nav-link', jQuery(this)).addClass('active');
				} else {
					jQuery('a.nav-link', jQuery(this)).removeClass('active');
				}
			});

			var href = jQuery(this).attr('href');
			// Let's switch URL
			window.history.pushState({'currentUrl': document.location.href, 'tab': sel}, '', href);


			return false;
		});

		window.addEventListener('popstate', function(e)
		{
			// Set previous tab
			if (e.state && e.state.tab) {
				// Set tab
				var sel = e.state.tab;
				// Hide all tabs except current one
				jQuery('.tab-content.wpfts_tabs_content .tab-pane').each(function()
				{
					if (jQuery(this).attr('data-tabname') == sel) {
						jQuery(this).addClass('active');
					} else {
						jQuery(this).removeClass('active');
					}
				});
				// Make tab highlighted
				jQuery('ul.wpfts_tabs li').each(function()
				{
					if (jQuery(this).attr('data-name') == sel) {
						jQuery('a.nav-link', jQuery(this)).addClass('active').focus();
					} else {
						jQuery('a.nav-link', jQuery(this)).removeClass('active');
					}
				});

			}
		}, false);

		window.history.replaceState({'currentUrl': document.location.href, 'tab': jQuery('ul.wpfts_tabs li a.active').closest('li').attr('data-name')}, '', document.location.href);
	});
	</script>
		</div>
	</div>
</div>

</div>