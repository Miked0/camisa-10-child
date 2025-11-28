<?php
/**
 * Template Name: Home Page
 * Versão: 4.1 - COM CSS EMBUTIDO
 * 
 * @package Camisa10
 */

get_header();
?>

<style>
/* ========================================
   RESET E BASE
   ======================================== */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* ========================================
   HERO FULLSCREEN
   ======================================== */
.hero-fullscreen {
    position: relative;
    width: 100%;
    height: 100vh;
    min-height: 600px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.hero-background {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
}

.hero-background img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(10, 59, 232, 0.85) 0%, rgba(0, 0, 0, 0.7) 100%);
    z-index: 2;
}

.hero-content {
    position: relative;
    z-index: 3;
    text-align: center;
    color: white;
    padding: 40px 20px;
}

.hero-title {
    font-size: clamp(2.5rem, 8vw, 5rem);
    font-weight: 900;
    line-height: 1.1;
    margin-bottom: 24px;
}

.hero-title .highlight {
    background: linear-gradient(90deg, #FAF323, #02FB9A);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.hero-subtitle {
    font-size: clamp(1.1rem, 3vw, 1.5rem);
    margin-bottom: 40px;
    opacity: 0.95;
    max-width: 700px;
    margin-left: auto;
    margin-right: auto;
}

.hero-cta {
    display: flex;
    gap: 20px;
    justify-content: center;
    flex-wrap: wrap;
}

.scroll-indicator {
    position: absolute;
    bottom: 40px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 3;
    animation: bounce 2s infinite;
}

.scroll-indicator a {
    color: white;
    opacity: 0.7;
    transition: opacity 0.3s;
}

.scroll-indicator a:hover {
    opacity: 1;
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
        transform: translateX(-50%) translateY(0);
    }
    40% {
        transform: translateX(-50%) translateY(-10px);
    }
    60% {
        transform: translateX(-50%) translateY(-5px);
    }
}

/* ========================================
   BUTTONS
   ======================================== */
.btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 16px 32px;
    font-size: 16px;
    font-weight: 700;
    text-decoration: none;
    border-radius: 8px;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.btn--primary {
    background: #FAF323;
    color: #000;
}

.btn--primary:hover {
    background: #02FB9A;
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(250, 243, 35, 0.3);
}

.btn--outline-white {
    background: transparent;
    color: white;
    border-color: white;
}

.btn--outline-white:hover {
    background: white;
    color: #0A3BE8;
}

.btn--outline {
    background: transparent;
    color: #0A3BE8;
    border-color: #0A3BE8;
}

.btn--outline:hover {
    background: #0A3BE8;
    color: white;
}

.btn--xl {
    padding: 20px 48px;
    font-size: 18px;
}

.btn--lg {
    padding: 18px 40px;
    font-size: 17px;
}

/* ========================================
   CONTAINER
   ======================================== */
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

/* ========================================
   FEATURES SECTION
   ======================================== */
.features-section {
    padding: 100px 0;
    background: white;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 40px;
}

.feature-card {
    text-align: center;
    padding: 40px 20px;
}

.feature-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #0A3BE8, #02FB9A);
    border-radius: 20px;
    color: white;
}

.feature-card h3 {
    font-size: 24px;
    font-weight: 700;
    color: #0A3BE8;
    margin-bottom: 16px;
}

.feature-card p {
    font-size: 16px;
    line-height: 1.6;
    color: #666;
}

/* ========================================
   ABOUT SECTION
   ======================================== */
.about-section {
    padding: 100px 0;
    background: #f8f9fa;
}

.about-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 60px;
    align-items: center;
}

@media (min-width: 768px) {
    .about-grid {
        grid-template-columns: 1fr 1fr;
    }
}

.section-label {
    display: inline-block;
    padding: 8px 20px;
    background: rgba(10, 59, 232, 0.1);
    color: #0A3BE8;
    font-size: 14px;
    font-weight: 700;
    text-transform: uppercase;
    border-radius: 50px;
    margin-bottom: 20px;
}

