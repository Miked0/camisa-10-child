<?php
/**
 * Template Name: Home - Camisa 10
 * Description: Template customizado para página inicial - Parte 2 inserida
 * @package Camisa10
 * @version 2.0
 */

// ============================================
// FUNÇÃO HELPER PARA PREVENIR ARRAY TO STRING
// ============================================
if (!function_exists('safe_echo_array')) {
    function safe_echo_array($value, $separator = ', ') {
        if (is_array($value)) {
            $output = array();
            foreach ($value as $item) {
                if (is_object($item) && isset($item->name)) {
                    $output[] = $item->name;
                } elseif (is_string($item)) {
                    $output[] = $item;
                }
            }
            return implode($separator, $output);
        } elseif (is_object($value) && isset($value->name)) {
            return $value->name;
        }
        return $value;
    }
}

get_header();
?>

<?php
// HERO BANNER
if (is_front_page()) {
    get_template_part('template-parts/hero', 'banner');
}
?>

<!-- ============================================
     COMO FUNCIONA
     Layout: 4 passos em linha horizontal
     Componentes: Número/Ícone, Título, Descrição
     ============================================ -->
<section id="como-funciona" class="how-it-works-section section-padding">
    <div class="container">
        <!-- Cabeçalho -->
        <div class="section-header text-center mb-5">
            <h2 class="section-title animate-on-scroll">Como Funciona</h2>
            <p class="section-subtitle">Comece sua jornada em 4 passos simples</p>
        </div>

        <!-- Steps -->
        <div class="row g-4 position-relative">
            <!-- Conectores -->
            <div class="step-connectors d-none d-lg-block"></div>

            <!-- Passo 1 -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="step-card text-center animate-on-scroll">
                    <div class="step-number">
                        <span>1</span>
                    </div>
                    <h3 class="step-title">Explore</h3>
                    <p class="step-description">
                        Navegue por nossa biblioteca com centenas de cursos em diversas áreas
                    </p>
                </div>
            </div>

            <!-- Passo 2 -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="step-card text-center animate-on-scroll">
                    <div class="step-number">
                        <span>2</span>
                    </div>
                    <h3 class="step-title">Inscreva-se</h3>
                    <p class="step-description">
                        Escolha o curso ideal e faça sua inscrição de forma rápida e segura
                    </p>
                </div>
            </div>

            <!-- Passo 3 -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="step-card text-center animate-on-scroll">
                    <div class="step-number">
                        <span>3</span>
                    </div>
                    <h3 class="step-title">Aprenda</h3>
                    <p class="step-description">
                        Assista às aulas no seu ritmo e pratique com exercícios reais
                    </p>
                </div>
            </div>

            <!-- Passo 4 -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="step-card text-center animate-on-scroll">
                    <div class="step-number">
                        <span>4</span>
                    </div>
                    <h3 class="step-title">Certifique-se</h3>
                    <p class="step-description">
                        Receba seu certificado reconhecido e destaque-se no mercado
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     ESTATÍSTICAS (KPIs)
     Layout: 4 cards em linha
     Componentes: Ícone, Número animado, Descrição
     ============================================ -->
<section id="statistics" class="statistics-section section-padding bg-primary text-white">
    <div class="container">
        <div class="row g-4 text-center">
            <!-- Estatística 1: Alunos -->
            <div class="col-6 col-md-3">
                <div class="stat-card animate-on-scroll">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-number" data-count="100000">0</div>
                    <div class="stat-label">Alunos Ativos</div>
                </div>
            </div>

            <!-- Estatística 2: Instrutores -->
            <div class="col-6 col-md-3">
                <div class="stat-card animate-on-scroll">
                    <div class="stat-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <div class="stat-number" data-count="1500">0</div>
                    <div class="stat-label">Especialistas</div>
                </div>
            </div>

            <!-- Estatística 3: Cursos -->
            <div class="col-6 col-md-3">
                <div class="stat-card animate-on-scroll">
                    <div class="stat-icon">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <div class="stat-number" data-count="2400">0</div>
                    <div class="stat-label">Cursos Disponíveis</div>
                </div>
            </div>

            <!-- Estatística 4: Rating -->
            <div class="col-6 col-md-3">
                <div class="stat-card animate-on-scroll">
                    <div class="stat-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="stat-number">
                        <span data-count="4.90">0</span><span class="stat-decimal">.9</span>
                    </div>
                    <div class="stat-label">Avaliação Média</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     CURSOS EM DESTAQUE (VERSÃO FINAL BLINDADA)
     ============================================ -->
