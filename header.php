<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
    /* ========================================
       HEADER CAMISA 10 - TRANSPARENT TO WHITE
       ======================================== */
    
    /* CSS Variables */
    :root {
        --color-amarelo: #FAF323;
        --color-azul: #0A3BE8;
        --color-verde: #02FB9A;
        --color-branco: #FFFFFF;
        --color-preto: #000000;
        --color-cinza-escuro: #282828;
        --color-cinza-claro: #E5DEDE;
        --color-off-white: #F2F2F2;
        --header-height: 90px;
        --transition-fast: 0.2s ease;
        --transition-normal: 0.3s ease;
        --transition-slow: 0.5s ease;
    }
    
    /* Reset para o Header */
    .site-header * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    
    /* Header Principal - TRANSPARENTE NO TOPO */
    .site-header {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: var(--header-height);
        background-color: transparent !important;
        box-shadow: none;
        z-index: 1000;
        transition: all var(--transition-slow);
    }
    
    /* Header ao Rolar - BRANCO COM SOMBRA */
    .site-header.scrolled {
        background-color: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(10px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        height: 80px;
    }
    
    .header-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 40px;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 32px;
    }
    
    /* Logo */
    .header-logo {
        flex-shrink: 0;
        transition: all var(--transition-normal);
    }
    
    .logo-link {
        display: inline-block;
        line-height: 0;
    }
    
    .logo-img {
        height: 55px;
        width: auto;
        max-width: 200px;
        transition: all var(--transition-normal);
        filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
    }
    
    /* Logo menor ao rolar */
    .site-header.scrolled .logo-img {
        height: 45px;
        filter: none;
    }
    
    .logo-link:hover .logo-img {
        transform: scale(1.05);
    }
    
    /* Navegação */
    .header-nav {
        flex: 1;
        display: flex;
        justify-content: center;
    }
    
    .nav-menu {
        display: flex;
        align-items: center;
        gap: 36px;
        list-style: none;
        margin: 0;
        padding: 0;
    }
    
    .nav-item {
        position: relative;
    }
    
    .nav-link {
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 10px 16px;
        font-size: 16px;
        font-weight: 600;
        color: var(--color-branco);
        text-decoration: none;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        transition: all var(--transition-fast);
        position: relative;
    }
    
    /* Cor dos links muda ao rolar */
    .site-header.scrolled .nav-link {
        color: var(--color-cinza-escuro);
        text-shadow: none;
    }
    
    .nav-link:hover {
        color: var(--color-amarelo);
    }
    
    .site-header.scrolled .nav-link:hover {
        color: var(--color-azul);
    }
    
    .nav-link i {
        font-size: 12px;
        transition: transform var(--transition-fast);
    }
    
    .nav-item:hover .nav-link i {
        transform: rotate(180deg);
    }
    
    /* Underline Effect */
    .nav-link::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 3px;
        background-color: var(--color-amarelo);
        transition: width var(--transition-fast);
        border-radius: 2px;
    }
    
    .site-header.scrolled .nav-link::after {
        background-color: var(--color-azul);
    }
    
    .nav-link:hover::after,
    .nav-link.active::after {
        width: 85%;
    }
    
    /* Submenu */
    .submenu {
        position: absolute;
        top: 100%;
        left: 0;
        min-width: 240px;
        background-color: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(10px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
        border-radius: 12px;
        padding: 12px;
        list-style: none;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: all var(--transition-normal);
        margin-top: 12px;
    }
    
    .nav-item:hover .submenu {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }
    
    .submenu li {
        margin: 0;
    }
    
    .submenu a {
        display: block;
        padding: 14px 18px;
        font-size: 15px;
        font-weight: 500;
        color: var(--color-cinza-escuro);
        text-decoration: none;
        text-shadow: none;
        border-radius: 8px;
        transition: all var(--transition-fast);
    }
    
    .submenu a:hover {
        background: linear-gradient(135deg, var(--color-azul) 0%, var(--color-verde) 100%);
        color: var(--color-branco);
        transform: translateX(5px);
    }
    
    /* Header Actions */
    .header-actions {
        display: flex;
        align-items: center;
        gap: 18px;
    }
    
    /* Botão de Busca */
    .search-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 44px;
        height: 44px;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        color: var(--color-branco);
        cursor: pointer;
        transition: all var(--transition-fast);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    
    .site-header.scrolled .search-btn {
        background: transparent;
        border-color: var(--color-cinza-claro);
        color: var(--color-cinza-escuro);
        box-shadow: none;
    }
    
    .search-btn:hover {
        background-color: var(--color-azul);
        border-color: var(--color-azul);
        color: var(--color-branco);
        transform: scale(1.1);
    }
    
    /* Botão Login */
    .btn-login {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 11px 22px;
        font-size: 15px;
        font-weight: 600;
        color: var(--color-branco);
        background-color: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-radius: 10px;
        text-decoration: none;
        transition: all var(--transition-fast);
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }
    
    .site-header.scrolled .btn-login {
        color: var(--color-cinza-escuro);
        background-color: transparent;
        border-color: var(--color-cinza-claro);
        text-shadow: none;
    }
    
    .btn-login:hover {
        background-color: var(--color-branco);
        border-color: var(--color-branco);
        color: var(--color-azul);
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
    }
    
    /* Botão CTA - SEMPRE VISÍVEL E COLORIDO */
    .header-btn-cta {
        display: inline-flex;
        align-items: center;
        padding: 13px 32px;
        font-size: 16px;
        font-weight: 700;
        color: var(--color-preto);
        background: linear-gradient(135deg, var(--color-amarelo) 0%, var(--color-verde) 100%);
        border: none;
        border-radius: 10px;
        text-decoration: none;
        cursor: pointer;
        transition: all var(--transition-fast);
        box-shadow: 0 6px 20px rgba(250, 243, 35, 0.4);
        text-shadow: none;
    }
    
    .header-btn-cta:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 28px rgba(250, 243, 35, 0.5);
        background: linear-gradient(135deg, var(--color-verde) 0%, var(--color-amarelo) 100%);
    }
    
    .header-btn-cta:active {
        transform: translateY(-1px);
    }
    
    /* Menu Mobile Toggle */
    .mobile-menu-toggle {
        display: none;
        flex-direction: column;
        gap: 5px;
        width: 32px;
        height: 32px;
        background: transparent;
        border: none;
        cursor: pointer;
        padding: 4px;
    }
    
    .hamburger-line {
        width: 100%;
        height: 3px;
        background-color: var(--color-branco);
        border-radius: 2px;
        transition: all var(--transition-fast);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }
    
    .site-header.scrolled .hamburger-line {
        background-color: var(--color-cinza-escuro);
        box-shadow: none;
    }
    
    .mobile-menu-toggle.active .hamburger-line:nth-child(1) {
        transform: rotate(45deg) translateY(10px);
    }
    
    .mobile-menu-toggle.active .hamburger-line:nth-child(2) {
        opacity: 0;
    }
    
    .mobile-menu-toggle.active .hamburger-line:nth-child(3) {
        transform: rotate(-45deg) translateY(-10px);
    }
    
    /* Mobile Navigation */
    .mobile-nav {
        display: none;
        position: fixed;
        top: var(--header-height);
        left: 0;
        width: 100%;
        height: calc(100vh - var(--header-height));
        background-color: var(--color-branco);
        padding: 24px;
        overflow-y: auto;
        transform: translateX(-100%);
        transition: transform var(--transition-normal);
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12);
        z-index: 999;
    }
    
    .mobile-nav.active {
        transform: translateX(0);
    }
    
    .mobile-menu {
        list-style: none;
        margin: 0 0 32px 0;
        padding: 0;
    }
    
    .mobile-menu li {
        border-bottom: 1px solid var(--color-cinza-claro);
    }
    
    .mobile-menu a {
        display: block;
        padding: 18px 0;
        font-size: 18px;
        font-weight: 600;
        color: var(--color-cinza-escuro);
        text-decoration: none;
        transition: all var(--transition-fast);
    }
    
    .mobile-menu a:hover {
        color: var(--color-azul);
        padding-left: 10px;
    }
    
    /* Mobile Actions */
    .mobile-actions {
        display: flex;
        flex-direction: column;
        gap: 16px;
        margin-top: 32px;
    }
    
    .mobile-btn-login,
    .mobile-header-btn-cta {
        display: block;
        width: 100%;
        padding: 18px;
        text-align: center;
        font-size: 16px;
        font-weight: 700;
        text-decoration: none;
        border-radius: 10px;
        transition: all var(--transition-fast);
    }
    
    .mobile-btn-login {
        color: var(--color-cinza-escuro);
        background-color: var(--color-off-white);
        border: 2px solid var(--color-cinza-claro);
    }
    
    .mobile-btn-login:hover {
        background-color: var(--color-cinza-claro);
    }
    
    .mobile-header-btn-cta {
        color: var(--color-preto);
        background: linear-gradient(135deg, var(--color-amarelo) 0%, var(--color-verde) 100%);
        border: none;
        box-shadow: 0 6px 20px rgba(250, 243, 35, 0.3);
    }
    
    .mobile-header-btn-cta:hover {
        box-shadow: 0 8px 28px rgba(250, 243, 35, 0.5);
    }
    
    /* Espaçamento para conteúdo não ficar atrás do header fixo */
    body {
        padding-top: var(--header-height);
    }
    
    /* Responsividade */
    @media (max-width: 1024px) {
        .header-nav {
            display: none;
        }
        
        .search-btn,
        .btn-login {
            display: none;
        }
        
        .mobile-menu-toggle {
            display: flex;
        }
        
        .mobile-nav {
            display: block;
        }
    }
    
    @media (max-width: 768px) {
        :root {
            --header-height: 75px;
        }
        
        .header-container {
            padding: 0 20px;
        }
        
        .logo-img {
            height: 45px;
        }
        
        .site-header.scrolled .logo-img {
            height: 38px;
        }
        
        .header-btn-cta {
            padding: 11px 24px;
            font-size: 14px;
        }
    }
    
    @media (max-width: 480px) {
        :root {
            --header-height: 70px;
        }
        
        .header-container {
            padding: 0 16px;
        }
        
        .logo-img {
            height: 40px;
        }
        
        .header-btn-cta {
            padding: 10px 20px;
            font-size: 13px;
        }
    }
    
    /* Scroll Lock quando menu mobile aberto */
    body.mobile-menu-open {
        overflow: hidden;
    }
    
    /* Animação suave de entrada */
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .site-header {
        animation: fadeInDown 0.6s ease-out;
    }
    
    /* Efeito de glassmorphism ao rolar */
    .site-header.scrolled::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(
            180deg,
            rgba(255, 255, 255, 0.9) 0%,
            rgba(255, 255, 255, 0.95) 100%
        );
        z-index: -1;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }
    </style>
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- HEADER -->
<header class="site-header">
    <div class="header-container">
        
        <!-- Logo -->
        <div class="header-logo">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="logo-link">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo.svg" 
                     alt="<?php bloginfo('name'); ?>" 
                     class="logo-img">
            </a>
        </div>
        
        <!-- Navigation Menu -->
        <nav class="header-nav">
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="<?php echo home_url('/'); ?>" class="nav-link">Início</a>
                </li>
                <li class="nav-item has-submenu">
                    <a href="<?php echo home_url('/cursos'); ?>" class="nav-link">
                        Cursos <i class="fas fa-chevron-down"></i>
                    </a>
                    <ul class="submenu">
                        <li><a href="<?php echo home_url('/cursos/lideranca'); ?>">Liderança</a></li>
                        <li><a href="<?php echo home_url('/cursos/estrategia'); ?>">Estratégia</a></li>
                        <li><a href="<?php echo home_url('/cursos/gestao'); ?>">Gestão</a></li>
                        <li><a href="<?php echo home_url('/cursos'); ?>">Todos os Cursos</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="<?php echo home_url('/sobre'); ?>" class="nav-link">Sobre</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo home_url('/blog'); ?>" class="nav-link">Blog</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo home_url('/contato'); ?>" class="nav-link">Contato</a>
                </li>
            </ul>
        </nav>
        
        <!-- Header Actions -->
        <div class="header-actions">
            
            <!-- Search Button -->
            <button class="search-btn" aria-label="Buscar">
                <i class="fas fa-search"></i>
            </button>
            
            <!-- Login/User -->
            <?php if (is_user_logged_in()) : ?>
                <a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>" 
                   class="btn-login">
                    <i class="fas fa-user-circle"></i>
                    Minha Conta
                </a>
            <?php else : ?>
                <a href="<?php echo esc_url(wp_login_url()); ?>" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i>
                    Entrar
                </a>
            <?php endif; ?>
            
            <!-- CTA Button -->
            <a href="<?php echo home_url('/cursos'); ?>" class="header-btn-cta">
                Começar Agora
            </a>
            
            <!-- Mobile Menu Toggle -->
            <button class="mobile-menu-toggle" aria-label="Menu Mobile">
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
            </button>
            
        </div>
    </div>
