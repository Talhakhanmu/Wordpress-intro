<?php 

/**
 * Theme Options Panel.
 *
 * @package consted
 */

$default = consted_get_default_theme_options();
global $wp_customize;



// Add Theme Options Panel.
$wp_customize->add_panel( 'theme_option_panel',
	array(
		'title'      => esc_html__( 'Theme Options', 'consted' ),
		'priority'   => 2,
		'capability' => 'edit_theme_options',
	)
);


$wp_customize->add_section( 'topbar_section_settings',
	array(
		'title'      => esc_html__( 'Top Bar', 'consted' ),
		'priority'   => 10,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

/*Social Profile*/
$wp_customize->add_setting( '__topbar_phone',
	array(
		'default'           => $default['__topbar_phone'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( '__topbar_phone',
	array(
		'label'    => esc_html__( 'Phone:', 'consted' ),
		'section'  => 'topbar_section_settings',
		'type'     => 'text',
		
	)
);

$wp_customize->add_setting( '__topbar_email',
	array(
		'default'           => $default['__topbar_email'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( '__topbar_email',
	array(
		'label'    => esc_html__( 'Email:', 'consted' ),
		'section'  => 'topbar_section_settings',
		'type'     => 'text',
		
	)
);

$wp_customize->add_setting( '__topbar_address',
	array(
		'default'           => $default['__topbar_address'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( '__topbar_address',
	array(
		'label'    => esc_html__( 'Address:', 'consted' ),
		'section'  => 'topbar_section_settings',
		'type'     => 'text',
		
	)
);


/*Posts management section start */
$wp_customize->add_section( 'page_option_section_settings',
	array(
		'title'      => esc_html__( 'Page Management', 'consted' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

	
		/*Home Page Layout*/
		$wp_customize->add_setting( 'page_layout',
			array(
				'default'           => $default['blog_layout'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'fastest_shop_sanitize_select',
			)
		);
		$wp_customize->add_control( 'page_layout',
			array(
				'label'    => esc_html__( 'Page Layout Options', 'consted' ),
				'section'  => 'page_option_section_settings',
				'description' => esc_html__( 'Choose between different layout options to be used as default', 'fastest-shop' ),
				'choices'   => array(
					'left-sidebar'  => esc_html__( 'Primary Sidebar / Content', 'consted' ),
					'right-sidebar' => esc_html__( 'Content / Primary Sidebar', 'consted' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'consted' ),
					'full-container'    => esc_html__( 'Full Container', 'consted' ),
					),
				'type'     => 'select',
				'priority' => 170,
			)
		);


/*Posts management section start */
$wp_customize->add_section( 'theme_option_section_settings',
	array(
		'title'      => esc_html__( 'Blog Management', 'consted' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

		/*Posts Layout*/
		
		$wp_customize->add_setting( 'blog_layout',
			array(
				'default'           => $default['blog_layout'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'consted_sanitize_select',
			)
		);
		$wp_customize->add_control( 'blog_layout',
			array(
				'label'    => esc_html__( 'Blog Archive Layouts', 'fastest-shop' ),
				'description' => esc_html__( 'Choose between different layout options to be used as default', 'consted' ),
				'section'  => 'theme_option_section_settings',
				'choices'   => array(
					'left-sidebar'  => esc_html__( 'Primary Sidebar / Content', 'consted' ),
					'right-sidebar' => esc_html__( 'Content / Primary Sidebar', 'consted' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'consted' ),
					'full-container'    => esc_html__( 'Full Container', 'consted' ),
					
					),
				'type'     => 'select',
				
			)
		);

		$wp_customize->add_setting( 'single_post_layout',
			array(
				'default'           => $default['single_post_layout'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'consted_sanitize_select',
			)
		);
		$wp_customize->add_control( 'single_post_layout',
			array(
				'label'    => esc_html__( 'Single Post Layouts', 'consted' ),
				'description' => esc_html__( 'Choose between different layout options to be used as default', 'consted' ),
				'section'  => 'theme_option_section_settings',
				'choices'   => array(
					'left-sidebar'  => esc_html__( 'Primary Sidebar / Content', 'consted' ),
					'right-sidebar' => esc_html__( 'Content / Primary Sidebar', 'consted' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'consted' ),
					'full-container'    => esc_html__( 'Full Container', 'consted' ),
					),
				'type'     => 'select',
				
			)
		);
		
		
		/*Blog Loop Content*/
		$wp_customize->add_setting( 'blog_loop_content_type',
			array(
				'default'           => $default['blog_loop_content_type'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'consted_sanitize_select',
			)
		);
		$wp_customize->add_control( 'blog_loop_content_type',
			array(
				'label'    => esc_html__( 'Archive Content Type', 'consted' ),
				'description' => esc_html__( 'Choose Archive, Blog Page Content type as default', 'consted' ),
				'section'  => 'theme_option_section_settings',
				'choices'               => array(
					'excerpt' => __( 'Excerpt', 'consted' ),
					'content' => __( 'Content', 'consted' ),
					),
				'type'     => 'select',
				
			)
		);
		
		/*Social Profile*/
		$wp_customize->add_setting( 'excerpt_length',
			array(
				'default'           => $default['excerpt_length'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'consted_sanitize_positive_integer',
			)
		);
		$wp_customize->add_control( 'excerpt_length',
			array(
				'label'    => esc_html__( 'Excerpt length', 'consted' ),
				'section'  => 'theme_option_section_settings',
				'type'     => 'number',
				'input_attrs'     => array( 'min' => 1, 'max' => 200, 'style' => 'width: 150px;' ),
				
			)
		);
		
		
		
		
		
		$wp_customize->add_setting( 'blog_meta_hide',
			array(
				'default'           => $default['blog_meta_hide'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'consted_sanitize_checkbox',
			)
		);
		$wp_customize->add_control( 'blog_meta_hide',
			array(
				'label'    => esc_html__( 'Hide Blog Archive Meta Info ?', 'consted' ),
				'section'  => 'theme_option_section_settings',
				'type'     => 'checkbox',
				
			)
		);
		
		$wp_customize->add_setting( 'signle_meta_hide',
			array(
				'default'           => $default['signle_meta_hide'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'consted_sanitize_checkbox',
			)
		);
		$wp_customize->add_control( 'signle_meta_hide',
			array(
				'label'    => esc_html__( 'Hide Single post Meta Info ?', 'consted' ),
				'section'  => 'theme_option_section_settings',
				'type'     => 'checkbox',
				
			)
		);
		
		// Footer Section.
		$wp_customize->add_section( 'footer_section',
			array(
			'title'      => esc_html__( 'Copyright Text', 'consted' ),
			'priority'   => 130,
			'capability' => 'edit_theme_options',
			'panel'      => 'theme_option_panel',
			)
		);
		
		// Setting copyright_text.
		$wp_customize->add_setting( 'copyright_text',
			array(
			'default'           => $default['copyright_text'],
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control( 'copyright_text',
			array(
			'label'    => esc_html__( 'Footer Copyright Text', 'consted' ),
			'section'  => 'footer_section',
			'type'     => 'textarea',
			'priority' => 120,
			)
		);
		
	
		
// Add Theme Options Panel.

$wp_customize->add_section( 'footer_section_settings',
	array(
		'title'      => esc_html__( 'Footer Background', 'consted' ),
		'priority'   => 999,
		'capability' => 'edit_theme_options',
		
	)
);

$wp_customize->add_setting( 'consted_footer_bg', array(
    'default' => esc_url( $default['consted_footer_bg'] ), // Add Default Image URL 
    'sanitize_callback' => 'esc_url_raw'
));

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'consted_footer_bg', array(
    'label' => esc_html__( 'Background Image', 'consted' ),
    'priority' => 20,
    'section' => 'footer_section_settings',
  
)));







		
		
	


		