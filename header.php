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
    /* HEADER STYLES - CAMISA 10 */
    
    :root {
        --header-height: 80px;
        --header-padding: 20px;
        --transition-speed: 0.3s;
    }

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

    .site-header.scrolled {
        background-color: rgba(255, 255, 255, 0.98);
        -webkit-backdrop-filter: blur(10px);
        backdrop-filter: blur(10px);
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
    }

    /* Restante do CSS inline do header */
    
    body {
        padding-top: var(--header-height);
    }
</style>

<header class="site-header">
    <div class="header-container">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo">
            <?php 
            $custom_logo_id = get_theme_mod('custom_logo');
            if ($custom_logo_id) {
                $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                if ($logo) {
                    echo '<img src="' . esc_url($logo[0]) . '" alt="' . esc_attr(get_bloginfo('name')) . '">';
                }
            } else {
                echo '<svg width="180" height="50"><text x="10" y="35">camisa</text><text x="135" y="35">10</text></svg>';
            }
            ?>
        </a>

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

        <div class="header-actions">
            <a href="<?php echo esc_url(home_url('/cursos')); ?>" class="header-cta">
                <?php esc_html_e('Ver Cursos', 'camisa10'); ?>
            </a>

            <button class="mobile-menu-toggle" aria-label="<?php esc_attr_e('Menu', 'camisa10'); ?>">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>
</header>

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
