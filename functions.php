<?php
/**
 * OneKorse Child Theme - Functions
 * 
 * @package     Camisa10
 * @subpackage  OneKorse Child
 * @version     9.0.0
 * @author      Camisa 10 Dev Team
 * @description Tema child do OneKorse com funcionalidades customizadas para plataforma educacional
 * 
 * ÍNDICE:
 * 1. Enqueue Styles & Scripts
 * 2. Custom Post Types & Taxonomies
 * 3. Advanced Custom Fields (ACF) Registration
 * 4. Integração Hotmart
 * 5. Integração WooCommerce + LMS
 * 6. Performance Optimization
 * 7. SEO & Schema Markup
 * 8. Widget Areas
 * 9. Theme Support & Menus
 * 10. Utility Functions
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// ========================================
// 1. ENQUEUE STYLES & SCRIPTS
// ========================================

/**
 * Enqueue Parent Theme Styles
 * Priority: 10 (carrega primeiro)
 */
function onekorse_child_enqueue_styles() {
    // Parent theme stylesheet
    wp_enqueue_style(
        'onekorse-parent-style',
        get_template_directory_uri() . '/style.css',
        array(),
        wp_get_theme()->parent()->get('Version')
    );

    // Child theme stylesheet
    wp_enqueue_style(
        'onekorse-child-style',
        get_stylesheet_uri(),
        array('onekorse-parent-style'),
        wp_get_theme()->get('Version')
    );
}
add_action('wp_enqueue_scripts', 'onekorse_child_enqueue_styles', 10);

/**
 * Enqueue Custom Home Page Assets
 * Priority: 20 (carrega após parent)
 */