</header>

<!-- Mobile Navigation -->
<nav class="mobile-nav">
    <ul class="mobile-menu">
        <li><a href="<?php echo home_url('/'); ?>">Início</a></li>
        <li><a href="<?php echo home_url('/cursos'); ?>">Cursos</a></li>
        <li><a href="<?php echo home_url('/cursos/lideranca'); ?>">→ Liderança</a></li>
        <li><a href="<?php echo home_url('/cursos/estrategia'); ?>">→ Estratégia</a></li>
        <li><a href="<?php echo home_url('/cursos/gestao'); ?>">→ Gestão</a></li>
        <li><a href="<?php echo home_url('/sobre'); ?>">Sobre</a></li>
        <li><a href="<?php echo home_url('/blog'); ?>">Blog</a></li>
        <li><a href="<?php echo home_url('/contato'); ?>">Contato</a></li>
    </ul>
    
    <div class="mobile-actions">
        <?php if (!is_user_logged_in()) : ?>
            <a href="<?php echo esc_url(wp_login_url()); ?>" class="mobile-btn-login">
                Entrar
            </a>
        <?php endif; ?>
        <a href="<?php echo home_url('/cursos'); ?>" class="mobile-header-btn-cta">
            Começar Agora
        </a>
    </div>
</nav>

