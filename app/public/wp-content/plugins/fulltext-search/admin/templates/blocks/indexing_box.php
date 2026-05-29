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
		
		//$minlen = intval($wpfts_core->get_option('minlen'));
		//$maxrepeat = intval($wpfts_core->get_option('maxrepeat'));
		//$stopwords = $wpfts_core->get_option('stopwords');
		//$epostype = $wpfts_core->get_option('epostype');
		
		?>
		<div class="wpfts_smartform bg-light" data-name="form_indexingbox">
			<?php wp_nonce_field( 'wpfts_options_indexingbox', 'wpfts_options-nonce_indexingbox' ); ?>
			<div class="">
				<div class="row">
					<span class="col-9"><h5><?php echo esc_html(__('Indexing Defaults', 'fulltext-search')); ?></h5></span>
					<span class="col-3 text-right sf_savelink_place"></span>
				</div>
			</div>
			<div>
				<p>
				<?php echo esc_html(__('For maximum compatibility with the standard WordPress search, by default, we always index the title and the content of all posts, pages, and custom posts and put them in clusters "post_title" and "post_content", respectively. But this can be modified if required.', 'fulltext-search')); ?>
				</p>
			</div>
			<div>
				<div class="row">
					<span class="col-12"></span>
				</div>

				<div class="row">
					<div class="col-12">
						<div class="bd-callout bg-white">
							<h5><?php echo esc_html(__('All posts will be indexed, except...', 'fulltext-search')); ?></h5>
							<div class="form-element">
								<label for="wpfts_exclude_post_types"><?php echo wp_kses(__('...posts with <code>post_type</code> from blacklist', 'fulltext-search'), array('code' => array())); ?>:</label>
								<?php

								$exclude_post_types = $wpfts_core->get_option('exclude_post_types');
								if (!is_array($exclude_post_types)) {
									$exclude_post_types = array();
								}
								// Get all post types with names and number of posts
								$sel = array();

								$q = 'select `post_type`, count(*) n from `'.$wpdb->posts.'` group by `post_type` order by n desc';
								$res2 = $wpfts_core->db->get_results($q, ARRAY_A);

								$all_pt = get_post_types(array(), 'objects');
								foreach ($res2 as $dd) {
									$sel[$dd['post_type']] = '<b>'.esc_html($dd['post_type']).'</b>'.(isset($all_pt[$dd['post_type']]) && is_object($all_pt[$dd['post_type']]) ? ' <span class="select2_title">('.esc_html($all_pt[$dd['post_type']]->label).')</span>' : '').($dd['n'] > 0 ? ' ['.$dd['n'].']' : '');
								}

								foreach ($exclude_post_types as $dd) {
									if (!isset($sel[$dd])) {
										$sel[$dd] = esc_html($dd);
									}
								}

								WPFTS_Htmltools::displayBadgelistEditor($sel, $exclude_post_types, array(
									'id' => 'wpfts_exclude_post_types',
									'name' => 'exclude_post_types',
									'class' => 'wpfts-badgelist-editor', 
								));
							?>
							</div>

							<div class="form-element">
								<label for="wpfts_exclude_post_statuses"><?php echo wp_kses(__('...and also posts with <code>post_status</code> from blacklist', 'fulltext-search'), array('code' => array())); ?>:</label>
								<?php

								$exclude_post_statuses = $wpfts_core->get_option('exclude_post_statuses');
								if (!is_array($exclude_post_statuses)) {
									$exclude_post_statuses = array();
								}
								// Get all post statuses with names and number of posts
								$sel = array();

								$q = 'select `post_status`, count(*) n from `'.$wpdb->posts.'` group by `post_status` order by n desc';
								$res3 = $wpfts_core->db->get_results($q, ARRAY_A);

								$all_ps = get_post_statuses();
								foreach ($res3 as $dd) {
									$sel[$dd['post_status']] = '<b>'.esc_html($dd['post_status']).'</b>'.(isset($all_ps[$dd['post_status']]) ? ' <span class="select2_title">('.esc_html($all_ps[$dd['post_status']]).')</span>' : '').($dd['n'] > 0 ? ' ['.$dd['n'].']' : '');
								}

								foreach ($exclude_post_statuses as $dd) {
									if (!isset($sel[$dd])) {
										$sel[$dd] = esc_html($dd);
									}
								}

								WPFTS_Htmltools::displayBadgelistEditor($sel, $exclude_post_statuses, array(
									'id' => 'wpfts_exclude_post_statuses',
									'name' => 'exclude_post_statuses',
									'class' => 'wpfts-badgelist-editor', 
								));
							?>
							</div>

						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-12">
						<div class="bd-callout bg-white">
							<h5><?php echo wp_kses(__('How to process <code>post_content</code> before indexing?', 'fulltext-search'), array('code' => array())); ?></h5>

				<div class="row mt-3">
					<div class="col fixed-200 font-weight-bolder">
						<?php echo esc_html(__('Index Shortcodes Content', 'fulltext-search')); ?>
					</div>
					<div class="col fixed-150">
						<?php
						$content_open_shortcodes = intval($wpfts_core->get_option('content_open_shortcodes'));
						WPFTS_Htmltools::displayLabelledCheckbox('wpfts_content_open_shortcodes', 1, __('Enabled', 'fulltext-search'), $content_open_shortcodes);
						?>
					</div>
					<div class="col d-xl-none text-right">
						<p><a data-toggle="collapse" href="#wf_hint_ie_striptags" role="button" aria-expanded="false" aria-controls="wf_hint_ie_striptags"><i class="fa fa-info-circle"></i></a></p>
					</div>
					<div class="col col-xl col-12 d-xl-block collapse" id="wf_hint_ie_striptags">
						<p class="text-secondary"><i><?php echo wp_kses(__('Renders registered shortcodes in the <code>post_content</code> before indexing.', 'fulltext-search'), array('code' => array())); ?></i></p>
					</div>
				</div>

				<div class="row mt-3">
					<div class="col fixed-200 font-weight-bolder">
						<?php echo esc_html(__('Remove Non-Text HTML Nodes', 'fulltext-search')); ?>
					</div>
					<div class="col fixed-150">
						<?php
						$is_remove_html_nodes = intval($wpfts_core->get_option('content_is_remove_nodes'));
						WPFTS_Htmltools::displayLabelledCheckbox('wpfts_content_is_remove_nodes', 1, __('Enabled', 'fulltext-search'), $is_remove_html_nodes);
						?>
					</div>	
					<div class="col d-xl-none text-right">
						<p><a data-toggle="collapse" href="#wf_hint_ie_removenodes" role="button" aria-expanded="false" aria-controls="wf_hint_ie_removenodes"><i class="fa fa-info-circle"></i></a></p>
					</div>
					<div class="col col-xl col-12 d-xl-block collapse" id="wf_hint_ie_removenodes">
						<p class="text-secondary"><i><?php echo wp_kses(__('Removes <code>style</code> and <code>script</code> HTML nodes with their content.', 'fulltext-search'), array('code' => array())); ?></i></p>
					</div>
				</div>

				<div class="row mt-3">
					<div class="col fixed-200 font-weight-bolder">
						<?php echo esc_html(__('Strip HTML Tags From Post Contents', 'fulltext-search')); ?>
					</div>
					<div class="col fixed-150">
						<?php
						$content_strip_tags = intval($wpfts_core->get_option('content_strip_tags'));
						WPFTS_Htmltools::displayLabelledCheckbox('wpfts_content_strip_tags', 1, __('Enabled', 'fulltext-search'), $content_strip_tags);
						?>
					</div>	
					<div class="col d-xl-none text-right">
						<p><a data-toggle="collapse" href="#wf_hint_ie_striptags" role="button" aria-expanded="false" aria-controls="wf_hint_ie_striptags"><i class="fa fa-info-circle"></i></a></p>
					</div>
					<div class="col col-xl col-12 d-xl-block collapse" id="wf_hint_ie_striptags">
						<p class="text-secondary"><i><?php echo wp_kses(__('Removes HTML tags and comments from the <code>post_content</code> while indexing (useful for Gutenberg-driven sites).', 'fulltext-search'), array('code' => array())); ?></i></p>
					</div>
				</div>
				<?php
				
				ob_start();
				
				?>
				<div class="wpfts_pro_only">
				<div class="row mt-3">
					<div class="col fixed-200 font-weight-bolder">
						<?php echo esc_html(__('Include Attachments', 'fulltext-search')); ?><br><?php echo esc_html(__('(Available in Pro only)', 'fulltext-search')); ?>
					</div>
					<div class="col fixed-150">
						<label for="lchwpfts_include_attachments"><input type="checkbox" value="1" id="lchwpfts_include_attachments" disabled="disabled">&nbsp;<span><?php echo esc_html(__('Enabled', 'fulltext-search')); ?></span></label>
					</div>
					<div class="col d-xl-none text-right">
						<p><a data-toggle="collapse" href="#wf_hint_ie_incatt" role="button" aria-expanded="false" aria-controls="wf_hint_ie_incatt"><i class="fa fa-info-circle"></i></a></p>
					</div>
					<div class="col col-xl col-12 d-xl-block collapse" id="wf_hint_ie_incatt">
						<p class="text-secondary"><i><?php echo esc_html(__('Allow for posts to be searchable by the content of their attached files. When enabled, this option will include attachments\' index to their parent post indexes.', 'fulltext-search')); ?></i></p>
					</div>
				</div>
				</div>
				<?php

				echo apply_filters('wpfts_out_include_attachments', ob_get_clean());
				
				?>
						</div>
					</div>
				</div>
				
				<div class="sf_savebtn_place"></div>
			</div>
		</div>

		
			<?php /*
			<tr>
				<th><?php echo __('Stop Words', 'fulltext-search'); ?></th>
				<td colspan="2">
					<p><?php echo __('A comma-separated list of custom stop words', 'fulltext-search'); ?></p>
					<div>
					<?php
						WPFTS_Htmltools::displayTextarea(
								$stopwords, array('name' => 'wpfts_stopwords', 'class' => 'wpfts_long_textarea', 'placeholder' => __('the, a, an, ...etc', 'fulltext-search'))
						);
					?>
					</div>
				</td>
			</tr>
	*/ ?>
		
<?php

