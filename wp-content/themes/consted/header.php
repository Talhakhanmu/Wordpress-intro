<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Consted
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); 

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
do_action( 'consted_shop_site_header');

?>    
    

