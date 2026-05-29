<?php

/**
 * Utility methods for ACM theme.
 *
 * PHP version 5
 *
 * @category  Utility
 * @package   ACM_Wordpress_Theme
 * @author
 * @copyright
 * @license
 * @link      https://services.acm.org/public/infodir/wordpress.cfm
 */

/**
 * Implements hook_help().
 */
class ACMUtils {

	/**
	 * Get data from json file.
	 *
	 * @param  string $file Name of the json file.
	 * @return array|null Return array of data is json file exist.
	 */
	public static function get_data_from_json( $file ) {
		$data_url = get_template_directory() . $file;
		// Get data.
		$str  = file_exists( $data_url ) ? file_get_contents( $data_url ) : '';
		$json = json_decode( $str, true );
		return $json;
	}
	/**
	 * Create breadcrumb.
	 */
	public static function the_breadcrumb() {
		?>
<ul id="crumbs" class="breadcrumbs">
		<?php
		if ( ! is_home() ) :
			?>
	<li><a href="<?php echo esc_url( get_option( 'home' ) ); ?>">Home</a></li>
			<?php
			if ( is_category() || is_single() ) :
				?>
	<li>
				<?php
				if ( the_category() ) {
							the_category( ' </li><li> ' );
				}
				if ( is_single() ) :
					?>
	</li>
	<li><?php the_title(); ?></li>
					<?php
				endif;
					elseif ( is_page() ) :
						?>
	<li><?php the_title(); ?></li>
						<?php
					endif;
				elseif ( is_tag() ) :
					?>
	<li><?php single_tag_title(); ?></li>
					<?php
				elseif ( is_day() ) :
					?>
	<li>Archive for <?php the_time( 'F jS, Y' ); ?></li>
					<?php
				elseif ( is_month() ) :
					?>
	<li>Archive for <?php the_time( 'F, Y' ); ?></li>
					<?php
				elseif ( is_year() ) :
					?>
	<li>Archive for <?php the_time( 'Y' ); ?></li>
					<?php
				elseif ( is_author() ) :
					?>
	<li>Author Archive</li>
					<?php
				elseif ( isset( $_GET['paged'] ) && ! empty( $_GET['paged'] ) ) :
					?>
	<li>Blog Archives</li>
					<?php
				elseif ( is_search() ) :
					?>
	<li>Search Results</li>
					<?php
				endif
				?>
</ul>
		<?php
	}
	/**
	 * Get banner data (from WCK fields).
	 *
	 * @param  int $post_id Current post id.
	 * @return array
	 */
	public static function get_banner_data( $post_id ) {
		// Get custom data.
		$meta_data   = array(
			'title'       => get_field( 'banner_box_title', $post_id ),
			'sub_title'   => get_field( 'banner_box_sub_title', $post_id ),
			'description' => get_field( 'banner_box_description', $post_id ),
			'image'       => get_field( 'banner_box_image', $post_id ),
		);
		$banner_data = array(
			'title'       => null,
			'sub_title'   => null,
			'description' => null,
			'image'       => null,
		);
		// Previous custom field names.
		$custom_fields = array(
			'title'       => 'meta-banner-top-title',
			'sub_title'   => 'meta-banner-title',
			'description' => 'meta-banner-description',
			'image'       => '_banner_attached_image',
		);
		if ( is_array( $meta_data ) ) {
			foreach ( $meta_data as $key => $data ) {
				$banner_data[ $key ] = $data;
			}
		} else {
			// Fallback for existing custom fields.
			foreach ( $custom_fields as $index => $field ) {
				$banner_data[ $index ] = get_post_meta( $post_id, $field, true );
			}
		}
		// Get banner image.
		$banner_data['image'] = is_numeric( $banner_data['image'] ) ?
			self::get_image( $banner_data['image'], 'large' ) :
			'';
		return $banner_data;
	}
	/**
	 * Get banner image through image id.
	 *
	 * @param  int    $image_id Image id.
	 * @param  string $size     Image size.
	 * @return string Image url.
	 */
	public static function get_image( $image_id, $size ) {
		$attachment_image = wp_get_attachment_image_src( $image_id, $size );
		$image_url        = is_array( $attachment_image ) ? $attachment_image[0] : '';
		return $image_url;
	}
}
