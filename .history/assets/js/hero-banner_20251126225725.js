/**
 * Hero Banner JS
 * @version 5.0.0
 */

(function($) {
    'use strict';

    $(document).ready(function() {
        console.log('🚀 Hero Banner - Inicializando');

        if (typeof bootstrap === 'undefined') {
            console.error('❌ Bootstrap não carregado!');
            return;
        }

        const carouselEl = document.getElementById('heroCarousel');
        if (!carouselEl) {
            console.error('❌ #heroCarousel não encontrado!');
            return;
        }

        const heroCarousel = new bootstrap.Carousel(carouselEl, {
            interval: 6000,
            pause: 'hover',
            wrap: true,
            keyboard: true,
            touch: true
        });

        console.log('✅ Carousel inicializado!');
    });

})(jQuery);
