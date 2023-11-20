<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Consted
 */

get_header();
$layout = 'no-sidebar';

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

	
	<?php
	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/content', 'page' );

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;

	endwhile; // End of the loop.
	?>
	

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
