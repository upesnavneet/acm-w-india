<?php
require_once get_template_directory() . '/src/widgets/SelectTypeOfSite/SelectTypeOfSite.php';
/**
 * ACM Open TOC functionality
 */
class ACMOpenTOC {



	/**
	 * ACMOpenTOC init function.
	 */
	public static function init() {
		 $type_of_site = SelectTypeOfSite::type_of_site();
	}
}
