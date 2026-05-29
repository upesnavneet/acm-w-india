<?php

/**
 * Set-up ACM theme configuration fields.
 * Thanks to David from Shellcreeper for the tutorial - https://shellcreeper.com/wp-settings-meta-box/
 */
class ACMThemeConfiguration {


	const PAGE_ID = 'toplevel_page_acm_config';
	/**
	 * Init.
	 */
	public static function init() {
		 add_action( 'admin_menu', array( __CLASS__, 'acm_config_settings_setup' ) );
		add_action( 'acm_config_settings_page_init', array( __CLASS__, 'acm_config_reset_settings' ) );
		add_action( 'add_acm_meta_boxes', array( __CLASS__, 'acm_config_comments_and_gutenberg' ) );
		add_action( 'add_acm_meta_boxes', array( __CLASS__, 'acm_config_submit_feedback' ) );

		add_action( 'add_acm_meta_boxes', array( __CLASS__, 'acm_config_submit_add_meta_box' ) );
	}

	/**
	 * Create Settings Page.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_setting
	 * @link http://codex.wordpress.org/Function_Reference/add_menu_page
	 */
	public static function acm_config_settings_setup() {
		register_setting( 'acm_config', 'acm_disable_comments', array( 'default' => 'on' ) );
		register_setting( 'acm_config', 'acm_enable_gutenberg_support', array( 'default' => 'on' ) );

		/* Add settings menu page. */
		$settings_page = add_menu_page(
			'ACM Theme Configuration',
			'ACM Theme Configuration',
			'manage_options',
			'acm_config',
			array( __CLASS__, 'acm_config_settings_page' ),
			'dashicons-clipboard',
			4
		);
		$page_id       = self::PAGE_ID;
		/* Do stuff in settings page, such as adding scripts, etc. */
		if ( ! empty( $settings_page ) ) {
			/* Load the JavaScript needed for the settings screen. */
			add_action( 'admin_enqueue_scripts', array( __CLASS__, 'acm_config_enqueue_scripts' ) );
			add_action( "admin_footer-{$page_id}", array( __CLASS__, 'acm_config_footer_scripts' ) );
			/* Set number of column available. */
			add_filter( 'screen_layout_columns', array( __CLASS__, 'acm_config_screen_layout_column' ), 10, 2 );
		}

		if ( get_option( 'acm_enable_gutenberg_support' ) !== 'on' ) {
			// var_dump(get_option('acm_enable_gutenberg_support'));
			add_action( 'add_acm_meta_boxes', array( __CLASS__, 'acm_config_basic_add_meta_box' ) );
			add_action( 'add_acm_meta_boxes', array( __CLASS__, 'acm_social_networks_add_meta_box' ) );
			add_action( 'add_acm_meta_boxes', array( __CLASS__, 'acm_custom_logos_add_meta_box' ) );

			register_setting(
				'acm_config',
				'acm_number_of_posts',
				'acm_basic_sanitize'
			);
			register_setting(
				'acm_config',
				'acm_social_networks',
				array(
					'default' => array(
						'facebook'  => 'https://www.facebook.com/AssociationForComputingMachinery/',
						'flickr'    => 'https://www.flickr.com/photos/theofficialacm',
						'linkedin'  => 'https://www.linkedin.com/company/association-for-computing-machinery',
						'email'     => 'acmhelp@acm.org',
						'twitter'   => 'https://twitter.com/theofficialacm',
						'instagram' => 'https://www.instagram.com/theofficialacm/',
						'youtube'   => 'https://www.youtube.com/user/TheOfficialACM',
					),
				)
			);
			register_setting(
				'acm_config',
				'acm_custom_logos'
			);
		}
	}

	/**
	 * Load Script Needed For Meta Box.
	 *
	 * @param [integer] $custom_page_id Page which use custom meta boxes.
	 */
	public static function acm_config_enqueue_scripts( $custom_page_id ) {
		if ( self::PAGE_ID == $custom_page_id ) {
			wp_enqueue_media();
			wp_enqueue_script( 'common' );
			wp_enqueue_script( 'wp-lists' );
			wp_enqueue_script( 'postbox' );
		}
	}

