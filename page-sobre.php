<?php get_header(); ?>

<main class="container">

    <section class="apresentacao">
        <p><?php echo esc_html(tema_texto('sobre_apresentacao')); ?></p>
    </section>

    <section class="biografia">
        <div class="biografia__texto">
            <h2><?php echo esc_html(tema_texto('biografia_titulo')); ?></h2>

             <div class="biografia_paragrafos">
                <?php foreach (tema_lista('biografia') as $paragrafo) : ?>
                    <p><?php echo esc_html(isset($paragrafo['texto']) ? $paragrafo['texto'] : ''); ?></p>
                <?php endforeach; ?>
            </div>
        </div>

        <aside class="sobre-ficha">
            <h2><?php echo esc_html(tema_texto('ficha_nome')); ?></h2>
            <figure class="sobre-ficha__foto">
                <?php $imagem = tema_imagem('ficha_img'); ?>
                <?php $legenda = tema_texto('ficha_legenda'); ?>
                <img src="<?php echo esc_url($imagem ? $imagem['url'] : img_placeholder()); ?>" alt="<?php echo esc_attr($legenda ? $legenda : 'Imagem padrão'); ?>">
                <?php if ($legenda) : ?><figcaption><?php echo esc_html($legenda); ?></figcaption><?php endif; ?>
            </figure>
            <dl class="sobre-ficha__dados">
                <div>
                    <dt>Nome completo</dt>
                    <dd><?php echo esc_html(tema_texto('dados_nome')); ?></dd>
                </div>
                <div>
                    <dt>Nascimento</dt>
                    <dd><?php echo esc_html(tema_texto('dados_dtnasc')); ?></dd>
                </div>
                <div>
                    <dt>Residência</dt>
                    <dd><?php echo esc_html(tema_texto('dados_residencia')); ?></dd>
                </div>
                <div>
                    <dt>Nacionalidade</dt>
                    <dd><?php echo esc_html(tema_texto('dados_nacionalidade')); ?></dd>
                </div>
                <div>
                    <dt>Progenitores</dt>
                    <dd>
                        <p>Mãe: <?php echo esc_html(tema_texto('dados_mae')); ?></p>
                        <p>Pai: <?php echo esc_html(tema_texto('dados_pai')); ?></p>
                    </dd>
                </div>
                <div>
                    <dt>Cônjuge</dt>
                    <dd><?php echo esc_html(tema_texto('dados_conjuge')); ?></dd>
                </div>
                <div>
                    <dt>Ocupação</dt>
                    <dd><?php echo esc_html(tema_texto('dados_ocupacao')); ?></dd>
                </div>
            </dl>
        </aside>
    </section>
    <section class="linhaTempo">
        <h2><?php echo esc_html(tema_texto('titulo_carreira')); ?></h2>
        <div class="linhaTempo__lista">
            <?php foreach (tema_lista('carreira') as $linha) :
                $ano   = isset($linha['ano']) ? $linha['ano'] : '';
                $texto = isset($linha['texto']) ? $linha['texto'] : '';
                if ($ano || $texto) : ?>
                <div class="linhaTempo__item">
                    <?php if ($ano) : ?>
                        <h3><?php echo esc_html($ano); ?></h3>
                    <?php endif; ?>
                    <?php if ($texto) : ?>
                        <p><?php echo esc_html($texto); ?></p>
                    <?php endif; ?>
                </div>
            <?php endif; endforeach; ?>
        </div>
    </section>

    <section class="premios">
        <h2><?php echo esc_html(tema_texto('titulo_premios')); ?></h2>
        <div class="premios__grid">
            <?php foreach (tema_lista('premios') as $premio) :
                $nome  = isset($premio['nome']) ? $premio['nome'] : '';
                $itens = tema_premio_itens(isset($premio['itens']) ? $premio['itens'] : '');
                if ($nome || $itens) : ?>
                <article class="premio">
                    <h3><?php echo esc_html($nome); ?></h3>
                    <ul>
                        <?php foreach ($itens as $item) : ?>
                            <li>
                                <?php if ($item['ano']) : ?><span><?php echo esc_html($item['ano']); ?></span> <?php endif; ?>
                                <?php echo esc_html($item['texto']); ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </article>
            <?php endif; endforeach; ?>
        </div>
    </section>

</main>

<?php get_footer(); ?>