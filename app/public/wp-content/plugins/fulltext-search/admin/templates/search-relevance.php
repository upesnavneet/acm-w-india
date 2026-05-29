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

?>
			<h4><?php echo esc_html(__('Search & Output', 'fulltext-search')); ?></h4>
			<form method="post" id="wpftsi_form5">
				<?php
					wp_nonce_field('wpftsi_form5_nonce', '_nonce');
				?>
				<div class="row">
					<div class="col-12">

						<div class="bd-callout bd-callout-info bg-white">
							<p><?php echo wp_kses(sprintf(__('The search algorithm is a sequence of 5 simple steps. You can do some tweaks at every step. If you need deeper work, you can use hooks. Check out the %1s documentation %2s.', 'fulltext-search'), '<a href="https://fulltextsearch.org/documentation/" target="_blank">', '</a>'), array('p' => array(), 'a' => array('href' => array(), 'target' => array()))); ?></p>
							<p><?php echo esc_html(__('It is important to remember that site data is not used directly for search, instead, all actions are performed on the Search Index.', 'fulltext-search')); ?></p>
						</div>
					</div>
				</div>
				<div style="background: #f8f9fa;">
				<ul class="nav nav-tabs mb-3 nav-tabs-inv" id="pills-tab-search_output" role="tablist">
				<li class="nav-item">
						<a class="nav-link active" id="pills-so_query-tab" data-toggle="pill" href="#pills-so_query" role="tab" aria-controls="pills-so_query" aria-selected="true"><?php echo esc_html(__('Query', 'fulltext-search')); ?></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="pills-so_filter-tab" data-toggle="pill" href="#pills-so_filter" role="tab" aria-controls="pills-so_filter" aria-selected="false"><?php echo esc_html(__('Filter', 'fulltext-search')); ?></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="pills-so_relevance-tab" data-toggle="pill" href="#pills-so_relevance" role="tab" aria-controls="pills-so_relevance" aria-selected="false"><?php echo esc_html(__('Relevance', 'fulltext-search')); ?></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="pills-so_sort_results-tab" data-toggle="pill" href="#pills-so_sort_results" role="tab" aria-controls="pills-so_sort_results" aria-selected="false"><?php echo esc_html(__('Sort Results', 'fulltext-search')); ?></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="pills-so_display-tab" data-toggle="pill" href="#pills-so_display" role="tab" aria-controls="pills-so_display" aria-selected="false"><?php echo esc_html(__('Display', 'fulltext-search')); ?></a>
					</li>
				</ul>
				<div class="tab-content" id="pills-tab-search_outputContent">
  					<div class="tab-pane show active p-3" id="pills-so_query" role="tabpanel" aria-labelledby="pills-so_query-tab">
						<?php
							require dirname(__FILE__).'/blocks/step1_query_filter.php';
						?>
					</div>
					<div class="tab-pane p-3" id="pills-so_filter" role="tabpanel" aria-labelledby="pills-so_filter-tab">
						<?php
							require dirname(__FILE__).'/blocks/step2_find_records.php';
						?>
					</div>
					<div class="tab-pane p-3" id="pills-so_relevance" role="tabpanel" aria-labelledby="pills-so_relevance-tab">
						<?php
							require dirname(__FILE__).'/blocks/step3_relevance_box.php';
						?>
					</div>
					<div class="tab-pane p-3" id="pills-so_sort_results" role="tabpanel" aria-labelledby="pills-so_sort_results-tab">
						<?php
							require dirname(__FILE__).'/blocks/step4_ordering.php';
						?>
					</div>
					<div class="tab-pane p-3" id="pills-so_display" role="tabpanel" aria-labelledby="pills-so_display-tab">
						<?php
							require dirname(__FILE__).'/blocks/step5_smart_excerpts_box.php';
						?>
					</div>
				</div>
				</div>
			</form>
<?php
