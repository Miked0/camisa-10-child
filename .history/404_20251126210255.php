<?php
/**
 * Template for displaying 404 pages (Not Found)
 * Versão: 2.0 (corrigida)
 * 
 * @package Camisa10
 */

get_header();
?>

<main id="primary" class="site-main">

    <section class="error-404 not-found">
        <div class="container">
            
            <div class="error-404-content">
                
                <!-- Número 404 -->
                <div class="error-404-number">
                    <h1>404</h1>
                </div>

                <!-- Mensagem -->
                <div class="error-404-message">
                    <h2>Página não encontrada</h2>
                    <p>Desculpe, a página que você está procurando não existe ou foi movida.</p>
                </div>

                <!-- Search Form -->
                <div class="error-404-search">
                    <p>Tente buscar o que você procura:</p>
                    <?php get_search_form(); ?>
                </div>

                <!-- Links úteis -->
                <div class="error-404-links">
                    <h3>Links úteis:</h3>
                    <ul>
                        <li>
                            <a href="<?php echo esc_url(home_url('/')); ?>">
                                Voltar para Home
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url(get_post_type_archive_link('curso')); ?>">
                                Ver Cursos
                            </a>
                        </li>
                        <?php if (has_nav_menu('primary')) : 
                            $menu_items = wp_get_nav_menu_items('primary');
                            if ($menu_items) :
                                foreach (array_slice($menu_items, 0, 3) as $item) :
                        ?>
                        <li>
                            <a href="<?php echo esc_url($item->url); ?>">
                                <?php echo esc_html($item->title); ?>
                            </a>
                        </li>
                        <?php 
                                endforeach;
                            endif;
                        endif; 
                        ?>
                    </ul>
                </div>

            </div>

        </div>
    </section>

</main>

<style>
.error-404 {
    padding: var(--space-4xl) 0;
    text-align: center;
    min-height: 60vh;
    display: flex;
    align-items: center;
}

.error-404-number h1 {
    font-family: var(--font-primary);
    font-size: clamp(4rem, 15vw, 10rem);
    font-weight: var(--font-weight-black);
    color: var(--color-amarelo);
    line-height: 1;
    margin-bottom: var(--space-lg);
}

.error-404-message h2 {
    font-family: var(--font-primary);
    font-size: var(--font-size-3xl);
    color: var(--color-azul);
    margin-bottom: var(--space-md);
}

.error-404-message p {
    font-size: var(--font-size-lg);
    color: var(--color-preto);
    opacity: 0.8;
    margin-bottom: var(--space-2xl);
}

.error-404-search {
    max-width: 500px;
    margin: 0 auto var(--space-3xl);
}

.error-404-search p {
    margin-bottom: var(--space-md);
    font-weight: var(--font-weight-medium);
}

.error-404-links {
    margin-top: var(--space-3xl);
}

.error-404-links h3 {
    font-size: var(--font-size-xl);
    margin-bottom: var(--space-lg);
}

.error-404-links ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: var(--space-md);
    align-items: center;
}

.error-404-links a {
    font-size: var(--font-size-lg);
    font-weight: var(--font-weight-medium);
    color: var(--color-azul);
    text-decoration: none;
    transition: color var(--transition-fast);
}

.error-404-links a:hover {
    color: var(--color-verde);
}
</style>

<?php
get_footer();
