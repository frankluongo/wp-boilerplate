<?php

// Load HTML5 Blank scripts (header.php)
function header_scripts() {
  if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
    wp_enqueue_script('app', get_template_directory_uri() . '/assets/scripts/app.js'); // Custom scripts
  }
}

// Load HTML5 Blank conditional scripts
function conditional_scripts() {
  if (is_page('homepage')) {
      // wp_register_script('homepage_script', get_template_directory_uri() . '/assets/scripts/vendor/count_up.js', array('jquery'), '1.0.0'); // Conditional script(s)
      // wp_enqueue_script('homepage_script'); // Enqueue it!

      // wp_register_style('homepage_css', get_template_directory_uri() . '/assets/css/pages/homepage.css', array(), '1.0', 'all');
      // wp_enqueue_style('homepage_css'); // Enqueue it!
  }
}

// Load HTML5 Blank styles
function add_theme_styles() {
    wp_enqueue_style('fonts', 'https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700', array(), '1.0', 'all');
    wp_enqueue_style('stylesheet', get_template_directory_uri() . '/assets/css/app.css', array(), '1.0', 'all');
}
