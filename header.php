<?php
/**
 * Header Template - Camisa 10
 * 
 * Template padrão do header para todas as páginas
 * Integrado com WordPress e tema OneKorse
 * 
 * @package Camisa10
 * @version 1.0.0
 * @updated 2025-11-26 - Corrigido: Vendor prefix -webkit-backdrop-filter adicionado para Safari
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<style>
    /* ========================================
       HEADER STYLES - CAMISA 10
       ======================================== */
    
    :root {
        --header-height: 80px;
        --header-padding: 20px;
        --transition-speed: 0.3s;
    }

    /* Site Header */
    .site-header {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
        background-color: rgba(255, 255, 255, 0.95);
        transition: all var(--transition-speed) ease;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    /* Scrolled State */
    .site-header.scrolled {
        background-color: rgba(255, 255, 255, 0.98);
        -webkit-backdrop-filter: blur(10px);
        backdrop-filter: blur(10px);
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
    }

    /* Container */
    .header-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 var(--header-padding);
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: var(--header-height);
    }

    /* Logo */
    .site-logo {
        display: flex;
        align-items: center;
        text-decoration: none;
    }

    .site-logo img,
    .site-logo svg {
        height: 40px;
        width: auto;
        max-width: 160px;
    }

    /* Navigation */
    .main-nav {
        display: flex;
        align-items: center;
        gap: 40px;
    }

    .nav-menu {
        display: flex;
        list-style: none;
        margin: 0;
        padding: 0;
        gap: 32px;
    }

    .nav-link {
        color: var(--color-text, #13343b);
        text-decoration: none;
        font-weight: 500;
        font-size: 14px;
        transition: color var(--transition-speed) ease;
        position: relative;
    }

    .nav-link::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 0;
        height: 2px;
        background: var(--color-primary, #21808d);
        transition: width var(--transition-speed) ease;
    }

    .nav-link:hover,
    .nav-link.active {
        color: var(--color-primary, #21808d);
    }

    .nav-link:hover::after,
    .nav-link.active::after {
        width: 100%;
    }

    /* Header Actions */
    .header-actions {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .search-btn,
    .user-btn {
        background: transparent;
        border: none;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        border-radius: 50%;
        transition: background var(--transition-speed) ease;
        color: var(--color-text, #13343b);
    }

    .search-btn:hover,
    .user-btn:hover {
        background: rgba(var(--color-teal-500-rgb, 33, 128, 141), 0.1);
    }

    .header-cta {
        background: var(--color-primary, #21808d);
        color: white;
        padding: 10px 24px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        transition: all var(--transition-speed) ease;
        border: none;
        cursor: pointer;
    }

    .header-cta:hover {
        background: var(--color-primary-hover, #1d748f);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(33, 128, 141, 0.3);
    }

    /* Mobile Menu Toggle */
    .mobile-menu-toggle {
        display: none;
        background: transparent;
        border: none;
        width: 40px;
        height: 40px;
        cursor: pointer;
        position: relative;
        z-index: 1001;
    }

    .mobile-menu-toggle span {
        display: block;
        width: 24px;
        height: 2px;
        background: var(--color-text, #13343b);
        margin: 5px auto;
        transition: all var(--transition-speed) ease;
    }

    .mobile-menu-toggle.active span:nth-child(1) {
        transform: rotate(45deg) translate(5px, 5px);
    }

    .mobile-menu-toggle.active span:nth-child(2) {
        opacity: 0;
    }

    .mobile-menu-toggle.active span:nth-child(3) {
        transform: rotate(-45deg) translate(7px, -6px);
    }

    /* Mobile Nav */
    .mobile-nav {
        display: none;
        position: fixed;
        top: 0;
        right: -100%;
        width: 300px;
        height: 100vh;
        background: white;
        box-shadow: -2px 0 20px rgba(0, 0, 0, 0.1);
        padding: 100px 30px 30px;
        transition: right var(--transition-speed) ease;
        z-index: 999;
        overflow-y: auto;
    }

    .mobile-nav.active {
        right: 0;
    }

    .mobile-menu {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .mobile-menu li {
        margin-bottom: 20px;
    }

    .mobile-menu a {
        color: var(--color-text, #13343b);
        text-decoration: none;
        font-weight: 500;
        font-size: 16px;
        display: block;
        padding: 10px 0;
        transition: color var(--transition-speed) ease;
    }

    .mobile-menu a:hover,
    .mobile-menu a.active {
        color: var(--color-primary, #21808d);
    }

    .mobile-submenu {
        display: none;
        padding-left: 20px;
        margin-top: 10px;
    }

    .mobile-submenu.active {
        display: block;
    }

    /* Dark Mode */
    @media (prefers-color-scheme: dark) {
        .site-header {
            background-color: rgba(31, 33, 33, 0.95);
        }

        .site-header.scrolled {
            background-color: rgba(31, 33, 33, 0.98);
            -webkit-backdrop-filter: blur(10px);
            backdrop-filter: blur(10px);
        }

        .nav-link,
        .search-btn,
        .user-btn,
        .mobile-menu a {
            color: var(--color-gray-200, #f5f5f5);
        }

        .mobile-nav {
            background: var(--color-charcoal-800, #262828);
        }

        .mobile-menu-toggle span {
            background: var(--color-gray-200, #f5f5f5);
        }
    }

    [data-color-scheme="dark"] .site-header {
        background-color: rgba(31, 33, 33, 0.95);
    }

    [data-color-scheme="dark"] .site-header.scrolled {
        background-color: rgba(31, 33, 33, 0.98);
        -webkit-backdrop-filter: blur(10px);
        backdrop-filter: blur(10px);
    }

    [data-color-scheme="dark"] .nav-link,
    [data-color-scheme="dark"] .search-btn,
    [data-color-scheme="dark"] .user-btn,
    [data-color-scheme="dark"] .mobile-menu a {
        color: var(--color-gray-200, #f5f5f5);
    }

    [data-color-scheme="dark"] .mobile-nav {
        background: var(--color-charcoal-800, #262828);
    }

    [data-color-scheme="dark"] .mobile-menu-toggle span {
        background: var(--color-gray-200, #f5f5f5);
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .main-nav {
            display: none;
        }

        .mobile-menu-toggle,
        .mobile-nav {
            display: block;
        }

        .header-actions .search-btn,
        .header-actions .user-btn {
            display: none;
        }
    }

    @media (max-width: 768px) {
        :root {
            --header-height: 70px;
            --header-padding: 16px;
        }

        .site-logo img,
        .site-logo svg {
            height: 32px;
        }

        .header-cta {
            padding: 8px 16px;
            font-size: 13px;
        }
    }

    /* Body Offset */
    body {
        padding-top: var(--header-height);
    }

    body.mobile-menu-open {
        overflow: hidden;
    }
</style>

<!-- HEADER -->
<header class="site-header">
    <div class="header-container">
        <!-- Logo -->
        <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo">
            <?php 
            $custom_logo_id = get_theme_mod('custom_logo');
            if ($custom_logo_id) {
                $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                if ($logo) {
                    echo '<img src="' . esc_url($logo[0]) . '" alt="' . esc_attr(get_bloginfo('name')) . '">';
                }
            } else {
                ?>
                <svg width="180" height="50" viewBox="0 0 180 50" xmlns="http://www.w3.org/2000/svg">
                    <text x="10" y="35" font-family="Arial Black, sans-serif" font-size="32" font-weight="900" fill="#13343b">camisa</text>
                    <text x="135" y="35" font-family="Arial Black, sans-serif" font-size="32" font-weight="900" fill="#21808d">10</text>
                </svg>
                <?php
            }
            ?>
        </a>

        <!-- Desktop Navigation -->
        <nav class="main-nav">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_class'     => 'nav-menu',
                'container'      => false,
                'fallback_cb'    => false,
                'link_class'     => 'nav-link',
            ));
            ?>
        </nav>

        <!-- Header Actions -->
        <div class="header-actions">
            <button class="search-btn" aria-label="<?php esc_attr_e('Buscar', 'camisa10'); ?>">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    ircle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.35-4.35"></path>
                </svg>
            </button>

            <?php if (is_user_logged_in()) : ?>
                <a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>" class="user-btn" aria-label="<?php esc_attr_e('Minha Conta', 'camisa10'); ?>">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        ircle cx="12" cy="7" r="4"></circle>
                    </svg>
                </a>
            <?php else : ?>
                <a href="<?php echo esc_url(wp_login_url()); ?>" class="user-btn" aria-label="<?php esc_attr_e('Login', 'camisa10'); ?>">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        ircle cx="12" cy="7" r="4"></circle>
                    </svg>
                </a>
            <?php endif; ?>

            <a href="<?php echo esc_url(home_url('/cursos')); ?>" class="header-cta">
                <?php esc_html_e('Ver Cursos', 'camisa10'); ?>
            </a>

            <!-- Mobile Menu Toggle -->
            <button class="mobile-menu-toggle" aria-label="<?php esc_attr_e('Menu', 'camisa10'); ?>">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>
</header>

<!-- Mobile Navigation -->
<nav class="mobile-nav">
    <?php
    wp_nav_menu(array(
        'theme_location' => 'primary',
        'menu_class'     => 'mobile-menu',
        'container'      => false,
        'fallback_cb'    => false,
    ));
    ?>
</nav>
