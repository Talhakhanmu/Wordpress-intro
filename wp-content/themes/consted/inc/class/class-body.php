<?php
/**
 * The Site Theme Header Class 
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package consted
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
class Consted_Body_Layout{
	/**
	 * Function that is run after instantiation.
	 *
	 * @return void
	 */
	

	public function __construct() {
		
		add_action('consted_container_wrap_start', array( $this, 'container_wrap_start' ), 5 );
		add_action('consted_container_wrap_start', array( $this, 'container_wrap_column_start' ), 10 );
		
		add_action('consted_container_wrap_end', array( $this, 'container_wrap_column_end' ), 5 );
		add_action('consted_container_wrap_end', array( $this, 'get_sidebar' ), 10 );
		add_action('consted_container_wrap_end', array( $this, 'container_wrap_end' ), 999 );
		
		

	}
	/**
	* Container before
	*
	* @return $html
	*/
	function container_wrap_start( $layout = '' ){
	
	    if( get_post_meta( get_the_ID(), '_wp_page_template', true ) == 'elementor_theme') return false;
	    
		
		$layout 	= ( $layout == 'full-container' ) ? 'container-fluid' : 'container';
		$html  = '<div id="inner-page-wrap" class="site-main">
					<div class="'.esc_attr( $layout ).'">
        				<div class="row">';
					
   		$html  = apply_filters( 'consted_container_wrap_start_filter', $html );	
		
		echo wp_kses( $html, $this->alowed_tags() );
    	
	}
	
	/**
	* Main Content Column before
	*
	* return $html
	*/
	function container_wrap_column_start ( $layout = '' ){
		if( get_post_meta( get_the_ID(), '_wp_page_template', true ) == 'elementor_theme') return false;
		switch ( $layout ) {
			case 'right-sidebar':
				$layout = 'col-xl-8 col-md-8 col-12 order-1';
				break;
			case 'left-sidebar':
				$layout = 'col-xl-8 col-md-8 col-12 order-2';
				break;		
				
			case 'no-sidebar':
				$layout = 'col-md-12';
				break;
			case 'full-container':
				$layout = 'col-12';
				break;	
			default:
				$layout = 'col-12';
		} 
	
	   $html 	 = '<div class="'.esc_attr( $layout ).'">
	   					<main id="main" class="site-main">';
	   
	   $html  	 = apply_filters( 'consted_container_wrap_column_start_filter', $html );	
		
		echo wp_kses( $html, $this->alowed_tags() );
		
   	
	}
	
	/**
	* Main Content Column before
	*
	* return $html
	*/
	function container_wrap_column_end ( $layout = '' ){
	if( $layout == 'theme-canvas' ) return;
	   $html 	 = '</main>
	   			</div>';
	   
	   $html  	 = apply_filters( 'consted_container_wrap_column_end_filter', $html );	
		
		echo wp_kses( $html, $this->alowed_tags() );
		
   	
	}
	
	/**
	* Main Content Column after
	*
	* return $html
	*/
	function get_sidebar( $layout = '' ){ 
		if( $layout == 'theme-canvas' ) return;
	switch ( $layout ) {
	case 'right-sidebar':
		$layout = 'col-xl-4 col-md-4 col-12 order-2 consted-sidebar';
		break;
	case 'left-sidebar':
		$layout = 'col-xl-4 col-md-4 col-12 order-1 consted-sidebar';
		break;	
	case 'no-sidebar':
		return false;
		break;
	case 'full-container':
		return false;
		break;	
	default:
		return false;
	} 

	?>
	<div id="blog-sidebar" class="consted-sidebar <?php echo esc_attr( $layout );?>">
		<?php 
		if ( is_active_sidebar( 'sidebar-2' ) ) : 
			dynamic_sidebar( 'sidebar-2' );
	    endif;
		?>
	</div>
	<?php
   	
	}
	
	/**
	* Container before
	*
	* @return $html
	*/
	function container_wrap_end( $layout = '' ){
		if( $layout == 'theme-canvas' ) return;
		$html  = '</div></div></div>';
						
   		$html  = apply_filters( 'consted_container_wrap_end_filter', $html );	
		
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

$consted_body_layout = new Consted_Body_Layout();