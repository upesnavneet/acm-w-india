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

$indexing_rules_ruletable = function($list, $type, $singles_stats)
{
	global $wpfts_core;

	ob_start();
	?>
	<table class="table table-sm table-bordered">
	<tr>
		<th><?php echo esc_html(__('#', 'fulltext-search')); ?></th>
		<th><?php echo esc_html(__('On', 'fulltext-search')); ?></th>
		<th><?php echo esc_html(__('Name / Record Filter', 'fulltext-search')); ?></th>
		<th><?php echo esc_html(__('Description', 'fulltext-search')); ?></th>
		<th><?php echo esc_html(__('# Records', 'fulltext-search')); ?></th>
	</tr>
	<?php
	foreach ($list as $item) {
	?>
	<tr>
		<td><span><?php echo esc_html(isset($item['id']) ? '#'.$item['id'] : ''); ?></span><a href="#" title="Check Details"><span class="btn btn-sm"><i class="fa fa-eye"></i></span></a></td>
		<td><?php 
			/*
				$content_open_shortcodes = intval($wpfts_core->get_option('content_open_shortcodes'));
				WPFTS_Htmltools::displayLabelledCheckbox('wpfts_content_open_shortcodes', 1, '', $content_open_shortcodes); 
			*/
			echo esc_html(__('Yes', 'fulltext-search'));
			?>
		</td>
		<td>
			<?php
			if (isset($item['rule_snap']['name']) && (strlen($item['rule_snap']['name']) > 0)) {
				?><h6><?php echo esc_html($item['rule_snap']['name']); ?></h6><?php
			}
			?>
			<?php
			if (isset($item['rule_snap']['defined_by']) && (strlen($item['rule_snap']['defined_by']) > 0)) {
				?><small><?php echo esc_html(__('Defined in', 'fulltext-search')); ?>: <?php echo esc_html($item['rule_snap']['defined_by']); ?></small><?php
			}

			$rls = new WPFTS_Indexing_Rules();

			list($err, $prep) = $rls->parseExpr($item['rule_snap']['filter']);

			list($err2, $expr_html) = $rls->makeHtml($prep, 'wpfts_expr_');

			?>
			<p><span class="wpfts_rule_query"><?php echo $expr_html; ?></span></p>
		</td>
		<td>
			<?php
			if (isset($item['rule_snap']['description']) && (strlen($item['rule_snap']['description']) > 0)) {
				?><p><?php echo esc_html($item['rule_snap']['description']); ?></p><?php
			}

			// Create short data movement map
			$src_s = array();
			$dest_s = array();

			if (isset($item['rule_snap']['actions']) && (is_array($item['rule_snap']['actions']))) {
				foreach ($item['rule_snap']['actions'] as $dd) {
					if (isset($dd['src'])) {
						$src_s[] = $dd['src'];
					}
					if (isset($dd['dest'])) {
						$dest_s[] = '"'.$dd['dest'].'"';
					}
				}	
			}
			if (isset($item['rule_snap']['short']) && (is_array($item['rule_snap']['short']))) {
				foreach ($item['rule_snap']['short'] as $kk => $dd) {
					$src_s[] = $kk;
					foreach ($dd as $d2) {
						$dest_s[] = '"'.$d2.'"';
					}
				}
			}

			$src_s = array_unique($src_s);
			$dest_s = array_unique($dest_s);

			if (count($src_s) > 0) {
				?><p><?php echo esc_html(__('Data Sources', 'fulltext-search')); ?>: <?php echo implode(', ', $src_s); ?></p><?php
			}
			if (count($dest_s) > 0) {
				?><p><?php echo esc_html(__('Clusters', 'fulltext-search')); ?>: <?php echo implode(', ', $dest_s); ?></p><?php
			}

			?>
		</td>
		<td>
			<?php

			$stats_item = isset($singles_stats[$item['id']]) ? $singles_stats[$item['id']] : array();

			$n_total = isset($stats_item['n_total']) ? intval($stats_item['n_total']) : 0;
			$n_valid = isset($stats_item['n_valid']) ? intval($stats_item['n_valid']) : 0;
			$n_indexed = isset($stats_item['n_indexed']) ? intval($stats_item['n_indexed']) : 0;
			$n_pending = $n_total - $n_indexed;

			?><p><?php echo esc_html(__('Affected', 'fulltext-search')); echo ': '; echo $n_total; ?>
			<?php
				if ($n_total - $n_valid > 0) {
					?><br><span class="wpfts_red"><?php echo esc_html(__('Not Valid', 'fulltext-search').': '.($n_total - $n_valid)); ?></span><?php
				}
				if ($n_pending > 0) {
					?><br><span class="wpfts_red"><?php echo esc_html(__('Not Indexed', 'fulltext-search').': '.$n_pending); ?></span><?php
				}
					
			?></p>
		</td>
	</tr>
	<?php
	}
	?>
	</table>
	<?php

	return ob_get_clean();
};

