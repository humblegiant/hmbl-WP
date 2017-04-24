<?php get_header(); ?>

	<main class="wrapper 404-wrapper">

		<article class="wrapper content-wrapper">

			<header>
				<h1><?php _e( "The page wasn't found", "hmbl" ); ?></h1>
			</header>

			<div>
				<p><?php _e( "Sorry, the page you're looking for doesn't exist.", "hmbl" ); ?></p>
			</div>

			<p><?php get_search_form(); ?></p>

		</article>

		<?php get_sidebar(); ?>

	</main>

<?php get_footer(); ?>
