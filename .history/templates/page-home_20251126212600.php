<?php
/**
 * Template Name: Home Page
 * Versão: 4.0 - ESTRUTURA ONEKORSE
 * 
 * @package Camisa10
 */

get_header();
?>

<main id="primary" class="site-main">

    <?php
    /**
     * SEÇÃO 1: HERO FULLSCREEN
     * Exatamente como OneKorse - fullscreen com imagem + overlay + texto centralizado
     */
    ?>
    <section class="hero-fullscreen">
        <div class="hero-background">
            <!-- Imagem de fundo (pode ser substituída por ACF depois) -->
            <img 
                src="https://images.unsplash.com/photo-1579952363873-27f3bade9f55?q=80&w=2000" 
                alt="Futebol Camisa 10"
            >
        </div>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <div class="container">
                <h1 class="hero-title" data-aos="fade-up">
                    Transforme Seu Jogo<br>
                    <span class="highlight">com a Camisa 10</span>
                </h1>
                <p class="hero-subtitle" data-aos="fade-up" data-aos-delay="100">
                    Cursos online de futebol com os melhores profissionais do Brasil
                </p>
                <div class="hero-cta" data-aos="fade-up" data-aos-delay="200">
                    <a href="#cursos" class="btn btn--primary btn--xl">
                        Explorar Cursos
                    </a>
                    <a href="#sobre" class="btn btn--outline-white btn--xl">
                        Saiba Mais
                    </a>
                </div>
            </div>
        </div>
        <!-- Scroll indicator -->
        <div class="scroll-indicator">
            <a href="#features">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M12 5V19M12 19L6 13M12 19L18 13" stroke="currentColor" stroke-width="2"/>
                </svg>
            </a>
        </div>
    </section>

    <?php
    /**
     * SEÇÃO 2: FEATURES/SERVIÇOS
     * Grid de 3 colunas com ícones (como OneKorse)
     */
    ?>
    <section class="features-section" id="features">
        <div class="container">
            
            <div class="features-grid">
                
                <div class="feature-card" data-aos="fade-up" data-aos-delay="0">
                    <div class="feature-icon">
                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                            ircle cx="24" cy="24" r="20" stroke="currentColor" stroke-width="2"/>
                            <path d="M24 12L27 21H36L29 27L32 36L24 30L16 36L19 27L12 21H21L24 12Z" fill="currentColor"/>
                        </svg>
                    </div>
                    <h3>Instrutores de Elite</h3>
                    <p>Aprenda com profissionais que atuam nos maiores clubes e seleções do país</p>
                </div>

                <div class="feature-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-icon">
                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                            <rect x="8" y="12" width="32" height="24" rx="2" stroke="currentColor" stroke-width="2"/>
                            <path d="M20 22L28 26L20 30V22Z" fill="currentColor"/>
                        </svg>
                    </div>
                    <h3>Aulas Online</h3>
                    <p>Assista quando e onde quiser, no seu ritmo e com suporte dedicado</p>
                </div>

                <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-icon">
                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                            <path d="M24 8L28 20H40L30 28L34 40L24 32L14 40L18 28L8 20H20L24 8Z" stroke="currentColor" stroke-width="2" fill="none"/>
                        </svg>
                    </div>
                    <h3>Certificado</h3>
                    <p>Receba certificado reconhecido ao concluir cada curso com sucesso</p>
                </div>

            </div>

        </div>
    </section>

    <?php
    /**
     * SEÇÃO 3: SOBRE (Texto + Imagem) - LAYOUT ONEKORSE
     * Grid 50/50 com imagem à direita
     */
    ?>
    <section class="about-section">
        <div class="container">
            <div class="about-grid">
                
                <div class="about-content" data-aos="fade-right">
                    <div class="section-label">Quem Somos</div>
                    <h2 class="section-title-large">
                        A Camisa 10 é Sua<br>
                        Plataforma de <span class="text-gradient">Evolução</span>
                    </h2>
                    <p class="text-large">
                        Somos uma plataforma dedicada ao desenvolvimento de jogadores de futebol através de cursos online de alta qualidade.
                    </p>
                    <p>
                        Nossa missão é democratizar o acesso ao conhecimento técnico e tático do futebol, permitindo que jogadores de todos os níveis possam aprender com os melhores profissionais do Brasil.
                    </p>
                    <ul class="checklist">
                        <li>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                ircle cx="10" cy="10" r="9" fill="#02FB9A"/>
                                <path d="M6 10L9 13L14 7" stroke="#000" stroke-width="2"/>
                            </svg>
                            Metodologia comprovada
                        </li>
                        <li>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                ircle cx="10" cy="10" r="9" fill="#02FB9A"/>
                                <path d="M6 10L9 13L14 7" stroke="#000" stroke-width="2"/>
                            </svg>
                            Suporte individualizado
                        </li>
                        <li>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                ircle cx="10" cy="10" r="9" fill="#02FB9A"/>
                                <path d="M6 10L9 13L14 7" stroke="#000" stroke-width="2"/>
                            </svg>
                            Comunidade exclusiva
                        </li>
                    </ul>
                    <a href="#cursos" class="btn btn--primary btn--lg">
                        Conhecer Cursos
                    </a>
                </div>

                <div class="about-image" data-aos="fade-left">
                    <div class="image-wrapper">
                        <img 
                            src="https://images.unsplash.com/photo-1574629810360-7efbbe195018?q=80&w=800" 
                            alt="Treinamento Camisa 10"
                        >
                        <!-- Elemento decorativo -->
                        <div class="image-decoration"></div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <?php
    /**
     * SEÇÃO 4: CURSOS (GRID ESTILO PORTFOLIO ONEKORSE)
     * Grid de cards com hover effect
     */
    $cursos_args = array(
        'post_type' => 'curso',
        'posts_per_page' => 6,
        'orderby' => 'date',
        'order' => 'DESC',
    );

    $cursos_query = new WP_Query($cursos_args);
    $has_cursos = $cursos_query->have_posts();
    ?>
    <section class="projects-section" id="cursos">
        <div class="container">
            
            <header class="section-header-center" data-aos="fade-up">
                <div class="section-label">Nossos Cursos</div>
                <h2 class="section-title-large">
                    Aprenda com os <span class="text-gradient">Melhores</span>
                </h2>
                <p class="section-subtitle">
                    Cursos desenvolvidos por profissionais de alto nível para acelerar sua evolução no futebol
                </p>
            </header>

            <div class="projects-grid">
                
                <?php 
                if ($has_cursos) :
                    $delay = 0;
                    while ($cursos_query->have_posts()) : $cursos_query->the_post();
                        $delay += 50;
                ?>

                <article class="project-card" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
                    <a href="<?php the_permalink(); ?>" class="project-link">
                        <div class="project-image">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('large'); ?>
                            <?php else : ?>
                                <img src="https://images.unsplash.com/photo-1606925797300-0b35e9d1794e?q=80&w=800" alt="<?php the_title(); ?>">
                            <?php endif; ?>
                            <div class="project-overlay">
                                <div class="project-overlay-content">
                                    <span class="project-category">Curso</span>
                                    <h3 class="project-title"><?php the_title(); ?></h3>
                                    <p class="project-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 12); ?></p>
                                    <span class="project-link-text">
                                        Ver Detalhes
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                            <path d="M5 10H15M15 10L11 6M15 10L11 14" stroke="currentColor" stroke-width="2"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                </article>

                <?php 
                    endwhile;
                    wp_reset_postdata();
                else :
                    // FALLBACK: Cursos de exemplo
                    for ($i = 1; $i <= 6; $i++) :
                        $images = [
                            'https://images.unsplash.com/photo-1606925797300-0b35e9d1794e?q=80&w=800',
                            'https://images.unsplash.com/photo-1574629810360-7efbbe195018?q=80&w=800',
                            'https://images.unsplash.com/photo-1579952363873-27f3bade9f55?q=80&w=800',
                            'https://images.unsplash.com/photo-1560272564-c83b66b1ad12?q=80&w=800',
                            'https://images.unsplash.com/photo-1431324155629-1a6deb1dec8d?q=80&w=800',
                            'https://images.unsplash.com/photo-1551958219-acbc608c6377?q=80&w=800',
                        ];
                        $titles = [
                            'Fundamentos do Futebol',
                            'Tática e Estratégia',
                            'Preparação Física',
                            'Técnica Individual',
                            'Leitura de Jogo',
                            'Alta Performance'
                        ];
                ?>

                <article class="project-card" data-aos="fade-up" data-aos-delay="<?php echo $i * 50; ?>">
                    <a href="#" class="project-link">
                        <div class="project-image">
                            <img src="<?php echo $images[$i-1]; ?>" alt="<?php echo $titles[$i-1]; ?>">
                            <div class="project-overlay">
                                <div class="project-overlay-content">
                                    <span class="project-category">Curso</span>
                                    <h3 class="project-title"><?php echo $titles[$i-1]; ?></h3>
                                    <p class="project-excerpt">Domine as técnicas essenciais e leve seu jogo para o próximo nível</p>
                                    <span class="project-link-text">
                                        Ver Detalhes
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                            <path d="M5 10H15M15 10L11 6M15 10L11 14" stroke="currentColor" stroke-width="2"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                </article>

                <?php endfor; endif; ?>

            </div>

            <div class="section-cta" data-aos="fade-up">
                <a href="<?php echo esc_url(get_post_type_archive_link('curso')); ?>" class="btn btn--outline btn--lg">
                    Ver Todos os Cursos
                </a>
            </div>

        </div>
    </section>

    <?php
    /**
     * SEÇÃO 5: NÚMEROS/STATS (ESTILO ONEKORSE)
     * Fundo escuro com contadores
     */
    ?>
    <section class="stats-section-dark">
        <div class="container">
            <div class="stats-grid-large">
                
                <div class="stat-item-large" data-aos="fade-up" data-aos-delay="0">
                    <div class="stat-number-large" data-target="1250">0</div>
                    <div class="stat-label-large">Alunos Ativos</div>
                </div>

                <div class="stat-item-large" data-aos="fade-up" data-aos-delay="100">
                    <div class="stat-number-large" data-target="50">0</div>
                    <div class="stat-label-large">Cursos Disponíveis</div>
                </div>

                <div class="stat-item-large" data-aos="fade-up" data-aos-delay="200">
                    <div class="stat-number-large" data-target="15">0</div>
                    <div class="stat-label-large">Instrutores Expert</div>
                </div>

                <div class="stat-item-large" data-aos="fade-up" data-aos-delay="300">
                    <div class="stat-number-large" data-target="98">0</div>
                    <div class="stat-label-large">% Satisfação</div>
                </div>

            </div>
        </div>
    </section>

    <?php
    /**
     * SEÇÃO 6: CTA FINAL (FULLWIDTH COM BACKGROUND)
     */
    ?>
    <section class="cta-fullwidth">
        <div class="cta-background">
            <img src="https://images.unsplash.com/photo-1574629810360-7efbbe195018?q=80&w=2000" alt="CTA Background">
        </div>
        <div class="cta-overlay"></div>
        <div class="container">
            <div class="cta-content-center" data-aos="fade-up">
                <h2 class="cta-title">
                    Pronto para Levar Seu Jogo<br>
                    ao <span class="text-gradient-alt">Próximo Nível?</span>
                </h2>
                <p class="cta-subtitle">
                    Junte-se a milhares de jogadores que já transformaram suas carreiras com a Camisa 10
                </p>
                <a href="#cursos" class="btn btn--primary btn--xl">
                    Começar Agora
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" class="btn-icon">
                        <path d="M5 10H15M15 10L11 6M15 10L11 14" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

</main>

<!-- Scroll to Top -->
<button class="scroll-to-top" aria-label="Voltar ao topo">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
        <path d="M12 19V5M12 5L6 11M12 5L18 11" stroke="currentColor" stroke-width="2"/>
    </svg>
</button>

<?php
get_footer();
