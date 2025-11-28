<?php
/**
 * Template Name: Home Page
 * Versão: 3.0 - Baseado em OneKorse
 * 
 * @package Camisa10
 */

get_header();
?>

<main id="primary" class="site-main">

    <?php
    /**
     * SEÇÃO 1: HERO BANNER (FULLSCREEN SLIDER)
     * Similar ao OneKorse - slider automático com sobreposição
     */
    get_template_part('template-parts/hero-banner');
    ?>

    <?php
    /**
     * SEÇÃO 2: SOBRE / QUEM SOMOS
     * Grid 2 colunas: texto + imagem
     */
    $sobre_titulo = get_field('home_sobre_titulo');
    $sobre_texto = get_field('home_sobre_texto');
    $sobre_cta_texto = get_field('home_sobre_cta_texto');
    $sobre_cta_url = get_field('home_sobre_cta_url');
    $sobre_imagem = get_field('home_sobre_imagem');

    if ($sobre_titulo || $sobre_texto) :
    ?>
    <section class="sobre-section">
        <div class="container">
            <div class="sobre-grid">
                
                <div class="sobre-content" data-aos="fade-right">
                    <?php if ($sobre_titulo) : ?>
                    <h2 class="section-title"><?php echo esc_html($sobre_titulo); ?></h2>
                    <?php endif; ?>

                    <?php if ($sobre_texto) : ?>
                    <div class="sobre-texto">
                        <?php echo wp_kses_post($sobre_texto); ?>
                    </div>
                    <?php endif; ?>

                    <?php if ($sobre_cta_texto && $sobre_cta_url) : ?>
                    <a href="<?php echo esc_url($sobre_cta_url); ?>" class="btn btn--primary">
                        <?php echo esc_html($sobre_cta_texto); ?>
                        <svg class="btn-icon" width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M5 10H15M15 10L11 6M15 10L11 14" stroke="currentColor" stroke-width="2"/>
                        </svg>
                    </a>
                    <?php endif; ?>
                </div>

                <?php if ($sobre_imagem) : ?>
                <div class="sobre-image" data-aos="fade-left">
                    <img 
                        src="<?php echo esc_url($sobre_imagem['url']); ?>" 
                        alt="<?php echo esc_attr($sobre_imagem['alt'] ?: 'Camisa 10'); ?>"
                        loading="lazy"
                    >
                </div>
                <?php endif; ?>

            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php
    /**
     * SEÇÃO 3: CURSOS EM DESTAQUE
     * Grid de cards com filtros (similar ao OneKorse)
     */
    $cursos_titulo = get_field('home_cursos_titulo') ?: 'Nossos Cursos';
    $cursos_subtitulo = get_field('home_cursos_subtitulo');
    $cursos_quantidade = get_field('home_cursos_quantidade') ?: 6;

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
            
            <header class="section-header" data-aos="fade-up">
                <h2 class="section-title"><?php echo esc_html($cursos_titulo); ?></h2>
                <?php if ($cursos_subtitulo) : ?>
                <p class="section-subtitle"><?php echo esc_html($cursos_subtitulo); ?></p>
                <?php endif; ?>
            </header>

            <div class="cursos-grid">
                
                <?php 
                $delay = 0;
                while ($cursos_query->have_posts()) : $cursos_query->the_post();
                    $curso_id = get_the_ID();
                    $categoria = get_field('curso_categoria', $curso_id);
                    $duracao = get_field('curso_duracao', $curso_id);
                    $nivel = get_field('curso_nivel', $curso_id);
                    $badge = get_field('curso_badge', $curso_id);
                    
                    $thumbnail_url = get_the_post_thumbnail_url($curso_id, 'curso-card');
                    if (!$thumbnail_url) {
                        $thumbnail_url = get_stylesheet_directory_uri() . '/assets/images/default-curso.jpg';
                    }
                    
                    $delay += 100;
                ?>

                <article class="curso-card" data-aos="fade-up" data-aos-delay="<?php echo esc_attr($delay); ?>">
                    
                    <div class="curso-card__image">
                        <a href="<?php the_permalink(); ?>">
                            <img 
                                src="<?php echo esc_url($thumbnail_url); ?>" 
                                alt="<?php echo esc_attr(get_the_title()); ?>"
                                loading="lazy"
                            >
                        </a>
                        
                        <?php if ($badge) : ?>
                        <span class="curso-card__badge"><?php echo esc_html($badge); ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="curso-card__content">
                        
                        <?php if ($categoria) : ?>
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
                            <?php if ($duracao) : ?>
                            <div class="curso-card__meta-item">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    ircle cx="8" cy="8" r="6" stroke="currentColor" stroke-width="1.5"/>
                                    <path d="M8 5V8L10 10" stroke="currentColor" stroke-width="1.5"/>
                                </svg>
                                <span><?php echo esc_html($duracao); ?></span>
                            </div>
                            <?php endif; ?>

                            <?php if ($nivel) : ?>
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
            <div class="cursos-cta" data-aos="fade-up">
                <a href="<?php echo esc_url(get_post_type_archive_link('curso')); ?>" class="btn btn--outline btn--lg">
                    Ver Todos os Cursos
                    <svg class="btn-icon" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M5 10H15M15 10L11 6M15 10L11 14" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </a>
            </div>

        </div>
    </section>
    <?php endif; ?>

    <?php
    /**
     * SEÇÃO 4: NÚMEROS/ESTATÍSTICAS
     * Faixa colorida com contadores animados
     */
    $stats = get_field('home_stats');
    
    if ($stats && is_array($stats)) :
    ?>
    <section class="stats-section">
        <div class="container">
            <div class="stats-grid">
                
                <?php 
                $delay = 0;
                foreach ($stats as $stat) : 
                    $numero = isset($stat['numero']) ? intval($stat['numero']) : 0;
                    $sufixo = isset($stat['sufixo']) ? esc_html($stat['sufixo']) : '';
                    $label = isset($stat['label']) ? esc_html($stat['label']) : '';
                    $delay += 100;
                ?>

                <div class="stat-item" data-aos="fade-up" data-aos-delay="<?php echo esc_attr($delay); ?>">
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
    /**
     * SEÇÃO 5: DEPOIMENTOS (OPCIONAL)
     * Slider de testimonials
     */
    $depoimentos = get_field('home_depoimentos');
    
    if ($depoimentos && is_array($depoimentos) && count($depoimentos) > 0) :
    ?>
    <section class="depoimentos-section">
        <div class="container">
            
            <header class="section-header" data-aos="fade-up">
                <h2 class="section-title">O Que Dizem Nossos Alunos</h2>
            </header>

            <div class="depoimentos-slider swiper" data-aos="fade-up">
                <div class="swiper-wrapper">
                    
                    <?php foreach ($depoimentos as $depoimento) : 
                        $texto = isset($depoimento['texto']) ? esc_html($depoimento['texto']) : '';
                        $nome = isset($depoimento['nome']) ? esc_html($depoimento['nome']) : '';
                        $cargo = isset($depoimento['cargo']) ? esc_html($depoimento['cargo']) : '';
                        $foto = isset($depoimento['foto']) ? $depoimento['foto'] : null;
                    ?>

                    <div class="swiper-slide">
                        <div class="depoimento-card">
                            
                            <?php if ($foto) : ?>
                            <img 
                                src="<?php echo esc_url($foto['url']); ?>" 
                                alt="<?php echo esc_attr($nome); ?>"
                                class="depoimento-foto"
                            >
                            <?php endif; ?>

                            <p class="depoimento-texto">"<?php echo $texto; ?>"</p>
                            
                            <div class="depoimento-autor">
                                <strong><?php echo $nome; ?></strong>
                                <?php if ($cargo) : ?>
                                <span><?php echo $cargo; ?></span>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>

                    <?php endforeach; ?>

                </div>
                
                <div class="swiper-pagination"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>

        </div>
    </section>
    <?php endif; ?>

    <?php
    /**
     * SEÇÃO 6: CTA FINAL
     * Banner com chamada para ação
     */
    $cta_titulo = get_field('home_cta_titulo');
    $cta_texto = get_field('home_cta_texto');
    $cta_botao_texto = get_field('home_cta_botao_texto');
    $cta_botao_url = get_field('home_cta_botao_url');

    if ($cta_titulo || $cta_botao_texto) :
    ?>
    <section class="cta-section">
        <div class="container">
            
            <div class="cta-content" data-aos="fade-up">
                <?php if ($cta
