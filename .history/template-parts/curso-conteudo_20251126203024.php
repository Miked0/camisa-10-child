<?php
/**
 * Conteúdo Principal do Curso
 * Seções: Info do Curso (3-4 blocos) + FAQ + Depoimentos
 * 
 * @package Camisa10_Child
 * @since 1.0.0
 * 
 * Acessibilidade: WCAG 2.1 AA
 * - Headings hierárquicos (h2, h3)
 * - Accordion acessível (ARIA)
 * - Contraste adequado
 * 
 * Integração:
 * - ACF PRO (campos repetidores)
 * - Post Meta (fallback)
 * - Layouts anteriores (FAQ e Depoimentos)
 */

// Segurança
if (!defined('ABSPATH')) {
    exit;
}

$curso_id = get_the_ID();

// ============================================
// SEÇÃO 1: INFORMAÇÕES DO CURSO (ACF Repeater)
// ============================================

$info_blocos = [];

// Tenta ACF PRO primeiro
if (function_exists('have_rows')) {
    if (have_rows('curso_info_blocos')) {
        while (have_rows('curso_info_blocos')) {
            the_row();
            $info_blocos[] = [
                'titulo' => get_sub_field('titulo'),
                'descricao' => get_sub_field('descricao'),
                'icone' => get_sub_field('icone') // opcional
            ];
        }
    }
}

// Fallback: Post Meta serializado
if (empty($info_blocos)) {
    $info_blocos_meta = get_post_meta($curso_id, 'curso_info_blocos', true);
    
    if (is_array($info_blocos_meta)) {
        $info_blocos = $info_blocos_meta;
    } else {
        // Fallback estático (pode ser removido em produção)
        $info_blocos = [
            [
                'titulo' => 'O que você vai aprender',
                'descricao' => 'Desenvolva habilidades práticas e estratégicas para alta performance profissional.',
                'icone' => 'lightbulb'
            ],
            [
                'titulo' => 'Metodologia',
                'descricao' => 'Aulas práticas com cases reais, exercícios aplicados e mentorias personalizadas.',
                'icone' => 'graduation-cap'
            ],
            [
                'titulo' => 'Certificação',
                'descricao' => 'Certificado reconhecido no mercado ao concluir todas as etapas do curso.',
                'icone' => 'award'
            ]
        ];
    }
}

// ============================================
// SEÇÃO 2: FAQ (Perguntas Frequentes)
// ============================================

$faq_items = [];

// Tenta ACF PRO primeiro
if (function_exists('have_rows')) {
    if (have_rows('curso_faq')) {
        while (have_rows('curso_faq')) {
            the_row();
            $faq_items[] = [
                'pergunta' => get_sub_field('pergunta'),
                'resposta' => get_sub_field('resposta')
            ];
        }
    }
}

// Fallback: Post Meta
if (empty($faq_items)) {
    $faq_meta = get_post_meta($curso_id, 'curso_faq', true);
    
    if (is_array($faq_meta)) {
        $faq_items = $faq_meta;
    } else {
        // Fallback estático
        $faq_items = [
            [
                'pergunta' => 'Qual é a carga horária do curso?',
                'resposta' => 'O curso tem carga horária total de ' . (get_field('curso_carga_horaria') ?: '40') . ' horas, divididas em módulos práticos e teóricos.'
            ],
            [
                'pergunta' => 'Preciso ter conhecimento prévio?',
                'resposta' => 'Não é necessário conhecimento prévio. O curso é estruturado para atender desde iniciantes até profissionais que buscam aprimoramento.'
            ],
            [
                'pergunta' => 'Como funciona o certificado?',
                'resposta' => 'Ao concluir 100% das aulas e atividades, você recebe automaticamente o certificado digital reconhecido pelo mercado.'
            ]
        ];
    }
}

// ============================================
// SEÇÃO 3: DEPOIMENTOS (Provas Sociais)
// ============================================

$depoimentos = [];

