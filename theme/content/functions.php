<?php

// CONSTANTS
define('THEME_DIRECTORY', esc_url(trailingslashit( get_template_directory_uri() )));
define('REQUIRE_DIRECTORY', trailingslashit( get_template_directory() ));

// Modules
// ? --------------------------------------------------------------------------

require_once( REQUIRE_DIRECTORY . 'admin/theme_functions.php' );
require_once( REQUIRE_DIRECTORY . 'admin/theme_menus.php' );
require_once( REQUIRE_DIRECTORY . 'admin/theme_scripts.php' );
require_once( REQUIRE_DIRECTORY . 'admin/theme_shortcodes.php' );
require_once( REQUIRE_DIRECTORY . 'admin/theme_sidebars.php' );

// Theme Support
// ? --------------------------------------------------------------------------

if (function_exists('add_theme_support')) {
  // Add Menu Support
  add_theme_support('menus');
  // Add Thumbnail Theme Support
  add_theme_support('post-thumbnails');
  add_image_size('xsmall', 320, '');
  add_image_size('small', 640, '');
  add_image_size('medium', 960, '');
  add_image_size('large', 1280, '');
  add_image_size('xlarge', 1600, '');
  add_image_size('xxlarge', 1920, '');
  // Enables post and comment RSS feed links to head
  add_theme_support('automatic-feed-links');
  // Localisation Support
  load_theme_textdomain('lang_support', get_template_directory() . '/languages');
}

// Actions
// ? --------------------------------------------------------------------------

// ! ADD ACTIONS
  // Add Custom Scripts to wp_head
  add_action('init', 'header_scripts');
  // Add Conditional Page Scripts
  add_action('wp_print_scripts', 'conditional_scripts');
  // Enable Threaded Comments
  add_action('get_header', 'enable_threaded_comments');
  // Add Theme Stylesheet
  add_action('wp_enqueue_scripts', 'add_theme_styles');
  // Add Custom Menu
  add_action('init', 'register_menu');
  // Remove inline Recent Comment Styles from wp_head()
  add_action('widgets_init', 'my_remove_recent_comments_style');
  // Add our Custom Pagination
  add_action('init', 'pagination');

// ! REMOVE ACTIONS
  // Display the links to the extra feeds such as category feeds
  remove_action('wp_head', 'feed_links_extra', 3);
  // Display the links to the general feeds: Post and Comment Feed
  remove_action('wp_head', 'feed_links', 2);
  // Display the link to the Really Simple Discovery service endpoint, EditURI link
  remove_action('wp_head', 'rsd_link');
  // Display the link to the Windows Live Writer manifest file.
  remove_action('wp_head', 'wlwmanifest_link');
  // Index link
  remove_action('wp_head', 'index_rel_link');
  // Prev link
  remove_action('wp_head', 'parent_post_rel_link', 10, 0);
  // Start link
  remove_action('wp_head', 'start_post_rel_link', 10, 0);
  // Display relational links for the posts adjacent to the current post.
  remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
  // Display the XHTML generator that is generated on the wp_head hook, WP version
  remove_action('wp_head', 'wp_generator');
  remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
  remove_action('wp_head', 'rel_canonical');
  remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
  // Remove some wordpress added styles
  remove_action('wp_head', 'print_emoji_detection_script', 7);
  remove_action('wp_print_styles', 'print_emoji_styles');

// Filters
// ? --------------------------------------------------------------------------

// ! ADD FILTERS
  add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
  // Custom Gravatar in Settings > Discussion
  add_filter('avatar_defaults', 'blankgravatar');
  // Add slug to body class (Starkers build)
  add_filter('body_class', 'add_slug_to_body_class');
  // Allow shortcodes in Dynamic Sidebar
  add_filter('widget_text', 'do_shortcode');
  // Remove <p> tags in Dynamic Sidebars (better!)
  add_filter('widget_text', 'shortcode_unautop');
  // Remove surrounding <div> from WP Navigation
  add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args');
  // Remove Navigation <li> injected classes
  add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1);
  // Remove Navigation <li> injected ID
  add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1);
  // Remove Navigation <li> Page ID's
  add_filter('page_css_class', 'my_css_attributes_filter', 100, 1);
  // Remove invalid rel attribute
  add_filter('the_category', 'remove_category_rel_from_category_list');
  // Remove auto <p> tags in Excerpt (Manual Excerpts only)
  add_filter('the_excerpt', 'shortcode_unautop');
  // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
  add_filter('the_excerpt', 'do_shortcode');
  // Add 'View Article' button instead of [...] for Excerpts
  add_filter('excerpt_more', 'blank_view_article');
  // Remove Admin bar
  add_filter('show_admin_bar', 'remove_admin_bar');
  // Remove 'text/css' from enqueued stylesheet
  add_filter('style_loader_tag', 'style_remove');
  // Remove width and height dynamic attributes to thumbnails
  add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10);
  // Remove width and height dynamic attributes to post images
  add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10);

// ! REMOVE FILTERS
  // Remove <p> tags from Excerpt
  remove_filter('the_excerpt', 'wpautop');
  // Remove <p> tags from Content
  // remove_filter( 'the_content', 'wpautop' );

// Shortcodes
// ? --------------------------------------------------------------------------
// Ex.) add_shortcode('shortcode_name_in_wp', 'shortcode_function_name');