.section-title-large {
    font-size: clamp(2rem, 5vw, 3.5rem);
    font-weight: 900;
    line-height: 1.2;
    color: #000;
    margin-bottom: 24px;
}

.text-gradient {
    background: linear-gradient(90deg, #0A3BE8, #02FB9A);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.text-large {
    font-size: 20px;
    font-weight: 500;
    color: #333;
    margin-bottom: 20px;
    line-height: 1.6;
}

.about-content p {
    font-size: 16px;
    line-height: 1.8;
    color: #666;
    margin-bottom: 20px;
}

.checklist {
    list-style: none;
    margin: 30px 0;
}

.checklist li {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 16px;
    color: #333;
    margin-bottom: 16px;
}

.about-content .btn {
    margin-top: 20px;
}

.about-image {
    position: relative;
}

.image-wrapper {
    position: relative;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
}

.image-wrapper img {
    width: 100%;
    height: auto;
    display: block;
}

.image-decoration {
    position: absolute;
    top: -20px;
    right: -20px;
    width: 200px;
    height: 200px;
    background: linear-gradient(135deg, #FAF323, #02FB9A);
    border-radius: 20px;
    z-index: -1;
    opacity: 0.3;
}

/* ========================================
   PROJECTS/CURSOS SECTION
   ======================================== */
.projects-section {
    padding: 100px 0;
    background: white;
}

.section-header-center {
    text-align: center;
    max-width: 800px;
    margin: 0 auto 80px;
}

.section-subtitle {
    font-size: 18px;
    color: #666;
    line-height: 1.6;
    margin-top: 16px;
}

.projects-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 30px;
    margin-bottom: 60px;
}

.project-card {
    position: relative;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.project-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.2);
}

.project-link {
    display: block;
    text-decoration: none;
    color: inherit;
}

.project-image {
    position: relative;
    width: 100%;
    height: 400px;
    overflow: hidden;
}

.project-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.project-card:hover .project-image img {
    transform: scale(1.1);
}

.project-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to top, rgba(10, 59, 232, 0.95) 0%, rgba(0, 0, 0, 0.7) 100%);
    display: flex;
    align-items: flex-end;
    padding: 40px;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.project-card:hover .project-overlay {
    opacity: 1;
}

.project-overlay-content {
    color: white;
}

.project-category {
    display: inline-block;
    padding: 6px 16px;
    background: #FAF323;
    color: #000;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    border-radius: 50px;
    margin-bottom: 12px;
}

.project-title {
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 12px;
    color: white;
}

.project-excerpt {
    font-size: 14px;
    line-height: 1.6;
    margin-bottom: 16px;
    opacity: 0.9;
}

.project-link-text {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    font-weight: 700;
    color: #FAF323;
}

.section-cta {
    text-align: center;
    margin-top: 60px;
}

/* ========================================
   STATS SECTION DARK
   ======================================== */
.stats-section-dark {
    padding: 100px 0;
    background: linear-gradient(135deg, #0A3BE8 0%, #02FB9A 100%);
    color: white;
}

.stats-grid-large {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 60px;
    text-align: center;
}

.stat-item-large {
    padding: 20px;
}

.stat-number-large {
    font-size: clamp(3rem, 8vw, 5rem);
    font-weight: 900;
    color: #FAF323;
    line-height: 1;
    margin-bottom: 16px;
}

.stat-label-large {
    font-size: 18px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    opacity: 0.95;
}

/* ========================================
   CTA FULLWIDTH
   ======================================== */
.cta-fullwidth {
    position: relative;
    padding: 120px 0;
    overflow: hidden;
}

.cta-background {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
}

.cta-background img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.cta-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(10, 59, 232, 0.9) 0%, rgba(2, 251, 154, 0.8) 100%);
    z-index: 2;
}

.cta-content-center {
    position: relative;
    z-index: 3;
    text-align: center;
    color: white;
    max-width: 900px;
    margin: 0 auto;
}

