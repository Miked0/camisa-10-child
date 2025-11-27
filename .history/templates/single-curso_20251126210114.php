<?php
/**
 * Template for displaying single curso
 * Versão: 2.0 (corrigida)
 * 
 * @package Camisa10
 */

get_header();
?>

<main id="primary" class="site-main">

    <?php
    while (have_posts()) :
        the_post();
        
        // Hero Section
        get_template_part('template-parts/curso-hero');
        
        // Informações Rápidas
        get_template_part('template-parts/curso-infos-rapidas');
        
        // Conteúdo Programático
        get_template_part('template-parts/curso-conteudo');
        
        // Descrição Completa (se houver)
        if (has_content()) :
        ?>
        <section class="curso-descricao">
            <div class="container">
                <div class="curso-descricao__content">
                    <?php the_content(); ?>
                </div>
            </div>
        </section>
        <?php
        endif;
        
        // Cursos Relacionados
        get_template_part('template-parts/curso-relacionados');
        
    endwhile;
    ?>

</main>

<?php
get_footer();
