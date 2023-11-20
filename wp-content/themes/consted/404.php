<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Consted
 */

get_header();
?>

	
            
<section class="error-404 not-found8">

	
    <h1><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'consted' ); ?></h1>
    
     <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'consted' ); ?></p>
 	
    <div class="page-content">
        
    
         <?php get_search_form();?>
    
    
         <div class="clearfix"></div>
         <!-- .widget -->
    
    
    </div><!-- .page-content -->
</section>


		
<?php
get_footer();
