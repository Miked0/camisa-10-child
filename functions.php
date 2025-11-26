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
