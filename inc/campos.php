<?php
/**
 * Campos editáveis direto na tela de edição das PÁGINAS (Páginas > Editar).
 * Sem plugin: usa só meta boxes e post meta do WordPress.
 *
 * Para criar um campo novo, adicione uma linha em tema_paginas():
 *   'id_do_campo' => ['tipo', 'Rótulo no painel', 'texto padrão (opcional)']
 * Tipos: text | textarea | url | imagem | lista
 *
 * "lista" é um campo repetível: no painel aparece o botão "Adicionar" e você
 * cria quantas linhas quiser (usado na linha do tempo, nos prêmios, etc.).
 *   'id' => ['lista', 'Rótulo', [linhas padrão], ['botao' => 'Adicionar X', 'campos' => [
 *       'sub_id' => ['tipo', 'Rótulo'],
 *   ]]]
 */

if (!defined('ABSPATH')) {
    exit;
}

/* ------------------------------------------------------------------
 * 1) Páginas e campos (uma única fonte de verdade)
 * ------------------------------------------------------------------ */
function tema_paginas() {

    $premios_padrao = [
        [
            'nome'  => 'Crunchyroll Anime Awards',
            'itens' => "2024 | Melhor Atuação de Voz (Português - Brasil) — Brook em One Piece",
        ],
        [
            'nome'  => 'Prêmio da Dublagem Carioca',
            'itens' => "2012 | Melhor Direção de Filme para Cinema por Rio",
        ],
        [
            'nome'  => 'Prêmio Top Blog',
            'itens' => "2011 | Melhor Blog de Humor (júri popular e júri acadêmico)\n2009 | Melhor Blog de Humor (júri popular e júri acadêmico)",
        ],
        [
            'nome'  => 'Prêmio Yamato',
            'itens' => "2010 | Melhor Dublador de Protagonista — Os Fantasmas de Scrooge\n2003 | Melhor Dublador de Coadjuvante — Professor Hiragi em Os Cavaleiros de Mon Colle",
        ],
    ];

    // Linhas de exemplo (sem imagem: enquanto nenhuma imagem for escolhida, aparece a placeholder).
    $trabalhos_padrao = [];
    $cards_padrao = [];
    $atores_padrao = [];
    for ($n = 1; $n <= 5; $n++) {
        $trabalhos_padrao[] = ['imagem' => '', 'legenda' => 'Trabalho ' . $n];
        $cards_padrao[]     = ['imagem' => '', 'detalhe' => '', 'titulo' => 'Trabalho ' . $n, 'descricao' => '', 'link' => ''];
    }
    $jogos_padrao = [];
    $direcao_padrao = [];
    for ($n = 1; $n <= 3; $n++) {
        $atores_padrao[] = ['imagem' => '', 'detalhe' => '', 'titulo' => 'Ator ' . $n, 'descricao' => '', 'link' => ''];
    }
    for ($n = 1; $n <= 2; $n++) {
        $jogos_padrao[]   = ['imagem' => '', 'detalhe' => '', 'titulo' => 'Jogo ' . $n, 'descricao' => '', 'link' => ''];
        $direcao_padrao[] = ['imagem' => '', 'detalhe' => '', 'titulo' => 'Direção ' . $n, 'descricao' => '', 'link' => ''];
    }

    // Campos de cada card da página Trabalhos (iguais nos dois grupos).
    $campos_card = [
        'imagem'    => ['imagem', 'Imagem'],
        'detalhe'   => ['text', 'Linha pequena em amarelo (ex.: ano ou personagem) – opcional'],
        'titulo'    => ['text', 'Título'],
        'descricao' => ['textarea', 'Descrição'],
        'link'      => ['url', 'Link do card (opcional)'],
    ];

    return [

        'inicio' => [
            'titulo' => 'Início',
            'slugs'  => ['inicio', 'home'],
            'caixas' => [
                'Imagem de topo' => [
                    'hero_img' => ['imagem', 'Imagem de fundo do topo'],
                ],
                'Quem é' => [
                    'titulo_sobre' => ['text', 'Título', 'QUEM É GUILHERME BRIGGS'],
                    'texto_sobre'  => ['textarea', 'Texto'],
                    'botao_sobre'  => ['text', 'Texto do botão', 'Saiba mais'],
                    'link_sobre'   => ['url', 'Link do botão', home_url('/sobre/')],
                    'imagem_sobre' => ['imagem', 'Imagem'],
                ],
                'Trabalhos' => [
                    'titulo_trabalhos' => ['text', 'Título', 'ALGUNS TRABALHOS'],
                    'texto_trabalhos'  => ['textarea', 'Texto'],
                    'trabalhos'        => ['lista', 'Trabalhos', $trabalhos_padrao, [
                        'botao'  => 'Adicionar trabalho',
                        'campos' => [
                            'imagem'  => ['imagem', 'Imagem'],
                            'legenda' => ['text', 'Legenda'],
                        ],
                    ]],
                    'botao_trabalhos' => ['text', 'Texto do botão', 'Ver trabalhos'],
                    'link_trabalhos'  => ['url', 'Link do botão', home_url('/trabalhos/')],
                ],
                'Últimos posts' => [
                    'titulo_posts' => ['text', 'Título', 'ÚLTIMOS POSTS'],
                    'botao_posts'  => ['text', 'Texto do botão', 'Ver todos os posts'],
                ],
            ],
        ],

        'sobre' => [
            'titulo' => 'Sobre',
            'slugs'  => ['sobre'],
            'caixas' => [
                'Apresentação e biografia' => [
                    'sobre_apresentacao' => ['textarea', 'Texto de apresentação'],
                    'biografia_titulo'   => ['text', 'Título da biografia', 'BIOGRAFIA'],
                    'biografia'          => ['lista', 'Parágrafos da biografia', [], [
                        'botao'  => 'Adicionar parágrafo',
                        'campos' => [
                            'texto' => ['textarea', 'Parágrafo'],
                        ],
                    ]],
                ],
                'Ficha' => [
                    'ficha_nome'          => ['text', 'Nome (título da ficha)'],
                    'ficha_img'           => ['imagem', 'Foto'],
                    'ficha_legenda'       => ['text', 'Legenda da foto'],
                    'dados_nome'          => ['text', 'Nome completo'],
                    'dados_dtnasc'        => ['text', 'Nascimento'],
                    'dados_residencia'    => ['text', 'Residência'],
                    'dados_nacionalidade' => ['text', 'Nacionalidade'],
                    'dados_mae'           => ['text', 'Mãe'],
                    'dados_pai'           => ['text', 'Pai'],
                    'dados_conjuge'       => ['text', 'Cônjuge'],
                    'dados_ocupacao'      => ['text', 'Ocupação'],
                ],
                'Linha do tempo' => [
                    'titulo_carreira' => ['text', 'Título da seção', 'Linha do tempo'],
                    'carreira'        => ['lista', 'Itens da linha do tempo', [], [
                        'botao'  => 'Adicionar linha',
                        'resumo' => ['ano', 'texto'],
                        'campos' => [
                            'ano'   => ['text', 'Ano'],
                            'texto' => ['textarea', 'Texto'],
                        ],
                    ]],
                ],
                'Prêmios' => [
                    'titulo_premios' => ['text', 'Título da seção', 'Prêmios'],
                    'premios'        => ['lista', 'Prêmios', $premios_padrao, [
                        'botao'  => 'Adicionar prêmio',
                        'campos' => [
                            'nome'  => ['text', 'Nome do prêmio'],
                            'itens' => ['textarea', 'Itens: uma linha por item, no formato  ano | descrição'],
                        ],
                    ]],
                ],
            ],
        ],

        'trabalhos' => [
            'titulo' => 'Trabalhos',
            'slugs'  => ['trabalhos'],
            'caixas' => [
                'Configurações da página' => [
                    'titulo_pagina_trabalhos' => ['text', 'Título da página', 'TRABALHOS'],
                    'cards_por_pagina'        => ['numero', 'Cards por página (passando disso, aparece a paginação)', '8'],
                ],
                'Personagens' => [
                    'titulo_grupo_personagens' => ['text', 'Nome do grupo (aparece na aba)', 'Personagens'],
                    'cards_trabalhos' => ['lista', 'Cards deste grupo', $cards_padrao, [
                        'botao'  => 'Adicionar card',
                        'resumo' => ['titulo'],
                        'campos' => $campos_card,
                    ]],
                ],
                'Atores' => [
                    'titulo_grupo_atores' => ['text', 'Nome do grupo (aparece na aba)', 'Atores'],
                    'cards_atores' => ['lista', 'Cards deste grupo', $atores_padrao, [
                        'botao'  => 'Adicionar card',
                        'resumo' => ['titulo'],
                        'campos' => $campos_card,
                    ]],
                ],
                'Jogos' => [
                    'titulo_grupo_jogos' => ['text', 'Nome do grupo (aparece na aba)', 'Jogos'],
                    'cards_jogos' => ['lista', 'Cards deste grupo', $jogos_padrao, [
                        'botao'  => 'Adicionar card',
                        'resumo' => ['titulo'],
                        'campos' => $campos_card,
                    ]],
                ],
                'Direção de dublagem' => [
                    'titulo_grupo_direcao' => ['text', 'Nome do grupo (aparece na aba)', 'Direção de dublagem'],
                    'cards_direcao' => ['lista', 'Cards deste grupo', $direcao_padrao, [
                        'botao'  => 'Adicionar card',
                        'resumo' => ['titulo'],
                        'campos' => $campos_card,
                    ]],
                ],
            ],
        ],

        'contato' => [
            'titulo' => 'Contato',
            'slugs'  => ['contato', 'contatos'],
            'caixas' => [
                'Contato' => [
                    'titulo_contato'    => ['text', 'Título', 'ENTRE EM CONTATO'],
                    'img_contato'       => ['imagem', 'Imagem'],
                    'link_youtube'      => ['url', 'YouTube – link'],
                    'contato_youtube'   => ['text', 'YouTube – texto exibido'],
                    'link_instagram'    => ['url', 'Instagram – link'],
                    'contato_instagram' => ['text', 'Instagram – texto exibido'],
                    'link_x'            => ['url', 'X – link'],
                    'contato_x'         => ['text', 'X – texto exibido'],
                    'link_facebook'     => ['url', 'Facebook – link'],
                    'contato_facebook'  => ['text', 'Facebook – texto exibido'],
                    'link_tiktok'       => ['url', 'TikTok – link'],
                    'contato_tiktok'    => ['text', 'TikTok – texto exibido'],
                    'contato_email'     => ['text', 'E-mail'],
                ],
            ],
        ],

        'blog' => [
            'titulo' => 'Blog',
            'slugs'  => ['blog'],
            'caixas' => [
                'Título' => [
                    'titulo_blog' => ['text', 'Título da página', 'BLOG'],
                ],
            ],
        ],
    ];
}

