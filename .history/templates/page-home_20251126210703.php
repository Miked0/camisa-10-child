<?php
/**
 * Template Name: Home Page
 * Versão: 2.1 - HOTFIX
 */

get_header();
?>

<main id="primary" class="site-main">

    <?php
    // Hero Banner Section
    get_template_part('template-parts/hero-banner');
    ?>

    <?php
    // Sobre Section
    $sobre_titulo = camisa10_sanitize_text('home_sobre_titulo');
    $sobre_texto = camisa10_get_field('home_sobre_texto'); // PODE SER ARRAY OU STRING
    $sobre_cta_texto = camisa10_sanitize_text('home_sobre_cta_texto');
    $sobre_cta_url = camisa10_sanitize_url('home_sobre_cta_url');
    $sobre_imagem = camisa10_get_image('home_sobre_imagem', false, 'large');

    if (!empty($sobre_titulo) || !empty($sobre_texto)) :
    ?>
    <section class="sobre-section">
        <div class="container">
            <div class="sobre-grid">
                
                <div class="sobre-content">
                    <?php if (!empty($sobre_titulo)) : ?>
                    <h2><?php echo esc_html($sobre_titulo); ?></h2>
                    <?php endif; ?>

                    <?php if (!empty($sobre_texto)) : ?>
                    <div class="sobre-texto">
                        <?php 
                        // CORREÇÃO: Verificar se é array ou string
                        if (is_array($sobre_texto)) {
                            // Se for array, pode ser rich text do ACF - não processar
                            echo '<p>Configure o campo "Sobre Texto" no ACF como Editor WYSIWYG ou Text Area</p>';
                        } else {
                            // Se for string, sanitizar e exibir
                            echo wp_kses_post($sobre_texto); 
                        }
                        ?>
                    </div>
                    <?php endif; ?>

                    <?php if (!empty($sobre_cta_texto) && !empty($sobre_cta_url)) : ?>
                    <a href="<?php echo esc_url($sobre_cta_url); ?>" class="btn btn--primary">
                        <?php echo esc_html($sobre_cta_texto); ?>
                    </a>
                    <?php endif; ?>
                </div>

                <?php if ($sobre_imagem) : ?>
                <div class="sobre-image">
                    <img 
                        src="<?php echo esc_url($sobre_imagem['url']); ?>" 
                        alt="<?php echo esc_attr($sobre_imagem['alt']); ?>"
                        loading="lazy"
                    >
                </div>
                <?php endif; ?>

            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- RESTO DO CÓDIGO CONTINUA IGUAL... -->
