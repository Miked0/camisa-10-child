<?php
/**
 * Header Template - Camisa 10
 * 
 * @package Camisa10
 * @version 8.5.1 - CLASSES CORRIGIDAS PARA MATCH COM header.css
 * @updated 2025-11-27
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

<header class="site-header">
    <div class="header-container">
        
        <!-- LOGO: Mudado .site-logo → .header-logo -->
        <div class="header-logo">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="logo-link">
                <?php 
                $custom_logo_id = get_theme_mod('custom_logo');
                if ($custom_logo_id) {
                    $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                    if ($logo) {
                        // Adicionado classe .logo-img
                        echo '<img src="' . esc_url($logo[0]) . '" alt="' . esc_attr(get_bloginfo('name')) . '" class="logo-img">';
                    }
                } else {
                    // SVG fallback com classe
                    echo '<img src="' . get_stylesheet_directory_uri() . '/assets/images/logo.svg" alt="Camisa 10" class="logo-img">';
                }
                ?>
            </a>
        </div>
        
        <!-- NAVEGAÇÃO: Mudado .main-nav → .header-nav -->
        <nav class="header-nav">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_class'     => 'nav-menu',
                'container'      => false,
                'fallback_cb'    => false,
                'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                'link_before'    => '',
                'link_after'     => '',
            ));
            ?>
        </nav>
        
        <!-- AÇÕES: Mudado .header-cta → .btn-cta -->
        <div class="header-actions">
            <a href="<?php echo esc_url(home_url('/cursos')); ?>" class="btn-cta">
                <?php esc_html_e('Ver Cursos', 'camisa10'); ?>
            </a>
            
            <button class="mobile-menu-toggle" aria-label="<?php esc_attr_e('Menu', 'camisa10'); ?>">
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
            </button>
        </div>
        
    </div>
</header>

<!-- MENU MOBILE -->
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
