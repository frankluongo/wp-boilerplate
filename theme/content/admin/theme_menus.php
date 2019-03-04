<?php
function register_menu() {
    register_nav_menus(array(
        'header-menu' => __('Header Menu', 'main-nav'),
        'sidebar-menu' => __('Sidebar Menu', 'sidebar-nav')
    ));
}
