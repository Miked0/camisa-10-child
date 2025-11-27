/**
 * Hero Banner Slider - Camisa 10
 * Controla o carousel principal usando Bootstrap 5
 * @package OneKorse Child
 * @since 2.0.0
 * @requires Bootstrap 5
 */

(function($) {
    'use strict';

    // Variável global para instância do carousel
    window.heroBannerCarousel = null;

    $(document).ready(function() {
        
        // ============================================
        // VERIFICAR DEPENDÊNCIAS
        // ============================================
        if (typeof bootstrap === 'undefined') {
            console.error('❌ Bootstrap 5 não está carregado!');
            return;
        }

        const carouselEl = document.getElementById('heroCarousel');
        
        if (!carouselEl) {
            console.warn('⚠️ Hero Carousel não encontrado - ignorando inicialização');
            return;
        }

        // ============================================
        // INICIALIZAR BOOTSTRAP CAROUSEL
        // ============================================
        try {
            window.heroBannerCarousel = new bootstrap.Carousel(carouselEl, {
                interval: 5000,        // 5 segundos entre slides
                pause: 'hover',        // Pausar ao passar mouse
                wrap: true,            // Loop infinito
                keyboard: true,        // Navegação por teclado
                touch: true            // Suporte a touch/swipe
            });

            console.log('✅ Hero Carousel (Bootstrap 5) inicializado');

            // ============================================
            // EVENT LISTENERS
            // ============================================
            
            // Tracking de mudança de slide
            carouselEl.addEventListener('slide.bs.carousel', function(event) {
                console.log('Carousel: Slide', event.to + 1);
                
                // Google Analytics
                if (typeof gtag !== 'undefined') {
                    gtag('event', 'hero_slide_change', {
                        'event_category': 'Engagement',
                        'event_label': 'Slide ' + (event.to + 1)
                    });
                }
            });

            // Pausar ao focar (acessibilidade)
            carouselEl.addEventListener('focus', function() {
                if (window.heroBannerCarousel) {
                    window.heroBannerCarousel.pause();
                }
            }, true);

            // Retomar ao desfocar
            carouselEl.addEventListener('blur', function() {
                if (window.heroBannerCarousel) {
                    window.heroBannerCarousel.cycle();
                }
            }, true);

        } catch (error) {
            console.error('❌ Erro ao inicializar Hero Carousel:', error);
        }

        // ============================================
        // MODAL DE VÍDEO (se existir)
        // ============================================
        const $videoModal = $('#video-modal');
        const $videoIframe = $('#video-iframe');

        $('.btn[data-video-id]').on('click', function(e) {
            e.preventDefault();
            
            const videoId = $(this).data('video-id');
            const videoUrl = `https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0`;

            $videoIframe.attr('src', videoUrl);
            $videoModal.addClass('active').fadeIn(300);
            $('body').css('overflow', 'hidden');

            // Pausar carousel
            if (window.heroBannerCarousel) {
                window.heroBannerCarousel.pause();
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
        }

        $('.video-modal-close, .video-modal-overlay').on('click', closeVideoModal);

        // ESC para fechar
        $(document).on('keydown', function(e) {
            if (e.key === 'Escape' && $videoModal.hasClass('active')) {
                closeVideoModal();
            }
        });

        // ============================================
        // BUSCA NO HERO (se existir)
        // ============================================
        $('.hero-search-form, .search-form').on('submit', function(e) {
            const searchValue = $(this).find('input[type="text"], input[type="search"]').val().trim();
            
            if (searchValue === '') {
                e.preventDefault();
                
                const $input = $(this).find('input[type="text"], input[type="search"]');
                $input.focus().addClass('shake');
                
                setTimeout(function() {
                    $input.removeClass('shake');
                }, 500);
            } else {
                // Google Analytics
                if (typeof gtag !== 'undefined') {
                    gtag('event', 'hero_search', {
                        'event_category': 'Engagement',
                        'event_label': searchValue
                    });
                }
            }
        });

        console.log('✅ Hero Banner Scripts carregados');
    });

})(jQuery);
