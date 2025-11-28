<?php
/**
 * Theme functions
 * @package Camisa10 Child
 * @version 8.5.0 - HEADER CSS/JS ADICIONADOS
 */

// ============================================
// 1. ESTILOS GLOBAIS (TODAS AS PÁGINAS)
// ============================================
function camisa10_enqueue_styles() {
    // Tema pai
    wp_enqueue_style(
        'onekorse-parent',
        get_template_directory_uri() . '/style.css',
        array(),
        wp_get_theme()->parent()->get('Version')
    );
}
add_action('wp_enqueue_scripts', 'camisa10_enqueue_styles', 10);

// ============================================
// 2. CSS E JS GLOBAIS (HEADER, FOOTER, ETC)
// Carrega em TODAS as páginas
// ============================================
function camisa10_global_assets() {
    // 1. CSS VARIABLES (base para tudo)
    wp_enqueue_style(
        'camisa10-variables',
        get_stylesheet_directory_uri() . '/assets/css/custom-variables.css',
        array(),
        filemtime(get_stylesheet_directory() . '/assets/css/custom-variables.css')
    );
    
    // 2. HEADER CSS (agora carrega!)
    wp_enqueue_style(
        'camisa10-header',
        get_stylesheet_directory_uri() . '/assets/css/header.css',
        array('camisa10-variables'),
        filemtime(get_stylesheet_directory() . '/assets/css/header.css')
    );
    
    // 3. CUSTOM STYLES CSS (estilos gerais)
    wp_enqueue_style(
        'camisa10-custom-styles',
        get_stylesheet_directory_uri() . '/assets/css/custom-styles.css',
        array('camisa10-header'),
        filemtime(get_stylesheet_directory() . '/assets/css/custom-styles.css')
    );
    
    // 4. FONT AWESOME (ícones)
    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css',
        array(),
        '6.4.0'
    );
    
    // 5. HEADER JS (agora carrega!)
    wp_enqueue_script(
        'camisa10-header-js',
        get_stylesheet_directory_uri() . '/assets/js/header.js',
        array('jquery'),
        filemtime(get_stylesheet_directory() . '/assets/js/header.js'),
        true // Carrega no footer
    );
}
add_action('wp_enqueue_scripts', 'camisa10_global_assets', 15);

// ============================================
// 3. ASSETS ESPECÍFICOS DA HOMEPAGE
// ============================================
function camisa10_home_assets() {
    if (!is_page_template('page-home.php') && !is_front_page()) {
        return;
    }
    
    // BOOTSTRAP CSS
    wp_register_style(
        'bootstrap',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css',
        array(),
        '5.3.0'
    );
    wp_enqueue_style('bootstrap');
    
    // HERO BANNER CSS
    wp_enqueue_style(
        'camisa10-hero-banner-css',
        get_stylesheet_directory_uri() . '/assets/css/hero-banner.css',
        array('camisa10-variables'),
        filemtime(get_stylesheet_directory() . '/assets/css/hero-banner.css')
    );
    
    // CUSTOM HOME CSS
    wp_enqueue_style(
        'camisa10-home-css',
        get_stylesheet_directory_uri() . '/assets/css/custom-home.css',
        array('camisa10-hero-banner-css'),
        filemtime(get_stylesheet_directory() . '/assets/css/custom-home.css')
    );
    
    // SLICK SLIDER CSS
    wp_enqueue_style(
        'slick-css',
        'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css',
        array(),
        '1.8.1'
    );
    
    // BOOTSTRAP JS
    wp_register_script(
        'bootstrap',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js',
        array('jquery'),
        '5.3.0',
        true
    );
    wp_enqueue_script('bootstrap');
    
    // SLICK SLIDER JS
    wp_enqueue_script(
        'slick-js',
        'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js',
        array('jquery'),
        '1.8.1',
        true
    );
    
    // HERO BANNER JS
    wp_enqueue_script(
        'camisa10-hero-banner-js',
        get_stylesheet_directory_uri() . '/assets/js/hero-banner.js',
        array('jquery', 'bootstrap'),
        filemtime(get_stylesheet_directory() . '/assets/js/hero-banner.js'),
        true
    );
    
    // CUSTOM HOME JS
    wp_enqueue_script(
        'camisa10-home-js',
        get_stylesheet_directory_uri() . '/assets/js/custom-home.js',
        array('jquery', 'bootstrap', 'slick-js'),
        filemtime(get_stylesheet_directory() . '/assets/js/custom-home.js'),
        true
    );
}
add_action('wp_enqueue_scripts', 'camisa10_home_assets', 20);