<section id="featured-courses" class="featured-courses-section section-padding">
    <div class="container">
        <!-- Cabeçalho da Seção -->
        <div class="section-header text-center mb-5">
            <h2 class="section-title animate-on-scroll">Cursos em Destaque</h2>
            <p class="section-subtitle">Os cursos mais procurados pelos nossos alunos</p>
        </div>

        <!-- Grid de Cursos -->
        <div class="row g-4">
            <?php
            try {
                // Query de Cursos em Destaque
                $args_featured = array(
                    'post_type'      => 'curso',
                    'posts_per_page' => 8,
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                    'post_status'    => 'publish',
                );

                $featured_courses = new WP_Query($args_featured);

                if ($featured_courses->have_posts()) :
                    while ($featured_courses->have_posts()) : $featured_courses->the_post();

                        // INICIALIZAR COM VALORES PADRÃO SEGUROS
                        $carga_horaria = '40h';
                        $formato = 'online';
                        $preco = 0;
                        $preco_promocional = 0;
                        $nivel = 'Intermediário';
                        $rating = 5.0;
                        $total_alunos = 0;

                        // PEGAR VALORES COM VALIDAÇÃO DE TIPO
                        try {
                            if (function_exists('get_field')) { // ACF
                                $temp_carga = get_field('curso_carga_horaria');
                                $carga_horaria = !empty($temp_carga) ? (string)$temp_carga : $carga_horaria;

                                $temp_formato = get_field('curso_formato');
                                $formato = !empty($temp_formato) ? (string)$temp_formato : $formato;

                                $temp_preco = get_field('curso_preco');
                                $preco = !empty($temp_preco) ? floatval($temp_preco) : 0;

                                $temp_preco_promo = get_field('curso_preco_promocional');
                                $preco_promocional = !empty($temp_preco_promo) ? floatval($temp_preco_promo) : 0;

                                $temp_nivel = get_field('curso_nivel');
                                $nivel = !empty($temp_nivel) ? (string)$temp_nivel : $nivel;

                                $temp_rating = get_field('curso_rating');
                                $rating = !empty($temp_rating) ? floatval($temp_rating) : 5.0;

                                $temp_alunos = get_field('curso_total_alunos');
                                $total_alunos = !empty($temp_alunos) ? intval($temp_alunos) : 0;
                            } else { // Fallback post_meta
                                $temp_carga = get_post_meta(get_the_ID(), 'curso_carga_horaria', true);
                                $carga_horaria = !empty($temp_carga) ? (string)$temp_carga : $carga_horaria;

                                $temp_formato = get_post_meta(get_the_ID(), 'curso_formato', true);
                                $formato = !empty($temp_formato) ? (string)$temp_formato : $formato;

                                $temp_preco = get_post_meta(get_the_ID(), 'curso_preco', true);
                                $preco = !empty($temp_preco) ? floatval($temp_preco) : 0;

                                $temp_preco_promo = get_post_meta(get_the_ID(), 'curso_preco_promocional', true);
                                $preco_promocional = !empty($temp_preco_promo) ? floatval($temp_preco_promo) : 0;

                                $temp_nivel = get_post_meta(get_the_ID(), 'curso_nivel', true);
                                $nivel = !empty($temp_nivel) ? (string)$temp_nivel : $nivel;

                                $temp_rating = get_post_meta(get_the_ID(), 'curso_rating', true);
                                $rating = !empty($temp_rating) ? floatval($temp_rating) : 5.0;

                                $temp_alunos = get_post_meta(get_the_ID(), 'curso_total_alunos', true);
                                $total_alunos = !empty($temp_alunos) ? intval($temp_alunos) : 0;
                            }
                        } catch (Exception $e) {
                            error_log('Erro ao pegar campos do curso ID ' . get_the_ID() . ': ' . $e->getMessage());
                        }

                        // Categorias com validação
                        $categories = get_the_terms(get_the_ID(), 'category');
                        if (is_wp_error($categories) || empty($categories)) {
                            $categories = array();
                        }
            ?>
                        <div class="col-12 col-sm-6 col-lg-3">
                            <article class="course-card animate-on-scroll">
                                <!-- Imagem do Curso -->
                                <div class="course-image">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('medium', array('class' => 'img-fluid')); ?>
                                        </a>
                                    <?php else : ?>
                                        <a href="<?php the_permalink(); ?>">
                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/course-placeholder.jpg" 
                                                 alt="<?php the_title_attribute(); ?>" 
                                                 class="img-fluid">
                                        </a>
                                    <?php endif; ?>

                                    <!-- Badge de Nível -->
                                    <span class="course-badge badge-<?php echo esc_attr(strtolower((string)$nivel)); ?>">
                                        <?php echo esc_html($nivel); ?>
                                    </span>

                                    <!-- Badge de Formato -->
                                    <span class="course-format-badge">
                                        <i class="fas fa-video"></i>
                                        <?php echo esc_html(ucfirst((string)$formato)); ?>
                                    </span>
                                </div>

                                <!-- Conteúdo do Card -->
                                <div class="course-content">
                                    <!-- Categoria -->
                                    <?php if (!empty($categories)) : ?>
                                        <div class="course-category">
                                            <a href="<?php echo esc_url(get_term_link($categories[0])); ?>">
                                                <?php echo esc_html($categories[0]->name); ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>

                                    <!-- Título -->
                                    <h3 class="course-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h3>

                                    <!-- Meta Info -->
                                    <div class="course-meta">
                                        <span class="meta-item">
                                            <i class="far fa-clock"></i>
                                            <?php echo esc_html($carga_horaria); ?>
                                        </span>
                                        <span class="meta-item">
                                            <i class="far fa-user"></i>
                                            <?php echo esc_html($total_alunos); ?> alunos
                                        </span>
                                    </div>

                                    <!-- Rating -->
                                    <div class="course-rating">
                                        <div class="stars">
                                            <?php
                                            $full_stars = floor($rating);
                                            $half_star = ($rating - $full_stars) >= 0.5;
                                            for ($i = 1; $i <= 5; $i++) {
                                                if ($i <= $full_stars) {
                                                    echo '<i class="fas fa-star"></i>';
                                                } elseif ($i == $full_stars + 1 && $half_star) {
                                                    echo '<i class="fas fa-star-half-alt"></i>';
                                                } else {
                                                    echo '<i class="far fa-star"></i>';
                                                }
                                            }
                                            ?>
                                        </div>
                                        <span class="rating-number"><?php echo number_format($rating, 1, ',', '.'); ?></span>
                                    </div>
                                </div>

                                <!-- Footer do Card -->
                                <div class="course-footer">
                                    <div class="course-price">
                                        <?php if ($preco_promocional > 0 && $preco_promocional < $preco) : ?>
                                            <span class="price-original">R$ <?php echo number_format($preco, 2, ',', '.'); ?></span>
                                            <span class="price-current">R$ <?php echo number_format($preco_promocional, 2, ',', '.'); ?></span>
                                        <?php elseif ($preco > 0) : ?>
                                            <span class="price-current">R$ <?php echo number_format($preco, 2, ',', '.'); ?></span>
                                        <?php else : ?>
                                            <span class="price-free">Gratuito</span>
                                        <?php endif; ?>
                                    </div>
                                    <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-sm">Ver Curso</a>
                                </div>
                            </article>
                        </div>
            <?php
                    endwhile;
                    wp_reset_postdata();
                else :
            ?>
                    <div class="col-12">
                        <div class="alert alert-info text-center" role="alert">
                            Nenhum curso encontrado.
                        </div>
                    </div>
            <?php
                endif;
            } catch (Exception $e) {
                error_log('ERRO na seção de cursos: ' . $e->getMessage());
            ?>
                <div class="col-12">
                    <div class="alert alert-danger" role="alert">
                        Erro ao carregar cursos. Verifique o log.
                    </div>
                </div>
            <?php
            }
            ?>
        </div>

        <!-- Botão Ver Todos -->
        <div class="text-center mt-5">
            <a href="<?php echo esc_url(get_post_type_archive_link('curso')); ?>" class="btn btn-outline-primary btn-lg">
                Ver Todos os Cursos
                <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- ============================================
     CATEGORIAS DE CURSOS
     Layout: Grid 4-6 colunas
     Card: Ícone, Nome, Contador, Link
     ============================================ -->
