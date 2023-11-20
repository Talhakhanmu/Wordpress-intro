<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Consted
 */

/**
* Hook - consted_site_footer
*
* @hooked site_footer_container_before
* @hooked site_footer_widgets
* @hooked site_footer_info
* @hooked site_footer_container_after
*/
do_action( 'consted_site_footer');

wp_footer(); 

get_sidebar();
?>

</body>
</html>
