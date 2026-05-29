<?php
/**
 * Base class for dashboard widgets.
 */
class Dashboard {
	/**
	 * Gets the options for a widget of the specified name.
	 *
	 * @param string $widget_id Optional. If provided, will only get options for the specified widget.
	 *
	 * @return array An associative array containing the widget's options and values. False if no opts.
	 */
	public static function get_widget_options( $widget_id = '' ) {
		// Fetch ALL dashboard widget options from the db.
		$opts = get_option( 'dashboard_widget_options' );
		// I f no widget is specified, return everything.
		if ( empty( $widget_id ) ) {
			return $opts;
		}
		// Request current widget options and if they exist, return them.
		if ( isset( $opts[ $widget_id ] ) ) {
			return $opts[ $widget_id ];
		}
		// Something went wrong.
		return array();
	}
	/**
	 * Gets one specific option for the specified widget.
	 *
	 * @param string $widget_id Widget id.
	 * @param string $option Specific widget option.
	 * @param null   $default Default option.
	 *
	 * @return string
	 */
	public static function get_widget_option( string $widget_id = null, $option, $default = null ) {
		$opts = self::get_widget_options( $widget_id );
		// If widget opts dont exist, return false.
		if ( ! $opts ) {
			return '';
		}
		// Otherwise fetch the option or use default.
		if ( isset( $opts[ $option ] ) && ! empty( $opts[ $option ] ) ) {
			return $opts[ $option ];
		} else {
			return ( isset( $default ) ) ? $default : false;
		}
	}
	/**
	 * Saves an array of options for a single dashboard widget to the database.
	 * Can also be used to define default values for a widget.
	 *
	 * @param string $widget_id The name of the widget being updated.
	 * @param array  $args An associative array of options being saved.
	 * @param bool   $add_only If true, options will not be added if widget options already exist.
	 *
	 * @return bool True if option value has changed, false if not or if update failed.
	 */
	public static function update_widget_options( $widget_id = '', $args = array(), $add_only = false ) {
		// Fetch ALL dashboard widget options from the db...
		$opts            = get_option( 'dashboard_widget_options' );
		$current_options = $opts[ $widget_id ];
		// Get just our widget's options, or set empty array.
		$widget_opts = ( isset( $current_options ) ) ? $current_options : array();
		if ( $add_only ) {
			// Flesh out any missing options (existing ones overwrite new ones).
			$current_options = array_merge( $args, $widget_opts );
		} else {
			// Merge new options with existing ones, and add it back to the widgets array.
			$current_options = array_merge( $widget_opts, $args );
		}
		$opts[ $widget_id ] = $current_options;
		// Save the entire widgets array back to the db.
		return update_option( 'dashboard_widget_options', $opts );
	}
}
