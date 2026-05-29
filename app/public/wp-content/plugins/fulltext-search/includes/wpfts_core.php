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

require_once dirname(__FILE__).'/wpfts_database.php';
require_once dirname(__FILE__).'/wpfts_index.php';
require_once dirname(__FILE__).'/wpfts_search.php';
require_once dirname(__FILE__).'/wpfts_jx.php';
require_once dirname(__FILE__).'/../admin/admin_actions.php';
require_once dirname(__FILE__).'/wpfts_htmltools.php';
require_once dirname(__FILE__).'/wpfts_result_item.php';
require_once dirname(__FILE__).'/wpfts_shortcodes.php';
require_once dirname(__FILE__).'/wpfts_semaphore.php';
require_once dirname(__FILE__).'/wpfts_flare.php';
require_once dirname(__FILE__).'/wpfts_db.php';
require_once dirname(__FILE__).'/wpfts_querylog.php';
require_once dirname(__FILE__).'/wpfts_irules.php';
require_once dirname(__FILE__).'/../compat/compat.php';
//require_once dirname(__FILE__).'/updater/updater.php';

class WPFTS_Core
{
	public $_index = null;
	public $_search = null;
	public $_querylog = null;
	public $_database = null;
	public $_admin_actions = null;
	
	protected $_pid = false;

	protected $_log_file = false;
	
	public $_wpfts_domain = 'https://fulltextsearch.org';
	public $_documentation_link = '/documentation';
	public $_forum_link = '/forum/';
	public $_flare_url = 'https://fulltextsearch.org/fire';
	
	public $root_url;
	public $root_dir;

	public $db = null;	// WPDB wrapper (soft mode)
	
	public $index_error = '';
	
	public $forced_se_query = false;

	public $defer_indexing = false;

	public $widget_presets = array();

	public $irules_base = array();
	public $irules_user = array();
	public $irules_final = array();
	public $irules_cache = false;
	public $irules_stats_cache = false;

	public $tablist = array('vectors', 'words', 'index', 'docs', 'rawcache');
	
	public $is_wpfts_settings_page = false;
	public $toplevel_screen = '---';
	public $prefix_screen = '---';

	public $se_css_cache_timeout = 600;	// 10 min
	public $se_css_tr_name = 'wpfts_se_css_transient';
	
	public $_flare = null;

	public $_dev_debug = false;

	public $is_mariadb = false;
	public $mysql_version = '';

	public $prefix = 'wpftsi_';

	public function __construct()
	{
		$this->root_url = dirname(plugins_url('', __FILE__));

		$upd = wp_upload_dir();

		if (isset($upd['basedir'])) {
			$hh = isset($_SERVER['SERVER_ADDR']) ? $_SERVER['SERVER_ADDR'] : (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'no_server_addr');
			$nk = defined('NONCE_KEY') && (strlen(NONCE_KEY) > 10) ? NONCE_KEY : sha1('_domain_'.home_url().'_key_');
			$this->_log_file = $upd['basedir'].'/wpfts_logs/'.date('Ymd', current_time('timestamp')).'_'.md5(home_url().$hh.$nk).'.txt';
			if (!file_exists(dirname($this->_log_file))) {
				@mkdir(dirname($this->_log_file));
			}
		}

		$this->db = new WPFTS_DB();
		$this->_database = new WPFTS_Database();
		$this->_index = new WPFTS_Index();
		$this->_search = new WPFTS_Search();
		$this->_flare = new WPFTS_Flare($this->_flare_url);
		$this->_querylog = new WPFTS_QueryLog();
		
		if (is_admin()) {
			add_action('admin_notices', array($this, 'admin_notices'));
		}

		add_filter('wpfts_irule/content_open_shortcodes', array($this, 'filterContentOpenShortcodes'), 10, 5);
		add_filter('wpfts_irule/content_is_remove_nodes', array($this, 'filterContentIsRemoveNodes'), 10, 5);
		add_filter('wpfts_irule/content_strip_tags', array($this, 'filterContentStripTags'), 10, 5);
	}
	
	public function writeToLog($module, $text)
	{
		if ($this->_log_file) {
			if (strlen($text) < 1) {
				file_put_contents($this->_log_file, "\n", FILE_APPEND);
			} else {
				file_put_contents($this->_log_file, date('Y-m-d H:i:s', current_time('timestamp')).' ['.$module.'] '.$text."\n", FILE_APPEND);
			}
		}
	}

	public function log($text)
	{
		$this->writeToLog('CORE', $text);
	}

	public function Init()
	{
		// Reinstall cron hooks
		$this->installCronIndexerTask();
		
		// Install/init flare service
		$mid = $this->get_option('flare_mid');
		if (strlen($mid) < 1) {
			$mid = WPFTS_Flare::MakeUniqueMediumID();
			$this->set_option('flare_mid', $mid);
		}
		$this->_flare->mid = $mid;
		
		// Get basic MySQL info
		$q = 'select version() v';
		$res = $this->db->get_results($q, ARRAY_A);

		$is_mariadb = false;
		$mysql_version = '';
		if (isset($res[0]['v'])) {
			$version = $res[0]['v'];

			$zz = array();
			if (preg_match('~(\d+\.\d+\.\d+)~', $version, $zz)) {
				$mysql_version = $zz[1];
			}
			if (preg_match('~(maria)~i', $version, $zz)) {
				$is_mariadb = true;
			}
		}

		$this->is_mariadb = $is_mariadb;
		$this->mysql_version = $mysql_version;

		if ($this->is_mariadb && (intval($this->get_option('is_fixmariadb')) != 0)) {
			if (version_compare($this->mysql_version, '10.3.0', '>')) {
				// Apply the patch
				$q = "set optimizer_switch='split_materialized=off'";
				$this->db->query($q);
			}
		}

		// Compatibility checker: saving the current theme to options
		$theme = wp_get_theme();
		$t_props = array();
		if (is_object($theme)) {
			$parent_theme = $theme->{"Parent Theme"};
			$is_child_theme = ($parent_theme && (strlen($parent_theme) > 0)) ? 1 : 0;
			$t_parent = $theme->parent();
			$t_props = array(
				'name' => $theme->Name,
				'version' => $theme->Version,
				'is_child_theme' => $is_child_theme,
				'base_name' => $is_child_theme && $t_parent && is_object($t_parent) ? $parent_theme : $theme->Name,
				'base_version' => $is_child_theme && $t_parent && is_object($t_parent) ? $t_parent->Version : $theme->Version,
				'is_hook_available' => 0,
			);
		}
		global $wpfts_compat_data, $wpfts_compat_installed;

		$wpfts_compat_installed = 0;

		if (isset($t_props['base_name']) && (strlen($t_props['base_name']) > 0) && isset($wpfts_compat_data['themes'][$t_props['base_name']][0])) {
			// We found an (in)compatible theme
			$is_req = 1;
			if (isset($wpfts_compat_data['themes'][$t_props['base_name']][1])) {
				$is_req = $wpfts_compat_data['themes'][$t_props['base_name']][1];
			}
			if ($is_req == 0) {
				// Hook not required!
				$t_props['is_hook_available'] = -1;
			} else {
				$compat_file = dirname(__FILE__).'/../compat/themes/'.$wpfts_compat_data['themes'][$t_props['base_name']][0].'/index.php';
				if (file_exists($compat_file)) {
					$t_props['is_hook_available'] = 1;
	
					$is_use_theme_compat = intval($this->get_option('is_use_theme_compat'));
					if ($is_use_theme_compat) {
						require_once $compat_file;
					}
				}	
			}
		}
		$this->set_option('theme_options', $t_props);

		$upds = $this->GetUpdates();

		if (isset($upds['has_changes']) && ($upds['has_changes'])) {
			$this->log('Version updates: '.print_r($upds, true));
		}

		if ($upds['is_new']) {
			// New installation
			$this->set_option('index_ready', 0);	// Disable index
			//$this->get_option('is_welcome_message', json_encode($upds['texts']));	// Welcome message

			if (isset($upds['text']) && $upds['text']) {
				$this->set_option('is_welcome_message', wpfts_json_encode($upds['text']));	// Welcome message
			}

			// We going to create DB tables first anyway
			if (strlen($this->get_option('updatedb_error_message')) < 1) {
				$is_ok = false;
				$err = $this->_database->updateDB();
				if ($err && isset($err['is_error']) && (!$err['is_error'])) {
					// Database has been upgraded, set current_db_version to actual_version
					$actual_version = WPFTS_VERSION;
					$this->set_option('current_db_version', $actual_version);
					$this->set_option('updatedb_error_message', '');
					$this->set_option('updatedb_valid', 1);
					$is_ok = true;
				}
				if (!$is_ok) {
					// Error while creating the database
					$s = '<p><b style="color: red;">'.__('WP Fast Total Search: Automatic database creating failed with error:', 'fulltext-search').'</b> <br><br><i><b>'.$err['error_message'].'</b></i>.</p>'; 
					$s .= '<p>'.__('Until the database is in the correct state, the plugin will not function correctly. To fix this, try retrying the update, or contact technical support. If your database is small, you can also rebuild the index from scratch. This usually works.', 'fulltext-search').'</p>';
					
					$this->set_option('updatedb_error_message', $s);
					$this->set_option('updatedb_valid', 0);				
				}
			}
		} else {
			if ($upds['is_rebuild']) {
				// DB is outdated
				// Require DB update
				$this->set_option('index_ready', 0);	// Disable index
				$this->set_option('is_db_outdated', 1);	// Set outdated flag
			} else {
				$this->set_option('is_db_outdated', 0);	// Ok with DB version
			}

			if (isset($upds['text']) && (is_array($upds['text'])) && (count($upds['text']) > 0)) {
				$this->set_option('change_log', wpfts_json_encode($upds['text']));
			}

			if (isset($upds['callback']) && (is_array($upds['callback'])) && (count($upds['callback']) > 0) && 
				isset($upds['text_notices']) && (is_array($upds['text_notices'])) && (count($upds['text_notices']) > 0)) {

				// Display notices if exist
				if (isset($upds['text_notices']) && (is_array($upds['text_notices'])) && (count($upds['text_notices']) > 0)) {
					$this->set_option('change_notices', wpfts_json_encode($upds['text_notices']));
				}

				// Let's execute callbacks
				$is_success = true;
				foreach ($upds['callback'] as $cb) {
					if (is_callable($cb)) {
						try {
							$is_success = call_user_func($cb);
						} catch (Exception $e) {
							print_r('Error while calling update callback: '.$e->getMessage());
							$is_success = false;
						}
						if (!$is_success) {
							break;
						}
					}
				}

				if (!$is_success) {
					// Switch off the index and propose user to rebuild the index (worst case)
					$this->set_option('index_ready', 0);	// Disable index
					$this->set_option('is_db_outdated', 1);	// Set outdated flag
				} else {
					// All is fine, update DB version
					//$this->set_option('current_db_version', WPFTS_VERSION);
				}
				// We make code changes only once
				$this->set_option('current_cb_version', WPFTS_VERSION);
			}

			// We going to check if we need to upgrade DB
			if (strlen($this->get_option('updatedb_error_message')) < 1) {
				if (isset($upds['is_version_changed']) && ($upds['is_version_changed'])) {
					$is_ok = false;
					$err = $this->_database->updateDB();
					if ($err && isset($err['is_error']) && (!$err['is_error'])) {
						// Database has been upgraded, set current_db_version to actual_version
						$actual_version = WPFTS_VERSION;
						$this->set_option('current_db_version', $actual_version);
						$this->set_option('updatedb_error_message', '');
						$this->set_option('updatedb_valid', 1);
						$is_ok = true;
					}
					if (!$is_ok) {
						// Error while creating the database
						$s = '<p><b style="color: red;">'.__('WP Fast Total Search: Automatic database update failed with error:', 'fulltext-search').'</b> <br><br><i><b>'.$err['error_message'].'</b></i>.</p>'; 
						$s .= '<p>'.__('Until the database is in the correct state, the plugin will not function correctly. To fix this, try retrying the update, or contact technical support. If your database is small, you can also rebuild the index from scratch. This usually works.', 'fulltext-search').'</p>';
						
						$this->set_option('updatedb_error_message', $s);
						$this->set_option('updatedb_valid', 0);				
					}	
				}
			}
		}

		$this->FeatureDetector();
	}
	
	public function GetIndex()
	{
		return $this->_index;
	}

	public function SetTopLevelScreen($screen_id)
	{
		$this->toplevel_screen = $screen_id;
	}

	public function SetPrefixScreen($screen_id)
	{
		$this->prefix_screen = $screen_id;
	}

	public function set_is_settings_page()
	{
		// If we are on the WPFTS Settings Pages?
		$screen = get_current_screen();
		$hook_suffix = !is_null($screen) ? $screen->id : '';

		$is_wpfts_settings_page = false;
		if (substr($hook_suffix, 0, strlen($this->prefix_screen)) == $this->prefix_screen) {
			$is_wpfts_settings_page = true;
		} else {
			if ($hook_suffix == $this->toplevel_screen) {
				$is_wpfts_settings_page = true;
			}
		}
		$this->is_wpfts_settings_page = $is_wpfts_settings_page;
	}

