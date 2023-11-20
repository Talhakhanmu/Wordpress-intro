<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:
function fashion_mart_theme_setup(){
    // Make theme available for translation.
    load_theme_textdomain( 'fashion-mart', get_stylesheet_directory_uri() . '/languages' );
}
add_action( 'after_setup_theme', 'fashion_mart_theme_setup' );

if ( !function_exists( 'fashion_mart_parent_css' ) ):
    function fashion_mart_parent_css() {

        wp_enqueue_style( 'fashion-mart-parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array( 'bootstrap','bi-icons','icofont','scrollbar','owl-carousel','emart-shop-common' ) );


        wp_enqueue_script( 'fashion-mart-js', get_theme_file_uri('js/fashion-mart.js' ), 0, '', true );


    }
endif;

add_action( 'wp_enqueue_scripts', 'fashion_mart_parent_css', 10 );

// END ENQUEUE PARENT ACTION

if( !function_exists('fashion_mart_disable_from_parent') ):

    add_action('init','fashion_mart_disable_from_parent',10);
    function fashion_mart_disable_from_parent(){
        
        global $emart_shop_Header_Layout, $emart_shop_body_layout;

        remove_action('emart_shop_site_header', array( $emart_shop_Header_Layout, 'site_header_layout' ), 30 );

        remove_action('emart_shop_container_wrap_start', array( $emart_shop_body_layout, 'container_wrap_column_start' ), 10 );
        remove_action('emart_shop_container_wrap_end', array( $emart_shop_body_layout, 'get_sidebar' ), 10 );
        
    }
    
endif;


if( !function_exists('fashion_mart_header_layout') ):
     add_action('emart_shop_site_header', 'fashion_mart_header_layout', 30 );

    function fashion_mart_header_layout(){
        global $emart_shop_Header_Layout;
    ?>

        <div class="container brand-wrap">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-3 col-sm-4 col-12 logo-wrap">
                    <?php do_action('emart_shop_header_layout_1_branding');?>
                </div>

                <?php if( is_active_sidebar( 'logo-side' ) ) : ?>
                <div class="col-lg-9 col-md-9 col-sm-6 col-12 d-flex justify-content-end ">
                    <?php dynamic_sidebar( 'logo-side' ); ?>
                </div>
                <?php else:
                    if ( class_exists( 'WooCommerce' ) ) {
                        echo '<div class="aspw-widgets-wrap-class ms-auto">';   
                        do_action('apsw_search_bar_preview', 1 );
                        echo '</div>';
                    }

                endif;?>
                
            </div>
        </div>

       

        <div id="nav-wrap" class="header_style_3">
          <div class="container">
            <div class="d-flex align-items-center">
            <?php 
            do_action('emart_product_category');
            do_action('emart_shop_header_layout_1_navigation');
            ?>
           <?php echo wp_kses( $emart_shop_Header_Layout->get_site_navbar_icon(), emart_shop_alowed_tags() );?>
            </div>
          </div>
        </div>
   
    <?php
    }
endif;

if ( ! function_exists( 'emart_woocommerce_product_category' ) ) {
    /**
     * Before Content.
     *
     * @return void
     */
    function emart_woocommerce_product_category() {
        
       if( !class_exists( 'WooCommerce' )  ) return;
        
                $args = array(
                    'orderby'    => 'title',
                    'order'      => 'ASC',
                    'parent' => 0,
                    'taxonomy' => 'type',
                );
                $product_categories = get_terms( 'product_cat', $args );
                
                if ( !empty($product_categories)) :
                

                echo '<div id="cat-block-menu" class="">
                          <button class="btn-mega"><span class="hamburger"></span><span>'.esc_html__('ALL CATEGORIES ','fashion-mart').'</span></button>
                          <ul class="menu">';
                    foreach ( $product_categories as $product_category ) {
                        
                        
                        
                        $args = array(
                            'orderby'    => 'title',
                            'order'      => 'ASC',
                            'parent'   => $product_category->term_id
                        );
                        $product_sub_categories = get_terms( 'product_cat', $args );
                        if ( !empty($product_sub_categories) ) :
                        
                        echo '<li class="shopstore-cat-parent"> <a href="' . esc_url( get_term_link( $product_category )) . '" title="'.esc_attr( $product_category->name ).'"><span class="menu-title">'.esc_html( $product_category->name ).'</span> </a> ';
                        echo "<ul class='children'>";
                        foreach ( $product_sub_categories as $term ) {
                            echo '<li> <a href="' . esc_url( get_term_link( $term ) ) . '" title="'.esc_attr( $term->name ).'" class=""><span class="menu-title">'.esc_html( $term->name ).'</span> </a> ';
                        }
                        echo "</ul>";
                        
                        else:
                            echo '<li> <a href="' . esc_url( get_term_link( $product_category ) ) . '" title="'.esc_attr( $product_category->name ).'" class=""><span class="menu-title">'.esc_html( $product_category->name ).'</span> </a> ';
                        
                        endif;
                        
                        echo '</li>';
                    }
                    echo '</ul>
                    </div>';
                endif;
                
                
                
                
    }
}
add_action( 'emart_product_category', 'emart_woocommerce_product_category' ); 

if( !function_exists('fashion_mart_header_args') ):
    add_filter( 'emart_shop_custom_header_args', 'fashion_mart_header_args' );
    function fashion_mart_header_args( $args ){
       $args['default-image'] = '';
       return $args;
    }
endif;


if( !function_exists('fashion_mart_container') ):
    add_action('emart_shop_container_wrap_start', 'fashion_mart_container', 10 );   
    function fashion_mart_container( $args ){
     echo '<div class="col-xl-9 col-md-9 col-12 order-1">
             <main id="main" class="site-main">';
    }
endif;

if( !function_exists('fashion_mart_get_sidebar') ):
 add_action('emart_shop_container_wrap_end', 'fashion_mart_get_sidebar', 10 );   
    function fashion_mart_get_sidebar( $layout = '' ){   
    ?>
    <div class="col-xl-3 col-md-3 col-12 order-2 emart-shop-sidebar">
        <?php get_sidebar();?>
    </div>
    <?php

    }
endif;

