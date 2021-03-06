<?php
/**
 * Hide the WordPress version number
 */
remove_action( 'wp_head', 'wp_generator' );
add_filter( 'the_generator', '__return_false' );

/**
 * Enqueue theme styles
 */
function hmbl_styles() {
	wp_enqueue_style('theme-style', get_template_directory_uri() . '/css/main.css');
}
add_action( 'wp_enqueue_scripts', 'hmbl_styles' );

/**
 * Enqueue theme scripts
 */
function hmbl_scripts() {
	wp_enqueue_script('theme-script', get_template_directory_uri() . '/js/script.min.js', array('jquery'), '1.0.0', true);
}
add_action( 'wp_enqueue_scripts', 'hmbl_scripts' );

/**
 * Enqueue admin styles
 */
function hmbl_admin_styles() {
	wp_enqueue_style('admin-style', get_template_directory_uri() . '/css/admin.css');
}
add_action( 'admin_enqueue_scripts', 'hmbl_admin_styles' );

/**
 * Enqueue admin scripts
 */
function hmbl_admin_scripts() {
	wp_enqueue_script('admin-script', get_template_directory_uri() . '/js/admin.min.js', array('jquery'), '1.0.0', true);
}
add_action( 'admin_enqueue_scripts', 'hmbl_admin_scripts' );

/**
 * Register menus
 */
function hmbl_register_menus() {
	register_nav_menu( 'primary', __( 'Primary Menu', 'hmbl' ) );
}
add_action( 'after_setup_theme', 'hmbl_register_menus' );

/**
 * Add Open Graph tags
 */
function hmbl_og_tags() {
	global $post;

	if (!is_a($post, 'WP_Post')) {
		return false;
	}

	// Get the URL
	$url = get_the_permalink();

	// Get the image
	if (has_post_thumbnail()) {
		$image_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium' );
		$image = $image_src[0];
	}

	// Get the excerpt
	if (strlen($post->post_excerpt) > 0) {
		$description = $post->post_excerpt;
	} else if (strlen(strip_tags($post->post_content)) > 0) {
		$full_content = $post->post_content;
		$description = substr(strip_tags($post->post_content), 0, 100);
	} else {
		$description = get_bloginfo('description');
	}
	$description = strip_tags($description);

	// Get the title
	$title = is_front_page() ? get_bloginfo('name') : get_the_title();

	?>
	<meta property="og:url" content="<?php echo $url ?>" />
	<?php if (isset($image) && !empty($image)): ?><meta property="og:image" content="<?php echo $image ?>" /><?php endif ?>

	<meta property="og:title" content="<?php echo $title ?>" />
	<meta property="og:description" content="<?php echo $description ?>" />
	<?php
}
add_action( 'wp_head', 'hmbl_og_tags', 5 );

// Remove the extra 10 px "padding" from captioned images
function remove_caption_extra_width($width) {
	return $width - 10;
}
add_filter('img_caption_shortcode_width', 'remove_caption_extra_width');

/**
 * Register widget areas
 */
function hmbl_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', 'hmbl' ),
		'id'            => 'primary_sidebar',
		'before_widget' => '<div class="sidebar-widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	));
}
add_action( 'widgets_init', 'hmbl_widgets_init' );

/**
 * Load theme text domain
 */
function hmbl_laod_theme_textdomain(){
	load_theme_textdomain( 'hmbl', get_stylesheet_directory().'/language' );
}
add_action( 'after_setup_theme', 'hmbl_laod_theme_textdomain' );

/**
 * Add wrapper to embedded media
 */
function hmbl_embed_oembed_html($html, $url, $attr, $post_id) {
	return '<div class="video-container">' . $html . '</div>';
}
add_filter('embed_oembed_html', 'hmbl_embed_oembed_html', 99, 4);

/**
 * Add support for featured image
 */
add_theme_support( 'post-thumbnails' );
