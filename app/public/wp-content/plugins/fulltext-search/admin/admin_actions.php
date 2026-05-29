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

class WPFTS_Admin_Actions
{
	public function sandboxPaginator($current_page, $total_items, $n_perpage) 
	{
		$maxpage = ceil($total_items / $n_perpage);
		
		$a_pages = array();
		for ($i = 1; $i <= $maxpage; $i ++) {
			$a_pages[$i] = (($i - 1) * $n_perpage + 1).' - '.min($total_items, $i * $n_perpage);
		}
		
		$pager = '<div class="wpfts_tq_pager col-6 text-left">';
		$pager .= '<span class="wpfts_tq_prevpage btn btn-secondary btn-sm"'.(($current_page > 1) ? '' : ' disabled="disabled"').' type="button"><i class="fa fa-angle-double-left"></i></span>';
		/* translators: %1$1s is a HTML combo select, %2$2s is a number of items */
		$pager .= sprintf(esc_html(__('Shown %1$1s from %2$2s', 'fulltext-search')), '<span>'.WPFTS_HtmlTools::makeSelect($a_pages, $current_page, array('class' => 'wpfts_tq_current_page')).'</span>', '<b>'.$total_items.'</b>');
		$pager .= '<span class="wpfts_tq_nextpage btn btn-secondary btn-sm"'.(($current_page < $maxpage) ? '' : ' disabled="disabled"').' type="button"><i class="fa fa-angle-double-right"></i></span>';
		$pager .= '</div>';
		
		$a_nn = array(
			10 => 10,
			25 => 25,
			50 => 50,
			100 => 100,
			250 => 250,
			500 => 500,
		);
		$sel_perpage = '<div class="wpfts_tq_perpage col-6 text-right">'.WPFTS_HtmlTools::makeSelect($a_nn, $n_perpage, array('class' => 'wpfts_tq_n_perpage')).'&nbsp;'.__('posts per page', 'fulltext-search').'</div>';

		return '<div class="row mb-2 mt-2">'.$pager.$sel_perpage.'</div>';
	}

	public function ajax_submit_testpost()
	{
		global $wpfts_core;

		$jx = new WPFTS_jxResponse();
		
		if (($data = $jx->getData()) !== false) {
			if (wp_verify_nonce($data['wpfts_options-nonce_indextester'], 'wpfts_options_indextester')) {
				
				//$jx->console($data);
				
				$postid = trim($data['wpfts_testpostid']);

				$e = array();
				
				if (strlen($postid) < 1) {
					$e[] = array('testpostid', __('Please specify post ID', 'fulltext-search'));
				} else {
					if (!is_numeric($postid)) {
						$e[] = array('testpostid', __('Please specify a number', 'fulltext-search'));
					}
				}
				
				if (count($e) > 0) {
					$z = array();
					foreach ($e as $dd) {
						$z[] = '* ' . $dd[1];
					}
					$txt = __('There are errors', 'fulltext-search') . ":\n\n" . implode("\n", $z);

					$jx->alert($txt);
				} else {
					
					$post_id = intval($postid);

					$o_title = sprintf(__('Results of Pre-indexing Filter Tester for Post ID = %s', 'fulltext-search'), $post_id);
					
					// Looking for post ID
					$p = get_post($post_id);
					
					if ($p) {

						$index = $wpfts_core->getPostChunks($post_id);
						
						if (is_array($index)) {
							
							if (is_array($index) && isset($index['__include_children'])) {
								$sch = $wpfts_core->getSubPostChunks($index['__include_children'], $post_id, 'wp_posts');
								if ($sch && is_array($sch)) {
									foreach ($sch as $k => $d) {
										$index[$k] = $d;
									}
								}
							}

							ob_start();
							?>
							<table class="table table-condensed table-sm table-hover table-striped wpfts_test_index_table">
							<thead class="thead-dark">
							<tr>
								<th><?php echo esc_html(__('Cluster', 'fulltext-search')); ?></th>
								<th><?php echo esc_html(__('Text Content', 'fulltext-search')); ?></th>
							</tr>
							</thead>
							<?php
							foreach ($index as $k => $d) {
								if (is_array($d) || is_object($d)) {
									// Show as array or object
									?>
									<tr data-clustername="<?php echo esc_attr($k); ?>">
										<td>
											<b><?php echo esc_html($k); ?></b> <a href="#" class="wpfts_btn_preview_change"><small class="wpfts_set_preview"><?php echo '['.esc_html(__('Preview', 'fulltext-search')).']'; ?></small><small class="wpfts_set_showjson" style="display:none;"><?php echo '['.esc_html(__('Show JSON', 'fulltext-search')).']'; ?></small></a>
										</td>
										<td class="wpfts_display_column">
											<span class="wpfts_show_json"><?php echo wpfts_json_encode($d); ?></span>
											<span class="wpfts_show_preview" style="display:none;"><pre><?php echo esc_html(print_r($d, true)); ?></pre></span>
										</td>
									</tr>
									<?php
								} else {
									// String
									?>
									<tr>
										<td><b><?php echo esc_html($k); ?></b></td>
										<td><?php echo esc_html($d); ?></td>
									</tr>
									<?php		
								}
							}
							?>
							</table>
							<?php
							$o_result = ob_get_clean();
							
						} else {
							// Wrong filter result
							$o_result = '<p>'.sprintf(__('Filter result is not array. Please read <a href="%s" target="_blank">documentation</a> to fix this error.', 'fulltext-search'), $wpfts_core->_wpfts_domain.$wpfts_core->_documentation_link).'</p>';
						}
						
					} else {
						// Post not found
						$o_result = '<p>'.__('The post with specified ID is not found.', 'fulltext-search').'</p>';
					}
					
					$wpfts_core->set_option('testpostid', $postid);
					
					$output = '<hr>';
					$output .= '<h5>'.htmlspecialchars($o_title).'</h5>';
					$output .= $o_result;
					
					$jx->variable('code', 0);
					$jx->variable('text', $output);
				}
				
			} else {
				$jx->alert(__('The form is outdated. Please refresh the page and try again.', 'fulltext-search'));
			}
		}
		$jx->echoJSON();
		wp_die();
	}
	
