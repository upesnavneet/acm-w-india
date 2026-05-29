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

?><div class="mb-2 mt-2 wpfts_smartform" data-name="form_step1_query_preprocessing">
	<?php wp_nonce_field( 'wpfts_options_step1_query_preprocessing', 'wpfts_options-nonce_step1_query_preprocessing' ); ?>
	<div class="">
		<div class="row"><span class="col-9"><h5><?php echo esc_html(__('STEP #1: Query Preprocessing', 'fulltext-search')); ?></h5></span><span class="col-3 text-right sf_savelink_place"></span></div></div>
		<div class="bg-light">
			<p>
			<?php echo esc_html(__('At the very first step, the plugin removes too short words, stop words and punctuation marks from the search phrase. After this, the phrase is broken down into words.', 'fulltext-search')); ?>
			</p>
			<div class="row">
				<div class="col-12">
					<div class="bd-callout bg-white">

			<div class="row">
				<div class="col fixed-200 font-weight-bolder">
					<?php echo esc_html(__('Internal Query Filter', 'fulltext-search')); ?>
				</div>
				<div class="col fixed-150">
					<?php
					$internal_sf = intval($wpfts_core->get_option('internal_search_terms'));
					WPFTS_Htmltools::displayLabelledCheckbox('wpfts_internal_search_terms', 1, __('Enabled', 'fulltext-search'), $internal_sf);
					?>
				</div>	
				<div class="col d-xl-none text-right">
					<p><a data-toggle="collapse" href="#wf_hint_intfilter" role="button" aria-expanded="false" aria-controls="wf_hint_intfilter"><i class="fa fa-info-circle"></i></a></p>
				</div>
				<div class="col col-xl col-12 d-xl-block collapse" id="wf_hint_intfilter">
					<p class="text-secondary"><i><?php echo esc_html(__('Cleans up the query string before using it for search. Uncheck this only if you are using own text splitting algorithm.', 'fulltext-search')); ?></i></p>
				</div>
			</div>

			<div class="row">
				<div class="col fixed-200 font-weight-bolder">
					<?php echo esc_html(__('Use Stemming', 'fulltext-search')); ?>
				</div>
				<div class="col fixed-150">
					<?php
					$use_stemming = intval($wpfts_core->get_option('use_stemming'));
					WPFTS_Htmltools::displayLabelledCheckbox('wpfts_use_stemming', 1, __('Enabled', 'fulltext-search'), $use_stemming);
					?>
				</div>	
				<div class="col d-xl-none text-right">
					<p><a data-toggle="collapse" href="#wf_hint_usestemming" role="button" aria-expanded="false" aria-controls="wf_hint_usestemming"><i class="fa fa-info-circle"></i></a></p>
				</div>
				<div class="col col-xl col-12 d-xl-block collapse" id="wf_hint_usestemming">
					<p class="text-secondary"><i><?php echo esc_html(__('Stemming automatically discards the variable part of words (endings), which increases the number of relevant search results.', 'fulltext-search')); ?></i></p>
				</div>
			</div>
			
			<div class="row">
				<div class="col fixed-200 font-weight-bolder">
					<?php echo esc_html(__('Stemming Language', 'fulltext-search')); ?>
				</div>
				<div class="col fixed-250">
					<?php
					$stemming_language = $wpfts_core->get_option('stemming_language');
					$a = array(
						'auto' => __('Automatic (slower)', 'fulltext-search'),
						'ca' => __('Catalan', 'fulltext-search'),
						'da' => __('Danish', 'fulltext-search'),
						'du' => __('Dutch', 'fulltext-search'),	// Holland
						'du' => __('Dutch', 'fulltext-search'),
						'en' => __('English', 'fulltext-search'),
						'fi' => __('Finnish', 'fulltext-search'),
						'fr' => __('French', 'fulltext-search'),
						'ge' => __('German', 'fulltext-search'),
						'it' => __('Italian', 'fulltext-search'),
						'nw' => __('Norwegian', 'fulltext-search'),
						'pt' => __('Portuguese', 'fulltext-search'),
						'ro' => __('Romanian', 'fulltext-search'),
						'ru' => __('Russian', 'fulltext-search'),
						'es' => __('Spanish', 'fulltext-search'),
						'sw' => __('Swedish', 'fulltext-search'),
					);
					echo WPFTS_Htmltools::makeSelect($a, $stemming_language, array('name' => 'wpfts_stemming_language'));
					?>
				</div>	
				<div class="col d-xl-none text-right">
					<p><a data-toggle="collapse" href="#wf_hint_stemming_language" role="button" aria-expanded="false" aria-controls="wf_hint_stemming_language"><i class="fa fa-info-circle"></i></a></p>
				</div>
				<div class="col col-xl col-12 d-xl-block collapse" id="wf_hint_stemming_language">
					<p class="text-secondary"><i><?php echo esc_html(__('If your texts are written in several languages, leave this option set to "automatic". In this case, WPFTS will automatically select the stemming algorithm for the query language. But it is a bit slower, since language detection takes time (usually 0.1-0.2 seconds).', 'fulltext-search')); ?></i></p>
				</div>
			</div>


					</div>
				</div>
			</div>
			<div class="sf_savebtn_place"></div>
		</div>
	</div>
<?php
