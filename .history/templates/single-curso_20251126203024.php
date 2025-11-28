<?php
/**
 * Template Name: Single Curso
 * 
 * @package Camisa10_Child
 * @version 2.0.0
 */

// Segurança
if (!defined('ABSPATH')) {
    exit;
}

get_header(); 
?>

<main id="main" class="site-main single-curso-main" role="main">
    
    <?php
    while (have_posts()) :
        the_post();
        
        // Template Parts
        get_template_part('template-parts/curso', 'hero');
        get_template_part('template-parts/curso', 'infos-rapidas');
        get_template_part('template-parts/curso', 'conteudo');
        get_template_part('template-parts/curso', 'relacionados');
        
    endwhile;
    ?>
    
</main>

<?php


get_footer();
