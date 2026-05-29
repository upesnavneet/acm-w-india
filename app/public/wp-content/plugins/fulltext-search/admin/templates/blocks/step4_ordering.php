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

?><div class="mb-2 mt-2 wpfts_smartform" data-name="form_step4_sort_results">
	<?php wp_nonce_field( 'wpfts_options_step4_sort_results', 'wpfts_options-nonce_step4_sort_results' ); ?>
		<div class=""><div class="row"><span class="col-9"><h5><?php echo esc_html(__('STEP #4: Sort Results', 'fulltext-search')); ?></h5></span><span class="col-3 text-right sf_savelink_place"></span></div></div>
		<div class="bg-light">
			<p>
			<?php echo esc_html(__('To be useful, the results should be shown in the specified order. It\'s a good place to set it up.', 'fulltext-search')); ?>
			</p>
			<div class="row">
				<div class="col-12">
					<div class="bd-callout bg-white">

			<div class="row">
				<div class="col fixed-200 font-weight-bolder">
					<?php echo esc_html(__('Search Order By', 'fulltext-search')); ?>
				</div>
				<div class="col fixed-250">
					<?php
					$mainsearch_orderby = $wpfts_core->get_option('mainsearch_orderby');
					$a = array(
						'relevance' => __('Relevance (WP default)', 'fulltext-search'),
						'ID' => __('Post ID', 'fulltext-search'),
						'author' => __('Author', 'fulltext-search'),
						'title' => __('Title', 'fulltext-search'),
						'name' => __('Post Slug', 'fulltext-search'),
						'type' => __('Post Type', 'fulltext-search'),
						'date' => __('Created Date', 'fulltext-search'),
						'modified' => __('Modified Date', 'fulltext-search'),
						'parent' => __('Parent Post ID', 'fulltext-search'),
						'rand' => __('Random', 'fulltext-search'),
						'comment_count' => __('Comment Count', 'fulltext-search'),
					);
					echo WPFTS_Htmltools::makeSelect($a, $mainsearch_orderby, array('name' => 'wpfts_mainsearch_orderby'));
					?>
				</div>	
				<div class="col d-xl-none text-right">
					<p><a data-toggle="collapse" href="#wf_hint_orderby" role="button" aria-expanded="false" aria-controls="wf_hint_orderby"><i class="fa fa-info-circle"></i></a></p>
				</div>
				<div class="col col-xl col-12 d-xl-block collapse" id="wf_hint_orderby">
					<p class="text-secondary"><i><?php echo esc_html(__('Search results will be ordered by selected field.', 'fulltext-search')); ?></i></p>
				</div>
			</div>
			<div class="row">
				<div class="col fixed-200 font-weight-bolder">
					<?php echo esc_html(__('Search Order', 'fulltext-search')); ?>
				</div>
				<div class="col fixed-250">
				<?php
					$mainsearch_order = $wpfts_core->get_option('mainsearch_order');
					$a = array(
						'DESC' => 'DESC',
						'ASC' => 'ASC',
					);
					echo WPFTS_Htmltools::makeSelect($a, $mainsearch_order, array('name' => 'wpfts_mainsearch_order'));
					?>
				</div>	
				<div class="col d-xl-none text-right">
					<p><a data-toggle="collapse" href="#wf_hint_orderd" role="button" aria-expanded="false" aria-controls="wf_hint_orderd"><i class="fa fa-info-circle"></i></a></p>
				</div>
				<div class="col col-xl col-12 d-xl-block collapse" id="wf_hint_orderd">
					<p class="text-secondary"><i><?php echo esc_html(__('You can select the direction of sorting.', 'fulltext-search')); ?></i></p>
				</div>
			</div>							
					</div>
				</div>
			</div>
			<div class="sf_savebtn_place"></div>
			
		</div>
	</div>
<?php
