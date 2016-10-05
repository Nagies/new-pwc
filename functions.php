<?php
/**
 * underscores functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package underscores
 */

if ( ! function_exists( 'underscores_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function underscores_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on underscores, use a find and replace
	 * to change 'underscores' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'underscores', get_template_directory() . '/languages' );

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
		'primary' => esc_html__( 'Primary Menu', 'underscores' ),
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

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'underscores_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // underscores_setup
add_action( 'after_setup_theme', 'underscores_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function underscores_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'underscores_content_width', 640 );
}
add_action( 'after_setup_theme', 'underscores_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function underscores_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'underscores' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'underscores_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function underscores_scripts() {
	wp_enqueue_style( 'underscores-style', get_stylesheet_uri() );

	wp_enqueue_script( 'underscores-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'underscores-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'underscores_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

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




/****************************************************************************************************************/
/************************************* Begin my fxns ************************************************************/
/****************************************************************************************************************/

define('WP_SCSS_ALWAYS_RECOMPILE', true);

// Register frontend styles & scripts
add_action( 'wp_enqueue_scripts', 'register_my_styles_and_scripts' );
function register_my_styles_and_scripts() {

	// custom styles
	wp_register_style( 'my_style', get_stylesheet_directory_uri() . '/css/main.css' );
	wp_enqueue_style( 'my_style' );

	// custom jquery
	wp_register_script( 'custom_validate_js', get_template_directory_uri() . '/js/custom-validate.js', array( 'jquery' ), '1.0', TRUE );
	wp_enqueue_script( 'custom_validate_js' );

	// custom jquery
	wp_register_script( 'custom-chapter-tabs', get_template_directory_uri() . '/js/custom-chapter-tabs.js', array( 'jquery' ), '1.0', TRUE );
	wp_enqueue_script( 'custom-chapter-tabs' );

	// jQ validation plugin
	wp_register_script( 'validation', 'http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'validation' );

	// wp dashicons
	wp_enqueue_style( 'dashicons' );

	// custom chapter styles
	wp_register_style( 'chapter-tabs-styles', get_stylesheet_directory_uri() . '/css/chapter-tabs.css' );
	wp_enqueue_style( 'chapter-tabs-styles' );

	// custom 'chapter tabs' functionality
	wp_enqueue_script( 'jquery-effects-core' );
	wp_enqueue_script( 'jquery-ui-tabs' );
	wp_enqueue_style(
		'jquery-ui-css',
    'https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css'
	);

}



/////////////////////////////////////
/////// edits to wp-admin //////////
///////////////////////////////////

// Remove posts, dashboard, comments from admin menu for everyone, including admins
function remove_menus(){
  remove_menu_page( 'index.php' );                  // Dashboard
  remove_menu_page( 'edit-comments.php' );          // Comments
  remove_menu_page( 'edit.php' );                   // Posts
}
add_action( 'admin_menu', 'remove_menus' );

// Remove menu items for anyone other than admins
function remove_menus_editors(){
  $author = wp_get_current_user();
  if( isset($author->roles[0]) ){
    $current_role = $author->roles[0];
  } else{
    $current_role = 'no_role';
  }
  if($current_role == 'editor'){
    remove_menu_page( 'themes.php' );                 // Appearance
    remove_menu_page( 'plugins.php' );                // Plugins
    remove_menu_page( 'tools.php' );                  // Tools
    remove_menu_page( 'options-general.php' );        // Settings
  }
}
add_action( 'admin_init', 'remove_menus_editors' );

// Remove dashboard boxes for all users
add_action( 'wp_dashboard_setup', 'remove_dashboard_widgets' );
function remove_dashboard_widgets() {
	remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' );          	// Activity
	remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );          	// At a glance
	remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );    	// Recent comments
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );        	// Quick Press widget
	remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );        	// Recent Drafts
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );        		// WordPress.com Blog
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );        		// Other WordPress News
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );     	// Incoming Links
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );      		// Plugins
}

// Removes Dashboard welcome panel for all users
remove_action( 'welcome_panel', 'wp_welcome_panel' );

// Instead show this:
function add_dashboard_widgets() {
	wp_add_dashboard_widget( 'dashboard_welcome', 'PWC', 'add_welcome_widget' );
}
function add_welcome_widget() {
	?><p>Welcome to PWC. <br></p><?php
}
add_action( 'wp_dashboard_setup', 'add_dashboard_widgets' );


