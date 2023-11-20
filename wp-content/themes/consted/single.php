<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Consted
 */

get_header();
$layout = consted_get_option('single_post_layout');

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
<div class="blog-details">
    <div id="post-<?php the_ID(); ?>" class="site-main main-content">

        <?php
        while ( have_posts() ) :
            the_post();
    
            get_template_part( 'template-parts/content', 'single' );
    
            /**
            * Hook - consted_post_navigation
            *
            * @hooked consted_post_navigation
            */
            do_action( 'consted_post_navigation');
    
            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;
    
        endwhile; // End of the loop.
        ?>

    </div>
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