?>
	<div class="wpfts_smartform bg-light" data-name="form_indexingrulesbox">
		<?php wp_nonce_field( 'wpfts_options_indexingrulesbox', 'wpfts_options-nonce_indexingrulesbox' ); ?>
		<div class=""><div class="row"><span class="col-9"><h5><?php echo esc_html(__('Indexing Rules', 'fulltext-search')); ?></h5></span><span class="col-3 text-right sf_savelink_place"></span></div></div>
		<div>
			<p><?php echo esc_html(__('This displays all the rules that WPFTS uses to collect data from WP records and place it in the search index. The rules can be set by you either manually or programmatically via the wpfts_irules_before and wpfts_irules_after hooks. Other plugins and addons can also add their own rules.', 'fulltext-search')); ?></p>
			<div class="row">
				<div class="col-12">
					<div class="bd-callout bg-white">

			<?php

			$all_rules = (array)$wpfts_core->decodeAndSyncIndexRules();
			$irules_stats = (array)$wpfts_core->getCurrentIRulesStats();

//print_r($all_rules);
//print_r($irules_stats);

			$rules_types = array(
				0 => array(),
				1 => array(),
				2 => array(),
			);
			
			foreach ($all_rules as $k => $rule) {
				$type = isset($rule['type']) ? intval($rule['type']) : 1;
				if ($type == 0) {
					$rules_types[0][$k] = $rule;
				} elseif ($type == 2) {
					$rules_types[2][$k] = $rule;
				} else {
					$rules_types[1][$k] = $rule;
				}
			}

			?>
			<p><?php 
			
			$no_rules = isset($irules_stats['no_rules']['n_total']) ? intval($irules_stats['no_rules']['n_total']) : 0;

			echo esc_html(__('Some records are affected by two or more indexing rules, so the total number of rules affected may exceed the number of existing records.', 'fulltext-search')); 
			
			if ($no_rules > 0) {
				echo wp_kses(' '.sprintf(__('We also found %s records that are not subject to any rule (they will have empty data in the index).', 'fulltext-search'), '<b>'.$no_rules.'</b>'), array('b' => array()));
			}

			?></p>

			<h5><?php echo esc_html(__('Base Rules', 'fulltext-search')); ?></h5>

			<?php 
			if (count($rules_types[0]) > 0) {
				echo $indexing_rules_ruletable($rules_types[0], 0, $irules_stats['singles']);
			} else {
				?>
				<p><?php echo esc_html(__('No rules found', 'fulltext-search')); ?></p>
				<?php
			}
			?>

			<h5><?php echo esc_html(__('User-defined Rules', 'fulltext-search')); ?> <span class="btn btn-sm btn-info btn_wpfts_add_user_irule"><i class="fa fa-plus"></i>&nbsp;<?php echo esc_html(__('Add Rule', 'fulltext-search')); ?></span></h5>

			<?php 
			if (count($rules_types[1]) > 0) {
				echo $indexing_rules_ruletable($rules_types[1], 1, $irules_stats['singles']);
			} else {
				?>
				<p><?php echo esc_html(__('No rules found', 'fulltext-search')); ?></p>
				<?php
			}
			?>

			<h5><?php echo esc_html(__('Final Rules', 'fulltext-search')); ?></h5>

			<?php 
			if (count($rules_types[2]) > 0) {
				echo $indexing_rules_ruletable($rules_types[2], 2, $irules_stats['singles']);
			} else {
				?>
				<p><?php echo esc_html(__('No rules found', 'fulltext-search')); ?></p>
				<?php
			}
			?>

					</div>
				</div>
			</div>
			
			<div class="sf_savebtn_place"></div>
		</div>
	</div>
<?php