	/**
	 * Footer Script Needed for Meta Box.
	 */
	public static function acm_config_footer_scripts() {            ?>
<script type="text/javascript">
//<![CDATA[
jQuery(document).ready(function($) {
	var file_frame = [];
	var $button = $('.meta-box-upload-button');
	var $removebutton = $('.meta-box-upload-button-remove');
	var $hiddenRefer = $('[name="_wp_http_referer"]');
	// Prevent reset when user wants to upload;
	if ($hiddenRefer.val().includes('action=reset_settings')) {
		$hiddenRefer.val('/wp-admin/admin.php?page=acm_config');
	}
	// Toogle boxes.
	$('.if-js-closed').removeClass('if-js-closed').addClass('closed');
	postboxes.add_postbox_toggles('<?php echo esc_html( self::PAGE_ID ); ?>');
	// Display spinner.
	$('#fx-smb-form').submit(function() {
		$('#publishing-action .spinner').css('display', 'inline');
	});
	// Confirm before reset.
	$('#delete-action .submitdelete').on('click', function() {
		return confirm('Are you sure want to do this?');
	});

	$button.on('click', function(event) {
		event.preventDefault();
		var $this = $(this);
		var id = $this.attr('id');
		// If the media frame already exists, reopen it.
		if (file_frame[id]) {
			file_frame[id].open();
			return;
		}
		// Create the media frame.
		file_frame[id] = wp.media.frames.file_frame = wp.media({
			title: $this.data('uploader_title'),
			button: {
				text: $this.data('uploader_button_text')
			},
			multiple: false // Set to true to allow multiple files to be selected
		});
		// When an image is selected, run a callback.
		file_frame[id].on('select', function() {
			// We set multiple to false so only get one image from the uploader
			var attachment = file_frame[id].state().get('selection').first().toJSON();
			// set input
			$('#' + id + '-value').val(attachment.id);
			// set preview
			var img = '<img src="' + attachment.url + '" style="max-width:200px;" />';
			$('.' + id + '-image-preview').append(img);
		});
		// Finally, open the modal
		file_frame[id].open();
	});

	$removebutton.on('click', function(event) {
		event.preventDefault();
		var $this = $(this);
		var id = $this.prev('input').attr('id');
		$('.' + id + '-image-preview').html('');
		$('#' + id + '-value').val(0);
	});
});
//]]>
</script>
		<?php
	}

	/**
	 * Number of columns available in Settings Page, we can only set to 1 or 2 column.
	 *
	 * @param [array]   $columns Array of columns.
	 * @param [integer] $screen_id Screen id.
	 * @return [array] Array of columns edited.
	 */
	public static function acm_config_screen_layout_column( $columns, $screen_id ) {
		if ( self::PAGE_ID == $screen_id ) {
			$columns[ self::PAGE_ID ] = 2;
		}
		return $columns;
	}

	/**
	 * Settings Page Callback
	 */
	public static function acm_config_settings_page() {
		 global $hook_suffix;
		do_action( 'acm_config_settings_page_init' );
		/* Enable add_acm_meta_boxes function in this page. */
		do_action( 'add_acm_meta_boxes', $hook_suffix );
		?>
<div class="wrap">
	<h2>ACM Theme Configuration</h2>
		<?php settings_errors(); ?>
	<div class="fx-settings-meta-box-wrap">
		<form id="fx-smb-form" method="post" action="options.php">
			<?php settings_fields( 'acm_config' ); ?>
			<?php wp_nonce_field( 'closedpostboxes', 'closedpostboxesnonce', false ); ?>
			<?php wp_nonce_field( 'meta-box-order', 'meta-box-order-nonce', false ); ?>
			<div id="poststuff">
				<div id="post-body"
					class="metabox-holder columns-<?php echo 1 == get_current_screen()->get_columns() ? '1' : '2'; ?>">
					<div id="postbox-container-1" class="postbox-container">
						<?php do_meta_boxes( $hook_suffix, 'side', null ); ?>
					</div>
					<div id="postbox-container-2" class="postbox-container">
						<?php do_meta_boxes( $hook_suffix, 'normal', null ); ?>
						<?php do_meta_boxes( $hook_suffix, 'advanced', null ); ?>
					</div>
				</div>
				<br class="clear">
			</div>
		</form>
	</div>
</div>
		<?php
	}

	/**
	 * Delete Options.
	 */
	public static function acm_config_reset_settings() {
		$action = isset( $_REQUEST['action'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['action'] ) ) : '';
		if ( 'reset_settings' == $action ) {
			if ( current_user_can( 'manage_options' ) ) {
				$nonce = isset( $_REQUEST['_wpnonce'] ) ? sanitize_key( $_REQUEST['_wpnonce'] ) : '';
				if ( wp_verify_nonce( $nonce, 'fx-smb-reset' ) ) {
					delete_option( 'acm_number_of_posts' );
					delete_option( 'acm_social_networks' );
					delete_option( 'acm_custom_logos' );
					delete_option( 'acm_disable_comments' );
					delete_option( 'acm_enable_gutenberg_support' );

					/* Utility hook. */
					do_action( 'acm_config_reset' );
					/* Add Update Notice. */
					add_settings_error( 'acm_config', '', 'Settings reset to defaults.', 'updated' );
				} else {
					/* Add Error Notice. */
					add_settings_error( 'acm_config', '', 'Failed to reset settings. Please try again.', 'error' );
				}
			} else {
				/* Add Error Notice. */
				add_settings_error( 'acm_config', '', 'Failed to reset settings. You do not capability to do this action.', 'error' );
			}
		}
	}

