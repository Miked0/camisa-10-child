/**
 * Hero Banner JS - Auto-Fix Bootstrap
 * @version 5.1.0 - GARANTIDO FUNCIONAR
 */

(function($) {
    'use strict';

    console.log('═══════════════════════════════════════');
    console.log('🚀 HERO CAROUSEL - INICIANDO');
    console.log('═══════════════════════════════════════');

    // Função principal de inicialização
    function initHeroCarousel() {
        
        // ============================================
        // VERIFICAÇÃO 1: JQUERY
        // ============================================
        if (typeof $ === 'undefined' || typeof jQuery === 'undefined') {
            console.error('❌ jQuery não carregado!');
            return false;
        }
        console.log('✅ jQuery:', $.fn.jquery);

        // ============================================
        // VERIFICAÇÃO 2: BOOTSTRAP
        // ============================================
        if (typeof bootstrap === 'undefined') {
            console.error('❌ Bootstrap não carregado!');
            console.log('🔧 Tentando carregar Bootstrap dinamicamente...');
            
            // Tentar carregar Bootstrap via CDN
            const bootstrapJS = document.createElement('script');
            bootstrapJS.src = 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js';
            bootstrapJS.onload = function() {
                console.log('✅ Bootstrap carregado via CDN!');
                setTimeout(initHeroCarousel, 500);
            };
            document.head.appendChild(bootstrapJS);
            return false;
        }
        console.log('✅ Bootstrap carregado');

        // ============================================
        // VERIFICAÇÃO 3: ELEMENTO #heroCarousel
        // ============================================
        const carouselEl = document.getElementById('heroCarousel');
        if (!carouselEl) {
            console.error('❌ Elemento #heroCarousel NÃO encontrado no DOM!');
            console.log('Elementos .carousel encontrados:', $('.carousel').length);
            return false;
        }
        console.log('✅ Elemento #heroCarousel encontrado');

        // ============================================
        // VERIFICAÇÃO 4: SLIDES
        // ============================================
        const slides = carouselEl.querySelectorAll('.carousel-item');
        console.log('📊 Total de slides:', slides.length);
        
        if (slides.length === 0) {
            console.error('❌ Nenhum slide (.carousel-item) encontrado!');
            return false;
        }

        // Garantir que pelo menos um slide tenha a classe .active
        const activeSlide = carouselEl.querySelector('.carousel-item.active');
        if (!activeSlide) {
            console.warn('⚠️ Nenhum slide com .active - adicionando ao primeiro');
            slides[0].classList.add('active');
        }

        // ============================================
        // INICIALIZAR CAROUSEL
        // ============================================
        try {
            // Destruir instância anterior se existir
            const existingInstance = bootstrap.Carousel.getInstance(carouselEl);
            if (existingInstance) {
                console.log('🔄 Destruindo instância anterior...');
                existingInstance.dispose();
            }

            // Criar nova instância
            const heroCarousel = new bootstrap.Carousel(carouselEl, {
                interval: 6000,      // 6 segundos
                pause: 'hover',      // Pausar ao passar mouse
                wrap: true,          // Loop infinito
                keyboard: true,      // Setas do teclado
                touch: true,         // Swipe em mobile
                ride: 'carousel'     // Auto-start
            });

            // Salvar instância globalmente
            window.heroCarousel = heroCarousel;

            console.log('✅ CAROUSEL INICIALIZADO COM SUCESSO!');
            console.log('Instance:', heroCarousel);

            // ============================================
            // EVENT LISTENERS
            // ============================================
            carouselEl.addEventListener('slide.bs.carousel', function(event) {
                console.log('🔄 Mudando para slide:', event.to + 1);
            });

            carouselEl.addEventListener('slid.bs.carousel', function(event) {
                console.log('✅ Slide ativo:', event.to + 1);
            });

            // ============================================
            // TESTE AUTOMÁTICO
            // ============================================
            setTimeout(function() {
                console.log('🧪 TESTE: Forçando mudança de slide...');
                heroCarousel.next();
            }, 3000);

            return true;

        } catch (error) {
            console.error('❌ ERRO ao inicializar carousel:', error);
            console.log('Stack:', error.stack);
            return false;
        }
    }

    // ============================================
    // INICIALIZAR AO CARREGAR O DOM
    // ============================================
    $(document).ready(function() {
        console.log('📄 DOM pronto - aguardando 300ms...');
        
        // Aguardar um pouco para garantir que tudo carregou
        setTimeout(function() {
            const success = initHeroCarousel();
            
            if (success) {
                console.log('═══════════════════════════════════════');
                console.log('✅ HERO CAROUSEL TOTALMENTE FUNCIONAL');
                console.log('═══════════════════════════════════════');
            } else {
                console.log('═══════════════════════════════════════');
                console.log('❌ FALHA AO INICIALIZAR CAROUSEL');
                console.log('Verifique os erros acima');
                console.log('═══════════════════════════════════════');
            }
        }, 300);
    });

    // ============================================
    // FALLBACK: Tentar novamente após window.load
    // ============================================
    $(window).on('load', function() {
        if (!window.heroCarousel) {
            console.log('⚠️ Carousel não inicializado - tentando novamente...');
            initHeroCarousel();
        }
    });

})(jQuery);