<section id="course-categories" class="categories-section section-padding bg-light">
    <div class="container">
        <!-- Cabeçalho -->
        <div class="section-header text-center mb-5">
            <h2 class="section-title animate-on-scroll">Explore por Categoria</h2>
            <p class="section-subtitle">Encontre o curso perfeito para suas necessidades</p>
        </div>

        <!-- Grid de Categorias -->
        <div class="row g-4">
            <?php
            $categories = array(
                array('icon' => 'fa-code', 'name' => 'Desenvolvimento', 'count' => 45, 'slug' => 'desenvolvimento'),
                array('icon' => 'fa-chart-line', 'name' => 'Negócios', 'count' => 32, 'slug' => 'negocios'),
                array('icon' => 'fa-palette', 'name' => 'Design', 'count' => 28, 'slug' => 'design'),
                array('icon' => 'fa-bullhorn', 'name' => 'Marketing', 'count' => 24, 'slug' => 'marketing'),
                array('icon' => 'fa-users-cog', 'name' => 'Gestão', 'count' => 18, 'slug' => 'gestao'),
                array('icon' => 'fa-brain', 'name' => 'Soft Skills', 'count' => 21, 'slug' => 'soft-skills'),
            );

            foreach ($categories as $cat) :
            ?>
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="<?php echo esc_url(add_query_arg('categoria', $cat['slug'], get_post_type_archive_link('curso'))); ?>" 
                       class="category-card text-decoration-none animate-on-scroll">
                        <div class="category-icon">
                            <i class="fas <?php echo esc_attr($cat['icon']); ?>"></i>
                        </div>
                        <h3 class="category-name"><?php echo esc_html($cat['name']); ?></h3>
                        <p class="category-count"><?php echo esc_html($cat['count']); ?> cursos</p>
                        <span class="category-link">Ver Todos <i class="fas fa-arrow-right"></i></span>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ============================================
     DEPOIMENTOS (TESTIMONIALS)
     Layout: Carousel com 3 cards visíveis
     Componentes: Texto, Rating, Avatar, Nome, Ocupação
     ============================================ -->
