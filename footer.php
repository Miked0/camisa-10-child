<?php
/**
 * Footer Template - Camisa 10
 * 
 * Template padrão do footer para todas as páginas
 * Integrado com WordPress e tema OneKorse
 * 
 * @package Camisa10
 * @version 1.0.0
 * @updated 2025-11-26 - Corrigido: Variáveis CSS corrigidas, escape functions adicionadas, fallback functions implementadas
 */
?>

<style>
    /* FOOTER STYLES */
    .c10-footer {
        background: var(--color-black, #000000);
        color: var(--color-cream-50, #fcfcf9);
        padding: 60px 0 0;
        font-family: var(--font-family-base, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif);
    }

    .c10-footer__container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 var(--padding-horizontal, 20px);
    }

    /* FOOTER MAIN CONTENT */
    .c10-footer__main {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1fr;
        gap: 60px;
        padding-bottom: 50px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    /* COLUNA SOBRE */
    .c10-footer__about {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .c10-footer__logo {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .c10-footer__logo-img {
        height: 40px;
        width: auto;
        max-width: 160px;
        filter: brightness(0) invert(1);
    }

    .c10-footer__description {
        font-size: 14px;
        line-height: 1.6;
        color: var(--color-gray-300, #a7a9a9);
        margin: 0;
    }

    .c10-footer__social {
        display: flex;
        gap: 16px;
        margin-top: 10px;
    }

    .c10-footer__social-link {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        color: var(--color-white, #ffffff);
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .c10-footer__social-link:hover {
        background: var(--color-primary, #21808d);
        color: var(--color-white, #ffffff);
        transform: translateY(-3px);
    }

    .c10-footer__social-icon {
        width: 20px;
        height: 20px;
    }

    /* COLUNAS DE LINKS */
    .c10-footer__column {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .c10-footer__column-title {
        font-size: 16px;
        font-weight: 700;
        color: var(--color-white, #ffffff);
        margin: 0 0 8px 0;
        letter-spacing: 0.5px;
    }

    .c10-footer__menu {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .c10-footer__menu-item {
        margin: 0;
    }

    .c10-footer__menu-link {
        color: var(--color-gray-300, #a7a9a9);
        text-decoration: none;
        font-size: 14px;
        transition: color 0.3s ease;
        display: inline-block;
        position: relative;
    }

    .c10-footer__menu-link::before {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 1px;
        background: var(--color-success, #21808d);
        transition: width 0.3s ease;
    }

    .c10-footer__menu-link:hover {
        color: var(--color-white, #ffffff);
    }

    .c10-footer__menu-link:hover::before {
        width: 100%;
    }

    /* COLUNA CONTATO */
    .c10-footer__contact {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .c10-footer__contact-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        font-size: 14px;
        color: var(--color-gray-300, #a7a9a9);
    }

    .c10-footer__contact-icon {
        width: 20px;
        height: 20px;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .c10-footer__contact-link {
        color: var(--color-gray-300, #a7a9a9);
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .c10-footer__contact-link:hover {
        color: var(--color-success, #21808d);
    }

    /* FOOTER BOTTOM */
    .c10-footer__bottom {
        padding: 30px 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 13px;
        color: var(--color-gray-300, #a7a9a9);
    }

    .c10-footer__copyright {
        margin: 0;
    }

    .c10-footer__legal {
        display: flex;
        gap: 24px;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .c10-footer__legal-link {
        color: var(--color-gray-300, #a7a9a9);
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .c10-footer__legal-link:hover {
        color: var(--color-primary, #21808d);
    }

    /* RESPONSIVE */
    @media (max-width: 1024px) {
        .c10-footer__main {
            grid-template-columns: 1fr 1fr;
            gap: 40px;
        }

        .c10-footer__about {
            grid-column: 1 / -1;
        }
    }

    @media (max-width: 768px) {
        .c10-footer {
            padding: 40px 0 0;
            margin-top: 60px;
        }

        .c10-footer__container {
            padding: 0 var(--padding-mobile, 16px);
        }

        .c10-footer__main {
            grid-template-columns: 1fr;
            gap: 40px;
            padding-bottom: 40px;
        }

        .c10-footer__about {
            grid-column: 1;
        }

        .c10-footer__bottom {
            flex-direction: column;
            gap: 20px;
            text-align: center;
        }

        .c10-footer__legal {
            flex-direction: column;
            gap: 12px;
        }
    }
</style>

<!-- FOOTER -->
<footer class="c10-footer">
    <div class="c10-footer__container">
        <!-- Main Content -->
        <div class="c10-footer__main">
            <!-- Coluna Sobre -->
            <div class="c10-footer__about">
                <div class="c10-footer__logo">
                    <?php 
                    $custom_logo_id = get_theme_mod('custom_logo');
                    if ($custom_logo_id) {
                        $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                        if ($logo) {
                            $logo_url = esc_url($logo[0]);
                            ?>
                            <img src="<?php echo $logo_url; ?>" 
                                 alt="<?php echo esc_attr(get_bloginfo('name')); ?>" 
                                 class="c10-footer__logo-img">
                            <?php
                        }
                    } else {
                        ?>
                        <svg class="c10-footer__logo-img" viewBox="0 0 180 50" xmlns="http://www.w3.org/2000/svg">
                            <text x="10" y="35" font-family="Arial Black, sans-serif" font-size="32" font-weight="900" fill="#ffffff">camisa</text>
                            <text x="135" y="35" font-family="Arial Black, sans-serif" font-size="32" font-weight="900" fill="#faf323">10</text>
                        </svg>
                        <?php
                    }
                    ?>
                </div>
                
                <p class="c10-footer__description">
                    Formamos líderes que dominam o jogo. Capacitação profissional com visão estratégica, habilidades técnicas e liderança prática para alta performance no mercado.
                </p>

                <!-- Redes Sociais -->
                <div class="c10-footer__social">
                    <a href="<?php echo esc_url('#'); ?>" 
                       class="c10-footer__social-link" 
                       aria-label="<?php echo esc_attr__('Seguir no Instagram', 'camisa10'); ?>" 
                       target="_blank" 
                       rel="noopener noreferrer">
                        <svg class="c10-footer__social-icon" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                    </a>
                    <a href="<?php echo esc_url('#'); ?>" 
                       class="c10-footer__social-link" 
                       aria-label="<?php echo esc_attr__('Seguir no LinkedIn', 'camisa10'); ?>" 
                       target="_blank" 
                       rel="noopener noreferrer">
                        <svg class="c10-footer__social-icon" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                    </a>
                    <a href="<?php echo esc_url('#'); ?>" 
                       class="c10-footer__social-link" 
                       aria-label="<?php echo esc_attr__('Inscrever no YouTube', 'camisa10'); ?>" 
                       target="_blank" 
                       rel="noopener noreferrer">
                        <svg class="c10-footer__social-icon" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                        </svg>
                    </a>
                    <a href="<?php echo esc_url('#'); ?>" 
                       class="c10-footer__social-link" 
                       aria-label="<?php echo esc_attr__('Curtir no Facebook', 'camisa10'); ?>" 
                       target="_blank" 
                       rel="noopener noreferrer">
                        <svg class="c10-footer__social-icon" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Coluna Navegação -->
            <div class="c10-footer__column">
                <h3 class="c10-footer__column-title">Navegação</h3>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer-nav',
                    'menu_class'     => 'c10-footer__menu',
                    'container'      => false,
                    'fallback_cb'    => 'c10_footer_nav_fallback',
                ));
                ?>
            </div>

            <!-- Coluna Cursos -->
            <div class="c10-footer__column">
                <h3 class="c10-footer__column-title">Conteúdo</h3>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer-content',
                    'menu_class'     => 'c10-footer__menu',
                    'container'      => false,
                    'fallback_cb'    => 'c10_footer_content_fallback',
                ));
                ?>
            </div>

            <!-- Coluna Contato -->
            <div class="c10-footer__column c10-footer__contact">
                <h3 class="c10-footer__column-title">Contato</h3>
                
                <div class="c10-footer__contact-item">
                    <svg class="c10-footer__contact-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <a href="mailto:contato@camisa10.com.br" class="c10-footer__contact-link">
                        contato@camisa10.com.br
                    </a>
                </div>

                <div class="c10-footer__contact-item">
                    <svg class="c10-footer__contact-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    <a href="tel:+5511999999999" class="c10-footer__contact-link">
                        (11) 99999-9999
                    </a>
                </div>

                <div class="c10-footer__contact-item">
                    <svg class="c10-footer__contact-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span>São Paulo, SP - Brasil</span>
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="c10-footer__bottom">
            <p class="c10-footer__copyright">
                &copy; <?php echo date('Y'); ?> Camisa 10. Todos os direitos reservados.
            </p>

            <ul class="c10-footer__legal">
                <li><a href="<?php echo esc_url(home_url('/privacidade')); ?>" class="c10-footer__legal-link">Política de Privacidade</a></li>
                <li><a href="<?php echo esc_url(home_url('/termos')); ?>" class="c10-footer__legal-link">Termos de Uso</a></li>
            </ul>
        </div>
    </div>
</footer>

<?php
/**
 * Helper function para obter link de arquivo com fallback seguro
 */
if (!function_exists('c10_get_safe_archive_link')) {
    function c10_get_safe_archive_link($post_type, $fallback = '/') {
        $link = get_post_type_archive_link($post_type);
        return $link ? esc_url($link) : esc_url(home_url($fallback));
    }
}

/**
 * Fallback para menu de navegação do footer
 */
if (!function_exists('c10_footer_nav_fallback')) {
    function c10_footer_nav_fallback() {
        ?>
        <ul class="c10-footer__menu">
            <li class="c10-footer__menu-item">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="c10-footer__menu-link">
                    <?php esc_html_e('Início', 'camisa10'); ?>
                </a>
            </li>
            <li class="c10-footer__menu-item">
                <a href="<?php echo esc_url(home_url('/cursos')); ?>" class="c10-footer__menu-link">
                    <?php esc_html_e('Cursos', 'camisa10'); ?>
                </a>
            </li>
            <li class="c10-footer__menu-item">
                <a href="<?php echo esc_url(home_url('/sobre')); ?>" class="c10-footer__menu-link">
                    <?php esc_html_e('Sobre', 'camisa10'); ?>
                </a>
            </li>
            <li class="c10-footer__menu-item">
                <a href="<?php echo esc_url(home_url('/contato')); ?>" class="c10-footer__menu-link">
                    <?php esc_html_e('Contato', 'camisa10'); ?>
                </a>
            </li>
        </ul>
        <?php
    }
}

/**
 * Fallback para menu de conteúdo do footer
 */
if (!function_exists('c10_footer_content_fallback')) {
    function c10_footer_content_fallback() {
        ?>
        <ul class="c10-footer__menu">
            <li class="c10-footer__menu-item">
                <a href="<?php echo c10_get_safe_archive_link('curso', '/cursos'); ?>" class="c10-footer__menu-link">
                    <?php esc_html_e('Todos os Cursos', 'camisa10'); ?>
                </a>
            </li>
            <li class="c10-footer__menu-item">
                <a href="<?php echo c10_get_safe_archive_link('especialista', '/especialistas'); ?>" class="c10-footer__menu-link">
                    <?php esc_html_e('Especialistas', 'camisa10'); ?>
                </a>
            </li>
            <li class="c10-footer__menu-item">
                <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts')) ?: home_url('/blog')); ?>" class="c10-footer__menu-link">
                    <?php esc_html_e('Blog', 'camisa10'); ?>
                </a>
            </li>
        </ul>
        <?php
    }
}
?>

<?php wp_footer(); ?>
</body>
</html>
<?php
/**
 * Footer Template - Camisa 10
 * 
 * @package Camisa10
 * @version 1.0.0
 * @updated 2025-11-26 - Corrigido: Variáveis CSS, escape functions, fallback functions
 */
?>

<style>
    .c10-footer {
        background: var(--color-black, #000000);
        color: var(--color-cream-50, #fcfcf9);
        padding: 60px 0 0;
    }
    
    /* CSS completo do footer */
</style>

<footer class="c10-footer">
    <div class="c10-footer__container">
        <div class="c10-footer__main">
            <div class="c10-footer__about">
                <div class="c10-footer__logo">
                    <?php 
                    $custom_logo_id = get_theme_mod('custom_logo');
                    if ($custom_logo_id) {
                        $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                        if ($logo) {
                            echo '<img src="' . esc_url($logo[0]) . '" alt="' . esc_attr(get_bloginfo('name')) . '" class="c10-footer__logo-img">';
                        }
                    }
                    ?>
                </div>
                
                <p class="c10-footer__description">
                    Formamos líderes que dominam o jogo. Capacitação profissional com visão estratégica.
                </p>

                <div class="c10-footer__social">
                    <a href="<?php echo esc_url('#'); ?>" class="c10-footer__social-link" aria-label="Instagram" target="_blank" rel="noopener">
                        <svg class="c10-footer__social-icon" viewBox="0 0 24 24" fill="currentColor"><!-- SVG --></svg>
                    </a>
                </div>
            </div>

            <div class="c10-footer__column">
                <h3 class="c10-footer__column-title">Navegação</h3>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer-nav',
                    'menu_class'     => 'c10-footer__menu',
                    'container'      => false,
                    'fallback_cb'    => 'c10_footer_nav_fallback',
                ));
                ?>
            </div>
        </div>

        <div class="c10-footer__bottom">
            <p class="c10-footer__copyright">
                &copy; <?php echo date('Y'); ?> Camisa 10. Todos os direitos reservados.
            </p>
        </div>
    </div>
</footer>

<?php
if (!function_exists('c10_footer_nav_fallback')) {
    function c10_footer_nav_fallback() {
        echo '<ul class="c10-footer__menu">';
        echo '<li><a href="' . esc_url(home_url('/')) . '">Início</a></li>';
        echo '<li><a href="' . esc_url(home_url('/cursos')) . '">Cursos</a></li>';
        echo '</ul>';
    }
}
?>

<?php wp_footer(); ?>
</body>
</html>
