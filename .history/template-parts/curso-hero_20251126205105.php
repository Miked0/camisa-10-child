<?php
/**
 * Template Part: Curso Hero Section
 * Versão: 2.0 (corrigida - ACF validado)
 * 
 * @package Camisa10
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Validar se estamos em single-curso
if (!is_singular('curso')) {
    return;
}

// ACF Fields com validação
$curso_id = get_the_ID();

// Hero Image
$hero_image = camisa10_get_image('curso_hero_imagem', $curso_id, 'curso-hero');
$hero_image_url = $hero_image ? $hero_image['url'] : get_stylesheet_directory_uri() . '/assets/images/default-curso-hero.jpg';
$hero_image_alt = $hero_image ? $hero_image['alt'] : get_the_title();

// Informações do curso
$categoria = camisa10_sanitize_text('curso_categoria', $curso_id);
$duracao = camisa10_sanitize_text('curso_duracao', $curso_id);
$nivel = camisa10_sanitize_text('curso_nivel', $curso_id);
$modalidade = camisa10_sanitize_text('curso_modalidade', $curso_id);
$badge = camisa10_sanitize_text('curso_badge', $curso_id); // Ex: "Novo", "Popular", "Destaque"

// Call to action
$cta_texto = camisa10_sanitize_text('curso_cta_texto', $curso_id);
$cta_url = camisa10_sanitize_url('curso_cta_url', $curso_id);

// Defaults
if (empty($cta_texto)) {
    $cta_texto = 'Inscreva-se Agora';
}
if (empty($cta_url)) {
    $cta_url = '#inscricao';
}
?>

<section class="curso-hero" style="background-image: url('<?php echo esc_url($hero_image_url); ?>');">
    <!-- Overlay escuro para legibilidade -->
    <div class="curso-hero__overlay"></div>

    <div class="container">
        <div class="curso-hero__content">
            
            <!-- Breadcrumb -->
            <nav class="breadcrumb" aria-label="Breadcrumb">
                <ol class="breadcrumb__list">
                    <li class="breadcrumb__item">
                        <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                    </li>
                    <li class="breadcrumb__item">
                        <a href="<?php echo esc_url(get_post_type_archive_link('curso')); ?>">Cursos</a>
                    </li>
                    <?php if (!empty($categoria)) : ?>
                    <li class="breadcrumb__item">
                        <span><?php echo esc_html($categoria); ?></span>
                    </li>
                    <?php endif; ?>
                    <li class="breadcrumb__item breadcrumb__item--active" aria-current="page">
                        <span><?php the_title(); ?></span>
                    </li>
                </ol>
            </nav>

            <!-- Badge (se existir) -->
            <?php if (!empty($badge)) : ?>
            <div class="curso-hero__badge">
                <span class="badge badge--primary"><?php echo esc_html($badge); ?></span>
            </div>
            <?php endif; ?>

            <!-- Categoria -->
            <?php if (!empty($categoria)) : ?>
            <div class="curso-hero__categoria">
                <span class="categoria-tag"><?php echo esc_html($categoria); ?></span>
            </div>
            <?php endif; ?>

            <!-- Título -->
            <h1 class="curso-hero__title"><?php the_title(); ?></h1>

            <!-- Excerpt/Descrição curta -->
            <?php if (has_excerpt()) : ?>
            <div class="curso-hero__excerpt">
                <p><?php echo wp_kses_post(get_the_excerpt()); ?></p>
            </div>
            <?php endif; ?>

            <!-- Meta informações -->
            <div class="curso-hero__meta">
                <ul class="meta-list">
                    
                    <?php if (!empty($duracao)) : ?>
                    <li class="meta-item">
                        <svg class="meta-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 18C14.4183 18 18 14.4183 18 10C18 5.58172 14.4183 2 10 2C5.58172 2 2 5.58172 2 10C2 14.4183 5.58172 18 10 18Z" stroke="currentColor" stroke-width="2"/>
                            <path d="M10 6V10L13 13" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                        <span><?php echo esc_html($duracao); ?></span>
                    </li>
                    <?php endif; ?>

                    <?php if (!empty($nivel)) : ?>
                    <li class="meta-item">
                        <svg class="meta-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3 17L10 3L17 17H3Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span><?php echo esc_html($nivel); ?></span>
                    </li>
                    <?php endif; ?>

                    <?php if (!empty($modalidade)) : ?>
                    <li class="meta-item">
                        <svg class="meta-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="3" y="4" width="14" height="12" stroke="currentColor" stroke-width="2"/>
                            <path d="M7 1V4M13 1V4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                        <span><?php echo esc_html($modalidade); ?></span>
                    </li>
                    <?php endif; ?>

                </ul>
            </div>

            <!-- CTA Button -->
            <div class="curso-hero__cta">
                <a 
                    href="<?php echo esc_url($cta_url); ?>" 
                    class="btn btn--primary btn--lg enroll-button"
                    data-curso-id="<?php echo esc_attr($curso_id); ?>"
                    data-curso-title="<?php echo esc_attr(get_the_title()); ?>"
                >
                    <?php echo esc_html($cta_texto); ?>
                    <svg class="btn-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 10H15M15 10L11 6M15 10L11 14" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>

        </div>
    </div>

    <!-- Scroll indicator -->
    <div class="curso-hero__scroll-indicator">
        <a href="#curso-content" class="scroll-arrow" aria-label="Rolar para conteúdo">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 5V19M12 19L6 13M12 19L18 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </a>
    </div>

</section>