// Tenta ACF PRO primeiro
if (function_exists('have_rows')) {
    if (have_rows('curso_depoimentos')) {
        while (have_rows('curso_depoimentos')) {
            the_row();
            $depoimentos[] = [
                'nome' => get_sub_field('nome'),
                'cargo' => get_sub_field('cargo'),
                'empresa' => get_sub_field('empresa'),
                'depoimento' => get_sub_field('depoimento'),
                'foto' => get_sub_field('foto') // URL da imagem
            ];
        }
    }
}

// Fallback: Post Meta
if (empty($depoimentos)) {
    $depoimentos_meta = get_post_meta($curso_id, 'curso_depoimentos', true);
    
    if (is_array($depoimentos_meta)) {
        $depoimentos = $depoimentos_meta;
    }
}

// Ícones SVG para Info Blocos
$icones_map = [
    'lightbulb' => '<path d="M12 2a7 7 0 00-7 7c0 2.38 1.19 4.47 3 5.74V17a1 1 0 001 1h6a1 1 0 001-1v-2.26c1.81-1.27 3-3.36 3-5.74a7 7 0 00-7-7zm-3 16v1a1 1 0 001 1h4a1 1 0 001-1v-1H9z" fill="currentColor"/>',
    'graduation-cap' => '<path d="M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3zm6.82 6L12 12.72 5.18 9 12 5.28 18.82 9zM17 15.99l-5 2.73-5-2.73v-3.72L12 15l5-2.73v3.72z" fill="currentColor"/>',
    'award' => '<path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" fill="currentColor"/>',
    'default' => '<circle cx="12" cy="12" r="10" fill="currentColor"/>'
];
?>