<section id="depoimentos" class="testimonials-section section-padding bg-light">
    <div class="container">
        <!-- Cabeçalho -->
        <div class="section-header text-center mb-5">
            <h2 class="section-title animate-on-scroll">O Que Nossos Alunos Dizem</h2>
            <p class="section-subtitle">Histórias reais de transformação profissional</p>
        </div>

        <!-- Slider de Depoimentos -->
        <div class="testimonials-slider">
            <?php
            // Query de Depoimentos
            $args_testimonials = array(
                'post_type'      => 'depoimento',
                'posts_per_page' => 6,
                'orderby'        => 'date',
                'order'          => 'DESC'
            );

            $testimonials = new WP_Query($args_testimonials);

            if ($testimonials->have_posts()) :
                while ($testimonials->have_posts()) : $testimonials->the_post();
                    $rating = get_post_meta(get_the_ID(), 'rating', true) ?: 5;
                    $ocupacao = get_post_meta(get_the_ID(), 'ocupacao', true) ?: '';
            ?>
                    <div class="testimonial-card">
                        <!-- Aspas Visuais -->
                        <div class="testimonial-quote-icon">
                            <i class="fas fa-quote-left"></i>
                        </div>

                        <!-- Texto do Depoimento -->
                        <div class="testimonial-text">
                            <?php the_content(); ?>
                        </div>

                        <!-- Rating -->
                        <div class="testimonial-rating">
                            <?php for ($i = 1; $i <= 5; $i++) : ?>
                                <?php if ($i <= $rating) : ?>
                                    <i class="fas fa-star"></i>
                                <?php else : ?>
                                    <i class="far fa-star"></i>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </div>

                        <!-- Autor -->
                        <div class="testimonial-author">
                            <div class="author-avatar">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('thumbnail', array('class' => 'rounded-circle')); ?>
                                <?php else : ?>
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/avatar-placeholder.jpg" 
                                         alt="<?php the_title(); ?>" 
                                         class="rounded-circle">
                                <?php endif; ?>
                            </div>
                            <div class="author-info">
                                <h4 class="author-name"><?php the_title(); ?></h4>
                                <?php if ($ocupacao) : ?>
                                    <p class="author-occupation"><?php echo esc_html($ocupacao); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
            ?>
                <!-- Depoimentos de exemplo caso não haja posts -->
                <div class="testimonial-card">
                    <div class="testimonial-quote-icon">
                        <i class="fas fa-quote-left"></i>
                    </div>
                    <div class="testimonial-text">
                        <p>A plataforma Camisa 10 transformou minha carreira. Aprendi com os melhores e apliquei o conhecimento imediatamente no meu trabalho.</p>
                    </div>
                    <div class="testimonial-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/avatar-placeholder.jpg" 
                                 alt="Aluno" 
                                 class="rounded-circle">
                        </div>
                        <div class="author-info">
                            <h4 class="author-name">Maria Silva</h4>
                            <p class="author-occupation">Desenvolvedora Full Stack</p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- ============================================
     ESPECIALISTAS EM DESTAQUE
     Layout: Grid 3-4 colunas
     Card: Imagem, Nome, Especialidade, Stats, Botões Social
     ============================================ -->
