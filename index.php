
<?php get_header(); ?>

<section class="page-hero">
  <div class="container">
    <h2><?php echo esc_html(tema_texto('titulo_blog')); ?></h2>
  </div>
</section>

<main class="container">
  <?php if (have_posts()) : ?>
    <div class="blog__lista">
      <?php while (have_posts()) : the_post(); ?>
        <?php get_template_part('template-parts/card-post'); ?>
      <?php endwhile; ?>
    </div>

    <?php the_posts_pagination(); ?>
  <?php else : ?>
    <p>Nada encontrado.</p>
  <?php endif; ?>
</main>

<?php get_footer(); ?>
