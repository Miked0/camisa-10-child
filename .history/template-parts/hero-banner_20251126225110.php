<?php
/**
 * Template Part: Hero Banner
 * Baseado na estrutura OneKorse LMS
 * @package Camisa10
 * @version 4.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

<!-- Hero Banner - OneKorse Style -->
<div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
    
    <!-- Slides -->
    <div class="carousel-inner">
        
        <!-- Slide 1 -->
        <div class="carousel-item active">
            <div class="hero-slide-content">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6 hero-text-col">
                            <div class="hero-content">
                                <span class="hero-badge">🎯 Novidade</span>
                                <h1 class="hero-title">
                                    Transforme Sua Carreira Com <span class="highlight">Excelência</span>
                                </h1>
                                <p class="hero-description">
                                    Capacitação profissional de alta performance. Aprenda estratégias comprovadas de gestão, liderança e inovação com os melhores especialistas.
                                </p>
                                <div class="hero-buttons">
                                    <a href="<?php echo esc_url(home_url('/cursos')); ?>" class="btn btn-primary btn-lg">
                                        <i class="fas fa-graduation-cap me-2"></i>Explorar Cursos
                                    </a>
                                    <a href="#" class="btn btn-outline-light btn-lg ms-3">
                                        <i class="fas fa-play-circle me-2"></i>Assista o Vídeo
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 hero-image-col">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/hero-1.jpg" alt="Hero Slide 1" class="img-fluid hero-image">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item">
            <div class="hero-slide-content">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6 hero-text-col">
                            <div class="hero-content">
                                <span class="hero-badge">⭐ Destaque</span>
                                <h1 class="hero-title">
                                    Aprenda Com Os <span class="highlight-blue">Melhores Profissionais</span>
                                </h1>
                                <p class="hero-description">
                                    Instrutores certificados com experiência comprovada no mercado. Metodologia prática focada em resultados reais para sua carreira.
                                </p>
                                <div class="hero-buttons">
                                    <a href="<?php echo esc_url(home_url('/instrutores')); ?>" class="btn btn-primary btn-lg">
                                        <i class="fas fa-users me-2"></i>Nossos Instrutores
                                    </a>
                                    <a href="<?php echo esc_url(home_url('/sobre')); ?>" class="btn btn-outline-light btn-lg ms-3">
                                        <i class="fas fa-info-circle me-2"></i>Saiba Mais
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 hero-image-col">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/hero-2.jpg" alt="Hero Slide 2" class="img-fluid hero-image">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="carousel-item">
            <div class="hero-slide-content">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6 hero-text-col">
                            <div class="hero-content">
                                <span class="hero-badge">🚀 Impulsione</span>
                                <h1 class="hero-title">
                                    Certificados <span class="highlight-green">Reconhecidos</span> No Mercado
                                </h1>
                                <p class="hero-description">
                                    Certificações validadas que agregam valor ao seu currículo. Destaque-se com conhecimento prático e reconhecimento profissional.
                                </p>
                                <div class="hero-buttons">
                                    <a href="<?php echo esc_url(home_url('/planos')); ?>" class="btn btn-primary btn-lg">
                                        <i class="fas fa-trophy me-2"></i>Ver Planos
                                    </a>
                                    <a href="<?php echo esc_url(home_url('/cadastro')); ?>" class="btn btn-outline-light btn-lg ms-3">
                                        <i class="fas fa-rocket me-2"></i>Começar Agora
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 hero-image-col">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/hero-3.jpg" alt="Hero Slide 3" class="img-fluid hero-image">
                        </div>
                    </div>
                </div>
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

    <!-- Indicadores -->
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>

</div>