	public function admin_notices()
	{
		$is_all_great = true;

		if ((strlen($this->get_option('is_welcome_message')) > 0) && (!$this->is_wpfts_settings_page)) {
			// Welcome message
			$text = json_decode($this->get_option('is_welcome_message'), true);
			if (isset($text[0])) {
				$s = $text[0];
				$this->output_admin_notice($s, 'notice notice-success is-dismissible wpfts-notice', 'welcome_message');

				$is_all_great = false;
			}
		}

		// Let's check if we have something to say!
		$text = json_decode($this->get_option('change_log'), true);

		if (is_array($text) && (count($text) > 0)) {
			$s = __('<b>WP Fast Total Search</b> new changes:', 'fulltext-search').'<br><br>';
			$a = array();
			foreach ($text as $k => $d) {
				$a[] = sprintf(__('In the version <b>%s</b>:', 'fulltext-search'), $k).'<br>'.$d;
			}
			$s .= implode('<br>', $a);
			$this->output_admin_notice($s, 'notice notice-success is-dismissible wpfts-notice', 'change_log');

			$is_all_great = false;
		}

		$text_notices = json_decode($this->get_option('change_notices'), true);

		if (is_array($text_notices) && (count($text_notices) > 0)) {
			$s = __('<b>WP Fast Total Search</b> important notice:', 'fulltext-search').'<br><br>';
			$a = array();
			foreach ($text_notices as $k => $d) {
				$a[] = sprintf(__('In the version <b>%s</b>:', 'fulltext-search'), $k).'<br>'.$d;
			}
			$s .= implode('<br>', $a);
			$this->output_admin_notice($s, 'notice notice-success is-dismissible wpfts-notice', 'change_notices');

			$is_all_great = false;
		}

		if ($is_all_great) {
			$s = $this->get_option('updatedb_error_message');
			if (strlen($s) > 0) {
				$is_all_great = false;

				$s .= '<p>
				<a href="#" class="button button-primary wpfts_btn_try_updatedb" data-nonce="'.esc_html(wp_create_nonce( 'try_updatedb' )).'">'.esc_html(__('Try Again', 'fulltext-search')).'</a>
				<a href="admin.php?page=wpfts-options-support" class="button button-secondary">'.esc_html(__('Contact Support', 'fulltext-search')).'</a>
				<a href="#" class="wpfts_btn_rebuild" data-confirm="'.esc_attr(__('This action will completely rebuild the search index, which may take some time. Are you sure?', 'fulltext-search')).'" data-rebuild_nonce="'.esc_html(wp_create_nonce('index_rebuild_nonce')).'">'.esc_html(__('Rebuild Index', 'fulltext-search')).'</a>
			</p>';

				// UpdateDB failed message
				$this->output_admin_notice($s, 'notice notice-error is-dismissible wpfts-notice', 'updatedb_error_message');
			}
		}

		if (intval($this->get_option('is_db_outdated'))) {

			$is_all_great = false;

			if ($this->is_wpfts_settings_page) {
				// DB update required message (for internal pages)
				$s = __('<b style="color: red;">The plugin\'s database requires update.</b><br>It is necessary to rebuild the index to ensure the correct operation of the search engine. This may take some time.<br><br>Click <a href="#" class="btn_notify_start_indexing" data-rebuild_nonce="'.esc_html(wp_create_nonce('index_rebuild_nonce')).'">here</a> to rebuild the search index now.', 'fulltext-search');

				$this->output_admin_notice($s, 'notice notice-warning wpfts-notice', 'db_update');
			} else {
				// DB update required message (for ext pages)
				$s = __('<b style="color: red;">Attention!</b> <b>WP Fast Total Search</b> plugin requires your attention.<br><br>Please <a href="admin.php?page=wpfts-options">click HERE</a> to go to WPFTS Settings page.', 'fulltext-search');

				$this->output_admin_notice($s, 'notice notice-warning wpfts-notice', 'db_update');
			}
		}
	
		$is_all_great = apply_filters('wpfts_admin_notices_in_serie', $is_all_great);

		if ($is_all_great) {
			// We can show other messages
			$s = $this->get_option('detector_message');
			if (strlen($s) > 0) {
				// Detector message
				$this->output_admin_notice($s, 'notice notice-warning is-dismissible wpfts-notice', 'detector_message');
			}

			$s = $this->get_option('detector2_message');
			if (strlen($s) > 0) {
				// Detector2 message
				$this->output_admin_notice($s, 'notice notice-warning is-dismissible wpfts-notice', 'detector2_message');
			}

			$s = $this->get_option('detector3_message');
			if (strlen($s) > 0) {
				// Detector3 message
				$this->output_admin_notice($s, 'notice notice-warning is-dismissible wpfts-notice', 'detector3_message');
			}

			$s = $this->get_option('reqreset_message');
			if (strlen($s) > 0) {
				// ReqReset message
				$this->output_admin_notice($s, 'notice notice-warning is-dismissible wpfts-notice', 'reqreset_message');
			}
		}
	}

	public function GetUpdates()
	{
		$current_db_version = $this->get_option('current_db_version');
		$current_code_version = $this->get_option('current_cb_version');
		$actual_version = WPFTS_VERSION;

		$is_pro = (version_compare($actual_version, '2.0.0', '>=')) ? 1 : 0;

		$is_pro_installed = $this->get_option('is_pro_installed');

		if ($is_pro_installed) {
			if ($this->is_wpfts_settings_page) {
				// Simple Initial Wizard
				return array(
					'is_new' => true,
					'is_rebuild' => true,
					'text' => array(__('<h2>Initial Configuration Wizard</h2> First of all, thank you for your support by purchasing the copy of the WPFTS Pro plugin. Thus you are supporting the plugin development and the whole Open Source code movement.', 'fulltext-search')),
					'has_changes' => true,
				);
			} else {
				// Show Welcome message
				return array(
					'is_new' => true,
					'is_rebuild' => true,
					'text' => array(__('<b style="color: red;">Congratulations!</b> <b>WP Fast Total Search Pro plugin</b> has just been installed!<br><br>To complete the installation, please follow some steps on the <a href="admin.php?page=wpfts-options">WPFTS Settings Page</a>', 'fulltext-search')),
					'has_changes' => true,
				);
			}
		}

		if (strlen($current_db_version) > 0) {
			// Check if we have an actual version of the database
			$changes = array(
				'is_new' => false,
				'is_rebuild' => false,
				'db_changes' => array(),
				'text' => array(),
				'text_notices' => array(),
				'callback' => array(),
				'is_version_changed' => false,
				'has_changes' => false,
			);

			// We started to track code changes from the 1.37.101 and 2.40.151
			if (strlen($current_code_version) < 1) {
				$current_code_version = $is_pro ? '2.40.151' : '1.37.101';
			}

			// Ignore version folder in case we have current_db_version and current_code_version 
			// equal or greater than actual_version
			if (version_compare($actual_version, $current_db_version, '<=')) {
				if (version_compare($actual_version, $current_code_version, '<=')) {
					// Already up to date
					return $changes;
				}
			} else {
				// Database needs update
				$changes['is_version_changed'] = true;
				$changes['has_changes'] = true;
			}

			// Get all changes from the 'version' folder
			$list_files = array();

			$path_version = dirname(__FILE__).'/version/';
			$old_dir = getcwd();
			chdir($path_version);
			foreach (glob('*.php') as $file) {
				$zz = array();
				if (preg_match('~^(\d+_\d+_\d+)\.php$~', $file, $zz)) {
					// If this version good for us?
					$v = str_replace('_', '.', $zz[1]);
					$f_db = version_compare($v, $current_db_version, '>') ? 1 : 0;
					$f_code = version_compare($v, $current_code_version, '>') ? 1 : 0;
					if (($f_db || $f_code) && version_compare($v, $actual_version, '<=')) {
						// Okay, good
						$list_files[$v] = array($file, $f_db, $f_code);
					}
				}
			}
			chdir($old_dir);

			if (count($list_files) > 0) {
				// Let's reorder versions from lower to higher
				$versions = array_keys($list_files);
				usort($versions, function($v1, $v2)
				{
					if (version_compare($v1, $v2, '<')) {
						return -1;
					} else {
						return 1;
					}
				});

				foreach ($versions as $k_version) {
					$data = false;
					try {
						$data = include($path_version.$list_files[$k_version][0]);
					} catch (Exception $e) {
						$data = false;
					}

					if (is_array($data)) {
						// Ok, now iterate till the actual version, inclusive
						if ($list_files[$k_version][1]) {
							// DB changes
							if (isset($data['is_rebuild']) && ($data['is_rebuild'])) {
								$changes['is_rebuild'] = true;
								$changes['has_changes'] = true;
							}
							if (isset($data['db_changes']) && (count($data['db_changes']) > 0)) {
								$changes['db_changes'] = array_merge($changes['db_changes'], $data['db_changes']);
								$changes['has_changes'] = true;
							}	
						}
						if ($list_files[$k_version][2]) {
							if (isset($data['text_notices']) && (strlen($data['text_notices']) > 0)) {
								$changes['text_notices'][$k_version] = $data['text_notices'];
								$changes['has_changes'] = true;
							}
							if (isset($data['callback']) && is_callable($data['callback'])) {
								$changes['callback'][$k_version] = $data['callback'];
								$changes['has_changes'] = true;
							}
						}
					}

				}

			}

			return $changes;
		} else {
			// No updates (just create a new database and reindex)
			return array(
				'is_new' => true,
				'is_rebuild' => true,
				'text' => array(__('<b style="color: red;">Congratulations!</b> <b>WP Fast Total Search plugin</b> has just been installed and successfully activated!<br><br>To complete the installation, we need to create the Search Index of your existing WP posts data. To start this process, simply go to the <a href="admin.php?page=wpfts-options">WPFTS Settings Page</a>', 'fulltext-search')),
				'has_changes' => true,
			);
		}
	}

	public function output_admin_notice($text, $type = 'error', $n_id = '', $is_raw = false)
	{
		if ($is_raw) {
			?>
			<div class="<?php echo esc_attr($type); ?>" data-notificationid="<?php echo esc_attr($n_id); ?>"><?php echo $text; ?></div>
			<?php
		} else {
			?>
		    <div class="<?php echo esc_attr($type); ?>" data-notificationid="<?php echo esc_attr($n_id); ?>"><p><?php echo $text; ?></p></div>
			<?php
		}
	}

	public function network_actdeact($pfunction, $networkwide) 
	{
		global $wpdb;
	 
		if (function_exists('is_multisite') && is_multisite()) {
			// Multisite activation
			if ($networkwide) {
				$old_blog = $wpdb->blogid;
				$blogids = $wpdb->get_col('SELECT blog_id FROM '.$wpdb->blogs);
				foreach ($blogids as $blog_id) {
					switch_to_blog($blog_id);
					call_user_func($pfunction, $networkwide);
				}
				switch_to_blog($old_blog);
				return;
			}   
		}
		// One site activation
		call_user_func($pfunction, $networkwide);
	}
	 
	public function activate_plugin($networkwide) 
	{
		$this->network_actdeact(array(&$this, '_activate_plugin'), $networkwide);
	}
	 
	public function deactivate_plugin($networkwide) 
	{
		$this->network_actdeact(array(&$this, '_deactivate_plugin'), $networkwide);
	}

	public function _activate_plugin($networkwide = false)
	{
		if (!function_exists('register_post_status')) {
			deactivate_plugins(basename(dirname( __FILE__ )).'/'.basename (__FILE__));

			$this->log('Activating plugin: WP version too low');

			wp_die(esc_html(__( "This plugin requires WordPress 3.0 or newer. Please update your WordPress installation to activate this plugin.", 'fulltext-search' )));
		}

		if ((isset($_GET['action'])) && ($_GET['action'] == 'error_scrape')) {
			// Showing error
			$this->log('Activating plugin, show error: '.$this->get_option('activation_error'));

			echo esc_html(__('Error: ', 'fulltext-search').$this->get_option('activation_error'));
			//$this->set_option('activation_error', '');
			
		} else {

			$this->log('Plugin activation');

			// Check db
			// We have to do this each time on plugin activation just for precaution, because
			// current_db_version can be up-to-date, but DB actually not actual.
			$this->_database->updateDB();

			// Reinstall scheduler
			$this->removeCronIndexerTask();
			$this->installCronIndexerTask();

			$this->log('Plugin activation completed');
		}
	}
	
	public function removeCronIndexerTask()
	{
		wp_clear_scheduled_hook('wpfts_indexer_event');
		wp_clear_scheduled_hook('wpfts_log_clean');
	}

	public function installCronIndexerTask()
	{
		if (!wp_next_scheduled('wpfts_indexer_event')) {
			wp_schedule_event( time(), 'wpfts_each_minute', 'wpfts_indexer_event');
		}
		if (!wp_next_scheduled('wpfts_log_clean')) {
			wp_schedule_event( time(), 'wpfts_each_hour', 'wpfts_log_clean');
		}
	}

	public function _deactivate_plugin($networkwide = false) 
	{
		$this->log('Plugin deactivation');

		$this->removeCronIndexerTask();

		// Break indexer loop
		$this->set_option('is_break_loop', 1);
	}
	
	public function getPid()
	{
		if (!$this->_pid) {
			$this->_pid = sha1(time().uniqid());
		}
		
		return $this->_pid;
	}
	
	public function get_post_types()
	{
		$post_types = get_post_types('', 'objects');

		$z = array();
		foreach ($post_types as $k => $d) {
			$z[$k] = isset($d->labels->singular_name) ? $d->labels->singular_name : $k;
		}

		return $z;
	}
	
	public function get_cluster_types()
	{
		return $this->_index->getClusters();
	}

	protected function default_options() 
	{
		$default_options = array(
			'enabled' => 1,
			'autoreindex' => 1,
			'index_ready' => 0,
			'deflogic' => 1, // OR
			'minlen' => 3,
			'maxrepeat' => 80, // 80%
			'stopwords' => '',
			'epostype' => '',
			'cluster_weights' => serialize(array(
				'post_title' => 0.8,
				'post_content' => 0.5,
			)),
			'relevance_finetune' => serialize(array()),
			'testpostid' => '',
			'testquery' => '',
			'tq_disable' => 0,
			'tq_nocache' => 1,
			'tq_post_status' => 'any',
			'tq_post_type' => 'any',
			'tq_perpage' => 25,
			'rebuild_time' => 0,
			'process_time' => '0|',
			'ping_period' => 30,
			'est_time' => '00:00:00',
			'internal_search_terms' => 1,
			'use_stemming' => 1,
			'stemming_language' => 'auto',
			'include_attachments' => 1,
			'content_open_shortcodes' => 1,
			'content_is_remove_nodes' => 1,
			'deeper_search' => 0,
			'display_attachments' => 1,
			'is_welcome_message' => '',
			'current_db_version' => '',
			'current_cb_version' => '',
			'is_db_outdated' => 0,
			'mainsearch_orderby' => 'relevance',
			'mainsearch_order' => 'DESC',
			'is_smart_excerpts' => 1,
			'is_fix_blocks' => 1,
			'is_smart_excerpt_text' => 1,
			'is_show_score' => 1,
			'is_not_found_words' => 1,
			'optimal_length' => 300,
			'custom_se_css' => '_get_css_file_',
			'sentence_styles' => serialize(array(
				array(
					'is_on' => 1,
					'is_regexp' => 1,
					'key_term' => 'post_content|post_excerpt',
					'caption' => '',
					'newline_type' => 0,
					'url_type' => 5,
					'url_template' => '{{post_url}}#:$:sentence={{sentence}}&:$:word={{word}}',
					'class_name' => '',
				),
				array(
					'is_on' => 1,
					'is_regexp' => 1,
					'key_term' => '.*/pages/page_(\d+)',
					'caption' => 'Page #{{$1}}',
					'newline_type' => 0,
					'url_type' => 5,
					'url_template' => '{{post_url}}?file_page={{$1}}&hlsentence={{sentence}}&hlword={{word}}',
					'class_name' => '',
				),
			)),

			'q_id' => 1000,
			'qlog_settings' => '',
			'preset_selector' => serialize(array(
				'wpmainsearch_admin' => '',
				'wpmainsearch_frontend' => 'frontend_default',
				'wpblockquery' => 'frontend_default',
			)),
			'presetdata_frontend_default' => serialize(array(
				'ident' => 'frontend_default',
				'name' => 'Default Frontend Search',
				'use_indexed_search' => 1,
			)),
			'presetdata_backend_default' => serialize(array(
				'ident' => 'backend_default',
				'name' => 'Default Admin Search',
				'use_indexed_search' => 1,
			)),
			'exclude_post_types' => serialize(array('revision', 'inherit')),
			'exclude_post_statuses' => serialize(array('auto-draft', 'draft', 'trash')),
			'exclude_post_ids' => serialize(array()),
			'exclude_post_slugs' => serialize(array()),

			'flare_mid' => '',
			'last_sync_ts' => 0,	// The timestamp of the last sync
			'is_break_loop' => 0,
			'is_pause' => 0,
			'ts_series' => '',

			'is_fixmariadb' => 1,
			'is_optimizer' => 0,
			'status_next_ts' => 0,
			'status_cache' => '',
			'last_indexerstart_ts' => 0,
			'irules_status_next_ts' => 0,
			'irules_status_cache' => '',

			'activation_error' => '',
			'subscription_key' => '',
			'is_pro_installed' => 0,
			'limit_mimetypes' => '',

			'change_log' => '',
			'change_notices' => '',

			'content_strip_tags' => 1,
			'detector_message' => '',
			'detector_message_expdt' => '',

			'detector2_message' => '',
			'detector2_message_expdt' => '',

			'detector3_message' => '',
			'detector3_message_expdt' => '',
			'detector3_lastresult' => 0,

			'reqreset_message' => '',
			'reqreset_message_expdt' => '',
			'irules_hash' => '',

			'ps1_start_dt' => '',
			'ps1_message' => '',
			'ps1_message_expdt' => '',

			'wpftslic_message' => '',
			'wpftslic_message_type' => 0,
			'wpftslic_message_key' => '',
			'wpftslic_message_expdt' => '',

			'updatedb_error_message' => '',
			'updatedb_error_message_expdt' => '',

			'addon_list' => '',
			'addon_list_error' => '',

			'theme_options' => serialize(array()),
			'is_use_theme_compat' => 1,
		);

		return apply_filters('wpfts_default_options', $default_options);
	}
	
