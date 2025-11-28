<?php
/**
 * Template Part: Hero Banner
 * Layout OneKorse: 50% Texto com Fundo Colorido | 50% Imagem
 * @package Camisa10
 * @version 5.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

<!-- Hero Banner - OneKorse Split Layout -->
<section class="hero-section">
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
        
        <!-- Carousel Inner -->
        <div class="carousel-inner">
            
            <!-- Slide 1 -->
            <div class="carousel-item active">
                <div class="hero-split-container">
                    
                    <!-- Lado Esquerdo - Texto com Fundo Colorido -->
                    <div class="hero-left-panel">
                        <div class="hero-content-wrapper">
                            <span class="hero-badge">ESCOLA DE FOTOGRAFIA</span>
                            
                            <h1 class="hero-title">
                                Inscreva-se para
                                <span class="hero-highlight">SeuCurso</span>
                            </h1>
                            
                            <p class="hero-description">
                                Egestas fringilla phasellus faucibus scelerisque eleifend donec pretium vulputate sapien. Amet mauris comodo quis imperdiet massa tincidunt nunc pulvinar sapien.
                            </p>
                            
                            <!-- Campo de Busca -->
                            <div class="hero-search-wrapper">
                                <form class="hero-search-form" action="<?php echo esc_url(home_url('/cursos')); ?>" method="get" role="search">
                                    <input 
                                        type="search" 
                                        name="s" 
                                        class="hero-search-input" 
                                        placeholder="Exemplo: 'Química Geral'"
                                        aria-label="Buscar cursos"
                                    >
                                    <button type="submit" class="hero-search-btn" aria-label="Pesquisar">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        
                        <!-- Botões CTA no Rodapé -->
                        <div class="hero-footer-buttons">
                            <a href="<?php echo esc_url(home_url('/cursos')); ?>" class="hero-footer-btn hero-btn-dark">
                                EXPLORE TODOS OS CURSOS
                            </a>
                            <a href="#video" class="hero-footer-btn hero-btn-light">
                                NOSSO VÍDEO DE 3 MINUTOS
                            </a>
                        </div>
                    </div>
                    
                    <!-- Lado Direito - Imagem -->
                    <div class="hero-right-panel">
                        <img 
                            src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/hero-slide-1.jpg" 
                            alt="Slide 1" 
                            class="hero-image"
                        >
                    </div>
                    
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="carousel-item">
                <div class="hero-split-container">
                    
                    <div class="hero-left-panel">
                        <div class="hero-content-wrapper">
                            <span class="hero-badge">APRENDA COM OS MELHORES</span>
                            
                            <h1 class="hero-title">
                                Transforme Sua
                                <span class="hero-highlight">Carreira</span>
                            </h1>
                            
                            <p class="hero-description">
                                Instrutores certificados com experiência comprovada no mercado. Metodologia prática focada em resultados reais para sua carreira profissional.
                            </p>
                            
                            <div class="hero-search-wrapper">
                                <form class="hero-search-form" action="<?php echo esc_url(home_url('/cursos')); ?>" method="get">
                                    <input 
                                        type="search" 
                                        name="s" 
                                        class="hero-search-input" 
                                        placeholder="Exemplo: 'Liderança'"
                                        aria-label="Buscar cursos"
                                    >
                                    <button type="submit" class="hero-search-btn">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        
                        <div class="hero-footer-buttons">
                            <a href="<?php echo esc_url(home_url('/instrutores')); ?>" class="hero-footer-btn hero-btn-dark">
                                NOSSOS INSTRUTORES
                            </a>
                            <a href="<?php echo esc_url(home_url('/sobre')); ?>" class="hero-footer-btn hero-btn-light">
                                SAIBA MAIS
                            </a>
                        </div>
                    </div>
                    
                    <div class="hero-right-panel">
                        <img 
                            src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/hero-slide-2.jpg" 
                            alt="Slide 2" 
                            class="hero-image"
                        >
                    </div>
                    
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="carousel-item">
                <div class="hero-split-container">
                    
                    <div class="hero-left-panel">
                        <div class="hero-content-wrapper">
                            <span class="hero-badge">CERTIFICAÇÃO RECONHECIDA</span>
                            
                            <h1 class="hero-title">
                                Destaque-se no
                                <span class="hero-highlight">Mercado</span>
                            </h1>
                            
                            <p class="hero-description">
                                Certificados validados que agregam valor ao seu currículo. Conquiste reconhecimento profissional com conhecimento prático e aplicável.
                            </p>
                            
                            <div class="hero-search-wrapper">
                                <form class="hero-search-form" action="<?php echo esc_url(home_url('/cursos')); ?>" method="get">
                                    <input 
                                        type="search" 
                                        name="s" 
                                        class="hero-search-input" 
                                        placeholder="Exemplo: 'Gestão'"
                                        aria-label="Buscar cursos"
                                    >
                                    <button type="submit" class="hero-search-btn">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        
                        <div class="hero-footer-buttons">
                            <a href="<?php echo esc_url(home_url('/planos')); ?>" class="hero-footer-btn hero-btn-dark">
                                VER PLANOS
                            </a>
                            <a href="<?php echo esc_url(home_url('/cadastro')); ?>" class="hero-footer-btn hero-btn-light">
                                COMEÇAR AGORA
                            </a>
                        </div>
                    </div>
                    
                    <div class="hero-right-panel">
                        <img 
                            src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/hero-slide-3.jpg" 
                            alt="Slide 3" 
                            class="hero-image"
                        >
                    </div>
                    
                </div>
            </div>

        </div>

        <!-- Controles de Navegação (Setas) -->
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <i class="fas fa-chevron-left"></i>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <i class="fas fa-chevron-right"></i>
            <span class="visually-hidden">Próximo</span>
        </button>

    </div>
</section>
