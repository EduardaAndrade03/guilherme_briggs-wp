<?php
/**
 * Rodapé (redes sociais): vale para o site inteiro, então fica em
 * Aparência > Personalizar > Rodapé – Redes sociais.
 * Os conteúdos das páginas ficam em Páginas > Editar (veja inc/campos.php).
 */

if (!defined('ABSPATH')) {
    exit;
}

function tema_customizer($wp_customize) {
    $wp_customize->add_section('rodape', [
        'title'    => 'Rodapé – Redes sociais',
        'priority' => 30,
    ]);

    $redes = [
        'footer_instagram' => 'Instagram',
        'footer_youtube'   => 'YouTube',
        'footer_x'         => 'X',
        'footer_facebook'  => 'Facebook',
        'footer_tiktok'    => 'TikTok',
    ];

    foreach ($redes as $id => $rotulo) {
        $wp_customize->add_setting($id, [
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ]);
        $wp_customize->add_control($id, [
            'label'   => $rotulo,
            'section' => 'rodape',
            'type'    => 'url',
        ]);
    }
}
add_action('customize_register', 'tema_customizer');
