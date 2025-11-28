<?php
/**
 * Camisa 10 Child Theme - Functions
 * @package Camisa10
 * @version 2.1.0 - CORRIGIDO EM 27/11/2025
 * 
 * CORREÇÕES APLICADAS:
 * - FIX #1: Função camisa10_single_curso_assets() reimplementada (CRÍTICO)
 * - FIX #2: Bootstrap sempre registrado para dependências (CRÍTICO)
 * - FIX #3: filemtime() substituindo time() para cache correto (ALTO)
 * - FIX #4: cursos-section.css adicionado ao enqueue (MÉDIO)
 * - FIX #5: Debug condicional para diagnóstico (opcional, comentado)
 */

// Prevenir acesso direto
if (!defined('ABSPATH')) {
    exit;
}

/**
 * ============================================
 * ENFILEIRAMENTO DE ESTILOS DO TEMA PAI
 * ============================================
 */
function camisa10_enqueue_styles() {
    $parent_style = 'onekorse-style';
    
    wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css');
    wp_enqueue_style(
        'camisa10-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array($parent_style),
        wp_get_theme()->get('Version')
    );
}
add_action('wp_enqueue_scripts', 'camisa10_enqueue_styles', 10);

/**
 * ============================================
 * ASSETS ESPECÍFICOS DA HOMEPAGE
 * ============================================
 */
function camisa10_home_assets() {
    if (!is_page_template('page-home.php') && !is_front_page()) {
        return;
    }

    /* FIX #2: Bootstrap sempre registrado ANTES de verificar enqueue
     * ANTES: if (!wp_style_is('bootstrap', 'enqueued')) { wp_enqueue_style... }
     * DEPOIS: Sempre registrar, WordPress evita duplicatas automaticamente
     */
    // 1. BOOTSTRAP CSS
    wp_register_style(
        'bootstrap',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css',
        array(),
        '5.3.0'
    );
    wp_enqueue_style('bootstrap');

    // 2. CSS VARIABLES
    wp_enqueue_style(
        'camisa10-variables',
        get_stylesheet_directory_uri() . '/assets/css/custom-variables.css',
        array('bootstrap'), // Agora dependência sempre satisfeita
        filemtime(get_stylesheet_directory() . '/assets/css/custom-variables.css')
    );

    // 3. HERO BANNER CSS
    wp_enqueue_style(
        'camisa10-hero-banner-css',
        get_stylesheet_directory_uri() . '/assets/css/hero-banner.css',
        array('camisa10-variables'),
        filemtime(get_stylesheet_directory() . '/assets/css/hero-banner.css')
    );

    // 4. CUSTOM HOME CSS
    wp_enqueue_style(
        'camisa10-home-css',
        get_stylesheet_directory_uri() . '/assets/css/custom-home.css',
        array('camisa10-hero-banner-css'),
        filemtime(get_stylesheet_directory() . '/assets/css/custom-home.css')
    );

    // 5. SLICK SLIDER CSS
    wp_enqueue_style(
        'slick-css',
        'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css',
        array(),
        '1.8.1'
    );

    // 6. BOOTSTRAP JS
    wp_register_script(
        'bootstrap',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js',
        array('jquery'),
        '5.3.0',
        true
    );
    wp_enqueue_script('bootstrap');

    // 7. SLICK SLIDER JS
    wp_enqueue_script(
        'slick-js',
        'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js',
        array('jquery'),
        '1.8.1',
        true
    );

    // 8. HERO BANNER JS
    wp_enqueue_script(
        'camisa10-hero-banner-js',
        get_stylesheet_directory_uri() . '/assets/js/hero-banner.js',
        array('jquery', 'bootstrap'),
        filemtime(get_stylesheet_directory() . '/assets/js/hero-banner.js'),
        true
    );

    // 9. CUSTOM HOME JS
    wp_enqueue_script(
        'camisa10-home-js',
        get_stylesheet_directory_uri() . '/assets/js/custom-home.js',
        array('jquery', 'bootstrap', 'slick-js'),
        filemtime(get_stylesheet_directory() . '/assets/js/custom-home.js'),
        true
    );
}
add_action('wp_enqueue_scripts', 'camisa10_home_assets', 20);

