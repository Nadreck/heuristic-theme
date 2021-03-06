<?php
/**
 * Heuristic functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Heuristic
 */

if ( ! function_exists( 'heuristic_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function heuristic_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Heuristic, use a find and replace
		 * to change 'heuristic' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'heuristic', get_template_directory() . '/languages' );

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
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'heuristic' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'heuristic_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/*
		 * Enable support for Post Formats.
		 * See https://developer.wordpress.org/themes/functionality/post-formats/
		 */
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'gallery',
			'video',
			'audio',
			'quote',
			'link',
		) );


		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'heuristic_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function heuristic_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'heuristic_content_width', 640 );
}
add_action( 'after_setup_theme', 'heuristic_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function heuristic_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'heuristic' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'heuristic' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'heuristic_widgets_init' );

function image_meta() {
	$imgmeta = wp_get_attachment_metadata($id);
	if (!empty($imgmeta['image_meta']['shutter_speed']))
	{
		if ((1 / $imgmeta['image_meta']['shutter_speed']) > 1)
		{
			if ((number_format((1 / $imgmeta['image_meta']['shutter_speed']), 1)) == 1.3
			or number_format((1 / $imgmeta['image_meta']['shutter_speed']), 1) == 1.5
			or number_format((1 / $imgmeta['image_meta']['shutter_speed']), 1) == 1.6
			or number_format((1 / $imgmeta['image_meta']['shutter_speed']), 1) == 2.5)
			{
				$shutter =  "1/" . number_format((1 / $imgmeta['image_meta']['shutter_speed']), 1, '.', '') . " second";
			} else {
				$shutter = "1/" . number_format((1 / $imgmeta['image_meta']['shutter_speed']), 0, '.', '') . " second";
			}
		} else {
			$shutter = $imgmeta['image_meta']['shutter_speed'] . " seconds";
		}
	}
 
	$image = wp_get_attachment_image_src( get_the_ID(), 'full' );
 
	if($imgmeta[image_meta][caption]) {
		printf('<span class="image-caption">'.$imgmeta[image_meta][caption].'</span>');
	}	
 
	printf('<table class="image-metadata-table">');
		if($imgmeta[image_meta][title]) {
			printf('<tr>');
				printf('<th>Title:</th>');
				printf('<td>'.$imgmeta[image_meta][title].'</td>');
			printf('</tr>');
		}
		if($imgmeta[image_meta][credit]) {
			printf('<tr>');
				printf('<th>Creator:</th>');
				printf('<td>'.$imgmeta[image_meta][credit].'</td>');
			printf('</tr>');
		}
		printf('<tr>');
			printf('<th>Date:</th>');
			$timestamped = $imgmeta[image_meta][created_timestamp];
			$created_timestamp = date("F j, Y, g:i a", $timestamped);    
			printf('<td>'.$created_timestamp.'</td>');
		printf('</tr>');
		printf('<tr>');
			printf('<th>Aperture:</th>');
			printf('<td>'.$imgmeta[image_meta][aperture].'</td>');
		printf('</tr>');
		printf('<tr>');
			printf('<th>Shutter Speed:</th>');
			printf('<td>'.$shutter.'</td>');
		printf('</tr>');
		printf('<tr>');
			printf('<th>ISO:</th>');
			printf('<td>'.$imgmeta[image_meta][iso].'</td>');
		printf('</tr>');
		printf('<tr>');
			printf('<th>Focal Length:</th>');
			printf('<td>'.$imgmeta[image_meta][focal_length].'</td>');
		printf('</tr>');
		printf('<tr>');
			printf('<th>Camera:</th>');
			printf('<td>'.$imgmeta[image_meta][camera].'</td>');
		printf('</tr>');
		printf('<tr>');
			printf('<th>Resolution:</th>');
			printf('<td><a href="'.$image[0].'">'.$imgmeta[width]." x ".$imgmeta[height].'</a></td>');
		printf('</tr>');		
	printf('</table>');
}

/**
 * Enqueue scripts and styles.
 */
function heuristic_scripts() {
	wp_enqueue_style( 'heuristic-style', get_stylesheet_uri() );

	wp_enqueue_script( 'heuristic-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'heuristic-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'heuristic_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

