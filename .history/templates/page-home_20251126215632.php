<?php
/**
 * Template Name: Home Page
 * Versão: 6.0 - HERO 50/50 ESTILO ONEKORSE
 * 
 * @package Camisa10
 */

get_header();
?>

<style>
/* ========================================
   RESET
   ======================================== */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', sans-serif;
}

/* ========================================
   HERO BANNER 50/50 (ESTILO ONEKORSE)
   ======================================== */
.hero-banner-split {
    display: grid;
    grid-template-columns: 1fr;
    min-height: 100vh;
    position: relative;
}

@media (min-width: 768px) {
    .hero-banner-split {
        grid-template-columns: 1fr 1fr;
    }
}

/* LADO ESQUERDO - CONTEÚDO */
.hero-content-side {
    display: flex;
    align-items: center;
    padding: 80px 40px;
    background: #fff;
    position: relative;
    z-index: 2;
}

@media (min-width: 1024px) {
    .hero-content-side {
        padding: 80px 80px 80px 120px;
    }
}

.hero-content-wrapper {
    max-width: 600px;
    width: 100%;
}

.hero-label {
    display: inline-block;
    padding: 8px 20px;
    background: rgba(10, 59, 232, 0.08);
    color: #0A3BE8;
    font-size: 14px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    border-radius: 50px;
    margin-bottom: 24px;
}

.hero-heading {
    font-size: clamp(2.5rem, 6vw, 4.5rem);
    font-weight: 900;
    line-height: 1.1;
    color: #000;
    margin-bottom: 24px;
    letter-spacing: -0.02em;
}

.hero-heading .highlight {
    background: linear-gradient(135deg, #0A3BE8 0%, #02FB9A 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.hero-text {
    font-size: 18px;
    line-height: 1.7;
    color: #666;
    margin-bottom: 40px;
}

.hero-buttons {
    display: flex;
    gap: 16px;
    flex-wrap: wrap;
}

/* LADO DIREITO - IMAGEM */
.hero-image-side {
    position: relative;
    min-height: 500px;
    overflow: hidden;
}

@media (min-width: 768px) {
    .hero-image-side {
        min-height: 100vh;
    }
}

.hero-image-wrapper {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

.hero-image-wrapper::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(10, 59, 232, 0.1) 0%, rgba(2, 251, 154, 0.1) 100%);
    z-index: 1;
}

.hero-image-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Badge decorativo na imagem */
.hero-image-badge {
    position: absolute;
    bottom: 40px;
    left: 40px;
    z-index: 2;
    background: white;
    padding: 24px 32px;
    border-radius: 12px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
}

.hero-image-badge-number {
    font-size: 48px;
    font-weight: 900;
    color: #0A3BE8;
    line-height: 1;
    margin-bottom: 8px;
}

.hero-image-badge-text {
    font-size: 14px;
    font-weight: 600;
    color: #666;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

/* ========================================
   BUTTONS
   ======================================== */
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 18px 36px;
    font-size: 16px;
    font-weight: 700;
    text-decoration: none;
    border-radius: 8px;
    transition: all 0.3s ease;
    border: 2px solid transparent;
    cursor: pointer;
}

.btn--primary {
    background: #0A3BE8;
    color: white;
}

.btn--primary:hover {
    background: #02FB9A;
    color: #000;
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(10, 59, 232, 0.3);
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

.btn svg {
    width: 20px;
    height: 20px;
}

/* ========================================
   FEATURES SECTION
   ======================================== */
.features-section {
    padding: 120px 0;
    background: #f8f9fa;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 40px;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 40px;
}

.feature-card {
    background: white;
    padding: 40px;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
    transition: all 0.3s ease;
}

.feature-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
}

.feature-icon {
    width: 64px;
    height: 64px;
    background: linear-gradient(135deg, #0A3BE8, #02FB9A);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    margin-bottom: 24px;
}

.feature-card h3 {
    font-size: 22px;
    font-weight: 700;
    color: #000;
    margin-bottom: 12px;
}

.feature-card p {
    font-size: 16px;
    line-height: 1.6;
    color: #666;
}

/* ========================================
   ABOUT SECTION (50/50 INVERTIDO)
   ======================================== */
.about-section {
    padding: 120px 0;
    background: white;
}

.about-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 80px;
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
    background: rgba(10, 59, 232, 0.08);
    color: #0A3BE8;
    font-size: 14px;
    font-weight: 700;
    text-transform: uppercase;
    border-radius: 50px;
    margin-bottom: 20px;
}

.section-title {
    font-size: clamp(2rem, 5vw, 3.5rem);
    font-weight: 900;
    line-height: 1.2;
    color: #000;
    margin-bottom: 24px;
}