function camisa10_home_assets() {
    // Apenas na página home
    if (!is_page_template('page-home.php') && !is_front_page()) {
        return;
    }

    // ===== CSS =====

    // 1. CSS Variables (cores, fontes, espaçamentos)
    if (file_exists(get_stylesheet_directory() . '/assets/css/custom-variables.css')) {
        wp_enqueue_style(
            'camisa10-variables',
            get_stylesheet_directory_uri() . '/assets/css/custom-variables.css',
            array('onekorse-parent-style'),
            '1.0.0',
            'all'
        );
    }

    // 2. CSS Custom Home
    if (file_exists(get_stylesheet_directory() . '/assets/css/custom-home.css')) {
        wp_enqueue_style(
            'camisa10-home-css',
            get_stylesheet_directory_uri() . '/assets/css/custom-home.css',
            array('camisa10-variables'),
            '9.0.0',
            'all'
        );
    }




    // 3. Bootstrap 5 CSS (para carousel e componentes)
    wp_enqueue_style(
        'bootstrap-css',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css',
        array(),
        '5.3.0'
    );

    // ===== JAVASCRIPT =====

    // 4. Bootstrap 5 JS
    wp_enqueue_script(
        'bootstrap-js',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js',
        array('jquery'),
        '5.3.0',
        true
    );

    // 5. Slick Slider (para depoimentos e carousels)
    wp_enqueue_style(
        'slick-css',
        'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css',
        array(),
        '1.8.1'
    );

    wp_enqueue_style(
        'slick-theme-css',
        'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css',
        array('slick-css'),
        '1.8.1'
    );

    wp_enqueue_script(
        'slick-js',
        'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js',
        array('jquery'),
        '1.8.1',
        true
    );

    // 6. JS Custom Home
    if (file_exists(get_stylesheet_directory() . '/assets/js/custom-home.js')) {
        wp_enqueue_script(
            'camisa10-home-js',
            get_stylesheet_directory_uri() . '/assets/js/custom-home.js',
            array('jquery', 'bootstrap-js'),
            '9.0.0',
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'camisa10_home_assets', 20);

/**
 * Defer Scripts for Performance
 */
function camisa10_defer_scripts($tag, $handle, $src) {
    $defer_scripts = array('camisa10-home-js', 'slick-js');

    if (in_array($handle, $defer_scripts)) {
        if (strpos($tag, 'async') === false) {
            $tag = str_replace(' src', ' defer src', $tag);
        }
    }

    return $tag;
}
add_filter('script_loader_tag', 'camisa10_defer_scripts', 10, 3);

// ========================================
// 2. CUSTOM POST TYPES & TAXONOMIES
// ========================================

/**
 * Registrar Custom Post Types
 */
function camisa10_register_custom_post_types() {

    // ===== CURSOS =====
    register_post_type('curso', array(
        'labels' => array(
            'name'               => __('Cursos', 'camisa10'),
            'singular_name'      => __('Curso', 'camisa10'),
            'add_new'            => __('Adicionar Novo', 'camisa10'),
            'add_new_item'       => __('Adicionar Novo Curso', 'camisa10'),
            'edit_item'          => __('Editar Curso', 'camisa10'),
            'new_item'           => __('Novo Curso', 'camisa10'),
            'view_item'          => __('Ver Curso', 'camisa10'),
            'search_items'       => __('Buscar Cursos', 'camisa10'),
            'not_found'          => __('Nenhum curso encontrado', 'camisa10'),
            'not_found_in_trash' => __('Nenhum curso na lixeira', 'camisa10'),
            'menu_name'          => __('Cursos', 'camisa10')
        ),
        'public'       => true,
        'has_archive'  => true,
        'menu_icon'    => 'dashicons-welcome-learn-more',
        'menu_position' => 5,
        'supports'     => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'comments'),
        'rewrite'      => array('slug' => 'cursos'),
        'show_in_rest' => true,
    ));

    // ===== MENTORIAS =====
    register_post_type('mentoria', array(
        'labels' => array(
            'name'               => __('Mentorias', 'camisa10'),
            'singular_name'      => __('Mentoria', 'camisa10'),
            'add_new'            => __('Adicionar Nova', 'camisa10'),
            'add_new_item'       => __('Adicionar Nova Mentoria', 'camisa10'),
            'edit_item'          => __('Editar Mentoria', 'camisa10'),
            'new_item'           => __('Nova Mentoria', 'camisa10'),
            'view_item'          => __('Ver Mentoria', 'camisa10'),
            'search_items'       => __('Buscar Mentorias', 'camisa10'),
            'not_found'          => __('Nenhuma mentoria encontrada', 'camisa10'),
            'not_found_in_trash' => __('Nenhuma mentoria na lixeira', 'camisa10'),
            'menu_name'          => __('Mentorias', 'camisa10')
        ),
        'public'       => true,
        'has_archive'  => true,
        'menu_icon'    => 'dashicons-groups',
        'menu_position' => 6,
        'supports'     => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'rewrite'      => array('slug' => 'mentorias'),
        'show_in_rest' => true,
    ));

    // ===== ESPECIALISTAS =====
    register_post_type('especialista', array(
        'labels' => array(
            'name'               => __('Especialistas', 'camisa10'),
            'singular_name'      => __('Especialista', 'camisa10'),
            'add_new'            => __('Adicionar Novo', 'camisa10'),
            'add_new_item'       => __('Adicionar Novo Especialista', 'camisa10'),
            'edit_item'          => __('Editar Especialista', 'camisa10'),
            'new_item'           => __('Novo Especialista', 'camisa10'),
            'view_item'          => __('Ver Especialista', 'camisa10'),
            'search_items'       => __('Buscar Especialistas', 'camisa10'),
            'not_found'          => __('Nenhum especialista encontrado', 'camisa10'),
            'not_found_in_trash' => __('Nenhum especialista na lixeira', 'camisa10'),
            'menu_name'          => __('Especialistas', 'camisa10')
        ),
        'public'       => true,
        'has_archive'  => true,
        'menu_icon'    => 'dashicons-businessperson',
        'menu_position' => 7,
        'supports'     => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'rewrite'      => array('slug' => 'especialistas'),
        'show_in_rest' => true,
    ));

    // ===== DEPOIMENTOS =====
    register_post_type('depoimento', array(
        'labels' => array(
            'name'               => __('Depoimentos', 'camisa10'),
            'singular_name'      => __('Depoimento', 'camisa10'),
            'add_new'            => __('Adicionar Novo', 'camisa10'),
            'add_new_item'       => __('Adicionar Novo Depoimento', 'camisa10'),
            'edit_item'          => __('Editar Depoimento', 'camisa10'),
            'new_item'           => __('Novo Depoimento', 'camisa10'),
            'view_item'          => __('Ver Depoimento', 'camisa10'),
            'search_items'       => __('Buscar Depoimentos', 'camisa10'),
            'not_found'          => __('Nenhum depoimento encontrado', 'camisa10'),
            'not_found_in_trash' => __('Nenhum depoimento na lixeira', 'camisa10'),
            'menu_name'          => __('Depoimentos', 'camisa10')
        ),
        'public'       => true,
        'has_archive'  => false,
        'menu_icon'    => 'dashicons-format-chat',
        'menu_position' => 8,
        'supports'     => array('title', 'editor', 'thumbnail'),
        'rewrite'      => array('slug' => 'depoimentos'),
        'show_in_rest' => true,
    ));
}
add_action('init', 'camisa10_register_custom_post_types');

/**
 * Registrar Taxonomias Customizadas
 */
function camisa10_register_taxonomies() {

    // Taxonomia: Categorias de Curso
    register_taxonomy('curso_categoria', 'curso', array(
        'labels' => array(
            'name'          => __('Categorias de Curso', 'camisa10'),
            'singular_name' => __('Categoria', 'camisa10'),
            'search_items'  => __('Buscar Categorias', 'camisa10'),
            'all_items'     => __('Todas Categorias', 'camisa10'),
            'edit_item'     => __('Editar Categoria', 'camisa10'),
            'update_item'   => __('Atualizar Categoria', 'camisa10'),
            'add_new_item'  => __('Adicionar Nova Categoria', 'camisa10'),
            'new_item_name' => __('Nome da Nova Categoria', 'camisa10'),
            'menu_name'     => __('Categorias', 'camisa10'),
        ),
        'hierarchical'      => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'curso-categoria'),
        'show_in_rest'      => true,
    ));

    // Taxonomia: Temas de Curso
    register_taxonomy('curso_tema', 'curso', array(
        'labels' => array(
            'name'          => __('Temas', 'camisa10'),
            'singular_name' => __('Tema', 'camisa10'),
            'search_items'  => __('Buscar Temas', 'camisa10'),
            'all_items'     => __('Todos Temas', 'camisa10'),
            'edit_item'     => __('Editar Tema', 'camisa10'),
            'update_item'   => __('Atualizar Tema', 'camisa10'),
            'add_new_item'  => __('Adicionar Novo Tema', 'camisa10'),
            'new_item_name' => __('Nome do Novo Tema', 'camisa10'),
            'menu_name'     => __('Temas', 'camisa10'),
        ),
        'hierarchical'      => false,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'tema'),
        'show_in_rest'      => true,
    ));

    // Taxonomia: Níveis de Curso
    register_taxonomy('curso_nivel', 'curso', array(
        'labels' => array(
            'name'          => __('Níveis', 'camisa10'),
            'singular_name' => __('Nível', 'camisa10'),
            'search_items'  => __('Buscar Níveis', 'camisa10'),
            'all_items'     => __('Todos Níveis', 'camisa10'),
            'edit_item'     => __('Editar Nível', 'camisa10'),
            'update_item'   => __('Atualizar Nível', 'camisa10'),
            'add_new_item'  => __('Adicionar Novo Nível', 'camisa10'),
            'new_item_name' => __('Nome do Novo Nível', 'camisa10'),
            'menu_name'     => __('Níveis', 'camisa10'),
        ),
        'hierarchical'      => false,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'nivel'),
        'show_in_rest'      => true,
    ));
}
add_action('init', 'camisa10_register_taxonomies');

