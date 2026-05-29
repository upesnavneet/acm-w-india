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

?><div class="mb-2 mt-2 wpfts_smartform" data-name="form_step3_calculate_relevance">
	<?php wp_nonce_field( 'wpfts_options_step3_calculate_relevance', 'wpfts_options-nonce_step3_calculate_relevance' ); ?>
		<div class=""><div class="row"><span class="col-9"><h5><?php echo esc_html(__('STEP #3: Calculate Relevance', 'fulltext-search')); ?></h5></span><span class="col-3 text-right sf_savelink_place"></span></div></div>
		<div class="bg-light">
			<p>
			<?php echo wp_kses(__('The relevance formula is based on the classic <a href="https://en.wikipedia.org/wiki/Tf-idf" target="_blank">TF-IDF</a> equation. You can justify the value by assigning some weights to specific clusters, post types or date ranges (*in development*) which will give you additional flexibility.', 'fulltext-search'), array('a' => array('href' => array(), 'target' => array()))); ?>
			</p>
			<div class="row">
				<div class="col-12">
					<div class="bd-callout bg-white">
			
			<div class="row">
				<div class="col fixed-200 font-weight-bolder">
					<?php echo esc_html(__('Cluster Weights', 'fulltext-search')); ?>
				</div>
				<div class="col fixed-350">
					<table class="table table-sm table-condensed">
					<thead class="thead-light">
					<tr>
						<th style="width: 1%;"><?php echo esc_html(__('Weight', 'fulltext-search')); ?></th>
						<th><?php echo esc_html(__('Cluster Name', 'fulltext-search')); ?></th>
					</tr>
					</thead>
					<?php
					
						$cluster_types = $wpfts_core->get_cluster_types();
						$cluster_weights = $wpfts_core->get_option('cluster_weights');

						$order_weights = array(
							'post_title' => 50,
							'post_content' => 30,
						);
						uasort($cluster_types, function ($v1, $v2) use ($order_weights) 
						{
							$w1 = isset($order_weights[$v1]) ? $order_weights[$v1] : 1;
							$w2 = isset($order_weights[$v2]) ? $order_weights[$v2] : 1;
							if ($w1 > $w2) {
								return -1;
							} else {
								if ($w1 < $w2) {
									return 1;
								} else {
									return strcasecmp($v1, $v2);
								}
							}
						});

						foreach ($cluster_types as $d) {
							$name = 'eclustertype_' . $d;
							$w = isset($cluster_weights[$d]) ? floatval($cluster_weights[$d]) : 0.5;
						
							echo '<tr><td>';
							WPFTS_Htmltools::displayText($w, array('name' => $name, 'class' => 'wpfts_short_input60 text-sm'));
							echo '</td><td><label for="'.esc_attr($name).'_id"><span>'.esc_html($d).'</span></label></td>';
						}
					?>
						
					</table>
				</div>	
				<div class="col d-xl-none text-right">
					<p><a data-toggle="collapse" href="#wf_hint_cw" role="button" aria-expanded="false" aria-controls="wf_hint_cw"><i class="fa fa-info-circle"></i></a></p>
				</div>
				<div class="col col-xl col-12 d-xl-block collapse" id="wf_hint_cw">
					<p class="text-secondary"><i><?php echo wp_kses(__('"Cluster" is a part of post (either title, content or even specific part which you can define using <b>wpfts_index_post</b> filter). You can assign some relevance weight to each of them.', 'fulltext-search'), array('b' => array())); ?></i></p>
				</div>
			</div>

			<div class="row">
				<div class="col">
					<h5><?php echo esc_html(__('Fine-tuning relevance', 'fulltext-search')); ?></h5>
				</div>
			</div>

			<div class="row">
				<div class="col">
					<?php
					$relevance_finetune = $wpfts_core->get_option('relevance_finetune');
					if (!is_array($relevance_finetune)) {
						$relevance_finetune = array();
					}

					$finetune_relev_offdate = isset($relevance_finetune['offdate']) ? intval($relevance_finetune['offdate']) : 0;
					$finetune_relev_firstchange = isset($relevance_finetune['firstchange']) ? floatval($relevance_finetune['firstchange']) : 0;
					$finetune_relev_periodday = isset($relevance_finetune['periodday']) ? intval($relevance_finetune['periodday']) : 0;
					$finetune_relev_periodchange = isset($relevance_finetune['periodchange']) ? floatval($relevance_finetune['periodchange']) : 0;

					?>
					<p><?php echo sprintf(__('For posts created older than %1$1s &nbsp;days, reduce relevance by %2$2s %% and then reduce by %4$4s %% every %3$3s &nbsp;days.', 'fulltext-search'), 
						WPFTS_Htmltools::makeText($finetune_relev_offdate, array('name' => 'finetune_relev_offdate', 'class' => 'wpfts_short_input60 text-sm')), 
						WPFTS_Htmltools::makeText($finetune_relev_firstchange, array('name' => 'finetune_relev_firstchange', 'class' => 'wpfts_short_input60 text-sm')),
						WPFTS_Htmltools::makeText($finetune_relev_periodday, array('name' => 'finetune_relev_periodday', 'class' => 'wpfts_short_input60 text-sm')),
						WPFTS_Htmltools::makeText($finetune_relev_periodchange, array('name' => 'finetune_relev_periodchange', 'class' => 'wpfts_short_input60 text-sm'))
					); 
					?></p>
				</div>
			</div>


					</div>
				</div>
			</div>

			<div class="sf_savebtn_place"></div>
		</div>
	</div>
<?php
