<?php
/**
 * Template Part: Curso Conteúdo Programático
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

// ACF Repeater - Módulos do curso
$modulos = camisa10_get_field('curso_modulos', $curso_id);

// Se não tiver módulos, não exibir
if (empty($modulos) || !is_array($modulos)) {
    return;
}

// Título da seção (customizável via ACF)
$secao_titulo = camisa10_sanitize_text('curso_conteudo_titulo', $curso_id);
if (empty($secao_titulo)) {
    $secao_titulo = 'Conteúdo do Curso';
}
?>

<section class="curso-conteudo" id="curso-content">
    <div class="container">
        
        <!-- Título da seção -->
        <header class="section-header">
            <h2 class="section-title"><?php echo esc_html($secao_titulo); ?></h2>
            
            <?php 
            $secao_subtitulo = camisa10_sanitize_text('curso_conteudo_subtitulo', $curso_id);
            if (!empty($secao_subtitulo)) : 
            ?>
            <p class="section-subtitle"><?php echo esc_html($secao_subtitulo); ?></p>
            <?php endif; ?>
        </header>

        <!-- Accordion de módulos -->
        <div class="curso-accordion">
            
            <?php 
            $total_aulas = 0;
            $total_duracao = 0;
            
            foreach ($modulos as $index => $modulo) : 
                $modulo_numero = $index + 1;
                $modulo_titulo = isset($modulo['titulo']) ? esc_html($modulo['titulo']) : "Módulo $modulo_numero";
                $modulo_descricao = isset($modulo['descricao']) ? wp_kses_post($modulo['descricao']) : '';
                $modulo_aulas = isset($modulo['aulas']) ? $modulo['aulas'] : array();
                $num_aulas = is_array($modulo_aulas) ? count($modulo_aulas) : 0;
                
                $total_aulas += $num_aulas;
                
                // Calcular duração do módulo
                $modulo_duracao = 0;
                if (is_array($modulo_aulas)) {
                    foreach ($modulo_aulas as $aula) {
                        if (isset($aula['duracao_minutos'])) {
                            $modulo_duracao += intval($aula['duracao_minutos']);
                        }
                    }
                }
                $total_duracao += $modulo_duracao;
            ?>

            <div class="accordion-item" data-modulo="<?php echo esc_attr($modulo_numero); ?>">
                
                <!-- Header do accordion -->
                <button 
                    class="accordion-header" 
                    aria-expanded="false"
                    aria-controls="modulo-<?php echo esc_attr($modulo_numero); ?>"
                >
                    <div class="accordion-header__content">
                        <span class="accordion-number">Módulo <?php echo esc_html($modulo_numero); ?></span>
                        <h3 class="accordion-title"><?php echo $modulo_titulo; ?></h3>
                    </div>

                    <div class="accordion-header__meta">
                        <?php if ($num_aulas > 0) : ?>
                        <span class="meta-aulas">
                            <?php echo esc_html($num_aulas); ?> aula<?php echo $num_aulas > 1 ? 's' : ''; ?>
                        </span>
                        <?php endif; ?>

                        <?php if ($modulo_duracao > 0) : ?>
                        <span class="meta-duracao">
                            <?php echo esc_html($modulo_duracao); ?> min
                        </span>
                        <?php endif; ?>

                        <span class="accordion-icon">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 7.5L10 12.5L15 7.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                    </div>
                </button>

                <!-- Content do accordion -->
                <div 
                    class="accordion-content" 
                    id="modulo-<?php echo esc_attr($modulo_numero); ?>"
                    aria-hidden="true"
                >
                    
                    <?php if (!empty($modulo_descricao)) : ?>
                    <div class="modulo-descricao">
                        <?php echo $modulo_descricao; ?>
                    </div>
                    <?php endif; ?>

                    <?php if (is_array($modulo_aulas) && !empty($modulo_aulas)) : ?>
                    <ul class="aulas-list">
                        <?php foreach ($modulo_aulas as $aula_index => $aula) : 
                            $aula_titulo = isset($aula['titulo']) ? esc_html($aula['titulo']) : "Aula " . ($aula_index + 1);
                            $aula_duracao = isset($aula['duracao_minutos']) ? intval($aula['duracao_minutos']) : 0;
                            $aula_gratuita = isset($aula['preview_gratuito']) ? (bool)$aula['preview_gratuito'] : false;
                            $aula_video_url = isset($aula['video_url']) ? esc_url($aula['video_url']) : '';
                        ?>

                        <li class="aula-item <?php echo $aula_gratuita ? 'aula-item--gratuita' : ''; ?>">
                            <div class="aula-item__icon">
                                <?php if ($aula_gratuita && !empty($aula_video_url)) : ?>
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    ircle cx="10" cy="10" r="8" stroke="var(--color-verde)" stroke-width="2"/>
                                    <path d="M8 7L14 10L8 13V7Z" fill="var(--color-verde)"/>
                                </svg>
                                <?php else : ?>
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="5" y="3" width="10" height="14" stroke="currentColor" stroke-width="2"/>
                                    <path d="M8 8H12M8 11H12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                                <?php endif; ?>
                            </div>

                            <div class="aula-item__content">
                                <h4 class="aula-item__title"><?php echo $aula_titulo; ?></h4>
                                
                                <?php if ($aula_gratuita) : ?>
                                <span class="aula-badge aula-badge--gratuita">Preview gratuito</span>
                                <?php endif; ?>
                            </div>

                            <?php if ($aula_duracao > 0) : ?>
                            <div class="aula-item__duracao">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    ircle cx="8" cy="8" r="6" stroke="currentColor" stroke-width="1.5"/>
                                    <path d="M8 5V8L10 10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                </svg>
                                <span><?php echo esc_html($aula_duracao); ?> min</span>
                            </div>
                            <?php endif; ?>

                            <?php if ($aula_gratuita && !empty($aula_video_url)) : ?>
                            <a href="<?php echo $aula_video_url; ?>" class="aula-item__link" target="_blank" rel="noopener">
                                Assistir preview
                            </a>
                            <?php endif; ?>
                        </li>

                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>

                </div>

            </div>

            <?php endforeach; ?>

        </div>

        <!-- Resumo total -->
        <div class="curso-conteudo-summary">
            <div class="summary-card">
                <h3 class="summary-title">Resumo do Conteúdo</h3>
                <div class="summary-stats">
                    
                    <div class="summary-stat">
                        <span class="summary-stat__value"><?php echo esc_html(count($modulos)); ?></span>
                        <span class="summary-stat__label">Módulo<?php echo count($modulos) > 1 ? 's' : ''; ?></span>
                    </div>

                    <?php if ($total_aulas > 0) : ?>
                    <div class="summary-stat">
                        <span class="summary-stat__value"><?php echo esc_html($total_aulas); ?></span>
                        <span class="summary-stat__label">Aula<?php echo $total_aulas > 1 ? 's' : ''; ?></span>
                    </div>
                    <?php endif; ?>

                    <?php if ($total_duracao > 0) : ?>
                    <div class="summary-stat">
                        <span class="summary-stat__value">
                            <?php 
                            $horas = floor($total_duracao / 60);
                            $minutos = $total_duracao % 60;
                            
                            if ($horas > 0) {
                                echo esc_html($horas) . 'h';
                                if ($minutos > 0) {
                                    echo ' ' . esc_html($minutos) . 'min';
                                }
                            } else {
                                echo esc_html($minutos) . 'min';
                            }
                            ?>
                        </span>
                        <span class="summary-stat__label">Duração total</span>
                    </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>

    </div>
</section>