////////////////////////////////////
/////// Other fxn files  //////////
//////////////////////////////////
require_once('includes/annualSponsors-functions.php'); 		// annual sponsors
require_once('includes/boardMembers-functions.php');			// board members
require_once('includes/events-functions.php');						// events
require_once('includes/eventSpeakers-functions.php');			// event speakers
require_once('includes/eventSponsors-functions.php');			// event sponsors
require_once('includes/jobs-functions.php');							// jobs
require_once('includes/memberApps-functions.php');				// member applications
require_once('includes/news-functions.php');							// news/blog


////////////////////////////
/////// All CPTs //////////
//////////////////////////

function register_cpts(){
	// jobs CPT:
	$labels = array(
		'name'               => _x( 'Jobs', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Job', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Jobs', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Job', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'job', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Job', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Job', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit Job', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View Job', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Jobs', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Jobs', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Jobs:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No jobs found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No jobs found in Trash.', 'your-plugin-textdomain' )
	);
	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Description.', 'your-plugin-textdomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'jobs' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'supports'           => array( 'title', 'author', 'revisions', 'editor')
	);
	register_post_type( 'jobs', $args ); // end jobs //

  // news CPT: ** Note: ** archive is turned off for News
	$labels = array(
		'name'               => _x( 'News', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'News', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'News', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'News', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'news', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New News', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New News', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit News', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View News', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All News', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search News', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent News:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No news found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No news found in Trash.', 'your-plugin-textdomain' )
	);
	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Description.', 'your-plugin-textdomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'news' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'supports'           => array( 'title', 'author', 'thumbnail', 'revisions', 'editor', 'excerpt')
	);
	register_post_type( 'news', $args ); // end news //


	// events CPT:
	$labels = array(
		'name'               => _x( 'Events', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Event', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Events', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Event', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'event', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Event', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Event', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit Event', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View Event', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Events', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Events', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Events:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No events found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No events found in Trash.', 'your-plugin-textdomain' )
	);
	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Description.', 'your-plugin-textdomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'events' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 0,
		'supports'           => array( 'title', 'author', 'revisions', 'editor', 'thumbnail')
	);
	register_post_type( 'events', $args ); // end events //

	// event speakers CPT:
	$labels = array(
		'name'               => _x( 'Event Speakers', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Event Speaker', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Event Speakers', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Event Speaker', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'event speaker', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Event Speaker', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Event Speaker', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit Event Speaker', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View Event Speaker', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Event Speakers', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Event Speakers', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Event Speakers:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No event speakers found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No event speakers found in Trash.', 'your-plugin-textdomain' )
	);
    $args = array(
        'labels'             => $labels,
        'description'        => __( 'Description.', 'your-plugin-textdomain' ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true, // change to true if Speakers stand alone
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'event-speakers' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 0,
        'supports'           => array( 'title', 'author', 'thumbnail', 'revisions', 'editor')
    );
    register_post_type( 'event-speakers', $args ); // end event speakers //

	// event speakers CPT:
	$labels = array(
		'name'               => _x( 'Event Sponsors', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Event Sponsor', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Event Sponsors', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Event Sponsor', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'event sponsor', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Event Sponsor', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Event Sponsor', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit Event Sponsor', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View Event Sponsor', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Event Sponsors', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Event Sponsors', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Event Sponsors:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No event sponsors found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No event sponsors found in Trash.', 'your-plugin-textdomain' )
	);
	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Description.', 'your-plugin-textdomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true, // change to true if sponsors stand alone
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'event-sponsors' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 0,
		'supports'           => array( 'title', 'author', 'thumbnail', 'revisions', 'editor')
	);
	register_post_type( 'event-sponsors', $args ); // end event sponsors //


	// annual sponsors CPT:
	$labels = array(
		'name'               => _x( 'Annual Sponsors', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Annual Sponsor', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Annual Sponsors', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Annual Sponsor', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'Annual Sponsor', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Annual Sponsor', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Annual Sponsor', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit Annual Sponsor', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View Annual Sponsor', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Annual Sponsors', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Annual Sponsors', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Annual Sponsors:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No Annual Sponsors found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No Annual Sponsors found in Trash.', 'your-plugin-textdomain' )
	);
	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Description.', 'your-plugin-textdomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'annual-sponsors' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 0,
		'supports'           => array( 'title', 'author', 'thumbnail')
	);
	register_post_type( 'annual-sponsors', $args ); // end annual sponsors //

	// board members CPT:
	$labels = array(
		'name'               => _x( 'Board Members', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Board Member', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Board Members', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Board Member', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'Board Member', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Board Member', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Board Member', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit Board Member', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View Board Member', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Board Members', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Board Members', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Board Members:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No Board Members found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No Board Members found in Trash.', 'your-plugin-textdomain' )
	);
	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Description.', 'your-plugin-textdomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'board-members' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 0,
		'supports'           => array( 'title', 'author', 'thumbnail', 'revisions', 'editor')
	);
	register_post_type( 'board-members', $args ); // end board members //


	// member-apps CPT:
	$labels = array(
		'name'               => _x( 'Membership Applications', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Membership Application', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Membership Applications', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Membership Application', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'Membership Application', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Membership Application', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Membership Application', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit Membership Application', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View Membership Application', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Membership Applications', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Membership Applications', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Membership Applications:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No Membership Applications found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No Membership Applications found in Trash.', 'your-plugin-textdomain' )
	);
	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Description.', 'your-plugin-textdomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'member-apps' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 0,
		'supports'           => array( 'title', 'author', 'revisions')
	);
	register_post_type( 'member-apps', $args ); // end membership applications //

	// scholarships CPT:
	$labels = array(
		'name'               => _x( 'Scholarships', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Scholarship', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Scholarships', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Scholarship', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'Scholarship', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Scholarship', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Scholarship', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit Scholarship', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View Scholarship', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Scholarships', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Scholarships', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Scholarships:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No Scholarships found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No Scholarships found in Trash.', 'your-plugin-textdomain' )
	);
	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Description.', 'your-plugin-textdomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'scholarships' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 0,
		'supports'           => array( 'title', 'author', 'revisions', 'editor')
	);
	register_post_type( 'scholarships', $args ); // end membership applications //

} // end register all CPTs
add_action( 'init', 'register_cpts' );


