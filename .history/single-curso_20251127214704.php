<?php
/**
 * Template para exibição de curso individual
 * @package Camisa10
 * @version 8.3.1 - CURSO-RELACIONADOS TEMPORARIAMENTE DESATIVADO
 * @updated 2025-11-27
 * 
 * ESTRUTURA FULL-WIDTH:
 * - Hero Section: Full-width com background gradient
 * - Conteúdo Principal: Grid 2 colunas (conteúdo + sidebar)
 * - Cursos Relacionados: DESATIVADO (erro fatal linha 160)
 * 
 * CORREÇÕES APLICADAS:
 * - Wrappers semânticos (<section>, <aside>)
 * - Grid 2 colunas implementado
 * - Curso-relacionados comentado por erro PHP fatal
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
     CURSOS RELACIONADOS - TEMPORARIAMENTE DESATIVADO
     ============================================ -->
<?php 
/**
 * ⚠️ SEÇÃO DESATIVADA POR ERRO FATAL
 * 
 * Arquivo: /template-parts/curso/curso-relacionados.php
 * Erro: PHP Fatal error - TypeError: Illegal offset type
 * Linha: 160
 * Data: 28/11/2025 00:07:56 UTC
 * 
 * DESCRIÇÃO DO ERRO:
 * Tentando usar objeto ou array como chave de array PHP
 * Isso causa erro 500 (Internal Server Error) na página
 * 
 * IMPACTO:
 * - Página não carrega completamente
 * - Header renderiza sem CSS (fica gigante)
 * - Footer não renderiza
 * - Erro afeta todas as páginas de curso
 * 
 * PRÓXIMOS PASSOS:
 * 1. Enviar arquivo curso-relacionados.php para análise
 * 2. Identificar código problemático na linha 160
 * 3. Corrigir erro (provavelmente $array[$objeto] → $array[$objeto->ID])
 * 4. Reativar esta seção descomentando a linha abaixo
 * 
 * REATIVAR QUANDO CORRIGIDO:
 */
// get_template_part('template-parts/curso/curso', 'relacionados'); 
?>

<!-- ============================================
     FALLBACK TEMPORÁRIO: Mensagem ao Usuário
     (Opcional - Remover quando relacionados voltar)
     ============================================ -->
<section class="cursos-relacionados-section" style="padding: 80px 0; background: #F8F9FA; text-align: center;">
    <div style="max-width: 800px; margin: 0 auto; padding: 0 24px;">
        <h2 style="font-size: 2rem; color: #1A1A1A; margin-bottom: 16px;">
            Cursos Relacionados
        </h2>
        <p style="color: #777; font-size: 1.1rem;">
            Em breve mostraremos aqui outros cursos que podem te interessar.
        </p>
        <a href="<?php echo home_url('/cursos/'); ?>" 
           style="display: inline-block; margin-top: 24px; padding: 14px 32px; background: #0A3BE8; color: #FFFFFF; text-decoration: none; border-radius: 8px; font-weight: 700;">
            Ver Todos os Cursos
        </a>
    </div>
</section>

<?php 
endwhile;

get_footer();
?>
