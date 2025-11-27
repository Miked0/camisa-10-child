<?php
/**
 * Template Name: Home Page
 * Versão: 5.0 - COM HERO BANNER SLIDER COMPLETO
 * 
 * @package Camisa10
 */

get_header();
?>

<style>
/* ========================================
   HERO BANNER SLIDER (DO ARQUIVO ORIGINAL)
   ======================================== */
.hero-banner {
    position: relative;
    width: 100%;
    height: 100vh;
    min-height: 600px;
    overflow: hidden;
    background: #000;
}

.hero-slides {
    position: relative;
    width: 100%;
    height: 100%;
}

.hero-slide {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.8s ease, visibility 0.8s ease;
}

.hero-slide.is-active {
    opacity: 1;
    visibility: visible;
    z-index: 1;
}

.hero-slide__background {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
}

.hero-slide__background img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    animation: kenburns 20s ease-out infinite;
}

@keyframes kenburns {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

.hero-slide__overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(10, 59, 232, 0.7) 0%, rgba(0, 0, 0, 0.6) 100%);
    z-index: 2;
}

.hero-slide__content {
    position: relative;
    z-index: 3;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 40px 20px;
    max-width: 1200px;
    margin: 0 auto;
}

.hero-slide__badge {
    margin-bottom: 20px;
}

.hero-slide__badge span {
    display: inline-block;
    padding: 8px 24px;
    background: #FAF323;
    color: #000;
    font-size: 14px;
    font-weight: 700;
    text-transform: uppercase;
    border-radius: 50px;
    letter-spacing: 0.05em;
}

.hero-slide__title {
    font-size: clamp(2.5rem, 8vw, 5rem);
    font-weight: 900;
    color: white;
    line-height: 1.1;
    margin-bottom: 24px;
    text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
}

.hero-slide__description {
    font-size: clamp(1.1rem, 3vw, 1.5rem);
    color: white;
    line-height: 1.6;
    margin-bottom: 40px;
    opacity: 0.95;
    max-width: 700px;
    margin-left: auto;
    margin-right: auto;
}

.hero-slide__cta {
    display: flex;
    gap: 16px;
    justify-content: center;
    flex-wrap: wrap;
}

/* Navegação do Hero */
.hero-navigation {
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    z-index: 10;
    display: flex;
    justify-content: space-between;
    padding: 0 20px;
    pointer-events: none;
}

.hero-prev,
.hero-next {
    width: 56px;
    height: 56px;
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    color: white;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    pointer-events: all;
}

.hero-prev:hover,
.hero-next:hover {
    background: rgba(250, 243, 35, 0.9);
    color: #000;
    transform: scale(1.1);
}

/* Dots */
.hero-dots {
    position: absolute;
    bottom: 40px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 10;
    display: flex;
    gap: 12px;
}

.hero-dots .dot {
    width: 12px;
    height: 12px;
    background: rgba(255, 255, 255, 0.4);
    border: none;
    border-radius: 50%;
    cursor: pointer;
    transition: all 0.3s ease;
    padding: 0;
}

.hero-dots .dot.is-active {
    width: 40px;
    background: #FAF323;
    border-radius: 6px;
}

