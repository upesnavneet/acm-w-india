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

 /**
  * This file contains data about compatibility solutions for different themes and plugins
  */
global $wpfts_compat_data;

$wpfts_compat_data = array(
	'themes' => array(
		'Avada' => array('avada', 1),
		'Divi' => array('divi', 1),
		'OceanWP' => array('oceanwp', 1),
		'Sinatra' => array('sinatra', 1),
		'Storefront' => array('storefront', 1),
		'Scientia' => array('scientia', 1),

		// Themes compatible without hook
		'Twenty Seventeen' => array('', 0),
		'Astra' => array('', 0),
		'Hello Elementor' => array('', 0),
		'Genesis' => array('', 0),

	),
	'plugins' => array(),
);
