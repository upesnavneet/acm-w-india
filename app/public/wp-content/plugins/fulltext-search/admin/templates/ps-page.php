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

$kses = array('p' => array(), 'b' => array(), 'a' => array('href' => array(), 'target' => array(), 'br' => array()));

?>
<h4><?php echo esc_html(__('Partnership Program', 'fulltext-search')); ?></h4>
<form method="post" id="wpftsi_form8">

	<div class="row">
		<div class="col-12">

			<div class="bd-callout bd-callout-info bg-white">
				<h5><?php echo wp_kses(__('Good day, esteemed user!', 'fulltext-search'), $kses); ?></h5>
				<p><?php echo wp_kses(sprintf(__('You have been using the WP Fast Total Search plugin for long enough to draw conclusions about its strengths and weaknesses. We don\'t ask you to leave a review or rate the plugin (although you can always %1$1s do so if you wish%2$2s). But we want to offer you much more - the opportunity to earn a little money while simultaneously making the world a better place by promoting our plugin.', 'fulltext-search'), '<a href="https://wordpress.org/support/plugin/fulltext-search/reviews/">', '</a>'), $kses); ?></p>
				<p><?php echo wp_kses(sprintf(__('To do this, you need to register in our <b>Affiliate Program</b> and place a link to the plugin on any of your resources. Please familiarize yourself with %1$1s the program rules%2$2s. Thank you for using our plugin!', 'fulltext-search'), '<a href="https://fulltextsearch.org/affiliate-program/">', '</a>'), $kses); ?></p>
				<div class="row">
					<div class="col col-xs-12 text-center">
						<a href="https://fulltextsearch.org/affiliate-program/" target="_blank"><button class="btn btn-success" type="button"><?php echo esc_html(__('Join the Program', 'fulltext-search')); ?></button></a>
					</div>
				</div>
			</div>
		</div>
	</div>

</form>
<?php
