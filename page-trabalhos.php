<?php
// CSS e JS só desta página (as abas)
wp_enqueue_style('meu-tema-trabalhos', get_template_directory_uri() . '/assets/css/trabalhos.css', ['meu-tema-main'], time());
wp_enqueue_script('meu-tema-trabalhos', get_template_directory_uri() . '/assets/js/trabalhos.js', [], time(), true);

// Mostra os cards de um grupo
function tema_cards_trabalhos($cards) {
  foreach ($cards as $card) :
    $imagem    = tema_anexo(isset($card['imagem']) ? $card['imagem'] : 0);
    $detalhe   = isset($card['detalhe']) ? $card['detalhe'] : '';
    $titulo    = isset($card['titulo']) ? $card['titulo'] : '';
    $descricao = isset($card['descricao']) ? $card['descricao'] : '';
    $link      = isset($card['link']) ? $card['link'] : '';
    $tag       = $link ? 'a' : 'div';
    ?>
    <article class="post-card">
      <<?php echo $tag; ?> class="post-card__link"<?php if ($link) : ?> href="<?php echo esc_url($link); ?>" target="_blank" rel="noopener noreferrer"<?php endif; ?>>
        <div class="post-card__img">
          <img src="<?php echo esc_url($imagem ? $imagem['url'] : img_placeholder()); ?>" alt="<?php echo esc_attr($titulo); ?>">
        </div>
        <div class="post-card__corpo">
          <?php if ($detalhe) : ?><span class="post-card__data"><?php echo esc_html($detalhe); ?></span><?php endif; ?>
          <h3><?php echo esc_html($titulo); ?></h3>
          <?php if ($descricao) : ?><p><?php echo esc_html($descricao); ?></p><?php endif; ?>
        </div>
      </<?php echo $tag; ?>>
    </article>
  <?php endforeach;
}

// Grupos da página, na ordem das abas: chave => [campo do nome, campo dos cards]
// (um grupo sem cards não aparece)
$mapa = [
  'personagens' => ['titulo_grupo_personagens', 'cards_trabalhos'],
  'atores'      => ['titulo_grupo_atores', 'cards_atores'],
  'jogos'       => ['titulo_grupo_jogos', 'cards_jogos'],
  'direcao'     => ['titulo_grupo_direcao', 'cards_direcao'],
];
$grupos = [];
foreach ($mapa as $chave => $campos) {
  $cards = tema_lista($campos[1]);
  if ($cards) {
    $grupos[$chave] = ['titulo' => tema_texto($campos[0]), 'cards' => $cards];
  }
}

// Quantos cards por página (se passar disso, aparece a paginação)
$por_pagina = (int) tema_texto('cards_por_pagina');
if ($por_pagina < 1) {
  $por_pagina = 8;
}
?>
<?php get_header(); ?>

<section class="page-hero">
  <div class="container">
    <h2><?php echo esc_html(tema_texto('titulo_pagina_trabalhos')); ?></h2>
  </div>
</section>

<main class="container trabalhos-pagina" data-por-pagina="<?php echo (int) $por_pagina; ?>">

  <?php if (count($grupos) > 1) : ?>
    <div class="trabalhos-abas" role="tablist">
      <?php foreach ($grupos as $chave => $grupo) : ?>
        <button type="button" class="trabalhos-aba" role="tab" data-alvo="<?php echo esc_attr($chave); ?>">
          <?php echo esc_html($grupo['titulo']); ?>
        </button>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <?php foreach ($grupos as $chave => $grupo) : ?>
    <section class="trabalhos-grupo" id="grupo-<?php echo esc_attr($chave); ?>">
      <h2 class="trabalhos-grupo__titulo"><?php echo esc_html($grupo['titulo']); ?></h2>
      <div class="blog__lista">
        <?php tema_cards_trabalhos($grupo['cards']); ?>
      </div>
    </section>
  <?php endforeach; ?>

</main>

<?php get_footer(); ?>