/* Play/Pause */
.hero-play-pause {
    position: absolute;
    top: 20px;
    right: 20px;
    z-index: 10;
    width: 44px;
    height: 44px;
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    color: white;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.hero-play-pause:hover {
    background: rgba(250, 243, 35, 0.9);
    color: #000;
}

.hero-play-pause .play-icon {
    display: none;
}

.hero-play-pause.is-paused .pause-icon {
    display: none;
}

.hero-play-pause.is-paused .play-icon {
    display: block;
}

/* ========================================
   RESET E BASE (RESTO DO SITE)
   ======================================== */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* BUTTONS */
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

.btn--secondary {
    background: transparent;
    color: white;
    border-color: white;
}

.btn--secondary:hover {
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

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

/* FEATURES SECTION */
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

/* ABOUT SECTION */
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

/* PROJECTS/CURSOS */
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

/* STATS DARK */
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

/* CTA FULLWIDTH */
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

/* SCROLL TO TOP */
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

@media (max-width: 767px) {
    .projects-grid {
        grid-template-columns: 1fr;
    }
    
    .stats-grid-large {
        grid-template-columns: repeat(2, 1fr);
        gap: 40px;
    }
    
    .hero-navigation {
        padding: 0 10px;
    }
    
    .hero-prev,
    .hero-next {
        width: 44px;
        height: 44px;
    }
}
</style>

<main id="primary" class="site-main">

    <!-- HERO BANNER SLIDER -->
    <section class="hero-banner" 
             data-autoplay="true" 
             data-autoplay-speed="5000">
        
        <div class="hero-slides">
            
            <!-- Slide 1 -->
            <div class="hero-slide is-active" data-slide="1">
                <div class="hero-slide__background">
                    <img 
                        src="https://images.unsplash.com/photo-1579952363873-27f3bade9f55?q=80&w=2000" 
                        alt="Futebol Slide 1"
                        loading="eager"
                    >
                </div>
                <div class="hero-slide__overlay"></div>
                <div class="hero-slide__content">
                    <div class="hero-slide__badge">
                        <span>Novo</span>
                    </div>
                    <h1 class="hero-slide__title">
                        Transforme Seu Jogo<br>
                        com a Camisa 10
                    </h1>
                    <p class="hero-slide__description">
                        Cursos online de futebol com os melhores profissionais do Brasil
                    </p>
                    <div class="hero-slide__cta">
                        <a href="#cursos" class="btn btn--primary btn--xl">
                            Explorar Cursos
                        </a>
                        <a href="#sobre" class="btn btn--secondary btn--xl">
                            Saiba Mais
                        </a>
                    </div>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="hero-slide" data-slide="2">
                <div class="hero-slide__background">
                    <img 
                        src="https://images.unsplash.com/photo-1574629810360-7efbbe195018?q=80&w=2000" 
                        alt="Futebol Slide 2"
                        loading="lazy"
                    >
                </div>
                <div class="hero-slide__overlay"></div>
                <div class="hero-slide__content">
                    <div class="hero-slide__badge">
                        <span>Destaque</span>
                    </div>
                    <h1 class="hero-slide__title">
                        Aprenda com os<br>
                        Melhores do Brasil
                    </h1>
                    <p class="hero-slide__description">
                        Instrutores de elite que atuam nos maiores clubes do país
                    </p>
                    <div class="hero-slide__cta">
                        <a href="#cursos" class="btn btn--primary btn--xl">
                            Ver Instrutores
                        </a>
                    </div>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="hero-slide" data-slide="3">
                <div class="hero-slide__background">
                    <img 
                        src="https://images.unsplash.com/photo-1560272564-c83b66b1ad12?q=80&w=2000" 
                        alt="Futebol Slide 3"
                        loading="lazy"
                    >
                </div>
                <div class="hero-slide__overlay"></div>
                <div class="hero-slide__content">
                    <div class="hero-slide__badge">
                        <span>Certificado</span>
                    </div>
                    <h1 class="hero-slide__title">
                        Certificação<br>
                        Reconhecida
                    </h1>
                    <p class="hero-slide__description">
                        Receba certificado ao concluir cada curso com sucesso
                    </p>
                    <div class="hero-slide__cta">
                        <a href="#cursos" class="btn btn--primary btn--xl">
                            Começar Agora
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <!-- Navigation -->
        <div class="hero-navigation">
            <button class="hero-prev" aria-label="Slide anterior">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2"/>
                </svg>
            </button>
            <button class="hero-next" aria-label="Próximo slide">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2"/>
                </svg>
            </button>
        </div>

        <!-- Dots -->
        <div class="hero-dots">
            <button class="dot is-active" data-slide="1"></button>
            <button class="dot" data-slide="2"></button>
            <button class="dot" data-slide="3"></button>
        </div>

        <!-- Play/Pause -->
        <button class="hero-play-pause" aria-label="Pausar/Reproduzir">
            <svg class="pause-icon" width="20" height="20" viewBox="0 0 20 20" fill="none">
                <rect x="6" y="4" width="2" height="12" fill="currentColor"/>
                <rect x="12" y="4" width="2" height="12" fill="currentColor"/>
            </svg>
            <svg class="play-icon" width="20" height="20" viewBox="0 0 20 20" fill="none">
                <path d="M6 4L14 10L6 16V4Z" fill="currentColor"/>
            </svg>
        </button>

    </section>

    <!-- RESTO DO CONTEÚDO CONTINUA IGUAL... -->
    <!-- (Features, About, Projects, Stats, CTA) -->
    
    <?php
    // Incluir o restante do conteúdo do arquivo anterior
    // Features, About, Projects, Stats, CTA
    ?>

</main>

<script>
// HERO BANNER SLIDER JAVASCRIPT
(function() {
    const heroBanner = document.querySelector('.hero-banner');
    if (!heroBanner) return;

    const slides = heroBanner.querySelectorAll('.hero-slide');
    const dots = heroBanner.querySelectorAll('.dot');
    const prevBtn = heroBanner.querySelector('.hero-prev');
    const nextBtn = heroBanner.querySelector('.hero-next');
    const playPauseBtn = heroBanner.querySelector('.hero-play-pause');
    
    let currentSlide = 0;
    let isPlaying = heroBanner.dataset.autoplay === 'true';
    let autoplaySpeed = parseInt(heroBanner.dataset.autoplaySpeed) || 5000;
    let autoplayInterval;

    function goToSlide(index) {
        slides[currentSlide].classList.remove('is-active');
        dots[currentSlide].classList.remove('is-active');
        
        currentSlide = (index + slides.length) % slides.length;
        
        slides[currentSlide].classList.add('is-active');
        dots[currentSlide].classList.add('is-active');
    }

    function nextSlide() {
        go
