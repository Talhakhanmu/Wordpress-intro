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

class Consted_Header_Layout{
	/**
	 * Function that is run after instantiation.
	 *
	 * @return void
	 */
	public function __construct() {

		add_action('consted_site_branding', array( $this, 'get_site_branding' ), 10 );
		add_action('consted_site_navigation', array( $this, 'get_site_navigation' ), 10 );


		add_action('consted_shop_site_header', array( $this, 'site_skip_to_content' ), 5 );
		add_action('consted_shop_site_header', array( $this, 'header_wrapping_before' ), 10 );
		add_action('consted_shop_site_header', array( $this, 'site_top_bar' ), 20 );
		add_action('consted_shop_site_header', array( $this, 'header_container' ), 30 );
		add_action('consted_shop_site_header', array( $this, 'header_wrapping_after' ), 99 );
		add_action('consted_shop_site_header', array( $this, 'site_hero_sections' ), 999 );

		add_action('consted_breadcrumb', array( $this, 'get_site_breadcrumb' ), 9999 );	


		add_action('elementor/page_templates/canvas/before_content', array( $this, 'site_skip_to_content' ), 5 );
		add_action('elementor/page_templates/canvas/before_content', array( $this, 'header_wrapping_before' ), 10 );
		add_action('elementor/page_templates/canvas/before_content', array( $this, 'site_top_bar' ), 20 );
		add_action('elementor/page_templates/canvas/before_content', array( $this, 'header_container' ), 30 );
		add_action('elementor/page_templates/canvas/before_content', array( $this, 'header_wrapping_after' ), 99 );
		//add_action('elementor/page_templates/canvas/before_content', array( $this, 'site_hero_sections' ), 999 );

		add_action('elementor/page_templates/canvas/before_content', array( $this, 'get_site_breadcrumb' ), 9999 );	

		

		//do_action( 'elementor/page_templates/canvas/before_content' );
		
	}
	
	
	/**
	* Skip link
	*
	* @return $html
	*/
	function site_skip_to_content(){
		
		echo '<a class="skip-link screen-reader-text" href="#inner-page-wrap">'. esc_html__( 'Skip to content', 'consted' ) .'</a>';
	}
	
	/*
	* Header section wrapping before
	*
	* @return $html
	*/
	function header_wrapping_before(){
		echo '<div class="header">';
	}
	
	/*
	* Header section wrapping after
	*
	* @return $html
	*/
	function header_wrapping_after(){
		echo '</div>';
	}
	
	/*
	* Site top bar
	*
	* @return $html
	*/
	function site_top_bar(){

		if( empty( consted_get_option('__topbar_phone') ) && empty( consted_get_option('__topbar_address') ) && empty( consted_get_option('__topbar_email') ) ) return false;
		?>
		<div class="top-header">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <div class="top-right">
                            <ul>
                            	<?php if( !empty( consted_get_option('__topbar_phone') ) ):?>
                                <li>
                                    <span><i class="icofont-ui-cell-phone"></i></span>
                                    <?php echo esc_html( consted_get_option('__topbar_phone')  );?>
                                </li>
                                <?php endif;?>
                                <?php if( !empty( consted_get_option('__topbar_email') ) ):?>
                                <li>
                                    <span><i class="icofont-email"></i></span>
                                    <?php echo esc_html( consted_get_option('__topbar_email')  );?>
                                </li>
                                <?php endif;?>
                                <?php if( !empty( consted_get_option('__topbar_address') ) ):?>
                                <li>
                                    <span><i class="icofont-google-map"></i></span>
                                    <?php echo esc_html( consted_get_option('__topbar_address')  );?>
                                </li>
                                <?php endif;?>
                                
                           </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php

		
	}
    
	function header_container(){
		$css = '';
		if( empty( consted_get_option('__topbar_phone') ) && empty( consted_get_option('__topbar_address') ) && empty( consted_get_option('__topbar_email') ) ){
			$css = 'without-topbar';
		}
	?>
	<div class="bottom-header">
        <div class="container">
            <div class="row no-gutters justify-content-between">
                <div class="d-xl-none d-lg-none d-flex col-4">
                    <button aria-controls="navbar" aria-expanded="true" data-target="#navbar" data-toggle="collapse" class="navbar-toggle" type="button">
                        <span class="sr-only"><?php esc_html__('Toggle navigation','consted');?></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="col-xl-2 col-lg-2 col-4">
                    <div class="logo <?php echo esc_attr($css);?>">
                     	<?php do_action('consted_site_branding');?>
                    </div>
                </div>

                <?php if( is_active_sidebar( 'sidebar-1' ) ):?>
                <div class="col-xl-9 col-lg-9 next">
                <?php else:?>	
                <div class="col-xl-10 col-lg-10 next">
                <?php endif; ?>

                    <nav class="navbar navbar-expand-lg navbar-light ow-navigation underline">
                    	<div id="navbar" class="collapse navbar-collapse navbar-left">
	                    	<button type="button" class="nav-close" aria-expanded="true"><i class="fa fa-window-close"></i></button>
	                       <?php
	                        wp_nav_menu( array(
	                            'theme_location'    => 'primary',
	                            'depth'             => 3,
	                            'container'         => '',
	                            'menu_class'        => 'nav navbar-nav menubar',
	                            'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
	                            'walker'            => new WP_Bootstrap_Navwalker())
	                        );
	                        ?>

	                       
	                       	
	                        
                    	</div>
                    </nav>
                </div>

                <?php if( is_active_sidebar( 'sidebar-1' ) ):?>
                <div class="col-xl-1 col-lg-1 col-4 d-xl-flex d-lg-flex align-items-center">
                    <div class="side-bar-btn">
                        <button type="button" aria-expanded="true" class="side-bar-show"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/image/btn-img.png' ) );?>" alt="<?php esc_attr_e('Sidebar','consted');?>"></button>

                    </div>
                </div>
            	<?php endif;?>


            </div>
        </div>
    </div>
	
	<?php
		
	}
	/**
	* Get the Site logo
	*
	* @return HTML
	*/
	public function get_site_branding (){
		
		$html = '<div class="logo-wrap">';
		
		if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
			$html .= get_custom_logo();
			
		}
		if ( display_header_text() == true ){
			
			$html .= '<h4><a href="'.esc_url( home_url( '/' ) ).'" rel="home" class="site-title">';
			$html .= get_bloginfo( 'name' );
			$html .= '</a></h4>';
			$description = get_bloginfo( 'description', 'display' );
		
			if ( $description ) :
			    $html .=  '<div class="site-description">'.esc_html($description).'</div>';
			endif;
		}
	
