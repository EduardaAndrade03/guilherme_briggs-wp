<?php get_header(); ?>

<main class="container">
  <?php while (have_posts()) : the_post(); ?>
    <article>
      <h1><?php the_title(); ?></h1>
      <p class="meta">
        <?php echo get_the_date(); ?> · <?php the_author(); ?>
      </p>
      <?php if (has_post_thumbnail()) the_post_thumbnail('large'); ?>
      <?php the_content(); ?>
    </article>
  <?php endwhile; ?>
</main>

<?php get_footer(); ?>
