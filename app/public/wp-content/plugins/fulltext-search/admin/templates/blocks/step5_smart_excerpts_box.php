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

?><div class="mb-2 mt-2 wpfts_smartform" data-name="form_step5_show_results">
	<?php wp_nonce_field( 'wpfts_options_step5_show_results', 'wpfts_options-nonce_step5_show_results' ); ?>
		<div class=""><div class="row"><span class="col-9"><h5><?php echo esc_html(__('STEP #5: Show Results', 'fulltext-search')); ?></h5></span><span class="col-3 text-right sf_savelink_place"></span></div></div>
		<div class="bg-light">
			<p>
			<?php echo wp_kses(sprintf(__('WPFTS can output search results in a Google-like way - showing only sentences which contains search words and highlighting them. Wordpress by default does not show any content for result items if the items are attachments. Smart Excerpts function can output attachment content too. %1s Read more %2s.', 'fulltext-search'), '<a href="https://fulltextsearch.org/documentation/#smart_excerpts" target="_blank">', '</a>'), array('a' => array('href' => array(), 'target' => array()))); ?>
			</p>
			<div class="row">
				<div class="col-12">
					<div class="bd-callout bg-white">

			<div class="row">
				<div class="col fixed-200 font-weight-bolder">
					<?php echo esc_html(__('Enable Smart Excerpts', 'fulltext-search')); ?>
				</div>
				<div class="col fixed-150">
					<?php
					$is_smart_excerpts = intval($wpfts_core->get_option('is_smart_excerpts'));
					WPFTS_Htmltools::displayLabelledCheckbox('wpfts_is_smart_excerpts', 1, __('Enabled', 'fulltext-search'), $is_smart_excerpts);
					?>
				</div>	
				<div class="col d-xl-none text-right">
					<p><a data-toggle="collapse" href="#wf_hint_enable_se" role="button" aria-expanded="false" aria-controls="wf_hint_enable_se"><i class="fa fa-info-circle"></i></a></p>
				</div>
				<div class="col col-xl col-12 d-xl-block collapse" id="wf_hint_enable_se">
					<p class="text-secondary"><i><?php echo esc_html(__('Replaces Wordpress excerpts by WPFTS Smart Excerpts in search results', 'fulltext-search')); ?></i></p>
				</div>
			</div>
			<div class="row">
				<div class="col fixed-200 font-weight-bolder">
					<?php echo esc_html(__('Fix Blocks Renderer', 'fulltext-search')); ?>
				</div>
				<div class="col fixed-150">
					<?php
					$is_fix_blocks = intval($wpfts_core->get_option('is_fix_blocks'));
					WPFTS_Htmltools::displayLabelledCheckbox('wpfts_is_fix_blocks', 1, __('Enabled', 'fulltext-search'), $is_fix_blocks);
					?>
				</div>	
				<div class="col d-xl-none text-right">
					<p><a data-toggle="collapse" href="#wf_hint_fix_blocks" role="button" aria-expanded="false" aria-controls="wf_hint_fix_blocks"><i class="fa fa-info-circle"></i></a></p>
				</div>
				<div class="col col-xl col-12 d-xl-block collapse" id="wf_hint_fix_blocks">
					<p class="text-secondary"><i><?php echo esc_html(__('Redefines WP Block "core/post-excerpt" renderer to allow links and hints in the dynamic WPFTS Smart Excerpts', 'fulltext-search')); ?></i></p>
				</div>
			</div>			
			<div class="row">
				<div class="col fixed-200 font-weight-bolder">
					<?php echo esc_html(__('Optimal Length', 'fulltext-search')); ?>
				</div>
				<div class="col fixed-150">
					<?php
					$optimal_length = intval($wpfts_core->get_option('optimal_length'));
					WPFTS_Htmltools::displayText($optimal_length, array(
						'name' => 'wpfts_optimal_length', 
						'style' => 'width: 100%;'
					));
					?>
				</div>	
				<div class="col d-xl-none text-right">
					<p><a data-toggle="collapse" href="#wf_hint_optselength" role="button" aria-expanded="false" aria-controls="wf_hint_optselength"><i class="fa fa-info-circle"></i></a></p>
				</div>
				<div class="col col-xl col-12 d-xl-block collapse" id="wf_hint_optselength">
					<p class="text-secondary"><i><?php echo esc_html(__('WPFTS will try to keep excerpt length between 90% and 110% of this value', 'fulltext-search')); ?></i></p>
				</div>
			</div>

			<div class="row mt-3-sm">
				<div class="col fixed-200 font-weight-bolder">
					<?php echo esc_html(__('Include to excerpt:', 'fulltext-search')); ?>
				</div>
				<div class="col fixed-250">
					<ul>
						<li><?php 
							$is_smart_excerpt_text = intval($wpfts_core->get_option('is_smart_excerpt_text'));
							WPFTS_Htmltools::displayLabelledCheckbox('wpfts_is_smart_excerpt_text', 1, __('Smart Excerpt text', 'fulltext-search'), $is_smart_excerpt_text);
							?>
						</li>
						<li><?php
							$is_show_score = intval($wpfts_core->get_option('is_show_score'));
							WPFTS_Htmltools::displayLabelledCheckbox('wpfts_is_show_score', 1, __('Score/Relevance', 'fulltext-search'), $is_show_score);
							?>
						</li>
						<li><?php
							$is_not_found_words = intval($wpfts_core->get_option('is_not_found_words'));
							WPFTS_Htmltools::displayLabelledCheckbox('wpfts_is_not_found_words', 1, __('"Not Found" words', 'fulltext-search'), $is_not_found_words);
							?>
						</li>
					</ul>
					<?php
					
					ob_start();
					?>
					<div class="wpfts_pro_only">
					<p class="mt-2 font-weight-bolder"><i><?php echo esc_html(__('Attachments Only:', 'fulltext-search')); ?></i></p>
					<ul>
						<li><label for="lchwpfts_is_file_ext"><input type="checkbox" value="1" id="lchwpfts_is_file_ext" disabled="disabled">&nbsp;<span><?php echo esc_html(__('File Extension', 'fulltext-search')); ?></span></label>
						</li>
						<li><label for="lchwpfts_is_filesize"><input type="checkbox" value="1" id="lchwpfts_is_filesize" disabled="disabled">&nbsp;<span><?php echo esc_html(__('Filesize', 'fulltext-search')); ?></span></label>
						</li>
						<li><label for="lchwpfts_is_direct_link"><input type="checkbox" value="1" id="lchwpfts_is_direct_link" disabled="disabled">&nbsp;<span><?php echo esc_html(__('Direct Download Link', 'fulltext-search')); ?></span></label>
						</li>
						<li><label for="lchwpfts_is_title_direct_link"><input type="checkbox" value="1" id="lchwpfts_is_title_direct_link" disabled="disabled">&nbsp;<span><?php echo esc_html(__('Link Title to File Download', 'fulltext-search')); ?></span></label>
						</li>
					</ul>
					</div>
					<?php
					
					echo apply_filters('wpfts_out_smart_excerpts_files', ob_get_clean());
					
					?>
				</div>
				<div class="col col-xl col-12">
					<p><?php echo esc_html(__('Demo Output:', 'fulltext-search')); ?> <span><a data-toggle="collapse" href="#wf_hint_dohint" role="button" aria-expanded="false" aria-controls="wf_hint_dohint"><i class="fa fa-info-circle"></i></a></span></p>
					<div class="collapse" id="wf_hint_dohint">
						<p class="text-secondary"><i><?php echo esc_html(__('Optimal Length is ignored here', 'fulltext-search')); ?></i></p>
					</div>

					<?php
						$wpfts_result_item = new WPFTS_Result_Item();
						$wpfts_result_item->demo_mode = true;
					?>
					<div class="wpfts_smart_excerpts_preview mb-3">
						<h2><a href="<?php echo esc_url($wpfts_result_item->TitleLink()); ?>" rel="bookmark"><?php echo wp_kses($wpfts_result_item->TitleText(), array('p' => array(), 'a' => array('href' => array(), 'target' => array()), 'sup' => array())); ?></a></h2>
						<div class="wpfts-result-item">
							<?php echo $wpfts_result_item->Excerpt(); ?>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col fixed-200 font-weight-bolder">
					<?php echo esc_html(__('Custom CSS Styling', 'fulltext-search')); ?>
				</div>
				<div class="col fixed-150 mb-3">
					<div class="btn btn-info btn-sm btn_se_style_preview mb-2"><?php echo esc_html(__('Preview Styles', 'fulltext-search')); ?></div>
					<div class="btn btn-secondary btn-sm btn_se_style_reset"><?php echo esc_html(__('Reset to Default', 'fulltext-search')); ?></div>
				</div>
				<div class="col col-xl col-12">
					<?php
						$custom_se_css = $wpfts_core->get_option('custom_se_css');
						echo '<div id="wpfts_se_styles_editor">'.esc_html($custom_se_css).'</div>';
					?>
					<textarea id="wpfts_se_styles_editor_hidden" name="wpfts_se_styles" style="display:none;"><?php echo esc_textarea($custom_se_css); ?></textarea>
					<i><?php echo esc_html(__('This CSS snippet will be automatically minimized upon usage with a frontend.', 'fulltext-search')); ?></i>
					<?php echo '<style type="text/css" id="wpfts_se_styles_node">'.esc_html($wpfts_core->ReadSEStylesMinimized()).'</style>'; ?>
				</div>
			</div>

					</div>
				</div>
			</div>

			<p><i><?php echo wp_kses(sprintf(__('Notice: this is a <b>beta version</b> of the Smart Excerpt function. In case it does not work for your theme/site, please do not hesistate to send us some information with screenshots and theme name %1s here %2s.', 'fulltext-search'), '<a href="https://fulltextsearch.org/contact/" target="_blank">', '</a>'), array('a' => array('href' => array(), 'target' => array()), 'b' => array())); ?></i></p>

			<div class="sf_savebtn_place"></div>
		</div>
	</div>
<?php
