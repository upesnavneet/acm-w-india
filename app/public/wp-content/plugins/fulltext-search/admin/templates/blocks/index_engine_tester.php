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

$testpostid = $wpfts_core->get_option('testpostid');

?><div class="mb-2 mt-2" id="form_indextester">
	<?php wp_nonce_field( 'wpfts_options_indextester', 'wpfts_options-nonce_indextester' ); ?>
		<div class=""><h5><?php echo esc_html(__('Index Engine Tester', 'fulltext-search')); ?></h5></div>
		<div class="bg-light">
			<p><?php echo wp_kses(__('Before the data from your posts (pages, meta-fields, etc.) gets into the Search Index, they go through a number of built-in WPFTS filters, including a custom hook <code>wpfts_index_post</code>. Enter the ID of any WordPress record to see what data will come to the Search Index.', 'fulltext-search'), array('code' => array())); ?></p>
			<div class="row">
				<div class="col-12">
					<div class="bd-callout bg-white">
			<div class="row">
				<div class="col fixed-200 font-weight-bolder">
					<?php echo esc_html(__('Post ID', 'fulltext-search')); ?>
				</div>
				<div class="col">
					<div class="form-row">
					<?php
						WPFTS_Htmltools::displayText($testpostid, array('name' => 'wpfts_testpostid', 'class' => 'wpfts_middle_input form-control', 'style' => 'width:150px;'));
					?>
					<?php
						WPFTS_Htmltools::displayButton(__('Test Filter', 'fulltext-search'), array('id' => 'wpfts_testbutton', 'type' => 'button', 'class' => 'btn btn-info'));
					?></div>
				</div>	
				<div class="col d-xl-none text-right">
					<p><a data-toggle="collapse" href="#wf_hint_testfilter" role="button" aria-expanded="false" aria-controls="wf_hint_testfilter"><i class="fa fa-info-circle"></i></a></p>
				</div>
				<div class="col col-xl col-12 d-xl-block collapse" id="wf_hint_testfilter">
					<p class="text-secondary"><i><a href="#wf_hint_testfilter2" data-toggle="collapse" aria-expanded="false" aria-controls="wf_hint_testfilter2"><?php echo esc_html(__('Where do I get this Post ID?', 'fulltext-search')); ?></a></i></p>
					<div class="collapse" id="wf_hint_testfilter2">
						<p class="text-secondary"><i><?php echo wp_kses(__('Open any Edit Post page, check the URL and find <code>post=<b>&lt;number&gt;</b></code> part there. The <b>&lt;number&gt;</b> is an actual Post ID', 'fulltext-search'), array('code' => array(), 'b' => array())); ?></i></p>
					</div>
				</div>
			</div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-12" id="wpfts_test_filter_output">

				</div>
			</div>

		</div>
	</div>
<?php
