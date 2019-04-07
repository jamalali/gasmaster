<?php
function enqueue_theme_stuff() {
   wp_enqueue_style('parent-style', get_stylesheet_directory_uri() .'/parent-style.css');
   wp_enqueue_script('script', get_stylesheet_directory_uri() .'/script.js');
   wp_enqueue_script('social-sharing', get_stylesheet_directory_uri() .'/social-sharing.js');
}
add_action('wp_enqueue_scripts', 'enqueue_theme_stuff');


// Enqueue external font awesome stylesheet
function enqueue_our_required_stylesheets() {
	wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css'); 
}
add_action('wp_enqueue_scripts', 'enqueue_our_required_stylesheets');


// Services List
function gm_list_services() {
	$parent_page_id = 1903;
	
	$services = get_pages(array(
		'parent' => $parent_page_id
	));
	
	$output = '';
	
	$output .= '<div class="et_pb_section et_section_regular gasmaster_services_list">';
	
		$num_services	= count($services);
		$i				= 0;
		$col_count		= 0;
		
		foreach ($services as $service) {
			
			$thumb_id			= get_post_thumbnail_id($service->ID);
			$thumb_url_array	= wp_get_attachment_image_src($thumb_id, 'full');
			$thumb_url			= $thumb_url_array[0];
			
			$i++;
			$col_count++;
			
			if ($i == 1) { $output .= '<div class="et_pb_row">'; }
			
				$output .= '<div class="et_pb_column et_pb_column_1_4">';
				
					$output .= '<div class="service">';
			
						$output .= '<div class="et_pb_blurb et_pb_bg_layout_light et_pb_text_align_center et_pb_blurb_position_top">';
							$output .= '<div class="et_pb_blurb_content">';
							
								$output .= '<div class="et_pb_main_blurb_image">';
									$output .= '<a href="/services/'. $service->post_name .'">';
										$output .= '<img class="et-waypoint et_pb_animation_top et-animated" alt="'. $service->post_title .'" src="'. $thumb_url .'">';
									$output .= '</a>';
								$output .= '</div>';
							
								$output .= '<div class="inner">';
									$output .= '<h4>'. $service->post_title .'</h4>';
									$output .= '<p>'. $service->post_excerpt .'</p>';
								$output .= '</div>';
								
								// Call to action
								$output .= '<div class="et_pb_promo et_pb_bg_layout_light et_pb_text_align_center et_pb_no_bg">';
									$output .= '<a href="/services/'. $service->post_name .'" class="et_pb_promo_button">';
										$output .= 'More info';
									$output .= '</a>';
								$output .= '</div>';
								
							$output .= '</div>';
						$output .= '</div>';
						
					$output .= '</div>';
					
				$output .= '</div>';
			
				//$output .= '<script>console.log('.json_encode($thumb_url_array).');</script>';
				
			if ($col_count == 4 && $i < $num_services) { $output .= '</div><div class="et_pb_row">'; $col_count = 0;}
				
			if ($i == $num_services) { $output .= '</div>'; }
		}
	
	$output .= '</div>';
	
	return $output;
}
add_shortcode('gasmaster_services', 'gm_list_services');

// Remove parent theme functions
function child_remove_parent_function() {
	
	// This stops Divi parent theme adding css in the <head>
    remove_action('wp_head', 'et_divi_add_customizer_css');
	remove_action('customize_controls_print_styles', 'et_divi_add_customizer_css');
}
add_action('wp_loaded', 'child_remove_parent_function');


// Callback function to insert 'styleselect' into the $buttons array
function my_mce_buttons_2($buttons) {
	array_unshift($buttons, 'styleselect');
	return $buttons;
}
add_filter('mce_buttons_2', 'my_mce_buttons_2');

// Callback function to filter the MCE settings
function my_mce_before_init_insert_formats($init_array) {
	// Define the style_formats array
	$style_formats = array(  
		// Each array child is a format with it's own settings
		array(  
			'title'		=> 'Tick List',  
			'classes'	=> 'tick-list fa-ul',
			'selector'	=> 'ul'
		)
	);  
	// Insert the array, JSON ENCODED, into 'style_formats'
	$init_array['style_formats'] = json_encode($style_formats);  
	
	return $init_array;  
}
// Attach callback to 'tiny_mce_before_init' 
add_filter('tiny_mce_before_init', 'my_mce_before_init_insert_formats');

function gm_template_single_checkout_btn() {
	wc_get_template('checkout-button.php');
}
add_action('woocommerce_single_product_summary', 'gm_template_single_checkout_btn', 46);

function gm_template_single_bundles() {
	wc_get_template('single-product/bundles.php');
}
add_action( 'woocommerce_single_product_summary', 'gm_template_single_bundles', 45 );

function gm_template_call_box() {
	wc_get_template('call-box.php');
}
add_action( 'woocommerce_single_product_summary', 'gm_template_call_box', 47 );

function sharethis_for_woocommerce() {
	wc_get_template('sharethis.php');
}
add_action('woocommerce_single_product_summary', 'sharethis_for_woocommerce', 11);

// Custom Theme Settings
function gm_customize_register($wp_customize) {
	
	$wp_customize->add_setting( 'et_divi[office_number]', array(
		'type'			=> 'option',
		'capability'	=> 'edit_theme_options',
		'transport'		=> 'postMessage',
	) );

	$wp_customize->add_control( 'et_divi[office_number]', array(
		'label'		=> __( 'Office Number', 'Divi' ),
		'section'	=> 'et_divi_settings',
		'type'      => 'text',
		'priority'  => 61,
	) );
	
	// Mobile Number
	$wp_customize->add_setting( 'et_divi[mobile_number]', array(
		'type'			=> 'option',
		'capability'	=> 'edit_theme_options',
		'transport'		=> 'postMessage',
	) );

	$wp_customize->add_control( 'et_divi[mobile_number]', array(
		'label'		=> __( 'Mobile Number', 'Divi' ),
		'section'	=> 'et_divi_settings',
		'type'      => 'text',
		'priority'  => 62,
	) );
	
}
add_action('customize_register', 'gm_customize_register');

if (!defined('SHARETHIS_PUBLISHER_ID')) {
	define('SHARETHIS_PUBLISHER_ID', '39a78604-5a1b-4c4a-b734-4ad2d2b1d92a');
}