<?php
/**
 * Header Template - Camisa 10 (CORRIGIDO)
 * 
 * @package Camisa10
 * @version 8.5.2 - CORRIGIDO
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
        
        <!-- LOGO -->
        <div class="header-logo">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="logo-link">
                <?php 
                $custom_logo_id = get_theme_mod('custom_logo');
                if ($custom_logo_id) {
                    $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                    if ($logo) {
                        echo '<img src="' . esc_url($logo[0]) . '" alt="' . esc_attr(get_bloginfo('name')) . '" class="logo-img">';
                    }
                } else {
                    echo '<span class="logo-img" style="display:inline-block; font-size:24px; font-weight:bold;">camisa<span style="color:#FAF323;">10</span></span>';
                }
                ?>
            </a>
        </div>
        
        <!-- NAVEGAÇÃO: com FALLBACK manual -->
        <nav class="header-nav">
            <ul class="nav-menu">
                <?php
                // PEGA menu do WordPress
                $menu_items = wp_get_nav_menu_items('primary');
                
                if ($menu_items && is_array($menu_items)) {
                    // Menu WordPress existe
                    foreach ($menu_items as $item) {
                        if (!$item->menu_item_parent) {
                            echo '<li class="nav-item"><a href="' . esc_url($item->url) . '" class="nav-link">' . esc_html($item->title) . '</a></li>';
                        }
                    }
                } else {
                    // FALLBACK: Menu padrão se nenhum menu foi criado
                    echo '<li class="nav-item"><a href="' . esc_url(home_url('/cursos')) . '" class="nav-link">Cursos</a></li>';
                    echo '<li class="nav-item"><a href="' . esc_url(home_url('/sobre')) . '" class="nav-link">Sobre</a></li>';
                    echo '<li class="nav-item"><a href="' . esc_url(home_url('/contato')) . '" class="nav-link">Contato</a></li>';
                }
                ?>
            </ul>
        </nav>
        
        <!-- AÇÕES -->
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
    <ul class="mobile-menu">
        <?php
        $menu_items = wp_get_nav_menu_items('primary');
        
        if ($menu_items && is_array($menu_items)) {
            foreach ($menu_items as $item) {
                if (!$item->menu_item_parent) {
                    echo '<li><a href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a></li>';
                }
            }
        } else {
            echo '<li><a href="' . esc_url(home_url('/cursos')) . '">Cursos</a></li>';
            echo '<li><a href="' . esc_url(home_url('/sobre')) . '">Sobre</a></li>';
            echo '<li><a href="' . esc_url(home_url('/contato')) . '">Contato</a></li>';
        }
        ?>
    </ul>
</nav>