// Add taxonomy "chapter" to multiple CPTs
// note: turn 'show_in_menu' to 'false' to disallow admins to add/delete chapters
add_action( 'init', 'create_chapter_taxonomy', 0 );
function create_chapter_taxonomy() {
	$labels = array(
		'name'              => _x( 'Chapter', 'taxonomy general name' ),
		'singular_name'     => _x( 'Chapter', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Chapters' ),
		'all_items'         => __( 'Chapter' ),
		'parent_item'       => __( 'Parent Chapter' ),
		'parent_item_colon' => __( 'Parent Chapter:' ),
		'edit_item'         => __( 'Edit Chapter' ),
		'update_item'       => __( 'Update Chapter' ),
		'add_new_item'      => __( 'Add New Chapter' ),
		'new_item_name'     => __( 'New Chapter Name' ),
		'menu_name'         => __( 'Chapters' )
	);
	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_in_menu'			=> true,
		'show_admin_column' => true,
		'hierarchical'			=> true
	);
	register_taxonomy( 'chapter', array( 'events', 'board-members', 'member-apps', 'scholarships', 'annual-sponsors' ), $args );
}

// add the following terms to the 'chapter' taxonomy as defaults:
add_action( 'wp_loaded', 'default_chapter_terms' );
function default_chapter_terms() {

	$chapterArr = [
		'new-york'        =>  'New York',
		'new-jersey'      =>  'New Jersey',
		'connecticut'     =>  'Connecticut',
		'washington-dc'   =>  'Washington, DC',
		'philadelphia'    =>  'Philadelphia',
		'all'							=> 	'All'
	];

	foreach ( $chapterArr as $chapterSlug => $chapterName ) {
		// if the term doesn't already exist, insert it
		if ( !term_exists( $chapterName, 'chapter' ) ) {

			wp_insert_term(
				$chapterName, // the term
				'chapter', // the taxonomy
				array(
					'slug' => $chapterSlug
				)
			);

		} else { // if already exists, get its ID and update it

			// get its ID:
			$termObj = get_term_by( 'slug', $chapterSlug, 'chapter' );
			$termID = intval( $termObj->term_id );

			// update:
			wp_update_term($termID, 'chapter', array(
			  'name' => $chapterName,
			  'slug' => $chapterSlug
			));

		} // end if / else
	} // end foreach
} // end fxn



// register the side menu
function register_side_menu() {
  register_nav_menu('side-menu',__( 'My Side Menu' ));
}
add_action( 'init', 'register_side_menu' );










// fin.