/* ------------------------------------------------------------------
 * 2) Descobre qual página do tema é a página sendo editada/exibida
 * ------------------------------------------------------------------ */

// ID da página de cada seção (Início = página inicial; Blog = página de posts; as outras pelo slug).
function tema_pagina_id($chave) {
    static $cache = [];
    if (isset($cache[$chave])) {
        return $cache[$chave];
    }

    $paginas = tema_paginas();
    $id = 0;

    if ($chave === 'inicio') {
        $id = (int) get_option('page_on_front');
    } elseif ($chave === 'blog') {
        $id = (int) get_option('page_for_posts');
    }

    if (!$id && isset($paginas[$chave])) {
        foreach ($paginas[$chave]['slugs'] as $slug) {
            $pagina = get_page_by_path($slug);
            if ($pagina) {
                $id = (int) $pagina->ID;
                break;
            }
        }
    }

    $cache[$chave] = $id;
    return $id;
}

function tema_chave_da_pagina($post_id) {
    foreach (array_keys(tema_paginas()) as $chave) {
        if (tema_pagina_id($chave) === (int) $post_id) {
            return $chave;
        }
    }
    return '';
}

// Todos os campos (de todas as caixas) de uma página, em uma lista só.
function tema_campos_da_pagina($chave) {
    $paginas = tema_paginas();
    $todos = [];
    if (isset($paginas[$chave])) {
        foreach ($paginas[$chave]['caixas'] as $campos) {
            $todos = array_merge($todos, $campos);
        }
    }
    return $todos;
}