	/**
	 * Add Submit/Save Meta Box.
	 *
	 * @uses acm_config_submit_meta_box()
	 * @link http://codex.wordpress.org/Function_Reference/add_meta_box
	 */
	public static function acm_config_submit_add_meta_box() {
		add_meta_box(
			'submitdiv',
			'Save Options',
			array( __CLASS__, 'acm_config_submit_meta_box' ),
			self::PAGE_ID,
			'side',
			'high'
		);
	}

	public static function acm_config_submit_feedback() {
		add_meta_box(
			'submitfeedback',
			'Send Feedback',
			array( __CLASS__, 'acm_config_submit_feedback_section' ),
			self::PAGE_ID,
			'normal',
			'high'
		);
	}

	public static function acm_config_comments_and_gutenberg() {
		add_meta_box(
			'disablecomments',
			'Comments and Gutenberg editor',
			array( __CLASS__, 'acm_config_disable_comments_section' ),
			self::PAGE_ID,
			'normal',
			'high'
		);
	}



	public static function acm_config_submit_feedback_section() {
		?>
<div>

	<p><?php echo __( 'If you found any bugs, please press the "Send Feedback" button bellow in order to be redirected to your default email app/client where you could describe the problem with the theme and send email to us.', 'acm' ); ?>
	</p>
	<a
		href="mailto:technicalsupport@acm.org?subject=Feedback%20on%20WordPress%20theme"><?php echo __( 'Send Feedback', 'acm' ); ?></a>
</div>

		<?php

	}

	public static function acm_config_disable_comments_section() {
		?>
<div>

	<div class="">
		<input type="checkbox" class="checkbox" id="acm_enable_gutenberg_support"
			<?php echo get_option( 'acm_enable_gutenberg_support' ) ? 'checked' : ''; ?>
			name="acm_enable_gutenberg_support" />
		<label
			for="acm_enable_gutenberg_support"><?php _e( 'Checked box means ACM Gutenberg blocks are enabled. In case you need to switch back to php templates - please uncheck the box and save settings.', 'acm' ); ?></label>
	</div>
	<br>
	<div class="">

		<input type="checkbox" class="checkbox" id="acm_disable_comments"
			<?php echo get_option( 'acm_disable_comments' ) ? 'checked' : ''; ?> name="acm_disable_comments" />
		<label for="acm_disable_comments"><?php _e( 'Checked box means comments are disabled', 'acm' ); ?></label>
	</div>


</div>

		<?php
	}

	/**
	 * Submit Meta Box Callback.
	 */
	public static function acm_config_submit_meta_box() {
		/* Reset URL */
		$reset_url = add_query_arg(
			array(
				'page'     => 'acm_config',
				'action'   => 'reset_settings',
				'_wpnonce' => wp_create_nonce( 'fx-smb-reset', __FILE__ ),
			),
			admin_url( 'admin.php' )
		);
		?>
<div id="submitpost" class="submitbox">
	<div id="major-publishing-actions">
		<div id="delete-action">
			<a href="<?php echo esc_url( $reset_url ); ?>" class="submitdelete deletion">
				Reset Settings
			</a>
		</div>
		<div id="publishing-action">
			<span class="spinner"></span>
			<?php submit_button( esc_attr( 'Save' ), 'primary', 'submit', false ); ?>
		</div>
		<div class="clear"></div>
	</div>
</div>

		<?php
	}


	/**
	 * Number of post meta box.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_meta_box
	 */
	public static function acm_config_basic_add_meta_box() {
		add_meta_box(
			'basic',
			'Number of posts to display',
			array( __CLASS__, 'acm_number_of_posts_meta_box' ),
			self::PAGE_ID,
			'normal',
			'default'
		);
	}

	/**
	 * Number of post meta box callback.
	 */
	public static function acm_number_of_posts_meta_box() {
		?>
<p>
	<label for="basic-text">Number of post</label>
	<input id="basic-text" class="widefat" type="number" name="acm_number_of_posts"
		value="<?php echo esc_html( get_option( 'acm_number_of_posts', '' ) ); ?>">
</p>
<p class="howto">
	Set a number of post to display in the main page. *If field is empty there will be no restrictions of posts.
</p>
		<?php
	}

	/**
	 * Sanitize Basic Settings, this function is defined in register_setting().
	 *
	 * @param [string] $settings Settings to sanitize.
	 * @return settings Settings sanitized.
	 */
	public static function acm_config_basic_sanitize( $settings ) {
		$settings = sanitize_text_field( $settings );
		return $settings;
	}

