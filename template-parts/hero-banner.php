<?php
/**
 * Hero Banner / Slider Section
 * Camisa 10 - Plataforma de Cursos
 * 
 * Seção de banner principal com slider rotativo
 * Localização: Logo após o header.php
 */
?>

<section class="hero-banner-section">
    <div class="hero-slider-wrapper">
        
        <!-- Swiper Container -->
        <div class="swiper hero-swiper">
            <div class="swiper-wrapper">
                
                <!-- SLIDE 1 -->
                <div class="swiper-slide hero-slide">
                    <div class="hero-grid-container">
                        
                        <!-- LADO ESQUERDO: Conteúdo -->
                        <div class="hero-content-left">
                            
                            <!-- Badge Pequeno -->
                            <span class="hero-badge" data-aos="fade-right" data-aos-delay="100">
                                Sessões 100% Práticas
                            </span>
                            
                            <!-- Título Principal -->
                            <h1 class="hero-title" data-aos="fade-right" data-aos-delay="200">
                                Certificado <span class="highlight-yellow">Curso</span>
                            </h1>
                            
                            <!-- Descrição -->
                            <p class="hero-description" data-aos="fade-right" data-aos-delay="300">
                                Amet mauris comodo quis imperdiet massa tincidunt nunc pulvinar sapien. 
                                Egestas fringilla phasellus faucibus scelerisque eleifend donec pretium vulputate sapien.
                            </p>
                            
                            <!-- Campo de Busca -->
                            <div class="hero-search-box" data-aos="fade-right" data-aos-delay="400">
                                <form action="<?php echo home_url('/cursos'); ?>" method="get" class="search-form">
                                    <input 
                                        type="text" 
                                        name="s" 
                                        placeholder='Exemplo: "Química Geral"' 
                                        class="search-input"
                                        autocomplete="off"
                                    >
                                    <button type="submit" class="search-submit" aria-label="Buscar curso">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </form>
                            </div>
                            
                        </div>
                        
                        <!-- LADO DIREITO: Imagem -->
                        <div class="hero-content-right" data-aos="fade-left" data-aos-delay="200">
                            <div class="hero-image-wrapper">
                                <img 
                                    src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/hero-slide-1.jpg" 
                                    alt="Certificado Curso Camisa 10" 
                                    class="hero-image"
                                    loading="lazy"
                                >
                                <div class="hero-image-overlay"></div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
                <!-- SLIDE 2 -->
                <div class="swiper-slide hero-slide">
                    <div class="hero-grid-container">
                        
                        <!-- LADO ESQUERDO: Conteúdo -->
                        <div class="hero-content-left">
                            
                            <span class="hero-badge" data-aos="fade-right" data-aos-delay="100">
                                Aprenda com Especialistas
                            </span>
                            
                            <h1 class="hero-title" data-aos="fade-right" data-aos-delay="200">
                                Seja o <span class="highlight-blue">Camisa 10</span>
                            </h1>
                            
                            <p class="hero-description" data-aos="fade-right" data-aos-delay="300">
                                Transforme sua carreira com cursos de alta performance. 
                                Capacitação profissional com estratégia, liderança e excelência.
                            </p>
                            
                            <div class="hero-search-box" data-aos="fade-right" data-aos-delay="400">
                                <form action="<?php echo home_url('/cursos'); ?>" method="get" class="search-form">
                                    <input 
                                        type="text" 
                                        name="s" 
                                        placeholder='Exemplo: "Liderança Estratégica"' 
                                        class="search-input"
                                        autocomplete="off"
                                    >
                                    <button type="submit" class="search-submit" aria-label="Buscar curso">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </form>
                            </div>
                            
                        </div>
                        
                        <div class="hero-content-right" data-aos="fade-left" data-aos-delay="200">
                            <div class="hero-image-wrapper">
                                <img 
                                    src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/hero-slide-2.jpg" 
                                    alt="Liderança Estratégica Camisa 10" 
                                    class="hero-image"
                                    loading="lazy"
                                >
                                <div class="hero-image-overlay"></div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
                <!-- SLIDE 3 -->
                <div class="swiper-slide hero-slide">
                    <div class="hero-grid-container">
                        
                        <div class="hero-content-left">
                            
                            <span class="hero-badge" data-aos="fade-right" data-aos-delay="100">
                                Alta Performance
                            </span>
                            
                            <h1 class="hero-title" data-aos="fade-right" data-aos-delay="200">
                                Domine o <span class="highlight-green">Mercado</span>
                            </h1>
                            
                            <p class="hero-description" data-aos="fade-right" data-aos-delay="300">
                                Aprenda estratégias comprovadas de gestão, liderança e inovação. 
                                Destaque-se no mercado com conhecimento de excelência.
                            </p>
                            
                            <div class="hero-search-box" data-aos="fade-right" data-aos-delay="400">
                                <form action="<?php echo home_url('/cursos'); ?>" method="get" class="search-form">
                                    <input 
                                        type="text" 
                                        name="s" 
                                        placeholder='Exemplo: "Gestão Estratégica"' 
                                        class="search-input"
                                        autocomplete="off"
                                    >
                                    <button type="submit" class="search-submit" aria-label="Buscar curso">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </form>
                            </div>
                            
                        </div>
                        
                        <div class="hero-content-right" data-aos="fade-left" data-aos-delay="200">
                            <div class="hero-image-wrapper">
                                <img 
                                    src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/hero-slide-3.jpg" 
                                    alt="Gestão Estratégica Camisa 10" 
                                    class="hero-image"
                                    loading="lazy"
                                >
                                <div class="hero-image-overlay"></div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
            </div>
            <!-- FIM swiper-wrapper -->
            
            <!-- ========================================
                 NAVEGAÇÃO E PAGINAÇÃO
                 Posicionados FORA do swiper-wrapper
                 mas DENTRO do swiper container
            ========================================= -->
            
            <!-- Botões CTA (50/50) - No fundo do hero -->
            <div class="hero-cta-buttons" data-aos="fade-up" data-aos-delay="500">
                <a href="<?php echo home_url('/cursos'); ?>" class="btn-cta btn-dark">
                    <i class="fas fa-th-large"></i>
                    Explore Todos os Cursos
                </a>
                <a href="#video-modal" class="btn-cta btn-gradient" data-video-id="dQw4w9WgXcQ">
                    <i class="fas fa-play"></i>
                    Nosso Vídeo de 3 Minutos
                </a>
            </div>
            
            <!-- Navegação: Setas (Canto esquerdo da imagem) -->
            <div class="hero-slider-navigation" id="hero-navigation">
                <button class="hero-nav-btn hero-prev swiper-button-prev" aria-label="Slide Anterior">
                    <i class="fas fa-chevron-right"></i>
                </button>
                <button class="hero-nav-btn hero-next swiper-button-next" aria-label="Próximo Slide">
                    <i class="fas fa-chevron-left"></i>
                </button>
            </div>
            
            <!-- Paginação (Canto direito da imagem) -->
            <div class="hero-pagination swiper-pagination"></div>
            
        </div>
        <!-- FIM swiper container -->
        
    </div>
    <!-- FIM hero-slider-wrapper -->
    
</section>
<!-- FIM hero-banner-section -->


<!-- ========================================
     MODAL DE VÍDEO
     Componente separado
========================================= -->
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
                allowfullscreen>
            </iframe>
        </div>
    </div>
</div>