<section id="especialistas" class="instructors-section section-padding">
    <div class="container">
        <!-- Cabeçalho -->
        <div class="section-header text-center mb-5">
            <h2 class="section-title animate-on-scroll">Nossos Especialistas</h2>
            <p class="section-subtitle">Aprenda com profissionais reconhecidos que dominam suas áreas</p>
        </div>

        <!-- Grid de Instrutores -->
        <div class="row g-4">
            <?php
            // Query de Especialistas
            $args_instructors = array(
                'post_type'      => 'especialista',
                'posts_per_page' => 4,
                'orderby'        => 'date',
                'order'          => 'DESC'
            );

            $instructors = new WP_Query($args_instructors);

            if ($instructors->have_posts()) :
                while ($instructors->have_posts()) : $instructors->the_post();
                    $especialidade = get_post_meta(get_the_ID(), 'especialidade', true);
                    $rating = get_post_meta(get_the_ID(), 'rating', true) ?: '4.9';
                    $cursos_count = get_post_meta(get_the_ID(), 'cursos_count', true) ?: '5';
                    $alunos_count = get_post_meta(get_the_ID(), 'alunos_count', true) ?: '1.2k';
                    $social_linkedin = get_post_meta(get_the_ID(), 'social_linkedin', true);
                    $social_twitter = get_post_meta(get_the_ID(), 'social_twitter', true) ?: '';
            ?>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="instructor-card text-center animate-on-scroll">
                            <!-- Imagem do Instrutor -->
                            <div class="instructor-image">
                                <?php if (has_post_thumbnail()) : ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('medium', array('class' => 'img-fluid rounded-circle')); ?>
                                    </a>
                                <?php else : ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/instructor-placeholder.jpg" 
                                             alt="<?php the_title(); ?>" 
                                             class="img-fluid rounded-circle">
                                    </a>
                                <?php endif; ?>
                            </div>

                            <!-- Nome -->
                            <h3 class="instructor-name">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>

                            <!-- Especialidade -->
                            <?php if ($especialidade) : ?>
                                <p class="instructor-specialty"><?php echo esc_html($especialidade); ?></p>
                            <?php endif; ?>

                            <!-- Rating -->
                            <div class="instructor-rating">
                                <i class="fas fa-star"></i>
                                <span><?php echo esc_html($rating); ?></span>
                            </div>

                            <!-- Estatísticas -->
                            <div class="instructor-stats">
                                <span><?php echo esc_html($cursos_count); ?> Cursos</span>
                                <span class="separator">•</span>
                                <span><?php echo esc_html($alunos_count); ?> Alunos</span>
                            </div>

                            <!-- Botões -->
                            <div class="instructor-actions">
                                <a href="<?php the_permalink(); ?>" class="btn btn-outline-primary btn-sm">Ver Perfil</a>
                            </div>

                            <!-- Ícones Sociais -->
                            <div class="instructor-social">
                                <?php if ($social_linkedin) : ?>
                                    <a href="<?php echo esc_url($social_linkedin); ?>" target="_blank" rel="noopener">
                                        <i class="fab fa-linkedin"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if ($social_twitter) : ?>
                                    <a href="<?php echo esc_url($social_twitter); ?>" target="_blank" rel="noopener">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>

        <!-- Botão Ver Todos -->
        <div class="text-center mt-5">
            <a href="<?php echo esc_url(get_post_type_archive_link('especialista')); ?>" class="btn btn-outline-primary btn-lg">
                Ver Todos Especialistas
                <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- ============================================
     CTA SECTION
     Layout: Centralizado
     Componentes: Headline, Subheadline, 2 Botões, Background Destacado
     ============================================ -->
