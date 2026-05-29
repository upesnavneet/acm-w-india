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

ob_start();
?>
	<div class="wpfts_smartform" data-name="form_extractionbox">
		<?php wp_nonce_field( 'wpfts_options_extractionbox', 'wpfts_options-nonce_extractionbox' ); ?>
			<div class=""><div class="row"><span class="col-9"><h5><?php echo esc_html(__('File Extraction Rules', 'fulltext-search')); ?></h5></span><span class="col-3 text-right sf_savelink_place"></span></div></div>
			<div class="bg-light">
				<p><i><?php echo esc_html(__('This option is available in Pro version only', 'fulltext-search')); ?></i></p>
				<div class="wpfts_pro_only">
				<p><?php echo wp_kses(sprintf(__('To search for files by their contents, the plugin places the text extracted from them into the search index. Extracting text is quite a resource-intensive operation, and the power of your server may not be enough for most file types. Therefore, we developed an external service (%s) that produces this work efficiently and quickly.', 'fulltext-search'), '<a href="https://textmill.io/">Textmill.io</a>'), array('a' => array('href' => array(), 'target' => array()))); ?></p>
				<p><?php echo esc_html(__('For a number of reasons, you can refuse to use this service, but in this case, the conversion quality and the number of supported file types will be significantly less.', 'fulltext-search')); ?></p>
				<div class="row">
					<div class="col-12">
						<div class="bd-callout bg-white">
				<div class="row">
					<div class="col fixed-200 font-weight-bolder">
						<?php echo esc_html(__('Extraction Engine', 'fulltext-search')); ?>
					</div>
					<div class="col fixed-250">
						<div class="wpfts_search_logic_group">
							<label for="rgwpfts_extraction_engine_1">
								<input type="radio" id="rgwpfts_extraction_engine_1" value="1" disabled="disabled">&nbsp;<?php echo esc_html(__('TextMill.io then Native PHP', 'fulltext-search')); ?></label><label for="rgwpfts_extraction_engine_0">
								<input type="radio" id="rgwpfts_extraction_engine_0" value="0" disabled="disabled">&nbsp;<?php echo esc_html(__('Native PHP only', 'fulltext-search')); ?></label>
						</div>
					</div>
					<div class="col d-xl-none text-right">
						<p><a data-toggle="collapse" href="#wf_hint_exteng" role="button" aria-expanded="false" aria-controls="wf_hint_exteng"><i class="fa fa-info-circle"></i></a></p>
					</div>
					<div class="col col-xl col-12 d-xl-block collapse" id="wf_hint_exteng">
						<p class="text-secondary"><i><?php echo wp_kses(sprintf(__('%1s is an external processing service, which supports a wide range of formats. Native PHP means local processing of attachments. We recommend %2s at the moment.', 'fulltext-search'), '<a href="https://textmill.io/">TextMill.io</a>', '<a href="https://textmill.io/">TextMill.io</a>'), array('a' => array('href' => array(), 'target' => array()))); ?></i></p>
						<p class="text-secondary"><i><?php echo esc_html(__('Note: Native PHP only supports medium-quality PDF parsing at the moment. Plain-text based formats (TXT, CSS, HTML, HTM etc) are always processing by Native PHP.', 'fulltext-search')); ?></i></p>
					</div>
				</div>
						</div>
					</div>
				</div>
				<div class="sf_savebtn_place"></div>

				</div>					

			</div>
		</div>


<?php

echo apply_filters('wpfts_out_extraction_box', ob_get_clean());

