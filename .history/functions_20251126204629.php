<?php
/**
 * Theme Name: Camisa 10 Child
 * Description: Tema child para Camisa 10 - Versão corrigida
 * Version: 2.0
 * Author: Desenvolvedor Camisa 10
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/* ========================================
   ENQUEUE STYLES E SCRIPTS - ORDEM CORRETA
   ======================================== */
function camisa10_enqueue_assets() {
    // 1. CSS DO TEMA PAI
    wp_enqueue_style(
        'parent-style',
        get_template_directory_uri() . '/style.css',
        array(),
        wp_get_theme()->parent()->get('Version')
    );

    // 2. VARIÁVEIS CSS (PRIMEIRO - BASE DE TUDO)
    wp_enqueue_style(
        'camisa10-variables',
        get_stylesheet_directory_uri() . '/assets/css/custom-variables.css',
        array('parent-style'),
        '2.0.0',
        'all'
    );

    // 3. CUSTOM STYLES (DEPOIS DAS VARIÁVEIS)
    wp_enqueue_style(
        'camisa10-custom-styles',
        get_stylesheet_directory_uri() . '/assets/css/custom-styles.css',
        array('camisa10-variables'),
        '2.0.0',
        'all'
    );

    // 4. HEADER CSS
    wp_enqueue_style(
        'camisa10-header',
        get_stylesheet_directory_uri() . '/assets/css/header.css',
        array('camisa10-variables'),
        '2.0.0',
        'all'
    );

    // 5. HERO BANNER CSS
    wp_enqueue_style(
        'camisa10-hero-banner',
        get_stylesheet_directory_uri() . '/assets/css/hero-banner.css',
        array('camisa10-variables'),
        '2.0.0',
        'all'
    );

    // 6. HOME CSS (apenas na home)
    if (is_page_template('page-home.php') || is_front_page()) {
        wp_enqueue_style(
            'camisa10-home',
            get_stylesheet_directory_uri() . '/assets/css/custom-home.css',
            array('camisa10-variables', 'camisa10-hero-banner'),
            '2.0.0',
            'all'
        );
    }

    // 7. CURSOS SECTION (apenas em páginas de curso)
    if (is_singular('curso') || is_post_type_archive('curso')) {
        wp_enqueue_style(
            'camisa10-cursos-section',
            get_stylesheet_directory_uri() . '/assets/css/cursos-section.css',
            array('camisa10-variables'),
            '2.0.0',
            'all'
        );

        wp_enqueue_style(
            'camisa10-single-curso',
            get_stylesheet_directory_uri() . '/assets/css/single-curso.css',
            array('camisa10-variables'),
            '2.0.0',
            'all'
        );
    }

    // 8. JAVASCRIPT - COM DEPENDÊNCIAS CORRETAS
    
    // Header JS (global)
    wp_enqueue_script(
        'camisa10-header-js',
        get_stylesheet_directory_uri() . '/assets/js/header.js',
        array('jquery'),
        '2.0.0',
        true // Footer
    );

    // Hero Banner JS (global)
    wp_enqueue_script(
        'camisa10-hero-banner-js',
        get_stylesheet_directory_uri() . '/assets/js/hero-banner.js',
        array('jquery'),
        '2.0.0',
        true
    );

    // Home JS (apenas na home)
    if (is_page_template('page-home.php') || is_front_page()) {
        wp_enqueue_script(
            'camisa10-home-js',
            get_stylesheet_directory_uri() . '/assets/js/custom-home.js',
            array('jquery', 'camisa10-hero-banner-js'),
            '2.0.0',
            true
        );
    }

    // Single Curso JS
    if (is_singular('curso')) {
        wp_enqueue_script(
            'camisa10-single-curso-js',
            get_stylesheet_directory_uri() . '/assets/js/single-curso.js',
            array('jquery'),
            '2.0.0',
            true
        );
    }

    // Localizar scripts com variáveis PHP
    wp_localize_script('camisa10-home-js', 'camisa10Ajax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('camisa10_nonce'),
        'siteUrl' => get_site_url(),
    ));
}
add_action('wp_enqueue_scripts', 'camisa10_enqueue_assets', 20);

/* ========================================
   ACF - VALIDAÇÃO E SETUP
   ======================================== */
