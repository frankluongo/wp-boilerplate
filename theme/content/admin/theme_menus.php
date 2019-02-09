<?php
function register_menu() {
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', 'main-nav'), // Main Navigation
        'sidebar-menu' => __('Sidebar Menu', 'sidebar-nav'), // Sidebar Navigation
        'extra-menu' => __('Extra Menu', 'extra-nav'), // Extra Navigation if needed (duplicate as many as you need!)
        'utility-nav' => __('Utility Nav', 'utility-nav') // Extra Navigation if needed (duplicate as many as you need!)
    ));
}