	public function get_option($optname, $is_force_reread = false)
	{
		$defaults = $this->default_options();

		$wp_optname = 'wpfts_'.$optname;

		if ($is_force_reread && isset($GLOBALS['wp_object_cache']) && is_object($GLOBALS['wp_object_cache'])) {
			$GLOBALS['wp_object_cache']->delete($wp_optname , 'options');
		}

		$v = get_option($wp_optname, isset($defaults[$optname]) ? $defaults[$optname] : false);

		if (substr($optname, 0, 11) == 'presetdata_') {
			$v = ($v && (strlen($v) > 0)) ? @unserialize($v) : array();
		} else {
			switch ($optname) {
				case 'cluster_weights':
					$v = (strlen($v) > 0) ? @unserialize($v) : array();
					// We have to have post_title and post_content
					if (!isset($v['post_title'])) {
						$v['post_title'] = 0.8;
					}
					if (!isset($v['post_content'])) {
						$v['post_content'] = 0.5;
					}
					break;
				case 'custom_se_css':
					if ($v == '_get_css_file_') {
						// Read from file
						$v = $this->ReadSEStyles();
					}
					break;
				// Serialized arrays					
				case 'epostype':
				case 'addon_list':
				case 'preset_selector':
				case 'exclude_post_types':
				case 'exclude_post_statuses':
				case 'exclude_post_ids':
				case 'exclude_post_slugs':
				case 'sentence_styles':
				case 'relevance_finetune':
				case 'theme_options':
					if (is_string($v)) {
						$v = (strlen($v) > 0) ? @unserialize($v) : array();
					}
					break;
			}
		}

		return apply_filters('wpfts_get_option', $v, $optname, $is_force_reread);
	}

	public function set_option($optname, $value)
	{
//$logname = dirname(__FILE__).'/../wpfts_options_log.txt';
//		file_put_contents($logname, "\n".date('Y-m-d H:i:s', current_time('timestamp')).' Save option: '.$optname.', value: '.print_r($value, true)."\n", FILE_APPEND);

		$defaults = $this->default_options();
		
//		file_put_contents($logname, date('Y-m-d H:i:s', current_time('timestamp')).' Defaults has '.count($defaults).' values'."\n", FILE_APPEND);

		if (isset($defaults[$optname])) {
			// Allowed option
			$v = $value;
			switch ($optname) {
				case 'epostype':
				case 'cluster_weights':
				case 'addon_list':
				case 'preset_selector':
				case 'exclude_post_types':
				case 'exclude_post_statuses':
				case 'exclude_post_ids':
				case 'exclude_post_slugs':
				case 'sentence_styles':
				case 'relevance_finetune':
				case 'theme_options':
					$v = serialize($value);
					break;
			}

			$option_name = 'wpfts_'.$optname;

//			$current_value = get_option($option_name, false);
//			ob_start();
//			var_dump($current_value);
//			$cv = ob_get_clean();

//			file_put_contents($logname, date('Y-m-d H:i:s', current_time('timestamp')).' Allowed. Current value: '.print_r($cv, true)."\n", FILE_APPEND);

			//if (get_option($option_name, false) !== false) {
				update_option($option_name, $v, false);
			//} else {
			//	add_option($option_name, $v, '', 'no');
			//}

//			$new_value = get_option($option_name, false);
//			ob_start();
//			var_dump($new_value);
//			$v2 = ob_get_clean();

//			file_put_contents($logname, date('Y-m-d H:i:s', current_time('timestamp')).' New value after read: '.print_r($v2, true)."\n", FILE_APPEND);

			return true;
		} else {
			// Not allowed option
//			file_put_contents($logname, date('Y-m-d H:i:s', current_time('timestamp')).' NOT Allowed'."\n", FILE_APPEND);

			return false;
		}
	}
	
	/**
	* This method is called on plugin 'init' hook. Do not place here any code 
	* that is initialized later 
	*/
	public function FeatureDetector()
	{
		global $wpdb;

		$is_feature_number = apply_filters('wpfts_feature_number', 0);
		if ($is_feature_number < 1) {

			$pro_supported_mimes = array(
				'text/rtf' => 'RTF',
				'application/rtf' => 'RTF',
				'application/pdf' => 'Portable Document (PDF)',
				'application/msword' => 'Microsoft Word (DOC)',
				'application/vnd.ms-excel' => 'Microsoft Excel (XLS)',
				'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'Microsoft Word (DOCX)',
				'application/vnd.ms-excel.sheet.macroEnabled.12' => 'XLSM',
				'application/vnd.ms-excel.sheet.binary.macroEnabled.12' => 'XLSB',
				'application/vnd.openxmlformats-officedocument.spreadsheetml.template' => 'XLTX',
				'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'PowerPoint (PPTX)',
				'application/vnd.openxmlformats-officedocument.presentationml.template' => 'POTX',
				'application/vnd.oasis.opendocument.text' => 'Open Document (ODT)',
				'application/vnd.oasis.opendocument.presentation' => 'Open Document Presentation (ODP)',
				'application/vnd.oasis.opendocument.spreadsheet' => 'Open Document Spreadsheet (ODS)',
				'application/vnd.oasis.opendocument.graphics' => 'Open Document Graphics (ODG)',
				'application/epub+zip' => 'EPUB',
				'application/vnd.oasis.opendocument.text-template' => 'Open Document Template (OTT)',
				'application/vnd.oasis.opendocument.graphics-template' => 'Open Document Template (OTG)',
				'application/vnd.oasis.opendocument.presentation-template' => 'Open Document Template (OTP)',
				'application/vnd.oasis.opendocument.spreadsheet-template' => 'Open Document Template (OTS)',
			);
			$mimes_q = array();
			foreach ($pro_supported_mimes as $k => $d) {
				$mimes_q[] = '"'.$k.'"';
			}

			$expdt = $this->get_option('detector_message_expdt');

			if (strlen($expdt) > 0) {
				if (strtotime($expdt) < current_time('timestamp')) {
					// Ok, let's check now
					$q = 'select 
							post_mime_type, 
							count(*) n 
						from `'.$wpdb->posts.'` 
						where 
							(post_type = "attachment") and 
							post_mime_type in ('.implode(',', $mimes_q).')
						group by post_mime_type 
						order by n desc';
					$res2 = $this->db->get_results($q, ARRAY_A);

					if ((count($res2) > 0) && ($res2[0]['n'] >= 10)) {
						// Found something
						/* translators: %1$1s is the number of files, %2$2s is the mime-type */
						$notify_text = '<p>'.sprintf(wp_kses(__('<b>Important Notice:</b> WP Fast Total Search plugin has detected %1$1s files of the type %2$2s', 'fulltext-search'), array('b' => array())), '<b>'.$res2[0]['n'].'</b>', '<b>'.$pro_supported_mimes[$res2[0]['post_mime_type']].'</b>');
						if (count($res2) > 1) {
							$notify_text .= ' '.esc_html(__('and other supported files', 'fulltext-search'));
						}
						$notify_text .= '.</p>';
						/* translators: %1$1s and %2$2s are open and close A tags respectively */
						$notify_text .= '<p>'.sprintf(wp_kses(__('%1$1s Click here %2$2s to learn how to make them searchable by their <b>text content</b> and improve your website usability.', 'fulltext-search'), array('b' => array())), '<a href="https://fulltextsearch.org" target="_blank">', '</a>').'</p>';
	
						$notify_text .= '<p>&nbsp;</p>';
						$notify_text .= '<p><a href="https://fulltextsearch.org" target="_blank" class="button">'.esc_html(__('Learn More', 'fulltext-search')).'</a> <span style="margin-left: 20px;text-decoration: underline;color: #888;cursor: pointer;" class="dismiss-link">'.esc_html(__("Don't Show Again", 'fulltext-search')).'</span></p>';

						$this->set_option('detector_message', $notify_text);
					
						// Recheck in a week if not dismissed
						$this->set_option('detector_message_expdt', date('Y-m-d H:i:s', current_time('timestamp') + 3600 * 24 * 7));
					
					} else {
						// Nothing were found, let's delay for a week
						$this->set_option('detector_message_expdt', date('Y-m-d H:i:s', current_time('timestamp') + 3600 * 24 * 7));
					}
			
				} else {
					// No need to check now
				}
			} else {
				// Never processed yet
				$this->set_option('detector_message_expdt', date('Y-m-d H:i:s', current_time('timestamp') + 15 * 60));
			}
		} else {
			// Do not check for 1 day at least
			$this->set_option('detector_message', '');
			$this->set_option('detector_message_expdt', date('Y-m-d H:i:s', current_time('timestamp') + 24 * 3600));
		}

		$ps1_expdt = $this->get_option('ps1_message_expdt');

		if (strlen($ps1_expdt) > 0) {
			if (strtotime($ps1_expdt) < current_time('timestamp')) {
				// @todo

			}
		} else {
			// Never processed yet
			$idx = $this->dbprefix();

			$q = 'select min(`update_dt`) min_date from `'.$idx.'index`';
			$r2 = $this->db->get_results($q, ARRAY_A);

			$min_ts = current_time('timestamp');
			if ($r2 && (count($r2) > 0)) {
				$min_ts = strtotime($r2[0]['min_date']);
			}

			$this->set_option('ps1_message_expdt', '');
			$this->set_option('ps1_start_dt', date('Y-m-d H:i:s', $min_ts));
			$this->set_option('ps1_message_expdt', date('Y-m-d H:i:s', $min_ts + 24 * 3600 * 14));
		}

		// Detect x64
		if (PHP_INT_SIZE != 8) {
			$expdt = $this->get_option('detector2_message_expdt');

			if (strlen($expdt) > 0) {
				if (strtotime($expdt) < current_time('timestamp')) {
					// x86 does not supported. Let's warn about this
					$notify_text = '<p>'.wp_kses(__('<b>Important Notice:</b> WP Fast Total Search plugin is optimized for x64 platforms, however your website is currently using 32-bit version of PHP.', 'fulltext-search'), array('b' => array())).'</p>';
	
					$notify_text .= '<p>'.esc_html(__('As a result, we are forced to use x64 software emulation, which decreases performance and increases search time.', 'fulltext-search')).'</p>';
	
					$notify_text .= '<p>'.wp_kses(__('Please contact your hosting provider to migrate your website to a modern <b>x64</b> server. This will speed up the search by 20-30%, and possibly even more.', 'fulltext-search'), array('b' => array())).'</p>';
	
					$notify_text .= '<p>&nbsp;</p>';
					$notify_text .= '<p><span style="text-decoration: underline;color: #888;cursor: pointer;" class="dismiss-link">'.esc_html(__("Don't Show Again", 'fulltext-search')).'</span></p>';
	
					$this->set_option('detector2_message', $notify_text);
					
					// Recheck in a week if not dismissed
					$this->set_option('detector2_message_expdt', date('Y-m-d H:i:s', current_time('timestamp') + 3600 * 24 * 7));
				}
			} else {
				// Never processed yet
				$this->set_option('detector2_message_expdt', date('Y-m-d H:i:s', current_time('timestamp') + 5 * 60));
			}	
		} else {
			// Okay, x64 is supported!
			// Do not check for 1 day at least
			$this->set_option('detector2_message', '');
			$this->set_option('detector2_message_expdt', date('Y-m-d H:i:s', current_time('timestamp') + 24 * 3600));
		}

		// Detect less than 256M or more than 512M
		$memory_limit = intval($this->get_memory_limit());

		$new_result = 0;
		if (($memory_limit > 0) && ($memory_limit < 510 * 1024 * 1024)) {
			if ($memory_limit < 256 * 1024 * 1024) {
				$new_result = 1;
			} else {
				$new_result = 2;
			}
		}

		if ($new_result > 0) {
			$expdt = $this->get_option('detector3_message_expdt');

			if (strlen($expdt) > 0) {
				if (strtotime($expdt) < current_time('timestamp')) {
					// Ok, let's check now
					$last_result = intval($this->get_option('detector3_lastresult'));

					if ($last_result != $new_result) {
						$memory_limit_ini = ini_get('memory_limit');	// Use for output only

						$notify_text = '';
						if ($new_result == 1) {
							// Critical error
							$notify_text .= '<p><b style="color:red;text-decoration:underline;">'.esc_html(__('CRITICAL MEMORY LIMIT', 'fulltext-search')).'</b>: '.sprintf(wp_kses(__('The WPFTS plugin for its work uses the RAM of your website, allocated for PHP scripts. Currently, the server settings allow the use of only %s, which is too small for the plugin to work properly.', 'fulltext-search'), array('b' => array())), '<b>'.$memory_limit_ini.'</b>').'</p>';

							$notify_text .= '<p>'.esc_html(__('You can ignore this message, but in this case there may be errors in the plugin\'s operation.', 'fulltext-search')).'</p>';

							$notify_text .= '<p>'.sprintf(wp_kses(__('Recommended value is <b>512M</b> or more. %1$1s Click here %2$2s to learn how to increase the <code>memory_limit</code> value on your site.', 'fulltext-search'), array('b' => array(), 'code' => array())), '<a href="https://fulltextsearch.org/how-to-set-up-memory_limit-value-for-wordpress/" target="_blank">', '</a>').'</p>';
						} else {
							// Friendly warning
							$notify_text .= '<p><b style="color: #dba617;text-decoration:underline;">'.esc_html(__('LOW MEMORY LIMIT', 'fulltext-search')).'</b>: '.sprintf(wp_kses(__('The WPFTS plugin for its work uses the RAM of your website, allocated for PHP scripts. Currently, the server settings allow the use of only %s, which is enough for the plugin, but still may generate slow downs or errors on big post/page indexing.', 'fulltext-search'), array('b' => array())), '<b>'.$memory_limit_ini.'</b>').'</p>';

							/* translators: %1$1s and %2$2s are open and close A tags respectively */
							$notify_text .= '<p>'.sprintf(wp_kses(__('We strongly recommend increasing the <code>memory_limit</code> value to <b>512M</b> or more. Find out how to do this on %1$1s this page %2$2s.', 'fulltext-search'), array('b' => array(), 'code' => array())), '<a href="https://fulltextsearch.org/how-to-set-up-memory_limit-value-for-wordpress/" target="_blank">', '</a>').'</p>';
						}	
						$this->set_option('detector3_message', $notify_text);
					}

					$this->set_option('detector3_lastresult', $new_result);
					
					// Recheck in 5 min if not dismissed
					$this->set_option('detector3_message_expdt', date('Y-m-d H:i:s', current_time('timestamp') + 5 * 60));
				} else {
					// No need to check now
				}
			} else {
				// Never processed yet, show warning in 5 min
				$this->set_option('detector3_message_expdt', date('Y-m-d H:i:s', current_time('timestamp') + 5 * 60));
			}
		} else {
			// More than 512M, satisfied
			// Do not check for 1 minute at least
			$this->set_option('detector3_message', '');
			$this->set_option('detector3_message_expdt', date('Y-m-d H:i:s', current_time('timestamp') + 1 * 60));
			$this->set_option('detector3_lastresult', 0);
		}

		// Detect too low set_time_limit
		/*
		$time_limit = intval(ini_get("max_execution_time"));
		if ($time_limit <= 59) {
			// Too small time limit

		} else {
			// Enough time
		}
		*/
	}

