<?php
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles', 20 );
function theme_enqueue_styles() {
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/css/theme.css');
    wp_enqueue_script( 'js-scripts', get_stylesheet_directory_uri() . '/js/scripts.js', array('jquery'),'1.0.0', true );
}
// Enregistrement - Menu Principal
function register_my_menu() {
    register_nav_menu( 'main-menu', __( 'Menu principal', 'text-domain' ) );
}
add_action( 'after_setup_theme', 'register_my_menu' );

// Enregistrement - Menu pied de page
function register_footer_menu() {
    register_nav_menu( 'footer-menu', __( 'Menu du pied de page', 'text-domain' ) );
}
add_action( 'after_setup_theme', 'register_footer_menu' );


