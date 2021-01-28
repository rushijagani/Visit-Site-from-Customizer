<?php
/**
 * Plugin Name: Visit Site from Customizer
 * Plugin URI: https://rushijagani.wordpress.com/
 * Description: Visit Site from Customizer plugin adds the link to Visit Site into the custmoizer.
 * Version: 1.0.0
 * Author: Rushi Jagani
 * Author URI: https://rushijagani.wordpress.com/
 * Text Domain: visit-site-customizer
 *
 * @package Visit_Site_from_Customizer
 */

define( 'VISIT_SITE_FROM_CUSTOMIZER_URI', plugins_url( '/', __FILE__ ) );

/**
 * Visit Site from Customizer
 *
 * @since 1.0.0
 */
if ( ! class_exists( 'Visit_Site_From_Customizer' ) ) :

	/**
	 * Visit Site from Customizer
	 */
	class Visit_Site_From_Customizer {

		/**
		 * Member Variable
		 *
		 * @since 1.0.0
		 * @var $instance
		 */
		private static $instance;

		/**
		 * WordPress Customizer Object
		 *
		 * @since 1.0.0
		 * @var $wp_customize
		 */
		private $wp_customize;

		/**
		 * Initiator
		 *
		 * @since 1.0.0
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			add_action( 'customize_controls_enqueue_scripts',   array( $this, 'controls_scripts' ) );
			add_action( 'customize_register',                   array( $this, 'customize_register' ) );

		}

		/**
		 * Customize Register Description
		 *
		 * @param  object $wp_customize Object of WordPress customizer.
		 * @return void
		 * @since 1.0.0
		 */
		public function customize_register( $wp_customize ) {
			$this->wp_customize = $wp_customize;
		}

		/**
		 * Customizer Scripts
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function controls_scripts() {

			// Enqueue JS.
			wp_enqueue_script( 'visit-site-from-customizer', VISIT_SITE_FROM_CUSTOMIZER_URI . 'assets/js/customizer-visit-site.js', array( 'jquery' ), null, true );

			$url = get_site_url();
			if( isset( $_GET['url'] ) && ! empty( $_GET['url'] ) ) {
				$url = urldecode($_GET['url']);
			}
			// Add localize JS.
			wp_localize_script( 'visit-site-from-customizer', 'visitSiteCustomizer', apply_filters( 'Visit_Site_From_Customizer_js_localize', array(
				'customizer' => array(
					'visitSite'   => __( 'Visit Site', 'visit-site-customizer' ),
					'siteUrl' => $url,
				),
			) ) );
		}
	}

endif; // End if().

/**
 * Kicking this off by calling 'get_instance()' method
 */
Visit_Site_From_Customizer::get_instance();
