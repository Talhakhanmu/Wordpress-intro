<?php
/**
 * Consted functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package consted
 */
/**
 * Implement the theme core feature.
 */
require get_template_directory() . '/inc/theme-core.php';
/**
 * Implement the theme-option.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Implement the bootstrap-navwalker.
 */
require get_template_directory() . '/inc/wp-bootstrap-navwalker.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/class/class-header.php';

require get_template_directory() . '/inc/class/class-body.php';
/**
 * Implement the post meta.
 */
require get_template_directory() . '/inc/class/class-template-tags.php';


/**
 * Implement the post meta.
 */
require get_template_directory() . '/inc/class/class-post-related.php';

/**
 * Implement the theme Footer.
 */
require get_template_directory() . '/inc/class/class-footer.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
* TGM Plugins
*/
require get_template_directory() . '/inc/tgm/recommended-plugins.php';


require get_template_directory() . '/inc/about-themes.php';

