<?php
/**
 * Auto Load Next Post Settings Page
 *
 * @since    1.0.0
 * @version  1.6.0
 * @author   Sébastien Dumont
 * @category Admin
 * @package  Auto Load Next Post/Admin/Settings
 * @license  GPL-2.0+
 */

if ( ! defined('ABSPATH') ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'ALNP_Settings_Page' ) ) {

	abstract class ALNP_Settings_Page {

		/**
		 * Setting page id.
		 *
		 * @access protected
		 * @var    string $id
		 */
		protected $id = '';

		/**
		 * Setting page label.
		 *
		 * @access protected
		 * @var    string $label
		 */
		protected $label = '';

		/**
		 * Constructor.
		 *
		 * @access  public
		 * @since   1.4.10
		 * @version 1.6.0
		 */
		public function __construct() {
			add_filter( 'alnp_settings_tabs_array', array( $this, 'add_settings_page' ), 20 );
			add_action( 'auto_load_next_post_sections_' . $this->id, array( $this, 'output_sections' ) );
			add_action( 'auto_load_next_post_settings_' . $this->id, array( $this, 'need_help' ), 5 );
			add_action( 'auto_load_next_post_settings_' . $this->id, array( $this, 'output' ), 10 );
			add_action( 'auto_load_next_post_settings_save_' . $this->id, array( $this, 'save' ) );
		}

		/**
		 * Get settings page ID.
		 *
		 * @access public
		 * @since  1.4.10
		 * @return string
		 */
		public function get_id() {
			return $this->id;
		} // END get_id()

		/**
		 * Get settings page label.
		 *
		 * @access public
		 * @since  1.4.10
		 * @return string
		 */
		public function get_label() {
			return $this->label;
		} // END get_label()

		/**
		 * Add this page to settings.
		 *
		 * @access public
		 * @since  1.0.0
		 * @param  array $pages
		 * @return array $pages
		 */
		public function add_settings_page( $pages ) {
			$pages[$this->id] = $this->label;

			return $pages;
		} // END add_settings_page()

		/**
		 * Add this settings page to plugin menu.
		 *
		 * @access public
		 * @since  1.0.0
		 * @param  array $pages
		 * @return array $pages
		 */
		public function add_menu_page( $pages ) {
			$pages[$this->id] = $this->label;

			return $pages;
		} // END add_menu_page()

		/**
		 * Get settings array
		 *
		 * @access public
		 * @since  1.0.0
		 * @return array
		 */
		public function get_settings() {
			return array();
		} // END get_settings()

		/**
		 * Get sections.
		 *
		 * @access public
		 * @since  1.6.0
		 * @return array
		 */
		public function get_sections() {
			return array();
		} // END get_sections()

		/**
		 * Output sections.
		 *
		 * @access public
		 * @since  1.6.0
		 * @global $current_section
		 */
		public function output_sections() {
			global $current_section;

			$sections = $this->get_sections();

			if ( empty( $sections ) || 1 === sizeof( $sections ) ) {
				return;
			}

			echo '<ul class="subsubsub">';

			$array_keys = array_keys( $sections );

			foreach ( $sections as $id => $label ) {
				$url = add_query_arg( array(
					'page'    => 'auto-load-next-post',
					'view'    => $this->id,
					'section' => sanitize_title( $id ),
				), admin_url( 'options-general.php' ) );

				echo '<li><a href="' . $url . '" class="' . ( $current_section == $id ? 'current' : '' ) . '">' . $label . '</a> ' . ( end( $array_keys ) == $id ? '' : '|' ) . ' </li>';
			}

			echo '</ul><br class="clear" />';
		} // END output_sections()

		/**
		 * Output the settings.
		 *
		 * @access public
		 * @since  1.0.0
		 */
		public function output() {
			$settings = $this->get_settings();

			ALNP_Admin_Settings::output_fields( $settings );
		} // END output()

		/**
		 * Save settings.
		 *
		 * @access  public
		 * @since   1.0.0
		 * @version 1.6.0
		 * @global  $current_section
		 */
		public function save() {
			global $current_section;

			$settings = $this->get_settings();

			ALNP_Admin_Settings::save_fields( $settings );

			if ( $current_section ) {
				do_action( 'auto_load_next_post_update_options_' . $this->id . '_' . $current_section );
			}
		} // END save()

		/**
		 * Displays a button above the settings header to toggle the help panel.
		 * 
		 * The help button does not show for theme selectors if the theme is already supported.
		 * 
		 * @access  public
		 * @static
		 * @since   1.5.5
		 * @version 1.6.0
		 * @global  $current_view
		 */
		public function need_help() {
			global $current_view;

			// If theme is already supported then don't show help button for theme selectors.
			if ( is_alnp_supported() && $current_view == 'theme-selectors' ) {
				return;
			}

			echo '<a href="#" class="need-help trigger-help" data-tab="' . $current_view . '"><span class="sonar-dot"></span> ' . esc_html__( 'Need Help?', 'auto-load-next-post' ) . '</a>';
		} // END need_help()

	} // END class

} // END if class exists.
