<?php
function meu_tema_setup() {
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('html5', ['search-form', 'gallery', 'caption']);
  register_nav_menus(['principal' => 'Menu Principal']);
}
add_action('after_setup_theme', 'meu_tema_setup');

function meu_tema_assets() {
  wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@400;600;700&display=swap');
  // wp_enqueue_style('meu-tema-style', get_stylesheet_uri(), [], '1.0');
  wp_enqueue_style('meu-tema-style', get_stylesheet_uri(), [], time());
  // wp_enqueue_style('meu-tema-main', get_template_directory_uri() . '/assets/css/main.css', [], '1.0');
  wp_enqueue_style('meu-tema-main', get_template_directory_uri() . '/assets/css/main.css', [], time());
  // wp_enqueue_script('meu-tema-js', get_template_directory_uri() . '/assets/js/main.js', [], '1.0', true);
  wp_enqueue_script('meu-tema-js', get_template_directory_uri() . '/assets/js/main.js', [], time(), true);
}
add_action('wp_enqueue_scripts', 'meu_tema_assets');

function img_placeholder() {
    return get_template_directory_uri() . '/assets/img/placeholder.jpg';
}

// Campos editáveis nas páginas (Páginas > Editar)
require_once get_template_directory() . '/inc/campos.php';

// Rodapé editável (Aparência > Personalizar)
require_once get_template_directory() . '/inc/customizer.php';
