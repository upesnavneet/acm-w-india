<?php
// Load parent class.
require_once get_template_directory() . '/src/widgets/Dashboard.php';
/**
 * Widget to select type of site to create.
 */
class SelectTypeOfSite extends Dashboard {

	/**
	 * The id of this widget.
	 */
	const ID = 'acm_type_of_site';
	/**
	 * Hook to wp_dashboard_setup to add the widget.
	 */
	public static function init() {
		 // Register widget settings.
		parent::update_widget_options(
			self::ID,
			array(
				'type_of_site' => null,
			),
			true
		);
		// Register the widget.
		wp_add_dashboard_widget(
			self::ID,
			'Type of site',
			array( __CLASS__, 'widget' )
		);
	}
	/**
	 * Get the type of site created.
	 *
	 * @return string Type of site.
	 */
	public static function type_of_site() {
		 return self::get_widget_option( self::ID, 'type_of_site' );
	}
	/**
	 * Load the widget code.
	 */
	public static function widget() {
		require_once 'select-type-of-site.php';
	}
	/**
	 * Update type of site and do other tasks.
	 *
	 * @param string $type_of_site Type of site user selected.
	 */
	public static function set_type_of_site( $type_of_site = null ) {
		parent::update_widget_options(
			self::ID,
			array(
				'type_of_site' => $type_of_site,
			)
		);
		// Create menus for type of site if user select a type of site.
		if ( $type_of_site ) {
			self::set_menu_by_site( $type_of_site );
		}
	}
	/**
	 * Set menu dependig of site.
	 *
	 * @param string $site Site selected to create menu.
	 */
	private static function set_menu_by_site( $site ) {
		$menu_data = ACMUtils::get_data_from_json( '/src/widgets/SelectTypeOfSite/type-of-sites.json' );
		if ( is_array( $menu_data ) ) {
			$menus = $menu_data[ $site ]['menus'];
			if ( $menus ) {
				foreach ( $menus as $type => $options ) {
					$default_name = 'default_' . $site . '_menu_' . $type;
					// Create menu for each type.
					self::create_menu( $default_name, $type, $options );
				}
			}
		}
	}
	/**
	 * Create custom menu.
	 *
	 * @param string $name Name of the menu.
	 * @param string $location Location of the menu.
	 * @param array  $data Options for the new menu.
	 */
	private static function create_menu( $name, $location, $data ) {
		// Create the menu.
		$menu_id = wp_create_nav_menu( $name );

		// Get the menu object by its name.
		$menu = get_term_by( 'name', $name, 'nav_menu' );
		if ( is_object( $menu ) && $menu->term_id ) {
			// Add the actuall link/ menu item for each item.
			foreach ( $data as $option ) {
				$menu_option = wp_update_nav_menu_item(
					$menu->term_id,
					0,
					array(
						'menu-item-title'  => $option['label'],
						'menu-item-url'    => get_site_url() . $option['link'],
						'menu-item-status' => 'publish',
					)
				);
				// Create page for each menu item

				if ( ! post_exists( $option['label'], '', '', 'page' ) && $location !== 'topsmall' ) {
					$new_page = wp_insert_post(
						array(
							'post_type'    => 'page',
							'post_title'   => $option['label'],
							'post_status'  => 'publish',
							'post_content' => '',

						)
					);
				}
				// Set-up sub-menu.
				foreach ( $option['sub-menu'] as $sub_option ) {
					// Create page for submenu  item
					if ( ! post_exists( $sub_option['label'], '', '', 'page' ) && $location !== 'topsmall' ) {
						wp_insert_post(
							array(
								'post_type'    => 'page',
								'post_title'   => $sub_option['label'],
								'post_status'  => 'publish',
								'post_content' => '',
								'post_parent'  => $new_page,

							)
						);
					}
					// Create menu item
					wp_update_nav_menu_item(
						$menu->term_id,
						0,
						array(
							'menu-item-title'     => $sub_option['label'],
							'menu-item-url'       => get_site_url() . $sub_option['link'],
							'menu-item-status'    => 'publish',
							'menu-item-parent-id' => $menu_option,
						)
					);
				}
			}
			// Set the wanted theme location.
			$locations              = get_theme_mod( 'nav_menu_locations' );
			$locations[ $location ] = $menu->term_id;
			set_theme_mod( 'nav_menu_locations', $locations );
		}
	}
}
