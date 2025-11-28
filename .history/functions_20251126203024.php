<?php
/**
 * Functions - Camisa 10 Child Theme
 * 
 * @package OneKorse Child
 * @since 1.0.0
 * @updated 2025-11-26 - Corrigido: Validação webhook Hotmart com token, sanitização completa, rate limiting
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * ============================================
 * ENQUEUE STYLES & SCRIPTS
 * ============================================
 */

/**
 * Enfileira estilos e scripts do tema filho
 */
function camisa10_enqueue_styles() {
    // Parent theme style
    wp_enqueue_style('onekorse-parent-style', get_template_directory_uri() . '/style.css');
    
    // Child theme style
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
    if (!is_page_template('page-home.php') && !is_front_page()) {
        return;
    }

    // CSS Variables (Design System)
    wp_enqueue_style(
        'camisa10-variables',
        get_stylesheet_directory_uri() . '/assets/css/custom-variables.css',
        array(),
        filemtime(get_stylesheet_directory() . '/assets/css/custom-variables.css')
    );

    // Custom Home CSS
    wp_enqueue_style(
        'camisa10-home-css',
        get_stylesheet_directory_uri() . '/assets/css/custom-home.css',
        array('camisa10-variables'),
        filemtime(get_stylesheet_directory() . '/assets/css/custom-home.css')
    );

    // Bootstrap 5 (CDN)
    wp_enqueue_script(
        'bootstrap-js',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js',
        array('jquery'),
        '5.3.0',
        true
    );

    // Slick Slider
    wp_enqueue_style(
        'slick-css',
        'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css',
        array(),
        '1.8.1'
    );
    
    wp_enqueue_script(
        'slick-js',
        'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js',
        array('jquery'),
        '1.8.1',
        true
    );

    // Swiper
    wp_enqueue_style(
        'swiper-css',
        'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css',
        array(),
        '8.4.7'
    );
    
    wp_enqueue_script(
        'swiper',
        'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js',
        array(),
        '8.4.7',
        true
    );

    // Custom Home JS
    wp_enqueue_script(
        'camisa10-home-js',
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
    wp_enqueue_script(
        'camisa10-header-js',
        get_stylesheet_directory_uri() . '/assets/js/header.js',
        array(),
        filemtime(get_stylesheet_directory() . '/assets/js/header.js'),
        true
    );
}
add_action('wp_enqueue_scripts', 'camisa10_enqueue_header_assets', 20);

/**
 * ============================================
 * HOTMART WEBHOOK (COM SEGURANÇA)
 * ============================================
 */

/**
 * ✅ Webhook Hotmart com Validação de Segurança
 * 
 * IMPORTANTE: Configurar token no admin WordPress:
 * update_option('camisa10_hotmart_webhook_token', 'SEU_TOKEN_HOTMART_AQUI');
 * 
 * Token obtido em: Hotmart > Configurações > Webhooks > Hot Token
 */
function camisa10_hotmart_webhook_listener() {
    // Verificar se é request do webhook
    if (!isset($_GET['hotmart_webhook'])) {
        return;
    }

    // ============================================
    // PASSO 1: VALIDAR TOKEN HOTMART (SEGURANÇA)
    // ============================================
    $hotmart_token = get_option('camisa10_hotmart_webhook_token');
    $received_token = $_SERVER['HTTP_X_HOTMART_HOTTOK'] ?? '';
    
    // Token não configurado
    if (empty($hotmart_token)) {
        error_log('[Camisa10 Webhook] ERRO: Token não configurado no WordPress');
        http_response_code(500);
        exit('Webhook token not configured. Configure via: update_option("camisa10_hotmart_webhook_token", "TOKEN")');
    }
    
    // Token incorreto = possível ataque
    if ($received_token !== $hotmart_token) {
        error_log('[Camisa10 Webhook] ALERTA: Token inválido - possível tentativa de fraude');
        error_log('[Camisa10 Webhook] IP: ' . ($_SERVER['REMOTE_ADDR'] ?? 'unknown'));
        error_log('[Camisa10 Webhook] User-Agent: ' . ($_SERVER['HTTP_USER_AGENT'] ?? 'unknown'));
        http_response_code(401);
        exit('Unauthorized');
    }

    // ============================================
    // PASSO 2: RATE LIMITING (PROTEÇÃO DoS)
    // ============================================
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $rate_limit_key = 'hotmart_webhook_' . md5($ip);
    $request_count = get_transient($rate_limit_key) ?: 0;
    
    if ($request_count > 10) {
        error_log('[Camisa10 Webhook] ALERTA: Rate limit excedido para IP: ' . $ip);
        http_response_code(429);
        exit('Too many requests');
    }
    
    set_transient($rate_limit_key, $request_count + 1, 60); // 10 requests/minuto

    // ============================================
    // PASSO 3: LER E VALIDAR PAYLOAD JSON
    // ============================================
    $raw_data = file_get_contents('php://input');
    $data = json_decode($raw_data, true);
    
    // JSON inválido
    if (json_last_error() !== JSON_ERROR_NONE) {
        error_log('[Camisa10 Webhook] ERRO: JSON inválido - ' . json_last_error_msg());
        http_response_code(400);
        exit('Invalid JSON: ' . json_last_error_msg());
    }
    
    // Estrutura obrigatória faltando
    if (!isset($data['event']) || !isset($data['data']['buyer']) || !isset($data['data']['product'])) {
        error_log('[Camisa10 Webhook] ERRO: Payload incompleto');
        error_log('[Camisa10 Webhook] Payload: ' . wp_json_encode($data));
        http_response_code(400);
        exit('Invalid payload structure');
    }

    // ============================================
    // PASSO 4: SANITIZAR E VALIDAR INPUTS
    // ============================================
    $event = sanitize_text_field($data['event']);
    $product_id = sanitize_text_field($data['data']['product']['id'] ?? '');
    $product_name = sanitize_text_field($data['data']['product']['name'] ?? '');
    $buyer_email = sanitize_email($data['data']['buyer']['email'] ?? '');
    $buyer_name = sanitize_text_field($data['data']['buyer']['name'] ?? '');
    
    // Validar product_id (apenas alfanuméricos e hífen)
    if (empty($product_id) || !preg_match('/^[a-zA-Z0-9\-]+$/', $product_id)) {
        error_log('[Camisa10 Webhook] ERRO: Product ID inválido: ' . $product_id);
        http_response_code(400);
        exit('Invalid product ID format');
    }
    
    // Validar tamanho do product_id
    if (strlen($product_id) > 50) {
        error_log('[Camisa10 Webhook] ERRO: Product ID muito longo: ' . strlen($product_id) . ' chars');
        http_response_code(400);
        exit('Product ID too long');
    }
    
    // Validar email
    if (empty($buyer_email) || !is_email($buyer_email)) {
        error_log('[Camisa10 Webhook] ERRO: Email inválido: ' . $buyer_email);
        http_response_code(400);
        exit('Invalid email address');
    }
    
    // Validar nome do comprador
    if (empty($buyer_name)) {
        error_log('[Camisa10 Webhook] ERRO: Nome do comprador vazio');
        http_response_code(400);
        exit('Buyer name is required');
    }

    // Debug log (apenas em desenvolvimento)
    if (defined('WP_DEBUG') && WP_DEBUG) {
        error_log('[Camisa10 Webhook] Evento: ' . $event);
        error_log('[Camisa10 Webhook] Produto: ' . $product_id . ' (' . $product_name . ')');
        error_log('[Camisa10 Webhook] Comprador: ' . $buyer_name . ' <' . $buyer_email . '>');
    }

    // ============================================
    // PASSO 5: PROCESSAR EVENTO
    // ============================================
    if ($event === 'PURCHASE_APPROVED' || $event === 'PURCHASE_COMPLETE') {
        
        // Buscar curso pelo product_id
        $query = new WP_Query(array(
            'post_type' => 'curso',
            'post_status' => 'publish',
            'posts_per_page' => 1,
            'no_found_rows' => true,
            'update_post_meta_cache' => false,
            'meta_query' => array(
                array(
                    'key' => 'hotmart_product_id',
                    'value' => $product_id,
                    'compare' => '=',
                    'type' => 'CHAR'
                )
            )
        ));
        
        if (!$query->have_posts()) {
            error_log('[Camisa10 Webhook] ERRO: Curso não encontrado para produto: ' . $product_id);
            wp_reset_postdata();
            http_response_code(404);
            exit('Course not found for product: ' . $product_id);
        }
        
        $curso_id = $query->posts[0]->ID;
        wp_reset_postdata();
        
        // Verificar se usuário existe
        $user = get_user_by('email', $buyer_email);
        
        if (!$user) {
            // Criar usuário
            $username = sanitize_user(strtolower(str_replace(' ', '', $buyer_name)));
            $password = wp_generate_password(12, true);
            
            $user_id = wp_create_user($username, $password, $buyer_email);
            
            if (is_wp_error($user_id)) {
                error_log('[Camisa10 Webhook] ERRO ao criar usuário: ' . $user_id->get_error_message());
                http_response_code(500);
                exit('Error creating user: ' . $user_id->get_error_message());
            }
            
            // Atualizar nome do usuário
            wp_update_user(array(
                'ID' => $user_id,
                'display_name' => $buyer_name,
                'first_name' => $buyer_name
            ));
            
            // Enviar credenciais por email
            wp_new_user_notification($user_id, null, 'both');
            
            error_log('[Camisa10 Webhook] Novo usuário criado: ' . $user_id . ' (' . $buyer_email . ')');
            
        } else {
            $user_id = $user->ID;
            error_log('[Camisa10 Webhook] Usuário existente: ' . $user_id . ' (' . $buyer_email . ')');
        }
        
        // Matricular usuário no curso
        if (function_exists('onekorse_enroll_user')) {
            $enrolled = onekorse_enroll_user($user_id, $curso_id);
            
            if (is_wp_error($enrolled)) {
                error_log('[Camisa10 Webhook] ERRO ao matricular: ' . $enrolled->get_error_message());
                
                // Notificar admin
                wp_mail(
                    get_option('admin_email'),
                    '[Camisa10] Falha na matrícula automática',
                    sprintf(
                        "Falha ao matricular usuário:\n\nUsuário ID: %d\nCurso ID: %d\nProduto Hotmart: %s\nErro: %s",
                        $user_id,
                        $curso_id,
                        $product_id,
                        $enrolled->get_error_message()
                    )
                );
                
                http_response_code(500);
                exit('Error enrolling user: ' . $enrolled->get_error_message());
            }
            
            error_log('[Camisa10 Webhook] Usuário matriculado com sucesso: User ' . $user_id . ' -> Curso ' . $curso_id);
            
        } else {
            error_log('[Camisa10 Webhook] ERRO CRÍTICO: Função onekorse_enroll_user não existe!');
            
            // Notificar admin
            wp_mail(
                get_option('admin_email'),
                '[Camisa10] ERRO CRÍTICO: Função de matrícula não encontrada',
                sprintf(
                    "A função onekorse_enroll_user() não existe.\n\nUsuário %d NÃO foi matriculado no curso %d.\nProduto Hotmart: %s",
                    $user_id,
                    $curso_id,
                    $product_id
                )
            );
            
            http_response_code(500);
            exit('Enrollment function not available');
        }
    }

    // ============================================
    // PASSO 6: RESPONDER COM SUCESSO
    // ============================================
    http_response_code(200);
    echo wp_json_encode(array(
        'status' => 'success',
        'message' => 'Webhook processed successfully',
        'event' => $event,
        'timestamp' => current_time('mysql')
    ));
    exit;
}
add_action('init', 'camisa10_hotmart_webhook_listener');

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
