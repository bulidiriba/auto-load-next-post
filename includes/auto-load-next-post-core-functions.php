<?php
/**
 * Auto Load Next Post Core Functions
 *
 * General core functions available for both the front-end and admin.
 *
 * @since    1.0.0
 * @version  1.6.0
 * @author   Sébastien Dumont
 * @category Core
 * @package  Auto Load Next Post/Functions
 * @license  GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'alnp_get_post_type' ) ) {
	/**
	 * Returns the post type.
	 *
	 * @since  1.4.12
	 * @return string
	 */
	function alnp_get_post_type() {
		$post_type = get_post_type();

		// If the post type is a post then return single instead.
		if ( $post_type == 'post' ) {
			return 'single';
		}

		return $post_type;
	}
}

if ( ! function_exists( 'alnp_get_post_types' ) ) {
	/**
	 * This returns a list of public registered post types.
	 *
	 * @since  1.6.0
	 * @return array $post_types
	 */
	function alnp_get_post_types() {
		$post_types = array(
			'post' => 'Post'
		);

		// If Auto Load Next Post Pro is installed then return all public post types.
		if ( is_alnp_pro_version_installed() ) {
			$post_types = get_post_types( array( 'public' => true ), 'names' );
		}

		// Un-supported post types are unset.
		$post_types = alnp_unset_unsupported_post_types( $post_types );

		return $post_types;
	} // END alnp_get_post_types()
}

if ( ! function_exists( 'alnp_unset_unsupported_post_types' ) ) {
	/**
	 * Unsets un-supported post types.
	 *
	 * @since  1.6.0
	 * @return array $post_types
	 */
	function alnp_unset_unsupported_post_types( $post_types ) {
		unset( $post_types['elementor_library'] );
		unset( $post_types['tdb_templates'] );

		$post_types = apply_filters( 'alnp_unset_unsupported_post_types', $post_types );

		return $post_types;
	} // END alnp_unset_unsupported_post_types()
}

if ( ! function_exists( 'alnp_get_random_page_permalink' ) ) {
	/**
	 * Returns the permalink of a random page
	 *
	 * @since  1.5.0
	 * @param  string $post_type - Default is post.
	 * @return int|boolean
	 */
	function alnp_get_random_page_permalink( $post_type = 'post' ) {
		$args = array(
			'post_type'      => $post_type,
			'post_status'    => 'publish',
			'orderby'        => 'rand',
			'posts_per_page' => 1
		);

		$query = new WP_Query( $args );

		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) : $query->the_post();
				$id = get_the_ID();

				return get_permalink( $id );
			endwhile;
		} else {
			return false;
		}
	} // END alnp_get_random_page_permalink()
}

if ( ! function_exists( 'alnp_load_js_in_footer' ) ) {
	/**
	 * This helps the plugin decide to load the JavaScript in the footer or not.
	 * 
	 * @since  1.5.7
	 * @return boolean
	 */
	function alnp_load_js_in_footer() {
		$load_in_footer = get_option( 'auto_load_next_post_load_js_in_footer', false );

		if ( isset( $load_in_footer ) && $load_in_footer == 'yes' ) {
			return true;
		}

		return false;
	} // END alnp_load_js_in_footer()
}

if ( ! function_exists( 'alnp_disable_on_mobile' ) ) {
	/**
	 * This helps the plugin decide to disable Auto Load Next Post 
	 * from running on mobile devices.
	 * 
	 * @since  1.6.0
	 * @return boolean
	 */
	function alnp_disable_on_mobile() {
		$disable_mobile = get_option( 'auto_load_next_post_disable_on_mobile', false );

		if ( isset( $disable_mobile ) && $disable_mobile == 'yes' ) {
			return true;
		}

		return false;
	} // END alnp_disable_on_mobile()
}

if ( ! function_exists( 'alnp_get_admin_screens' ) ) {
	/**
	 * These are the only screens Auto Load Next Post will focus 
	 * on displaying notices or equeue scripts/styles.
	 *
	 * @since   1.5.11
	 * @version 1.6.0
	 * @return  array
	 */
	function alnp_get_admin_screens() {
		return array(
			'dashboard',
			'plugins',
			'themes',
			'settings_page_auto-load-next-post'
		);
	} // END alnp_get_admin_screens()
}

if ( ! function_exists( 'alnp_meta_version' ) ) {
	/**
	 * Adds the plugin version to the header.
	 *
	 * @since 1.6.0
	 */
	function alnp_meta_version() {
		echo '<meta name="generator" content="Auto Load Next Post ' . esc_attr( AUTO_LOAD_NEXT_POST_VERSION ) . '" />' . "\n";
	} // END alnp_meta_version()
}