<section id="curso-conteudo" class="curso-conteudo-principal">
    <div class="container">
        
        <!-- ==================
             INFO DO CURSO
             ================== -->
        <?php if (!empty($info_blocos)) : ?>
        <div class="info-curso-section">
            <h2 class="section-titulo">Sobre o Curso</h2>
            
            <div class="info-blocos-grid">
                <?php foreach ($info_blocos as $index => $bloco) : 
                    $icone = $bloco['icone'] ?? 'default';
                    $icone_svg = $icones_map[$icone] ?? $icones_map['default'];
                ?>
                
                <article class="info-bloco" data-aos="fade-up" data-aos-delay="<?php echo ($index * 100); ?>">
                    <div class="info-bloco__icone" aria-hidden="true">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none">
                            <?php echo $icone_svg; ?>
                        </svg>
                    </div>
                    
                    <h3 class="info-bloco__titulo">
                        <?php echo esc_html($bloco['titulo']); ?>
                    </h3>
                    
                    <div class="info-bloco__descricao">
                        <?php echo wp_kses_post($bloco['descricao']); ?>
                    </div>
                </article>
                
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- ==================
             FAQ (ACCORDION)
             ================== -->
        <?php if (!empty($faq_items)) : ?>
        <div class="faq-section">
            <h2 class="section-titulo">Perguntas Frequentes</h2>
            
            <div class="faq-accordion" role="region" aria-label="Perguntas frequentes sobre o curso">
                <?php foreach ($faq_items as $index => $faq) : 
                    $accordion_id = 'faq-' . $curso_id . '-' . $index;
                ?>
                
                <div class="faq-item">
                    <button 
                        type="button"
                        class="faq-pergunta"
                        aria-expanded="false"
                        aria-controls="<?php echo esc_attr($accordion_id); ?>"
                        id="<?php echo esc_attr($accordion_id . '-btn'); ?>"
                    >
                        <span class="faq-pergunta__texto">
                            <?php echo esc_html($faq['pergunta']); ?>
                        </span>
                        <svg class="faq-icone" width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M19 9l-7 7-7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                    
                    <div 
                        id="<?php echo esc_attr($accordion_id); ?>"
                        class="faq-resposta"
                        role="region"
                        aria-labelledby="<?php echo esc_attr($accordion_id . '-btn'); ?>"
                        hidden
                    >
                        <div class="faq-resposta__conteudo">
                            <?php echo wp_kses_post(wpautop($faq['resposta'])); ?>
                        </div>
                    </div>
                </div>
                
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- ==================
             DEPOIMENTOS
             ================== -->
        <?php if (!empty($depoimentos)) : ?>
        <div class="depoimentos-section">
            <h2 class="section-titulo">O que nossos alunos dizem</h2>
            
            <div class="depoimentos-grid">
                <?php foreach ($depoimentos as $index => $depoimento) : 
                    $foto_url = $depoimento['foto'] ?? '';
                    $iniciais = '';
                    
                    // Gera iniciais se não houver foto
                    if (empty($foto_url)) {
                        $nome_partes = explode(' ', $depoimento['nome']);
                        $iniciais = strtoupper(substr($nome_partes[0], 0, 1));
                        if (isset($nome_partes[1])) {
                            $iniciais .= strtoupper(substr($nome_partes[1], 0, 1));
                        }
                    }
                ?>
                
                <article class="depoimento-card" data-aos="fade-up" data-aos-delay="<?php echo ($index * 150); ?>">
                    <blockquote class="depoimento-quote">
                        <svg class="quote-icon" width="32" height="32" viewBox="0 0 32 32" fill="none" aria-hidden="true">
                            <path d="M10 14c0-3.3 2.7-6 6-6V6c-4.4 0-8 3.6-8 8v12h8v-8h-6v-4zm16 0c0-3.3 2.7-6 6-6V6c-4.4 0-8 3.6-8 8v12h8v-8h-6v-4z" fill="currentColor" opacity="0.1"/>
                        </svg>
                        
                        <p class="depoimento-texto">
                            <?php echo esc_html($depoimento['depoimento']); ?>
                        </p>
                    </blockquote>
                    
                    <footer class="depoimento-autor">
                        <div class="autor-avatar">
                            <?php if ($foto_url) : ?>
                                <img 
                                    src="<?php echo esc_url($foto_url); ?>" 
                                    alt="<?php echo esc_attr($depoimento['nome']); ?>"
                                    loading="lazy"
                                    width="56"
                                    height="56"
                                />
                            <?php else : ?>
                                <span class="avatar-iniciais"><?php echo esc_html($iniciais); ?></span>
                            <?php endif; ?>
                        </div>
                        
                        <div class="autor-info">
                            <cite class="autor-nome"><?php echo esc_html($depoimento['nome']); ?></cite>
                            <p class="autor-cargo">
                                <?php 
                                $cargo_empresa = esc_html($depoimento['cargo']);
                                if (!empty($depoimento['empresa'])) {
                                    $cargo_empresa .= ' | ' . esc_html($depoimento['empresa']);
                                }
                                echo $cargo_empresa;
                                ?>
                            </p>
                        </div>
                    </footer>
                </article>
                
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
        
    </div>
</section>

<!-- JavaScript para FAQ Accordion -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const faqButtons = document.querySelectorAll('.faq-pergunta');
    
    faqButtons.forEach(button => {
        button.addEventListener('click', function() {
            const isExpanded = this.getAttribute('aria-expanded') === 'true';
            const targetId = this.getAttribute('aria-controls');
            const targetContent = document.getElementById(targetId);
            
            // Toggle estado
            this.setAttribute('aria-expanded', !isExpanded);
            targetContent.hidden = isExpanded;
            
            // Anima ícone
            this.classList.toggle('is-active', !isExpanded);
            
            // Scroll suave se necessário
            if (!isExpanded) {
                setTimeout(() => {
                    this.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                }, 300);
            }
        });
    });
});
</script>

<!-- Schema.org para FAQ -->
<?php if (!empty($faq_items)) : ?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    <?php foreach ($faq_items as $index => $faq) : ?>
    {
      "@type": "Question",
      "name": "<?php echo esc_js($faq['pergunta']); ?>",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "<?php echo esc_js(wp_strip_all_tags($faq['resposta'])); ?>"
      }
    }<?php echo $index < count($faq_items) - 1 ? ',' : ''; ?>
    <?php endforeach; ?>
  ]
}
</script>
<?php endif; ?>
