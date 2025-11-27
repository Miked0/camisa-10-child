<?php
/**
 * Template Part: Hero Banner
 * Carousel principal usando Bootstrap 5
 * @package Camisa10
 * @version 3.0.0
 */

// Prevenir acesso direto
if (!defined('ABSPATH')) {
    exit;
}
?>

<!-- ============================================
     HERO BANNER SECTION
     ============================================ -->
<section class="hero-banner-section">
    
    <!-- Bootstrap 5 Carousel -->
    <div id="heroCarousel" class="carousel slide hero-carousel" data-bs-ride="carousel">
        
        <!-- Indicadores -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>

        <!-- Slides -->
        <div class="carousel-inner">
            
            <!-- ===== SLIDE 1 ===== -->
            <div class="carousel-item active" data-bs-interval="6000">
                <div class="hero-grid-container">
                    
                    <!-- Lado Esquerdo - Conteúdo -->
                    <div class="hero-content-left">
                        <span class="hero-badge" data-aos="fade-right">🎯 Novidade</span>
                        
                        <h1 class="hero-title" data-aos="fade-right" data-aos-delay="100">
                            <span class="highlight-yellow">Transforme</span>
                            <span class="highlight-blue">Sua Carreira</span>
                            <span>Com Excelência</span>
                        </h1>
                        
                        <p class="hero-description" data-aos="fade-right" data-aos-delay="200">
                            Capacitação profissional de alta performance. Aprenda estratégias comprovadas de gestão, liderança e inovação com os melhores especialistas do mercado.
                        </p>
                        
                        <!-- Campo de Busca -->
                        <div class="hero-search-box" data-aos="fade-right" data-aos-delay="300">
                            <form class="search-form" action="<?php echo esc_url(home_url('/cursos')); ?>" method="get">
                                <input 
                                    type="search" 
                                    name="s" 
                                    class="search-input" 
                                    placeholder="Buscar cursos, instrutores, categorias..."
                                    aria-label="Buscar cursos"
                                >
                                <button type="submit" class="search-submit" aria-label="Pesquisar">
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Lado Direito - Imagem -->
                    <div class="hero-content-right">
                        <div class="hero-image-wrapper">
                            <img 
                                src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/hero-slide-1.jpg" 
                                alt="Transforme sua carreira"
                                class="hero-image"
                                loading="eager"
                            >
                            <div class="hero-image-overlay"></div>
                        </div>
                    </div>
                    
                </div>
                
                <!-- Botões CTA (50/50 no fundo) -->
                <div class="hero-cta-buttons">
                    <a href="<?php echo esc_url(home_url('/cursos')); ?>" class="btn-cta btn-dark">
                        <i class="fas fa-graduation-cap"></i>
                        <span>Explorar Cursos</span>
                    </a>
                    <a href="#video-modal" class="btn-cta btn-gradient" data-video-id="dQw4w9WgXcQ">
                        <i class="fas fa-play-circle"></i>
                        <span>Assista o Vídeo</span>
                    </a>
                </div>
            </div>
            
            <!-- ===== SLIDE 2 ===== -->
            <div class="carousel-item" data-bs-interval="6000">
                <div class="hero-grid-container">
                    
                    <!-- Lado Esquerdo - Conteúdo -->
                    <div class="hero-content-left">
                        <span class="hero-badge" data-aos="fade-right">⭐ Destaque</span>
                        
                        <h1 class="hero-title" data-aos="fade-right" data-aos-delay="100">
                            <span class="highlight-green">Aprenda Com</span>
                            <span class="highlight-blue">Os Melhores</span>
                            <span>Profissionais</span>
                        </h1>
                        
                        <p class="hero-description" data-aos="fade-right" data-aos-delay="200">
                            Instrutores certificados com experiência comprovada no mercado. Metodologia prática focada em resultados reais para sua carreira profissional.
                        </p>
                        
                        <!-- Campo de Busca -->
                        <div class="hero-search-box" data-aos="fade-right" data-aos-delay="300">
                            <form class="search-form" action="<?php echo esc_url(home_url('/cursos')); ?>" method="get">
                                <input 
                                    type="search" 
                                    name="s" 
                                    class="search-input" 
                                    placeholder="Buscar cursos, instrutores, categorias..."
                                    aria-label="Buscar cursos"
                                >
                                <button type="submit" class="search-submit" aria-label="Pesquisar">
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Lado Direito - Imagem -->
                    <div class="hero-content-right">
                        <div class="hero-image-wrapper">
                            <img 
                                src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/hero-slide-2.jpg" 
                                alt="Aprenda com os melhores"
                                class="hero-image"
                                loading="lazy"
                            >
                            <div class="hero-image-overlay"></div>
                        </div>
                    </div>
                    
                </div>
                
                <!-- Botões CTA -->
                <div class="hero-cta-buttons">
                    <a href="<?php echo esc_url(home_url('/sobre')); ?>" class="btn-cta btn-dark">
                        <i class="fas fa-users"></i>
                        <span>Nossos Instrutores</span>
                    </a>
                    <a href="<?php echo esc_url(home_url('/contato')); ?>" class="btn-cta btn-gradient">
                        <i class="fas fa-comments"></i>
                        <span>Fale Conosco</span>
                    </a>
                </div>
            </div>
            
            <!-- ===== SLIDE 3 ===== -->
            <div class="carousel-item" data-bs-interval="6000">
                <div class="hero-grid-container">
                    
                    <!-- Lado Esquerdo - Conteúdo -->
                    <div class="hero-content-left">
                        <span class="hero-badge" data-aos="fade-right">🚀 Impulsione</span>
                        
                        <h1 class="hero-title" data-aos="fade-right" data-aos-delay="100">
                            <span class="highlight-yellow">Certificados</span>
                            <span class="highlight-green">Reconhecidos</span>
                            <span>No Mercado</span>
                        </h1>
                        
                        <p class="hero-description" data-aos="fade-right" data-aos-delay="200">
                            Certificações validadas que agregam valor ao seu currículo. Destaque-se no mercado com conhecimento prático e reconhecimento profissional.
                        </p>
                        
                        <!-- Campo de Busca -->
                        <div class="hero-search-box" data-aos="fade-right" data-aos-delay="300">
                            <form class="search-form" action="<?php echo esc_url(home_url('/cursos')); ?>" method="get">
                                <input 
                                    type="search" 
                                    name="s" 
                                    class="search-input" 
                                    placeholder="Buscar cursos, instrutores, categorias..."
                                    aria-label="Buscar cursos"
                                >
                                <button type="submit" class="search-submit" aria-label="Pesquisar">
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Lado Direito - Imagem -->
                    <div class="hero-content-right">
                        <div class="hero-image-wrapper">
                            <img 
                                src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/hero-slide-3.jpg" 
                                alt="Certificados reconhecidos"
                                class="hero-image"
                                loading="lazy"
                            >
                            <div class="hero-image-overlay"></div>
                        </div>
                    </div>
                    
                </div>
                
                <!-- Botões CTA -->
                <div class="hero-cta-buttons">
                    <a href="<?php echo esc_url(home_url('/planos')); ?>" class="btn-cta btn-dark">
                        <i class="fas fa-trophy"></i>
                        <span>Ver Planos</span>
                    </a>
                    <a href="<?php echo esc_url(home_url('/cadastro')); ?>" class="btn-cta btn-gradient">
                        <i class="fas fa-rocket"></i>
                        <span>Começar Agora</span>
                    </a>
                </div>
            </div>
            
        </div>
        
        <!-- Controles de Navegação -->
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Próximo</span>
        </button>
        
    </div>
    
