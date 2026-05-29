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

$status = $wpfts_core->get_status();

?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="background-size: cover;background: linear-gradient(0.28turn, #fff 20%, #6cb6e3 25%);">
	<div class="col-6 text-secondary" style="flex: 0 0 280px; min-width: 280px;">
		<div class="wpfts_logo_div">
			<div class="wpfts_logo_version"><?php echo esc_html($version_text); ?></div>
			<?php echo wp_kses(apply_filters('wpfts_out_logomark', ''), array('div' => array('style' => array(), 'class' => array()))); ?>
			<img src="<?php echo esc_url($wpfts_core->root_url); ?>/style/wpfts-logo-transparent.png" alt="" style="height: 100px; width: 220px;" class="d-inline-block align-top" width="220" height="100">
		</div>
		<div class="text-left wpfts_izfs_row" style="padding-left: 10px;">
			<span class="wpfts_data_isdisabled" style="display: <?php echo esc_attr($status['enabled'] ? 'none' : 'inline-block'); ?>;">
				<span class="wpfts_status_bullet wpfts_red" title="<?php echo esc_attr(__('The Search Index was disabled in configuration.', 'fulltext-search')); ?>">&#9679;</span>&nbsp;<b style="color: #fcc;"><?php echo esc_attr(__('Disabled', 'fulltext-search')); ?></b>
			</span>
			<span class="wpfts_data_isindexready" style="display: <?php echo esc_attr(($status['enabled'] && $status['index_ready']) ? 'inline-block' : 'none'); ?>;">
				<span class="wpfts_status_bullet wpfts_green">&#9679;</span>&nbsp;<b><?php echo esc_attr(__('Active', 'fulltext-search')); ?></b>
			</span>
			<span class="wpfts_data_isindexready_not" style="display: <?php echo esc_attr(($status['enabled'] && (!$status['index_ready'])) ? 'inline-block' : 'none'); ?>;">
				<span class="wpfts_status_bullet wpfts_yellow" title="<?php echo esc_attr(__('The Search Index will be activated after the indexing process is complete.', 'fulltext-search')); ?>">&#9679;</span>&nbsp;<b><?php echo esc_html(__('Awaiting', 'fulltext-search')); ?></b>
			</span>
		</div>
	</div>
	<div class="col-6 text-white" style="flex: 1 280px;max-width: calc(100% - 280px);padding-right:0;">
		<?php			
			// Title
		?>
		<div class="wpfts_top_indexstatus">
			<div>
				<h6><?php echo esc_html(__('Indexing Engine Status', 'fulltext-search')); ?></h6>
			<?php
		
				// Search engine status
				// @todo
		
				// Get status values
				$is_ok = false;
				//$is_slow_warning = false;
				$is_indexing = false;
				$is_optimization = false;
				$percent = 0;
				$percent2 = 0;
				$is_pending = false;
				$is_records = false;
				$is_index_enabled = false;
		
				if ($status['autoreindex']) {
		
					$is_index_enabled = true;
					//$is_slow_warning = true;
		
					//$percent = (0.0 + intval($status['n_actual'])) * 100 / (intval($status['n_inindex']) + intval($status['n_pending']));
					if (intval($status['n_inindex']) > 0) {
						$percent = (0.0 + intval($status['n_actual'])) * 100 / (intval($status['n_inindex']));
						$percent = (intval($status['n_actual']) < intval($status['n_inindex'])) ? min(99.99, $percent) : $percent;
					} else {
						$percent = 0;
					}
		
					if ($status['nw_total'] > 0) {
						$percent2 = sprintf('%.2f', $status['nw_act'] * 100 / $status['nw_total']);
					} else {
						$percent2 = 0;
					}
		
					if (($status['n_pending'] > 0) || ($status['n_tw'] > 0)) {
						// Main indexing mode
						$is_pending = true;
						$is_indexing = true;
					} else {
						$is_records = true;
						$is_indexing = false;
						if ($status['nw_act'] < $status['nw_total']) {
							$is_optimization = true;
							//$is_slow_warning = true;
						} else {
							$is_optimization = false;
							if ($status['n_tw'] < 1) {
								$is_ok = true;
								//$is_slow_warning = false;
							}
						}
		
					}
				} else {
					$is_index_enabled = false;
				}
		
				$is_pause = intval($status['is_pause']);
		
				ob_start();
				?>
					<div style="display:block;position:absolute;right:0px;">
						<button type="button" class="btn btn-default btn-sm wpfts_set_pause_on wpfts_data_pause_btn_on" style="color:#888;display:<?php echo esc_attr($is_pause ? 'none' : 'inline-block'); ?>;" title="<?php echo esc_attr(__('Pause', 'fulltext-search')); ?>"><i class="fa fa-pause"></i></button> 
						<button type="button" class="btn btn-default btn-sm wpfts_set_pause_off wpfts_data_pause_btn_off" style="color:green;display:<?php echo esc_attr($is_pause ? 'inline-block' : 'none'); ?>;" title="<?php echo esc_attr(__('Continue Indexing', 'fulltext-search')); ?>"><i class="fa fa-play"></i></button>
						<div style="clear:both;"></div>
					</div>
				<?php
		
				$pause_block = ob_get_clean();
				$pause_block_kses = array(
					'div' => array('style' => array()),
					'button' => array('type' => array(), 'class' => array(), 'style' => array(), 'title' => array()),
					'i' => array('class' => array()),
				);
		
				// Block Switchers
				$data_is_ok = ($is_ok && (!$is_pause)) ? 'block' : 'none';
				$data_is_paused_st = ($is_ok && $is_pause) ? 'block' : 'none';
				$data_is_index_disabled = !$is_index_enabled ? 'block' : 'none';
				$data_is_indexing = ($is_indexing && (!$is_pause)) ? 'block' : 'none';
				$data_is_indexing_paused = ($is_indexing && $is_pause) ? 'block' : 'none';
				$data_is_optimization = ($is_optimization && (!$is_pause)) ? 'block' : 'none';
				$data_is_optimization_paused = ($is_optimization && $is_pause) ? 'block' : 'none';
		
				$data_is_pending = $is_pending ? 'block' : 'none';
				$data_is_records = $is_records ? 'block' : 'none';
		
				$data_is_esttime = ($is_indexing) ? 'block' : 'none';
				$data_is_ready4changes = ((!$is_indexing) && (!$is_pause)) ? 'block' : 'none';
				$data_is_tempstopped = ((!$is_indexing) && $is_pause) ? 'block' : 'none';
		
				$data_est_time = $status['est_time'];
		
				$data_et_paused = ($is_indexing && $is_pause) ? 'inline-block' : 'none';
				$data_et_counting = ($is_indexing && (!$is_pause) && ($status['est_time'] == '--:--:--')) ? 'inline-block' : 'none';
				$data_et_esttime = ($is_indexing && (!$is_pause) && ($status['est_time'] != '--:--:--')) ? 'inline-block' : 'none';
		
				// Fill the template
				?>
				<div class="wpfts_ixst_body" id="wpfts_status_box">
				<div class="wpfts_ixst_row">
					<span class="wpfts_data_is_ok" style="display: <?php echo esc_attr($data_is_ok); ?>;">
						<span class="wpfts_status_bullet wpfts_green">&#9679;</span>&nbsp;<?php echo esc_html(__('Idle', 'fulltext-search')); ?>
					</span>
					<span class="wpfts_data_is_paused_st" style="display: <?php echo esc_attr($data_is_paused_st); ?>;">
						<span class="wpfts_status_bullet wpfts_yellow"><i class="fa fa-pause" style="font-size: 0.7em;"></i></span>&nbsp;<?php echo esc_html(__('Paused', 'fulltext-search')); ?>
					</span>
					<span class="wpfts_data_is_index_disabled" style="display: <?php echo esc_attr($data_is_index_disabled); ?>;">
						<span class="wpfts_status_bullet wpfts_red">&#9679;</span>&nbsp;<?php echo esc_html(__('Disabled', 'fulltext-search')); ?>
					</span>
					<span class="wpfts_data_is_indexing" style="display: <?php echo esc_attr($data_is_indexing); ?>;">
						<img src="<?php echo esc_url($wpfts_core->root_url); ?>/style/waiting16_y.gif" alt="" title="<?php echo esc_html(__('Indexing is in progress', 'fulltext-search')); ?>">&nbsp;<?php echo esc_html(__('Indexing', 'fulltext-search')); ?>...&nbsp;<span class="wpfts_data_percent"><?php echo esc_attr(sprintf('%.2f', $percent).'%'); ?></span>
					</span>
					<span class="wpfts_data_is_indexing_paused" style="display: <?php echo esc_attr($data_is_indexing_paused); ?>;">
						<span class="wpfts_status_bullet wpfts_yellow" title="<?php echo esc_attr(__('Indexing is temporary stopped', 'fulltext-search')); ?>"><i class="fa fa-pause" style="font-size: 0.7em;"></i></span>&nbsp;<?php echo esc_html(__('Indexing is paused', 'fulltext-search')); ?>&nbsp;(<span class="wpfts_data_percent"><?php echo esc_html(sprintf('%.2f', $percent).'%'); ?></span>)
					</span>
					<span class="wpfts_data_is_optimization" style="display: <?php echo esc_attr($data_is_optimization); ?>;">
						<img src="<?php echo esc_url($wpfts_core->root_url); ?>/style/waiting16_y.gif" alt="" title="<?php echo esc_attr(__('Optimizing the index', 'fulltext-search')); ?>">&nbsp;<?php echo esc_html(__('Optimizing', 'fulltext-search')); ?>...&nbsp;<span class="wpfts_data_percent2"><?php echo esc_html(sprintf('%.2f', $percent2).'%'); ?></span>
					</span>
					<span class="wpfts_data_is_optimization_paused" style="display: <?php echo esc_attr($data_is_optimization_paused); ?>;">
						<span class="wpfts_status_bullet wpfts_yellow" title="<?php echo esc_attr(__('Optimizing is temporary stopped', 'fulltext-search')); ?>"><i class="fa fa-pause" style="font-size: 0.7em;"></i></span>&nbsp;<?php echo esc_html(__('Optimizing is paused', 'fulltext-search')); ?>&nbsp;(<span class="wpfts_data_percent2"><?php echo esc_html(sprintf('%.2f', $percent2).'%'); ?></span>)
					</span>
		
				</div>
				<?php
		
				// Pending or Total
				?>
				<div class="wpfts_ixst_row">
					<span class="wpfts_data_is_pending" style="display:<?php echo esc_attr($data_is_pending); ?>">
						<?php echo esc_html(__('Pending', 'fulltext-search')); ?>: <b><span id="wpfts_st_pending" class="wpfts_data_n_pending"><?php echo esc_html($status['n_pending']); ?></span></b> <?php echo esc_html(__('of', 'fulltext-search')); ?> <b><span id="wpfts_st_records" class="wpfts_data_n_inindex"><?php echo esc_html($status['n_inindex']); ?></span></b>
					</span>
					<span class="wpfts_data_is_records" style="display:<?php echo esc_attr($data_is_records); ?>">
						<?php echo esc_html(__('Records', 'fulltext-search')); ?>: <b><span id="wpfts_st_records2" class="wpfts_data_n_inindex"><?php echo esc_html($status['n_inindex']); ?></span></b>
					</span>
				</div>
				<?php
				// ETA and pause button
		
				?>
				<div class="wpfts_ixst_row" style="position: relative;">
					<?php echo wp_kses($pause_block, $pause_block_kses); ?>
					<span class="wpfts_data_is_esttime" style="display: <?php echo esc_attr($data_is_esttime); ?>">
						<?php echo esc_html(__('Est. Time: ', 'fulltext-search')); ?>
						<span class="wpfts_st_esttime wpfts_data_est_time wpfts_data_et_esttime" style="display: <?php echo esc_attr($data_et_esttime); ?>"><?php echo esc_html($data_est_time); ?></span>
						<span class="wpfts_data_et_paused" style="display: <?php echo esc_attr($data_et_paused); ?>">[<?php echo esc_html(__('Paused', 'fulltext-search')); ?>]</span>
						<span class="wpfts_data_et_counting" style="display: <?php echo esc_attr($data_et_counting); ?>"><?php echo esc_html(__('Counting...', 'fulltext-search')); ?></span>
					</span>
					<span class="wpfts_data_is_ready4changes" style="display: <?php echo esc_attr($data_is_ready4changes); ?>"><i>...<?php echo esc_html(__('Ready for changes', 'fulltext-search')); ?>...</i></span>
					<span class="wpfts_data_is_tempstopped" style="color:#ff0;display: <?php echo esc_attr($data_is_tempstopped); ?>"><i>...<?php echo esc_html(__('Temporary stopped', 'fulltext-search')); ?>...</i></span>
				</div>
				</div>
			</div>
		</div>
		<?php
		
		?>
	</div>
</nav>
<?php 
