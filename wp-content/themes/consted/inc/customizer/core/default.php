<?php
/**
 * Default theme options.
 *
 * @package consted
 */

if ( ! function_exists( 'consted_get_default_theme_options' ) ) :

	/**
	 * Get default theme options
	 *
	 * @since 1.0.0
	 *
	 * @return array Default theme options.
	 */
	function consted_get_default_theme_options() {

		$defaults = array();
		
		
		/*Posts Layout*/
		$defaults['blog_layout']     				= 'right-sidebar';
		$defaults['single_post_layout']     		= 'right-sidebar';
		
		$defaults['blog_loop_content_type']     	= 'excerpt';
		
		$defaults['blog_meta_hide']     			= false;
		$defaults['signle_meta_hide']     			= false;
		
		/*Posts Layout*/
		$defaults['page_layout']     				= 'content-sidebar';
		
		/*layout*/
		$defaults['copyright_text']					= esc_html__( 'Copyright All right reserved', 'consted' );
		$defaults['read_more_text']					= esc_html__( 'Continue Reading', 'consted' );
		$defaults['index_hide_thumb']     			= false;
		$defaults['dev_credit']     				= false;
		
		/*Posts Layout*/
		$defaults['__fb_pro_link']     				= '';
		$defaults['__tw_pro_link']     				= '';
		$defaults['__you_pro_link']     		    = '';
		$defaults['__pr_pro_link']     				= '';
		
		$defaults['__primary_color']     			= '#6c757d';
		$defaults['__secondary_color']     			= '#000';
		
		$defaults['__menu_secondary_color']     	= '#6c757d';
		$defaults['__menu_primary_color']     		= '#000';
		
		/*layout*/
		$defaults['__topbar_phone']					= '';
		$defaults['__topbar_email']					= '';
		$defaults['__topbar_address']     			= '';
		$defaults['excerpt_length']     			= 20;
		$defaults['consted_footer_bg']     			= get_theme_file_uri('assets/image/footer-bg.jpg');

		// Pass through filter.
		$defaults = apply_filters( 'consted_filter_default_theme_options', $defaults );

		return $defaults;

	}

endif;
