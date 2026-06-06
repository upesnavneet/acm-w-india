<?php

/**
 * ACM functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage ACM
 * @since ACM 1.0
 */
// Load configurations.
require_once get_template_directory() . '/src/Tgm.php';
require_once get_template_directory() . '/src/Acf.php';
require_once get_template_directory() . '/src/ACMUtils.php';
require_once get_template_directory() . '/src/ACMOpenTOC.php';
require_once get_template_directory() . '/src/ACMThemeConfiguration.php';
// require_once get_template_directory() . '/src/ACMThemeFeedback.php';
require_once get_template_directory() . '/src/widgets/SelectTypeOfSite/SelectTypeOfSite.php';
// require_once get_template_directory() . '/src/wp-hide-login-custom/autoload.php';
if ( ! function_exists( 'is_plugin_active' ) ) {
	require_once ABSPATH . '/wp-admin/includes/plugin.php';
}
// if ( function_exists( 'is_plugin_active' ) && ! is_plugin_active( 'wps-hide-login/wps-hide-login.php' ) ) {
// 	require_once get_template_directory() . '/src/wp-hide-login-custom/singleton.php';
// 	require_once get_template_directory() . '/src/wp-hide-login-custom/plugin.php';
// }
// require_once get_template_directory() . '/src/WPLogin.php';

if ( get_option( 'acm_enable_gutenberg_support' ) === 'on' ) {

	require_once get_template_directory() . '/gutenberg-blocks/register-blocks.php';
	add_theme_support( 'wp_block_styles' );
	add_theme_support( 'align-wide' );
} else {

	// add_filter('gutenberg_can_edit_post', '__return_false');
	// remove_filter('template_include', 'template_loader');
	// remove_action('get_template_part', 'get_template_part', 10, 3);

	// // Disable Gutenberg on the back end.
	// add_filter('use_block_editor_for_post', '__return_false');

	// // Disable Gutenberg for widgets.
	// add_filter('use_widgets_block_editor', '__return_false');

	// add_action('wp_enqueue_scripts', function () {
	// Remove CSS on the front end.
	// wp_dequeue_style('wp-block-library');

	// Remove Gutenberg theme.
	// wp_dequeue_style('wp-block-library-theme');

	// Remove inline global CSS on the front end.
	// wp_dequeue_style('global-styles');
	// }, 20);

	// add_filter('use_block_editor_for_post_type', function ($enabled, $post_type) {
	// return 'your_post_type' === $post_type ? false : $enabled;
	// }, 10, 2);
	// remove_theme_support('editor-color-palette');
	// remove_theme_support('wp-block-styles');
	// remove_theme_support('align-wide');
	// remove_theme_support('editor-gradient-presets');
	// remove_theme_support('core-block-patterns');
	// remove_theme_support('editor-styles');
	// remove_theme_support('appearance-tools');
	remove_theme_support( 'block-template-parts' );
	remove_theme_support( 'block-templates' );
}
require_once get_template_directory() . '/src/new_comments_template.php';
require_once get_template_directory() . '/plugin-update-checker-5.0/plugin-update-checker.php';
/**
 * ACMTheme
 */
class ACMTheme {


