<?php
/**
 * The Site Theme Header Class 
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Consted
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
class Consted_Footer_Layout{
	/**
	 * Function that is run after instantiation.
	 *
	 * @return void
	 */
	public function __construct() {
		
		add_action('consted_site_footer', array( $this, 'site_footer_container_before' ), 5);
		add_action('consted_site_footer', array( $this, 'site_footer_widgets' ), 10);
		add_action('consted_site_footer', array( $this, 'site_footer_info' ), 80);
		add_action('consted_site_footer', array( $this, 'site_footer_container_after' ), 998);
		

		add_action('elementor/page_templates/canvas/after_content', array( $this, 'site_footer_container_before' ), 5);
		add_action('elementor/page_templates/canvas/after_content', array( $this, 'site_footer_widgets' ), 10);
		add_action('elementor/page_templates/canvas/after_content', array( $this, 'site_footer_info' ), 80);
		add_action('elementor/page_templates/canvas/after_content', array( $this, 'site_footer_container_after' ), 998);
		
	}
	
	/**
	* diet_shop foter conteinr before
	*
	* @return $html
	*/
	public function site_footer_container_before (){
		
		$html = '<div class="footer"  id="colophon">';
						
		$html = apply_filters( 'consted_footer_container_before_filter',$html);		
				
		echo wp_kses( $html, $this->alowed_tags() );
		
						
	}
	
	/**
	* Footer Container before
	*
	* @return $html
	*/
	function site_footer_widgets(){
		if ( is_active_sidebar( 'footer-1' ) ) { ?>
        <div class="main-footer">
        <div class="container">
        <div class="row no-gutters">
        
       		 <?php dynamic_sidebar( 'footer-1' ); ?>
        
        </div>
        </div>
        </div>
        <?php }
	}
	
	
	/**
	* diet_shop foter conteinr after
	*
	* @return $html
	*/
	public function site_footer_info (){
		$text ='';
		if( get_theme_mod('copyright_text') != '' ) 
		{
			$text .= esc_html(  get_theme_mod('copyright_text') );
		}else
		{
			/* translators: 1: Current Year, 2: Blog Name  */
			$text .= sprintf( esc_html__( 'Copyright &copy; %1$s %2$s. All Right Reserved.', 'consted' ), date_i18n( _x( 'Y', 'copyright date format', 'consted' ) ), esc_html( get_bloginfo( 'name' ) ) );
		
		
			
		}
		
		
		$html = '<div class="copyright">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-xl-6 col-lg-6 col-md-6 text-wrap">';
				
			$html  .= apply_filters( 'consted_footer_copywrite_text', $text );
			
			if( get_theme_mod('dev_credit') != true ) {
				/* translators: 1: developer website, 2: WordPress url  */
				$html  .= '<span class="dev_info">'.sprintf( esc_html__( ' %1$s By aThemeArt - Proudly Powered by WordPress .', 'consted' ), '<a href="'. esc_url( 'https://athemeart.com/downloads/consted/' ) .'" target="_blank" rel="nofollow">'.esc_html_x( 'Consted theme', 'credit - theme', 'consted' ).'</a>' ).'</span>';
			}
		$html .= '</div>
			</div>
		</div>
		</div>';
		echo wp_kses( $html, $this->alowed_tags() );
	}
	
	/**
	* diet_shop foter conteinr after
	*
	* @return $html
	*/
	public function site_footer_container_after (){
		
		$html = '</div>';
						
		$html = apply_filters( 'consted_footer_container_after_filter',$html);		
				
		echo wp_kses( $html, $this->alowed_tags() );
	
	}
	
	
	private function alowed_tags(){
		
		if( function_exists('consted_alowed_tags') ){ 
			  return consted_alowed_tags(); 
		}else{
			return array();	
		}
		
	}
}

$consted_footer_layout_class = new Consted_Footer_Layout();