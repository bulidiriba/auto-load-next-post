<?php
/**
 * Auto Load Next Post Theme Support: Twenty Eleven
 *
 * Applies support for WordPress Twenty Eleven Theme.
 *
 * @since    1.5.0
 * @author   Sébastien Dumont
 * @category Core
 * @package  Auto Load Next Post
 * @license  GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * ALNP_Twenty_Eleven class.
 */
class ALNP_Twenty_Eleven {

	/**
	 * Initlize Theme.
	 *
	 * @access public
	 * @static
	 */
	public static function init() {
		// This removes the default post navigation in the repeater template.
		remove_action( 'alnp_load_after_content', 'auto_load_next_post_navigation', 1, 10 );

		// Add a compaitable post navigation.
		add_action( 'alnp_load_after_content', 'alnp_twentyeleven_post_navigation', 1, 10 );

		// Filters the repeater template location.
		add_filter( 'alnp_template_redirect', 'alnp_twentyeleven_template_redirect' );

		// Override theme selectors.
		add_theme_support( 'auto-load-next-post' array(
			'content_container'    => '#content',
			'title_selector'       => 'h1.entry-title',
			'navigation_container' => '#nav-single',
			'comments_container'   => 'div#comments',
		) );
	} // END init()

	/**
	 * Adds a compaitable post navigation.
	 *
	 * @access public
	 * @static
	 */
	public static function alnp_twentyeleven_post_navigation() {
		?>
		<nav id="nav-single">
			<h3 class="assistive-text"><?php _e( 'Post navigation', 'auto-load-next-post' ); ?></h3>
			<span class="nav-previous"><?php previous_post_link( '%link', __( '<span class="meta-nav">&larr;</span> Previous', 'auto-load-next-post' ) ); ?></span>
		</nav><!-- #nav-single -->
		<?php
	} // END alnp_twentyeleven_post_navigation()

	/**
	 * Filters the location of the repeater template.
	 *
	 * @access public
	 * @static
	 * @return string
	 */
	public static function alnp_twentyeleven_template_redirect() {
		return AUTO_LOAD_NEXT_POST_FILE_PATH . '/template/theme-support/twenty-eleven/content-alnp.php';
	} // END alnp_twentyeleven_template_redirect()

} // END class

ALNP_Twenty_Eleven::init();