// Mapa id_do_campo => [chave_da_pagina, campo]
function tema_campo_info($id) {
    static $mapa = null;
    if ($mapa === null) {
        $mapa = [];
        foreach (array_keys(tema_paginas()) as $chave) {
            foreach (tema_campos_da_pagina($chave) as $cid => $campo) {
                $mapa[$cid] = [$chave, $campo];
            }
        }
    }
    return isset($mapa[$id]) ? $mapa[$id] : null;
}

/* ------------------------------------------------------------------
 * 3) Caixas na tela de edição da página
 * ------------------------------------------------------------------ */
function tema_add_meta_boxes($post_type, $post) {
    if ($post_type !== 'page' || !$post) {
        return;
    }
    $chave = tema_chave_da_pagina($post->ID);
    if (!$chave) {
        return;
    }
    $paginas = tema_paginas();
    foreach ($paginas[$chave]['caixas'] as $titulo => $campos) {
        add_meta_box(
            'tema_' . sanitize_title($titulo),
            $paginas[$chave]['titulo'] . ' – ' . $titulo,
            'tema_render_caixa',
            'page',
            'normal',
            'high',
            ['campos' => $campos]
        );
    }
}
add_action('add_meta_boxes', 'tema_add_meta_boxes', 10, 2);

function tema_render_caixa($post, $caixa) {
    wp_nonce_field('tema_salvar', 'tema_nonce', false);
    foreach ($caixa['args']['campos'] as $id => $campo) {
        tema_render_campo('tema[' . $id . ']', $campo, tema_valor_salvo($post->ID, $id, $campo));
    }
}

