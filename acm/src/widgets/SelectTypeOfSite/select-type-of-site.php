<div class="acm-widget">
<?php

	$type_of_site_selected = ( isset( $_POST['site'] ) ) ?
		sanitize_text_field( wp_unslash( $_POST['site'] ) ) :
		'';
	// Set type of site after user select an option.
if ( $type_of_site_selected ) {
	$type_of_site_correct = 'none' === $type_of_site_selected ? '' : $type_of_site_selected;
	self::set_type_of_site( $type_of_site_correct );
}
	// Get option selected.
	$type_of_site = self::get_widget_option( self::ID, 'type_of_site' );
if ( ! $type_of_site && 'none' !== $type_of_site ) :
	?>
	<h2 class="acm-widget__title">Select the type of site to create</h2>
	<form method="post" class="dashboard-widget-control-form wp-clearfix">
		<input type="hidden" name="_wp_http_referer" value="/wp-admin/index.php?edit=acm_type_of_site">
		<select name="site" class="acm-widget__select" required>
			<option value="">Select type</option>
			<option value="conference">Conference</option>
			<option value="sig">SIG</option>
			<option value="chapter">Chapter</option>
		</select>
		<button class="wp-core-ui button-primary" type="submit">Create</button>
	</form>
	<?php
	else :
		?>
	<h2 class="acm-widget__title">
		Your site type is:
		<strong> <?php echo esc_html( ucfirst( $type_of_site ) ); ?> </strong>
		<hr>
		<form method="post" class="dashboard-widget-control-form wp-clearfix">
			<input type="hidden" name="_wp_http_referer" value="/wp-admin/index.php?edit=acm_type_of_site">
			<input type="hidden" name="site" value="none">
			<button class="wp-core-ui button-primary" type="submit">Reset type of site</button>
		</form>
		<p class="acm-widget__disclaimer">
			Reseting the theme set-up will give you the option to change the site type. Note this will not delete existing menus so you will end up with duplicates if you have not manually removed these first in <strong>appearance/menus</strong>.
		</p>
	</h2>
		<?php
	endif;
	?>
</div>