	/**
	 * Theme setup
	 */
	public static function init() {
		 // Add inital actions.
		// add_action('wp_head', array(__CLASS__, 'acm_javascript_detection'), 0);
		add_action( 'tgmpa_register', array( __CLASS__, 'acm_require_plugins' ) );
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'acm_scripts' ) );
		add_action( 'admin_print_styles', array( __CLASS__, 'acm_admin_scripts' ) );
		add_action( 'do_meta_boxes', array( __CLASS__, 'remove_custom_field_meta_box' ) );
		add_action( 'customize_register', array( __CLASS__, 'acm_customize_register' ) );
		add_action( 'customize_preview_init', array( __CLASS__, 'social_links_customizer' ) );
		add_filter( 'wp_nav_menu_items', array( __CLASS__, 'add_search_form' ), 10, 2 );
		add_action( 'widgets_init', array( __CLASS__, 'acm_widgets_init' ) );
		add_action( 'wp_dashboard_setup', array( 'SelectTypeOfSite', 'init' ) );
		if ( get_option( 'acm_enable_gutenberg_support' ) === 'on' ) {
			// use default WordPress post settings
		} else {
			add_action( 'pre_get_posts', array( __CLASS__, 'display_homepage_posts' ) );
		}
		add_action( 'after_switch_theme', array( __CLASS__, 'setup_theme' ) );
		add_filter( 'the_content', array( __CLASS__, 'acm_the_content_filter' ) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);
		// Home thumbnails.
		if ( function_exists( 'add_image_size' ) ) {
			add_theme_support( 'post-thumbnails' );
		}
		if ( function_exists( 'add_image_size' ) ) {
			add_image_size( 'home-excerpt-thumbnail', 327, 208, true );
		}
		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'primary'   => __( 'Primary Menu', 'acm' ),
				'secondary' => __( 'Secondary Menu', 'acm' ),
				'topsmall'  => __( 'Top Small', 'acm' ),
				'footer'    => __( 'Footer Bottom', 'acm' ),
			)
		);
		// Create custom options.
		if ( function_exists( 'acf_add_options_page' ) ) {
			// self::add_acf_option_pages();
		}
	}
	/**
	 * To activate CPT Single page.
	 *
	 * @author  Bainternet
	 * @link http://en.bainternet.info/2011/custom-post-type-getting-404-on-permalinks
	 * ---
	 */
	public static function setup_theme() {
		// Rewrite rules for custom posts.
		flush_rewrite_rules( false );
	}
	/**
	 * Filter for the_content.
	 *
	 * @param string $content Content from the db.
	 * @return string Content filtered.
	 */
	public static function acm_the_content_filter( $content ) {
		if ( 'conferences' === $GLOBALS['post']->post_type ) {
			return html_entity_decode( $content );
		}
		return $content;
	}
	/**
	 * Require plugins with tgm.
	 */
	public static function acm_require_plugins() {
		$plugins = array(
			array(
				'name'     => 'Advanced Custom Fields',
				'slug'     => 'advanced-custom-fields',
				'required' => true,
			),
			array(
				'name'     => 'WP Migrate DB',
				'slug'     => 'wp-migrate-db',
				'required' => false,
			),
			array(
				'name'     => 'Duplicator',
				'slug'     => 'duplicator',
				'required' => false,
			),
			array(
				'name'     => 'The Events Calendar',
				'slug'     => 'the-events-calendar',
				'required' => false,
			),
			array(
				'name'     => 'Appointment Booking and Online Scheduling Plugin by vCita',
				'slug'     => 'meeting-scheduler-by-vcita',
				'required' => false,
			),

			array(
				'name'     => 'Yoast SEO',
				'slug'     => 'wordpress-seo',
				'required' => false,
			),
			array(
				'name'     => 'WP Fast Total Search – The Power of Indexed Search',
				'slug'     => 'fulltext-search',
				'required' => false,
			),
		);
		$config = array(
			'id'           => 'ACM-Theme',
			'menu'         => 'tgmpa-install-plugins',
			'parent_slug'  => 'themes.php',
			'capability'   => 'edit_theme_options',
			'has_notices'  => true,
			'dismissable'  => true,
			'is_automatic' => true,
		);
		tgmpa( $plugins, $config );
	}
	/**
	 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
	 */

	/**
	 * Add acm fonts.
	 *
	 * @return string New url
	 */
	public static function acm_fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';

		/*
		 * Translators: If there are characters in your language that are not supported
		 * by Noto Sans, translate this to 'off'. Do not translate into your own language.
		 */
		if ( 'off' !== _x( 'on', 'Noto Sans font: on or off', 'acm' ) ) {
			$fonts[] = 'Noto Sans:400italic,700italic,400,700';
		}

		/*
		 * Translators: If there are characters in your language that are not supported
		 * by Noto Serif, translate this to 'off'. Do not translate into your own language.
		 */
		if ( 'off' !== _x( 'on', 'Noto Serif font: on or off', 'acm' ) ) {
			$fonts[] = 'Noto Serif:400italic,700italic,400,700';
		}

		/*
		 * Translators: If there are characters in your language that are not supported
		 * by Inconsolata, translate this to 'off'. Do not translate into your own language.
		 */
		if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'acm' ) ) {
			$fonts[] = 'Inconsolata:400,700';
		}

		/*
		 * Translators: To add an additional character subset specific to your language,
		 * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate
		 * into your own language.
		 */
		$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'acm' );

		if ( 'cyrillic' === $subset ) {
			$subsets .= ',cyrillic,cyrillic-ext';
		} elseif ( 'greek' === $subset ) {
			$subsets .= ',greek,greek-ext';
		} elseif ( 'devanagari' === $subset ) {
			$subsets .= ',devanagari';
		} elseif ( 'vietnamese' === $subset ) {
			$subsets .= ',vietnamese';
		}

		if ( $fonts ) {
			$fonts_url = add_query_arg(
				array(
					'family' => urlencode( implode( '|', $fonts ) ),
					'subset' => urlencode( $subsets ),
				),
				'https://fonts.googleapis.com/css'
			);
		}

		return $fonts_url;
	}
	/**
	 * Enqueue scripts and styles
	 */
	public static function acm_scripts() {
		$path_style = get_template_directory() . '/style.css';
		// Add custom fonts, used in the main stylesheet. (removed safely)
		// wp_enqueue_style('acm-fonts', self::acm_fonts_url(), array(), null);
		// Load our main stylesheet.
		wp_enqueue_style( 'acm-style', get_stylesheet_uri(), array(), filemtime( $path_style ) );
		// Load custom animations stylesheet
		wp_enqueue_style( 'acm-animations', get_template_directory_uri() . '/css/animations.css', array(), '1.0.0' );

		// Load FontAwesome font.
		// wp_enqueue_script('priority-nav', get_template_directory_uri() . '/priorityNav.js', array('jquery'));
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		// wp_register_script('jquery', '//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js', null, null, true);
		// wp_enqueue_script('modernizr-script', '//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js');
		$location = '/patterns/static/js/main.js';
		$path     = get_template_directory() . $location;
		if ( file_exists( $path ) ) {
			$src = get_template_directory_uri() . $location;
			wp_enqueue_script( 'acm-main', $src, array( 'jquery' ), filemtime( $path ), true );
		}
		wp_enqueue_script( 'acm-script', get_template_directory_uri() . '/js/acm.js', null, null, true );
		wp_localize_script(
			'acm-script',
			'screenReaderText',
			array(
				'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu', 'acm' ) . '</span>',
				'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu', 'acm' ) . '</span>',
			)
		);
		
		// Load Lenis JS library (from CDN) and animations script
		wp_enqueue_script( 'lenis-js', 'https://unpkg.com/lenis@1.1.13/dist/lenis.min.js', array(), '1.1.13', true );
		wp_enqueue_script( 'acm-animations', get_template_directory_uri() . '/js/animations.js', array( 'lenis-js' ), '1.0.0', true );
	}
	/**
	 * Enqueue scripts and styles for admin area.
	 */
	public static function acm_admin_scripts() {
		// Add custom admin scripts.
		if ( is_admin() ) {
			wp_enqueue_style( 'acm-admin', get_template_directory_uri() . '/css/admin.css' );
			wp_enqueue_style(
				'jquery-confirm',
				'//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css'
			);
			wp_enqueue_script(
				'jquery-confirm',
				'//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js',
				array( 'jquery' ),
				false,
				true
			);
		}
	}
	/**
	 * Remove meta box.
	 */
	public static function remove_custom_field_meta_box() {
		 remove_meta_box( 'postcustom', 'post', 'normal' );
	}
	/**
	 * Customize register.
	 *
	 * @param WP_Customize $wp_customize Customize object reference.
	 */
	public static function acm_customize_register( $wp_customize ) {
		$wp_customize->add_section(
			'banner_settings_section',
			array(
				'title'    => __( 'Banner Image', 'acm' ),
				'priority' => 30,
			)
		);

		$wp_customize->add_setting( 'banner_bgimage' );

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'banner_bgimage',
				array(
					'label'    => __( 'Banner Background Image', 'acm' ),
					'section'  => 'banner_settings_section',
					'settings' => 'banner_bgimage',
				)
			)
		);

		$wp_customize->add_setting(
			'banner_title',
			array(
				'default' => '',
			)
		);
		$wp_customize->add_setting(
			'banner_top_title',
			array(
				'default' => '',
			)
		);
		$wp_customize->add_setting(
			'banner_description',
			array(
				'default' => '',
			)
		);

		$wp_customize->add_control(
			'banner_title',
			array(
				'label'    => __( 'Title', 'acm' ),
				'section'  => 'banner_settings_section',
				'settings' => 'banner_title',
				'type'     => 'text',
			)
		);

		$wp_customize->add_control(
			'banner_top_title',
			array(
				'label'    => __( 'Top Title', 'acm' ),
				'section'  => 'banner_settings_section',
				'settings' => 'banner_top_title',
				'type'     => 'text',
			)
		);

		$wp_customize->add_control(
			'banner_description',
			array(
				'label'    => __( 'Description', 'acm' ),
				'section'  => 'banner_settings_section',
				'settings' => 'banner_description',
				'type'     => 'textarea',
			)
		);
		// Add logo.
		$wp_customize->add_setting( 'logo_image' );
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'logo_image',
				array(
					'label'    => __( 'Logo Image', 'acm' ),
					'section'  => 'title_tagline',
					'settings' => 'logo_image',
				)
			)
		);
		// Footer logo.
		$wp_customize->add_setting( 'footer_logo' );
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'footer_logo',
				array(
					'label'    => __( 'Footer Logo', 'acm' ),
					'section'  => 'title_tagline',
					'settings' => 'footer_logo',
				)
			)
		);
	}
	/**
	 * Enqueue social script.
	 */
	public static function social_links_customizer() {
		wp_enqueue_script( 'social-links-customizer', get_template_directory_uri() . '/social-links-customizer.js', array( 'jquery' ) );
	}
	/**
	 * Add search form to menu.
	 *
	 * @param string $items Menu items.
	 * @param string $args  Menu items with search form.
	 */
	public static function add_search_form( $items, $args ) {
		if ( 'secondary' === $args->theme_location ) {
			$items .= '
				<li class="hide-for-small">
					<form class="acm-search-form" id="form_1" action="' . get_site_url() . '" method="get">
						<input type="text" name="s" class="acm-searchbox-input" required="required" autocomplete="off" id="input_1"/>
						<label for="search-site_1" class="toggle">
							<i class="fa fa-search left"></i>
							<input type="submit" class="acm-searchbox-submit left" value="Search" name="search-site_1" id="search-site_1" />
						</label>
						<script>window.liveSearchUrl = "/live-search";</script>
					</form>
				</li>';
		}
		return $items;
	}
	/**
	 * Register sidebars and widgetized areas.
	 */
	public static function acm_widgets_init() {
		register_sidebar(
			array(
				'name'          => 'Content sidebar',
				'id'            => 'content_right',
				'before_widget' => '<div>',
				'after_widget'  => '</div>',
				'before_title'  => '<h2>',
				'after_title'   => '</h2>',
			)
		);
		register_sidebar(
			array(
				'name'          => 'Content footer',
				'id'            => 'content_footer',
				'before_widget' => '<div>',
				'after_widget'  => '</div>',
				'before_title'  => '<h2>',
				'after_title'   => '</h2>',
			)
		);
	}
	/**
	 * Modify post to display in homepage.
	 *
	 * @param object $query Query object.
	 */
	public static function display_homepage_posts( $query ) {
		if ( is_home() && $query->is_main_query() ) {
			$number_of_post_field = get_option( 'acm_number_of_posts' );
			$posts_to_display     = is_numeric( $number_of_post_field ) ? $number_of_post_field : 20;
			// Display post if display in home option is setting in true.
			$meta_query = array(
				'relation' => 'OR',
				array(
					'key'     => 'display_post_in_main_page',
					'value'   => true,
					'compare' => '=',
				),
				array(
					'key'     => 'display_post_in_main_page',
					'compare' => 'NOT EXISTS',
				),
			);
			$query->set( 'meta_query', $meta_query );
			$query->set( 'posts_per_page', $posts_to_display );
		}
	}
	/**
	 * Display alert message for new theme updates.
	 */
	public static function acm_update_alert() {              ?>
<div class="notice notice-info is-dismissible">
	<p>A new version of the ACM Theme is available. <a href="/wp-admin/update-core.php">Click here to download it.</a>
	</p>
</div>
		<?php
	}
};
// Instantiate theme.
ACMTheme::init();
// Active Open TOC functionality.
ACMOpenTOC::init();
// Activate ACF fields.
ACMAcf::init();
// Activate ACM Theme Configuration page.
ACMThemeConfiguration::init();
// Activate ACM Theme Feedback page.
// ACMThemeFeedback::init();
// Activate custom wp-admin route
// if ( function_exists( 'is_plugin_active' ) && ! is_plugin_active( 'wps-hide-login/wps-hide-login.php' ) ) {
// 	Plugin::get_instance();
// 	Plugin::activate();
// }
// turning off auto updates for plugins
add_filter( 'auto_update_plugin', '__return_false' );
// turning off auto updates for themes
add_filter( 'auto_update_theme', '__return_false' );

