<?php
/**
 * Informações Rápidas - Layout Inline Horizontal
 * Design: Ícone ao lado do texto em linha única
 * 
 * @package Camisa10_Child
 * @version 3.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

$curso_id = get_the_ID();

// Dados do curso (com validação)
$carga_horaria_raw = function_exists('get_field') ? get_field('curso_carga_horaria') : get_post_meta($curso_id, 'curso_carga_horaria', true);
$carga_horaria = trim((string)$carga_horaria_raw) ?: '40';
if (!is_numeric($carga_horaria)) {
    $carga_horaria = '40';
}

$formato_raw = function_exists('get_field') ? get_field('curso_formato') : get_post_meta($curso_id, 'curso_formato', true);
$formato = is_string($formato_raw) ? trim($formato_raw) : 'Online';
$formatos_validos = ['Online', 'Presencial', 'Híbrido'];
if (!in_array($formato, $formatos_validos, true)) {
    $formato = 'Online';
}

$proxima_turma_raw = function_exists('get_field') ? get_field('curso_proxima_turma') : get_post_meta($curso_id, 'curso_proxima_turma', true);
$proxima_turma = trim((string)$proxima_turma_raw) ?: 'Janeiro/2026';

$preco_raw = function_exists('get_field') ? get_field('curso_preco') : get_post_meta($curso_id, 'curso_preco', true);
$preco = abs(floatval($preco_raw));

$preco_promocional_raw = function_exists('get_field') ? get_field('curso_preco_promocional') : get_post_meta($curso_id, 'curso_preco_promocional', true);
$preco_promocional = abs(floatval($preco_promocional_raw));

$tem_promocao = $preco_promocional > 0 && $preco_promocional < $preco;
$preco_exibir = $tem_promocao ? $preco_promocional : $preco;
$percentual_desconto = $tem_promocao ? round((($preco - $preco_promocional) / $preco) * 100) : 0;

$link_compra = function_exists('get_field') ? get_field('curso_link_compra') : get_post_meta($curso_id, 'curso_link_compra', true);
$link_compra = $link_compra ?: '#';

function formatar_preco_brl($valor) {
    return 'R$ ' . number_format($valor, 2, ',', '.');
}
?>

<section class="curso-infos-inline" aria-label="Informações rápidas do curso">
    <div class="container">
        
        <!-- Título da Seção -->
        <h2 class="infos-titulo">Infos Rápidas</h2>
        
        <div class="infos-grid-inline">
            
            <!-- CARD 1: Carga Horária -->
            <div class="info-card-inline" data-aos="fade-up">
                <div class="card-icon-inline">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none">
                        ircle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                        <path d="M12 6v6l4 2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
                <div class="card-text-inline">
                    <span class="card-label-inline">Carga horária</span>
                    <span class="card-value-inline"><?php echo esc_html($carga_horaria); ?>h</span>
                </div>
            </div>
            
            <!-- CARD 2: Formato -->
            <div class="info-card-inline" data-aos="fade-up" data-aos-delay="100">
                <div class="card-icon-inline">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none">
                        <?php if ($formato === 'Online') : ?>
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z" fill="currentColor"/>
                        <?php elseif ($formato === 'Presencial') : ?>
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" fill="currentColor"/>
                        <?php else : ?>
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" fill="currentColor"/>
                        <?php endif; ?>
                    </svg>
                </div>
                <div class="card-text-inline">
                    <span class="card-label-inline">Formato</span>
                    <span class="card-value-inline"><?php echo esc_html($formato); ?></span>
                </div>
            </div>
            
            <!-- CARD 3: Próxima Turma -->
            <div class="info-card-inline" data-aos="fade-up" data-aos-delay="200">
                <div class="card-icon-inline">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none">
                        <rect x="3" y="4" width="18" height="18" rx="2" stroke="currentColor" stroke-width="2"/>
                        <path d="M3 9h18M9 4v2M15 4v2" stroke="currentColor" stroke-width="2"/>
                        ircle cx="12" cy="14" r="2" fill="currentColor"/>
                    </svg>
                </div>
                <div class="card-text-inline">
                    <span class="card-label-inline">Próxima turma</span>
                    <span class="card-value-inline"><?php echo esc_html($proxima_turma); ?></span>
                </div>
            </div>
            
            <!-- CARD 4: CTA Compra (DESTAQUE) -->
            <div class="info-card-inline info-card-inline--cta" data-aos="fade-up" data-aos-delay="300">
                <div class="cta-content-inline">
                    
                    <!-- Preço -->
                    <div class="preco-inline">
                        <?php if ($tem_promocao) : ?>
                            <div class="preco-stack-inline">
                                <span class="preco-de-inline">De <?php echo formatar_preco_brl($preco); ?></span>
                                <span class="preco-por-inline">Por <?php echo formatar_preco_brl($preco_promocional); ?></span>
                            </div>
                        <?php else : ?>
                            <span class="preco-unico-inline">
                                <?php echo $preco > 0 ? formatar_preco_brl($preco) : 'Gratuito'; ?>
                            </span>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Badge Desconto -->
                    <?php if ($tem_promocao) : ?>
                    <div class="badge-desconto-inline">
                        <?php echo $percentual_desconto; ?>% OFF
                    </div>
                    <?php endif; ?>
                    
                    <!-- Botões -->
                    <div class="cta-buttons-inline">
                        <a 
                            href="<?php echo esc_url($link_compra); ?>" 
                            class="btn-inline btn-inline--buy"
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            Comprar
                        </a>
                        
                        <a href="#curso-conteudo" class="btn-inline btn-inline--info">
                            Saiba Mais
                        </a>
                    </div>
                    
                </div>
            </div>
            
        </div>
    </div>
</section>
