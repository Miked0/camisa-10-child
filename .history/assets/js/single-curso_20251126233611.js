/**
 * Single Curso - JavaScript
 * @version 8.0.0
 */

(function($) {
    'use strict';

    $(document).ready(function() {
        console.log('🎓 Single Curso - Inicializando');

        // ============================================
        // ACCORDION FAQ
        // ============================================
        $('.accordion-header').on('click', function() {
            const $item = $(this).closest('.accordion-item');
            const $collapse = $item.find('.accordion-collapse');
            
            // Se já está ativo, fecha
            if ($item.hasClass('active')) {
                $item.removeClass('active');
                $collapse.css('max-height', '0');
            } else {
                // Fecha outros
                $('.accordion-item.active').removeClass('active');
                $('.accordion-collapse').css('max-height', '0');
                
                // Abre o clicado
                $item.addClass('active');
                const scrollHeight = $collapse[0].scrollHeight;
                $collapse.css('max-height', scrollHeight + 'px');
            }
        });

        // ============================================
        // STICKY SIDEBAR (INFOS RÁPIDAS)
        // ============================================
        const $sidebar = $('.curso-infos-rapidas');
        const $heroSection = $('.curso-hero-section');
        
        if ($sidebar.length && $heroSection.length) {
            $(window).on('scroll', function() {
                const scrollTop = $(window).scrollTop();
                const heroHeight = $heroSection.outerHeight();
                
                // Adiciona classe sticky quando passar do hero
                if (scrollTop > heroHeight - 120) {
                    $sidebar.addClass('is-sticky');
                } else {
                    $sidebar.removeClass('is-sticky');
                }
            });
        }

        // ============================================
        // SMOOTH SCROLL PARA ÂNCORAS
        // ============================================
        $('a[href^="#"]').on('click', function(e) {
            const target = $(this.hash);
            
            if (target.length) {
                e.preventDefault();
                
                $('html, body').animate({
                    scrollTop: target.offset().top - 100
                }, 600, 'swing');
            }
        });

        // ============================================
        // BOTÃO COMPRAR - TRACKING
        // ============================================
        $('.curso-btn-comprar').on('click', function() {
            const cursoTitulo = $('.curso-titulo').text().trim();
            const cursoPreco = $('.preco-atual').text().trim();
            
            console.log('🛒 Clique em Comprar:', cursoTitulo, cursoPreco);
            
            // Google Analytics
            if (typeof gtag !== 'undefined') {
                gtag('event', 'curso_comprar_click', {
                    'event_category': 'Curso',
                    'event_label': cursoTitulo,
                    'value': cursoPreco
                });
            }
        });

        // ============================================
        // LAZY LOADING DE IMAGENS
        // ============================================
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver(function(entries, observer) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.remove('lazy');
                        imageObserver.unobserve(img);
                    }
                });
            });

            document.querySelectorAll('img.lazy').forEach(function(img) {
                imageObserver.observe(img);
            });
        }

        // ============================================
        // ANIMAÇÃO DE ENTRADA DOS ELEMENTOS
        // ============================================
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const fadeInObserver = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('fade-in-visible');
                }
            });
        }, observerOptions);

        // Elementos para animar
        document.querySelectorAll('.info-bloco-card, .accordion-item, .depoimento-card, .curso-card').forEach(function(el) {
            el.classList.add('fade-in-element');
            fadeInObserver.observe(el);
        });

        console.log('✅ Single Curso carregado com sucesso!');
    });

})(jQuery);
