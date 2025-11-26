/**
 * Single Curso - JavaScript
 * FAQ Accordion e interações
 * 
 * @package Camisa10_Child
 * @version 1.0.0
 */

(function($) {
    'use strict';
    
    $(document).ready(function() {
        
        // ========================================
        // FAQ ACCORDION
        // ========================================
        
        $('.faq-pergunta').on('click', function(e) {
            e.preventDefault();
            
            const $button = $(this);
            const $resposta = $button.next('.faq-resposta');
            const isActive = $button.hasClass('is-active');
            
            // Fecha todos os outros
            $('.faq-pergunta').removeClass('is-active').attr('aria-expanded', 'false');
            $('.faq-resposta').attr('hidden', true).slideUp(300);
            
            // Abre o clicado (se não estava ativo)
            if (!isActive) {
                $button.addClass('is-active').attr('aria-expanded', 'true');
                $resposta.removeAttr('hidden').slideDown(300);
                
                // Scroll suave até a pergunta
                setTimeout(function() {
                    $('html, body').animate({
                        scrollTop: $button.offset().top - 100
                    }, 300);
                }, 350);
            }
        });
        
        // ========================================
        // SMOOTH SCROLL PARA ÂNCORAS
        // ========================================
        
        $('a[href^="#"]').on('click', function(e) {
            const target = $(this.getAttribute('href'));
            
            if (target.length) {
                e.preventDefault();
                $('html, body').stop().animate({
                    scrollTop: target.offset().top - 80
                }, 800, 'swing');
            }
        });
        
        // ========================================
        // LOG DE DEBUG (Remover em produção)
        // ========================================
        
        if (window.console && window.console.log) {
            console.log('Single Curso JS carregado com sucesso!');
        }
        
    });
    
})(jQuery);
