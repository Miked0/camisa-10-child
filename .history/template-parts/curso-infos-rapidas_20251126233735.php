<?php
/**
 * Template Part: Infos Rápidas (Sidebar)
 * @package Camisa10
 */

if (!defined('ABSPATH')) {
    exit;
}

$curso_id = get_the_ID();

// CAMPOS ACF COM VALIDAÇÃO SEGURA
$carga_horaria = get_acf_safe('curso_carga_horaria', $curso_id, '40h');
$formato = get_acf_safe('curso_formato', $curso_id, 'Online');
$proxima_turma = get_acf_safe('curso_proxima_turma', $curso_id, 'Matrícula Aberta');

// PREÇOS
$preco = get_acf_number('curso_preco', $curso_id, 0, 'float');
$preco_promocional = get_acf_number('curso_preco_promocional', $curso_id, 0, 'float');

$tem_promocao = $preco_promocional > 0 && $preco_promocional < $preco;
$preco_exibir = $tem_promocao ? $preco_promocional : $preco;
$percentual_desconto = $tem_promocao ? round((($preco - $preco_promocional) / $preco) * 100) : 0;

// LINK DE COMPRA
$link_compra = get_acf_safe('curso_link_compra', $curso_id, '#');
?>

<aside class="curso-infos-rapidas">
    
    <h3 class="infos-rapidas-titulo">Informações do Curso</h3>

    <!-- Carga Horária -->
    <div class="info-rapida-item">
        <div class="info-rapida-icon">
            <i class="fas fa-clock"></i>
        </div>
        <div class="info-rapida-content">
            <div class="info-rapida-label">Carga horária</div>
            <div class="info-rapida-value"><?php echo esc_html($carga_horaria); ?></div>
        </div>
    </div>

    <!-- Formato -->
    <div class="info-rapida-item">
        <div class="info-rapida-icon">
            <i class="fas fa-laptop"></i>
        </div>
        <div class="info-rapida-content">
            <div class="info-rapida-label">Formato</div>
            <div class="info-rapida-value"><?php echo esc_html($formato); ?></div>
        </div>
    </div>

    <!-- Próxima Turma -->
    <div class="info-rapida-item">
        <div class="info-rapida-icon">
            <i class="fas fa-calendar"></i>
        </div>
        <div class="info-rapida-content">
            <div class="info-rapida-label">Próxima turma</div>
            <div class="info-rapida-value"><?php echo esc_html($proxima_turma); ?></div>
        </div>
    </div>

    <!-- PREÇO -->
    <div class="curso-preco-box">
        <?php if ($tem_promocao) : ?>
            <div class="preco-original">De R$ <?php echo number_format($preco, 2, ',', '.'); ?></div>
        <?php endif; ?>
        
        <div class="preco-atual">
            <?php
            if ($preco_exibir > 0) {
                echo 'R$ ' . number_format($preco_exibir, 2, ',', '.');
            } else {
                echo 'Gratuito';
            }
            ?>
        </div>

        <?php if ($tem_promocao) : ?>
            <span class="preco-desconto-badge"><?php echo $percentual_desconto; ?>% OFF</span>
        <?php endif; ?>
    </div>

    <!-- BOTÕES CTA -->
    <a href="<?php echo esc_url($link_compra); ?>" class="curso-btn-comprar" target="_blank" rel="noopener">
        <i class="fas fa-shopping-cart"></i> Comprar Agora
    </a>

    <a href="#conteudo" class="curso-btn-saiba-mais">
        <i class="fas fa-info-circle"></i> Saiba Mais
    </a>

</aside>