<script>
// Header Transparente que vira Branco ao Rolar
(function($) {
    'use strict';
    
    $(document).ready(function() {
        const $toggle = $('.mobile-menu-toggle');
        const $mobileNav = $('.mobile-nav');
        const $body = $('body');
        const $header = $('.site-header');
        
        // Toggle Mobile Menu
        $toggle.on('click', function() {
            $(this).toggleClass('active');
            $mobileNav.toggleClass('active');
            $body.toggleClass('mobile-menu-open');
        });
        
        // Close menu ao clicar em link
        $('.mobile-menu a').on('click', function() {
            $toggle.removeClass('active');
            $mobileNav.removeClass('active');
            $body.removeClass('mobile-menu-open');
        });
        
        // Header Scroll Effect - TRANSPARENTE → BRANCO
        $(window).on('scroll', function() {
            if ($(this).scrollTop() > 50) {
                $header.addClass('scrolled');
            } else {
                $header.removeClass('scrolled');
            }
        });
        
        // Highlight active menu item
        const currentUrl = window.location.href;
        $('.nav-link, .mobile-menu a').each(function() {
            if (this.href === currentUrl) {
                $(this).addClass('active');
            }
        });
        
        // Smooth scroll para links internos
        $('a[href^="#"]').on('click', function(e) {
            const target = $(this.hash);
            if (target.length) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: target.offset().top - 80
                }, 800);
            }
        });
    });
    
})(jQuery);
</script>