// ============================================
// 4. ASSETS DO SINGLE CURSO
// ============================================
function camisa10_single_curso_assets() {
    if (!is_singular('curso')) {
        return;
    }
    
    $vars_version = filemtime(get_stylesheet_directory() . '/assets/css/custom-variables.css');
    $curso_version = filemtime(get_stylesheet_directory() . '/assets/css/single-curso.css');
    $cursos_section_version = filemtime(get_stylesheet_directory() . '/assets/css/cursos-section.css');
    
    // BOOTSTRAP CSS
    wp_register_style(
        'bootstrap',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css',
        array(),
        '5.3.0'
    );
    wp_enqueue_style('bootstrap');
    
    // CURSOS SECTION CSS
    wp_enqueue_style(
        'camisa10-cursos-section-css',
        get_stylesheet_directory_uri() . '/assets/css/cursos-section.css',
        array('camisa10-variables'),
        $cursos_section_version
    );
    
    // SINGLE CURSO CSS
    wp_enqueue_style(
        'camisa10-curso-css',
        get_stylesheet_directory_uri() . '/assets/css/single-curso.css',
        array('camisa10-cursos-section-css', 'font-awesome'),
        $curso_version
    );
    
    // BOOTSTRAP JS
    wp_register_script(
        'bootstrap',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js',
        array('jquery'),
        '5.3.0',
        true
    );
    wp_enqueue_script('bootstrap');
    
    // SINGLE CURSO JS
    $curso_js_version = filemtime(get_stylesheet_directory() . '/assets/js/single-curso.js');
    wp_enqueue_script(
        'camisa10-curso-js',
        get_stylesheet_directory_uri() . '/assets/js/single-curso.js',
        array('jquery', 'bootstrap'),
        $curso_js_version,
        true
    );
}
add_action('wp_enqueue_scripts', 'camisa10_single_curso_assets', 30);

// ============================================
// RESTO DO CÓDIGO (helpers, etc)
// ============================================

/**
 * HELPER: ACF SAFE GET
 */
function get_acf_safe($field_name, $post_id = null, $default = '') {
    if (!function_exists('get_field')) {
        return $default;
    }
    
    $value = get_field($field_name, $post_id);
    
    if (is_array($value)) {
        if (isset($value['value'])) {
            return $value['value'];
        }
        if (isset($value['label'])) {
            return $value['label'];
        }
        if (!empty($value)) {
            $first = reset($value);
            if (is_object($first) && isset($first->name)) {
                return $first->name;
            }
            return (string)$first;
        }
        return $default;
    }
    
    if (is_wp_error($value)) {
        return $default;
    }
    
    if (empty($value)) {
        return $default;
    }
    
    return $value;
}

function get_acf_number($field_name, $post_id = null, $default = 0, $type = 'int') {
    $value = get_acf_safe($field_name, $post_id, $default);
    if ($type === 'float') {
        return floatval($value);
    }
    return intval($value);
}

/**
 * MENU LOCATIONS
 */
function camisa10_register_menus() {
    register_nav_menus(array(
        'primary' => __('Menu Principal', 'camisa10'),
        'footer-nav' => __('Menu Footer - Navegação', 'camisa10'),
        'footer-content' => __('Menu Footer - Conteúdo', 'camisa10'),
    ));
}
add_action('after_setup_theme', 'camisa10_register_menus');

/**
 * THEME SUPPORT
 */
function camisa10_theme_support() {
    add_theme_support('custom-logo');
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
}
add_action('after_setup_theme', 'camisa10_theme_support');

/**
 * REGISTRAR POST TYPE 'CURSO'
 */
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
        'not_found_in_trash' => 'Nenhum curso na lixeira',
    );
    
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'curso'),
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-welcome-learn-more',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'show_in_rest' => true,
    );
    
    register_post_type('curso', $args);
}
add_action('init', 'camisa10_register_curso_post_type');

/**
 * Registrar Taxonomia
 */
function camisa10_register_curso_taxonomies() {
    register_taxonomy('course_category', 'curso', array(
        'labels' => array(
            'name' => 'Categorias de Curso',
            'singular_name' => 'Categoria de Curso',
        ),
        'hierarchical' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'categoria-curso'),
        'show_in_rest' => true,
    ));
}
add_action('init', 'camisa10_register_curso_taxonomies');

/**
 * Desabilitar lazy load do Elementor
 */
add_filter('elementor/frontend/lazy_load/optimization_support', '__return_false');
