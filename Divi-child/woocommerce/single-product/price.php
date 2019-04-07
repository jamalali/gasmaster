<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( ! $product->is_purchasable() ) {
	return;
}

$price_note		= get_post_meta($product->id, 'price_note', true);
$price_from		= (boolean) get_post_meta($product->id, 'price_from', true);

?>
<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">

	<p class="price">
		
		<?php if ($price_from) { ?>
			<span class="from">
				From
			</span>
		<?php } ?>
		
		<?php echo $product->get_price_html(); ?>
		
		<?php if ($price_note) { ?>
			<span class="note">
				<?php echo $price_note; ?>
			</span>
		<?php } ?>
	</p>

	<meta itemprop="price" content="<?php echo $product->get_price(); ?>" />
	<meta itemprop="priceCurrency" content="<?php echo get_woocommerce_currency(); ?>" />
	<link itemprop="availability" href="http://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>" />
	
</div>