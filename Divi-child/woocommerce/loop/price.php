<?php
/**
 * Loop Price
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

$price_from	= (boolean) get_post_meta($product->id, 'price_from', true);

$price_html = $product->get_price_html();
?>

<?php if ($price_html) { ?>
	<span class="price">
		<?php if ($price_from) { ?>
			<span class="from">From</span>
		<?php } ?>
		<?php echo $price_html; ?>
	</span>
<?php }