// ========================================
// 4. INTEGRAÇÃO HOTMART
// ========================================

/**
 * Hotmart Webhook Listener
 * URL: https://seusite.com.br/?hotmart_webhook=1
 */
function camisa10_hotmart_webhook_listener() {
    if (!isset($_GET['hotmart_webhook'])) {
        return;
    }

    // Ler dados do webhook
    $raw_data = file_get_contents('php://input');
    $data = json_decode($raw_data, true);

    // Log para debug (remover em produção)
    if (defined('WP_DEBUG') && WP_DEBUG) {
        error_log('Hotmart Webhook: ' . print_r($data, true));
    }

    // Validar dados básicos
    if (!isset($data['event']) || !isset($data['data'])) {
        http_response_code(400);
        exit;
    }

    $event = sanitize_text_field($data['event']);
    $buyer_email = sanitize_email($data['data']['buyer']['email']);
    $buyer_name = sanitize_text_field($data['data']['buyer']['name']);
    $product_id = sanitize_text_field($data['data']['product']['id']);
    $product_name = sanitize_text_field($data['data']['product']['name']);

    // Processar apenas eventos de compra aprovada
    if ($event === 'PURCHASE_APPROVED' || $event === 'PURCHASE_COMPLETE') {

        // 1. Criar/atualizar usuário WordPress
        $user = get_user_by('email', $buyer_email);

        if (!$user) {
            $user_id = wp_create_user(
                $buyer_email,
                wp_generate_password(),
                $buyer_email
            );

            if (!is_wp_error($user_id)) {
                // Atualizar dados do usuário
                wp_update_user(array(
                    'ID' => $user_id,
                    'display_name' => $buyer_name,
                    'first_name' => explode(' ', $buyer_name)[0],
                ));

                // Enviar email com credenciais
                wp_send_new_user_notifications($user_id, 'user');
            }
        } else {
            $user_id = $user->ID;
        }

        // 2. Buscar curso vinculado ao produto Hotmart
        $args = array(
            'post_type' => 'curso',
            'meta_query' => array(
                array(
                    'key' => 'hotmart_product_id',
                    'value' => $product_id,
                    'compare' => '='
                )
            )
        );

        $curso = get_posts($args);

        if ($curso && !is_wp_error($user_id)) {
            $curso_id = $curso[0]->ID;

            // 3. Matricular usuário no curso (OneKorse LMS)
            if (function_exists('onekorse_enroll_user')) {
                onekorse_enroll_user($user_id, $curso_id);
            }

            // 4. Salvar metadados da compra
            add_user_meta($user_id, 'hotmart_purchase_' . $product_id, array(
                'purchase_date' => current_time('mysql'),
                'product_name' => $product_name,
                'product_id' => $product_id,
            ));
        }
    }

    // Responder com sucesso
    http_response_code(200);
    echo json_encode(array('status' => 'success'));
    exit;
}
add_action('init', 'camisa10_hotmart_webhook_listener');

