<?php get_header(); ?>

  <div class="wrapper single-wrapper">

    <?php if (have_posts()): while(have_posts()): the_post(); ?>

      <div class="wrapper content-wrapper">
        <h1><?php the_title(); ?></h1>
        <div>
          <?php the_content(); ?>
        </div>
      </div>

    <?php endwhile; else: ?>
      <p><?php _e( 'Sorry, no posts matched your criteria.', 'hmbl' ); ?></p>
    <?php endif; ?>

  </div>

<?php get_footer(); ?>