	public function FeatureDetectorAfterInitAdmin()
	{
		// Detect records to be reset
		// Create hash for current ruleset and compare with previous one
		$hash = $this->createIRulesHash();
		$last_hash = $this->get_option('irules_hash');

		$expdt = $this->get_option('reqreset_message_expdt');

		if (strlen($expdt) > 0) {
			if (($hash !== $last_hash) || (strtotime($expdt) < current_time('timestamp'))) {
				// Ok, let's check now
				$irules_stats = (array)$this->getCurrentIRulesStats(false, true);	// Force to get from cache only

				$n_req_reset = isset($irules_stats['n_req_reset']) ? intval($irules_stats['n_req_reset']) : 0;

				if ($n_req_reset > 0) {

					$notify_text = '<p><b>WP Fast Total Search index:</b> '.sprintf(esc_html(__('The indexing rule set has changed and now %s records do not match the rules. Run a partial index update (this may take a while) or check the current ruleset.', 'fulltext-search')), '<b>'.$n_req_reset.'</b>').'</p>';

					$notify_text .= '<p>
        				<a href="#" class="button button-primary wpfts_btn_upgrade_index"  data-upgradeindex_nonce="'.esc_html(wp_create_nonce('upgradeindex_nonce')).'">'.esc_html(__('Upgrade Index', 'fulltext-search')).'</a>
        				<a href="admin.php?page=wpfts-options-indexing-engine" class="button button-secondary">'.esc_html(__('Check Rules', 'fulltext-search')).'</a>
						<span style="text-decoration: underline;color: #888;cursor: pointer;" class="dismiss-link">'.esc_html(__("Hide for 1 day", 'fulltext-search')).'</span>
					</p>';

					$this->set_option('reqreset_message', $notify_text);
				
					// Recheck shortly if not dismissed
					$this->set_option('reqreset_message_expdt', date('Y-m-d H:i:s', current_time('timestamp') + 1 * 60));
				} else {
					$this->set_option('reqreset_message', '');
				
					// Recheck shortly if not dismissed
					$this->set_option('reqreset_message_expdt', date('Y-m-d H:i:s', current_time('timestamp') + 1 * 60));
				}

			} else {
				// No need to check now
			}
		} else {
			// Never processed yet
			$this->set_option('reqreset_message_expdt', date('Y-m-d H:i:s', current_time('timestamp') + 1 * 60));
		}

		$this->set_option('irules_hash', $hash);
	}

	public function getAdminActions()
	{
		if (!$this->_admin_actions) {
			$this->_admin_actions = new WPFTS_Admin_Actions();
		}

		return $this->_admin_actions;
	}

	public function ReadSEStyles()
	{
		$style_fn = dirname(__FILE__).'/../style/wpfts_front_styles.css';
		if (is_file($style_fn) && file_exists($style_fn)) {
			return file_get_contents($style_fn);
		} else {
			return '/'.'* '.__('Unable to find default stylesheet file', 'fulltext-search').' *'.'/';
		}
	}

	public function MinimizeSEStyle($buffer)
	{
		// Remove HTML (just in case!)
		$buffer = strip_tags($buffer);
		// Remove comments
		$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
		// Remove space after colons
		$buffer = str_replace(': ', ':', $buffer);
		// Remove whitespace
		$buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);