	public function ajax_submit_testsearch()
	{
		global $wpfts_core;

		$jx = new WPFTS_jxResponse();
		
		if (($data = $jx->getData()) !== false) {
			if (wp_verify_nonce($data['wpfts_options-nonce_searchtester'], 'wpfts_options_searchtester')) {
				
				//$jx->console($data);
				
				$query = trim($data['wpfts_testquery']);
				$tq_disable = $data['wpfts_tq_disable'];
				$tq_nocache = $data['wpfts_tq_nocache'];
				$tq_post_type = $data['wpfts_tq_post_type'];
				$tq_post_status = $data['wpfts_tq_post_status'];

				$current_page = max(1, isset($data['wpfts_tq_current_page']) ? intval($data['wpfts_tq_current_page']) : 0);
				$n_perpage = isset($data['wpfts_tq_n_perpage']) ? intval($data['wpfts_tq_n_perpage']) : 25;
				
				$e = array();
				
				if (strlen($query) < 1) {
					$e[] = array('testquery', __('Please specify search query', 'fulltext-search'));
				}
				
				if (count($e) > 0) {
					$z = array();
					foreach ($e as $dd) {
						$z[] = '* ' . $dd[1];
					}
					$txt = __('There are errors', 'fulltext-search') . ":\n\n" . implode("\n", $z);

					$jx->alert($txt);
				} else {
					
					$o_title = sprintf(__('Results of search for query = "%s"', 'fulltext-search'), $query);
					
					$t0 = microtime(true);
					
					$wpq = new WP_Query(array(
						//'fields' => 'ids',
						'fields' => '*',
						's' => $query,
						'post_status' => 'any',
						//'nopaging' => true,
						'use_indexed_search' => $tq_disable ? 0 : 1,
						'wpfts_nocache' => $tq_nocache ? 1 : 0,
						'posts_per_page' => $n_perpage,
						'paged' => $current_page,
						'post_status' => $tq_post_status,
						'post_type' => $tq_post_type,
						'wpfts_is_force' => 1,
					));
					
					$t1 = microtime(true) - $t0;
					
					if (isset($GLOBALS['posts_clauses'])) {
						$jx->console($GLOBALS['posts_clauses']);
					}
					
					//$num = $wpq->have_posts() ? count($wpq->posts) : 0;
					$num = $wpq->found_posts;
					
					$o_result = '<p><i>'.sprintf(__('Time spent: <b>%.3f</b> sec', 'fulltext-search'), $t1).'</i><br>';
					$o_result .= '</p>';
					
					global $post;
					
					$a = array();
					$n = ($current_page - 1) * $n_perpage + 1;
					while ( $wpq->have_posts() ) {
					
						$wpq->the_post();
						
						$relev = isset($post->relev) ? $post->relev : 0;
						$post = get_post($post->ID);
						setup_postdata($post);
						
						$tn = '';
						$post_tn = get_post_thumbnail_id($post->ID);
						if ($post_tn) {
							$large_image_url = wp_get_attachment_image_src($post_tn, 'thumbnail');
							if ( ! empty( $large_image_url[0] ) ) {
								$tn = '<img src="'.esc_url($large_image_url[0]).'" alt="" class="wpfts_table_img">';
							}
						}
						
						ob_start();
						the_excerpt();
						$exc = ob_get_clean();
						
						$a[] = array(
							'n' => $n ++,
							'ID' => $post->ID,
							'post_type' => $post->post_type,
							'post_title' => $post->post_title,
							'post_status' => $post->post_status,
							'tn' => $tn,
							'exc' => $exc,
							'relevance' => sprintf('%.2f', $relev * 100).'%',
						);
					}
					wp_reset_postdata();
					
					if (count($a) > 0) {
						
						$o_result .= '<div class="sandbox_paginator">'.$this->sandboxPaginator($current_page, $num, $n_perpage).'</div>';
						
						ob_start();
						?>
						<table class="table table-sm table-condensed table-striped table-hover">
						<thead class="thead-dark">
						<tr>
							<th style="width: 10%;"><?php echo esc_html(__('#', 'fulltext-search')); ?></th>
							<th style="width: 10%;"><?php echo esc_html(__('ID', 'fulltext-search')); ?></th>
							<th style="width: 10%;"><?php echo esc_html(__('Type', 'fulltext-search')); ?></th>
							<th style="width: 10%;"><?php echo esc_html(__('Status', 'fulltext-search')); ?></th>
							<th style="width: 50%;"><?php echo esc_html(__('Title, Thumbnail, Excerpt', 'fulltext-search')); ?></th>
							<th style="width: 10%;"><?php echo esc_html(__('Relevance', 'fulltext-search')); ?></th>
						</tr>
						</thead>
						<?php
						$o_result .= ob_get_clean();
						
						foreach ($a as $d) {
							
							$content = '<div class="wpfts_tq_content"><div class="cont1">'.$d['tn'].'</div><div class="cont2"><b>'.htmlspecialchars($d['post_title']).'</b><br>'.$d['exc'].'</div></div>';
							
							$o_result .= '<tr>';
							$o_result .= '<td>'.$d['n'].'</td>';
							$o_result .= '<td><a href="/?p='.$d['ID'].'">'.$d['ID'].'</a></td>';
							$o_result .= '<td>'.$d['post_type'].'</td>';
							$o_result .= '<td>'.$d['post_status'].'</td>';
							$o_result .= '<td>'.$content.'</td>';
							$o_result .= '<td>'.$d['relevance'].'</td>';
							$o_result .= '</tr>';
						}
							
						ob_start();
						?>
						</table>
						<?php
						$o_result .= ob_get_clean();
						
						$o_result .= '<div class="sandbox_paginator">'.$this->sandboxPaginator($current_page, $num, $n_perpage).'</div>';
					} else {
						$o_result .= '<p><i>'.sprintf(__('Found: <b>%d</b> posts', 'fulltext-search'), $num).'</i></p>';
					}
					
					$wpfts_core->set_option('testquery', $query);
					$wpfts_core->set_option('tq_disable', $tq_disable);
					$wpfts_core->set_option('tq_post_type', $tq_post_type);
					$wpfts_core->set_option('tq_post_status', $tq_post_status);
					$wpfts_core->set_option('tq_perpage', $n_perpage);
					
					$output = '<hr>';
					$output .= '<h4>'.htmlspecialchars($o_title).'</h4>';
					$output .= $o_result;
					
					$jx->variable('code', 0);
					$jx->variable('text', $output);
				}
				
			} else {
				$jx->alert(__('The form is outdated. Please refresh the page and try again.', 'fulltext-search'));
			}
		}
		$jx->echoJSON();
		wp_die();
	}

