<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Consted
 */

get_header();

$layout = 'container';
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

		<?php
		if ( have_posts() ) :

			
			echo '<div class="row">';
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			endwhile;

			
			 do_action( 'consted_loop_navigation' );
			 echo '</div>';
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</div>	
<?php
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
do_action( 'consted_container_wrap_end',$layout);
get_footer();
