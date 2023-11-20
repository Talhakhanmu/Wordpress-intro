<?php

/**
 * Consted functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Consted
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'consted_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function consted_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Consted, use a find and replace
		 * to change 'consted' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'consted', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary', 'consted' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'consted_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		add_theme_support( "responsive-embeds");
		add_theme_support( "align-wide" );
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
		
		// remove_theme_support( 'widgets-block-editor' );
	}
	
  update_option( 'widget_block', '' );

  
endif;
add_action( 'after_setup_theme', 'consted_setup' );



/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function consted_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'consted_content_width', 640 );
}
add_action( 'after_setup_theme', 'consted_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function consted_widgets_init() {

	register_sidebar(
		array(
			'name'          => esc_html__( 'Fly Sidebar', 'consted' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'consted' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title"><span>',
		    'after_title'   => '</span></h3>',
		)
	);
	
	register_sidebar(
		array(
			'name'          => esc_html__( 'Blog Sidebar', 'consted' ),
			'id'            => 'sidebar-2',
			'description'   => esc_html__( 'Add widgets here for single post.', 'consted' ),
			'before_widget' => '<div id="%1$s" class="widget widget_block %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
		    'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Homepage Slider', 'consted' ),
			'id'            => 'slider',
			'description'   => esc_html__( 'Replace home page default slider', 'consted' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title hide-block">',
		    'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Inner-page Hero block', 'consted' ),
			'id'            => 'inner-hero',
			'description'   => esc_html__( 'Replace inner page hero block', 'consted' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title hide-block">',
		    'after_title'   => '</h3>',
		)
	);

	

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer', 'consted' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Add widgets here.', 'consted' ),
   			'before_widget' => '<div id="%1$s" class="col-md-4 col-sm-3 col-12 d-xl-flex widget  %2$s"><div class="footer-contact">',

			'after_widget'  => '</div></div>',
			'before_title'  => '<h3 class="title">',
			'after_title'   => '</h3>',
		)
	);
	
	
}
add_action( 'widgets_init', 'consted_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function consted_scripts() {
	
	wp_enqueue_style( 'consted-google-fonts', 'https://fonts.googleapis.com/css2?family=Hind:wght@300;400;500;600;700&family=Jost:wght@300;500;700&&family=Roboto+Condensed:wght@400;700&display=swap', array(), null );

	wp_enqueue_style( 'font-awesome', get_theme_file_uri( 'assets/fontawesome/css/all.css' ), array(), '5.0.0' );
	wp_enqueue_style( 'animate-2', get_theme_file_uri( 'assets/css/animate-2.css' ), array(), '4.0.0' );
	wp_enqueue_style( 'icofont', get_theme_file_uri( 'assets/icofont/icofont.css' ), array(), '4.0.0' );
	

    wp_enqueue_style( 'bootstrap', get_theme_file_uri( 'assets/css/bootstrap.css"' ), array(), '4.0.0' );
 	wp_enqueue_style( 'consted-core-style', get_theme_file_uri( 'assets/css/consted.css"' ), array('thickbox'), _S_VERSION );

  
	
	wp_enqueue_style( 'consted-style', get_stylesheet_uri(), array(), _S_VERSION );
	
	$footer_bg = consted_get_option('consted_footer_bg');
	if( !empty( $footer_bg ) ){
	    $custom_css = '#colophon{ background: url( '.esc_url( $footer_bg ).' ) center center no-repeat; background-size: cover;}';
			
		wp_add_inline_style( 'consted-style', $custom_css );
	}

    wp_enqueue_script( 'bootstrap', get_theme_file_uri( 'assets/js/bootstrap.js"' ), 0, '3.3.7', true );
    wp_enqueue_script( 'consted-js', get_theme_file_uri( 'assets/js/consted.js'), array('jquery','jquery-masonry','thickbox'), _S_VERSION, true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'consted_scripts' );


/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Consted
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses consted_header_style()
 */
function consted_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'consted_custom_header_args', array(
		'default-image' => get_template_directory_uri() . '/assets/image/custom-header.jpg',
		'default-text-color'     => '000000',
		'width'                  => 1000,
		'height'                 => 350,
		'flex-height'            => true,
		'wp-head-callback'       => 'consted_header_style',
	) ) );
	
	register_default_headers( array(
		'default-image' => array(
		'url' => '%s/assets/image/custom-header.jpg',
		'thumbnail_url' => '%s/assets/image/custom-header.jpg',
		'description' => esc_html__( 'Default Header Image', 'consted' ),
		),
	));
}



add_action( 'after_setup_theme', 'consted_custom_header_setup' );

if ( ! function_exists( 'consted_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see consted_custom_header_setup().
	 */
	function consted_header_style() {
		$header_text_color = get_header_textcolor();
		$header_image	   = get_header_image();
		
		
		if( !empty( $header_image ) ){
		?>
			<style type="text/css">
				#masthead .container.header-middle{
					background: url( <?php echo esc_url( $header_image );?> ) center center no-repeat;
					background-size: cover;
				}
			</style>
		<?php
		}


		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
		 */
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
		<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
			?>
			.site-title,
			.site-description {
					position: absolute;
					clip: rect(1px, 1px, 1px, 1px);
				}
		<?php endif; 
		// If the user has set a custom color for the text use that.
		if( !empty($header_text_color) ) :
		?>
			.site-hero-section .part-txt h1,
			.site-hero-section .part-txt .subtitle {
				color: #<?php echo esc_attr( $header_text_color ); ?>;
			}
		<?php endif; ?>
		</style>
		<?php
	}
endif;


