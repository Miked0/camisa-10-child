<?php
/**
 * Template Part: Hero Banner
 * Versão: 2.0 (corrigida - ACF validado)
 * 
 * @package Camisa10
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// ACF Repeater - Slides do Hero Banner
$slides = camisa10_get_field('hero_banner_slides');

// Se não tiver slides, não exibir
if (empty($slides) || !is_array($slides)) {
    return;
}

// Configurações do banner
$autoplay = camisa10_get_field('hero_banner_autoplay', false, true);
$autoplay_speed = camisa10_get_field('hero_banner_autoplay_speed', false, 5000);
?>

<section class="hero-banner-section">
    <div class="hero-banner" 
         data-autoplay="<?php echo $autoplay ? 'true' : 'false'; ?>"
         data-autoplay-speed="<?php echo esc_attr($autoplay_speed); ?>"
         tabindex="0"
         role="region"
         aria-label="Banner principal"
    >
        
        <!-- Slides Container -->
        <div class="hero-slides">
            
            <?php foreach ($slides as $index => $slide) : 
                $slide_numero = $index + 1;
                
                // Dados do slide com validação
                $titulo = isset($slide['titulo']) ? esc_html($slide['titulo']) : '';
                $descricao = isset($slide['descricao']) ? esc_html($slide['descricao']) : '';
                $badge = isset($slide['badge']) ? esc_html($slide['badge']) : '';
                
                // Imagem de fundo
                $imagem = isset($slide['imagem']) ? $slide['imagem'] : null;
                $imagem_url = '';
                $imagem_alt = '';
                
                if (is_array($imagem) && isset($imagem['url'])) {
                    $imagem_url = esc_url($imagem['url']);
                    $imagem_alt = isset($imagem['alt']) ? esc_attr($imagem['alt']) : $titulo;
                } elseif (is_numeric($imagem)) {
                    $imagem_data = wp_get_attachment_image_src($imagem, 'curso-hero');
                    $imagem_url = $imagem_data ? esc_url($imagem_data[0]) : '';
                    $imagem_alt = get_post_meta($imagem, '_wp_attachment_image_alt', true) ?: $titulo;
                }
                
                // Fallback para imagem padrão
                if (empty($imagem_url)) {
                    $imagem_url = get_stylesheet_directory_uri() . '/assets/images/default-hero.jpg';
                }
                
                // CTAs (Primary e Secondary)
                $cta_primary_texto = isset($slide['cta_primary_texto']) ? esc_html($slide['cta_primary_texto']) : '';
                $cta_primary_url = isset($slide['cta_primary_url']) ? esc_url($slide['cta_primary_url']) : '';
                $cta_secondary_texto = isset($slide['cta_secondary_texto']) ? esc_html($slide['cta_secondary_texto']) : '';
                $cta_secondary_url = isset($slide['cta_secondary_url']) ? esc_url($slide['cta_secondary_url']) : '';
                
                $is_active = $index === 0 ? 'is-active' : '';
            ?>

            <div class="hero-slide <?php echo $is_active; ?>" 
                 data-slide="<?php echo esc_attr($slide_numero); ?>"
                 aria-hidden="<?php echo $index === 0 ? 'false' : 'true'; ?>"
            >
                
                <!-- Background Image -->
                <div class="hero-slide__background">
                    <?php if ($index < 2) : // Carregar primeiras 2 imagens imediatamente ?>
                    <img 
                        src="<?php echo $imagem_url; ?>" 
                        alt="<?php echo $imagem_alt; ?>"
                        loading="eager"
                    >
                    <?php else : // Lazy load demais ?>
                    <img 
                        data-src="<?php echo $imagem_url; ?>" 
                        alt="<?php echo $imagem_alt; ?>"
                        loading="lazy"
                    >
                    <?php endif; ?>
                </div>

                <!-- Overlay -->
                <div class="hero-slide__overlay"></div>

                <!-- Content -->
                <div class="hero-slide__content">
                    
                    <?php if (!empty($badge)) : ?>
                    <div class="hero-slide__badge">
                        <span><?php echo $badge; ?></span>
                    </div>
                    <?php endif; ?>

                    <?php if (!empty($titulo)) : ?>
                    <h1 class="hero-slide__title"><?php echo $titulo; ?></h1>
                    <?php endif; ?>

                    <?php if (!empty($descricao)) : ?>
                    <p class="hero-slide__description"><?php echo $descricao; ?></p>
                    <?php endif; ?>

                    <?php if (!empty($cta_primary_texto) || !empty($cta_secondary_texto)) : ?>
                    <div class="hero-slide__cta">
                        
                        <?php if (!empty($cta_primary_texto) && !empty($cta_primary_url)) : ?>
                        <a href="<?php echo $cta_primary_url; ?>" class="btn btn--primary btn--lg">
                            <?php echo $cta_primary_texto; ?>
                            <svg class="btn-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 10H15M15 10L11 6M15 10L11 14" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                        <?php endif; ?>

                        <?php if (!empty($cta_secondary_texto) && !empty($cta_secondary_url)) : ?>
                        <a href="<?php echo $cta_secondary_url; ?>" class="btn btn--secondary btn--lg">
                            <?php echo $cta_secondary_texto; ?>
                        </a>
                        <?php endif; ?>

                    </div>
                    <?php endif; ?>

                </div>

            </div>

            <?php endforeach; ?>

        </div>

        <?php if (count($slides) > 1) : ?>
        
        <!-- Navigation (Prev/Next) -->
        <div class="hero-navigation">
            <button class="hero-prev" aria-label="Slide anterior">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
            <button class="hero-next" aria-label="Próximo slide">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>

        <!-- Dots Indicator -->
        <div class="hero-dots" role="tablist" aria-label="Indicadores de slides">
            <?php foreach ($slides as $index => $slide) : ?>
            <button 
                class="dot <?php echo $index === 0 ? 'is-active' : ''; ?>" 
                data-slide="<?php echo esc_attr($index + 1); ?>"
                role="tab"
                aria-label="Ir para slide <?php echo esc_attr($index + 1); ?>"
                aria-selected="<?php echo $index === 0 ? 'true' : 'false'; ?>"
            ></button>
            <?php endforeach; ?>
        </div>

        <!-- Play/Pause Button -->
        <?php if ($autoplay) : ?>
        <button class="hero-play-pause" aria-label="Pausar/Reproduzir slideshow">
            <svg class="pause-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="6" y="4" width="2" height="12" fill="currentColor"/>
                <rect x="12" y="4" width="2" height="12" fill="currentColor"/>
            </svg>
            <svg class="play-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M6 4L14 10L6 16V4Z" fill="currentColor"/>
            </svg>
        </button>
        <?php endif; ?>

        <?php endif; ?>

    </div>
</section>