	/**
	 * Social networks meta box.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_meta_box
	 */
	public static function acm_social_networks_add_meta_box() {
		add_meta_box(
			'acm_social_networks',
			'Social Networks',
			array( __CLASS__, 'acm_social_networks_meta_box' ),
			self::PAGE_ID,
			'normal',
			'default'
		);
	}

	/**
	 * Social networks meta box callback.
	 */
	public static function acm_social_networks_meta_box() {
		 $social_options = get_option( 'acm_social_networks' );
		?>
<p class="howto">
	Enter the full URL of your social network. Links will be displayed in the footer.
</p>
<p>
	<label for="facebook">Facebook</label>
	<input id="facebook" class="widefat" type="url" name="acm_social_networks[facebook]"
		placeholder="https://www.facebook.com/pages/ACM-Association-for-Computing-Machinery"
		value="<?php echo esc_html( sanitize_text_field( $social_options['facebook'] ) ); ?>">
</p>
<p>
	<label for="flickr">Flickr</label>
	<input id="flickr" class="widefat" type="url" name="acm_social_networks[flickr]"
		placeholder="https://www.flickr.com/photos/theofficialacm"
		value="<?php echo esc_html( sanitize_text_field( $social_options['flickr'] ) ); ?>">
</p>
<p>
	<label for="linkedin">LinkedIn</label>
	<input id="linkedin" class="widefat" type="url" name="acm_social_networks[linkedin]"
		placeholder="https://www.linkedin.com/company-beta/785681/"
		value="<?php echo esc_html( sanitize_text_field( $social_options['linkedin'] ) ); ?>">
</p>
<p>
	<label for="email">Email</label>
	<input id="email" class="widefat" type="email" name="acm_social_networks[email]"
		placeholder="mailto:acmhelp@acm.org" value="<?php echo esc_html( sanitize_email( $social_options['email'] ) ); ?>">
</p>
<p>
	<label for="twitter">Twitter</label>
	<input id="twitter" class="widefat" type="url" name="acm_social_networks[twitter]"
		placeholder="https://twitter.com/theofficialacm"
		value="<?php echo esc_html( sanitize_text_field( $social_options['twitter'] ) ); ?>">
</p>
<p>
	<label for="instagram">Instagram</label>
	<input id="instagram" class="widefat" type="url" name="acm_social_networks[instagram]"
		placeholder="https://www.instagram.com/theofficialacm/"
		value="<?php echo esc_html( sanitize_text_field( $social_options['instagram'] ) ); ?>">
</p>
<p>
	<label for="youtube">YouTube</label>
	<input id="youtube" class="widefat" type="url" name="acm_social_networks[youtube]"
		placeholder="https://www.youtube.com/user/TheOfficialACM"
		value="<?php echo esc_html( sanitize_text_field( $social_options['youtube'] ) ); ?>">
</p>
		<?php
	}

	/**
	 * Custom logos meta box.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_meta_box
	 */
	public static function acm_custom_logos_add_meta_box() {
		add_meta_box(
			'acm_custom_logos',
			'Custom Logos',
			array( __CLASS__, 'acm_custom_logos_meta_box' ),
			self::PAGE_ID,
			'normal',
			'default'
		);
	}

	/**
	 * Custom logos meta box callback.
	 */
	public static function acm_custom_logos_meta_box() {
		$custom_logos = get_option( 'acm_custom_logos' );
		?>
<p class="howto">
	Upload up to 5 sponsor logos. These will be displayed in the footer.
</p>
		<?php
		$field_names = array(
			'acm_custom_logo_1',
			'acm_custom_logo_2',
			'acm_custom_logo_3',
			'acm_custom_logo_4',
			'acm_custom_logo_5',
			'acm_custom_logo_6',
		);
		foreach ( $field_names as $key => $name ) :
			$value = $custom_logos[ $name ] ?? 'Logo' . $name;
			$name  = esc_attr( $name );
			?>
<h5>Logo - <?php echo esc_html( $key + 1 ); ?></h5>
<input type="hidden" id="<?php echo esc_html( $name ); ?>-value" class="small-text"
	name="acm_custom_logos[<?php echo esc_html( $name ); ?>]" value="<?php echo esc_html( $value ); ?>" />
<input type="button" id="<?php echo esc_html( $name ); ?>" class="button meta-box-upload-button" value="Upload" />
			<?php
			if ( $value ) :
				?>
<input type="button" id="<?php echo esc_html( $name ); ?>-remove" class="button meta-box-upload-button-remove"
	value="Remove" />
				<?php
			endif;
			$image = wp_get_attachment_thumb_url( $value );
			?>
<div class="<?php echo esc_html( $name ); ?>-image-preview">
			<?php if ( $image ) : ?>
	<img src="<?php echo esc_url( $image ); ?>">
	<?php endif; ?>
</div>
<br />
			<?php
		endforeach;
	}
}