<section id="cta-section" class="cta-section section-padding bg-gradient text-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 text-center">
                <!-- Headline -->
                <h2 class="cta-title animate-on-scroll mb-4">
                    <?php echo get_theme_mod('camisa10_cta_title', 'Pronto para Ser o Camisa 10?'); ?>
                </h2>

                <!-- Subheadline -->
                <p class="cta-subtitle animate-on-scroll mb-5">
                    <?php echo get_theme_mod('camisa10_cta_subtitle', 'Comece sua jornada hoje e transforme sua carreira com nossa plataforma de aprendizado'); ?>
                </p>

                <!-- CTAs -->
                <div class="cta-buttons animate-on-scroll">
                    <a href="<?php echo esc_url(get_theme_mod('camisa10_cta_button1_url', '#')); ?>" class="btn btn-dark btn-lg me-3">
                        <?php echo get_theme_mod('camisa10_cta_button1_text', 'Começar Gratuitamente'); ?>
                    </a>
                    <a href="<?php echo esc_url(get_theme_mod('camisa10_cta_button2_url', '/mentorias')); ?>" class="btn btn-outline-dark btn-lg">
                        <?php echo get_theme_mod('camisa10_cta_button2_text', 'Conhecer Mentorias'); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     BLOG (ÚLTIMAS NOTÍCIAS)
     Layout: Grid 3 colunas
     Card: Imagem, Categoria, Data, Título, Excerpt, Link
     ============================================ -->
<section id="blog" class="blog-section section-padding">
    <div class="container">
        <!-- Cabeçalho -->
        <div class="section-header text-center mb-5">
            <h2 class="section-title animate-on-scroll">Últimas do Blog</h2>
            <p class="section-subtitle">Fique por dentro das novidades e dicas para seu desenvolvimento</p>
        </div>

        <!-- Grid de Posts -->
        <div class="row g-4">
            <?php
            // Query de Posts do Blog
            $args_blog = array(
                'post_type'      => 'post',
                'posts_per_page' => 3,
                'orderby'        => 'date',
                'order'          => 'DESC'
            );

            $blog_posts = new WP_Query($args_blog);

            if ($blog_posts->have_posts()) :
                while ($blog_posts->have_posts()) : $blog_posts->the_post();
                    $categories = get_the_category();
            ?>
                    <div class="col-12 col-md-6 col-lg-4">
                        <article class="blog-card animate-on-scroll">
                            <!-- Imagem do Post -->
                            <div class="blog-image">
                                <?php if (has_post_thumbnail()) : ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('medium_large', array('class' => 'img-fluid w-100')); ?>
                                    </a>
                                <?php else : ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/blog-placeholder.jpg" 
                                             alt="<?php the_title(); ?>" 
                                             class="img-fluid w-100">
                                    </a>
                                <?php endif; ?>
                            </div>

                            <!-- Conteúdo -->
                            <div class="blog-content">
                                <!-- Categoria -->
                                <?php if (!empty($categories)) : ?>
                                    <div class="blog-category">
                                        <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>">
                                            <?php echo esc_html($categories[0]->name); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <!-- Data -->
                                <div class="blog-date">
                                    <i class="far fa-calendar-alt"></i>
                                    <time datetime="<?php echo get_the_date('c'); ?>">
                                        <?php echo get_the_date('d/m/Y'); ?>
                                    </time>
                                </div>

                                <!-- Título -->
                                <h3 class="blog-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>

                                <!-- Excerpt -->
                                <div class="blog-excerpt">
                                    <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                                </div>

                                <!-- Link Ler Mais -->
                                <a href="<?php the_permalink(); ?>" class="blog-readmore">
                                    Ler Mais <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </article>
                    </div>
            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>

        <!-- Botão Ver Todos -->
        <div class="text-center mt-5">
            <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="btn btn-outline-primary btn-lg">
                Ver Todos os Artigos
                <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- ============================================
     FAQ (Frequently Asked Questions)
     Layout: 2 colunas desktop, 1 coluna mobile
     Componentes: Accordions interativos (Total: 10 itens)
     ============================================ -->
