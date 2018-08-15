<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<title><?php echo is_front_page() ? get_bloginfo('description').' » ' : wp_title( '»', true, 'right' ); ?><?php bloginfo('name'); ?></title>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<header class="wrapper header">
		<nav class="header-menu">
			<?php wp_nav_menu(array(
				'theme_location' => 'primary',
				'fallback_cb' => false
			)) ?>
		</nav>
	</header>
