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
	<h4><?php echo esc_html(__('Sandbox Area', 'fulltext-search')); ?></h4>
	<form method="post" id="wpftsi_form3">
			
		<div class="row">
			<div class="col-12">

				<div class="bd-callout bd-callout-info bg-white">
					<?php echo esc_html(__('Here you can test different parts of the WPFTS engine to find the reason of possible issue.', 'fulltext-search')); ?>
				</div>
			</div>
		</div>

		<div style="background: #f8f9fa;">
			<ul class="nav nav-tabs mb-3 nav-tabs-inv" id="pills-tab-sandbox" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" id="pills-sb_indexing-tab" data-toggle="pill" href="#pills-sb_indexing" role="tab" aria-controls="pills-sb_indexing" aria-selected="true"><?php echo esc_html(__('Test Indexing Engine', 'fulltext-search')); ?></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="pills-sb_search-tab" data-toggle="pill" href="#pills-sb_search" role="tab" aria-controls="pills-sb_search" aria-selected="false"><?php echo esc_html(__('Test Search', 'fulltext-search')); ?></a>
				</li>
			</ul>
			<div class="tab-content" id="pills-tab-sandboxContent">
  				<div class="tab-pane show active p-3" id="pills-sb_indexing" role="tabpanel" aria-labelledby="pills-sb_indexing-tab">
					<?php
						require dirname(__FILE__).'/blocks/index_engine_tester.php';
					 ?>
				</div>
				<div class="tab-pane p-3" id="pills-sb_search" role="tabpanel" aria-labelledby="pills-sb_search-tab">
					<?php
						require dirname(__FILE__).'/blocks/search_tester.php';
					?>
				</div>
			</div>
		</div>
	</form>
<?php
