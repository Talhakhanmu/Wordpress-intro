<?php 

/**
 * consted Theme Customizer.
 *
 * @package consted
 */

//customizer core option

load_template( get_template_directory() . '/inc/customizer/core/customizer-core.php', true ) ;

//customizer 

load_template( get_template_directory() . '/inc/customizer/core/default.php', true ) ;
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function consted_customize_register( $wp_customize ) {

	// Load custom controls.

	load_template( get_template_directory() . '/inc/customizer/core/control.php', true ) ;
	// Load customize sanitize.
	load_template( get_template_directory() . '/inc/customizer/core/sanitize.php', true ) ;

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	
	/*theme option panel details*/
	load_template( get_template_directory() . '/inc/customizer/theme-option.php', false ) ;
	
	// Register custom section types.
	$wp_customize->register_section_type( 'consted_Customize_Section_Upsell' );

	// Register sections.
	$wp_customize->add_section(
		new consted_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell',
			array(
				'title'    => esc_html__( 'Upgrade to Consted Pro!', 'consted' ),
				'pro_text' => esc_html__( 'Go PRO', 'consted' ),
				'pro_url'  => 'https://athemeart.com/downloads/consted/',
				'priority'  => 1,
			)
		)
	);
	
	
}
add_action( 'customize_register', 'consted_customize_register' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since 1.0.0
 */

function consted_customizer_css() {
	
	wp_enqueue_script( 'consted-customize-controls', get_template_directory_uri() . '/inc/customizer/assets/js/customizer-admin.js', array( 'customize-controls' ) );
	wp_enqueue_style( 'consted-customize-controls', get_template_directory_uri() . '/inc/customizer/assets/css/customizer-controll.css' );
	
}
add_action( 'customize_controls_enqueue_scripts', 'consted_customizer_css',0 );


