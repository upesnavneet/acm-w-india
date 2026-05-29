# This is modified version of WP Hide Login plugin
## Update process 
- update plugin.php and singleton.php files
- delete namespaces
- define constant WPS_HIDE_LOGIN_BASENAME as wps-hide-login
- replace is_plugin_active_for_network(WPS_HIDE_LOGIN_BASENAME) with true value
- change default login string to acm-management in new_login_slug function (if the structure changes, adapt accordingly)
- change hook plugins_loaded to after_setup_theme in  add_action('after_setup_theme', array($this, 'plugins_loaded'), 9999);