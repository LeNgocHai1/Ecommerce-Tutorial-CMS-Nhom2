<?php
/**
 * Admin Class
 *
 * Handles the admin functionality of plugin
 *
 * @package Product Slider and Carousel with Category for WooCommerce
 * @since 1.0
 */

if( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Wcpscwc_Admin {

	function __construct() {

		// Action to register plugin settings
		add_action ( 'admin_init', array( $this, 'wcpscwc_admin_processes' ) );

		// Admin for the Solutions & Features
		add_action( 'admin_init', array($this, 'wcpscwc_admin_init_sf_process') );

		// Action to add admin menu
		add_action( 'admin_menu', array($this, 'wcpscwc_register_menu'), 12 );

		// Action to add little JS code in admin footer
		//add_action( 'admin_footer', array($this, 'wcpscwc_upgrade_page_link_blank') );
	}

	/**
	 * Function register setings
	 * 
	 * @package Woo Product Slider and Carousel with Category
	 * @since 2.5
	 */
	function wcpscwc_admin_processes() {

		//global $pagenow;

		//$current_page = isset( $_REQUEST['page'] ) ? $_REQUEST['page'] : '';

		// If plugin notice is dismissed
		if( isset($_GET['message']) && $_GET['message'] == 'wcpscwc-plugin-notice' ) {
			set_transient( 'wcpscwc_install_notice', true, 604800 );
		}

		// Redirect to external page for upgrade to menu
		// if( $pagenow == 'admin.php' ) {

		// 	if( $current_page == 'wcpscwc-upgrade-pro' ) {

		// 		wp_redirect( WCPSCWC_PLUGIN_LINK_UPGRADE );
		// 		exit;
		// 	}

		// 	if( $current_page == 'wcpscwc-bundle-deal' ) {

		// 		wp_redirect( WCPSCWC_PLUGIN_BUNDLE_LINK );
		// 		exit;
		// 	}
		// }
	}

	/**
	 * Function register setings
	 * 
	 * @package Woo Product Slider and Carousel with Category
	 * @since 2.5
	 */
	function wcpscwc_admin_init_sf_process() {

		if ( get_option( 'wcpscwc_sf_optin', false ) ) {

			delete_option( 'wcpscwc_sf_optin' );

			$redirect_link = add_query_arg( array('page' => 'wcpscwc-solutions-features' ), admin_url( 'admin.php' ) );

			wp_safe_redirect( $redirect_link );

			exit;
		}
	}

	/**
	 * Function to add menu
	 * 
	 * @package Product Slider and Carousel with Category for WooCommerce
	 * @since 1.0.0
	 */
	function wcpscwc_register_menu() {

		// Getting Started page
		add_menu_page( __('Woo - Product Slider', 'woo-product-slider-and-carousel-with-category'), __('Woo - Product Slider', 'woo-product-slider-and-carousel-with-category'), 'manage_options', 'wcpscwc-about', array($this, 'wcpscwc_designs_page'), 'dashicons-slides', 56 );

		// Setting page
		add_submenu_page( 'wcpscwc-about', __('Solutions & Features - Woo - Product Slider/Carousel', 'woo-product-slider-and-carousel-with-category'), '<span style="color:#2ECC71">'. __('Solutions & Features', 'woo-product-slider-and-carousel-with-category').'</span>', 'manage_options', 'wcpscwc-solutions-features', array($this, 'wcpscwc_solutions_features_page') );

		// Register plugin premium page
		add_submenu_page( 'wcpscwc-about', __('Upgrade To PRO - Woo Product Slider', 'woo-product-slider-and-carousel-with-category'), '<span style="color:#ff2700">'.__('Upgrade To PRO', 'woo-product-slider-and-carousel-with-category').'</span>', 'edit_posts', 'wcpscwc-premium', array($this, 'wcpscwc_premium_page') );
		//add_submenu_page( 'wcpscwc-about', __('Upgrade To PRO - Woo - Product Slider/Carousel', 'woo-product-slider-and-carousel-with-category'), '<span class="wpos-upgrade-pro" style="color:#ff2700">' . __('Upgrade To Premium ', 'woo-product-slider-and-carousel-with-category') . '</span>', 'manage_options', 'wcpscwc-upgrade-pro', array($this, 'wcpscwc_redirect_page') );
		//add_submenu_page( 'wcpscwc-about', __('Bundle Deal - Woo - Product Slider/Carousel', 'woo-product-slider-and-carousel-with-category'), '<span class="wpos-upgrade-pro" style="color:#ff2700">' . __('Bundle Deal', 'woo-product-slider-and-carousel-with-category') . '</span>', 'manage_options', 'wcpscwc-bundle-deal', array($this, 'wcpscwc_redirect_page') );
	}

	/**
	 * How it work Page Html
	 * 
	 * @package Product Slider and Carousel with Category for WooCommerce
	 * @since 1.0.0
	 */
	function wcpscwc_designs_page() {
		include_once( WCPSCWC_DIR . '/includes/admin/wcpscwc-how-it-work.php' );
	}

	/**
	 * solutions and features Page Html
	 * 
	 * @package Product Slider and Carousel with Category for WooCommerce
	 * @since 1.0.0
	 */
	function wcpscwc_solutions_features_page() {
		include_once( WCPSCWC_DIR . '/includes/admin/settings/solutions-features.php' );
	}

	/**
	 * Premium Page Html
	 * 
	 * @package Product Slider and Carousel with Category for WooCommerce
	 * @since 1.0.0
	 */
	function wcpscwc_premium_page() {
		include_once( WCPSCWC_DIR . '/includes/admin/settings/premium.php' );
	}

	/**
	 * How It Work Page Html
	 * 
	 * @since 1.0
	 */
	// function wcpscwc_redirect_page() {
	// }

	/**
	 * Add JS snippet to admin footer to add target _blank in upgrade link
	 * 
	 * @package Product Slider and Carousel with Category for WooCommerce
	 * @since 1.0.0
	 */
	/*function wcpscwc_upgrade_page_link_blank() {

		global $wpos_upgrade_link_snippet;

		// Redirect to external page
		if( empty( $wpos_upgrade_link_snippet ) ) {

			$wpos_upgrade_link_snippet = 1;
	?>
		<script type="text/javascript">
			(function ($) {
				$('.wpos-upgrade-pro').parent().attr( { target: '_blank', rel: 'noopener noreferrer' } );
			})(jQuery);
		</script>
	<?php }
	} */
}

$wcpscwc_Admin = new Wcpscwc_Admin();