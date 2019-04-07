<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

$meta_bundle_product = get_post_meta($product->id, 'bundle_product', true);

if ( ! $product->is_purchasable() || ! $meta_bundle_product ) {
	return;
}
		
$bundle_products = explode(',', $meta_bundle_product);

foreach ($bundle_products as $bundle_product_id) {

	$bundle_product = wc_get_product($bundle_product_id);

	if ( $bundle_product->is_in_stock() ) { ?>

		<div style="display:none;" class="bundle_product" id="product-<?php echo $bundle_product->id; ?>" itemprop="isRelatedTo" itemscope itemtype="http://schema.org/Product">

			<h3 itemprop="name" class="product_title entry-title">
				<?php echo $bundle_product->post->post_title; ?>
			</h3>

			<div itemtype="http://schema.org/Offer" itemscope="" itemprop="offers">

				<p class="price">
					<?php echo $bundle_product->get_price_html(); ?>
				</p>

				<meta itemprop="price" content="<?php echo $bundle_product->get_price(); ?>" />
				<meta itemprop="priceCurrency" content="<?php echo get_woocommerce_currency(); ?>" />
				<link itemprop="availability" href="http://schema.org/<?php echo $bundle_product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>" />

			</div>

			<div itemprop="description">
				<?php echo apply_filters( 'woocommerce_short_description', $bundle_product->post->post_excerpt ) ?>
			</div>

			<form class="cart" method="post" enctype='multipart/form-data'>
				<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

				<?php
					if ( ! $bundle_product->is_sold_individually() )
						woocommerce_quantity_input( array(
							'min_value' => apply_filters( 'woocommerce_quantity_input_min', 1, $bundle_product ),
							'max_value' => apply_filters( 'woocommerce_quantity_input_max', $bundle_product->backorders_allowed() ? '' : $bundle_product->get_stock_quantity(), $bundle_product )
						) );
				?>

				<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $bundle_product->id ); ?>" />

				<button type="submit" class="single_add_to_cart_button button alt"><?php echo $bundle_product->single_add_to_cart_text(); ?></button>

				<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
			</form>

			<meta itemprop="url" content="<?php echo get_permalink($bundle_product->id); ?>" />

		</div>
	<?php }
} ?>

<h4>
	This product is also part of a bundle
</h4>

<select id="bundle-selector" class="bundle-selector">
	<option value=""><?php the_title(); ?> (Single)</option>
	  
	<?php foreach ($bundle_products as $bundle_product_id) {

		$bundle_product = wc_get_product($bundle_product_id);

		if ( $bundle_product->is_in_stock() ) { ?>
	
			<option value="<?php echo $bundle_product->id; ?>"><?php echo $bundle_product->post->post_title; ?> (Bundle)</option>
	
		<?php }
	} ?>
</select>