		return $buffer;
	}

	public function ReadSEStylesMinimized($force_reset = false)
	{
		$tr_name = $this->se_css_tr_name;
		$css = get_transient($tr_name);
		if (($css === false) || $force_reset) {
			// Ok, let's create new one
			$css = $this->MinimizeSEStyle($this->get_option('custom_se_css'));
			set_transient($tr_name, $css, $this->se_css_cache_timeout);
		}
		return $css;
	}

	public function checkAndSyncWPPosts()
	{
		return $this->_index->checkAndSyncWPPosts($this->get_option('rebuild_time'));
	}
	
	public function get_status($is_reread_options = false) 
	{	
		$st = $this->_index->get_status();
		$st['is_pause'] = $this->get_option('is_pause', $is_reread_options);
		$st['enabled'] = intval($this->get_option('enabled', $is_reread_options));
		$st['index_ready'] = intval($this->get_option('index_ready', $is_reread_options));
		$st['autoreindex'] = intval($this->get_option('autoreindex', $is_reread_options));

		$st['est_time'] = '--:--:--';
		$ts_series = trim($this->get_option('ts_series', $is_reread_options));
		if (strlen($ts_series) > 2) {
			$aa = json_decode($ts_series, true);
			if (is_array($aa) && (count($aa) == 3)) {
				// Calculate est_time
				$t_avg = ($aa[1] - $aa[0]) / $aa[2];

				if (isset($st['n_pending'])) {
					$est_seconds = intval($t_avg * intval($st['n_pending']));

					$est_h = intval($est_seconds / 3600);
					$est_m = intval(($est_seconds - $est_h * 3600) / 60);
					$est_s = ($est_seconds - $est_h * 3600) % 60;
					$st['est_time'] = sprintf('%02d:%02d:%02d', $est_h, $est_m, $est_s);
				}
			}
		}

		$time = time();
		$st['ts'] = $time;
		
		$last_indexerstart_ts = intval($this->get_option('last_indexerstart_ts', $is_reread_options));
		$st['is_inx_outdated'] = ($last_indexerstart_ts + 1.5 * 60 < $time) ? 1 : 0;
		$st['is_inx_notrun'] = ($last_indexerstart_ts + 5 * 60 < $time) ? 1 : 0;
		
		return $st;
	}
	
	public function rebuild_index($time = false)
	{
		if (!$time) {
			$time = time();
		}
		
		$this->set_option('rebuild_time', $time);
		
		return $this->checkAndSyncWPPosts();
	}
	
	public function split_to_words($str)
	{
		// Replace UTF-8 apostrophes/quotes with ASCII ones
		$str2 = preg_replace("~[\x{00b4}\x{2018}\x{2019}]~u", "'", mb_strtolower($str));

		// Replace quotes also (intentionally commented out for future usage)
		//$str2 = str_replace(array("\x{201C}", "\x{201D}"), '"', $str2);
	
		//preg_match_all("~([\x{00C0}-\x{1FFF}\x{2C00}-\x{D7FF}\w][\x{00C0}-\x{1FFF}\x{2C00}-\x{D7FF}\w'\-]*[\x{00C0}-\x{1FFF}\x{2C00}-\x{D7FF}\w]+|[\x{00C0}-\x{1FFF}\x{2C00}-\x{D7FF}\w]+)~u", $str2, $matches);
		preg_match_all("~([\x{00C0}-\x{1FFF}\x{2C00}-\x{D7FF}\w][\x{00C0}-\x{1FFF}\x{2C00}-\x{D7FF}\w']*[\x{00C0}-\x{1FFF}\x{2C00}-\x{D7FF}\w]+|[\x{00C0}-\x{1FFF}\x{2C00}-\x{D7FF}\w]+)~u", $str2, $matches);
		if (isset($matches[1])) {
			$ws = $matches[1];
		} else {
			$ws = array();
		}
		return apply_filters('wpfts_split_to_words', $ws, $str);
	}

	public function get_memory_limit()
	{
		$memory_limit = ini_get('memory_limit');

		$matches = array();
		if (preg_match('/^(\d+)(.)$/', $memory_limit, $matches)) {
			$letter = strtoupper($matches[2]);
			if ($letter == 'G') {
				$memory_limit = $matches[1] * 1024 * 1024 * 1024; // nnnG -> nnn GB
			} elseif($letter == 'M') {
				$memory_limit = $matches[1] * 1024 * 1024; // nnnM -> nnn MB
			} elseif ($letter == 'K') {
				$memory_limit = $matches[1] * 1024; // nnnK -> nnn KB
			}
		}
		if (!is_numeric($memory_limit)) {
			$memory_limit = intval($memory_limit);
		}

		return $memory_limit;
	}
	
	/**
	 * Insert, Update or Delete index record for specified post
	 * 
	 * @param int $post_id Post ID
	 * @return boolean Success or not
	 */
	/*
	public function reindex_post($post_id, $is_force_remove = false, $is_raw_cache_remove = false) 
	{
		$post = get_post($post_id);
		if ($post && (!$is_force_remove)) {
			// Insert or update index record

			if (!$this->defer_indexing) {
				$chunks2 = $this->getPostChunks($post_id, $is_raw_cache_remove);
			}
			
			$modt = $post->post_modified;
			$time = time();
			$build_time = $this->get_option('rebuild_time');
			$insert_id = $this->_index->updateIndexRecordForPost($post_id, $modt, $build_time, $time, $this->defer_indexing ? 1 : 0);
			
			$res = true;
			if (!$this->defer_indexing) {
				$this->_index->clearLog();
				$res = $this->_index->reindex($insert_id, $chunks2, true);
				$this->index_error = (!$res) ? 'Indexing error: ' . $this->_index->getLog() : '';
			}
			
			return $res;
		} else {
			// Check if index record exists and delete it
			$this->_index->removeIndexRecordForPost($post_id);
			$this->removeRawCache($post_id);
			return true;
		}
	}
	*/

	/**
	 * @deprecated Compatibility method, will be removed in the next versions
	 */
	public function GetDBPrefix()
	{
		return $this->dbprefix();
	}

	public function dbprefix()
	{
		global $wpdb;

		if (function_exists('is_multisite') && is_multisite()) {
			$blog_id = $wpdb->blogid;
			if ($blog_id > 1) {
				return $this->prefix.$blog_id.'_';
			}
		}
		return $this->prefix;
	}

	public function removeRawCache($post_id)
	{
		$idx = $this->dbprefix();

		$q = 'delete from `'.$idx.'rawcache` where (`object_id` = "'.addslashes($post_id).'") and (`object_type` = "wp_post")';
		$this->db->query($q);
	}

	public function getCachedAttachmentContent($post_id, $is_reset_cache = false) 
	{
		$post = get_post($post_id);
		$chunks = array(
			'post_title' => $post->post_title,
			'post_content' => $post->post_content,
		);

		return apply_filters('wpfts_get_attachment_content', $chunks, $post, $is_reset_cache);
	}

	public function contentStripTags($s)
	{
		return strip_tags($s);
	}

	public function GetShortcodesContent($post_id, $text)
	{
		global $post;

		// We can get a fatal error inside the_content() call...
		$r = '';
		$error = '';

		if (function_exists('interface_exists') && interface_exists('Throwable')) {
			// PHP 7+
			$post = get_post($post_id);
			setup_postdata($post);
			try {
				$r = apply_filters( 'the_content', $text );
				$r = str_replace( ']]>', ']]&gt;', $r );
			} catch (Throwable $e) {
				// Thrown the error!
				$error = $e->getMessage();
			}
			wp_reset_postdata();

		} else {
			// PHP 5+ or lower
			$post = get_post($post_id);
			setup_postdata($post);
			try {
				$r = apply_filters( 'the_content', $text );
				$r = str_replace( ']]>', ']]&gt;', $r );
			} catch (Exception $e) {
				// Thrown the error!
				$error = $e->getMessage();
			}
			wp_reset_postdata();
		}
	
		return array(
			'content' => $r, 
			'error' => $error,
		);
	}

	public function getRulesIDsForPosts($post_ids)
	{
		global $wpdb;

		$prefix = $this->dbprefix();

		if (!is_array($post_ids)) {
			$post_ids = array(intval($post_ids));
		}

		$ww = array();
		foreach ($post_ids as $pid) {
			$ww[] = '"'.intval($pid).'"';
		}

		if (count($ww) < 1) {
			return array();
		}

		$all_rules = (array)$this->decodeAndSyncIndexRules();

		$sql_group = array();
		foreach ($all_rules as $kk => $dd) {
			if (isset($dd['rule_snap']) && isset($dd['filter_sql']) && isset($dd['id']) && isset($dd['is_valid']) && ($dd['is_valid'])) {
				$sql_group[] = 'if('.$dd['filter_sql'].', "'.$dd['id'].'", null)';
			}
		}

		if (count($sql_group) > 0) {
			$q = 'select 
				tt.ID,
				if(length(tt.algs_raw) > 0, tt.algs_raw, "0") algs,
				if (((inx.force_rebuild = 0) and (inx.build_time != 0)) or (isnull(tt.ID)), 0, 1) is_not_indexed,
				if (inx.rules_idset = if(length(tt.algs_raw) > 0, tt.algs_raw, "0"), 1, 0) is_actual
			from (
				select 
					p.ID,
					concat_ws("|", '.implode(',', $sql_group).') algs_raw
				from `'.$wpdb->posts.'` p
				) tt
			left join `'.$prefix.'index` inx
			   	on tt.ID = inx.tid and inx.tsrc = "wp_posts"
			where 
				(tt.`ID` in ('.implode(',', $ww).'))';
			$r2 = $this->db->get_results($q, ARRAY_A);

			return $r2;
		}
		
		return array();
	}

	/**
	 * This method returns the value and type of the given post record part
	 * $post - Object, original post
	 * $field_name - name of the post's part:
	 * 		".<name>" - meta field
	 * 		"@<name>" - taxonomy tag name
	 * 		"<name>" - DB column of the wp_posts record
	 * 
	 * return: array(<value>, <type>) or false if field was not found
	 * 
	 * <type> is: 1 = int, 2 = string, 3 = proc, 4 = html, 5 = array
	 */
	public function getPostFieldByName($post, $field_name)
	{
		if ($post && (is_object($post)) && (strlen($field_name) > 0)) {
			if ($field_name[0] === '.') {
				// Meta field
				$k = substr($field_name, 1);
				$v = get_post_meta($post->ID, $k, true);

				return array($v, is_array($v) ? 5 : 2);
			} else {
				$basic_fields = array(
					'ID' => 1,
					'post_author' => 3,
					'post_date' => 3,
					'post_date_gmt' => 3,
					'post_content' => 4,
					'post_title' => 2,
					'post_excerpt' => 2,
					'post_status' => 2,
					'post_name' => 2,
					'post_modified' => 3,
					'post_modified_gmt' => 3,
					'post_parent' => 3,
					'post_type' => 2,
					'post_mime_type' => 2,
					'comment_count' => 1,
				);
				if (isset($basic_fields[$field_name])) {
					$v = $post->{$field_name};
					return array($v, $basic_fields[$field_name]);
				} else {
					// Unknown field
					return false;
				}
			}
		} else {
			return false;
		}
	}

	public function filterContentOpenShortcodes($s, $opts, $post, &$chunks, $rule)
	{
		if (is_string($s) && (strlen($s) > 0)) {
			$is_on = intval($this->get_option('content_open_shortcodes'));
			if (isset($opts['value'])) {
				$is_on = intval($opts['value']);
			}
			if ($is_on) {
				$zz = array();
				if (preg_match_all( '@\[([^<>&/\[\]\x00-\x20=]++)@', $s, $zz )) {	// Regexp from WP core
					$tt2_all = $this->GetShortcodesContent($post->ID, $s);
					$s = str_replace('<', ' <', $tt2_all['content']);
					if (isset($tt2_all) && (strlen($tt2_all['error']) > 0)) {
						if (!isset($chunks['__debug']['error_open_shortcodes'])) {
							$chunks['__debug']['error_open_shortcodes'] = array();	
						}
						$chunks['__debug']['error_open_shortcodes'][] = array(
							'src' => $rule['src'],
							'error' => $tt2_all['error'],
						);
					}
				}
			}
		}

		return $s;
	}

	public function filterContentIsRemoveNodes($s, $opts, $post, &$chunks, $rule)
	{
		if ((is_string($s)) && (strlen($s) > 0)) {
			$is_on = intval($this->get_option('content_is_remove_nodes'));
			if (isset($opts['value'])) {
				$is_on = intval($opts['value']);
			}
			if ($is_on) {
				if (isset($opts['node'])) {
					if (in_array('script', $opts['node'])) {
						// Remove <script> with content
						$s = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $s);						
					}
					if (in_array('style', $opts['node'])) {
						// Remove <style> with content
						$s = preg_replace('/<style\b[^>]*>(.*?)<\/style>/is', "", $s);
					}
				}
			}
		}

		return $s;
	}

	public function filterContentStripTags($s, $opts, $post, &$chunks, $rule)
	{
		if (is_string($s) && (strlen($s) > 0)) {
			$is_on = intval($this->get_option('content_strip_tags'));
			if (isset($opts['value'])) {
				$is_on = intval($opts['value']);
			}
			if ($is_on) {
				$s = $this->contentStripTags($s);
				$s = html_entity_decode(str_replace('&nbsp;', ' ', $s));
			}
		}

		return $s;
	}

	public function getObjectChunks($obj_id, $obj_type, $is_refresh_raw_cache = false, $use_rules_list = false) {
		if ($obj_type == 'wp_posts') {
			return $this->getPostChunks($obj_id, $is_refresh_raw_cache, $use_rules_list);
		} else {
			// @todo Process other obj_types

		}

		return array();
	}

	public function getPostChunks($post_id, $is_refresh_raw_cache = false, $use_rules_list = false)
	{
		$chunks = array(
			'__used_rules' => array(),
			'__debug' => array(),
		);

		$post = get_post($post_id);
		if (!$post) {
			$chunks['__debug']['core_error'] = 'No post';
			return $chunks;
		}

		do_action('wpfts_index_post_start', $this, $post, $is_refresh_raw_cache);

		$all_rules = (array)$this->decodeAndSyncIndexRules();

		$go_use_rules = $use_rules_list;
		if ($use_rules_list === false) {
			// We need to get rules list for this post
			$rules_data = $this->getRulesIDsForPosts(array($post_id));

			$algs = array();
			if (($rules_data && (count($rules_data) > 0)) && ($rules_data[0]['ID'] == $post_id)) {
				$algs = isset($rules_data[0]['algs']) ? explode('|', $rules_data[0]['algs']) : array(0);
			}

			$go_use_rules = $algs;
		}

		$chunks['__used_rules'] = $go_use_rules;

		if ((!$go_use_rules) || (!is_array($go_use_rules)) || (count($go_use_rules) < 1)) {
			return $chunks;
		}

		// Retrieve rule ids
		$rule_ids_cache = array();
		foreach ($all_rules as $k => $rule) {
			if (isset($rule['id'])) {
				$rule_ids_cache[$rule['id']] = $k;
			}
		}

		// Apply rules from the list
		foreach ($go_use_rules as $rule_id) {
			if (isset($rule_ids_cache[$rule_id])) {
				$t_rule = $all_rules[$rule_ids_cache[$rule_id]];

				if (isset($t_rule['rule_snap']['actions']) && is_array($t_rule['rule_snap']['actions']) && (count($t_rule['rule_snap']['actions']) > 0)) {
					// Apply this rule
					foreach ($t_rule['rule_snap']['actions'] as $r) {
						if (isset($r['call']) && is_string($r['call'])) {
							// Go call specific method
							$props = isset($r['props']) ? $r['props'] : array();
							$chunks = apply_filters('wpfts_irules_call/'.$r['call'], $chunks, $post, $props, $t_rule);
							
						} elseif (isset($r['src']) && isset($r['dest']) && (strlen($r['dest']) > 0)) {
							// Process the field
							$r_dest = $r['dest'];

							$as = $this->getPostFieldByName($post, $r['src']);
							if ($as !== false) {
								$s = isset($as[0]) ? $as[0] : '';

								// Post process the value
								if (isset($r['filters']) && is_array($r['filters'])) {
									foreach ($r['filters'] as $filter) {
										$ident = isset($filter['ident']) ? $filter['ident'] : '';
										$opts = (isset($filter['opts']) && is_array($filter['opts'])) ? $filter['opts'] : array();

										if (strlen($ident) > 0) {
											$s = apply_filters_ref_array('wpfts_irule/'.$ident, array($s, $opts, $post, &$chunks, $r));
										}										
									}
								}
							}

							$chunks[$r_dest] = isset($chunks[$r_dest]) ? $chunks[$r_dest].' '.$s : $s;
						}
					}
				}	
			}
		}

		$chunks = apply_filters('wpfts_index_post', $chunks, $post, $is_refresh_raw_cache);
		
		// A smart finalization
		$chunks = apply_filters('wpfts_index_post_finish', $chunks, $post, $this);
		
		return $chunks;
	}

	public function getSubPostChunks($sub_chunk = array(), $object_id = false, $object_type = false)
	{
		$chunks = array();
		$obj_cache = array();
		if (is_array($sub_chunk) && (count($sub_chunk) > 0)) {
			foreach ($sub_chunk as $sch) {
				if (($object_id !== false) && ($object_type !== false)) {
					// Check whether parent is the same
					if (isset($sch['p_tid']) && ($sch['p_tid'] == $object_id) && isset($sch['p_tsrc']) && ($sch['p_tsrc'] == $object_type)) {
						// Ok
					} else {
						// Parent object is not the same
						continue;
					}
				}
				if (isset($sch['p_token']) && is_string($sch['p_token']) && (strlen($sch['p_token']) > 0) && 
					isset($sch['c_tid']) && is_string($sch['c_tid']) && is_numeric($sch['c_tid']) &&
					isset($sch['c_tsrc']) && is_string($sch['c_tsrc']) && (strlen($sch['c_tsrc']) > 0) &&
					isset($sch['c_token']) && is_string($sch['c_token']) && (strlen($sch['c_token']) > 0)) {
						$key = $sch['c_tsrc'].'.'.$sch['c_tid'];
						$c_token = $sch['c_token'];
						$p_token = $sch['p_token'];
						if (!isset($obj_cache[$key])) {
							$obj_cache[$key] = $this->getObjectChunks($sch['c_tid'], $sch['c_tsrc']);
						}
						if (is_array($obj_cache[$key]) && isset($obj_cache[$key][$c_token])) {
							if (!isset($chunks[$p_token][$key])) {
								$chunks[$p_token] = array();
								$chunks[$p_token][$key] = array();
							}
							if (isset($chunks[$p_token][$key][$c_token])) {
								if (!is_array($chunks[$p_token][$key][$c_token])) {
									$chunks[$p_token][$key][$c_token] = array($chunks[$p_token][$key][$c_token]);
								}
								$chunks[$p_token][$key][$c_token][] = $obj_cache[$key][$c_token];	
							} else {
								$chunks[$p_token][$key][$c_token] = $obj_cache[$key][$c_token];
							}
						}
				}
			}
		}

		return $chunks;
	}

	/*
	public function getPostChunks_old($post_id, $is_refresh_raw_cache = false)
	{
		$post = get_post($post_id);
		$chunks = array();
		$tt = $post->post_title;
		if (strlen($tt) > 0) {
			$chunks['post_title'] = $tt;
		}
		$tt2 = $post->post_content;

		$content_error = '';

		// A smart startup
		do_action('wpfts_index_post_start', $this, $post, $is_refresh_raw_cache);

		if (strlen($tt2) > 0) {
			if ($this->get_option('content_open_shortcodes') != 0) {
				$zz = array();
				//if (preg_match('~\[[0-9a-z_\-]+.*]~U', $tt2, $zz)) {
				if (preg_match_all( '@\[([^<>&/\[\]\x00-\x20=]++)@', $tt2, $zz )) {	// Regexp from WP core
					
					$tt2_all = $this->GetShortcodesContent($post->ID);

					$tt2 = str_replace('<', ' <', $tt2_all['content']);

					$content_error = $tt2_all['error'];
				}
			}
		
			if ($this->get_option('content_is_remove_nodes')) {
				//$n_list = trim((string)$this->get_option('content_remove_nodes_list'));
				//$a = explode(',', $n_list);
				// @todo
				// Remove <script> with content
				$tt2 = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $tt2);
				// Remove <style> with content
				$tt2 = preg_replace('/<style\b[^>]*>(.*?)<\/style>/is', "", $tt2);
			}

			if ($this->get_option('content_strip_tags') != 0) {
				$tt2 = $this->contentStripTags($tt2);
				$tt2 = html_entity_decode(str_replace('&nbsp;', ' ', $tt2));
			}
		}
		$chunks['post_content'] = $tt2;	

		// Add error chunk!
		// @todo
		// $content_error ....

		$tt3 = $post->post_excerpt;
		if (strlen($tt3) > 0) {
			$chunks['post_excerpt'] = $tt3;
		}

		$chunks = apply_filters('wpfts_index_post', $chunks, $post, $is_refresh_raw_cache);
		
		// A smart finalization
		$chunks = apply_filters('wpfts_index_post_finish', $chunks, $post, $this);
		
		return $chunks;
	}
	*/

	public function ajax_ping()
	{
		$t0 = microtime(true);
		
		$jx = new WPFTS_jxResponse();
		
		if (($data = $jx->getData()) !== false) {
			
			$time = time();
			
			$status = $this->get_status();
			$jx->variable('status', $status);
			
			$box_post_ids = isset($data['box_post_ids']) ? $data['box_post_ids'] : array();
			$postdata = $this->GetPostIndexStatus($box_post_ids);
			$jx->variable('postdata', $postdata);

			// Force indexer (this is for situation when the server has wrong DNS records and 
			// the native WP cron can not run succesfully)
			/*
			$last_indexerstart_ts = intval($this->get_option('last_indexerstart_ts'));
			if ($last_indexerstart_ts + 1.5 * 60 < $time) {
				//$this->CallIndexerStartNoBlocking();
				$this->IndexerStart();
			}
			*/
			
			$jx->variable('code', 0);
		}
		
		$jx->echoJSON();
		wp_die();
	}

	public function SetPause($is_pause = true, $is_start_indexer = false)
	{
		if ($is_pause) {
			// Set pause mode
			$this->set_option('is_pause', 1);
			$this->set_option('is_break_loop', 1);

		} else {
			// Remove pause mode
			$this->set_option('is_pause', 0);
			$this->set_option('ts_series', '');	// Reset est. time
			$this->set_option('last_sync_ts', 0);
		}

		$this->set_option('status_next_ts', 0);

		if ((!$is_pause) && $is_start_indexer) {
			// Start loop
			$this->CallIndexerStartNoBlocking();
		}

		return true;
	}

	public function ajax_set_pause()
	{
		if (!current_user_can('manage_options')) {
			wp_die();
		}

		$jx = new WPFTS_jxResponse();
		
		if (($data = $jx->getData()) !== false) {
			if (wp_verify_nonce($data['_nonce'], 'setpause_nonce')) {
				
				$is_pause = isset($data['is_pause']) ? intval($data['is_pause']) : 0;

				$this->SetPause($is_pause, true);

				$status = $this->get_status();

				$jx->variable('status', $status);
				$jx->variable('code', 0);

			} else {
				$jx->alert(__('The form is outdated. Please refresh the page and try again.', 'fulltext-search'));
			}
		}
		$jx->echoJSON();
		wp_die();
	}

	public function ajax_se_style_preview()
	{
		if (!current_user_can('manage_options')) {
			wp_die();
		}

		$jx = new WPFTS_jxResponse();
		
		if (($data = $jx->getData()) !== false) {

			$css = isset($data['wpfts_se_styles']) ? $data['wpfts_se_styles'] : '';
			// Minimize
			$c_css = $this->MinimizeSEStyle($css);

			$jx->variable('code', 0);
			$jx->variable('c_css', $c_css);
		}
		$jx->echoJSON();
		wp_die();
	}

	public function ajax_se_style_reset()
	{
		if (!current_user_can('manage_options')) {
			wp_die();
		}

		$jx = new WPFTS_jxResponse();
		
		if (($data = $jx->getData()) !== false) {

			if (!wp_verify_nonce($data['_nonce'], 'wpftsi_form5_nonce')) {
				echo '';
				wp_die();
			}

			$def_styles = $this->ReadSEStyles();
			$c_css = $this->MinimizeSEStyle($def_styles);

			$jx->variable('code', 0);
			$jx->variable('c_css', $c_css);
			$jx->variable('css_data', $def_styles);
		}
		$jx->echoJSON();
		wp_die();
	}

	public function ajax_try_updatedb()
	{
		if (!current_user_can('manage_options')) {
			wp_die();
		}

		$jx = new WPFTS_jxResponse();
		
		if (($data = $jx->getData()) !== false) {

			if (!wp_verify_nonce($data['_nonce'], 'try_updatedb')) {
				echo '';
				wp_die();
			}

			$this->set_option('updatedb_error_message', '');
			
			$jx->reload();
		}
		$jx->echoJSON();
		wp_die();
	}

	public function set_hooks()
	{
		if ($this->_search) {
			$this->_search->set_hooks();
		}
	}

	function ajax_hide_notification()
	{
		$jx = new WPFTS_jxResponse();
		
		if (($data = $jx->getData()) !== false) {
			$notification_id = isset($data['notification_id']) ? $data['notification_id'] : '';

			switch ($notification_id) {
				case 'change_log':
					$this->set_option('change_log', '');
					break;
				case 'change_notices':
					$this->set_option('change_notices', '');
					break;
				case 'welcome_message':
					$this->set_option('is_welcome_message', '');
					break;
				case 'detector_message':
					$this->set_option('detector_message', '');
					$this->set_option('detector_message_expdt', date('Y-m-d H:i:s', current_time('timestamp') + 3600 * 24 * 90));
					break;
				case 'detector2_message':
					$this->set_option('detector2_message', '');
					$this->set_option('detector2_message_expdt', date('Y-m-d H:i:s', current_time('timestamp') + 3600 * 24 * 365));
					break;
				case 'detector3_message':
					$this->set_option('detector3_message', '');
					$this->set_option('detector3_message_expdt', date('Y-m-d H:i:s', current_time('timestamp') + 3600 * 24 * 30));
					break;
				case 'reqreset_message':
					$this->set_option('reqreset_message', '');
					$this->set_option('reqreset_message_expdt', date('Y-m-d H:i:s', current_time('timestamp') + 3600 * 24 * 1));
					break;
				case 'wpftslic_message':
					$this->set_option('wpftslic_message', '');
					$this->set_option('wpftslic_message_expdt', date('Y-m-d H:i:s', current_time('timestamp') + 3600 * 24 * 1));
					break;
				case 'updatedb_error_message':
					$this->set_option('updatedb_error_message', '');
					$this->set_option('updatedb_error_message_expdt', '');
					break;
			}
		}
		$jx->echoJSON();
		wp_die();
	}

	public function ForceSmartExcerpts($query = false)
	{
		$this->forced_se_query = mb_strlen((string)$query) > 0 ? (string)$query : false;
	}

	public function GetUsedMimetypes()
	{
		global $wpdb;

		// Get used mimetypes
		$used_mt = get_transient('wpfts_used_mt');
		if ($used_mt === false) {
			$q = 'select post_mime_type, count(*) n from `'.$wpdb->posts.'` group by `post_mime_type`';
			$r2 = $this->db->get_results($q, ARRAY_A);
			$used_mt = array();
			foreach ($r2 as $d) {
				if (strlen($d['post_mime_type']) > 0) {
					$used_mt[$d['post_mime_type']] = $d['n'];
				}
			}
			set_transient('wpfts_used_mt', $used_mt, 1);
		}
		return $used_mt;
	}

	public function GetWidgetPresets()
	{
		return $this->widget_presets;
	}

	public function AddWidgetPreset($id, $data = array())
	{
		if ($id && (strlen($id) > 0) && (isset($data['title']) && (strlen($data['title']) > 0))) {
			$defaults = array(
				'filter' => '',
				'results_url' => '/',
				'autocomplete_mode' => 0,
				'classname' => '',
				'use_indexed_search' => 1,
			);
			$this->widget_presets[$id] = $data + $defaults;
			$this->widget_presets[$id]['id'] = $id;
		}
	}

	public function GetPresetBySearchType($search_type)
	{
		$t = $this->get_option('preset_selector');

		return ($t && is_array($t) && isset($t[$search_type])) ? $t[$search_type] : '';
	}

	public function GetPresetData($preset_ident)
	{
		$t = $this->get_option('presetdata_'.$preset_ident);

		if ($t && is_array($t)) {
			return $t;
		} else {
			if (isset($this->widget_presets[$preset_ident])) {
				return $this->widget_presets[$preset_ident];
			}
			return array();
		}
	}

	/***************************************** */
	/* Index Rules                             */
	/***************************************** */
	public function set_basic_irule()
	{
		// Construct post set
		$filter = array(
			0 => 'AND',
		);

		$exclude_post_types = $this->get_option('exclude_post_types');
		if (!is_array($exclude_post_types)) {
			$exclude_post_types = array();
		}
		
		if (count($exclude_post_types) > 1) {
			// Use not in
			$filter['post_type__not_in'] = $exclude_post_types;
		} else {
			if (count($exclude_post_types) > 0) {
				// Use !=
				$filter['post_type__!='] = $exclude_post_types[0];
			}
		}

		$exclude_post_statuses = $this->get_option('exclude_post_statuses');
		if (!is_array($exclude_post_statuses)) {
			$exclude_post_statuses = array();
		}
		
		if (count($exclude_post_statuses) > 1) {
			// Use not in
			$filter['post_status__not_in'] = $exclude_post_statuses;
		} else {
			if (count($exclude_post_statuses) > 0) {
				// Use !=
				$filter['post_status__!='] = $exclude_post_statuses[0];		
			}
		}


		// Create post_content filters
		$post_content_filters = array();


		$irule = array(
			'filter' => $filter,
			'actions' => array(
				/*array(
					'call' => 'wpfts_basic_irule',
				),*/
				array(
					'src' => 'post_title',
					'filters' => array(),
					'dest' => 'post_title',
				),
				array(
					'src' => 'post_content',
					'filters' => array(
						array(
							'ident' => 'content_open_shortcodes',
							'opts' => array(),
						),
						array(
							'ident' => 'content_is_remove_nodes',
							'opts' => array(
								'node' => array('script', 'style'),
							),
						),
						array(
							'ident' => 'content_strip_tags',
							'opts' => array(),
						),
					),
					'dest' => 'post_content',
				),
				array(
					'src' => 'post_excerpt',
					'dest' => 'post_excerpt',
				),
			),
			'short' => array(
				'post_title' => array('post_title'), 
				'post_content' => array('post_excerpt', 'post_content'),
			),
			'ident' => 'wpfts_core/settings',
			'name' => 'Native Search Simulation',
			'description' => __('This is the default WPFTS rule to mimic WordPress\' native search behavior. You can change it using the Default "Indexing Defaults" tab.', 'fulltext-search'),
			'ver' => '1.0',
			'defined_by' => 'WPFTS Core',
			'ord' => -10000,
		);

		return $irule;
	}

	public function decode_user_irules()
	{
		// @todo
		return array();
	}

	public function collect_irules()
	{
		// Add base rules
		$this->irules_base = apply_filters('wpfts_irules_before', array_merge($this->irules_base, array($this->set_basic_irule())));

		// Add user-defined rules
		$this->irules_user = $this->decode_user_irules();

		// Add final rules
		$this->irules_final = apply_filters('wpfts_irules_after', $this->irules_final);

		$this->decodeAndSyncIndexRules();

		//$all_rules = $this->decodeAndSyncIndexRules();

		//print_r($all_rules);

		//$this->getIRulesWithStats();
	}

	public function decodeAndSyncIndexRules($is_force_reread = false)
	{
		if (($this->irules_cache === false) || ($is_force_reread)) {
			$all_rules = array();
			$w = array();
	
			$lists = array(
				array($this->irules_base, 0),
				array($this->irules_user, 1),
				array($this->irules_final, 2),
			);

			$checked_idents = array();
			$failed_rules = array();
	
			foreach ($lists as $d_list) {			
				$ord = 100;
				if (is_array($d_list[0])) {
					foreach ($d_list[0] as $dd) {
						// Create hashes
						if (isset($dd['filter']) && isset($dd['actions'])) {	// Valid rule

							$filter_hash = sha1(wpfts_json_encode($dd['filter']));
							$act_hash = sha1(wpfts_json_encode($dd['actions']).'|'.wpfts_json_encode(isset($dd['ver']) ? $dd['ver'] : ''));

							$is_valid = true;
							if (isset($dd['ident']) && (strlen($dd['ident']) > 0)) {
								// Use ident
								$ident = $dd['ident'];
							} else {
								// Construct key hash from 'filter'
								$ident = $filter_hash;
							}

							if (isset($checked_idents[$ident])) {
								// Repeated usage of ident, this is not allowed
								// Ignore rule
								$failed_rules[] = array($d_list[1], $dd, 'Repeated ident is not allowed, should be empty or not set');
								$is_valid = false;
							}

							if ($is_valid) {
								$checked_idents[$ident] = 1;
		
								$rule = array(
									'ident' => $ident,
									'filter_hash' => $filter_hash,
									'act_hash' => $act_hash,
									'rule_snap' => $dd,
									'type' => $d_list[1],
									'ord' => $ord,
								);
								$all_rules[$ident.'|'.$act_hash] = $rule;
		
								$ord += 10;
		
								$w[] = '(ir.`ident` = "'.addslashes($ident).'" and ir.`act_hash` = "'.addslashes($act_hash).'")';
							}
						}
					}
				}	
			}
	
			global $wpdb;
	
			$prefix = $this->dbprefix();
	
			if (count($w) > 0) {
				try {
					$q = 'select ir.* from `'.$prefix.'irules` ir where '.implode(' or ', $w);
	
					$res = $this->db->get_results($q, ARRAY_A);

					$ex_hashes = array();
					if (count($res) > 0) {
						foreach ($res as $r2) {
							$fh = $r2['filter_hash'];
							$ah = $r2['act_hash'];
							$ident_act = ((isset($r2['ident']) && (strlen($r2['ident']) > 0)) ? $r2['ident'] : $fh).'|'.$ah;
		
							$ex_hashes[$ident_act] = $r2;
						}
					}

					$rls = new WPFTS_Indexing_Rules();
		
					foreach ($all_rules as $kk => $dd) {
						if (!isset($ex_hashes[$kk])) {
							// We need to add this rule to DB
							$sql = '';
							$is_valid = -1;
							$error_msg = '';
		
							list($err, $prep) = $rls->parseExpr($dd['rule_snap']['filter']);
		
							if (count($err) < 1) {
								
								list($err, $sql) = $rls->makeSQL($prep);
		
								if (count($err) > 0) {
									$is_valid = 0;
									$error_msg = implode("\n", $err);
								} else {
									$is_valid = 1;
								}
		
							} else {
								$is_valid = 0;
								$error_msg = implode("\n", $err);
							}
		
							$is_success = $this->db->insert($prefix.'irules', array(
								'ident' => $dd['ident'],
								'filter_hash' => $dd['filter_hash'],
								'act_hash' => $dd['act_hash'],
								'rule_snap' => wpfts_json_encode($dd['rule_snap']),
								'clone_id' => 0,
								'filter_sql' => $sql,
								'is_valid' => $is_valid,
								'error_msg' => $error_msg,
								'ord' => isset($dd['ord']) ? intval($dd['ord']) : 0,
								'type' => isset($dd['type']) ? intval($dd['type']) : 3,
								'insert_dt' => date('Y-m-d H:i:s', current_time('timestamp')),
							));
		
							$insert_id = $wpdb->insert_id;
							if ($is_success && ($insert_id > 0)) {
								// Successfully saved
								$all_rules[$kk]['id'] = $insert_id;
								$all_rules[$kk]['filter_sql'] = $sql;
								$all_rules[$kk]['is_valid'] = $is_valid;
								$all_rules[$kk]['error_msg'] = $error_msg;
							}
						} else {
							// The rule exists, but we need to update it in case filter_hash was changed
							$r3 = $ex_hashes[$kk];
							if ($dd['filter_hash'] !== $r3['filter_hash']) {
								// Recalculate SQL and update in DB
								$sql = '';
								$is_valid = -1;
								$error_msg = '';
			
								list($err, $prep) = $rls->parseExpr($dd['rule_snap']['filter']);
			
								if (count($err) < 1) {
									
									list($err, $sql) = $rls->makeSQL($prep);
			
									if (count($err) > 0) {
										$is_valid = 0;
										$error_msg = implode("\n", $err);
									} else {
										$is_valid = 1;
									}
			
								} else {
									$is_valid = 0;
									$error_msg = implode("\n", $err);
								}
			
								$this->db->update($prefix.'irules', array(
									'filter_hash' => $dd['filter_hash'],
									'rule_snap' => wpfts_json_encode($dd['rule_snap']),
									'filter_sql' => $sql,
									'is_valid' => $is_valid,
									'error_msg' => $error_msg,
								), array('id' => $r3['id']));
			
								$all_rules[$kk]['id'] = $r3['id'];
								$all_rules[$kk]['filter_sql'] = $sql;
								$all_rules[$kk]['is_valid'] = $is_valid;
								$all_rules[$kk]['error_msg'] = $error_msg;
	
							} else {
								// The rule is equal to DB
								// Found in DB, read some precalculated values
								$all_rules[$kk]['id'] = $r3['id'];
								$all_rules[$kk]['filter_sql'] = $r3['filter_sql'];
								$all_rules[$kk]['is_valid'] = $r3['is_valid'];
								$all_rules[$kk]['error_msg'] = $r3['error_msg'];
							}
	
						}
					}
	
				} catch (Exception $e) {
					// Some DB error was happen, ignore rules processing
					$all_rules = array();
				}
	
			}

			$this->irules_cache = $all_rules;
		}

		return $this->irules_cache;
	}

	public function getRecordsToResetSQL($rule_id = 0)
	{
		global $wpdb;

		$prefix = $this->dbprefix();

		$all_rules = (array)$this->decodeAndSyncIndexRules();

		$w1 = array();
		foreach ($all_rules as $dd) {
			if (isset($dd['is_valid']) && (intval($dd['is_valid']) > 0) && isset($dd['id']) && (intval($dd['id']) > 0) && isset($dd['filter_sql']) && (strlen($dd['filter_sql']) > 0)) {
				if (($rule_id <= 0) || ($rule_id == $dd['id'])) {
					$w1[] = 'if('.$dd['filter_sql'].', "'.addslashes($dd['id']).'", null)';
				}
			}
		}

		if (count($w1) > 0) {
			$q = 'select 
					inx.id
				from
				(
					select 
						p.ID,
						concat_ws("|",'.implode(',', $w1).') algs_raw
					from `'.$wpdb->posts.'` p
				) tt
				left join `'.$prefix.'index` inx
					on (tt.ID = inx.tid) and (inx.tsrc = "wp_posts")
				where
					(((inx.force_rebuild = 0) and (inx.build_time != 0)) or (isnull(tt.ID))) and (inx.rules_idset <> if(length(tt.algs_raw) > 0, tt.algs_raw, "0"))
				';

			return $q;
		} else {
			// No valid rules found
		}

		return false;
	}

	public function createIRulesHash()
	{
		// Fast hash calculation to check rules changes
		$lists = array(
			array($this->irules_base, 0),
			array($this->irules_user, 1),
			array($this->irules_final, 2),
		);

		$hash = '';
		try {
			// Just in case of serializing will fail
			$hash = sha1(serialize($lists));
		} catch (Exception $e) {
			$hash = '';
		}

		return $hash;
	}

	public function getCurrentIRulesStats($is_force_reread = false, $is_get_from_cache = false)
	{
		global $wpdb;

		$prefix = $this->dbprefix();

		$time = time();

		$irules_status_next_ts = intval($this->get_option('irules_status_next_ts'));
		if ((($irules_status_next_ts <= $time) || $is_force_reread) && (!$is_get_from_cache)) {

//$tt0 = microtime(true);
//$logident = substr(md5(uniqid()), 0, 7);

//$arr = '';//debug_backtrace();
//file_put_contents(dirname(__FILE__).'/irules_status_log.txt', $logident.' Started '.date('Y-m-d H:i:s', current_time('timestamp'))."\n".print_r($arr, true)."\n", FILE_APPEND);

			$all_rules = (array)$this->decodeAndSyncIndexRules();

			$w1 = array();
			foreach ($all_rules as $dd) {
				if (isset($dd['is_valid']) && (intval($dd['is_valid']) > 0) && isset($dd['id']) && (intval($dd['id']) > 0) && isset($dd['filter_sql']) && (strlen($dd['filter_sql']) > 0)) {
					$w1[] = 'if('.$dd['filter_sql'].', "'.addslashes($dd['id']).'", null)';
				}
			}
	
			// Total variables
			$n_inindex = 0;
			$n_actual = 0;
			$n_req_reset = 0;

			// Make groups
			$singles = array();
			$groups = array();
			$no_rules = array(
				'n_total' => 0,
				'n_valid' => 0,
				'n_indexed' => 0,
				'n_req_reset' => 0,
			);
			
			if (count($w1) > 0) {
				$q = 'select 
						if(length(tt.algs_raw) > 0, tt.algs_raw, "0") algs,
						inx.rules_idset,
						sum(if (((inx.force_rebuild = 0) and (inx.build_time != 0)) or (isnull(tt.ID)), 1, 0)) n_indexed,
						sum(if (inx.rules_idset = if(length(tt.algs_raw) > 0, tt.algs_raw, "0"), 1, 0)) n_actual,
						sum(if ((((inx.force_rebuild = 0) and (inx.build_time != 0)) or (isnull(tt.ID))) and (inx.rules_idset <> if(length(tt.algs_raw) > 0, tt.algs_raw, "0")), 1, 0)) n_req_reset,
						count(*) n
				from
				(
					select 
						p.ID,
						concat_ws("|",'.implode(',', $w1).') algs_raw
					from `'.$wpdb->posts.'` p
				) tt
				left join `'.$prefix.'index` inx
					on (tt.ID = inx.tid) and (inx.tsrc = "wp_posts")
				group by if(length(tt.algs_raw) > 0, tt.algs_raw, "0"), inx.rules_idset';
	//file_put_contents(dirname(__FILE__).'/irules_status_log.txt', $logident.' Query:  '.$q."\n", FILE_APPEND);
				$r2 = $this->db->get_results($q, ARRAY_A);

				foreach ($r2 as $d) {
					if (isset($d['algs']) && (strlen($d['algs']) > 0)) {
						$tt = explode('|', $d['algs']);
						if (count($tt) > 0) {
							if ($tt[0] == '0') {
								// No rules assigned to this
								$no_rules['n_total'] += isset($d['n']) ? intval($d['n']) : 0;
								$no_rules['n_valid'] += isset($d['n_actual']) ? intval($d['n_actual']) : 0;
								$no_rules['n_indexed'] += isset($d['n_indexed']) ? intval($d['n_indexed']) : 0;
								$no_rules['n_req_reset'] += isset($d['n_req_reset']) ? intval($d['n_req_reset']) : 0;
							} else {
								foreach ($tt as $rule_id) {
									if (!isset($singles[$rule_id])) {
										$singles[$rule_id] = array(
											'n_total' => 0,
											'n_valid' => 0,
											'n_indexed' => 0,
											'n_req_reset' => 0,
										);		
									}
									$singles[$rule_id]['n_total'] += isset($d['n']) ? intval($d['n']) : 0;
									$singles[$rule_id]['n_valid'] += isset($d['n_actual']) ? intval($d['n_actual']) : 0;
									$singles[$rule_id]['n_indexed'] += isset($d['n_indexed']) ? intval($d['n_indexed']) : 0;
									$singles[$rule_id]['n_req_reset'] += isset($d['n_req_reset']) ? intval($d['n_req_reset']) : 0;										
								}
							}

						}

						// Update group
						$algs = $d['algs'];
						if (!isset($groups[$algs])) {
							$groups[$algs] = array(
								'n_total' => 0,
								'n_valid' => 0,
								'n_indexed' => 0,
								'n_req_reset' => 0,
							);
						}
						$groups[$algs]['n_total'] += isset($d['n']) ? intval($d['n']) : 0;
						$groups[$algs]['n_valid'] += isset($d['n_actual']) ? intval($d['n_actual']) : 0;
						$groups[$algs]['n_indexed'] += isset($d['n_indexed']) ? intval($d['n_indexed']) : 0;
						$groups[$algs]['n_req_reset'] += isset($d['n_req_reset']) ? intval($d['n_req_reset']) : 0;

						$n_inindex += isset($d['n']) ? intval($d['n']) : 0;
						$n_actual += isset($d['n_indexed']) ? intval($d['n_indexed']) : 0;
						$n_req_reset += isset($d['n_req_reset']) ? intval($d['n_req_reset']) : 0;
					}
				}


			} else {
				// No valid rules found
			}

			$stats['groups'] = $groups;
			$stats['singles'] = $singles;
			$stats['no_rules'] = $no_rules;
	
			$stats['n_inindex'] = $n_inindex;
			$stats['n_actual'] = $n_actual;
			$stats['n_pending'] = $n_inindex - $n_actual;
			$stats['n_req_reset'] = $n_req_reset;

			$stats['tsd'] = time();

			$this->set_option('irules_status_next_ts', $time + 5 * 60);
			$this->set_option('irules_status_cache', wpfts_json_encode($stats));

			$stats['is_cached'] = false;

//			$tt1 = microtime(true);
//file_put_contents(dirname(__FILE__).'/irules_status_log.txt', $logident.' Finished '.date('Y-m-d H:i:s', current_time('timestamp')).' took '.($tt1 - $tt0)."\n\n", FILE_APPEND);


		} else {
			$stats = array();
			try {
				$stats = json_decode($this->get_option('irules_status_cache'), true);
			} catch (Exception $e) {
				$stats = array();
			}

			$stats['is_cached'] = true;

		}

		$this->irules_stats_cache = $stats;
		
		return $this->irules_stats_cache;
	}

	/**
	 * Returns ready SQL query for all rules that returns number of posts that is not correct for each rules
	 */
	/*
	public function createSQLForIRules($ir_list = array())
	{
		global $wpdb;

		$prefix = $this->dbprefix();

		$w1 = array();
		foreach ($ir_list as $dd) {
			if (isset($dd['is_valid']) && (intval($dd['is_valid']) > 0) && isset($dd['id']) && (intval($dd['id']) > 0) && isset($dd['filter_sql']) && (strlen($dd['filter_sql']) > 0)) {
				$w1[] = 'if('.$dd['filter_sql'].', "'.addslashes($dd['id']).'", null)';
			}
		}

		$q = '';
		if (count($w1) > 0) {
			$q = 'select 
					tt.idset,
					inx.rules_idset,
					sum(if (((inx.force_rebuild = 0) and (inx.build_time != 0)) or (isnull(tt.ID)), 0, 1)) n_not_indexed,
					sum(if (inx.rules_idset = tt.idset, 1, 0)) n_actual,
					count(*) n
				from
				(
					select 
						p.ID,
						concat_ws("|",'.implode(',', $w1).') idset
					from `'.$wpdb->posts.'` p
				) tt
				left join `'.$prefix.'index` inx
					on (tt.ID = inx.tid) and (inx.tsrc = "wp_posts")
				where 
					group by tt.idset, inx.rules_idset';
		} else {
			// No valid rules found
		}

		return $q;
	}
	*/

	/*
	public function getIRulesWithStats()
	{
		global $wpdb;

		$c_rules = $this->decodeAndSyncIndexRules();

		// Create SQL based on those rules

		// Get current index state with statuses
		$sql = $this->createSQLForIRules($c_rules);

		//print_r($sql);

		// Parse results


	}
	*/

	/***************************************** */
	/* Addons                                  */
	/***************************************** */
	public function RegisterAddon($ident, $data = null)
	{
		if (!$data) {
			return false;
		}

		$t = $this->GetActiveAddon($ident);
		if ($t) {
			// This addon was already registered!
			return false;
		} else {
			$this->active_addons[$ident] = $data;

			return true;
		}
	}
	
	public function GetActiveAddon($ident)
	{
		if (isset($this->active_addons[$ident])) {
			return $this->active_addons[$ident];
		}

		return false;
	}

	/***************************************** */

	public function getMimetypeGroups()
	{
		$mimetype_groups = array(
			1 => array(__('Image', 'fulltext-search'), array('image/jpeg', 'image/gif', 'image/png', 'image/bmp', 'image/tiff', 'image/x-icon')),
			2 => array(__('Video', 'fulltext-search'), array('video/x-ms-asf', 'video/x-ms-wmv', 'video/x-ms-wmx', 'video/x-ms-wm', 'video/avi', 'video/divx', 'video/x-flv', 'video/quicktime', 'video/mpeg', 'video/mp4', 'video/ogg', 'video/webm', 'video/x-matroska')),
			3 => array(__('Text', 'fulltext-search'), array('text/plain', 'text/csv', 'text/tab-separated-values', 'text/calendar', 'text/richtext', 'text/css', 'text/html')),
			4 => array(__('Audio', 'fulltext-search'), array('audio/mpeg', 'audio/x-realaudio', 'audio/wav', 'audio/ogg', 'audio/midi', 'audio/x-ms-wma', 'audio/x-ms-wax', 'audio/x-matroska')),
			5 => array(__('Misc App', 'fulltext-search'), array('application/rtf', 'application/javascript', 'application/pdf', 'application/x-shockwave-flash', 'application/java', 'application/x-tar', 'application/zip', 'application/x-gzip', 'application/rar', 'application/x-7z-compressed', 'application/x-msdownload')),
			6 => array(__('Microsoft Office', 'fulltext-search'), array('application/msword', 'application/vnd.ms-powerpoint', 'application/vnd.ms-write', 'application/vnd.ms-excel', 'application/vnd.ms-access', 'application/vnd.ms-project', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.ms-word.document.macroEnabled.12', 'application/vnd.openxmlformats-officedocument.wordprocessingml.template', 'application/vnd.ms-word.template.macroEnabled.12', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel.sheet.macroEnabled.12', 'application/vnd.ms-excel.sheet.binary.macroEnabled.12', 'application/vnd.openxmlformats-officedocument.spreadsheetml.template', 'application/vnd.ms-excel.template.macroEnabled.12', 'application/vnd.ms-excel.addin.macroEnabled.12', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', 'application/vnd.ms-powerpoint.presentation.macroEnabled.12', 'application/vnd.openxmlformats-officedocument.presentationml.slideshow', 'application/vnd.ms-powerpoint.slideshow.macroEnabled.12', 'application/vnd.openxmlformats-officedocument.presentationml.template', 'application/vnd.ms-powerpoint.template.macroEnabled.12', 'application/vnd.ms-powerpoint.addin.macroEnabled.12', 'application/vnd.openxmlformats-officedocument.presentationml.slide', 'application/vnd.ms-powerpoint.slide.macroEnabled.12', 'application/onenote')),
			7 => array(__('OpenOffice', 'fulltext-search'), array('application/vnd.oasis.opendocument.text', 'application/vnd.oasis.opendocument.presentation', 'application/vnd.oasis.opendocument.spreadsheet', 'application/vnd.oasis.opendocument.graphics', 'application/vnd.oasis.opendocument.chart', 'application/vnd.oasis.opendocument.database', 'application/vnd.oasis.opendocument.formula')),
			8 => array(__('WordPerfect', 'fulltext-search'), array('application/wordperfect')),
			9 => array(__('iWork', 'fulltext-search'), array('application/vnd.apple.keynote', 'application/vnd.apple.numbers', 'application/vnd.apple.pages')),
			10 => array(__('Used-Defined', 'fulltext-search'), array()),
			11 => array(__('Not Registered', 'fulltext-search'), array()),
		);

		return $mimetype_groups;
	}

	/**
	 * This ajax call is forcing index loop to run
	 */
	public function ajax_force_index()
	{
		$jx = new WPFTS_jxResponse();

		$this->IndexerStart();

		$jx->variable('code', 0);
		$jx->echoJSON();
		wp_die();
	}

	/**
	 * Unfortunately this call may fail sometimes in case
	 * the server run in the local environment or DNS was configured incorrectly.
	 * 
	 */
	public function CallIndexerStartNoBlocking()
	{
		$url = admin_url('admin-ajax.php');

		$packet = array(
			'body' => array(
				'action' => 'wpfts_force_index',
			),
			'blocking' => false,
			'timeout' => 0.01,
		);

		$wpres = wp_remote_post($url, $packet);

		return $wpres;
	}

	public function MakePostsSync($is_force_sync = false)
	{
		global $wpdb;
		
		$time = time();
		$last_sync_ts = intval($this->get_option('last_sync_ts'));

		if (($last_sync_ts <= $time) || ($is_force_sync)) {
			$idx = $this->dbprefix();
		
			// Find index records that linked with changed or removed posts
			$q = 'update `'.$idx.'index` wi
				left join `'.$wpdb->posts.'` p
					on p.ID = wi.tid and wi.tsrc = "wp_posts"
				set wi.force_rebuild = 1
				where
					(wi.force_rebuild = 0) and 
					((p.ID is null) or (wi.tdt != p.post_modified))
				';
			$this->db->query($q);

			// Find post records that have no index records yet and initialize them
			$start_from = 0;
			$chunk_length = 1000;

			$is_exit = false;

			while (!$is_exit) {

				$q = 'select 
						p.ID
					from `'.$wpdb->posts.'` p
					left join `'.$idx.'index` wi
						on p.ID = wi.tid and wi.tsrc = "wp_posts"
					where 
						(wi.id is null)
						limit '.$start_from.', '.$chunk_length.'
					';
				$r2 = $this->db->get_results($q, ARRAY_A);

				if (count($r2) > 0) {
					// We found some post records, we need to create new index records for them
					$vv = array();
					foreach ($r2 as $d) {
						$vv[] = '("'.$d['ID'].'", "wp_posts", "1970-01-01 00:00:00", 0, "1970-01-01 00:00:00", 1, "1970-01-01 00:00:00")';
					}

					if (count($vv) > 0) {
						$q = 'insert into `'.$idx.'index` (`tid`, `tsrc`, `tdt`, `build_time`, `update_dt`, `force_rebuild`, `locked_dt`) values '.implode(', ', $vv);
						$this->db->query($q);
					}

					if (count($r2) >= $chunk_length) {
						// May be there is another chunk?
						$start_from += $chunk_length;
					} else {
						$is_exit = true;
						break;
					}


				} else {
					$is_exit = true;
					break;
				}
			}

			$this->set_option('last_sync_ts', $time + 10 * 60);

			return true;
		}

		return false;
	}

	public function GetPostIndexStatus($post_ids = array())
	{
		$ret = array();

		if ((!is_array($post_ids)) || (count($post_ids) < 1)) {
			return $ret;
		}

		$idx = $this->dbprefix();

		$ids = array();
		foreach ($post_ids as $d) {
			$ids[] = intval($d);
		}

		$q = 'select * from `'.$idx.'index` where tid in ('.implode(',', $ids).') and tsrc = "wp_posts"';
		$r2 = $this->db->get_results($q, ARRAY_A);

		$all_ret = array();
		foreach ($r2 as $dd) {
			$ret = $dd;

			$status_code = 0;
			$status_text = __('Unknown', 'fulltext-search');

			// Get status code and text
			if ($ret['force_rebuild'] > 0) {
				$status_code = 3;
				$status_text = __('Pending', 'fulltext-search');
			} else {
				if ($ret['build_time'] == 0) {
					$status_code = 0;
					$status_text = __('Not Indexed', 'fulltext-search');
				} else {
					if ($ret['build_time'] == 9999) {
						$delta =  strtotime($ret['update_dt']) - time();
						if ($delta < 30) {
							$status_code = 1;
							$status_text = __('Processing', 'fulltext-search');
						} else {
							// Timeout
							$status_code = 2;
							$status_text = __('Error', 'fulltext-search');
						}
					} else {
						if ($ret['build_time'] >= 10000) {
							$status_code = 4;
							$status_text = __('Ok', 'fulltext-search');			
						} else {
							// Strange!
							// @todo
						}
					}
				}
			}

			$ret['status_code'] = $status_code;
			$ret['status_text'] = $status_text;

			$all_ret['p'.$dd['tid']] = $ret;
		}

		foreach ($ids as $d) {
			if (!isset($all_ret['p'.$d])) {
				$all_ret['p'.$d] = array(
					'id' => 0,
					'status_code' => 0,
					'status_text' => 'Not Indexed',
				);
			}
		}

		return $all_ret;
	}

	public function SQLKeyValueLists($a)
	{
		$kk = array();
		$vv = array();
		foreach ($a as $k => $v) {
			$kk[] = '`'.$k.'`';
			$vv[] = '"'.addslashes($v).'"';
		}

		return array($kk, $vv);
	}

	public function SQLSetList($a)
	{
		$vv = array();
		foreach ($a as $k => $v) {
			$vv[] = '`'.$k.'` = "'.addslashes($v).'"';
		}

		return $vv;
	}

	public function GetRecordsToRebuild($n_max = 1)
	{	
		$idx = $this->dbprefix();
		
		// To optimize MySQL query we going to make 2 requests
		$q = 'select 
				id, tid, tsrc
			from `'.$idx.'index` 
			where 
				(force_rebuild != 0)
				order by force_rebuild desc
			limit '.intval($n_max).'';
		$r = $this->db->get_results($q, ARRAY_A);
		
		if (count($r) > 0) {
			return $r;
		}

		// No 'force_rebuild' records. Let's check for 'build_time' records
		$q = 'select 
				id, tid, tsrc
			from `'.$idx.'index` 
			where 
				(build_time = 0)
			order by build_time asc, id asc 
			limit '.intval($n_max).'';
		$r = $this->db->get_results($q, ARRAY_A);
		
		return $r;
	}

	// This method is intended to be ran with cron each 1 hour
	public function ClearLogs()
	{
		$this->_querylog->checkAndClipQueryLog();
	}

	public function IndexerLogStart($id, $data = array())
	{
		$a = array_filter($data, function($k) {
			return in_array($k, array('start_ts', 'getpost_ts', 'clusters_ts', 'cluster_stats', 'reindex_ts', 'status', 'error'));
		}, ARRAY_FILTER_USE_KEY);

		if (count($a) > 0) {
			$idx = $this->dbprefix();
				
			$a['index_id'] = $id;

			list($kk, $vv) = $this->SQLKeyValueLists($a);

			$q = 'replace into `'.$idx.'ilog` ('.implode(',', $kk).') values ('.implode(',', $vv).')';
			$this->db->query($q);	
		}
	}

	public function IndexerLogUpdate($id, $data = array())
	{
		$a = array_filter($data, function($k) {
			return in_array($k, array('start_ts', 'getpost_ts', 'clusters_ts', 'cluster_stats', 'reindex_ts', 'status', 'error'));
		}, ARRAY_FILTER_USE_KEY);

		if (count($a) > 0) {
			$idx = $this->dbprefix();
				
			$vv = $this->SQLSetList($a);
	
			$q = 'update `'.$idx.'ilog` set '.implode(', ', $vv).' where index_id = "'.addslashes($id).'"';
			$this->db->query($q);
		}
	}

	public function IndexerOneStep($sem = null)
	{
		$maxtime = 20;
		$start_ts = microtime(true);
		
		ignore_user_abort(true);
	
		$flare_period = 5;	// flare each 1 sec
		$sem_period = 5;	// semaphore update each 5 sec
		$series_period = 5;

		$is_loop_was_broken = false;

		$status = $this->get_status(true);

		// Send initial status to Flare
		$this->_flare->SendFire(array(
			'pt' => 'status', 
			'data' => $status
		));
		$next_flare_ts = $start_ts + $flare_period;

		if ($sem) {
			$sem->Update();
			$next_sem_ts = $start_ts + $sem_period;
		}

		$next_ts_series = $start_ts + $series_period;

		$ts_series = array();
		$aa = trim($this->get_option('ts_series', true));
		if (strlen($aa) >= 2) {
			$ts_series = json_decode(true);
			if (is_array($ts_series) && (count($ts_series) == 3)) {
				// Okay
			} else {
				// Initialize new estimator
				$ts_series = array(
					microtime(true),
					microtime(true),
					1
				);
			}
		}

		$n = 0;

		// Avoid this loop in case we have nothing to index
		if ($status['n_pending'] > 0) {

			while ((microtime(true) - $start_ts < $maxtime) && (!$is_loop_was_broken)) {

				$ids = $this->GetRecordsToRebuild(1000);

				if ($this->_dev_debug) {
					$this->_flare->SendFire(array('pt' => 'onestep', 'ids' => count($ids)));
				}

				if (count($ids) < 1) {
					break;
				}

				foreach ($ids as $item) {
				
					$is_break_loop = intval($this->get_option('is_break_loop', true));
					if ($is_break_loop > 0) {
						$is_loop_was_broken = true;
						break;
					}

					if (!(microtime(true) - $start_ts < $maxtime)) {
						break;
					}
				
					// Rebuild this record
					if (true /*$item['tsrc'] == 'wp_posts'*/) {

						$index_id = $item['id'];
						$item_start_ts = microtime(true);

						if (is_array($ts_series) && (count($ts_series) == 3)) {
							$ts_series[1] = $item_start_ts;
							$ts_series[2] ++;
						}

						$this->IndexerLogStart($index_id, array(
							'start_ts' => $item_start_ts,
							'getpost_ts' => 0,
							'clusters_ts' => 0,
							'cluster_stats' => '',
							'reindex_ts' => 0,
							'status' => 0,
							'error' => '',
						));

						// Check if locked and lock if not locked
						$post_id = $item['tid'];

						// Set build time to prevent consecutive rebuilds in case of error
						$time = time();
						$this->_index->updateRecordData($item['id'], array(
							'build_time' => 9999,	// Special mark of possible error
							'update_dt' => date('Y-m-d H:i:s', $time),
							'force_rebuild' => 0,
							'rules_idset' => '',
						));

						// Record is prepared, lets index it now
						$post = get_post($post_id);

						$item_getpost_ts = microtime(true);

						$this->IndexerLogUpdate($index_id, array(
							'getpost_ts' => $item_getpost_ts - $item_start_ts,
							'status' => 1,
						));

						if ($post) {
							$modt = $post->post_modified;
							$chunks = $this->getPostChunks($post_id);

							$chunks = apply_filters('wpfts_chunks_before_indexing', $chunks, $post);

							$item_clusters_ts = microtime(true);

							$used_rules = (isset($chunks['__used_rules']) && is_array($chunks['__used_rules'])) ? ((count($chunks['__used_rules']) > 0) ? implode('|', $chunks['__used_rules']) : '0') : '';

							$cluster_stats = array();
							$rem_chunks = array();
							foreach ($chunks as $k => $ch) {
								if (substr($k, 0, 2) == '__') {
									$cluster_stats[$k] = wpfts_json_encode($ch);
									$rem_chunks[] = $k;
								} else {
									$cluster_stats[$k] = is_string($ch) ? mb_strlen($ch) : strlen(wpfts_json_encode($ch));
								}
							}
							// Remove chunks that should not be indexed
							foreach ($rem_chunks as $d) {
								unset($chunks[$d]);
							}

							$this->IndexerLogUpdate($index_id, array(
								'clusters_ts' => $item_clusters_ts - $item_start_ts,
								'cluster_stats' => wpfts_json_encode($cluster_stats),
								'status' => 2,
							));
					
							$this->_index->clearLog();
							$this->_index->clearLogTime();

							// Force status recalculation
							$this->set_option('status_next_ts', 0);

/*
if ($post_id == 35) {
// Fuckup simulating
header('500 Server Lost');
feoiwjfnowi();
exit();
}
*/
							$res = $this->_index->reindex($item['id'], $chunks, false);

							// Force status recalculation (again!)
							// We need 2nd call because status may be recalculated too early by 
							// an external request
							$this->set_option('status_next_ts', 0);

							$item_reindex_ts = microtime(true);

							$item_status = $res ? 3 : -3;	// -3 means "Indexing error"
					
							$err = array();
							$log1 = $this->_index->getLog();
							if (strlen($log1) > 0) {
								$err['log'] = $log1;
							}
							$log1 = $this->_index->getLogTime();
							if (strlen($log1) > 0) {
								$err['logtime'] = $log1;
							}

							$tt = array(
								'reindex_ts' => $item_reindex_ts - $item_start_ts,
								'status' => $item_status,
								'error' => (count($err) > 0) ? wpfts_json_encode($err) : '',
							);
							$this->IndexerLogUpdate($index_id, $tt);
	
							// Store some statistic
							$time = time();
							$this->_index->updateRecordData($item['id'], array(
								'tdt' => $modt,
								'build_time' => $time,
								'update_dt' => date('Y-m-d H:i:s', $time),
								'force_rebuild' => 0,
								'rules_idset' => $used_rules,
							));
	
							// Let's update status virtually, do not touch DB (to save some time)
							if (isset($status['n_pending']) && isset($status['n_actual']) && isset($status['n_inindex'])) {
								if ($status['n_pending'] > 0) {
									$status['n_pending'] --;
									if ($status['n_actual'] < $status['n_inindex']) {
										$status['n_actual'] ++;
									}
								}
								$status['tsd'] = time();
							}
						} else {
							// No post - remove index
							$this->IndexerLogUpdate($index_id, array(
								'clusters_ts' => -1,
								'cluster_stats' => '',
								'status' => 2,
							));

							$this->_index->clearLog();
							$this->_index->clearLogTime();
	
							// Remove index records
							$this->_index->removeIndexRecordForPost($post_id);
							$this->removeRawCache($post_id);

							// Force status recalculation
							$this->set_option('status_next_ts', 0);

							$item_reindex_ts = microtime(true);
	
							$item_status = 4;	// 4 = "removed"
						
							$err = array();
							$log1 = $this->_index->getLog();
							if (strlen($log1) > 0) {
								$err['log'] = $log1;
							}
							$log1 = $this->_index->getLogTime();
							if (strlen($log1) > 0) {
								$err['logtime'] = $log1;
							}
	
							$tt = array(
								'reindex_ts' => $item_reindex_ts - $item_start_ts,
								'status' => $item_status,
								'error' => (count($err) > 0) ? wpfts_json_encode($err) : '',
							);
							$this->IndexerLogUpdate($index_id, $tt);
	
							// Let's update status virtually, do not touch DB (to save some time)
							if (isset($status['n_pending']) && isset($status['n_actual']) && isset($status['n_inindex'])) {
								if ($status['n_pending'] > 0) {
									$status['n_pending'] --;
									if ($status['n_actual'] < $status['n_inindex']) {
										$status['n_inindex'] --;
									}
								}
								$status['tsd'] = time();
							}
						}
					} else {
						// tsrc is not 'wp_posts'
						// Custom processing?
						// @todo
					}
				
					$n ++;

					$c_ts = microtime(true);

					// Do we need to store ts_series?
					if ($next_ts_series < $c_ts) {
						$this->set_option('ts_series', wpfts_json_encode($ts_series));
						$next_ts_series = $c_ts + $series_period;
					}

					// Do we need to update semaphore?
					if ($sem && ($next_sem_ts < $c_ts)) {
						$sem->Update();
						$next_sem_ts = $c_ts + $sem_period;
					}

					// Do we need to update flare?
					if ($next_flare_ts < $c_ts) {
						// Update status cache before sending to flare
						$st_cache = json_decode($this->get_option('status_cache', true), true);
						$st_cache['n_inindex'] = $status['n_inindex'];
						$st_cache['n_pending'] = $status['n_pending'];
						$st_cache['n_actual'] = $status['n_actual'];
						$this->set_option('status_cache', wpfts_json_encode($st_cache));

						$status = $this->get_status(true);

						$this->_flare->SendFire(array(
							'pt' => 'status', 
							'data' => $status
						));
						$next_flare_ts = $c_ts + $flare_period;	
					}
				}
			
				if ($n < 1) {
					break;
				}

			}

		}

		// Do we need to store ts_series?
		$c_ts = microtime(true);
		if ($next_ts_series < $c_ts) {
			$this->set_option('ts_series', wpfts_json_encode($ts_series));
			$next_ts_series = $c_ts + $series_period;
		}

		// Flush is only enabled if we didn't index any post in the loop
		$is_flush = false;
		if (($n < 1) || (microtime(true) - $start_ts < ($maxtime - 5)) || ($is_loop_was_broken)) {
			// Check if we have something to flush
			$n_fl = $this->_index->_getTWCount();

			if ($this->_dev_debug) {
				$this->_flare->SendFire(array('pt' => 'onestep2_twcount', 'n_fl' => $n_fl));
			}

			if ($n_fl > 0) {
				$this->_index->_flushTW();
				$is_flush = true;

				// Force status recalculation
				$this->set_option('status_next_ts', 0);

				if ($sem) {
					$sem->Update();
					$next_sem_ts = microtime(true) + $sem_period;
				}
			} else {
				// Nothing to index or flush! We are done!
				$this->set_option('index_ready', 1);
			}
		}

		if (($n > 0) || ($is_loop_was_broken) || ($is_flush)) {
			// Update the status copy from DB
			// This should be called after flush (otherwise the status will not reflect nw_* correctly)!
			$status = $this->get_status();
		}

		$is_optimizer = intval($this->get_option('is_optimizer', true));
		
		$is_not_acts = false;
		if ($is_optimizer) {
			if ((!$is_flush) && (!$is_loop_was_broken)) {

				if (($n < 1) && (microtime(true) - $start_ts < $maxtime) && ($status['nw_act'] < $status['nw_total'])) {
					// Check and process with vc
					while ((microtime(true) - $start_ts < $maxtime) && (!$is_loop_was_broken)) {
						$not_act = $this->_index->_getVCNotAct(1000);

						if ($this->_dev_debug) {
							$this->_flare->SendFire(array('pt' => 'onestep2_notact', 'not_act' => count($not_act)));
						}

						if (count($not_act) > 0) {
							$is_not_acts = true;
						} else {
							break;
						}

						foreach ($not_act as $wid) {

							$is_break_loop = intval($this->get_option('is_break_loop', true));
							if ($is_break_loop > 0) {
								$is_loop_was_broken = true;
								break;
							}

							if (!(microtime(true) - $start_ts < $maxtime)) {
								break;
							}

							$this->_index->indexWordData($wid);

							// Force status recalculation
							$this->set_option('status_next_ts', 0);

							// Update the status in variable only (to save some time)
							if (isset($status['nw_act']) && isset($status['nw_total'])) {
								if ($status['nw_act'] < $status['nw_total']) {
									$status['nw_act'] ++;
								}
								$status['ts'] = time();
							}

							// Update the semaphore and the flare
							$c_ts = microtime(true);

							// Do we need to update semaphore?
							if ($sem && ($next_sem_ts < $c_ts)) {
								$sem->Update();
								$next_sem_ts = $c_ts + $sem_period;
							}
		
							// Do we need to update flare?
							if ($next_flare_ts < $c_ts) {
								$this->_flare->SendFire(array(
									'pt' => 'status', 
									'data' => $status
								));
								$next_flare_ts = $c_ts + $flare_period;	
							}
		
						}
					}

				}
			}

		}
		
		// Do we made anything useful in this pass?
		$finish_ts = microtime(true);

		$is_useful = $is_loop_was_broken || ($n > 0) || $is_flush || $is_not_acts || ($finish_ts - $start_ts >= $maxtime);

		return $is_useful;
	}

	public function IndexerStart()
	{
		global $wpdb_debug;
		//$wpdb_debug = rand(10000, 99999);

		// Try to set time limit for 60 seconds in case there is less
		$time_limit = intval(ini_get("max_execution_time"));
		if ($time_limit <= 59) {
			if (function_exists('set_time_limit')) {
				try {
					set_time_limit(60);
				} catch (Exception $e) {
					// Unable to set time limit (blocked by hoster provider)
				}
			}
		}

		if ($this->_dev_debug) {
			$this->_flare->SendFire(array('pt' => 'indexer_cron'));
		}
		
		// Store last indexerStart ts for further usage
		// For example, we will prevent CallIndexerStartNoBlocking() from the wpfts_ping (get status)
		// in case IndexerStart was called from somewhere in 1,5 minutes or less
		$this->set_option('last_indexerstart_ts', time());

		$is_pause = intval($this->get_option('is_pause', true));
		if ($is_pause > 0) {
			// Indexer loop is on pause. Exit silently.
			if ($this->_dev_debug) {
				$this->_flare->SendFire(array('pt' => 'indexer_on_pause'));
			}
			return;
		}

		// Check the semaphore
		$sem = new WPFTS_Semaphore('inx_cron');
		$sem->timeout = 180;	// 3 minutes

		if (!$sem->Enter()) {
			// Another instance is processing indexing task now
			return;
		}

		if ($this->_dev_debug) {
			$this->_flare->SendFire(array('pt' => 'indexer_cron_enter'));
		}

		// Remove "break_loop" flag in case it was set before
		$this->set_option('is_break_loop', 0);

		// Semaphore is free - go to indexer cycle
		// Check if we need to make posts resync (once in 10 min)
		$time = time();

		// Make posts sync
		if ($this->MakePostsSync()) {
			$sem->Update();
		}

		$is_useful = $this->IndexerOneStep($sem);

		if ($this->_dev_debug) {
			$this->_flare->SendFire(array('pt' => 'indexer_leave'));
		}

		// Free the semaphore instance to let this method to be called again
		$sem->Leave();

		if ($is_useful) {
			// In case this pass was useful (we did something), try to run the task again!
			$this->CallIndexerStartNoBlocking();
		}
	}
}

class WPFTS_Addon_Base
{
	public function __construct()
	{
		
	}
}