// Valor salvo no painel; se nunca foi salvo, mostra o padrão.
function tema_valor_salvo($post_id, $id, $campo) {
    $meta = '_tema_' . $id;
    if (metadata_exists('post', $post_id, $meta)) {
        return get_post_meta($post_id, $meta, true);
    }
    if (isset($campo[2])) {
        return $campo[2];
    }
    return $campo[0] === 'lista' ? [] : '';
}

function tema_render_campo($nome, $campo, $valor) {
    $tipo = $campo[0];

    echo '<div class="tema-campo">';
    echo '<label class="tema-rotulo">' . esc_html($campo[1]) . '</label>';

    if ($tipo === 'textarea') {
        echo '<textarea name="' . esc_attr($nome) . '" rows="4">' . esc_textarea($valor) . '</textarea>';
    } elseif ($tipo === 'imagem') {
        tema_render_imagem($nome, $valor);
    } elseif ($tipo === 'lista') {
        tema_render_lista($nome, $campo, $valor);
    } elseif ($tipo === 'numero') {
        echo '<input type="number" min="1" max="50" style="width:100px" name="' . esc_attr($nome) . '" value="' . esc_attr($valor) . '">';
    } else {
        $html_type = ($tipo === 'url') ? 'url' : 'text';
        echo '<input type="' . $html_type . '" name="' . esc_attr($nome) . '" value="' . esc_attr($valor) . '">';
    }

    echo '</div>';
}

function tema_render_imagem($nome, $valor) {
    $url = '';
    $guardar = '';
    if (is_numeric($valor) && absint($valor)) {
        $guardar = absint($valor);
        $url = wp_get_attachment_image_url($guardar, 'medium');
    } elseif (tema_caminho_valido($valor)) {
        $guardar = $valor;
        $url = get_template_directory_uri() . '/' . $valor;
    }
    $anexo = $url ? $guardar : '';

    echo '<div class="tema-img">';
    echo '<input type="hidden" name="' . esc_attr($nome) . '" value="' . esc_attr($anexo) . '">';
    echo '<div class="tema-img-previa">';
    if ($url) {
        echo '<img src="' . esc_url($url) . '" alt="">';
    }
    echo '</div>';
    echo '<button type="button" class="button tema-img-escolher">Escolher imagem</button> ';
    echo '<button type="button" class="button tema-img-remover"' . ($anexo ? '' : ' style="display:none"') . '>Remover</button>';
    echo '</div>';
}

// Texto que aparece no título do item fechado (ex.: o nome do prêmio).
function tema_resumo_linha($linha, $ids) {
    $partes = [];
    foreach ($ids as $sid) {
        $v = (isset($linha[$sid]) && is_string($linha[$sid])) ? trim(wp_strip_all_tags($linha[$sid])) : '';
        if ($v !== '') {
            $partes[] = $v;
        }
    }
    $texto = implode(' — ', $partes);
    return mb_strlen($texto) > 60 ? mb_substr($texto, 0, 60) . '…' : $texto;
}

