<?php
/**
 * Template Name: Home Page
 * Versão: 3.1 - COM FALLBACK (funciona sem ACF)
 * 
 * @package Camisa10
 */

get_header();
?>

<main id="primary" class="site-main">

    <?php
    /**
     * SEÇÃO 1: HERO BANNER
     * Tenta pegar do ACF, senão usa fallback
     */
    $hero_slides = function_exists('get_field') ? get_field('hero_banner_slides') : false;
    
    if (!$hero_slides || !is_array($hero_slides)) {
        // FALLBACK: Hero estático se não tiver ACF
        ?>
        <section class="hero-banner-static">
            <div class="hero-slide-static">
                <div class="hero-slide__overlay"></div>
                <div class="container">
                    <div class="hero-slide__content">
                        <div class="hero-slide__badge">
                            <span>Novo</span>
                        </div>
                        <h1 class="hero-slide__title">Transforme Seu Jogo com a Camisa 10</h1>
                        <p class="hero-slide__description">
                            Cursos online de futebol com os melhores profissionais do Brasil
                        </p>
                        <div class="hero-slide__cta">
                            <a href="#cursos" class="btn btn--primary btn--lg">
                                Explorar Cursos
                                <svg class="btn-icon" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M5 10H15M15 10L11 6M15 10L11 14" stroke="currentColor" stroke-width="2"/>
                                </svg>
                            </a>
                            <a href="#sobre" class="btn btn--secondary btn--lg">
                                Saiba Mais
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    } else {
        get_template_part('template-parts/hero-banner');
    }
    ?>

    <?php
    /**
     * SEÇÃO 2: SOBRE
     */
    $sobre_titulo = function_exists('get_field') ? get_field('home_sobre_titulo') : '';
    $sobre_texto = function_exists('get_field') ? get_field('home_sobre_texto') : '';
    
    // FALLBACK
    if (empty($sobre_titulo)) {
        $sobre_titulo = 'Quem Somos';
    }
    if (empty($sobre_texto)) {
        $sobre_texto = '<p>A <strong>Camisa 10</strong> é uma plataforma dedicada ao desenvolvimento de jogadores de futebol através de cursos online de alta qualidade. Nossa missão é democratizar o acesso ao conhecimento técnico e tático do futebol.</p><p>Com instrutores experientes e metodologia comprovada, ajudamos milhares de jogadores a alcançarem seu máximo potencial.</p>';
    }
    ?>
    <section class="sobre-section" id="sobre">
        <div class="container">
            <div class="sobre-grid">
                
                <div class="sobre-content">
                    <h2 class="section-title"><?php echo esc_html($sobre_titulo); ?></h2>
                    <div class="sobre-texto">
                        <?php echo wp_kses_post($sobre_texto); ?>
                    </div>
                    <a href="#cursos" class="btn btn--primary">
                        Ver Nossos Cursos
                        <svg class="btn-icon" width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M5 10H15M15 10L11 6M15 10L11 14" stroke="currentColor" stroke-width="2"/>
                        </svg>
                    </a>
                </div>

                <div class="sobre-image">
                    <img 
                        src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/sobre-placeholder.jpg" 
                        alt="Sobre Camisa 10"
                        loading="lazy"
                        onerror="this.style.display='none'"
                    >
                    <!-- SVG Placeholder se imagem não existir -->
                    <svg viewBox="0 0 600 400" xmlns="http://www.w3.org/2000/svg" style="background: linear-gradient(135deg, #0A3BE8, #02FB9A);">
                        <rect width="600" height="400" fill="url(#grad)"/>
                        <defs>
                            <linearGradient id="grad" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" style="stop-color:#0A3BE8;stop-opacity:1" />
                                <stop offset="100%" style="stop-color:#02FB9A;stop-opacity:1" />
                            </linearGradient>
                        </defs>
                        <text x="50%" y="50%" text-anchor="middle" fill="white" font-size="48" font-weight="bold" dy=".3em">
                            ⚽ CAMISA 10
                        </text>
                    </svg>
                </div>

            </div>
        </div>
    </section>

    <?php
    /**
     * SEÇÃO 3: CURSOS
     */
    $cursos_args = array(
        'post_type' => 'curso',
        'posts_per_page' => 6,
        'orderby' => 'date',
        'order' => 'DESC',
    );

    $cursos_query = new WP_Query($cursos_args);

    if ($cursos_query->have_posts()) :
    ?>
    <section class="cursos-section" id="cursos">
        <div class="container">
            
            <header class="section-header">
                <h2 class="section-title">Nossos Cursos</h2>
                <p class="section-subtitle">Aprenda com os melhores profissionais do futebol</p>
            </header>

            <div class="cursos-grid">
                
                <?php while ($cursos_query->have_posts()) : $cursos_query->the_post(); ?>

                <article class="curso-card">
                    
                    <div class="curso-card__image">
                        <a href="<?php the_permalink(); ?>">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('curso-card'); ?>
                            <?php else : ?>
                                <!-- Placeholder SVG -->
                                <svg viewBox="0 0 400 300" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="400" height="300" fill="#0A3BE8"/>
                                    <text x="50%" y="50%" text-anchor="middle" fill="white" font-size="80" dy=".3em">⚽</text>
                                </svg>
                            <?php endif; ?>
                        </a>
                        <span class="curso-card__badge">Destaque</span>
                    </div>

                    <div class="curso-card__content">
                        
                        <div class="curso-card__categoria">
                            Futebol
                        </div>

                        <h3 class="curso-card__title">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h3>

                        <div class="curso-card__excerpt">
                            <?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?>
                        </div>

                        <div class="curso-card__meta">
                            <div class="curso-card__meta-item">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    ircle cx="8" cy="8" r="6" stroke="currentColor" stroke-width="1.5"/>
                                    <path d="M8 5V8L10 10" stroke="currentColor" stroke-width="1.5"/>
                                </svg>
                                <span>20 horas</span>
                            </div>
                            <div class="curso-card__meta-item">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <path d="M2 14L8 2L14 14H2Z" stroke="currentColor" stroke-width="1.5"/>
                                </svg>
                                <span>Intermediário</span>
                            </div>
                        </div>

                    </div>

                </article>

                <?php endwhile; wp_reset_postdata(); ?>

            </div>

            <div class="cursos-cta">
                <a href="<?php echo esc_url(get_post_type_archive_link('curso')); ?>" class="btn btn--outline btn--lg">
                    Ver Todos os Cursos
                    <svg class="btn-icon" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M5 10H15M15 10L11 6M15 10L11 14" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </a>
            </div>

        </div>
    </section>
    <?php else : ?>
    
    <!-- FALLBACK: Se não tiver cursos cadastrados -->
    <section class="cursos-section" id="cursos">
        <div class="container">
            
            <header class="section-header">
                <h2 class="section-title">Nossos Cursos</h2>
                <p class="section-subtitle">Aprenda com os melhores profissionais do futebol</p>
            </header>

            <div class="cursos-grid">
                
                <!-- Curso Exemplo 1 -->
                <article class="curso-card">
                    <div class="curso-card__image">
                        <svg viewBox="0 0 400 300" xmlns="http://www.w3.org/2000/svg">
                            <rect width="400" height="300" fill="#0A3BE8"/>
                            <text x="50%" y="50%" text-anchor="middle" fill="white" font-size="80" dy=".3em">⚽</text>
                        </svg>
                        <span class="curso-card__badge">Novo</span>
                    </div>
                    <div class="curso-card__content">
                        <div class="curso-card__categoria">Fundamentos</div>
                        <h3 class="curso-card__title">
                            <a href="#">Fundamentos do Futebol Moderno</a>
                        </h3>
                        <div class="curso-card__excerpt">
                            Aprenda as bases essenciais do futebol com técnicas comprovadas e exercícios práticos.
                        </div>
                        <div class="curso-card__meta">
                            <div class="curso-card__meta-item">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    ircle cx="8" cy="8" r="6" stroke="currentColor" stroke-width="1.5"/>
                                    <path d="M8 5V8L10 10" stroke="currentColor" stroke-width="1.5"/>
                                </svg>
                                <span>20 horas</span>
                            </div>
                            <div class="curso-card__meta-item">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <path d="M2 14L8 2L14 14H2Z" stroke="currentColor" stroke-width="1.5"/>
                                </svg>
                                <span>Iniciante</span>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Curso Exemplo 2 -->
                <article class="curso-card">
                    <div class="curso-card__image">
                        <svg viewBox="0 0 400 300" xmlns="http://www.w3.org/2000/svg">
                            <rect width="400" height="300" fill="#02FB9A"/>
                            <text x="50%" y="50%" text-anchor="middle" fill="#000" font-size="80" dy=".3em">🎯</text>
                        </svg>
                        <span class="curso-card__badge">Popular</span>
                    </div>
                    <div class="curso-card__content">
                        <div class="curso-card__categoria">Tática</div>
                        <h3 class="curso-card__title">
                            <a href="#">Tática e Estratégia</a>
                        </h3>
                        <div class="curso-card__excerpt">
                            Domine esquemas táticos e leitura de jogo para se destacar em campo.
                        </div>
                        <div class="curso-card__meta">
                            <div class="curso-card__meta-item">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    ircle cx="8" cy="8" r="6" stroke="currentColor" stroke-width="1.5"/>
                                    <path d="M8 5V8L10 10" stroke="currentColor" stroke-width="1.5"/>
                                </svg>
                                <span>30 horas</span>
                            </div>
                            <div class="curso-card__meta-item">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <path d="M2 14L8 2L14 14H2Z" stroke="currentColor" stroke-width="1.5"/>
                                </svg>
                                <span>Intermediário</span>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Curso Exemplo 3 -->
                <article class="curso-card">
                    <div class="curso-card__image">
                        <svg viewBox="0 0 400 300" xmlns="http://www.w3.org/2000/svg">
                            <rect width="400" height="300" fill="#FAF323"/>
                            <text x="50%" y="50%" text-anchor="middle" fill="#000" font-size="80" dy=".3em">🏆</text>
                        </svg>
                        <span class="curso-card__badge">Destaque</span>
                    </div>
                    <div class="curso-card__content">
                        <div class="curso-card__categoria">Performance</div>
                        <h3 class="curso-card__title">
                            <a href="#">Alta Performance</a>
                        </h3>
                        <div class="curso-card
