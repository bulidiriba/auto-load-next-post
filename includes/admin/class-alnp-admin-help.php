<?php
/**
 * Auto Load Next Post: Help Tab.
 *
 * Adds a help tab to the settings page providing useful
 * and helpful information for the users.
 *
 * @since    1.0.0
 * @version  1.5.7
 * @author   Sébastien Dumont
 * @category Admin
 * @package  Auto Load Next Post/Admin/Help
 * @license  GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'ALNP_Admin_Help' ) ) {

	class ALNP_Admin_Help {

		/**
		 * Constructor
		 *
		 * @access public
		 * @since  1.0.0
		 */
		public function __construct() {
			add_action( 'current_screen', array( $this, 'add_help_tabs' ), 50 );
		} // END __construct()

		/**
		 * Adds help tabs to the plugin pages.
		 *
		 * @access  public
		 * @since   1.0.0
		 * @version 1.5.7
		 */
		public function add_help_tabs() {
			$screen = get_current_screen();

			if (	$screen->id != 'settings_page_auto-load-next-post-settings') {
				return;
			}

			$screen->add_help_tab( array(
				'id'      => 'auto_load_next_post_theme_selectors_tab',
				'title'   => __( 'Theme Selectors', 'auto-load-next-post' ),
				'content' =>
					'<h2>' . __( 'Theme Selectors', 'auto-load-next-post' ) . '</h2>' .
					'<p>' . sprintf( __( 'Theme Selectors allows %s look for where to load content in, the post being read, the next post to load and whether to show or hide comments per post.', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ) . '</p>' .
					'<p>' . sprintf( __( 'When the plugin was activated, default theme selectors are set that match the majority of most WordPress themes. If the active theme supports %1$s then it will set its own theme selectors. If the theme has not declared support for %1$s and posts are not loading, dont worry. It is most likely that at least one of these selectors need to be changed. You may find it to be the <em>Content Container</em>. See more information on %2$show to find your theme selectors%3$s.', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ), '<a href="' . AUTO_LOAD_NEXT_POST_STORE_URL . 'documentation/find-theme-selectors/">', '</a>' ) . '</p>' .
					'<p>' . sprintf( esc_html__( 'These are the default theme selectors when %s is installed.', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ) . '</p>' .
					'<h5>' . esc_html__( 'Default Theme Selectors', 'auto-load-next-post' ) . '</h5>' .
					'<ul>' .
					'<li><strong>' . esc_html__( 'Content Container', 'auto-load-next-post' ) . '</strong>' . '<br>main.site-main</li>' .
					'<li><strong>' . esc_html__( 'Post Title', 'auto-load-next-post' ) . '</strong>' . '<br>h1.entry-title</li>' .
					'<li><strong>' . esc_html__( 'Post Navigation', 'auto-load-next-post' ) . '</strong>' . '<br>nav.post-navigation</li>' .
					'<li><strong>' . esc_html__( 'Comments Container', 'auto-load-next-post' ) . '</strong>' . '<br>div#comments</li>' .
					'</ul>'
			) );

			$screen->add_help_tab( array(
				'id'      => 'auto_load_next_post_support_tab',
				'title'   => esc_html__( 'Help & Support', 'auto-load-next-post' ),
				'content' =>
					'<h2>' . esc_html__( 'Help & Support', 'auto-load-next-post' ) . '</h2>' .
					'<p>' . sprintf( __( 'Should you need help understanding, using, or extending %1$s, please %2$sread the documentation%3$s. You will find snippets, tutorials and much more.', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ), '<a href="' . AUTO_LOAD_NEXT_POST_STORE_URL . 'documentation/?utm_source=wpadmin&utm_campaign=plugin-settings-help-tab" aria-label="' . esc_attr__( 'View Auto Load Next Post documentation', 'auto-load-next-post' ) . '" target="_blank">', '</a>' ) . '</p>' .
					'<p>' . sprintf( __( 'For further assistance with %1$s you can use the %2$scommunity forum%3$s.', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ), '<a href="'. AUTO_LOAD_NEXT_POST_SUPPORT_URL . '"aria-label="' . esc_attr__( 'Get support from the community', 'auto-load-next-post' ). '" target="_blank">', '</a>' ) . '</p> ' .
					'<p>' . sprintf( __( '%1$s is in need of translations. Is the plugin not translated in your language or do you spot errors with the current translations? Helping out is easy! Head over to the project on WordPress.org and click %2$sTranslate %1$s%3$s.', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ), '<a href="https://translate.wordpress.org/projects/wp-plugins/auto-load-next-post" target="_blank">', '</a>' ) . '</p>' .
					'<p><a href="' . AUTO_LOAD_NEXT_POST_STORE_URL . 'documentation/?utm_source=wpadmin&utm_campaign=plugin-settings-help-tab" class="button button-primary" aria-label="' . esc_attr__( 'View Auto Load Next Post documentation', 'auto-load-next-post' ) . '" target="_blank">' . esc_html__( 'Documentation', 'auto-load-next-post' ) . '</a> <a href="'. AUTO_LOAD_NEXT_POST_SUPPORT_URL . '" class="button button-secondary" aria-label="' . esc_attr__( 'Get support from the community', 'auto-load-next-post' ). '" target="_blank">' . esc_html__( 'Community Forum', 'auto-load-next-post' ) . '</a> <a href="' . AUTO_LOAD_NEXT_POST_STORE_URL . 'f-a-q/?utm_source=wpadmin&utm_campaign=plugin-settings-help-tab" class="button button-secondary" target="_blank">' . esc_html__( 'Frequently Asked Questions', 'auto-load-next-post' ) . '</a> <a href="https://translate.wordpress.org/projects/wp-plugins/auto-load-next-post" class="button button-secondary" target="_blank">' . sprintf( esc_html__( 'Translate %s', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ) . '</a></p>'
			) );

			$screen->add_help_tab( array(
				'id'      => 'auto_load_next_post_bugs_tab',
				'title'   => esc_html__( 'Found a bug?', 'auto-load-next-post' ),
				'content' =>
					'<h2>' . esc_html__( 'Found a bug?', 'auto-load-next-post' ) . '</h2>' .
					'<p>' . sprintf( __( 'If you find a bug within %1$s, please %2$sreport the issue%4$s by creating a ticket on the GitHub repository where I can deal with it more appropriately. Please ensure that you have read the %3$sguidelines to contributing%4$s prior to submitting your report. To help me solve the issue, please be as descriptive as possible.', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ), '<a href="https://github.com/autoloadnextpost/auto-load-next-post/issues?state=open" target="_blank">', '<a href="https://github.com/autoloadnextpost/auto-load-next-post/blob/master/CONTRIBUTING.md" target="_blank">', '</a>' ) . '</p>' .
					'<p><a href="https://github.com/autoloadnextpost/auto-load-next-post/issues?state=open" class="button button-primary" target="_blank">' . esc_html__( 'Report an Issue', 'auto-load-next-post' ) . '</a></p>'
			) );

			$screen->add_help_tab(array(
				'id'      => 'auto_load_next_post_feedback_tab',
				'title'   => esc_html__( 'Feedback', 'auto-load-next-post' ),
				'content' =>
					'<h2>' . esc_html__( 'Feedback', 'auto-load-next-post' ) . '</h2>' .
					'<p>' . esc_html__( 'Your feedback is very important to me so please consider leaving a review on WordPress.org', 'auto-load-next-post' ) . '</p>' .
					'<p>' . sprintf( __( 'If %1$s has worked out for you well and you like it, please either consider %2$smaking a donation%3$s or signing up to be on the list for %1$s Pro.', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ), '<a href="https://sebdumont.xyz/donate/" target="_blank">', '</a>' ) . '</p>'.
					'<p><a href="' . AUTO_LOAD_NEXT_POST_REVIEW_URL . '?filter=5#postform" class="button button-primary" target="_blank" aria-label="' . esc_attr( __( 'Review Auto Load Next Post on WordPress.org', 'auto-load-next-post' ) ) . '">' . esc_html__( 'Leave a Review', 'auto-load-next-post' ) . '</a> <a href="https://sebdumont.xyz/donate/" class="button button-secondary" target="_blank">' . esc_html__( 'Make a Donation', 'auto-load-next-post' ) . '</a></p>'
			) );

			$screen->set_help_sidebar(
				'<p><strong>' . esc_html__( 'For more information:', 'auto-load-next-post' ) . '</strong></p>' .
				'<p><a href="' . AUTO_LOAD_NEXT_POST_STORE_URL . 'about/?utm_source=wpadmin&utm_campaign=plugin-settings-help-tab" target="_blank">' . sprintf( esc_html__( 'About %s', 'auto-load-next-post' ), esc_html__( 'Auto Load Next Post', 'auto-load-next-post' ) ) . '</a></p>' .
				'<p><a href="https://wordpress.org/plugins/auto-load-next-post/" target="_blank">' . esc_html__( 'WordPress.org Project', 'auto-load-next-post' ) . '</a></p>' .
				'<p><a href="https://github.com/autoloadnextpost/auto-load-next-post/" target="_blank">' . esc_html__( 'GitHub Project', 'auto-load-next-post' ) . '</a></p>'
			);

		} // END add_help_tabs()

	} // END ALNP_Admin_Help class.

} // END if class exists.

return new ALNP_Admin_Help();