// ========================================
// 5. INTEGRAÇÃO WOOCOMMERCE + LMS
// ========================================

/**
 * Auto-matrícula em curso após compra aprovada
 */
function camisa10_auto_enroll_course($order_id) {
    if (!$order_id) {
        return;
    }

    $order = wc_get_order($order_id);
    $user_id = $order->get_user_id();

    if (!$user_id) {
        return;
    }

    // Iterar pelos itens do pedido
    foreach ($order->get_items() as $item) {
        $product_id = $item->get_product_id();

        // Buscar curso vinculado ao produto
        $curso_id = get_post_meta($product_id, '_linked_course', true);

        if ($curso_id && function_exists('onekorse_enroll_user')) {
            // Matricular usuário
            onekorse_enroll_user($user_id, $curso_id);

            // Log da matrícula
            $order->add_order_note(
                sprintf(
                    __('Usuário %s matriculado automaticamente no curso ID %s', 'camisa10'),
                    $user_id,
                    $curso_id
                )
            );
        }
    }
}
add_action('woocommerce_order_status_completed', 'camisa10_auto_enroll_course');
add_action('woocommerce_order_status_processing', 'camisa10_auto_enroll_course'); // Para produtos digitais

// ========================================
// 6. PERFORMANCE OPTIMIZATION
// ========================================

/**
 * Ativar Lazy Loading nativo
 */
add_filter('wp_lazy_loading_enabled', '__return_true');

/**
 * Desabilitar Google Fonts do Elementor (usar fontes locais)
 */
add_filter('elementor/frontend/print_google_fonts', '__return_false');

/**
 * Limitar Post Revisions
 */
if (!defined('WP_POST_REVISIONS')) {
    define('WP_POST_REVISIONS', 3);
}

/**
 * Aumentar intervalo de autosave
 */
if (!defined('AUTOSAVE_INTERVAL')) {
    define('AUTOSAVE_INTERVAL', 300); // 5 minutos
}

/**
 * Remover query strings de assets estáticos
 */
function camisa10_remove_script_version($src) {
    if (strpos($src, '?ver=')) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}