function tema_render_lista($nome, $campo, $linhas) {
    $extra  = isset($campo[3]) ? $campo[3] : [];
    $sub    = isset($extra['campos']) ? $extra['campos'] : [];
    $botao  = isset($extra['botao']) ? $extra['botao'] : 'Adicionar item';
    $linhas = is_array($linhas) ? array_values($linhas) : [];

    // Campos usados no título do item fechado (padrão: o primeiro campo de texto).
    $resumo = isset($extra['resumo']) ? $extra['resumo'] : [];
    if (!$resumo) {
        foreach ($sub as $sid => $scampo) {
            if ($scampo[0] === 'text' || $scampo[0] === 'textarea') {
                $resumo = [$sid];
                break;
            }
        }
    }

    echo '<div class="tema-lista" data-prox="' . count($linhas) . '" data-resumo="' . esc_attr(implode(',', $resumo)) . '">';
    // Garante que, se todas as linhas forem removidas, a lista salva vazia.
    echo '<input type="hidden" name="' . esc_attr($nome) . '" value="">';

    echo '<div class="tema-lista-linhas">';
    foreach ($linhas as $n => $linha) {
        tema_render_linha($nome, $n, $sub, $linha, $resumo, false);
    }
    echo '</div>';

    // Modelo de linha em branco, já aberta (o JavaScript troca __N__ pelo número da nova linha).
    echo '<script type="text/template" class="tema-modelo">';
    tema_render_linha($nome, '__N__', $sub, [], $resumo, true);
    echo '</script>';

    echo '<button type="button" class="button tema-lista-add">+ ' . esc_html($botao) . '</button>';
    echo '</div>';
}

function tema_render_linha($nome, $n, $sub, $linha, $resumo, $aberta) {
    $titulo = tema_resumo_linha($linha, $resumo);

    echo '<div class="tema-linha' . ($aberta ? '' : ' is-fechada') . '">';
    echo '<div class="tema-linha-topo">';
    echo '<button type="button" class="tema-linha-toggle"><span class="tema-linha-seta"></span>';
    echo '<span class="tema-linha-resumo">' . esc_html($titulo !== '' ? $titulo : 'Novo item') . '</span></button>';
    echo '<span class="tema-linha-acoes">';
    echo '<button type="button" class="button-link tema-linha-subir" title="Subir">↑</button>';
    echo '<button type="button" class="button-link tema-linha-descer" title="Descer">↓</button>';
    echo '<button type="button" class="button-link tema-linha-remover">Remover</button>';
    echo '</span>';
    echo '</div>';
    echo '<div class="tema-linha-corpo">';
    foreach ($sub as $sid => $scampo) {
        $valor = isset($linha[$sid]) ? $linha[$sid] : '';
        tema_render_campo($nome . '[' . $n . '][' . $sid . ']', $scampo, $valor);
    }
    echo '</div>';
    echo '</div>';
}

// Scripts e estilos só na tela de edição de páginas.
function tema_admin_assets($hook) {
    if (!in_array($hook, ['post.php', 'post-new.php'], true)) {
        return;
    }
    $tela = get_current_screen();
    if (!$tela || $tela->post_type !== 'page') {
        return;
    }
    wp_enqueue_media();
    wp_enqueue_style('tema-admin-campos', get_template_directory_uri() . '/assets/css/admin-campos.css', [], time());
    wp_enqueue_script('tema-admin-campos', get_template_directory_uri() . '/assets/js/admin-campos.js', ['jquery'], time(), true);
}
add_action('admin_enqueue_scripts', 'tema_admin_assets');

// Aceita só caminhos de imagem dentro de assets/img do tema (segurança).
function tema_caminho_valido($valor) {
    return is_string($valor)
        && strpos($valor, '..') === false
        && preg_match('#^assets/img/[A-Za-z0-9_\-/\.]+$#', $valor) === 1;
}

// Nas páginas do tema o conteúdo vem das caixas abaixo; o editor grande não é usado e atrapalha.
// (Para voltar a mostrar o editor, apague esta função e a linha add_action logo abaixo dela.)
function tema_esconder_editor() {
    $post_id = isset($_GET['post']) ? absint($_GET['post']) : 0;
    if ($post_id && tema_chave_da_pagina($post_id)) {
        remove_post_type_support('page', 'editor');
    }
}
add_action('admin_init', 'tema_esconder_editor');

/* ------------------------------------------------------------------
 * 4) Salvar
 * ------------------------------------------------------------------ */