	public function ajax_submit_rebuild()
	{
		global $wpfts_core;

		$jx = new WPFTS_jxResponse();
		
		if (($data = $jx->getData()) !== false) {
			if (wp_verify_nonce($data['_nonce'], 'index_rebuild_nonce')) {

				$wpfts_core->set_option('index_ready', 0);
				$wpfts_core->set_option('is_break_loop', 1);

				$wpfts_core->_database->rebuildDBTables();
				$wpfts_core->rebuild_index(time());

				$wpfts_core->SetPause(false, true);

				// Force status recalculation
				$wpfts_core->set_option('status_next_ts', 0);
				$wpfts_core->set_option('last_indexerstart_ts', 0);

				$jx->reload();
				
			} else {
				$jx->alert(__('The form is outdated. Please refresh the page and try again.', 'fulltext-search'));
			}
		}
		$jx->echoJSON();
		wp_die();
	}

	public function ajax_upgradeindex()
	{
		global $wpfts_core;

		$jx = new WPFTS_jxResponse();
		
		if (($data = $jx->getData()) !== false) {
			if (wp_verify_nonce($data['_nonce'], 'upgradeindex_nonce')) {

				$time = time();

				$rule_id = isset($data['rule_id']) ? intval($data['rule_id']) : 0;

				$sql = $wpfts_core->getRecordsToResetSQL($rule_id);

				if ($sql) {
					$prefix = $wpfts_core->dbprefix();

					$wpfts_core->set_option('index_ready', 0);
					$wpfts_core->set_option('is_break_loop', 1);

					$q = 'update `'.$prefix.'index` inx left join ('.$sql.') tt on tt.id = inx.id set `force_rebuild` = 1 where not isnull(tt.id)';
					$wpfts_core->db->query($q);

					$err = $wpfts_core->db->get_last_error();

					if (strlen($err) > 0) {
						$jx->alert('Error: '.$err);
					}

					// Force status recalculation
					$wpfts_core->set_option('status_next_ts', 0);
					$wpfts_core->set_option('last_indexerstart_ts', 0);

					// Remove notification
					$wpfts_core->set_option('reqreset_message', '');
					$wpfts_core->set_option('reqreset_message_expdt', date('Y-m-d H:i:s', current_time('timestamp') + 1 * 60));

					// Force start indexing
					$wpfts_core->CallIndexerStartNoBlocking();

					$jx->reload();
				}
			} else {
				$jx->alert(__('The form is outdated. Please refresh the page and try again.', 'fulltext-search'));
			}
		}
		
		$jx->echoJSON();
		wp_die();
	}