add_filter('script_loader_src', 'camisa10_remove_script_version', 15, 1);
add_filter('style_loader_src', 'camisa10_remove_script_version', 15, 1);

// ========================================
// 7. SEO & SCHEMA MARKUP
// ========================================

/**
 * Adicionar Schema.org JSON-LD para Educational Organization
 */
function camisa10_add_schema_markup() {
    if (!is_front_page()) {
        return;
    }

    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'EducationalOrganization',
        'name' => 'Camisa 10',
        'description' => 'Plataforma de educação para formar profissionais de alta performance',
        'url' => home_url(),
        'logo' => get_stylesheet_directory_uri() . '/assets/images/logo.png',
        'sameAs' => array(
            'https://facebook.com/camisa10',
            'https://instagram.com/camisa10',
            'https://linkedin.com/company/camisa10'
        ),
        'contactPoint' => array(
            '@type' => 'ContactPoint',
            'contactType' => 'Customer Service',
            'email' => 'contato@camisa10.com.br'
        )
    );

    echo '<script type="application/ld+json">' . PHP_EOL;
    echo json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    echo PHP_EOL . '</script>' . PHP_EOL;
}
add_action('wp_head', 'camisa10_add_schema_markup');

// ========================================
// 8. WIDGET AREAS
// ========================================

/**
 * Registrar Widget Areas
 */