/**
 * ============================================
 * ASSETS DO SINGLE CURSO - REIMPLEMENTADO
 * ============================================
 * FIX #1: Função estava ausente no arquivo original
 * FIX #3: time() substituído por filemtime() para cache correto
 * FIX #4: cursos-section.css adicionado
 */
function camisa10_single_curso_assets() {
    if (!is_singular('curso')) {
        return;
    }

    /* FIX #5: DEBUG CONDICIONAL (opcional - descomentar para diagnóstico)
    if (current_user_can('administrator')) {
        error_log('=== DEBUG SINGLE CURSO ===');
        error_log('URL: ' . get_permalink());
        error_log('Post Type: ' . get_post_type());
        error_log('is_singular(curso): ' . (is_singular('curso') ? 'TRUE' : 'FALSE'));
        error_log('Bootstrap carregado: ' . (wp_style_is('bootstrap', 'enqueued') ? 'SIM' : 'NÃO'));
    }
    */

    /* FIX #3: Versões calculadas UMA VEZ com filemtime()
     * ANTES: $timestamp = time(); (mudava a cada segundo)
     * DEPOIS: filemtime() (muda apenas quando arquivo é editado)
     */
    $vars_version = filemtime(get_stylesheet_directory() . '/assets/css/custom-variables.css');
    $curso_version = filemtime(get_stylesheet_directory() . '/assets/css/single-curso.css');
    $cursos_section_version = filemtime(get_stylesheet_directory() . '/assets/css/cursos-section.css');

    // 1. BOOTSTRAP CSS (sempre registrado)
    wp_register_style(
        'bootstrap',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css',
        array(),
        '5.3.0'
    );
    wp_enqueue_style('bootstrap');

    // 2. CSS VARIABLES (dependência satisfeita)
    wp_enqueue_style(
        'camisa10-variables',
        get_stylesheet_directory_uri() . '/assets/css/custom-variables.css',
        array('bootstrap'),
        $vars_version // ← Agora usa filemtime() ao invés de time()
    );

    // 3. FONT AWESOME
    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css',
        array(),
        '6.4.0'
    );

    // 4. FIX #4: CURSOS SECTION CSS (arquivo estava órfão)
    wp_enqueue_style(
        'camisa10-cursos-section-css',
        get_stylesheet_directory_uri() . '/assets/css/cursos-section.css',
        array('camisa10-variables'),
        $cursos_section_version
    );

    // 5. SINGLE CURSO CSS
    wp_enqueue_style(
        'camisa10-curso-css',
        get_stylesheet_directory_uri() . '/assets/css/single-curso.css',
        array('camisa10-cursos-section-css', 'font-awesome'),
        $curso_version // ← Agora usa filemtime() ao invés de time()
    );

    // 6. BOOTSTRAP JS (sempre registrado)
    wp_register_script(
        'bootstrap',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js',
        array('jquery'),
        '5.3.0',
        true
    );
    wp_enqueue_script('bootstrap');

    // 7. SINGLE CURSO JS
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

/**
 * ============================================
 * CORREÇÃO: ERRO DEPRECATED DO AVATAR
 * ============================================
 */
function camisa10_fix_avatar_deprecated($avatar, $id_or_email, $size, $default, $alt, $args) {
    if (isset($args['url']) && $args['url'] === null) {
        $args['url'] = '';
    }
    
    if (empty($avatar)) {
        $default_avatar = get_stylesheet_directory_uri() . '/assets/images/avatar-default.png';
        
        if (!file_exists(get_stylesheet_directory() . '/assets/images/avatar-default.png')) {
            $default_avatar = get_avatar_url($id_or_email, array('default' => 'mystery'));
        }
        
        $avatar = '<img src="' . esc_url($default_avatar) . '" alt="' . esc_attr($alt) . '" width="' . esc_attr($size) . '" height="' . esc_attr($size) . '" class="avatar avatar-' . esc_attr($size) . '" />';
    }
    
    return $avatar;
}
add_filter('get_avatar', 'camisa10_fix_avatar_deprecated', 10, 6);

/**
 * ============================================
 * HELPER: ACF SAFE GET
 * ============================================
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
 * ============================================
 * HELPER: SAFE PRINT ARRAYS
 * ============================================
 */