		$html .= '</div>';
		
		$html = apply_filters( 'consted_get_site_branding_filter', $html );
		
		echo wp_kses( $html, $this->alowed_tags() );
		
	}
	
	/**
	* Get the Site Main Menu / Navigation
	*
	* @return HTML
	*/
	public function get_site_navigation (){
	?>
	<nav id="navbar" class="collapse navbar-collapse">
	<?php
		wp_nav_menu( array(
			'theme_location'    => 'menu-1',
			'depth'             => 3,
			'menu_class'  		=> 'navbar-nav ml-auto',
			'container'			=> 'ul',
			//'fallback_cb'       => 'consted_shop_navwalker::fallback',
		) );
	?>
	</nav>
	<?php	
	}
	

	public function get_site_breadcrumb (){

		if ( is_404() || 'templates/without-hero.php' == get_page_template_slug() || get_page_template_slug() == 'elementor_canvas') return;

		if( function_exists('bcn_display') && ( !is_home() || !is_front_page())  ):?>
        	
            <ul class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
                <?php bcn_display_list();?>
           </ul>
        <?php
		endif; 

	}
	/**
	* Get the hero sections
	*
	* @return HTML
	*/
	public function site_hero_sections(){

		if ( is_404() || 'templates/without-hero.php' == get_page_template_slug() ) return;
		
		if (  is_front_page() && is_active_sidebar( 'slider' )  ) : 

			dynamic_sidebar( 'slider' );

		else: 
			if( is_active_sidebar( 'inner-hero' ) ){ dynamic_sidebar( 'inner-hero' ); return; }
			$header_image = get_header_image();
			?>
		
           <!-- breadcrumb begin -->
            <div id="inner-hero" class="site-hero-section" <?php if( !empty( $header_image ) ):?> style="background-image: url(<?php echo esc_url( $header_image );?>); background-attachment: scroll; " <?php endif;?>>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-10 col-lg-10">
                            <div class="part-txt">
	                            <div class="flex-wrap">	

	                                <?php echo wp_kses( $this->hero_block_heading(), $this->alowed_tags() );?>

	                                <?php  if ( !is_home() && !is_front_page() ) { do_action('consted_breadcrumb'); }?>
	                            </div>
                        	</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- breadcrumb end -->
		<?php
		endif;
	}
	/**
	 * Add Banner Title.
	 *
	 * @since 1.0.0
	 */
	function hero_block_heading( $style = '' ) {
		 echo '<div class="site-header-text-wrap">';
		
			if ( is_home() ) {
					
					echo '<h1 class="page-title-text">';
					echo !empty( get_option('page_for_posts') ) ? esc_html( get_the_title( get_option('page_for_posts') ) ) : bloginfo( 'name' );
					echo '</h1>';
					echo '<p class="subtitle">';
					echo esc_html(get_bloginfo( 'description', 'display' ));
					echo '</p>';
			}elseif( is_front_page() ){

				echo '<h1 class="page-title-text">';
					echo !empty( get_option('page_on_front') ) ? esc_html( get_the_title( get_option('page_on_front') ) ) : bloginfo( 'name' );
				echo '</h1>';

				echo '<p class="subtitle">';
					echo esc_html(get_bloginfo( 'description', 'display' ));
					echo '</p>';

			}else if ( function_exists('is_shop') && is_shop() ){
				if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
					echo '<h1 class="page-title-text">';
					echo esc_html( woocommerce_page_title() );
					echo '</h1>';
				}
			}else if( function_exists('is_product_category') && is_product_category() ){
				echo '<h1 class="page-title-text">';
				echo esc_html( woocommerce_page_title() );
				echo '</h1>';
				echo '<p class="subtitle">';
				do_action( 'woocommerce_archive_description' );
				echo '</p>';
				
			}elseif ( is_singular() ) {
				echo '<h1 class="page-title-text">';
					echo single_post_title( '', false );
				echo '</h1>';
			} elseif ( is_archive() ) {
				
				the_archive_title( '<h1 class="page-title-text">', '</h1>' );
				the_archive_description( '<p class="archive-description subtitle">', '</p>' );
				
			} elseif ( is_search() ) {
				echo '<h1 class="title">';
					printf( /* translators:straing */ esc_html__( 'Search Results for: %s', 'consted' ),  get_search_query() );
				echo '</h1>';
			} elseif ( is_404() ) {
				echo '<h1 class="display-1">';
					esc_html_e( 'Oops! That page can&rsquo;t be found.', 'consted' );
				echo '</h1>';
			}
		
		echo '</div>';
	}
	
	
	private function alowed_tags(){
		
		if( function_exists('consted_alowed_tags') ){ 
			return consted_alowed_tags(); 
		}else{
			return array();	
		}
		
	}
}

$consted_header_layout_class = new Consted_Header_Layout();