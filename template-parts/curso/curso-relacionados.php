<?php
/**
 * Cursos Relacionados
 * Grid de 3 cursos similares (mesma categoria ou tags)
 * 
 * @package Camisa10_Child
 * @since 1.0.0
 * 
 * Acessibilidade: WCAG 2.1 AA
 * - Cards interativos com estados de foco
 * - Alt text descritivo em imagens
 * - Contraste adequado
 * 
 * Lógica:
 * 1. Busca por mesma categoria
 * 2. Fallback por tags similares
 * 3. Fallback por cursos mais recentes
 */

// Segurança
if (!defined('ABSPATH')) {
    exit;
}

$curso_atual_id = get_the_ID();

// Obtém categorias do curso atual
$categorias = get_the_terms($curso_atual_id, 'category');
$categoria_ids = [];

if ($categorias && !is_wp_error($categorias)) {
    foreach ($categorias as $cat) {
        $categoria_ids[] = $cat->term_id;
    }
}

// Obtém tags do curso atual (fallback)
$tags = get_the_terms($curso_atual_id, 'post_tag');
$tag_ids = [];

if ($tags && !is_wp_error($tags)) {
    foreach ($tags as $tag) {
        $tag_ids[] = $tag->term_id;
    }
}

// Query de cursos relacionados
$args = [
    'post_type' => ['curso', 'sfwd-courses'], // LearnDash compatibility
    'posts_per_page' => 3,
    'post__not_in' => [$curso_atual_id],
    'orderby' => 'rand',
    'post_status' => 'publish'
];

// Prioriza mesma categoria
if (!empty($categoria_ids)) {
    $args['tax_query'] = [
        [
            'taxonomy' => 'category',
            'field' => 'term_id',
            'terms' => $categoria_ids,
            'operator' => 'IN'
        ]
    ];
}

$cursos_relacionados = new WP_Query($args);

// Fallback: Se não encontrou por categoria, tenta por tags
if (!$cursos_relacionados->have_posts() && !empty($tag_ids)) {
    $args['tax_query'] = [
        [
            'taxonomy' => 'post_tag',
            'field' => 'term_id',
            'terms' => $tag_ids,
            'operator' => 'IN'
        ]
    ];
    
    $cursos_relacionados = new WP_Query($args);
}

// Fallback final: Cursos mais recentes
if (!$cursos_relacionados->have_posts()) {
    unset($args['tax_query']);
    $args['orderby'] = 'date';
    $args['order'] = 'DESC';
    
    $cursos_relacionados = new WP_Query($args);
}

// Se não houver cursos, não exibe a seção
if (!$cursos_relacionados->have_posts()) {
    return;
}
?>

