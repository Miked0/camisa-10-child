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