function safe_print($value, $separator = ', ') {
    if (is_array($value)) {
        if (empty($value)) {
            return '';
        }
        
        $output = array();
        foreach ($value as $item) {
            if (is_object($item)) {
                if (isset($item->name)) {
                    $output[] = esc_html($item->name);
                } elseif (method_exists($item, '__toString')) {
                    $output[] = esc_html((string)$item);
                }
            } elseif (is_scalar($item)) {
                $output[] = esc_html($item);
            }
        }
        return implode($separator, $output);
    } elseif (is_object($value)) {
        if (isset($value->name)) {
            return esc_html($value->name);
        } elseif (method_exists($value, '__toString')) {
            return esc_html((string)$value);
        }
        return '';
    } elseif (is_wp_error($value)) {
        return '';
    }
    
    return esc_html($value);
}

/**
 * ============================================
 * MENU LOCATIONS
 * ============================================
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
 * ============================================
 * THEME SUPPORT
 * ============================================
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
 * ============================================
 * HOTMART WEBHOOK
 * ============================================
 */
function camisa10_hotmart_webhook_listener() {
    if (!isset($_GET['hotmart_webhook'])) {
        return;
    }

    $hotmart_token = get_option('camisa10_hotmart_webhook_token');
    $received_token = $_SERVER['HTTP_X_HOTMART_HOTTOK'] ?? '';

    if (empty($hotmart_token)) {
        error_log('[Camisa10 Webhook] ERRO: Token não configurado');
        http_response_code(500);
        exit('Webhook token not configured');
    }

    if ($received_token !== $hotmart_token) {
        error_log('[Camisa10 Webhook] ALERTA: Token inválido');
        http_response_code(401);
        exit('Unauthorized');
    }

    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $rate_limit_key = 'hotmart_webhook_' . md5($ip);
    $request_count = get_transient($rate_limit_key) ?: 0;
    
    if ($request_count > 10) {
        http_response_code(429);
        exit('Too many requests');
    }
    
    set_transient($rate_limit_key, $request_count + 1, 60);

    $raw_data = file_get_contents('php://input');
    $data = json_decode($raw_data, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        http_response_code(400);
        exit('Invalid JSON');
    }

    if (!isset($data['event'])) {
        http_response_code(400);
        exit('Invalid payload');
    }

    $event = sanitize_text_field($data['event']);
    
    if ($event === 'PURCHASE_APPROVED' || $event === 'PURCHASE_COMPLETE') {
        error_log('[Camisa10 Webhook] Compra aprovada');
    }

    http_response_code(200);
    echo wp_json_encode(array('status' => 'success'));
    exit;
}
add_action('init', 'camisa10_hotmart_webhook_listener');

/**
 * ============================================
 * REGISTRAR POST TYPE 'CURSO'
 * ============================================
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
=======
add_action('init', 'camisa10_register_curso_taxonomies');
<?php
/**
 * Functions - Camisa 10 Child Theme
 * 
 * @package OneKorse Child
 * @since 1.0.0
 * @updated 2025-11-26 - Corrigido: Webhook com validação token, sanitização, rate limiting
 */

if (!defined('ABSPATH')) exit;

/**
 * Enfileira estilos e scripts do tema filho
 */
function camisa10_enqueue_styles() {
    wp_enqueue_style('onekorse-parent-style', get_template_directory_uri() . '/style.css');
    
    wp_enqueue_style('camisa10-child-style', 
        get_stylesheet_uri(),
        array('onekorse-parent-style'),
        wp_get_theme()->get('Version')
    );
}
add_action('wp_enqueue_scripts', 'camisa10_enqueue_styles', 10);

/**
 * Enfileira assets específicos da homepage
 */
function camisa10_home_assets() {
    if (!is_page_template('page-home.php') && !is_front_page()) return;

    wp_enqueue_style('camisa10-variables',
        get_stylesheet_directory_uri() . '/assets/css/custom-variables.css',
        array(),
        filemtime(get_stylesheet_directory() . '/assets/css/custom-variables.css')
    );

    wp_enqueue_style('camisa10-home-css',
        get_stylesheet_directory_uri() . '/assets/css/custom-home.css',
        array('camisa10-variables'),
        filemtime(get_stylesheet_directory() . '/assets/css/custom-home.css')
    );

    wp_enqueue_script('bootstrap-js',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js',
        array('jquery'), '5.3.0', true
    );

    wp_enqueue_style('slick-css',
        'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css',
        array(), '1.8.1'
    );
    
    wp_enqueue_script('slick-js',
        'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js',
        array('jquery'), '1.8.1', true
    );

    wp_enqueue_script('camisa10-home-js',
        get_stylesheet_directory_uri() . '/assets/js/custom-home.js',
        array('jquery', 'bootstrap-js', 'slick-js'),
        filemtime(get_stylesheet_directory() . '/assets/js/custom-home.js'),
        true
    );
}
add_action('wp_enqueue_scripts', 'camisa10_home_assets', 20);

