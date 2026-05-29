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

global $wpdb;

$testquery = $wpfts_core->get_option('testquery');
$tq_disable = $wpfts_core->get_option('tq_disable');
$tq_nocache = $wpfts_core->get_option('tq_nocache');
$tq_post_status = $wpfts_core->get_option('tq_post_status');
$tq_post_type = $wpfts_core->get_option('tq_post_type');
	
$post_statuses = array(
	'any' => __('* (Any)', 'fulltext-search'),
	'publish' => __('publish (Published)', 'fulltext-search'),
	'future' => __('future (Future)', 'fulltext-search'),
	'draft' => __('draft (Draft)', 'fulltext-search'),
	'pending' => __('pending (Pending)', 'fulltext-search'),
	'private' => __('private (Private)', 'fulltext-search'),
	'trash' => __('trash (Trash)', 'fulltext-search'),
	'auto-draft' => __('auto-draft (Auto-Draft)', 'fulltext-search'),
	'inherit' => __('inherit (Inherit)', 'fulltext-search'),
);
	
$q = 'select distinct post_type from `'.$wpdb->posts.'` order by post_type asc';
$res = $wpfts_core->db->get_results($q, ARRAY_A);
	
$post_types = array('any' => __('* (Any)', 'fulltext-search'));
foreach ($res as $d) {
	$post_types[$d['post_type']] = $d['post_type'];
}
	
?>
	<div class="mb-2 mt-2" id="form_searchtester">
		<?php wp_nonce_field( 'wpfts_options_searchtester', 'wpfts_options-nonce_searchtester' ); ?>
		<div class=""><h5><?php echo esc_html(__('Search Tester', 'fulltext-search')); ?></h5></div>
		<div class="bg-light">
			<p>
			<?php echo wp_kses(__('You can test search with any query here. Standard wordpress <b>WP_Query</b> object with WPFTS features will be used.', 'fulltext-search'), array('b' => array())); ?>
			</p>
			<div class="row">
				<div class="col-12">
					<div class="bd-callout bg-white">
					<div class="row">
				<div class="col fixed-200 font-weight-bolder">
					<?php echo esc_html(__('Query', 'fulltext-search')); ?>
				</div>
				<div class="col">
					<div class="form-row">
					<?php
						WPFTS_Htmltools::displayText($testquery, array('name' => 'wpfts_testquery', 'class' => 'wpfts_middle_input form-control', 'style' => 'width:150px;'));
					?>
					<?php
						WPFTS_Htmltools::displayButton(__('Test Search', 'fulltext-search'), array('id' => 'wpfts_testquerybutton', 'type' => 'button', 'class' => 'btn btn-info'));
					?></div>
				</div>
				<div class="col d-xl-none text-right">
					<?php /*
					<p><a data-toggle="collapse" href="#wf_hint_testfilter" role="button" aria-expanded="false" aria-controls="wf_hint_testfilter"><i class="fa fa-info-circle"></i></a></p>
					*/ ?>
				</div>
				<div class="col col-xl col-12 d-xl-block collapse" id="wf_hint_testfilter">
					<?php /*
					<p class="text-secondary"><i><a href="#wf_hint_testfilter2" data-toggle="collapse" aria-expanded="false" aria-controls="wf_hint_testfilter2"><?php echo __('Where do I get this Post ID?', 'fulltext-search'); ?></a></i></p>
					<div class="collapse" id="wf_hint_testfilter2">
						<p class="text-secondary"><i><?php echo __('Open any Edit Post page, check the URL and find <code>post=<b>&lt;number&gt;</b></code> part there. The <b>&lt;number&gt;</b> is an actual Post ID', 'fulltext-search'); ?></i></p>
					</div>
					*/ ?>
				</div>
			</div>
			<div class="row">
				<div class="col fixed-200 font-weight-bolder">
				</div>
				<div class="col">
					<div class="mt-2">
						<p><b><?php echo esc_html(__('Additional Options', 'fulltext-search')); ?></b></p>
						<div class="row">
							<div class="col-12">
							<span style="margin-right: 20px;"><?php
								WPFTS_Htmltools::displayCheckbox($tq_disable, array('id' => 'wpfts_tq_disable', 'name' => 'wpfts_tq_disable', 'class' => 'wpfts_middle_input', 'value' => 1), '&nbsp;'.__('Disable WPFTS', 'fulltext-search'));
							?></span>
							<span style="margin-right: 20px;"><?php
								WPFTS_Htmltools::displayCheckbox($tq_nocache, array('id' => 'wpfts_tq_nocache', 'name' => 'wpfts_tq_nocache', 'class' => 'wpfts_middle_input', 'value' => 1), '&nbsp;'.__('Disable SQL cache', 'fulltext-search'));
							?></span>
							</div>
						</div>
						
						<div class="row">
							<div class="col-12 col-sm-12 col-md-12 col-lg-6">
							<span style="margin-right: 20px;"><?php
								echo esc_html(__('Post Type:', 'fulltext-search')).'&nbsp;'; 
								WPFTS_Htmltools::displaySelect($post_types, $tq_post_type, array('id' => 'wpfts_tq_post_type', 'name' => 'wpfts_tq_post_type', 'class' => 'wpfts_middle_input form-control'));
							?></span>
							</div>
							<div class="col-12 col-sm-12 col-md-12 col-lg-6">
							<span style="margin-right: 20px;"><?php
								echo esc_html(__('Post Status:', 'fulltext-search')).'&nbsp;';
								WPFTS_Htmltools::displaySelect($post_statuses, $tq_post_status, array('id' => 'wpfts_tq_post_status', 'name' => 'wpfts_tq_post_status', 'class' => 'wpfts_middle_input form-control'));
							?></span>
							</div>
						</div>
					</div>

				</div>	
				
			</div>							
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-12" id="wpfts_test_search_output">

				</div>
			</div>


		</div>
	</div>
<?php
