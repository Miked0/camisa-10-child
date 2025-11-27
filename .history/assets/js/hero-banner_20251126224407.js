/**
 * Hero Banner Scripts - Camisa 10
 * Compatível com Bootstrap 5 Carousel
 * @package Camisa10
 * @version 3.0.0
 * @requires jQuery, Bootstrap 5
 */

(function($) {
    'use strict';

    // Variável global para instância do carousel
    window.heroBannerCarousel = null;

    $(document).ready(function() {
        console.log('🚀 Iniciando Hero Banner Scripts v3.0');

        // ============================================
        // VERIFICAR DEPENDÊNCIAS
        // ============================================
        if (typeof bootstrap === 'undefined') {
            console.error('❌ Bootstrap 5 não está carregado!');
            return;
        }

        if (typeof $ === 'undefined') {
            console.error('❌ jQuery não está carregado!');
            return;
        }

        const carouselEl = document.getElementById('heroCarousel');
        
        if (!carouselEl) {
            console.warn('⚠️ Hero Carousel (#heroCarousel) não encontrado');
            return;
        }

        console.log('✅ Dependências verificadas');
        console.log('✅ Elemento #heroCarousel encontrado');

        // ============================================
        // INICIALIZAR BOOTSTRAP 5 CAROUSEL
        // ============================================
        try {
            window.heroBannerCarousel = new bootstrap.Carousel(carouselEl, {
                interval: 6000,        // 6 segundos entre slides
                pause: 'hover',        // Pausar ao passar mouse
                wrap: true,            // Loop infinito
                keyboard: true,        // Navegação por teclado (setas)
                touch: true,           // Suporte a touch/swipe
                ride: 'carousel'       // Auto-iniciar
            });

            console.log('✅ Bootstrap Carousel inicializado');

            // ============================================
            // EVENT LISTENERS DO CAROUSEL
            // ============================================
            
            // Quando o slide começa a mudar
            carouselEl.addEventListener('slide.bs.carousel', function(event) {
                console.log('📊 Slide mudando para:', event.to + 1);
                
                // Google Analytics (se disponível)
                if (typeof gtag !== 'undefined') {
                    gtag('event', 'hero_slide_change', {
                        'event_category': 'Hero Banner',
                        'event_label': 'Slide ' + (event.to + 1),
                        'value': event.to + 1
                    });
                }
            });

            // Quando o slide termina a transição
            carouselEl.addEventListener('slid.bs.carousel', function(event) {
                console.log('✅ Slide alterado para:', event.to + 1);
            });

            // Pausar ao focar (acessibilidade)
            carouselEl.addEventListener('focus', function() {
                if (window.heroBannerCarousel) {
                    window.heroBannerCarousel.pause();
                    console.log('⏸️ Carousel pausado (focus)');
                }
            }, true);

            // Retomar ao desfocar
            carouselEl.addEventListener('blur', function() {
                if (window.heroBannerCarousel) {
                    window.heroBannerCarousel.cycle();
                    console.log('▶️ Carousel retomado (blur)');
                }
            }, true);

        } catch (error) {
            console.error('❌ Erro ao inicializar Bootstrap Carousel:', error);
            return;
        }

        // ============================================
        // MODAL DE VÍDEO
        // ============================================
        const $videoModal = $('#video-modal');
        const $videoIframe = $('#video-iframe');

        // Abrir modal ao clicar no botão com data-video-id
        $('.btn-gradient[data-video-id], .btn[data-video-id]').on('click', function(e) {
            e.preventDefault();
            
            const videoId = $(this).data('video-id');
            if (!videoId) {
                console.warn('⚠️ Video ID não encontrado');
                return;
            }
            
            const videoUrl = `https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0&modestbranding=1`;
            
            $videoIframe.attr('src', videoUrl);
            $videoModal.addClass('active').fadeIn(300);
            $('body').css('overflow', 'hidden');
            
            // Pausar carousel
            if (window.heroBannerCarousel) {
                window.heroBannerCarousel.pause();
            }
            
            console.log('🎥 Modal de vídeo aberto:', videoId);
            
            // Google Analytics
            if (typeof gtag !== 'undefined') {
                gtag('event', 'video_open', {
                    'event_category': 'Hero Banner',
                    'event_label': 'Video ID: ' + videoId
                });
            }
        });

        // Fechar modal
        function closeVideoModal() {
            $videoIframe.attr('src', '');
            $videoModal.removeClass('active').fadeOut(300);
            $('body').css('overflow', '');
            
            // Retomar carousel
            if (window.heroBannerCarousel) {
                window.heroBannerCarousel.cycle();
            }
            
            console.log('❌ Modal de vídeo fechado');
        }

        // Eventos de fechar
        $('.video-modal-close, .video-modal-overlay').on('click', closeVideoModal);

        // ESC para fechar
        $(document).on('keydown', function(e) {
            if (e.key === 'Escape' && $videoModal.hasClass('active')) {
                closeVideoModal();
            }
        });

        // ============================================
        // BUSCA NO HERO
        // ============================================
        $('.hero-search-form, .search-form').on('submit', function(e) {
            const searchValue = $(this).find('input[type="search"], .search-input').val().trim();
            
            if (searchValue === '') {
                e.preventDefault();
                
                const $input = $(this).find('input[type="search"], .search-input');
                $input.focus().addClass('shake');
                
                setTimeout(function() {
                    $input.removeClass('shake');
                }, 500);
                
                console.warn('⚠️ Busca vazia - validação acionada');
            } else {
                console.log('🔍 Busca realizada:', searchValue);
                
                // Google Analytics
                if (typeof gtag !== 'undefined') {
                    gtag('event', 'search', {
                        'event_category': 'Hero Banner',
                        'event_label': searchValue,
                        'search_term': searchValue
                    });
                }
            }
        });

        // ============================================
        // INICIALIZAR AOS (SE DISPONÍVEL)
        // ============================================
        if (typeof AOS !== 'undefined') {
            AOS.init({
                duration: 600,
                easing: 'ease-out',
                once: false,
                mirror: true,
                offset: 50
            });
            console.log('✅ AOS Animations inicializado');
        }

        // ============================================
        // STATUS FINAL
        // ============================================
        console.log('═══════════════════════════════════════');
        console.log('✅ HERO BANNER - TOTALMENTE INICIALIZADO');
        console.log('═══════════════════════════════════════');
        console.log('📊 Carousel Instance:', window.heroBannerCarousel);
        console.log('🎯 Total de Slides:', $('#heroCarousel .carousel-item').length);
        console.log('═══════════════════════════════════════');
    });

})(jQuery);