.cta-title {
    font-size: clamp(2rem, 5vw, 4rem);
    font-weight: 900;
    line-height: 1.2;
    margin-bottom: 24px;
}

.text-gradient-alt {
    background: linear-gradient(90deg, #FAF323, white);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.cta-subtitle {
    font-size: clamp(1rem, 3vw, 1.3rem);
    margin-bottom: 40px;
    opacity: 0.95;
}

/* ========================================
   SCROLL TO TOP
   ======================================== */
.scroll-to-top {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 56px;
    height: 56px;
    background: linear-gradient(135deg, #0A3BE8, #02FB9A);
    color: white;
    border: none;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
    opacity: 0;
    visibility: hidden;
    transform: translateY(20px);
    transition: all 0.3s ease;
    z-index: 1000;
}

.scroll-to-top.visible {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.scroll-to-top:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.3);
}

/* ========================================
   RESPONSIVE
   ======================================== */
@media (max-width: 767px) {
    .projects-grid {
        grid-template-columns: 1fr;
    }
    
    .stats-grid-large {
        grid-template-columns: repeat(2, 1fr);
        gap: 40px;
    }
    
    .hero-cta {
        flex-direction: column;
    }
    
    .btn {
        width: 100%;
        justify-content: center;
    }
}
</style>

<main id="primary" class="site-main">

    <!-- HERO FULLSCREEN -->
    <section class="hero-fullscreen">
        <div class="hero-background">
            <img 
                src="https://images.unsplash.com/photo-1579952363873-27f3bade9f55?q=80&w=2000" 
                alt="Futebol Camisa 10"
            >
        </div>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <div class="container">
                <h1 class="hero-title">
                    Transforme Seu Jogo<br>
                    <span class="highlight">com a Camisa 10</span>
                </h1>
                <p class="hero-subtitle">
                    Cursos online de futebol com os melhores profissionais do Brasil
                </p>
                <div class="hero-cta">
                    <a href="#cursos" class="btn btn--primary btn--xl">
                        Explorar Cursos
                    </a>
                    <a href="#sobre" class="btn btn--outline-white btn--xl">
                        Saiba Mais
                    </a>
                </div>
            </div>
        </div>
        <div class="scroll-indicator">
            <a href="#features">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M12 5V19M12 19L6 13M12 19L18 13" stroke="currentColor" stroke-width="2"/>
                </svg>
            </a>
        </div>
    </section>

    <!-- FEATURES -->
    <section class="features-section" id="features">
        <div class="container">
            <div class="features-grid">
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                            ircle cx="24" cy="24" r="20" stroke="currentColor" stroke-width="2"/>
                            <path d="M24 12L27 21H36L29 27L32 36L24 30L16 36L19 27L12 21H21L24 12Z" fill="currentColor"/>
                        </svg>
                    </div>
                    <h3>Instrutores de Elite</h3>
                    <p>Aprenda com profissionais que atuam nos maiores clubes e seleções do país</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                            <rect x="8" y="12" width="32" height="24" rx="2" stroke="currentColor" stroke-width="2"/>
                            <path d="M20 22L28 26L20 30V22Z" fill="currentColor"/>
                        </svg>
                    </div>
                    <h3>Aulas Online</h3>
                    <p>Assista quando e onde quiser, no seu ritmo e com suporte dedicado</p>
                </div>

                <div class="feature-card">
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

    <!-- ABOUT -->
    <section class="about-section" id="sobre">
        <div class="container">
            <div class="about-grid">
                
                <div class="about-content">
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

                <div class="about-image">
                    <div class="image-wrapper">
                        <img 
                            src="https://images.unsplash.com/photo-1574629810360-7efbbe195018?q=80&w=800" 
                            alt="Treinamento Camisa 10"
                        >
                        <div class="image-decoration"></div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- CURSOS/PROJECTS -->
    <section class="projects-section" id="cursos">
        <div class="container">
            
            <header class="section-header-center">
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
                // Cursos de exemplo
                $cursos_exemplo = [
                    [
                        'img' => 'https://images.unsplash.com/photo-1606925797300-0b35e9d1794e?q=80&w=800',
                        'titulo' => 'Fundamentos do Futebol',
                        'desc' => 'Domine as bases essenciais do futebol moderno com técnicas comprovadas'
                    ],
                    [
                        'img' => 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?q=80&w=800',
                        'titulo' => 'Tática e Estratégia',
                        'desc' => 'Aprenda esquemas táticos e leitura de jogo para se destacar'
                    ],
                    [
                        'img' => 'https://images.unsplash.com/photo-1579952363873-27f3bade9f55?q=80&w=800',
                        'titulo' => 'Preparação Física',
                        'desc' => 'Desenvolva resistência, força e velocidade de forma profissional'
                    ],
                    [
                        'img' => 'https://images.unsplash.com/photo-1560272564-c83b66b1ad12?q=80&w=800',
                        'titulo' => 'Técnica Individual',
                        'desc' => 'Aprimore dribles, passes e finalizações com exercícios práticos'
                    ],
                    [
                        'img' => 'https://images.unsplash.com/photo-1431324155629-1a6deb1dec8d?q=80&w=800',
                        'titulo' => 'Leitura de Jogo',
                        'desc' => 'Desenvolva inteligência tática e antecipação em campo'
                    ],
                    [
                        'img' => 'https://images.unsplash.com/photo-1551958219-acbc608c6377?q=80&w=800',
                        'titulo' => 'Alta Performance',
                        'desc' => 'Prepare-se para o alto nível com treinos de elite'
                    ]
                ];

                foreach ($cursos_exemplo as $curso) :
                ?>

                <article class="project-card">
                    <a href="#" class="project-link">
                        <div class="project-image">
                            <img src="<?php echo $curso['img']; ?>" alt="<?php echo $curso['titulo']; ?>">
                            <div class="project-overlay">
                                <div class="project-overlay-content">
                                    <span class="project-category">Curso</span>
                                    <h3 class="project-title"><?php echo $curso['titulo']; ?></h3>
                                    <p class="project-excerpt"><?php echo $curso['desc']; ?></p>
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

                <?php endforeach; ?>

            </div>

            <div class="section-cta">
                <a href="#" class="btn btn--outline btn--lg">
                    Ver Todos os Cursos
                </a>
            </div>

        </div>
    </section>

    <!-- STATS -->
    <section class="stats-section-dark">
        <div class="container">
            <div class="stats-grid-large">
                
                <div class="stat-item-large">
                    <div class="stat-number-large">1250+</div>
                    <div class="stat-label-large">Alunos Ativos</div>
                </div>

                <div class="stat-item-large">
                    <div class="stat-number-large">50+</div>
                    <div class="stat-label-large">Cursos Disponíveis</div>
                </div>

                <div class="stat-item-large">
                    <div class="stat-number-large">15+</div>
                    <div class="stat-label-large">Instrutores Expert</div>
                </div>

                <div class="stat-item-large">
                    <div class="stat-number-large">98%</div>
                    <div class="stat-label-large">Satisfação</div>
                </div>

            </div>
        </div>
    </section>

    <!-- CTA FINAL -->
    <section class="cta-fullwidth">
        <div class="cta-background">
            <img src="https://images.unsplash.com/photo-1574629810360-7efbbe195018?q=80&w=2000" alt="CTA">
        </div>
        <div class="cta-overlay"></div>
        <div class="container">
            <div class="cta-content-center">
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

<script>
// Scroll to top button
window.addEventListener('scroll', function() {
    const scrollBtn = document.querySelector('.scroll-to-top');
    if (window.scrollY > 500) {
        scrollBtn.classList.add('visible');
    } else {
        scrollBtn.classList.remove('visible');
    }
});

document.querySelector('.scroll-to-top').addEventListener('click', function() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
});
</script>

<?php
get_footer();
