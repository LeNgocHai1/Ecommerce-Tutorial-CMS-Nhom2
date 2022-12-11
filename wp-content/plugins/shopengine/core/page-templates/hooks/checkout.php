<?php

namespace ShopEngine\Core\Page_Templates\Hooks;

use ShopEngine;
use ShopEngine\Core\Register\Module_List;
use ShopEngine\Widgets\Widget_Helper;

defined('ABSPATH') || exit;

class Checkout extends Base {

	protected $page_type = 'checkout';
	protected $template_part = 'content-checkout.php';

	public function init(): void {

		add_action( 'shopengine-order-review-thumbnail', [ $this, 'add_product_thumbnail' ], 10, 4 );

		add_filter('wc_get_template', function ( $template ) {
			if ( strpos( $template, 'checkout/review-order.php' ) !== false ) {
				return ShopEngine::widget_dir() . 'checkout-review-order/screens/review-order-template.php';
			}
			return $template;
		});

		if (class_exists('ShopEngine_Pro\Modules\Multistep_Checkout\Multistep_Checkout')) {

			$module_list = Module_List::instance();

			if ($module_list->get_list()['multistep-checkout']['status'] === 'active') {
				\ShopEngine_Pro\Modules\Multistep_Checkout\Multistep_Checkout::instance()->load();
			}
		}

		Widget_Helper::instance()->wc_template_replace_multiple(
			[
				'checkout/review-order.php',
				'checkout/payment-method.php',
			]
		);

		remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10);

		remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form');


        /**
         * Remove checkout template extra markup;
         */
        remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10);

		do_action( 'woocommerce_check_cart_items' );
	} 
	
	protected function get_page_type_option_slug(): string {

		return !empty($_REQUEST['shopengine_quick_checkout']) && $_REQUEST['shopengine_quick_checkout'] === 'modal-content' ? 'quick_checkout' : $this->page_type;
	}

	protected function template_include_pre_condition(): bool {

		return (is_checkout() && !is_wc_endpoint_url('order-received')) || (isset($_REQUEST['wc-ajax']) &&  $_REQUEST['wc-ajax'] == 'update_order_review');
	}

	public function add_product_thumbnail( $cart_item ) {

		if(!empty($cart_item['product_id'])) {
			$product    = wc_get_product( intval($cart_item['product_id']) );
			$product_id = !empty( $cart_item['variation_id'] ) ? intval($cart_item['variation_id']) : $product->get_id();
			$attachment = wp_get_attachment_image( get_post_thumbnail_id( $product_id ), 'single-post-thumbnail' );

			if(empty($attachment)) {
				$attachment = wp_get_attachment_image( $product->get_image_id(), 'full' );
			} 
			echo $attachment;
		}
	}
}
