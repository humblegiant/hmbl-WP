<?php get_header(); ?>

	<main class="wrapper single-wrapper">

		<?php if (have_posts()): while(have_posts()): the_post(); ?>

			<article class="wrapper content-wrapper">
				<header>
					<h1><?php the_title(); ?></h1>
				</header>
				<div>
					<?php the_content(); ?>
				</div>
			</article>

		<?php endwhile; else: ?>
			<p><?php _e( 'Sorry, no posts matched your criteria.', 'hmbl' ); ?></p>
		<?php endif; ?>

	</main>

<?php get_footer(); ?>