.text-gradient {
    background: linear-gradient(135deg, #0A3BE8, #02FB9A);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.about-text {
    font-size: 18px;
    line-height: 1.8;
    color: #666;
    margin-bottom: 32px;
}

.about-image {
    position: relative;
}

.about-image img {
    width: 100%;
    height: auto;
    border-radius: 20px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
}

/* ========================================
   PROJECTS SECTION
   ======================================== */
.projects-section {
    padding: 120px 0;
    background: #f8f9fa;
}

.section-header {
    text-align: center;
    max-width: 700px;
    margin: 0 auto 80px;
}

.section-subtitle {
    font-size: 18px;
    color: #666;
    margin-top: 16px;
}

.projects-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 30px;
}

.project-card {
    position: relative;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
}

.project-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
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
    background: linear-gradient(to top, rgba(10, 59, 232, 0.95), rgba(0, 0, 0, 0.4));
    display: flex;
    align-items: flex-end;
    padding: 32px;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.project-card:hover .project-overlay {
    opacity: 1;
}

.project-content {
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
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 8px;
}

.project-excerpt {
    font-size: 14px;
    opacity: 0.9;
    margin-bottom: 16px;
}

.project-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    font-weight: 700;
    color: #FAF323;
    text-decoration: none;
}

/* ========================================
   STATS SECTION
   ======================================== */