function camisa10_widgets_init() {
    // Footer Widget 1
    register_sidebar(array(
        'name'          => __('Footer Widget Area 1', 'camisa10'),
        'id'            => 'footer-1',
        'description'   => __('Aparece na primeira coluna do footer', 'camisa10'),
        'before_widget' => '<div id="%1\$s" class="widget %2\$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    // Footer Widget 2
    register_sidebar(array(
        'name'          => __('Footer Widget Area 2', 'camisa10'),
        'id'            => 'footer-2',
        'description'   => __('Aparece na segunda coluna do footer', 'camisa10'),
        'before_widget' => '<div id="%1\$s" class="widget %2\$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    // Footer Widget 3
    register_sidebar(array(
        'name'          => __('Footer Widget Area 3', 'camisa10'),
        'id'            => 'footer-3',
        'description'   => __('Aparece na terceira coluna do footer', 'camisa10'),
        'before_widget' => '<div id="%1\$s" class="widget %2\$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    // Sidebar padrão
    register_sidebar(array(
        'name'          => __('Primary Sidebar', 'camisa10'),
        'id'            => 'sidebar-1',
        'description'   => __('Aparece na lateral das páginas e posts', 'camisa10'),
        'before_widget' => '<aside id="%1\$s" class="widget %2\$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'camisa10_widgets_init');

// ========================================
// 9. THEME SUPPORT & MENUS
// ========================================

/**
 * Theme Setup
 */
function camisa10_theme_setup() {
    // Suporte a logo customizado
    add_theme_support('custom-logo', array(
        'height'      => 80,
        'width'       => 320,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // Suporte a HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));

    // Suporte a imagens destacadas
    add_theme_support('post-thumbnails');

    // Suporte a título automático
    add_theme_support('title-tag');
}
add_action('after_setup_theme', 'camisa10_theme_setup');

/**
 * Registrar Menus de Navegação
 */
function camisa10_register_menus() {
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'camisa10'),
        'footer'  => __('Footer Menu', 'camisa10'),
    ));
}
add_action('init', 'camisa10_register_menus');

// ========================================
// 10. UTILITY FUNCTIONS
// ========================================

/**
 * Custom Login Logo
 */
function camisa10_login_logo() {
    if (file_exists(get_stylesheet_directory() . '/assets/images/logo.png')) {
        ?>
        <style type="text/css">
            #login h1 a, .login h1 a {
                background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo.png);
                height: 80px;
                width: 320px;
                background-size: contain;
                background-repeat: no-repeat;
                padding-bottom: 30px;
            }
        </style>
        <?php
    }
}
add_action('login_enqueue_scripts', 'camisa10_login_logo');

/**
 * Custom Excerpt Length
 */
function camisa10_custom_excerpt_length($length) {
    return 30; // palavras
}
add_filter('excerpt_length', 'camisa10_custom_excerpt_length', 999);

/**
 * Custom Excerpt More
 */
function camisa10_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'camisa10_excerpt_more');

/**
 * Debug Scripts (apenas para admins em modo debug)
 */
function camisa10_debug_scripts() {
    global $wp_scripts;

    if (defined('WP_DEBUG') && WP_DEBUG && current_user_can('administrator')) {
        echo '<!-- Camisa10 Debug: Scripts Carregados -->' . PHP_EOL;
        echo '<!-- ';
        if (isset($wp_scripts->queue)) {
            print_r($wp_scripts->queue);
        }
        echo ' -->' . PHP_EOL;
    }
}
add_action('wp_footer', 'camisa10_debug_scripts', 999);

/**
 * Limitar busca apenas a posts e cursos
 */
function camisa10_search_filter($query) {
    if ($query->is_search && !is_admin()) {
        $query->set('post_type', array('post', 'curso', 'mentoria'));
    }
    return $query;
}
add_filter('pre_get_posts', 'camisa10_search_filter');


function camisa10_enqueue_header_assets() {
    // Header CSS
    wp_enqueue_style(
        'camisa10-header',
        get_stylesheet_directory_uri() . '/assets/css/header.css',
        array(),
        '1.0.0'
    );
    
    // Header JS (para menu mobile)
    wp_enqueue_script(
        'camisa10-header',
        get_stylesheet_directory_uri() . '/assets/js/header.js',
        array('jquery'),
        '1.0.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'camisa10_enqueue_header_assets', 5);
/**
 * Adiciona Hero Banner após o header
 */
function camisa10_add_hero_banner() {
    if ( is_front_page() ) {
        get_template_part( 'template-parts/hero-banner' );
    }
}
add_action( 'onekorse_after_header', 'camisa10_add_hero_banner', 10 );

add_action('wp_enqueue_scripts', 'camisa10_enqueue_hero_slider_assets', 30);


/**
 * Enfileira Swiper.js e scripts do Hero Banner
 */
/**
 * Enfileira Swiper.js e scripts do Hero Banner
 */
function camisa10_enqueue_hero_slider_assets() {
    // Apenas na homepage
    if (!is_front_page()) {
        return;
    }
    
    // Swiper CSS
    wp_enqueue_style(
        'swiper',
        'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css',
        array(),
        '8.4.7'
    );
    
    // Hero Banner CSS - COM VERIFICAÇÃO
    if (file_exists(get_stylesheet_directory() . '/assets/css/hero-banner.css')) {
        wp_enqueue_style(
            'camisa10-hero-slider',
            get_stylesheet_directory_uri() . '/assets/css/hero-banner.css',
            array('swiper'),
            '1.0.0'
        );
    }
    
    // Swiper JS
    wp_enqueue_script(
        'swiper',
        'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js',
        array('jquery'),
        '8.4.7',
        true
    );
    
    // Hero Banner JS - COM VERIFICAÇÃO
    if (file_exists(get_stylesheet_directory() . '/assets/js/hero-banner.js')) {
        wp_enqueue_script(
            'camisa10-hero-slider',
            get_stylesheet_directory_uri() . '/assets/js/hero-banner.js',
            array('jquery', 'swiper'),
            '1.0.0',
            true
        );
    }
    
    // AOS (Opcional - para animações)
    wp_enqueue_style(
        'aos',
        'https://unpkg.com/aos@2.3.1/dist/aos.css',
        array(),
        '2.3.1'
    );
    
    wp_enqueue_script(
        'aos',
        'https://unpkg.com/aos@2.3.1/dist/aos.js',
        array(),
        '2.3.1',
        true
    );
}
add_action('wp_enqueue_scripts', 'camisa10_enqueue_hero_slider_assets');
add_action( 'wp_enqueue_scripts', 'camisa10_enqueue_hero_slider_assets' );

/**
 * Inicializa AOS
 */
function camisa10_init_aos() {
    if ( ! is_front_page() ) {
        return;
    }
    ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof AOS !== 'undefined') {
                AOS.init({
                    duration: 800,
                    easing: 'ease-out',
                    once: true,
                    offset: 100
                });
            }
        });
    </script>
    <?php
}
add_action( 'wp_footer', 'camisa10_init_aos' );
