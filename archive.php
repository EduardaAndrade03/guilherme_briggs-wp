<?php get_header(); ?>

<main class="container">
  <h1><?php the_archive_title(); ?></h1>
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php get_template_part('template-parts/card-post'); ?>
  <?php endwhile; the_posts_pagination(); endif; ?>
</main>

<?php get_footer(); ?>
