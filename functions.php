<?php
/**
 * tm2 functions and definitions
 *
 * @package tm2
 */
require "shortcodes.php";

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'tm2_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function tm2_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on tm2, use a find and replace
	 * to change 'tm2' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'tm2', get_template_directory() . '/languages' );

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
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'tm2' ),
		'secondery' => __( 'Secondery Menu', 'tm2' ),
		'secondery' => __( 'Secondery Menu', 'tm2' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'tm2_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	add_image_size('sg', 300, 300, 1);
}
endif; // tm2_setup
add_action( 'after_setup_theme', 'tm2_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function tm2_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'tm2' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'tm2_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function tm2_scripts() {
	wp_enqueue_style( 'tm2-style', get_stylesheet_uri() );
	wp_enqueue_style( 'tm2-bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css' );

	wp_enqueue_script( 'tm2-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'tm2-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'tm2_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


/**
 * Our Functions
 */

function main_container_class(){
	$col_main_content = 'col-md-12';
	if(is_active_sidebar('sidebar-1')){
		$col_main_content = 'col-md-9';
	}

	return $col_main_content;
}

function side_container_class(){
	$return = false;
	if(is_active_sidebar('sidebar-1')){
		$return = 'col-md-3';
	}
	return $return;
}

function remove_column($defaults){
unset($defaults['tags']);
	return $defaults;
}
add_filter("manage_posts_columns", "remove_column", 10);

function add_column($defaults){
	$defaults['slug'] = "Slug";
	$defaults['id'] = "ID";

	$new_columns = array(
		"cb" => "cb",
		"id" => "id",
		"slug" => "slug",
		"title" => "title",

	);
	return $new_columns;
//	return $defaults;
}
add_filter("manage_posts_columns", "add_column", 10);

function column_slug_content($cn, $p){
	if("slug" == $cn){
		echo basename(get_permalink());
	}elseif("id" == $cn){
		echo get_the_ID();
	}
}
add_filter("manage_posts_custom_column", "column_slug_content", 10, 2);




// Register Custom Post Type
function cpt_movies() {

	$labels = array(
		'name'                => _x( 'Movies', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Movie', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Movie', 'text_domain' ),
		'parent_item_colon'   => __( 'Parent Movie:', 'text_domain' ),
		'all_items'           => __( 'All Movies', 'text_domain' ),
		'view_item'           => __( 'View Movie', 'text_domain' ),
		'add_new_item'        => __( 'Add New Movie', 'text_domain' ),
		'add_new'             => __( 'Add New', 'text_domain' ),
		'edit_item'           => __( 'Edit Movie', 'text_domain' ),
		'update_item'         => __( 'Update Movie', 'text_domain' ),
		'search_items'        => __( 'Search Movie', 'text_domain' ),
		'not_found'           => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
	);
	$args = array(
		'label'               => __( 'movies', 'text_domain' ),
		'description'         => __( 'About Movies', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 20,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
		'menu_icon' => get_template_directory_uri().'/img/icon_movie.gif'
	);
	register_post_type( 'movies', $args );
}

// Hook into the 'init' action
add_action( 'init', 'cpt_movies', 0 );



// Register Custom Post Type
function cpt_books() {

	$labels = array(
		'name'                => _x( 'Books', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Book', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Book', 'text_domain' ),
		'parent_item_colon'   => __( 'Parent Book:', 'text_domain' ),
		'all_items'           => __( 'All Books', 'text_domain' ),
		'view_item'           => __( 'View Book', 'text_domain' ),
		'add_new_item'        => __( 'Add New Book', 'text_domain' ),
		'add_new'             => __( 'Add New', 'text_domain' ),
		'edit_item'           => __( 'Edit Book', 'text_domain' ),
		'update_item'         => __( 'Update Book', 'text_domain' ),
		'search_items'        => __( 'Search Book', 'text_domain' ),
		'not_found'           => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
	);
	$args = array(
		'label'               => __( 'books', 'text_domain' ),
		'description'         => __( 'About Books', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'thumbnail', ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 20,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
		'menu_icon' => get_template_directory_uri().'/img/icon-book.png',
	);
	register_post_type( 'books', $args );
}

// Hook into the 'init' action
add_action( 'init', 'cpt_books', 0 );


function get_latest_cpt($post_type, $count=5){
	$param = array(
		'post_per_page' => $count,
		'post_type' => $post_type,
		'orderby' => 'ID',
		'order' => 'DESC'
	);
	$movies = get_posts($param);
	return $movies;
}


/**
 * CMB2 Meta Box
 */

if(!class_exists('cmb2_bootstrap_201')){
	require "libs/CMB2/init.php";

}
require "libs/CMB2/metaboxes.php";

if ( ! class_exists( 'TitanFrameworkEmbedder' ) ) {
	require "libs/titan/titan-framework-embedder.php";
}

function titan_metabox(){
	$titan = TitanFramework::getInstance("tm2");
	$mb1 =  $titan->createMetaBox(array(
		'name' => 'Additional Post Options',
		'post_type' => array( 'page', 'post' ),

	));

	$mb1->createOption(array(
		'id' => 'name',
		'name' => 'My titan text box',
		'type' => 'text'
	));

	$mb1->createOption( array(
		'name' => 'Heading Font',
		'id' => 'my_heading_font',
		'type' => 'select-googlefont',
		'default' => array(
			'name' => 'Exo',
			'variants' => array( '400', 'italic' ),
			'subsets' => array( 'latin-ext' )
		),
		'css' => 'h1, h2, h3, h4, h5, h6 { font-family: value; }',
	) );

	$mb2 =  $titan->createAdminPanel(array(
		'name' => 'Additional Post Options',
		'post_type' => array( 'page', 'post' ),

	));
}

add_action("tf_create_options", "titan_metabox");