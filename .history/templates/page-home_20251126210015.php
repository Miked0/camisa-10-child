<?php
/**
 * Template Name: Home Page
 * Versão: 2.0 (corrigida)
 * 
 * @package Camisa10
 */

get_header();
?>

<main id="primary" class="site-main">

    <?php
    // Hero Banner Section
    get_template_part('template-parts/hero-banner');
    ?>

    <?php
    // Sobre Section
    $sobre_titulo = camisa10_sanitize_text('home_sobre_titulo');
    $sobre_texto = camisa10_get_field('home_sobre_texto');
    $sobre_cta_texto = camisa10_sanitize_text('home_sobre_cta_texto');
    $sobre_cta_url = camisa10_sanitize_url('home_sobre_cta_url');
    $sobre_imagem = camisa10_get_image('home_sobre_imagem', false, 'large');

    if (!empty($sobre_titulo) || !empty($sobre_texto)) :
    ?>
    <section class="sobre-section">
        <div class="container">
            <div class="sobre-grid">
                
                <div class="sobre-content">
                    <?php if (!empty($sobre_titulo)) : ?>
                    <h2><?php echo esc_html($sobre_titulo); ?></h2>
                    <?php endif; ?>

                    <?php if (!empty($sobre_texto)) : ?>
                    <div class="sobre-texto">
                        <?php echo wp_kses_post($sobre_texto); ?>
                    </div>
                    <?php endif; ?>

                    <?php if (!empty($sobre_cta_texto) && !empty($sobre_cta_url)) : ?>
                    <a href="<?php echo esc_url($sobre_cta_url); ?>" class="btn btn--primary">
                        <?php echo esc_html($sobre_cta_texto); ?>
                    </a>
                    <?php endif; ?>
                </div>

                <?php if ($sobre_imagem) : ?>
                <div class="sobre-image">
                    <img 
                        src="<?php echo esc_url($sobre_imagem['url']); ?>" 
                        alt="<?php echo esc_attr($sobre_imagem['alt']); ?>"
                        width="<?php echo esc_attr($sobre_imagem['width']); ?>"
                        height="<?php echo esc_attr($sobre_imagem['height']); ?>"
                        loading="lazy"
                    >
                </div>
                <?php endif; ?>

            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php
    // Cursos em Destaque Section
    $cursos_titulo = camisa10_sanitize_text('home_cursos_titulo');
    $cursos_subtitulo = camisa10_sanitize_text('home_cursos_subtitulo');
    $cursos_quantidade = camisa10_get_field('home_cursos_quantidade', false, 6);

    $cursos_args = array(
        'post_type' => 'curso',
        'posts_per_page' => intval($cursos_quantidade),
        'orderby' => 'date',
        'order' => 'DESC',
    );

    $cursos_query = new WP_Query($cursos_args);

    if ($cursos_query->have_posts()) :
    ?>
    <section class="cursos-section">
        <div class="container">
            
            <header class="section-header">
                <h2 class="section-title">
                    <?php echo !empty($cursos_titulo) ? esc_html($cursos_titulo) : 'Nossos Cursos'; ?>
                </h2>
                <?php if (!empty($cursos_subtitulo)) : ?>
                <p class="section-subtitle"><?php echo esc_html($cursos_subtitulo); ?></p>
                <?php endif; ?>
            </header>

            <div class="cursos-grid">
                
                <?php 
                while ($cursos_query->have_posts()) : $cursos_query->the_post();
                    $curso_id = get_the_ID();
                    $categoria = camisa10_sanitize_text('curso_categoria', $curso_id);
                    $duracao = camisa10_sanitize_text('curso_duracao', $curso_id);
                    $nivel = camisa10_sanitize_text('curso_nivel', $curso_id);
                    $badge = camisa10_sanitize_text('curso_badge', $curso_id);
                    
                    $thumbnail_url = get_the_post_thumbnail_url($curso_id, 'curso-card');
                    if (empty($thumbnail_url)) {
                        $thumbnail_url = get_stylesheet_directory_uri() . '/assets/images/default-curso.jpg';
                    }
                ?>

                <article class="curso-card animate-on-scroll">
                    
                    <div class="curso-card__image">
                        <a href="<?php the_permalink(); ?>">
                            <img 
                                src="<?php echo esc_url($thumbnail_url); ?>" 
                                alt="<?php echo esc_attr(get_the_title()); ?>"
                                loading="lazy"
                            >
                        </a>
                        
                        <?php if (!empty($badge)) : ?>
                        <span class="curso-card__badge"><?php echo esc_html($badge); ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="curso-card__content">
                        
                        <?php if (!empty($categoria)) : ?>
                        <div class="curso-card__categoria">
                            <?php echo esc_html($categoria); ?>
                        </div>
                        <?php endif; ?>

                        <h3 class="curso-card__title">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h3>

                        <?php if (has_excerpt()) : ?>
                        <div class="curso-card__excerpt">
                            <?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?>
                        </div>
                        <?php endif; ?>

                        <div class="curso-card__meta">
                            <?php if (!empty($duracao)) : ?>
                            <div class="curso-card__meta-item">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    ircle cx="8" cy="8" r="6" stroke="currentColor" stroke-width="1.5"/>
                                    <path d="M8 5V8L10 10" stroke="currentColor" stroke-width="1.5"/>
                                </svg>
                                <span><?php echo esc_html($duracao); ?></span>
                            </div>
                            <?php endif; ?>

                            <?php if (!empty($nivel)) : ?>
                            <div class="curso-card__meta-item">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <path d="M2 14L8 2L14 14H2Z" stroke="currentColor" stroke-width="1.5"/>
                                </svg>
                                <span><?php echo esc_html($nivel); ?></span>
                            </div>
                            <?php endif; ?>
                        </div>

                    </div>

                </article>

                <?php endwhile; wp_reset_postdata(); ?>

            </div>

            <!-- Ver todos os cursos -->
            <div class="cursos-load-more">
                <a href="<?php echo esc_url(get_post_type_archive_link('curso')); ?>" class="btn btn--primary btn--lg">
                    Ver Todos os Cursos
                </a>
            </div>

        </div>
    </section>
    <?php endif; ?>

    <?php
    // Stats Section (Números)
    $stats = camisa10_get_field('home_stats');
    
    if (!empty($stats) && is_array($stats)) :
    ?>
    <section class="stats-section">
        <div class="container">
            <div class="stats-grid">
                
                <?php foreach ($stats as $stat) : 
                    $numero = isset($stat['numero']) ? intval($stat['numero']) : 0;
                    $sufixo = isset($stat['sufixo']) ? esc_html($stat['sufixo']) : '';
                    $label = isset($stat['label']) ? esc_html($stat['label']) : '';
                ?>

                <div class="stat-item animate-on-scroll">
                    <span 
                        class="stat-number" 
                        data-value="<?php echo esc_attr($numero); ?>"
                        data-suffix="<?php echo esc_attr($sufixo); ?>"
                    >
                        0
                    </span>
                    <span class="stat-label"><?php echo $label; ?></span>
                </div>

                <?php endforeach; ?>

            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php
    // CTA Section
    $cta_titulo = camisa10_sanitize_text('home_cta_titulo');
    $cta_texto = camisa10_sanitize_text('home_cta_texto');
    $cta_botao_texto = camisa10_sanitize_text('home_cta_botao_texto');
    $cta_botao_url = camisa10_sanitize_url('home_cta_botao_url');

    if (!empty($cta_titulo)) :
    ?>
    <section class="cta-section">
        <div class="container">
            
            <?php if (!empty($cta_titulo)) : ?>
            <h2><?php echo esc_html($cta_titulo); ?></h2>
            <?php endif; ?>

            <?php if (!empty($cta_texto)) : ?>
            <p><?php echo esc_html($cta_texto); ?></p>
            <?php endif; ?>

            <?php if (!empty($cta_botao_texto) && !empty($cta_botao_url)) : ?>
            <a href="<?php echo esc_url($cta_botao_url); ?>" class="btn btn--primary btn--lg cta-button">
                <?php echo esc_html($cta_botao_texto); ?>
            </a>
            <?php endif; ?>

        </div>
    </section>
    <?php endif; ?>

</main>

<!-- Scroll to Top Button -->
<button class="scroll-to-top" aria-label="Voltar ao topo">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M12 19V5M12 5L6 11M12 5L18 11" stroke="currentColor" stroke-width="2"/>
    </svg>
</button>

<?php
get_footer();
