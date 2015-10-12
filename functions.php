<?php
/**
 * Enqueue theme styles
 */
function hmbl_styles() {
  wp_enqueue_style('theme-style', get_template_directory_uri() . '/main.css');
}
add_action( 'wp_enqueue_scripts', 'hmbl_styles' );

/**
 * Enqueue theme scripts
 */
function hmbl_scripts() {
  wp_enqueue_script('theme-script', get_template_directory_uri() . '/script.min.js', array('jquery'), '1.0.0', true);
}
add_action( 'wp_enqueue_scripts', 'hmbl_scripts' );

/**
 * Register menus
 */
function hmbl_register_menus() {
  register_nav_menu( 'primary', __( 'Primary Menu', 'hmbl' ) );
}
add_action( 'after_setup_theme', 'hmbl_register_menus' );

/**
 * Register widget areas
 */
function hmbl_widgets_init() {

  register_sidebar( array(
    'name'          => 'Footer 1',
    'id'            => 'footer_1',
    'before_widget' => '<div class="footer-widget">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2>',
    'after_title'   => '</h2>',
  ));

  register_sidebar( array(
    'name'          => 'Footer 2',
    'id'            => 'footer_2',
    'before_widget' => '<div class="footer-widget">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2 class="">',
    'after_title'   => '</h2>',
  ));

  register_sidebar( array(
    'name'          => 'Footer 3',
    'id'            => 'footer_3',
    'before_widget' => '<div class="footer-widget">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2>',
    'after_title'   => '</h2>',
  ));

}
add_action( 'widgets_init', 'hmbl_widgets_init' );

/**
 * Load theme text domain
 */
load_theme_textdomain( 'hmbl', get_stylesheet_directory().'/language' );

/**
 * Add wrapper to embedded media
 */
function my_embed_oembed_html($html, $url, $attr, $post_id) {
  return '<div class="video-container">' . $html . '</div>';
}
add_filter('embed_oembed_html', 'my_embed_oembed_html', 99, 4);

/**
 * Add support for featured image
 */
add_theme_support( 'post-thumbnails' );
