<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $woocommerce;
global $product;

if ( ! $product->is_purchasable() ) {
	return;
} ?>
	
<div class="wc-proceed-to-checkout">
	<a class="checkout-button button alt wc-forward" href="<?php echo $woocommerce->cart->get_checkout_url(); ?>" title="Proceed to Checkout">
		Proceed to Checkout
	</a>
</div>