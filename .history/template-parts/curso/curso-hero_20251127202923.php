<?php
/**
 * Template Part: Hero Section do Curso
 * @package Camisa10
 * @version 8.1.0 - FULL-WIDTH LAYOUT
 * @updated 2025-11-27
 * 
 * COMPONENTES:
 * - Breadcrumb (Home > Cursos > Curso Atual)
 * - Categoria Badge
 * - Título do Curso (H1)
 * - Descrição / Excerpt
 * - Meta Info (Duração, Avaliação, Nível, Total Alunos)
 * 
 * ACF FIELDS NECESSÁRIOS:
 * - curso_nivel (select: Iniciante|Intermediário|Avançado)
 * - curso_rating (number: 0-5)
 * - curso_total_alunos (number)
 * - curso_duracao (text)
 * 
 * TAXONOMIA:
 * - course_category (categoria do curso)
 */

if (!defined('ABSPATH')) {
    exit;
}

$curso_id = get_the_ID();

// ============================================
// CATEGORIA (Taxonomy)
// ============================================
$categorias = get_the_terms($curso_id, 'course_category');
$categoria_nome = 'Curso';
$categoria_link = home_url('/cursos/');

if ($categorias && !is_wp_error($categorias)) {
    $primeira_cat = $categorias[0];
    $categoria_nome = $primeira_cat->name;
    $categoria_link = get_term_link($primeira_cat);
}

// ============================================
// CAMPOS ACF COM VALIDAÇÃO SEGURA
// ============================================
$nivel = get_acf_safe('curso_nivel', $curso_id, 'Intermediário');
$rating = get_acf_number('curso_rating', $curso_id, 4.5, 'float');
$total_alunos = get_acf_number('curso_total_alunos', $curso_id, 0, 'int');
$duracao = get_acf_safe('curso_duracao', $curso_id, '8 semanas');

// Validar nível
$niveis_validos = ['Iniciante', 'Intermediário', 'Avançado'];
if (!in_array($nivel, $niveis_validos, true)) {
    $nivel = 'Intermediário';
}

// Validar rating (0-5)
if ($rating < 0 || $rating > 5) {
    $rating = 4.5;
}

// ============================================
// IMAGEM COM FALLBACK
// ============================================
$imagem_url = get_the_post_thumbnail_url($curso_id, 'full');

if (!$imagem_url) {
    // Tentar placeholder local
    $placeholder_path = get_stylesheet_directory() . '/assets/images/curso-placeholder.jpg';
    
    if (file_exists($placeholder_path)) {
        $imagem_url = get_stylesheet_directory_uri() . '/assets/images/curso-placeholder.jpg';
    } else {
        // Fallback SVG inline (800x450)
        $imagem_url = 'data:image/svg+xml;base64,' . base64_encode('
            <svg width="800" height="450" xmlns="http://www.w3.org/2000/svg">
                <rect width="800" height="450" fill="#0A3BE8"/>
                <text x="50%" y="50%" font-family="Arial" font-size="32" fill="#FFFFFF" text-anchor="middle" dy=".3em">
                    ' . esc_attr(get_the_title()) . '
                </text>
            </svg>
        ');
    }
}

// ============================================
// CORES DE NÍVEL (Dinâmicas)
// ============================================
$nivel_cores = [
    'Iniciante' => ['bg' => '#02FB9A', 'text' => '#111111'],
    'Intermediário' => ['bg' => '#FAF323', 'text' => '#111111'],
    'Avançado' => ['bg' => '#0A3BE8', 'text' => '#FFFFFF']
];
$nivel_cor = $nivel_cores[$nivel];

// ============================================
// EXCERPT
// ============================================
$excerpt = get_the_excerpt();
if (empty($excerpt)) {
    $excerpt = wp_trim_words(get_the_content(), 30, '...');
}
?>

<!-- ============================================
     BREADCRUMB
     ============================================ -->
<nav class="curso-breadcrumb" aria-label="Breadcrumb">
    <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
    <span>/</span>
    <a href="<?php echo esc_url($categoria_link); ?>">Cursos</a>
    <span>/</span>
    <span><?php echo esc_html(wp_trim_words(get_the_title(), 5)); ?></span>
</nav>

<!-- ============================================
     CATEGORIA BADGE
     ============================================ -->
<span class="curso-categoria-badge">
    <?php echo esc_html($categoria_nome); ?>
</span>

<!-- ============================================
     TÍTULO DO CURSO (H1)
     ============================================ -->
<h1 class="curso-titulo">
    <?php the_title(); ?>
</h1>

<!-- ============================================
     DESCRIÇÃO / EXCERPT
     ============================================ -->
<?php if ($excerpt) : ?>
    <div class="curso-excerpt">
        <?php echo wp_kses_post($excerpt); ?>
    </div>
<?php endif; ?>

<!-- ============================================
     META INFO (Grid de informações)
     ============================================ -->
<div class="curso-meta-info">
    
    <!-- DURAÇÃO -->
    <?php if ($duracao) : ?>
        <div class="meta-info-item">
            <div class="meta-info-icon">
                <i class="far fa-clock"></i>
            </div>
            <div class="meta-info-text">
                <span class="meta-info-label">Duração</span>
                <span class="meta-info-value"><?php echo esc_html($duracao); ?></span>
            </div>
        </div>
    <?php endif; ?>
    
    <!-- AVALIAÇÃO (Rating com Estrelas) -->
    <?php if ($rating > 0) : ?>
        <div class="meta-info-item">
            <div class="meta-info-icon">
                <i class="fas fa-star"></i>
            </div>
            <div class="meta-info-text">
                <span class="meta-info-label">Avaliação</span>
                <div class="meta-info-value">
                    <div class="curso-rating-stars">
                        <?php
                        $estrelas_cheias = floor($rating);
                        $tem_meia = ($rating - $estrelas_cheias) >= 0.5;
                        
                        for ($i = 0; $i < 5; $i++) {
                            if ($i < $estrelas_cheias) {
                                echo '<span class="star filled">★</span>';
                            } elseif ($i == $estrelas_cheias && $tem_meia) {
                                echo '<span class="star half">★</span>';
                            } else {
                                echo '<span class="star empty">☆</span>';
                            }
                        }
                        ?>
                    </div>
                    <span style="margin-left: 8px; font-size: 14px; color: rgba(255,255,255,0.8);">
                        <?php echo number_format($rating, 1, ',', '.'); ?>/5
                    </span>
                </div>
            </div>
        </div>
    <?php endif; ?>
    
    <!-- NÍVEL (Badge com cor dinâmica) -->
    <div class="meta-info-item">
        <div class="meta-info-icon">
            <i class="fas fa-signal"></i>
        </div>
        <div class="meta-info-text">
            <span class="meta-info-label">Nível</span>
            <span class="curso-nivel-badge" style="background: <?php echo esc_attr($nivel_cor['bg']); ?>; color: <?php echo esc_attr($nivel_cor['text']); ?>;">
                <?php echo esc_html($nivel); ?>
            </span>
        </div>
    </div>
    
    <!-- TOTAL DE ALUNOS (Se > 0) -->
    <?php if ($total_alunos > 0) : ?>
        <div class="meta-info-item">
            <div class="meta-info-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="meta-info-text">
                <span class="meta-info-label">Alunos</span>
                <span class="meta-info-value">
                    <?php echo number_format($total_alunos, 0, ',', '.'); ?> alunos
                </span>
            </div>
        </div>
    <?php endif; ?>
    
</div>