function tema_limpar($campo, $valor) {
    $tipo = $campo[0];

    if ($tipo !== 'lista' && is_array($valor)) {
        return '';
    }

    switch ($tipo) {
        case 'textarea':
            return sanitize_textarea_field($valor);
        case 'url':
            return esc_url_raw($valor);
        case 'numero':
            return min(50, absint($valor));
        case 'imagem':
            if (is_numeric($valor)) {
                return absint($valor);
            }
            return tema_caminho_valido($valor) ? $valor : 0;
        case 'lista':
            $sub = isset($campo[3]['campos']) ? $campo[3]['campos'] : [];
            $saida = [];
            if (is_array($valor)) {
                foreach ($valor as $linha) {
                    if (!is_array($linha)) {
                        continue;
                    }
                    $nova = [];
                    $tem_conteudo = false;
                    foreach ($sub as $sid => $scampo) {
                        $v = isset($linha[$sid]) ? tema_limpar($scampo, $linha[$sid]) : '';
                        if ($v !== '' && $v !== 0) {
                            $tem_conteudo = true;
                        }
                        $nova[$sid] = $v;
                    }
                    if ($tem_conteudo) {
                        $saida[] = $nova;
                    }
                }
            }
            return $saida;
        default:
            return sanitize_text_field($valor);
    }
}

function tema_salvar($post_id) {
    if (!isset($_POST['tema_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['tema_nonce'])), 'tema_salvar')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (wp_is_post_revision($post_id) || !current_user_can('edit_post', $post_id)) {
        return;
    }

    $chave = tema_chave_da_pagina($post_id);
    if (!$chave) {
        return;
    }

    $enviado = (isset($_POST['tema']) && is_array($_POST['tema'])) ? wp_unslash($_POST['tema']) : [];

    foreach (tema_campos_da_pagina($chave) as $id => $campo) {
        $valor = isset($enviado[$id]) ? $enviado[$id] : '';
        update_post_meta($post_id, '_tema_' . $id, tema_limpar($campo, $valor));
    }
}
add_action('save_post_page', 'tema_salvar');

/* ------------------------------------------------------------------
 * 5) Funções usadas nos templates (substituem o get_field do ACF)
 * ------------------------------------------------------------------ */

// Valor bruto de um campo da página (ou o padrão, se nunca foi salvo).
function tema_bruto($id) {
    $info = tema_campo_info($id);
    if (!$info) {
        return null;
    }
    $campo  = $info[1];
    $padrao = isset($campo[2]) ? $campo[2] : ($campo[0] === 'lista' ? [] : '');

    $post_id = tema_pagina_id($info[0]);
    if (!$post_id) {
        return $padrao;
    }

    $meta = '_tema_' . $id;
    if (!metadata_exists('post', $post_id, $meta)) {
        return $padrao;
    }
    return get_post_meta($post_id, $meta, true);
}

// Texto ou link de um campo. Se estiver vazio, usa o texto padrão.
// Campos que não são de página (rodapé) vêm do Personalizar.
function tema_texto($id) {
    $info = tema_campo_info($id);
    if (!$info) {
        return get_theme_mod($id, '');
    }
    $valor = tema_bruto($id);
    if ($valor === '' || $valor === null) {
        return isset($info[1][2]) ? $info[1][2] : '';
    }
    return $valor;
}

// Dados de um anexo (imagem da biblioteca): ['url' => ..., 'alt' => ...] ou null.
function tema_anexo($anexo) {
    // Caminho de uma imagem que já vem dentro do tema (ex.: assets/img/inicio/sobre.jpg)
    if (!is_numeric($anexo)) {
        if (tema_caminho_valido($anexo) && file_exists(get_template_directory() . '/' . $anexo)) {
            return ['url' => get_template_directory_uri() . '/' . $anexo, 'alt' => ''];
        }
        return null;
    }
    $anexo = absint($anexo);
    if (!$anexo) {
        return null;
    }
    $url = wp_get_attachment_image_url($anexo, 'full');
    if (!$url) {
        return null;
    }
    return [
        'url' => $url,
        'alt' => get_post_meta($anexo, '_wp_attachment_image_alt', true),
    ];
}

// Imagem de um campo: ['url' => ..., 'alt' => ...] ou null se não tiver imagem.
function tema_imagem($id) {
    return tema_anexo(tema_bruto($id));
}

// Linhas de um campo do tipo lista (array de arrays).
function tema_lista($id) {
    $valor = tema_bruto($id);
    return is_array($valor) ? $valor : [];
}

// Prêmios: transforma as linhas "ano | descrição" em uma lista de itens.
function tema_premio_itens($texto) {
    $itens = [];
    foreach (preg_split('/\r\n|\r|\n/', trim((string) $texto)) as $linha) {
        $linha = trim($linha);
        if ($linha === '') {
            continue;
        }
        $partes = array_map('trim', explode('|', $linha, 2));
        $itens[] = count($partes) === 2
            ? ['ano' => $partes[0], 'texto' => $partes[1]]
            : ['ano' => '', 'texto' => $partes[0]];
    }
    return $itens;
}
