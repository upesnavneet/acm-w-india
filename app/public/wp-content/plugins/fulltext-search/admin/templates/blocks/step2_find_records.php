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

$deflogic = $wpfts_core->get_option('deflogic');

$deflogic_data = array(
	0 => 'AND',
	1 => 'OR',
);

?><div class="mb-2 mt-2 wpfts_smartform" data-name="form_step2_find_records">
	<?php wp_nonce_field( 'wpfts_options_step2_find_records', 'wpfts_options-nonce_step2_find_records' ); ?>
		<div class=""><div class="row"><span class="col-9"><h5><?php echo esc_html(__('STEP #2: Find Records', 'fulltext-search')); ?></h5></span><span class="col-3 text-right sf_savelink_place"></span></div></div>
		<div class="bg-light">
			<p>
			<?php echo esc_html(__('Then, the algorithm effectively scans the index to find those entries in which the words (or parts of them) mentioned in the query are found.', 'fulltext-search')); ?>
			</p>
			<div class="row">
				<div class="col-12">
					<div class="bd-callout bg-white">
			<div class="row">
				<div class="col fixed-200 font-weight-bolder">
					<?php echo esc_html(__('Default Search Logic', 'fulltext-search')); ?>
				</div>
				<div class="col fixed-150">
					<div class="wpfts_search_logic_group">
					<?php
						WPFTS_Htmltools::displayRadioGroup('wpfts_deflogic', $deflogic_data, $deflogic, array());
					?>
					</div>
				</div>	
				<div class="col d-xl-none text-right">
					<p><a data-toggle="collapse" href="#wf_hint_deflogic" role="button" aria-expanded="false" aria-controls="wf_hint_deflogic"><i class="fa fa-info-circle"></i></a></p>
				</div>
				<div class="col col-xl col-12 d-xl-block collapse" id="wf_hint_deflogic">
					<p class="text-secondary"><i><?php echo esc_html(__('This option tells the search engine whether all query words should contain in the found post (AND) or any of these words (OR).', 'fulltext-search')); ?></i></p>
				</div>
			</div>

			<div class="row">
				<div class="col fixed-200 font-weight-bolder">
					<?php echo esc_html(__('Deeper Search', 'fulltext-search')); ?>
				</div>
				<div class="col fixed-150">
					<?php
						$dps = intval($wpfts_core->get_option('deeper_search'));
						WPFTS_Htmltools::displayLabelledCheckbox('wpfts_deeper_search', 1, __('Enabled', 'fulltext-search'), $dps);
					?>
				</div>	
				<div class="col d-xl-none text-right">
					<p><a data-toggle="collapse" href="#wf_hint_deepersearch" role="button" aria-expanded="false" aria-controls="wf_hint_deepersearch"><i class="fa fa-info-circle"></i></a></p>
				</div>
				<div class="col col-xl col-12 d-xl-block collapse" id="wf_hint_deepersearch">
					<p class="text-secondary"><i><?php echo esc_attr(__('Enables searching substrings in the middle of words. This is much slower than usual search, so use it with care. Keep it disabled if you have any issues with MySQL performance.', 'fulltext-search')); ?></i></p>
				</div>
			</div>
			<?php
			
			ob_start();
			?>
			<div class="wpfts_pro_only">
			<div class="row">
				<div class="col-12">
					<p><i><?php echo wp_kses(sprintf(__('Options below available in %s Pro version %s only', 'fulltext-search'), '<a href="https://fulltextsearch.org/" target="_blank">', '</a>'), array('a' => array('href' => array(), 'target' => array()))); ?></i></p>
				</div>
			</div>

			<div class="row">
				<div class="col fixed-200 font-weight-bolder">
					<?php echo esc_html(__('Search in File Contents', 'fulltext-search')); ?>
				</div>
				<div class="col fixed-150">
					<label for="lchwpfts_display_attachments"><input type="checkbox" value="1" id="lchwpfts_display_attachments" disabled="disabled">&nbsp;<span><?php echo esc_html(__('Enabled', 'fulltext-search')); ?></span></label>
				</div>	
				<div class="col d-xl-none text-right">
					<p><a data-toggle="collapse" href="#wf_hint_filecontents" role="button" aria-expanded="false" aria-controls="wf_hint_filecontents"><i class="fa fa-info-circle"></i></a></p>
				</div>
				<div class="col col-xl col-12 d-xl-block collapse" id="wf_hint_filecontents">
					<p class="text-secondary"><i><?php echo esc_html(__('When checked on, WPFTS will search attachments by contents and show them in search results like usual posts.', 'fulltext-search')); ?></i></p>
				</div>
			</div>

			<?php
			// Mime types justifications

			$mtg = $wpfts_core->getMimetypeGroups();
			$mt_keys = array();
			foreach ($mtg as $k => $d) {
				if (count($d[1]) > 0) {
					foreach ($d[1] as $dd) {
						$mt_keys[$dd] = $k;
					}
				}
			}

			$enabled_mt = wp_get_mime_types();

			$used_mt = $wpfts_core->GetUsedMimetypes();

			// Detect non-registered mime-types
			$non_registered = $used_mt;
			foreach ($enabled_mt as $k => $d) {
				if (isset($non_registered[$d])) {
					unset($non_registered[$d]);
				}
			}
			foreach ($non_registered as $k => $d) {
				$enabled_mt[$k] = $k;
				$mt_keys[$k] = 11;
			}

			$listed_mt = array();
			
			$mt_stat = array();
			$mt_used_stat = array();
			foreach ($enabled_mt as $k => $d) {
				$ks = 10;
				$stt = &$mt_stat;
				$nn = 0;
				if (isset($mt_keys[$d])) {
					$ks = $mt_keys[$d];
				}
				if (isset($used_mt[$d])) {
					$stt = &$mt_used_stat;
					$nn = $used_mt[$d];
				}
				if (!isset($stt[$ks])) {
					$stt[$ks] = array();
				}
				$stt[$ks][$k] = array($d, $nn);
			}

			$render_group = function($group_id, $mt_stat) use ($mtg, $listed_mt) 
			{
				if (isset($mt_stat[$group_id]) && (count($mt_stat[$group_id]) > 0)) {
					?>
					<tr>
						<td><b><?php echo esc_html(__($mtg[$group_id][0])); ?></b></td>
						<td>
						<?php 
						foreach ($mt_stat[$group_id] as $k => $tt) {
							$d = $tt[0];
							$nn = $tt[1];
							$key = 'ft_'.str_replace('|', '_', $k);
							$key_name = ($group_id != 11) ? mb_strtoupper(str_replace('|', ', ', $k)) : str_replace('|', ', ', $k);
						?>
						<div class="wpfts_mt_item"><label for="<?php echo $key; ?>" title="<?php echo htmlspecialchars($d); ?>"><input type="checkbox" value="<?php echo htmlspecialchars($d); ?>" id="<?php echo $key; ?>" disabled="disabled"> <?php echo htmlspecialchars($key_name); if ($nn > 0) { echo ' ('.$nn.')'; } ?></label></div>
						<?php
						}
						?>
						</td>
				</tr>
				<?php
			}
		};

		?><div class="ft_limit_filetypes">
			<div class="row">
				<div class="col fixed-200 font-weight-bolder">
					<?php echo esc_html(__('Limit File Types', 'fulltext-search')); ?>
				</div>
				<div class="col fixed-150">
					<div style="padding: 0px 0px 15px 0px;"><label for="ft_mt_all"><input type="checkbox" id="ft_mt_all" value="1" disabled="disabled"> <?php echo esc_html(__('Allow All', 'fulltext-search')); ?></label></div>
				</div>
			</div>
			<div class="row">
				<div class="col fixed-200 d-none d-xl-block">
				</div>
				<div class="col">
					<p><i><?php echo esc_html(__('Alternatively, you can allow to show attachments with these file types only', 'fulltext-search')); ?></i></p>

					<div class="ft_used_mt">
					<h5><?php echo esc_html(__('Currently used file types (amount of files found)', 'fulltext-search')); ?></h5>
					<table class="ft_used_mt_table ft_mt_table table table-striped">
					<col width="150">
					<col>
					<?php
					foreach (array(3,7,5,6,1,2,4,8,9,10,11) as $dd) {
						$render_group($dd, $mt_used_stat);
					}
					?>
					</table>
					<a href="#" class="ft_mt_show_extra_mimetypes"><?php echo esc_html(__('Show All File Types &gt;&gt;', 'fulltext-search')); ?></a>
				</div>
				<div class="ft_selector" style="display:none;">
					<h5><?php echo esc_html(__('Other File Formats (not used yet on this website)', 'fulltext-search')); ?></h5>
					<table class="ft_selector_table ft_mt_table table table-striped">
					<col width="150">
					<col>
					<?php
					foreach (array(3,7,5,6,1,2,4,8,9,10,11) as $dd) {
						$render_group($dd, $mt_stat);
					}
					?>
					</table>
				</div>
				</div>
			</div>
			</div>

		</div>
					<?php
					
					echo apply_filters('wpfts_out_mimetype_part', ob_get_clean());
					
					?>
					</div>
				</div>
			</div>
			<div class="sf_savebtn_place"></div>
		</div>
	</div>
<?php

