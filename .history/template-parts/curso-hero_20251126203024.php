<?php
/**
 * Hero Card - Curso Individual
 * Layout: 30% Título | 70% Imagem em destaque
 * 
 * @package Camisa10_Child
 * @version 1.0.2
 * 
 * CORREÇÕES APLICADAS:
 * - Validação tipo-segura para ACF fields
 * - Prevenção de "Illegal offset type" error
 * - Sanitização robusta de valores
 * - Schema.org para SEO
 */

// Segurança
if (!defined('ABSPATH')) {
    exit;
}

// Dados do curso
$curso_id = get_the_ID();
$titulo = get_the_title();
$categoria = get_the_terms($curso_id, 'category');
$categoria_nome = !empty($categoria) && !is_wp_error($categoria) ? esc_html($categoria[0]->name) : '';

// ============================================
// VALIDAÇÃO TIPO-SEGURA DE CAMPOS ACF
// ============================================

// Nível
$nivel_raw = function_exists('get_field') ? get_field('curso_nivel') : get_post_meta($curso_id, 'curso_nivel', true);
if (is_array($nivel_raw)) {
    $nivel = isset($nivel_raw[0]) ? trim((string)$nivel_raw[0]) : 'Intermediário';
} else {
    $nivel = $nivel_raw ? trim((string)$nivel_raw) : 'Intermediário';
}
$niveis_validos = ['Iniciante', 'Intermediário', 'Avançado'];
if (!in_array($nivel, $niveis_validos, true)) {
    $nivel = 'Intermediário';
}

// Rating
$rating_raw = function_exists('get_field') ? get_field('curso_rating') : get_post_meta($curso_id, 'curso_rating', true);
$rating = floatval($rating_raw) ?: 4.5;
if ($rating < 1 || $rating > 5) {
    $rating = 4.5;
}

// Total Alunos
$total_alunos_raw = function_exists('get_field') ? get_field('curso_total_alunos') : get_post_meta($curso_id, 'curso_total_alunos', true);
$total_alunos = abs(intval($total_alunos_raw)) ?: 0;

// Imagem em destaque
$imagem_id = get_post_thumbnail_id($curso_id);
$imagem_url = wp_get_attachment_image_url($imagem_id, 'full');
$imagem_alt = get_post_meta($imagem_id, '_wp_attachment_image_alt', true);
$imagem_alt = $imagem_alt ?: $titulo;

if (!$imagem_url) {
    $imagem_url = get_template_directory_uri() . '/assets/images/curso-placeholder.jpg';
}

// Cores de nível
$nivel_cores = [
    'Iniciante' => ['bg' => '#02FB9A', 'text' => '#111111'],
    'Intermediário' => ['bg' => '#FAF323', 'text' => '#111111'],
    'Avançado' => ['bg' => '#0A3BE8', 'text' => '#FFFFFF']
];
$nivel_cor = isset($nivel_cores[$nivel]) ? $nivel_cores[$nivel] : $nivel_cores['Intermediário'];

// Excerpt
$excerpt = get_the_excerpt();
?>

<section class="curso-hero" aria-labelledby="curso-titulo">
    <div class="container">
        <div class="curso-hero__grid">
            
            <!-- COLUNA ESQUERDA: Título + Meta (30%) -->
            <div class="curso-hero__content">
                
                <!-- Badge de Categoria -->
                <?php if ($categoria_nome) : ?>
                <div class="curso-hero__categoria" role="text">
                    <svg class="icon-categoria" width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                        <path d="M2 4h12M2 8h12M2 12h12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    <span><?php echo $categoria_nome; ?></span>
                </div>
                <?php endif; ?>
                
                <!-- Título Principal -->
                <h1 id="curso-titulo" class="curso-hero__titulo">
                    <?php echo esc_html($titulo); ?>
                </h1>
                
                <!-- Meta Informações -->
                <div class="curso-hero__meta">
                    
                    <!-- Badge de Nível -->
                    <span 
                        class="badge-nivel" 
                        style="background-color: <?php echo esc_attr($nivel_cor['bg']); ?>; color: <?php echo esc_attr($nivel_cor['text']); ?>;"
                        role="status"
                        aria-label="Nível do curso: <?php echo esc_attr($nivel); ?>"
                    >
                        <?php echo esc_html($nivel); ?>
                    </span>
                    
                    <!-- Rating (Estrelas) -->
                    <div class="curso-rating" role="img" aria-label="Avaliação: <?php echo number_format($rating, 1, ',', '.'); ?> de 5 estrelas">
                        <?php 
                        for ($i = 1; $i <= 5; $i++) {
                            $preenchimento = 'empty';
                            
                            if ($i <= floor($rating)) {
                                $preenchimento = 'full';
                            } elseif ($i - $rating < 1 && $i - $rating > 0) {
                                $preenchimento = 'half';
                            }
                        ?>
                        <svg class="star star--<?php echo esc_attr($preenchimento); ?>" width="20" height="20" viewBox="0 0 20 20" aria-hidden="true">
                            <path d="M10 1l2.5 6.5L19 8l-5 4.5L15.5 19 10 15.5 4.5 19 6 12.5 1 8l6.5-.5z" 
                                  fill="<?php echo $preenchimento !== 'empty' ? '#FAF323' : 'none'; ?>" 
                                  stroke="#FAF323" 
                                  stroke-width="1"/>
                        </svg>
                        <?php } ?>
                        <span class="rating-numero"><?php echo number_format($rating, 1, ',', '.'); ?></span>
                    </div>
                    
                    <!-- Total de Alunos -->
                    <?php if ($total_alunos > 0) : ?>
                    <div class="curso-alunos" role="text">
                        <svg class="icon-alunos" width="18" height="18" viewBox="0 0 18 18" fill="none" aria-hidden="true">
                            <path d="M9 9c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" fill="currentColor"/>
                        </svg>
                        <span><?php echo number_format($total_alunos, 0, ',', '.'); ?> alunos</span>
                    </div>
                    <?php endif; ?>
                    
                </div>
                
                <!-- Descrição Curta -->
                <?php if ($excerpt) : ?>
                <div class="curso-hero__descricao">
                    <?php echo wp_kses_post($excerpt); ?>
                </div>
                <?php endif; ?>
                
            </div>
            
            <!-- COLUNA DIREITA: Imagem (70%) -->
            <div class="curso-hero__imagem">
                <figure class="imagem-destaque">
                    <img 
                        src="<?php echo esc_url($imagem_url); ?>" 
                        alt="<?php echo esc_attr($imagem_alt); ?>"
                        loading="eager"
                        fetchpriority="high"
                        width="1200"
                        height="675"
                    />
                    <div class="imagem-overlay" aria-hidden="true"></div>
                </figure>
            </div>
            
        </div>
    </div>
</section>

<!-- Schema.org para SEO -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Course",
  "name": "<?php echo esc_js($titulo); ?>",
  "description": "<?php echo esc_js(wp_strip_all_tags($excerpt)); ?>",
  "provider": {
    "@type": "Organization",
    "name": "Camisa 10"
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "<?php echo $rating; ?>",
    "ratingCount": "<?php echo $total_alunos; ?>"
  },
  "educationalLevel": "<?php echo esc_js($nivel); ?>"
}
</script>