	public function ajax_add_user_irule()
	{
		global $wpfts_core;

		$jx = new WPFTS_jxResponse();
		
		if (($data = $jx->getData()) !== false) {
			$jx->alert(esc_html(__('This functionality is currently being tested and will be implemented in the next version.', 'fulltext-search')));
		}
		
		$jx->echoJSON();
		wp_die();
	}

	public function process_form_controlbox($jx, $data)
	{
		global $wpfts_core;

		if (wp_verify_nonce($data['wpfts_options-nonce_controlbox'], 'wpfts_options_controlbox')) {
				
			$enabled = isset($data['wpfts_enabled']) ? $data['wpfts_enabled'] : 0;
			$autoreindex = isset($data['wpfts_autoreindex']) ? $data['wpfts_autoreindex'] : 0;
			$is_wpadmin = isset($data['wpfts_is_wpadmin']) ? $data['wpfts_is_wpadmin'] : 0;
			$is_wpblocks = isset($data['wpfts_is_wpblocks']) ? $data['wpfts_is_wpblocks'] : 0;
			$is_fixmariadb = isset($data['wpfts_is_fixmariadb']) ? $data['wpfts_is_fixmariadb'] : 0;
			$is_optimizer = isset($data['wpfts_is_optimizer']) ? $data['wpfts_is_optimizer'] : 0;
			$is_use_theme_compat = isset($data['wpfts_is_use_theme_compat']) ? $data['wpfts_is_use_theme_compat'] : 0;

			$wpfts_core->set_option('enabled', $enabled ? 1 : 0);
			$wpfts_core->set_option('autoreindex', $autoreindex ? 1 : 0);
			$wpfts_core->set_option('is_fixmariadb', $is_fixmariadb ? 1 : 0);
			$wpfts_core->set_option('is_optimizer', $is_optimizer ? 1 : 0);
			$wpfts_core->set_option('is_use_theme_compat', $is_use_theme_compat ? 1 : 0);

			$t = $wpfts_core->get_option('preset_selector');
			if (!($t && is_array($t))) {
				$t = array();
			}
			$t['wpmainsearch_admin'] = $is_wpadmin ? 'backend_default' : '';
			$t['wpmainsearch_frontend'] = 'frontend_default';
			$t['wpblockquery'] = $is_wpblocks ? 'frontend_default' : '';
			$wpfts_core->set_option('preset_selector', $t);

			$jx->variable('code', 0);

			// We need to refresh status block also
			return true;
			
		} else {
			$jx->alert(__('The form is outdated. Please refresh the page and try again.', 'fulltext-search'));
		}
		
		return false;
	}