</section>

<!-- ============================================
     MODAL DE VÍDEO
     ============================================ -->
<div id="video-modal" class="video-modal">
    <div class="video-modal-overlay"></div>
    <div class="video-modal-content">
        <button class="video-modal-close" aria-label="Fechar vídeo">
            <i class="fas fa-times"></i>
        </button>
        <div class="video-wrapper">
            <iframe 
                id="video-iframe" 
                src="" 
                frameborder="0" 
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                allowfullscreen
            ></iframe>
        </div>
    </div>
</div>

<style>
/* Modal de Vídeo */
.video-modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 9999;
}

.video-modal.active {
    display: block;
}

.video-modal-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.95);
    backdrop-filter: blur(12px);
}

.video-modal-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 90%;
    max-width: 1024px;
    z-index: 10;
}

.video-modal-close {
    position: absolute;
    top: -50px;
    right: 0;
    width: 48px;
    height: 48px;
    background: #FFFFFF;
    border: none;
    border-radius: 50%;
    color: #1A1A1A;
    font-size: 24px;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
}

.video-modal-close:hover {
    background: #0A3BE8;
    color: #FFFFFF;
    transform: rotate(90deg) scale(1.1);
}

.video-wrapper {
    position: relative;
    padding-bottom: 56.25%;
    height: 0;
    overflow: hidden;
    border-radius: 12px;
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.3);
}

.video-wrapper iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: none;
}

/* Animation Shake */
@keyframes shake {
    0%, 100% { transform: translateX(0); }
    10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
    20%, 40%, 60%, 80% { transform: translateX(5px); }
}

.shake {
    animation: shake 0.5s;
}
</style>
