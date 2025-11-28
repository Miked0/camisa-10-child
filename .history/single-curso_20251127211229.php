<?php
/**
 * Template para exibição de curso individual
 * @package Camisa10
 * @version 8.1.0 - FULL-WIDTH LAYOUT
 * @updated 2025-11-27
 * 
 * ESTRUTURA FULL-WIDTH:
 * - Hero Section: Full-width com background gradient
 * - Conteúdo Principal: Grid 2 colunas (conteúdo + sidebar)
 * - Cursos Relacionados: Full-width com background
 * 
 * CORREÇÕES:
 * - Removido CSS inline (já carregado via functions.php)
 * - Estrutura HTML reorganizada para layout full-width
 * - Wrappers semânticos adicionados (<section>, <aside>)
 * - Grid 2 colunas implementado corretamente
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

while (have_posts()) : the_post();
    $curso_id = get_the_ID();
?>

<!-- ============================================
     HERO SECTION - Full Width com Background Azul
     ============================================ -->
<section class="curso-hero-section">
    <div class="curso-hero-content">
        <?php 
        /**
         * Template Part: Hero Banner
         * Contém: Breadcrumb, Categoria, Título, Descrição, Meta Info
         * Localização: /template-parts/curso/curso-hero.php
         */
        get_template_part('template-parts/curso/curso', 'hero'); 
        ?>
    </div>
</section>

<!-- ============================================
     CONTEÚDO PRINCIPAL - Grid 2 Colunas
     Layout: Conteúdo (70%) + Sidebar (30%)
     ============================================ -->
<section class="curso-conteudo-section">
    <div class="curso-container">
        
        <!-- ========================================
             COLUNA ESQUERDA: Conteúdo do Curso
             ======================================== -->
        <div class="curso-conteudo-principal">
            <?php 
            /**
             * Template Part: Conteúdo Principal
             * Contém: Descrição, O que aprenderá, Conteúdo programático,
             *         Requisitos, FAQ, Depoimentos
             * Localização: /template-parts/curso/curso-conteudo.php
             */
            get_template_part('template-parts/curso/curso', 'conteudo'); 
            ?>
        </div>
        
        <!-- ========================================
             COLUNA DIREITA: Sidebar com Infos Rápidas
             Sticky sidebar que acompanha scroll
             ======================================== -->
        <aside class="curso-sidebar">
            <?php 
            /**
             * Template Part: Infos Rápidas (Sidebar)
             * Contém: Preço, Duração, Nível, Certificado, CTA Comprar
             * Localização: /template-parts/curso/curso-infos-rapidas.php
             */
            get_template_part('template-parts/curso/curso', 'infos-rapidas'); 
            ?>
        </aside>
        
    </div>
</section>

<!-- ============================================
     CURSOS RELACIONADOS - Full Width
     Background cinza claro com grid de cards
     ============================================ -->
<section class="cursos-relacionados-section">
    <?php 
    /**
     * Template Part: Cursos Relacionados
     * Contém: Grid de cards de cursos da mesma categoria
     * Localização: /template-parts/curso/curso-relacionados.php
     */
    get_template_part('template-parts/curso/curso', 'relacionados'); 
    ?>
</section>

<?php 
endwhile;

get_footer();
?>