	public function process_form_indexingbox($jx, $data)
	{
		global $wpfts_core;

		if (wp_verify_nonce($data['wpfts_options-nonce_indexingbox'], 'wpfts_options_indexingbox')) {

			$exclude_post_types = (isset($data['exclude_post_types']) && is_array($data['exclude_post_types'])) ? $data['exclude_post_types'] : array();
			$exclude_post_statuses = (isset($data['exclude_post_statuses']) && is_array($data['exclude_post_statuses'])) ? $data['exclude_post_statuses'] : array();
			$exclude_post_ids = (isset($data['exclude_post_ids']) && is_array($data['exclude_post_ids'])) ? $data['exclude_post_ids'] : array();
			$exclude_post_slugs = (isset($data['exclude_post_slugs']) && is_array($data['exclude_post_slugs'])) ? $data['exclude_post_slugs'] : array();

			$content_strip_tags = isset($data['wpfts_content_strip_tags']) ? $data['wpfts_content_strip_tags'] : 0;
			$content_open_shortcodes = isset($data['wpfts_content_open_shortcodes']) ? $data['wpfts_content_open_shortcodes'] : 0;
			$content_is_remove_nodes = isset($data['wpfts_content_is_remove_nodes']) ? $data['wpfts_content_is_remove_nodes'] : 0;

			$wpfts_core->set_option('exclude_post_types', $exclude_post_types);
			$wpfts_core->set_option('exclude_post_statuses', $exclude_post_statuses);
			$wpfts_core->set_option('exclude_post_ids', $exclude_post_ids);
			$wpfts_core->set_option('exclude_post_slugs', $exclude_post_slugs);

			$wpfts_core->set_option('content_strip_tags', $content_strip_tags ? 1 : 0);
			$wpfts_core->set_option('content_open_shortcodes', $content_open_shortcodes ? 1 : 0);
			$wpfts_core->set_option('content_is_remove_nodes', $content_is_remove_nodes ? 1 : 0);

			$jx->variable('code', 0);

			// We need to refresh status block also
			return true;
			
		} else {
			$jx->alert(__('The form is outdated. Please refresh the page and try again.', 'fulltext-search'));
		}
		
		return false;
	}

	public function process_form_extractionbox($jx, $data)
	{
		if (wp_verify_nonce($data['wpfts_options-nonce_extractionbox'], 'wpfts_options_extractionbox')) {
				
			$jx->variable('code', 0);

			// We need to refresh status block also
			return true;
			
		} else {
			$jx->alert(__('The form is outdated. Please refresh the page and try again.', 'fulltext-search'));
		}
		
		return false;
	}

	public function process_form_step1_query_preprocessing($jx, $data)
	{
		global $wpfts_core;

		if (wp_verify_nonce($data['wpfts_options-nonce_step1_query_preprocessing'], 'wpfts_options_step1_query_preprocessing')) {
			
			$v = isset($data['wpfts_internal_search_terms']) ? intval($data['wpfts_internal_search_terms']) : 0;
			$wpfts_core->set_option('internal_search_terms', $v);

			$v = isset($data['wpfts_use_stemming']) ? intval($data['wpfts_use_stemming']) : 0;
			$wpfts_core->set_option('use_stemming', $v);

			$v = isset($data['wpfts_stemming_language']) ? trim($data['wpfts_stemming_language']) : 'auto';
			$wpfts_core->set_option('stemming_language', $v);

			$jx->variable('code', 0);

			// We need to refresh status block also
			return true;
			
		} else {
			$jx->alert(__('The form is outdated. Please refresh the page and try again.', 'fulltext-search'));
		}
		
		return false;
	}