function camisa10_acf_setup() {
    // Verificar se ACF está ativo
    if (!function_exists('acf_add_options_page')) {
        add_action('admin_notices', function() {
            echo '<div class="notice notice-error"><p><strong>Camisa 10:</strong> O plugin Advanced Custom Fields PRO precisa estar ativo!</p></div>';
        });
        return;
    }

    // Adicionar página de opções
    acf_add_options_page(array(
        'page_title' => 'Configurações Camisa 10',
        'menu_title' => 'Camisa 10',
        'menu_slug' => 'camisa10-settings',
        'capability' => 'edit_posts',
        'icon_url' => 'dashicons-admin-generic',
        'position' => 2,
    ));
}
add_action('acf/init', 'camisa10_acf_setup');

/* ========================================
   CUSTOM POST TYPE: CURSOS
   ======================================== */
function camisa10_register_curso_post_type() {
    $labels = array(
        'name' => 'Cursos',
        'singular_name' => 'Curso',
        'menu_name' => 'Cursos',
        'add_new' => 'Adicionar Novo',
        'add_new_item' => 'Adicionar Novo Curso',
        'edit_item' => 'Editar Curso',
        'new_item' => 'Novo Curso',
        'view_item' => 'Ver Curso',
        'search_items' => 'Buscar Cursos',
        'not_found' => 'Nenhum curso encontrado',
        'not_found_in_trash' => 'Nenhum curso encontrado na lixeira',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-welcome-learn-more',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'rewrite' => array('slug' => 'cursos'),
        'show_in_rest' => true, // Gutenberg
    );

    register_post_type('curso', $args);
}
add_action('init', 'camisa10_register_curso_post_type');

/* ========================================
   HELPER FUNCTIONS - VALIDAÇÃO ACF
   ======================================== */

/**
 * Get ACF field com validação
 * @param string $field Nome do campo
 * @param mixed $post_id ID do post (opcional)
 * @param mixed $default Valor padrão se campo vazio
 * @return mixed
 */
function camisa10_get_field($field, $post_id = false, $default = '') {
    if (!function_exists('get_field')) {
        return $default;
    }

    $value = get_field($field, $post_id);
    
    return !empty($value) ? $value : $default;
}

/**
 * Sanitizar campo de texto ACF
 */
function camisa10_sanitize_text($field, $post_id = false) {
    $value = camisa10_get_field($field, $post_id);
    return !empty($value) ? esc_html($value) : '';
}

/**
 * Sanitizar campo de URL ACF
 */
function camisa10_sanitize_url($field, $post_id = false) {
    $value = camisa10_get_field($field, $post_id);
    return !empty($value) ? esc_url($value) : '';
}

/**
 * Validar imagem ACF
 * @return array|false Array com 'url', 'alt', 'width', 'height' ou false
 */
function camisa10_get_image($field, $post_id = false, $size = 'full') {
    $image = camisa10_get_field($field, $post_id);
    
    if (!$image) {
        return false;
    }

    // Se for ID
    if (is_numeric($image)) {
        $image_data = wp_get_attachment_image_src($image, $size);
        $alt = get_post_meta($image, '_wp_attachment_image_alt', true);
        
        return array(
            'url' => $image_data[0] ?? '',
            'width' => $image_data[1] ?? '',
            'height' => $image_data[2] ?? '',
            'alt' => $alt ?: 'Imagem Camisa 10',
        );
    }

    // Se for array
    if (is_array($image)) {
        return array(
            'url' => $image['url'] ?? '',
            'width' => $image['width'] ?? '',
            'height' => $image['height'] ?? '',
            'alt' => $image['alt'] ?: 'Imagem Camisa 10',
        );
    }

    return false;
}

/* ========================================
   THUMBNAIL SIZES
   ======================================== */
function camisa10_image_sizes() {
    add_image_size('curso-thumb', 600, 400, true);
    add_image_size('curso-hero', 1920, 800, true);
    add_image_size('curso-card', 400, 300, true);
}
add_action('after_setup_theme', 'camisa10_image_sizes');

/* ========================================
   LIMPAR HEAD
   ======================================== */
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');

/* ========================================
   FLUSH REWRITE RULES (apenas uma vez)
   ======================================== */
function camisa10_flush_rewrites() {
    if (get_option('camisa10_flush_rewrite_rules') !== 'yes') {
        flush_rewrite_rules();
        update_option('camisa10_flush_rewrite_rules', 'yes');
    }
}
add_action('init', 'camisa10_flush_rewrites', 999);