<section id="faq" class="faq-section section-padding bg-light">
    <div class="container">
        <!-- Cabeçalho -->
        <div class="section-header text-center mb-5">
            <h2 class="section-title animate-on-scroll">Perguntas Frequentes</h2>
            <p class="section-subtitle">Tire suas dúvidas sobre a plataforma e os cursos</p>
        </div>

        <!-- Accordions em 2 Colunas -->
        <div class="row g-4">
            <!-- Coluna 1 -->
            <div class="col-12 col-lg-6">
                <div class="accordion" id="faqAccordionLeft">
                    <!-- FAQ 1 -->
                    <div class="accordion-item animate-on-scroll">
                        <h2 class="accordion-header" id="faqHeading1">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" 
                                    data-bs-target="#faqCollapse1" aria-expanded="true" aria-controls="faqCollapse1">
                                Como faço para me inscrever em um curso?
                            </button>
                        </h2>
                        <div id="faqCollapse1" class="accordion-collapse collapse show" 
                             aria-labelledby="faqHeading1" data-bs-parent="#faqAccordionLeft">
                            <div class="accordion-body">
                                Para se inscrever, navegue até a página do curso desejado e clique no botão "Inscrever-se Agora". 
                                Você precisará criar uma conta ou fazer login caso já tenha uma. Após o pagamento, você terá acesso 
                                imediato ao conteúdo do curso.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 2 -->
                    <div class="accordion-item animate-on-scroll">
                        <h2 class="accordion-header" id="faqHeading2">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                    data-bs-target="#faqCollapse2" aria-expanded="false" aria-controls="faqCollapse2">
                                Os cursos têm certificado?
                            </button>
                        </h2>
                        <div id="faqCollapse2" class="accordion-collapse collapse" 
                             aria-labelledby="faqHeading2" data-bs-parent="#faqAccordionLeft">
                            <div class="accordion-body">
                                Sim! Todos os nossos cursos oferecem certificado de conclusão reconhecido no mercado. Você receberá 
                                o certificado automaticamente após concluir todas as aulas e atividades do curso, com nota mínima de 
                                aprovação de 70%.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 3 -->
                    <div class="accordion-item animate-on-scroll">
                        <h2 class="accordion-header" id="faqHeading3">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                    data-bs-target="#faqCollapse3" aria-expanded="false" aria-controls="faqCollapse3">
                                Qual a duração dos cursos?
                            </button>
                        </h2>
                        <div id="faqCollapse3" class="accordion-collapse collapse" 
                             aria-labelledby="faqHeading3" data-bs-parent="#faqAccordionLeft">
                            <div class="accordion-body">
                                A duração varia de acordo com o curso. Temos cursos rápidos de 2-5 horas, cursos médios de 10-20 horas 
                                e cursos completos com mais de 30 horas de conteúdo. Todas as informações estão disponíveis na página de 
                                cada curso.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 4 -->
                    <div class="accordion-item animate-on-scroll">
                        <h2 class="accordion-header" id="faqHeading4">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                    data-bs-target="#faqCollapse4" aria-expanded="false" aria-controls="faqCollapse4">
                                Posso assistir as aulas no meu próprio ritmo?
                            </button>
                        </h2>
                        <div id="faqCollapse4" class="accordion-collapse collapse" 
                             aria-labelledby="faqHeading4" data-bs-parent="#faqAccordionLeft">
                            <div class="accordion-body">
                                Sim! Nossa plataforma é 100% flexível. Você pode assistir às aulas quando e onde quiser, quantas vezes 
                                precisar. Não há prazos rígidos - você aprende no seu próprio ritmo, de acordo com sua disponibilidade.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 5 -->
                    <div class="accordion-item animate-on-scroll">
                        <h2 class="accordion-header" id="faqHeading5">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                    data-bs-target="#faqCollapse5" aria-expanded="false" aria-controls="faqCollapse5">
                                Existe alguma garantia de devolução?
                            </button>
                        </h2>
                        <div id="faqCollapse5" class="accordion-collapse collapse" 
                             aria-labelledby="faqHeading5" data-bs-parent="#faqAccordionLeft">
                            <div class="accordion-body">
                                Sim! Oferecemos garantia de 7 dias. Se você não estiver satisfeito com o curso por qualquer motivo, 
                                basta solicitar o reembolso total dentro deste período. Sem perguntas, sem complicações.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Coluna 2 -->
            <div class="col-12 col-lg-6">
                <div class="accordion" id="faqAccordionRight">
                    <!-- FAQ 6 -->
                    <div class="accordion-item animate-on-scroll">
                        <h2 class="accordion-header" id="faqHeading6">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                    data-bs-target="#faqCollapse6" aria-expanded="false" aria-controls="faqCollapse6">
                                Como funcionam as mentorias?
                            </button>
                        </h2>
                        <div id="faqCollapse6" class="accordion-collapse collapse" 
                             aria-labelledby="faqHeading6" data-bs-parent="#faqAccordionRight">
                            <div class="accordion-body">
                                Nossas mentorias são sessões individuais com especialistas. Você agenda um horário, prepara suas dúvidas 
                                e objetivos, e participa de uma videoconferência exclusiva. O mentor vai guiar você com feedback 
                                personalizado e plano de ação específico para suas necessidades.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 7 -->
                    <div class="accordion-item animate-on-scroll">
                        <h2 class="accordion-header" id="faqHeading7">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                    data-bs-target="#faqCollapse7" aria-expanded="false" aria-controls="faqCollapse7">
                                Os cursos são atualizados?
                            </button>
                        </h2>
                        <div id="faqCollapse7" class="accordion-collapse collapse" 
                             aria-labelledby="faqHeading7" data-bs-parent="#faqAccordionRight">
                            <div class="accordion-body">
                                Sim! Mantemos nossos cursos sempre atualizados com as últimas tendências e tecnologias do mercado. 
                                Quando você se inscreve em um curso, tem acesso vitalício a todas as atualizações futuras, sem custo 
                                adicional.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 8 -->
                    <div class="accordion-item animate-on-scroll">
                        <h2 class="accordion-header" id="faqHeading8">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                    data-bs-target="#faqCollapse8" aria-expanded="false" aria-controls="faqCollapse8">
                                Posso acessar os cursos pelo celular?
                            </button>
                        </h2>
                        <div id="faqCollapse8" class="accordion-collapse collapse" 
                             aria-labelledby="faqHeading8" data-bs-parent="#faqAccordionRight">
                            <div class="accordion-body">
                                Sim! Nossa plataforma é 100% responsiva e funciona perfeitamente em celulares, tablets e computadores. 
                                Você pode começar uma aula no computador e continuar no celular sem perder o progresso.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 9 -->
                    <div class="accordion-item animate-on-scroll">
                        <h2 class="accordion-header" id="faqHeading9">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                    data-bs-target="#faqCollapse9" aria-expanded="false" aria-controls="faqCollapse9">
                                Preciso ter conhecimento prévio?
                            </button>
                        </h2>
                        <div id="faqCollapse9" class="accordion-collapse collapse" 
                             aria-labelledby="faqHeading9" data-bs-parent="#faqAccordionRight">
                            <div class="accordion-body">
                                Depende do curso! Cada curso indica claramente o nível de conhecimento necessário: iniciante, 
                                intermediário ou avançado. Temos cursos para todos os níveis, desde quem está começando do zero até 
                                profissionais experientes que querem se especializar.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 10 -->
                    <div class="accordion-item animate-on-scroll">
                        <h2 class="accordion-header" id="faqHeading10">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                    data-bs-target="#faqCollapse10" aria-expanded="false" aria-controls="faqCollapse10">
                                Como entro em contato com o suporte?
                            </button>
                        </h2>
                        <div id="faqCollapse10" class="accordion-collapse collapse" 
                             aria-labelledby="faqHeading10" data-bs-parent="#faqAccordionRight">
                            <div class="accordion-body">
                                Você pode entrar em contato através do email suporte@camisa10.com.br, pelo chat ao vivo disponível 
                                no canto inferior direito da tela, ou pelo WhatsApp (21) 99999-9999. Nossa equipe responde em até 24 
                                horas úteis.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ainda tem dúvidas? -->
        <div class="text-center mt-5">
            <p class="lead mb-4">Ainda tem dúvidas?</p>
            <a href="<?php echo esc_url(get_permalink(get_page_by_path('contato'))); ?>" class="btn btn-primary btn-lg">
                Entre em Contato
                <i class="fas fa-envelope ms-2"></i>
            </a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
