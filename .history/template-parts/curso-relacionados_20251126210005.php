<?php
/**
 * Template Part: Cursos Relacionados
 * Versão: 2.0 (corrigida)
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

// Pegar categoria do curso atual
$categoria = camisa10_sanitize_text('curso_categoria', $curso_id);

// Query de cursos relacionados
$args = array(
    'post_type' => 'curso',
    'posts_per_page' => 3,
    'post__not_in' => array($curso_id),
    'orderby' => 'rand',
);

// Se tiver categoria, filtrar por ela
if (!empty($categoria)) {
    $args['meta_query'] = array(
        array(
            'key' => 'curso_categoria',
            'value' => $categoria,
            'compare' => '='
        )
    );
}

$related_query = new WP_Query($args);

// Se não encontrou cursos relacionados, não exibir
if (!$related_query->have_posts()) {
    return;
}
?>

<section class="curso-relacionados" id="cursos-relacionados">
    <div class="container">
        
        <header class="section-header">
            <h2 class="section-title">Cursos Relacionados</h2>
            <p class="section-subtitle">Continue aprendendo com estes cursos</p>
        </header>

        <div class="cursos-grid">
            
            <?php while ($related_query->have_posts()) : $related_query->the_post(); 
                $related_id = get_the_ID();
                $related_categoria = camisa10_sanitize_text('curso_categoria', $related_id);
                $related_duracao = camisa10_sanitize_text('curso_duracao', $related_id);
                $related_nivel = camisa10_sanitize_text('curso_nivel', $related_id);
                $related_badge = camisa10_sanitize_text('curso_badge', $related_id);
                
                // Thumbnail
                $thumbnail_url = get_the_post_thumbnail_url($related_id, 'curso-card');
                if (empty($thumbnail_url)) {
                    $thumbnail_url = get_stylesheet_directory_uri() . '/assets/images/default-curso.jpg';
                }
            ?>

            <article class="curso-card animate-on-scroll">
                
                <!-- Imagem -->
                <div class="curso-card__image">
                    <a href="<?php the_permalink(); ?>">
                        <img 
                            src="<?php echo esc_url($thumbnail_url); ?>" 
                            alt="<?php echo esc_attr(get_the_title()); ?>"
                            loading="lazy"
                        >
                    </a>
                    
                    <?php if (!empty($related_badge)) : ?>
                    <span class="curso-card__badge"><?php echo esc_html($related_badge); ?></span>
                    <?php endif; ?>
                </div>

                <!-- Conteúdo -->
                <div class="curso-card__content">
                    
                    <?php if (!empty($related_categoria)) : ?>
                    <div class="curso-card__categoria">
                        <?php echo esc_html($related_categoria); ?>
                    </div>
                    <?php endif; ?>

                    <h3 class="curso-card__title">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h3>

                    <?php if (has_excerpt()) : ?>
                    <div class="curso-card__excerpt">
                        <?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?>
                    </div>
                    <?php endif; ?>

                    <!-- Meta -->
                    <div class="curso-card__meta">
                        
                        <?php if (!empty($related_duracao)) : ?>
                        <div class="curso-card__meta-item">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                ircle cx="8" cy="8" r="6" stroke="currentColor" stroke-width="1.5"/>
                                <path d="M8 5V8L10 10" stroke="currentColor" stroke-width="1.5"/>
                            </svg>
                            <span><?php echo esc_html($related_duracao); ?></span>
                        </div>
                        <?php endif; ?>

                        <?php if (!empty($related_nivel)) : ?>
                        <div class="curso-card__meta-item">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2 14L8 2L14 14H2Z" stroke="currentColor" stroke-width="1.5"/>
                            </svg>
                            <span><?php echo esc_html($related_nivel); ?></span>
                        </div>
                        <?php endif; ?>

                    </div>

                </div>

            </article>

            <?php endwhile; wp_reset_postdata(); ?>

        </div>

        <!-- Ver todos os cursos -->
        <div class="related-cta">
            <a href="<?php echo esc_url(get_post_type_archive_link('curso')); ?>" class="btn btn--outline">
                Ver Todos os Cursos
                <svg class="btn-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5 10H15M15 10L11 6M15 10L11 14" stroke="currentColor" stroke-width="2"/>
                </svg>
            </a>
        </div>

    </div>
</section>

<style>
.curso-relacionados {
    padding: var(--space-4xl) 0;
    background-color: rgba(250, 243, 35, 0.05);
}

.related-cta {
    display: flex;
    justify-content: center;
    margin-top: var(--space-3xl);
}
</style>
