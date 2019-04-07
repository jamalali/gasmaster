<?php

	if ( ! defined( 'ABSPATH' ) ) {
		exit; // Exit if accessed directly
	}

	global $product;

	$meta_contact_for_info = get_post_meta($product->id, 'contact_for_info', true);
	
	if ( ! $meta_contact_for_info ) {
		return;
	}

	$et_office_number_display	= et_get_option('office_number');
	$et_mobile_number_display	= et_get_option('mobile_number');
	$et_email					= et_get_option('header_email');
	
	$et_office_number_call = '';
	$et_mobile_number_call = '';
	
	// Convert numbers to mobile friendly
	if ($et_office_number_display !== '') {
		$et_office_number_call = str_replace(' ', '', $et_office_number_display);
		$et_office_number_call = substr($et_office_number_call, 1);
		$et_office_number_call = '+44' . $et_office_number_call;
	}
	
	if ($et_mobile_number_display !== '') {
		$et_mobile_number_call = str_replace(' ', '', $et_mobile_number_display);
		$et_mobile_number_call = substr($et_mobile_number_call, 1);
		$et_mobile_number_call = '+44' . $et_mobile_number_call;
	}
?>

<div class="call-box">
	
	<p class="title">
		For more information:
	</p>
	
	<?php if ($et_office_number_display !== '') : ?>
	
		<div class="office-number section">
			<a href="tel:<?php echo $et_office_number_call; ?>">
				<i class="fa fa-phone"></i>
				<?php echo $et_office_number_display; ?>
			</a>
		</div>
	
	<?php endif; ?>
	
	<?php if ($et_mobile_number_display !== '') : ?>
	
		<div class="mobile-number section">
			<a href="tel:<?php echo $et_mobile_number_call; ?>">
				<i class="fa fa-mobile"></i>
				<?php echo $et_mobile_number_display; ?>
			</a>
		</div>
	
	<?php endif; ?>

	<?php if ($et_email !== '') : ?>
	
		<div class="email section">
			<a href="<?php echo esc_attr( 'mailto:' . $et_email ); ?>">
				<i class="fa fa-envelope"></i>
				<?php echo esc_html( $et_email ); ?>
			</a>
		</div>
		
	<?php endif; ?>
	
</div>