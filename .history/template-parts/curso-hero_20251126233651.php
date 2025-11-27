<?php
/**
 * Template Part: Hero do Curso
 * @package Camisa10
 */

if (!defined('ABSPATH')) {
    exit;
}

$curso_id = get_the_ID();
$titulo = get_the_title();

// CATEGORIA (com safe_print)
$categorias = get_the_terms($curso_id, 'course_category');
$categoria_nome = '';
if ($categorias && !is_wp_error($categorias)) {
    $categoria_nome = esc_html($categorias[0]->name);
}

// CAMPOS ACF COM VALIDAÇÃO SEGURA
$nivel = get_acf_safe('curso_nivel', $curso_id, 'Intermediário');
$rating = get_acf_number('curso_rating', $curso_id, 4.5, 'float');
$total_alunos = get_acf_number('curso_total_alunos', $curso_id, 0, 'int');

// Validar nível
$niveis_validos = ['Iniciante', 'Intermediário', 'Avançado'];
if (!in_array($nivel, $niveis_validos, true)) {
    $nivel = 'Intermediário';
}

// Validar rating
if ($rating < 1 || $rating > 5) {
    $rating = 4.5;
}

// IMAGEM
$imagem_url = get_the_post_thumbnail_url($curso_id, 'full');
if (!$imagem_url) {
    $imagem_url = get_stylesheet_directory_uri() . '/assets/images/curso-placeholder.jpg';
}

// CORES DE NÍVEL
$nivel_cores = [
    'Iniciante' => ['bg' => '#02FB9A', 'text' => '#111111'],
    'Intermediário' => ['bg' => '#FAF323', 'text' => '#111111'],
    'Avançado' => ['bg' => '#0A3BE8', 'text' => '#FFFFFF']
];
$nivel_cor = $nivel_cores[$nivel];

$excerpt = get_the_excerpt();
?>

<section class="curso-hero-section" style="background-image: linear-gradient(135deg, rgba(10, 59, 232, 0.95) 0%, rgba(6, 31, 152, 0.95) 100%), url('<?php echo esc_url($imagem_url); ?>');">
    <div class="curso-hero-content">
        
        <!-- Breadcrumb -->
        <nav class="curso-breadcrumb">
            <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
            <span>/</span>
            <a href="<?php echo esc_url(home_url('/cursos')); ?>">Cursos</a>
            <span>/</span>
            <span><?php echo esc_html($titulo); ?></span>
        </nav>

        <?php if ($categoria_nome) : ?>
            <span class="curso-categoria-badge"><?php echo $categoria_nome; ?></span>
        <?php endif; ?>

        <h1 class="curso-titulo"><?php echo esc_html($titulo); ?></h1>

        <?php if ($excerpt) : ?>
            <p class="curso-excerpt"><?php echo esc_html($excerpt); ?></p>
        <?php endif; ?>

        <!-- Meta Info -->
        <div class="curso-meta-info">
            
            <!-- Rating -->
            <div class="meta-info-item">
                <div class="meta-info-icon">
                    <i class="fas fa-star"></i>
                </div>
                <div class="meta-info-text">
                    <span class="meta-info-label">Avaliação</span>
                    <div class="curso-rating-stars">
                        <?php
                        $estrelas_cheias = floor($rating);
                        $tem_meia = ($rating - $estrelas_cheias) >= 0.5;
                        
                        for ($i = 0; $i < 5; $i++) {
                            if ($i < $estrelas_cheias) {
                                echo '<span class="star">★</span>';
                            } elseif ($i == $estrelas_cheias && $tem_meia) {
                                echo '<span class="star">★</span>';
                            } else {
                                echo '<span class="star empty">☆</span>';
                            }
                        }
                        ?>
                        <span class="meta-info-value" style="margin-left: 8px;"><?php echo number_format($rating, 1, ',', '.'); ?></span>
                    </div>
                </div>
            </div>

            <!-- Nível -->
            <div class="meta-info-item">
                <div class="meta-info-icon">
                    <i class="fas fa-signal"></i>
                </div>
                <div class="meta-info-text">
                    <span class="meta-info-label">Nível</span>
                    <span class="curso-nivel-badge" style="background: <?php echo $nivel_cor['bg']; ?>; color: <?php echo $nivel_cor['text']; ?>;">
                        <?php echo esc_html($nivel); ?>
                    </span>
                </div>
            </div>

            <!-- Alunos -->
            <?php if ($total_alunos > 0) : ?>
                <div class="meta-info-item">
                    <div class="meta-info-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="meta-info-text">
                        <span class="meta-info-label">Alunos</span>
                        <span class="meta-info-value"><?php echo number_format($total_alunos, 0, ',', '.'); ?> alunos</span>
                    </div>
                </div>
            <?php endif; ?>

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
