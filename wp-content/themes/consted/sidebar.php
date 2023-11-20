<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Consted
 */

if ( ! is_active_sidebar( 'sidebar-1' )  ) {
	return;
}

?>



<!-- sidebar begin -->
<div class="sidebar-bg"></div>
<div class="main-sidebar">
    
   <aside id="secondary" class="widget-area">
	  <?php dynamic_sidebar( 'sidebar-1' ); ?>
	</aside>
    <button class="close-btn">
        <i class="icofont-close-line-circled"></i>
    </button>
</div>
<!-- sidebar end -->