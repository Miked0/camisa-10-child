<?php
/**
 * Header Template
 * Versão: 2.0 (corrigida)
 * 
 * @package Camisa10
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    
    <!-- Skip to Content (Acessibilidade) -->
    <a class="skip-link screen-reader-text" href="#primary">
        Pular para o conteúdo
    </a>

    <!-- Header -->
    <header id="masthead" class="site-header" role="banner">
        <div class="site-header-container">
            
            <!-- Logo/Branding -->
            <div class="site-branding">
                <?php
                if (has_custom_logo()) {
                    the_custom_logo();
                } else {
                    ?>
                    <h1 class="site-title">
                        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                            <?php bloginfo('name'); ?>
                        </a>
                    </h1>
                    <?php
                    $description = get_bloginfo('description', 'display');
                    if ($description || is_customize_preview()) :
                        ?>
                        <p class="site-description"><?php echo $description; ?></p>
                        <?php
                    endif;
                }
                ?>
            </div>

            <!-- Navegação Desktop -->
            <nav id="site-navigation" class="main-navigation" role="navigation" aria-label="Menu principal">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_id' => 'primary-menu',
                    'menu_class' => 'menu',
                    'container' => false,
                    'fallback_cb' => false,
                ));
                ?>
            </nav>

            <!-- Header Actions -->
            <div class="header-actions">
                
                <!-- Search Toggle -->
                <button class="search-toggle" aria-label="Abrir busca" aria-expanded="false">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        ircle cx="8" cy="8" r="6" stroke="currentColor" stroke-width="2"/>
                        <path d="M13 13L17 17" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </button>

                <!-- Search Form -->
                <div class="search-form" role="search" aria-hidden="true">
                    <?php get_search_form(); ?>
                </div>

                <!-- CTA Button (opcional - via ACF) -->
                <?php 
                $header_cta_texto = camisa10_sanitize_text('header_cta_texto', 'option');
                $header_cta_url = camisa10_sanitize_url('header_cta_url', 'option');
                
                if (!empty($header_cta_texto) && !empty($header_cta_url)) :
                ?>
                <div class="header-cta">
                    <a href="<?php echo esc_url($header_cta_url); ?>" class="btn btn--primary">
                        <?php echo esc_html($header_cta_texto); ?>
                    </a>
                </div>
                <?php endif; ?>

                <!-- Menu Toggle (Mobile) -->
                <button class="menu-toggle" aria-label="Menu" aria-expanded="false" aria-controls="mobile-menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>

            </div>

        </div>

        <!-- Mobile Menu -->
        <nav id="mobile-menu" class="mobile-menu" role="navigation" aria-label="Menu mobile" aria-hidden="true">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_id' => 'mobile-primary-menu',
                'menu_class' => 'menu',
                'container' => false,
                'fallback_cb' => false,
            ));
            ?>
        </nav>

        <!-- Menu Overlay -->
        <div class="menu-overlay"></div>

    </header>