.stats-section {
    padding: 100px 0;
    background: linear-gradient(135deg, #0A3BE8, #02FB9A);
    color: white;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 60px;
    text-align: center;
}

.stat-number {
    font-size: clamp(3rem, 8vw, 5rem);
    font-weight: 900;
    color: #FAF323;
    line-height: 1;
    margin-bottom: 12px;
}

.stat-label {
    font-size: 18px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

/* ========================================
   CTA SECTION
   ======================================== */
.cta-section {
    padding: 120px 0;
    background: white;
    text-align: center;
}

.cta-content {
    max-width: 800px;
    margin: 0 auto;
}

.cta-title {
    font-size: clamp(2rem, 5vw, 4rem);
    font-weight: 900;
    margin-bottom: 24px;
    color: #000;
}

.cta-text {
    font-size: 20px;
    color: #666;
    margin-bottom: 40px;
}

/* ========================================
   RESPONSIVE
   ======================================== */
@media (max-width: 767px) {
    .hero-content-side {
        padding: 60px 24px;
    }
    
    .hero-buttons {
        flex-direction: column;
    }
    
    .btn {
        width: 100%;
    }
    
    .hero-image-badge {
        left: 24px;
        bottom: 24px;
        padding: 16px 24px;
    }
    
    .projects-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<main id="primary" class="site-main">

    <!-- ========================================
         HERO BANNER 50/50
         ======================================== -->
    <section class="hero-banner-split">
        
        <!-- LADO ESQUERDO - CONTEÚDO -->
        <div class="hero-content-side">
            <div class="hero-content-wrapper">
                
                <span class="hero-label">Novo na Camisa 10</span>
                
                <h1 class="hero-heading">
                    Transforme Seu Jogo com a <span class="highlight">Camisa 10</span>
                </h1>
                
                <p class="hero-text">
                    Aprenda com os melhores profissionais do futebol brasileiro através de cursos online de alta qualidade. Evolua sua técnica, tática e mentalidade.
                </p>
                
                <div class="hero-buttons">
                    <a href="#cursos" class="btn btn--primary">
                        Explorar Cursos
                        <svg viewBox="0 0 20 20" fill="none">
                            <path d="M5 10H15M15 10L11 6M15 10L11 14" stroke="currentColor" stroke-width="2"/>
                        </svg>
                    </a>
                    <a href="#sobre" class="btn btn--outline">
                        Saiba Mais
                    </a>
                </div>
                
            </div>
        </div>

        <!-- LADO DIREITO - IMAGEM -->
        <div class="hero-image-side">
            <div class="hero-image-wrapper">
                <img 
                    src="https://images.unsplash.com/photo-1579952363873-27f3bade9f55?q=80&w=1600" 
                    alt="Futebol Camisa 10"
                >
            </div>
            <div class="hero-image-badge">
                <div class="hero-image-badge-number">1250+</div>
                <div class="hero-image-badge-text">Alunos Ativos</div>
            </div>
        </div>

    </section>

    <!-- ========================================
         FEATURES
         ======================================== -->
    <section class="features-section">
        <div class="container">
            <div class="features-grid">
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none">
                            ircle cx="16" cy="16" r="12" stroke="currentColor" stroke-width="2"/>
                            <path d="M16 8L18 14H24L19 18L21 24L16 20L11 24L13 18L8 14H14L16 8Z" fill="currentColor"/>
                        </svg>
                    </div>
                    <h3>Instrutores de Elite</h3>
                    <p>Aprenda com profissionais que atuam nos maiores clubes e seleções do país</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none">
                            <rect x="6" y="8" width="20" height="16" rx="2" stroke="currentColor" stroke-width="2"/>
                            <path d="M14 14L20 17L14 20V14Z" fill="currentColor"/>
                        </svg>
                    </div>
                    <h3>Aulas Online</h3>
                    <p>Assista quando e onde quiser, no seu ritmo e com suporte dedicado</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none">
                            <path d="M16 6L18 13H26L20 18L22 26L16 21L10 26L12 18L6 13H14L16 6Z" stroke="currentColor" stroke-width="2" fill="none"/>
                        </svg>
                    </div>
                    <h3>Certificado Reconhecido</h3>
                    <p>Receba certificado ao concluir cada curso com sucesso</p>
                </div>

            </div>
        </div>
    </section>

    <!-- ========================================
         ABOUT (50/50 INVERTIDO)
         ======================================== -->
    <section class="about-section" id="sobre">
        <div class="container">
            <div class="about-grid">
                
                <div class="about-image">
                    <img 
                        src="https://images.unsplash.com/photo-1574629810360-7efbbe195018?q=80&w=800" 
                        alt="Sobre Camisa 10"
                    >
                </div>

                <div class="about-content">
                    <span class="section-label">Quem Somos</span>
                    <h2 class="section-title">
                        A Camisa 10 é Sua<br>
                        Plataforma de <span class="text-gradient">Evolução</span>
                    </h2>
                    <p class="about-text">
                        Somos uma plataforma dedicada ao desenvolvimento de jogadores de futebol através de cursos online de alta qualidade. Nossa missão é democratizar o acesso ao conhecimento técnico e tático do futebol.
                    </p>
                    <a href="#cursos" class="btn btn--primary">
                        Conhecer Cursos
                        <svg viewBox="0 0 20 20" fill="none">
                            <path d="M5 10H15M15 10L11 6M15 10L11 14" stroke="currentColor" stroke-width="2"/>
                        </svg>
                    </a>
                </div>

            </div>
        </div>
    </section>

    <!-- ========================================
         CURSOS/PROJECTS
         ======================================== -->
    <section class="projects-section" id="cursos">
        <div class="container">
            
            <div class="section-header">
                <span class="section-label">Nossos Cursos</span>
                <h2 class="section-title">
                    Aprenda com os <span class="text-gradient">Melhores</span>
                </h2>
                <p class="section-subtitle">
                    Cursos desenvolvidos por profissionais de alto nível para acelerar sua evolução
                </p>
            </div>

            <div class="projects-grid">
                
                <?php
                $cursos = [
                    ['img' => 'https://images.unsplash.com/photo-1606925797300-0b35e9d1794e?q=80&w=800', 'titulo' => 'Fundamentos do Futebol', 'desc' => 'Domine as bases essenciais'],
                    ['img' => 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?q=80&w=800', 'titulo' => 'Tática e Estratégia', 'desc' => 'Aprenda leitura de jogo'],
                    ['img' => 'https://images.unsplash.com/photo-1579952363873-27f3bade9f55?q=80&w=800', 'titulo' => 'Preparação Física', 'desc' => 'Desenvolva resistência'],
                    ['img' => 'https://images.unsplash.com/photo-1560272564-c83b66b1ad12?q=80&w=800', 'titulo' => 'Técnica Individual', 'desc' => 'Aprimore dribles e passes'],
                    ['img' => 'https://images.unsplash.com/photo-1431324155629-1a6deb1dec8d?q=80&w=800', 'titulo' => 'Leitura de Jogo', 'desc' => 'Inteligência tática'],
                    ['img' => 'https://images.unsplash.com/photo-1551958219-acbc608c6377?q=80&w=800', 'titulo' => 'Alta Performance', 'desc' => 'Treinos de elite'],
                ];

                foreach ($cursos as $curso) :
                ?>
                <div class="project-card">
                    <div class="project-image">
                        <img src="<?php echo $curso['img']; ?>" alt="<?php echo $curso['titulo']; ?>">
                        <div class="project-overlay">
                            <div class="project-content">
                                <span class="project-category">Curso</span>
                                <h3 class="project-title"><?php echo $curso['titulo']; ?></h3>
                                <p class="project-excerpt"><?php echo $curso['desc']; ?></p>
                                <a href="#" class="project-link">
                                    Ver Detalhes
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M4 8H12M12 8L9 5M12 8L9 11" stroke="currentColor" stroke-width="2"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>

            </div>

        </div>
    </section>

    <!-- ========================================
         STATS
         ======================================== -->
    <section class="stats-section">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number">1250+</div>
                    <div class="stat-label">Alunos Ativos</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">50+</div>
                    <div class="stat-label">Cursos</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">15+</div>
                    <div class="stat-label">Instrutores</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">98%</div>
                    <div class="stat-label">Satisfação</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================
         CTA
         ======================================== -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2 class="cta-title">
                    Pronto para Levar Seu Jogo<br>
                    ao <span class="text-gradient">Próximo Nível?</span>
                </h2>
                <p class="cta-text">
                    Junte-se a milhares de jogadores que já transformaram suas carreiras
                </p>
                <a href="#cursos" class="btn btn--primary">
                    Começar Agora
                    <svg viewBox="0 0 20 20" fill="none">
                        <path d="M5 10H15M15 10L11 6M15 10L11 14" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();
