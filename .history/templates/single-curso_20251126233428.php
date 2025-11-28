<?php
/**
 * Template para exibição de curso individual
 * @package Camisa10
 * @version 8.0.0 - CORRIGIDO
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<!-- Single Curso Container -->
<main class="single-curso-container">
    <?php
    while (have_posts()) : the_post();
        
        // ID do curso atual
        $curso_id = get_the_ID();
        
        // ============================================
        // SEÇÃO 1: HERO BANNER DO CURSO
        // ============================================
        get_template_part('template-parts/curso/curso', 'hero');
        
        // ============================================
        // SEÇÃO 2: INFOS RÁPIDAS (SIDEBAR FLUTUANTE)
        // ============================================
        get_template_part('template-parts/curso/curso', 'infos-rapidas');
        
        // ============================================
        // SEÇÃO 3: CONTEÚDO PRINCIPAL
        // ============================================
        get_template_part('template-parts/curso/curso', 'conteudo');
        
        // ============================================
        // SEÇÃO 4: CURSOS RELACIONADOS
        // ============================================
        get_template_part('template-parts/curso/curso', 'relacionados');
        
    endwhile;
    ?>
</main>

<?php
get_footer();
