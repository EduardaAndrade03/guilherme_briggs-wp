<?php get_header(); ?>

<?php get_template_part('template-parts/hero'); ?>

<main class="container">
  <div class="sobre">
    <div>
      <h2><?php echo esc_html(tema_texto('titulo_sobre')); ?></h2>
      <p><?php echo esc_html(tema_texto('texto_sobre')); ?></p>
      <a href="<?php echo esc_url(tema_texto('link_sobre')); ?>" class="btn"><?php echo esc_html(tema_texto('botao_sobre')); ?></a>
    </div>
    <?php $imagem = tema_imagem('imagem_sobre'); ?>
    <img src="<?php echo esc_url($imagem ? $imagem['url'] : img_placeholder()); ?>" alt="<?php echo esc_attr($imagem ? $imagem['alt'] : 'Imagem padrão'); ?>">
  </div>

  <div class="trabalhos">
    <h2><?php echo esc_html(tema_texto('titulo_trabalhos')); ?></h2>
    <p><?php echo esc_html(tema_texto('texto_trabalhos')); ?></p>      
    <div class="trabalhos__lista">
      <?php foreach (tema_lista('trabalhos') as $trabalho) :
        $imagem = tema_anexo(isset($trabalho['imagem']) ? $trabalho['imagem'] : 0);
        $legenda = isset($trabalho['legenda']) ? $trabalho['legenda'] : '';
        ?>
          <figure class="trabalho">
            <img src="<?php echo esc_url($imagem ? $imagem['url'] : img_placeholder()); ?>" alt="<?php echo esc_attr($legenda); ?>">
            <figcaption>
              <?php echo esc_html($legenda); ?>
            </figcaption>
          </figure>
        <?php endforeach; ?>
    </div>
    <a class="btn" href="<?php echo esc_url(tema_texto('link_trabalhos')); ?>"><?php echo esc_html(tema_texto('botao_trabalhos')); ?></a>    
  </div>

  <div class="postsRecentes">
    <h2><?php echo esc_html(tema_texto('titulo_posts')); ?></h2>
    <div class="blog__lista">
      <?php
      $ultimos = new WP_Query([
        'post_type'      => 'post',
        'posts_per_page' => 3,
      ]);

      if ($ultimos->have_posts()) :
        while ($ultimos->have_posts()) : $ultimos->the_post();
          get_template_part('template-parts/card-post');
        endwhile;
        wp_reset_postdata();
      else :
        echo '<p>Nenhum post ainda.</p>';
      endif;
      ?>
    </div>
    <a class="btn" href="<?php echo home_url('/blog/'); ?>"><?php echo esc_html(tema_texto('botao_posts')); ?></a>
  </div>
</main>

<?php get_footer(); ?>