function custom_permalink_structure() {
	 global $wp_rewrite;
	$wp_rewrite->set_permalink_structure( '/%postname%/' );
}
add_action( 'init', 'custom_permalink_structure' );



// allows to show all subcategories in menu
add_filter( 'nav_menu_css_class', 'special_nav_class', 10, 2 );

function special_nav_class( $classes, $item ) {
	if ( in_array( 'current-menu-item', $classes ) ) {
		$classes[] = 'active ';
	}
	if ( in_array( 'current-menu-parent', $classes ) ) {
		$classes[] = 'active ';
	}
	return $classes;
}

function comments_open_filter( $open, $post_id ) {
	$comments_status = get_option( 'acm_disable_comments' ); // You can check from your own option value
	if ( $comments_status === 'on' || $comments_status === false ) {
		$open = false;
	} else {
		$open = true;
	}
	return $open;
}
add_filter( 'comments_open', 'comments_open_filter', 10, 2 );

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$myUpdateChecker = PucFactory::buildUpdateChecker(
	'https://services.acm.org/public/infodir/wp-versions/details.json',
	__FILE__, // Full path to the main plugin file or functions.php.
	'acm-update'
);

function add_favicon_to_theme() {
	$favicon_url    = get_stylesheet_directory_uri() . '/favicon.ico';
	$custom_favicon = get_theme_mod( 'site_icon' );
	if ( empty( $custom_favicon ) ) {
		echo '<link rel="shortcut icon" href="' . $favicon_url . '" type="image/x-icon" />';
	}
}

  add_action( 'wp_head', 'add_favicon_to_theme' );