<section class="curso-relacionados" aria-labelledby="relacionados-titulo">
    <div class="container">
        
        <header class="relacionados-header">
            <h2 id="relacionados-titulo" class="section-titulo">
                Outros Cursos Recomendados
            </h2>
            <p class="section-subtitulo">
                Continue sua jornada de aprendizado com estes cursos
            </p>
        </header>
        
        <div class="relacionados-grid">
            
            <?php 
            while ($cursos_relacionados->have_posts()) : 
                $cursos_relacionados->the_post();
                
                $post_id = get_the_ID();
                $titulo = get_the_title();
                $permalink = get_permalink();
                $imagem_url = get_the_post_thumbnail_url($post_id, 'medium_large');
                $imagem_alt = get_post_meta(get_post_thumbnail_id($post_id), '_wp_attachment_image_alt', true);
                $imagem_alt = $imagem_alt ?: $titulo;
                
                // Fallback de imagem
                if (!$imagem_url) {
                    $imagem_url = get_template_directory_uri() . '/assets/images/curso-placeholder.jpg';
                }
                
                // ACF Fields com fallback
                $carga_horaria = function_exists('get_field') ? get_field('curso_carga_horaria', $post_id) : get_post_meta($post_id, 'curso_carga_horaria', true);
                $carga_horaria = $carga_horaria ?: '40';
                
                $nivel = function_exists('get_field') ? get_field('curso_nivel', $post_id) : get_post_meta($post_id, 'curso_nivel', true);
                $nivel = $nivel ?: 'Intermediário';
                
                $preco = function_exists('get_field') ? get_field('curso_preco', $post_id) : get_post_meta($post_id, 'curso_preco', true);
                $preco = floatval($preco);
                
                $preco_promocional = function_exists('get_field') ? get_field('curso_preco_promocional', $post_id) : get_post_meta($post_id, 'curso_preco_promocional', true);
                $preco_promocional = floatval($preco_promocional);
                
                // Determina preço final
                $preco_exibir = $preco_promocional > 0 && $preco_promocional < $preco ? $preco_promocional : $preco;
                $tem_promocao = $preco_promocional > 0 && $preco_promocional < $preco;
                
                // Categoria principal
                $categorias = get_the_terms($post_id, 'category');
                $categoria_nome = '';
                if ($categorias && !is_wp_error($categorias)) {
                    $categoria_nome = $categorias[0]->name;
                }
                
                // Cores de nível
                $nivel_cores = [
                    'Iniciante' => ['bg' => '#02FB9A', 'text' => '#111111'],
                    'Intermediário' => ['bg' => '#FAF323', 'text' => '#111111'],
                    'Avançado' => ['bg' => '#0A3BE8', 'text' => '#FFFFFF']
                ];
                
                $nivel_cor = $nivel_cores[$nivel] ?? $nivel_cores['Intermediário'];
            ?>
            
            <article class="curso-card-relacionado" data-aos="fade-up" data-aos-delay="<?php echo ($cursos_relacionados->current_post * 150); ?>">
                
                <!-- Imagem -->
                <a href="<?php echo esc_url($permalink); ?>" class="card-imagem-link" aria-label="Ver detalhes do curso <?php echo esc_attr($titulo); ?>">
                    <figure class="card-imagem">
                        <img 
                            src="<?php echo esc_url($imagem_url); ?>" 
                            alt="<?php echo esc_attr($imagem_alt); ?>"
                            loading="lazy"
                            width="400"
                            height="250"
                        />
                        
                        <!-- Badge de Nível -->
                        <span 
                            class="badge-nivel-overlay" 
                            style="background-color: <?php echo esc_attr($nivel_cor['bg']); ?>; color: <?php echo esc_attr($nivel_cor['text']); ?>;"
                            aria-label="Nível: <?php echo esc_attr($nivel); ?>"
                        >
                            <?php echo esc_html($nivel); ?>
                        </span>
                        
                        <?php if ($tem_promocao) : ?>
                        <span class="badge-promo-overlay" role="status">
                            <?php 
                            $desconto = round((($preco - $preco_promocional) / $preco) * 100);
                            echo esc_html($desconto . '% OFF');
                            ?>
                        </span>
                        <?php endif; ?>
                    </figure>
                </a>
                
                <!-- Conteúdo -->
                <div class="card-conteudo">
                    
                    <!-- Categoria -->
                    <?php if ($categoria_nome) : ?>
                    <span class="card-categoria"><?php echo esc_html($categoria_nome); ?></span>
                    <?php endif; ?>
                    
                    <!-- Título -->
                    <h3 class="card-titulo">
                        <a href="<?php echo esc_url($permalink); ?>">
                            <?php echo esc_html($titulo); ?>
                        </a>
                    </h3>
                    
                    <!-- Meta -->
                    <div class="card-meta">
                        <span class="meta-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                                <path d="M12 6v6l4 2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                            <?php echo esc_html($carga_horaria); ?>h
                        </span>
                    </div>
                    
                    <!-- Footer (Preço + CTA) -->
                    <div class="card-footer">
                        <div class="card-preco">
                            <?php if ($tem_promocao) : ?>
                                <span class="preco-original-small"><?php echo 'R$ ' . number_format($preco, 2, ',', '.'); ?></span>
                                <span class="preco-atual"><?php echo 'R$ ' . number_format($preco_promocional, 2, ',', '.'); ?></span>
                            <?php else : ?>
                                <span class="preco-atual">
                                    <?php echo $preco > 0 ? 'R$ ' . number_format($preco, 2, ',', '.') : 'Gratuito'; ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        
                        <a 
                            href="<?php echo esc_url($permalink); ?>" 
                            class="btn-ver-curso"
                            aria-label="Ver detalhes do curso <?php echo esc_attr($titulo); ?>"
                        >
                            Ver Curso
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                    
                </div>
                
            </article>
            
            <?php endwhile; wp_reset_postdata(); ?>
            
        </div>
        
        <!-- Link para ver todos os cursos -->
        <div class="relacionados-cta-wrapper">
            <a href="<?php echo esc_url(get_post_type_archive_link('curso')); ?>" class="btn-todos-cursos">
                Ver Todos os Cursos
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </div>
        
    </div>
</section>
