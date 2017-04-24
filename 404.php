<?php get_header(); ?>

	<main class="wrapper 404-wrapper">

		<article class="wrapper content-wrapper">

			<header>
				<h1><?php _e( 'Sorry, no posts matched your criteria.', 'hmbl' ); ?></h1>
			</header>

			<p><?php get_search_form(); ?></p>

		</article>

		<?php get_sidebar(); ?>

	</main>

<?php get_footer(); ?>