	public function process_form_step2_find_records($jx, $data)
	{
		global $wpfts_core;

		if (wp_verify_nonce($data['wpfts_options-nonce_step2_find_records'], 'wpfts_options_step2_find_records')) {

			$deflogic = isset($data['wpfts_deflogic']) ? intval($data['wpfts_deflogic']) : 0;
			$deeper_search = isset($data['wpfts_deeper_search']) ? intval($data['wpfts_deeper_search']) : 0;

			$wpfts_core->set_option('deflogic', $deflogic ? 1 : 0);
			$wpfts_core->set_option('deeper_search', $deeper_search ? 1 : 0);

			$jx->variable('code', 0);

			// We need to refresh status block also
			return true;
			
		} else {
			$jx->alert(__('The form is outdated. Please refresh the page and try again.', 'fulltext-search'));
		}
		
		return false;
	}

	public function process_form_step3_calculate_relevance($jx, $data)
	{
		global $wpfts_core;

		if (wp_verify_nonce($data['wpfts_options-nonce_step3_calculate_relevance'], 'wpfts_options_step3_calculate_relevance')) {
			
			$e = array();

			$cluster_weights = array();
			
			foreach ($data as $k => $d) {
				if (preg_match('~^eclustertype_(.+)$~', $k, $m)) {
					$clname = $m[1];
					$clvalue = floatval($d);
					if ((is_numeric($d)) && ($clvalue >= 0) && ($clvalue <= 1.0)) {
						$cluster_weights[$clname] = $clvalue;
					} else {
						$e[] = array($k, sprintf(__('The weight value of cluster "%s" should be numeric value from 0.0 to 1.0', 'fulltext-search'), $clname));
					}
				}
			}

			$offdate = isset($data['finetune_relev_offdate']) ? $data['finetune_relev_offdate'] : '';
			if ((strlen($offdate) > 0) && (is_numeric($offdate))) {
				// Ok
			} else {
				$e[] = array('finetune_relev_offdate', __('Date Offset: this value should be an integer number', 'fulltext-search'));
			}

			$firstchange = isset($data['finetune_relev_firstchange']) ? $data['finetune_relev_firstchange'] : '';
			if ((strlen($firstchange) > 0) && (is_numeric($firstchange))) {
				// Ok
			} else {
				$e[] = array('finetune_relev_firstchange', __('First Relevance Change: this value should be a number', 'fulltext-search'));
			}

			$periodday = isset($data['finetune_relev_periodday']) ? $data['finetune_relev_periodday'] : '';
			if ((strlen($periodday) > 0) && (is_numeric($periodday))) {
				// Ok
			} else {
				$e[] = array('finetune_relev_periodday', __('Date Period: this value should be an integer number', 'fulltext-search'));
			}

			$periodchange = isset($data['finetune_relev_periodchange']) ? $data['finetune_relev_periodchange'] : '';
			if ((strlen($periodchange) > 0) && (is_numeric($periodchange))) {
				// Ok
			} else {
				$e[] = array('finetune_relev_periodchange', __('Periodic Relevance Change: this value should be a number', 'fulltext-search'));
			}

			if (count($e) > 0) {

				$z = array();
				foreach ($e as $dd) {
					$z[] = '* ' . $dd[1];
				}
				$txt = __('There are errors', 'fulltext-search') . ":\n\n" . implode("\n", $z);

				$jx->alert($txt);
			} else {
				// Validation passed!

				// We need to have post_title and post_content clusters even they are not set
				if (!isset($cluster_weights['post_title'])) {
					$cluster_weights['post_title'] = 0.8;
				}
				if (!isset($cluster_weights['post_content'])) {
					$cluster_weights['post_content'] = 0.5;
				}

				$wpfts_core->set_option('cluster_weights', $cluster_weights);

				$relevance_finetune = $wpfts_core->get_option('relevance_finetune');
				if (!is_array($relevance_finetune)) {
					$relevance_finetune = array();
				}
				$relevance_finetune['offdate'] = intval($offdate);
				$relevance_finetune['firstchange'] = floatval($firstchange);
				$relevance_finetune['periodday'] = intval($periodday);
				$relevance_finetune['periodchange'] = floatval($periodchange);

				$wpfts_core->set_option('relevance_finetune', $relevance_finetune);

				$jx->variable('code', 0);

				// We need to refresh status block also
				return true;
			}

		} else {
			$jx->alert(__('The form is outdated. Please refresh the page and try again.', 'fulltext-search'));
		}
		
		return false;
	}

