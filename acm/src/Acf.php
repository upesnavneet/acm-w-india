<?php
/**
 * Set-up ACF.
 */
class ACMAcf {
	/**
	 * Init.
	 */
	public static function init() {
		if ( function_exists( 'register_field_group' ) ) {
			self::import_display_post_field();
			self::import_banner_box_field();
		}
	}

	/**
	 * Import display post field group.
	 */
	public static function import_display_post_field() {
		register_field_group(
			array(
				'id'         => 'acf_display-post',
				'title'      => 'Display post',
				'fields'     => array(
					array(
						'key'           => 'field_5ab9884a21a3a',
						'label'         => 'Display post in main page',
						'name'          => 'display_post_in_main_page',
						'type'          => 'true_false',
						'instructions'  => 'Enable or disable post to appear in the main page',
						'message'       => '',
						'default_value' => 1,
					),
				),
				'location'   => array(
					array(
						array(
							'param'    => 'post_type',
							'operator' => '==',
							'value'    => 'post',
							'order_no' => 0,
							'group_no' => 0,
						),
					),
				),
				'options'    => array(
					'position'       => 'normal',
					'layout'         => 'no_box',
					'hide_on_screen' => array(),
				),
				'menu_order' => 0,
			)
		);
	}

	/**
	 * Import banner box field group.
	 */
	public static function import_banner_box_field() {
		register_field_group(
			array(
				'id'         => 'acf_banner-box',
				'title'      => 'Banner box',
				'fields'     => array(
					array(
						'key'   => 'field_5ab9862ac1536',
						'label' => 'Banner box',
						'name'  => 'banner_box_heading',
						'type'  => 'none',
					),
					array(
						'key'           => 'field_5ab9864ac1537',
						'label'         => 'Title',
						'name'          => 'banner_box_title',
						'type'          => 'text',
						'default_value' => '',
						'placeholder'   => '',
						'prepend'       => '',
						'append'        => '',
						'formatting'    => 'html',
						'maxlength'     => '',
					),
					array(
						'key'           => 'field_5ab98660c1538',
						'label'         => 'Sub title',
						'name'          => 'banner_box_sub_title',
						'type'          => 'text',
						'default_value' => '',
						'placeholder'   => '',
						'prepend'       => '',
						'append'        => '',
						'formatting'    => 'html',
						'maxlength'     => '',
					),
					array(
						'key'           => 'field_5ab98675c1539',
						'label'         => 'Description',
						'name'          => 'banner_box_description',
						'type'          => 'textarea',
						'default_value' => '',
						'placeholder'   => '',
						'maxlength'     => '',
						'rows'          => '',
						'formatting'    => 'br',
					),
					array(
						'key'          => 'field_5ab9868bc153a',
						'label'        => 'Image',
						'name'         => 'banner_box_image',
						'type'         => 'image',
						'instructions' => 'Allowed sizes are:
						1920 x 485px
						1920 x 370px',
						'save_format'  => 'id',
						'preview_size' => 'thumbnail',
						'library'      => 'all',
					),
				),
				'location'   => array(
					array(
						array(
							'param'    => 'post_type',
							'operator' => '==',
							'value'    => 'page',
							'order_no' => 0,
							'group_no' => 0,
						),
					),
				),
				'options'    => array(
					'position'       => 'normal',
					'layout'         => 'no_box',
					'hide_on_screen' => array(),
				),
				'menu_order' => 0,
			)
		);
	}
}
