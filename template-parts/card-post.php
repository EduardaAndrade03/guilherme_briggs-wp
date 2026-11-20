<article class="post-card">
  <a class="post-card__link" href="<?php the_permalink(); ?>">
    <div class="post-card__img">
      <?php if (has_post_thumbnail()) : ?>
        <?php the_post_thumbnail('medium_large'); ?>
      <?php else : ?>
        <img src="<?php echo (get_template_directory_uri() . '/assets/img/placeholder.jpg'); ?>" alt="Imagem padrão do post">
      <?php endif; ?>
    </div>
    <div class="post-card__corpo">
      <time class="post-card__data" datetime="<?php echo get_the_date('c'); ?>">
        <?php echo get_the_date(); ?>
      </time>
      <h3><?php the_title(); ?></h3>
      <p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
    </div>
  </a>
</article>