	public function process_form_step4_sort_results($jx, $data)
	{
		global $wpfts_core;

		if (wp_verify_nonce($data['wpfts_options-nonce_step4_sort_results'], 'wpfts_options_step4_sort_results')) {
			
			$mainsearch_orderby = isset($data['wpfts_mainsearch_orderby']) ? trim($data['wpfts_mainsearch_orderby']) : '';
			$mainsearch_order = isset($data['wpfts_mainsearch_order']) ? trim($data['wpfts_mainsearch_order']) : '';

			$wpfts_core->set_option('mainsearch_orderby', $mainsearch_orderby);
			$wpfts_core->set_option('mainsearch_order', $mainsearch_order);

			$jx->variable('code', 0);

			// We need to refresh status block also
			return true;
			
		} else {
			$jx->alert(__('The form is outdated. Please refresh the page and try again.', 'fulltext-search'));
		}
		
		return false;
	}

	public function process_form_step5_show_results($jx, $data)
	{
		global $wpfts_core;

		if (wp_verify_nonce($data['wpfts_options-nonce_step5_show_results'], 'wpfts_options_step5_show_results')) {
			
			$e = array();

			foreach ($data as $k => $d) {
				if (preg_match('~^wpfts_(.+)$~', $k, $m)) {
					$key = $m[1];
					switch ($key) {
						case 'is_smart_excerpts':
						case 'is_fix_blocks':
						case 'is_smart_excerpt_text':
						case 'is_show_score':
						case 'is_not_found_words':
							$v = ($d) ? 1 : 0;
							$wpfts_core->set_option($key, $v);
							break;
						case 'optimal_length':
							$optlen = intval($d);
							if (($optlen < 10) || ($optlen > 10240)) {
								$e[] = array($key, __('Optimal Length should be a number from 10 to 10240', 'fulltext-search'));
							} else {
								$wpfts_core->set_option($key, $optlen);
							}
							break;
						case 'se_styles':
							$wpfts_core->set_option('custom_se_css', $d);
							$wpfts_core->ReadSEStylesMinimized(true);	// Reset minimization cache
							break;
						default:
					}
				} else {
					// Not valid input name
				}
			}

			if (count($e) > 0) {

				$z = array();
				foreach ($e as $dd) {
					$z[] = '* ' . $dd[1];
				}
				$txt = __('There are errors', 'fulltext-search') . ":\n\n" . implode("\n", $z);

				$jx->alert($txt);
			} else {
				// Validation passed!
				$jx->variable('code', 0);
				
				// We need to refresh status block also
				return true;
			}
			
		} else {
			$jx->alert(__('The form is outdated. Please refresh the page and try again.', 'fulltext-search'));
		}
		
		return false;
	}

	public function ajax_smartform()
	{
		global $wpfts_core;

		$jx = new WPFTS_jxResponse();
		
		if (($data = $jx->getData()) !== false) {
			
			$time = time();

			$is_form_processed = apply_filters('wpfts_submit_settings_before', false, $data, $jx);

			if (!$is_form_processed) {
				$form_name = isset($data['form_name']) ? trim($data['form_name']) : false;

				if ($form_name) {

					switch ($form_name) {
						case 'form_controlbox':
							$is_form_processed = $this->process_form_controlbox($jx, $data);
							break;
						case 'form_indexingbox':
							$is_form_processed = $this->process_form_indexingbox($jx, $data);
							break;
						case 'form_extractionbox':
							$is_form_processed = $this->process_form_extractionbox($jx, $data);
							break;
						case 'form_step1_query_preprocessing':
							$is_form_processed = $this->process_form_step1_query_preprocessing($jx, $data);
							break;
						case 'form_step2_find_records':
							$is_form_processed = $this->process_form_step2_find_records($jx, $data);
							break;
						case 'form_step3_calculate_relevance':
							$is_form_processed = $this->process_form_step3_calculate_relevance($jx, $data);
							break;
						case 'form_step4_sort_results':
							$is_form_processed = $this->process_form_step4_sort_results($jx, $data);
							break;
						case 'form_step5_show_results':
							$is_form_processed = $this->process_form_step5_show_results($jx, $data);
							break;
						default:
							$is_form_processed = false;
							//
					}

					$is_form_processed = apply_filters('wpfts_submit_settings_after', $is_form_processed, $data, $jx);
					
					if ($is_form_processed) {
						// Force status recalculation
						$wpfts_core->set_option('status_next_ts', 0);				
					}
				}			
			}
		}
		
		$jx->echoJSON();
		wp_die();
	}

}