/**
 * Enfileira assets do header
 */
function camisa10_enqueue_header_assets() {
    wp_enqueue_script('camisa10-header-js',
        get_stylesheet_directory_uri() . '/assets/js/header.js',
        array(),
        filemtime(get_stylesheet_directory() . '/assets/js/header.js'),
        true
    );
}
add_action('wp_enqueue_scripts', 'camisa10_enqueue_header_assets', 20);

/**
 * Webhook Hotmart com Validação de Segurança
 * 
 * Configure o token: update_option('camisa10_hotmart_webhook_token', 'SEU_TOKEN');
 */
function camisa10_hotmart_webhook_listener() {
    if (!isset($_GET['hotmart_webhook'])) return;

    // Validar token Hotmart
    $hotmart_token = get_option('camisa10_hotmart_webhook_token');
    $received_token = $_SERVER['HTTP_X_HOTMART_HOTTOK'] ?? '';
    
    if (empty($hotmart_token)) {
        error_log('[Camisa10] Token não configurado');
        http_response_code(500);
        exit('Token not configured');
    }
    
    if ($received_token !== $hotmart_token) {
        error_log('[Camisa10] Token inválido - IP: ' . ($_SERVER['REMOTE_ADDR'] ?? 'unknown'));
        http_response_code(401);
        exit('Unauthorized');
    }

    // Rate limiting
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $rate_limit_key = 'hotmart_webhook_' . md5($ip);
    $request_count = get_transient($rate_limit_key) ?: 0;
    
    if ($request_count > 10) {
        error_log('[Camisa10] Rate limit excedido: ' . $ip);
        http_response_code(429);
        exit('Too many requests');
    }
    
    set_transient($rate_limit_key, $request_count + 1, 60);

    // Ler payload
    $raw_data = file_get_contents('php://input');
    $data = json_decode($raw_data, true);
    
    if (json_last_error() !== JSON_ERROR_NONE) {
        error_log('[Camisa10] JSON inválido');
        http_response_code(400);
        exit('Invalid JSON');
    }
    
    if (!isset($data['event']) || !isset($data['data']['buyer']) || !isset($data['data']['product'])) {
        error_log('[Camisa10] Payload incompleto');
        http_response_code(400);
        exit('Invalid payload');
    }

    // Sanitizar inputs
    $event = sanitize_text_field($data['event']);
    $product_id = sanitize_text_field($data['data']['product']['id'] ?? '');
    $buyer_email = sanitize_email($data['data']['buyer']['email'] ?? '');
    $buyer_name = sanitize_text_field($data['data']['buyer']['name'] ?? '');
    
    if (empty($product_id) || !preg_match('/^[a-zA-Z0-9\-]+$/', $product_id)) {
        http_response_code(400);
        exit('Invalid product ID');
    }
    
    if (empty($buyer_email) || !is_email($buyer_email)) {
        http_response_code(400);
        exit('Invalid email');
    }

    // Processar evento
    if ($event === 'PURCHASE_APPROVED' || $event === 'PURCHASE_COMPLETE') {
        // Lógica de matrícula aqui
        error_log('[Camisa10] Evento processado: ' . $event . ' - ' . $buyer_email);
    }

    http_response_code(200);
    echo json_encode(array('status' => 'success', 'event' => $event));
    exit;
}
add_action('init', 'camisa10_hotmart_webhook_listener');

/**
 * Registrar menus
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
 * Suporte do tema
 */
function camisa10_theme_support() {
    add_theme_support('custom-logo');
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
}
add_action('after_setup_theme', 'camisa10_theme_support');
>>>>>>> 203dc77c76e83bed2d4b7c1ee49b1ff2eb6cadaf
