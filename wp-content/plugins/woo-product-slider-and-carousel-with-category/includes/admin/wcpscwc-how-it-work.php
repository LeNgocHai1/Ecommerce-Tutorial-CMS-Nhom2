<?php
/**
 * Pro Designs and Plugins Feed
 *
 * @package Product Slider and Carousel with Category for WooCommerce
 * @since 1.0.0
 */

if( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<div class="wrap wcpscwc-wrap">
	<style type="text/css">
		.wpos-box{box-shadow: 0 5px 30px 0 rgba(214,215,216,.57);background: #fff; padding-bottom:10px; position:relative;}
		.wpos-box ul{padding: 15px;}
		.wpos-box h5{background:#555; color:#fff; padding:15px; text-align:center;}
		.wpos-box h4{ padding:0 15px; margin:5px 0; font-size:18px;}
		.wpos-box .button{margin:0px 15px 15px 15px; text-align:center; padding:7px 15px; font-size:15px;display:inline-block;}
		.wpos-box .wpos-list{list-style:square; margin:10px 0 0 20px;}
		.wpos-clearfix:before, .wpos-clearfix:after{content: "";display: table;}
		.wpos-clearfix::after{clear: both;}
		.wpos-clearfix{clear: both;}
		.wpos-col{width: 47%; float: left; margin-right:10px; margin-bottom:10px;}
		.wpos-pro-box .hndle{background-color:#0073AA; color:#fff;}
		.wpos-pro-box.postbox{background:#dbf0fa none repeat scroll 0 0; border:1px solid #0073aa; color:#191e23;}
		.postbox-container .wpos-list li:before{font-family: dashicons; content: "\f139"; font-size:20px; color: #0073aa; vertical-align: middle;}
		.wcpscwc-wrap .wpos-button-full{display:block; text-align:center; box-shadow:none; border-radius:0;}
		.wcpscwc-shortcode-preview{background-color: #e7e7e7; font-weight: bold; padding: 2px 5px; display: inline-block; margin:0 0 2px 0;}
		.upgrade-to-pro{font-size:18px; text-align:center; margin-bottom:15px;}
		.wpos-copy-clipboard{-webkit-touch-callout: all; -webkit-user-select: all; -khtml-user-select: all; -moz-user-select: all; -ms-user-select: all; user-select: all;}
		.wpos-new-feature{ font-size: 10px; color: #fff; font-weight: bold; background-color: #03aa29; padding:1px 4px; font-style: normal; }
		.button-orange{background: #ff5d52 !important;border-color: #ff5d52 !important; font-weight: 600;}
		.button-blue{background: #0055fb !important;border-color: #0055fb !important; font-weight: 600;}
	</style>
	<h2><?php _e( 'How It Works', 'woo-product-slider-and-carousel-with-category' ); ?></h2>
	<div id="poststuff">
		<div id="post-body" class="metabox-holder columns-2"> 
			<div id="post-body-content">
				<div class="meta-box-sortables">
					<div class="postbox">
						<div class="postbox-header">
							<h2 class="hndle">
								<span><?php _e( 'How It Works - Display and Shortcode', 'woo-product-slider-and-carousel-with-category' ); ?></span>
							</h2>
						</div>
						<div class="inside">
							<table class="form-table">
								<tbody>
									<tr>
										<th>
											<label><?php _e('Getting Started', 'woo-product-slider-and-carousel-with-category'); ?>:</label>
										</th>
										<td>
											<ul>
												<li><?php _e('Step-1. This plugin is use to slide Products with 3 option' , 'woo-product-slider-and-carousel-with-category'); ?></li>
												<li><?php _e('Step-2. A) Product Slider, B) Best Selling Product in slider, C) Featured Product in slider', 'woo-product-slider-and-carousel-with-category'); ?></li>
												<li><?php _e('Step-3. A) Product Slider : Display all latest products ', 'woo-product-slider-and-carousel-with-category'); ?></li>
												<li><?php _e('Step-4. B) Best Selling Product in slider : Display all best selling products', 'woo-product-slider-and-carousel-with-category'); ?></li>
												<li><?php _e('Step-5. C) Featured Product in slider : Display all Featured selling products. To select a product as a featured click on STAR button on product list.', 'woo-product-slider-and-carousel-with-category'); ?></li>
												<li><?php _e('Step-6. You can also use <b>Category ID with all 3 shortcode</b> to filter the products category wise.', 'woo-product-slider-and-carousel-with-category'); ?></li>
											</ul>
										</td>
									</tr>

									<tr>
										<th>
											<label><?php _e('How Shortcode Works', 'woo-product-slider-and-carousel-with-category'); ?>:</label>
										</th>
										<td>
											<ul>
												<li><?php _e('Step-1. Create a page like Product Slider OR Best Selling Products.', 'woo-product-slider-and-carousel-with-category'); ?></li>
												<li><?php _e('Step-2. Put below shortcode as per your need.', 'woo-product-slider-and-carousel-with-category'); ?></li>
											</ul>
										</td>
									</tr>

									<tr>
										<th>
											<label><?php _e('All Shortcodes', 'woo-product-slider-and-carousel-with-category'); ?>:</label>
										</th>
										<td>
											<span class="wpos-copy-clipboard wcpscwc-shortcode-preview">[wcpscwc_pdt_slider type="products"]</span> – <?php _e('Product in slider Shortcode', 'woo-product-slider-and-carousel-with-category'); ?> <br />
											<span class="wpos-copy-clipboard wcpscwc-shortcode-preview">[wcpscwc_pdt_slider type="bestselling"]</span> – <?php _e('Best Selling Product in slider Shortcode', 'woo-product-slider-and-carousel-with-category'); ?> <br />
											<span class="wpos-copy-clipboard wcpscwc-shortcode-preview">[wcpscwc_pdt_slider type="featured"]</span> – <?php _e('Featured Product in slider Shortcode', 'woo-product-slider-and-carousel-with-category'); ?>
										</td>
									</tr>
									
									<tr>
										<th>
											<label><?php _e('Documentation', 'woo-product-slider-and-carousel-with-category'); ?>:</label>
										</th>
										<td>
											<a class="button button-primary" href="https://docs.essentialplugin.com/woo-product-slider-and-carousel-with-category/" target="_blank"><?php _e('Check Documentation', 'woo-product-slider-and-carousel-with-category'); ?></a>
										</td>
									</tr>
									
									<tr>
										<th>
											<label><?php _e('Demo', 'woo-product-slider-and-carousel-with-category'); ?>:</label>
										</th>
										<td>
											<a class="button button-primary" href="https://demo.essentialplugin.com/product-slider-and-carousel-demo/" target="_blank"><?php _e('Check Free Demo', 'woo-product-slider-and-carousel-with-category'); ?></a>
										</td>
									</tr>

								</tbody>
							</table>
						</div>
					</div>

					

					<div class="postbox">
						<div class="postbox-header">
							<h2 class="hndle">
								<span><?php _e( 'Help to improve this plugin!', 'woo-product-slider-and-carousel-with-category' ); ?></span>
							</h2>
						</div>
						<div class="inside">
							<p>Enjoyed this plugin? You can help by rate this plugin <a href="https://wordpress.org/support/plugin/woo-product-slider-and-carousel-with-category/reviews/" target="_blank">5 stars!</a></p>
						</div>
					</div>
				</div>
			</div>

			<div id="postbox-container-1" class="postbox-container">
				<div class="meta-box-sortables">
					<div class="postbox wpos-pro-box">
						<h3 class="hndle">
							<span><?php _e( 'Product Slider Premium Features', 'woo-product-slider-and-carousel-with-category' ); ?></span>
						</h3>
						<div class="inside">
							<ul class="wpos-list">
								<li>15+ cool designs</li>
								<li>2 Product Shortcodes(Grid and Slider)</li>
								<li>2 Product Widgets(Grid and Slider)</li>
								<li>Displaying Latest/Recent Products Slider/grid</li>
								<li>Featured products slider/grid</li>
								<li>Best Selling Product slider/grid</li>
								<li>Rating Product slider/grid</li>
								<li>Regular Price Product slider/grid</li>
								<li>Sale Price Product slider/grid</li>
								<li>Sort by category </li>
								<li>Gutenberg Block Supports.</li>
								<li>WPBakery Page Builder Supports</li>
								<li>Elementor, Beaver and SiteOrigin Page Builder Support. <span class="wpos-new-feature">New</span></li>
								<li>Divi Page Builder Native Support. <span class="wpos-new-feature">New</span></li>
								<li>Fusion Page Builder (Avada) native support. <span class="wpos-new-feature">New</span></li>
								<li>WP Templating Features</li>
								<li>100% Mobile & Tablet Responsive</li>
								<li>Awesome Touch-Swipe Enabled</li>
								<li>Added a custom design</li>
								<li>Translation Ready</li>
								<li>Work in any WordPress Theme</li>
								<li>Created with Slick Slider</li>
								<li>Lightweight, Fast & Powerful</li>
								<li>Set Number of Columns you want to show</li>
								<li>Slider AutoPlay on/off</li>
								<li>Navigation show/hide options</li>
								<li>Pagination show/hide options</li>
								<li>Unlimited slider anywhere</li>
								<li>Custom CSS</li>
								<li>Fully responsive</li>
								<li>100% Multi language</li>
							</ul>
							<div class="upgrade-to-pro">Gain access to <strong>Product Slider and Carousel with Category for WooCommerce</strong></div>
							<a class="button button-primary wpos-button-full button-orange" href="<?php echo WCPSCWC_PLUGIN_LINK_UPGRADE; ?>" target="_blank"><?php _e('Grab Product Slider/Carousel Now', 'woo-product-slider-and-carousel-with-category'); ?></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>