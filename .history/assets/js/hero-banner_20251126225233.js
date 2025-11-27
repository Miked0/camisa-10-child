/**
 * Hero Banner JS - OneKorse Style
 * @version 4.0.0
 */

(function($) {
    'use strict';

    $(document).ready(function() {
        console.log('🚀 Hero Banner Carousel - Inicializando');

        // Verificar Bootstrap
        if (typeof bootstrap === 'undefined') {
            console.error('❌ Bootstrap não carregado!');
            return;
        }

        // Verificar elemento
        const carouselEl = document.getElementById('heroCarousel');
        if (!carouselEl) {
            console.error('❌ #heroCarousel não encontrado!');
            return;
        }

        // Inicializar carousel
        const heroCarousel = new bootstrap.Carousel(carouselEl, {
            interval: 6000,
            pause: 'hover',
            wrap: true,
            keyboard: true,
            touch: true
        });

        console.log('✅ Carousel inicializado com sucesso!');

        // Event tracking
        carouselEl.addEventListener('slid.bs.carousel', function(event) {
            console.log('📊 Slide ativo:', event.to + 1);
        });
    });

})(jQuery);
