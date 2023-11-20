<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Consted
 */

get_header();
$layout = consted_get_option('blog_layout');

/**
* Hook - consted_shop_site_header
*
* @hooked header_wrapping_before
* @hooked site_top_bar
* @hooked header_wrapping_before
* @hooked header_wrapping_before
* @hooked header_wrapping_before
* @hooked header_wrapping_after
*/
do_action( 'consted_container_wrap_start',$layout);

?>  
    

<div class="blog-wrap blog-inner">
        <div class="row">    

		<?php
		if ( have_posts() ) :

			

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

			
			 do_action( 'consted_loop_navigation' );

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</div>

</div><!-- #main -->
<?php
do_action( 'consted_container_wrap_end',$layout);
get_footer();
