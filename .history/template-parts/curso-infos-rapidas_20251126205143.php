<?php
/**
 * Template Part: Curso Informações Rápidas
 * Versão: 2.0 (corrigida - ACF validado)
 * 
 * @package Camisa10
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

if (!is_singular('curso')) {
    return;
}

$curso_id = get_the_ID();

// ACF Fields com validação
$carga_horaria = camisa10_sanitize_text('curso_carga_horaria', $curso_id);
$certificado = camisa10_get_field('curso_certificado', $curso_id, false); // Boolean
$material_incluso = camisa10_get_field('curso_material_incluso', $curso_id, false); // Boolean
$suporte = camisa10_sanitize_text('curso_suporte', $curso_id);
$vagas = camisa10_sanitize_text('curso_vagas', $curso_id);
$idioma = camisa10_sanitize_text('curso_idioma', $curso_id);
$instrutor_nome = camisa10_sanitize_text('curso_instrutor_nome', $curso_id);
$instrutor_foto = camisa10_get_image('curso_instrutor_foto', $curso_id, 'thumbnail');

// Defaults
if (empty($idioma)) {
    $idioma = 'Português';
}

// Se não tiver nenhuma info, não exibir seção
$has_info = !empty($carga_horaria) || $certificado || $material_incluso || 
             !empty($suporte) || !empty($vagas) || !empty($instrutor_nome);

if (!$has_info) {
    return;
}
?>

<section class="curso-infos-rapidas" id="curso-infos">
    <div class="container">
        
        <div class="infos-grid">

            <!-- Carga Horária -->
            <?php if (!empty($carga_horaria)) : ?>
            <div class="info-card">
                <div class="info-card__icon">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        ircle cx="20" cy="20" r="18" stroke="var(--color-azul)" stroke-width="2"/>
                        <path d="M20 10V20L26 26" stroke="var(--color-azul)" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
                <div class="info-card__content">
                    <h3 class="info-card__title">Carga Horária</h3>
                    <p class="info-card__value"><?php echo esc_html($carga_horaria); ?></p>
                </div>
            </div>
            <?php endif; ?>

            <!-- Certificado -->
            <?php if ($certificado) : ?>
            <div class="info-card">
                <div class="info-card__icon">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="8" y="10" width="24" height="20" stroke="var(--color-verde)" stroke-width="2"/>
                        <path d="M14 20L18 24L26 16" stroke="var(--color-verde)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="info-card__content">
                    <h3 class="info-card__title">Certificado</h3>
                    <p class="info-card__value">Incluso</p>
                </div>
            </div>
            <?php endif; ?>

            <!-- Material Incluso -->
            <?php if ($material_incluso) : ?>
            <div class="info-card">
                <div class="info-card__icon">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 8H28V32H12V8Z" stroke="var(--color-amarelo)" stroke-width="2"/>
                        <path d="M16 16H24M16 20H24M16 24H20" stroke="var(--color-amarelo)" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
                <div class="info-card__content">
                    <h3 class="info-card__title">Material</h3>
                    <p class="info-card__value">Incluso</p>
                </div>
            </div>
            <?php endif; ?>

            <!-- Suporte -->
            <?php if (!empty($suporte)) : ?>
            <div class="info-card">
                <div class="info-card__icon">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 32C26.6274 32 32 26.6274 32 20C32 13.3726 26.6274 8 20 8C13.3726 8 8 13.3726 8 20C8 22.5 8.7 24.8 9.9 26.7L8 32L13.3 30.1C15.2 31.3 17.5 32 20 32Z" stroke="var(--color-azul)" stroke-width="2"/>
                    </svg>
                </div>
                <div class="info-card__content">
                    <h3 class="info-card__title">Suporte</h3>
                    <p class="info-card__value"><?php echo esc_html($suporte); ?></p>
                </div>
            </div>
            <?php endif; ?>

            <!-- Vagas -->
            <?php if (!empty($vagas)) : ?>
            <div class="info-card">
                <div class="info-card__icon">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        ircle cx="15" cy="12" r="4" stroke="var(--color-verde)" stroke-width="2"/>
                        ircle cx="25" cy="12" r="4" stroke="var(--color-verde)" stroke-width="2"/>
                        <path d="M10 28C10 24 12.5 20 15 20C17.5 20 20 24 20 28" stroke="var(--color-verde)" stroke-width="2"/>
                        <path d="M20 28C20 24 22.5 20 25 20C27.5 20 30 24 30 28" stroke="var(--color-verde)" stroke-width="2"/>
                    </svg>
                </div>
                <div class="info-card__content">
                    <h3 class="info-card__title">Vagas</h3>
                    <p class="info-card__value"><?php echo esc_html($vagas); ?></p>
                </div>
            </div>
            <?php endif; ?>

            <!-- Idioma -->
            <div class="info-card">
                <div class="info-card__icon">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        ircle cx="20" cy="20" r="12" stroke="var(--color-amarelo)" stroke-width="2"/>
                        <path d="M8 20H32M20 8C20 8 24 13 24 20C24 27 20 32 20 32M20 8C20 8 16 13 16 20C16 27 20 32 20 32" stroke="var(--color-amarelo)" stroke-width="2"/>
                    </svg>
                </div>
                <div class="info-card__content">
                    <h3 class="info-card__title">Idioma</h3>
                    <p class="info-card__value"><?php echo esc_html($idioma); ?></p>
                </div>
            </div>

        </div>

        <!-- Instrutor (se existir) -->
        <?php if (!empty($instrutor_nome)) : ?>
        <div class="curso-instrutor">
            <div class="instrutor-card">
                
                <?php if ($instrutor_foto) : ?>
                <div class="instrutor-card__foto">
                    <img 
                        src="<?php echo esc_url($instrutor_foto['url']); ?>" 
                        alt="<?php echo esc_attr($instrutor_foto['alt']); ?>"
                        width="80"
                        height="80"
                        loading="lazy"
                    >
                </div>
                <?php endif; ?>

                <div class="instrutor-card__info">
                    <h3 class="instrutor-card__label">Instrutor</h3>
                    <p class="instrutor-card__nome"><?php echo esc_html($instrutor_nome); ?></p>
                    
                    <?php 
                    $instrutor_bio = camisa10_sanitize_text('curso_instrutor_bio', $curso_id);
                    if (!empty($instrutor_bio)) : 
                    ?>
                    <p class="instrutor-card__bio"><?php echo esc_html($instrutor_bio); ?></p>
                    <?php endif; ?>
                </div>

            </div>
        </div>
        <?php endif; ?>

    </div>
</section>
