<?php
/**
 * Camisa 10 Child Theme - Functions
 * @package Camisa10
 * @version 6.0.0 - CORRIGIDO
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

    // 1. BOOTSTRAP CSS (PRIMEIRO - ANTES DE TUDO)
    if (!wp_style_is('bootstrap', 'enqueued')) {
        wp_enqueue_style(
            'bootstrap',
            'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css',
            array(),
            '5.3.0'
        );
    }

    // 2. CSS VARIABLES (DESIGN SYSTEM)
    wp_enqueue_style(
        'camisa10-variables',
        get_stylesheet_directory_uri() . '/assets/css/custom-variables.css',
        array('bootstrap'),
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

    // 5. SLICK SLIDER CSS (OPCIONAL)
    wp_enqueue_style(
        'slick-css',
        'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css',
        array(),
        '1.8.1'
    );

    // 6. BOOTSTRAP JS (COM JQUERY)
    if (!wp_script_is('bootstrap', 'enqueued')) {
        wp_enqueue_script(
            'bootstrap',
            'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js',
            array('jquery'),
            '5.3.0',
            true
        );
    }

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
 * CORREÇÃO: ERRO DEPRECATED DO AVATAR
 * ============================================
 */
function camisa10_fix_avatar_deprecated($avatar, $id_or_email, $size, $default, $alt, $args) {
    // Prevenir erro quando $args['url'] é null
    if (isset($args['url']) && $args['url'] === null) {
        $args['url'] = '';
    }
    
    // Se avatar vazio, retornar padrão
    if (empty($avatar)) {
        $default_avatar = get_stylesheet_directory_uri() . '/assets/images/avatar-default.png';
        
        // Verificar se arquivo existe
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
    
    // Se for array (select, taxonomy, relationship)
    if (is_array($value)) {
        // ACF Select com return format 'array'
        if (isset($value['value'])) {
            return $value['value'];
        }
        
        // ACF Select com return format 'label'
        if (isset($value['label'])) {
            return $value['label'];
        }
        
        // Taxonomy ou relationship - pegar primeiro termo
        if (!empty($value)) {
            $first = reset($value);
            if (is_object($first) && isset($first->name)) {
                return $first->name;
            }
            return (string)$first;
        }
        
        return $default;
    }
    
    // Se for WP_Error
    if (is_wp_error($value)) {
        return $default;
    }
    
    // Se for vazio
    if (empty($value)) {
        return $default;
    }
    
    return $value;
}

/**
 * Helper para pegar número ACF com segurança
 */
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
 * HOTMART WEBHOOK (COM SEGURANÇA)
 * ============================================
 */
function camisa10_hotmart_webhook_listener() {
    // Verificar se é request do webhook
    if (!isset($_GET['hotmart_webhook'])) {
        return;
    }

    // VALIDAR TOKEN HOTMART (SEGURANÇA)
    $hotmart_token = get_option('camisa10_hotmart_webhook_token');
    $received_token = $_SERVER['HTTP_X_HOTMART_HOTTOK'] ?? '';

    // Token não configurado
    if (empty($hotmart_token)) {
        error_log('[Camisa10 Webhook] ERRO: Token não configurado no WordPress');
        http_response_code(500);
        exit('Webhook token not configured');
    }

    // Token incorreto = possível ataque
    if ($received_token !== $hotmart_token) {
        error_log('[Camisa10 Webhook] ALERTA: Token inválido - possível tentativa de fraude');
        error_log('[Camisa10 Webhook] IP: ' . ($_SERVER['REMOTE_ADDR'] ?? 'unknown'));
        http_response_code(401);
        exit('Unauthorized');
    }

    // RATE LIMITING (PROTEÇÃO DoS)
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $rate_limit_key = 'hotmart_webhook_' . md5($ip);
    $request_count = get_transient($rate_limit_key) ?: 0;
    
    if ($request_count > 10) {
        error_log('[Camisa10 Webhook] ALERTA: Rate limit excedido para IP: ' . $ip);
        http_response_code(429);
        exit('Too many requests');
    }
    
    set_transient($rate_limit_key, $request_count + 1, 60);

    // LER E VALIDAR PAYLOAD JSON
    $raw_data = file_get_contents('php://input');
    $data = json_decode($raw_data, true);

    // JSON inválido
    if (json_last_error() !== JSON_ERROR_NONE) {
        error_log('[Camisa10 Webhook] ERRO: JSON inválido - ' . json_last_error_msg());
        http_response_code(400);
        exit('Invalid JSON');
    }

    // Estrutura obrigatória faltando
    if (!isset($data['event']) || !isset($data['data']['buyer']) || !isset($data['data']['product'])) {
        error_log('[Camisa10 Webhook] ERRO: Payload incompleto');
        http_response_code(400);
        exit('Invalid payload structure');
    }

    // SANITIZAR E VALIDAR INPUTS
    $event = sanitize_text_field($data['event']);
    $product_id = sanitize_text_field($data['data']['product']['id'] ?? '');
    $buyer_email = sanitize_email($data['data']['buyer']['email'] ?? '');
    $buyer_name = sanitize_text_field($data['data']['buyer']['name'] ?? '');

    // Validar product_id
    if (empty($product_id) || !preg_match('/^[a-zA-Z0-9\-]+$/', $product_id)) {
        error_log('[Camisa10 Webhook] ERRO: Product ID inválido');
        http_response_code(400);
        exit('Invalid product ID');
    }

    // Validar email
    if (empty($buyer_email) || !is_email($buyer_email)) {
        error_log('[Camisa10 Webhook] ERRO: Email inválido');
        http_response_code(400);
        exit('Invalid email');
    }

    // PROCESSAR EVENTO
    if ($event === 'PURCHASE_APPROVED' || $event === 'PURCHASE_COMPLETE') {
        // Processar compra...
        error_log('[Camisa10 Webhook] Compra aprovada: ' . $buyer_email . ' - Produto: ' . $product_id);
    }

    // RESPONDER COM SUCESSO
    http_response_code(200);
    echo wp_json_encode(array(
        'status' => 'success',
        'timestamp' => current_time('mysql')
    ));
    exit;
}
add_action('init', 'camisa10_hotmart_webhook_listener');

/**
 * Enfileira assets da página de curso individual
 */
function camisa10_single_curso_assets() {
    // Só carregar em single curso
    if (!is_singular('curso')) {
        return;
    }

    // CSS do curso
    wp_enqueue_style(
        'camisa10-curso-css',
        get_stylesheet_directory_uri() . '/assets/css/single-curso.css',
        array(),
        filemtime(get_stylesheet_directory() . '/assets/css/single-curso.css')
    );

    // JS do curso
    wp_enqueue_script(
        'camisa10-curso-js',
        get_stylesheet_directory_uri() . '/assets/js/single-curso.js',
        array('jquery'),
        filemtime(get_stylesheet_directory() . '/assets/js/single-curso.js'),
        true
    );
}
add_action('wp_enqueue_scripts', 'camisa10_single_curso_assets', 30);
