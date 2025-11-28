/**
 * Camisa 10 - Single Curso Page
 * Versão: 2.0 (corrigida)
 * Dependências: jQuery
 */

(function($) {
    'use strict';

    // DOM Cache
    let DOM = {};

    /**
     * Cache DOM elements
     */
    function cacheDOMElements() {
        DOM = {
            accordions: $('.curso-accordion'),
            tabs: $('.curso-tabs'),
            shareButtons: $('.share-button'),
            enrollButton: $('.enroll-button'),
            cursoSidebar: $('.curso-sidebar'),
            relatedCursos: $('.related-cursos-slider')
        };

        return true;
    }

    /**
     * Setup accordion functionality
     */
    function setupAccordion() {
        if (DOM.accordions.length === 0) return;

        DOM.accordions.each(function() {
            const $accordion = $(this);
            const $items = $accordion.find('.accordion-item');

            $items.each(function() {
                const $item = $(this);
                const $header = $item.find('.accordion-header');
                const $content = $item.find('.accordion-content');

                $header.on('click', function(e) {
                    e.preventDefault();

                    const isOpen = $item.hasClass('is-open');

                    // Fechar outros itens (comportamento exclusivo)
                    $items.removeClass('is-open');
                    $items.find('.accordion-content').slideUp(300);

                    // Toggle item atual
                    if (!isOpen) {
                        $item.addClass('is-open');
                        $content.slideDown(300);
                    }

                    // Update ARIA
                    $header.attr('aria-expanded', !isOpen);
                    $content.attr('aria-hidden', isOpen);
                });
            });

            // Abrir primeiro item por padrão
            $items.first().addClass('is-open')
                .find('.accordion-content').show();
        });
    }

    /**
     * Setup tabs functionality
     */
    function setupTabs() {
        if (DOM.tabs.length === 0) return;

        DOM.tabs.each(function() {
            const $tabContainer = $(this);
            const $tabButtons = $tabContainer.find('.tab-button');
            const $tabPanels = $tabContainer.find('.tab-panel');

            $tabButtons.on('click', function(e) {
                e.preventDefault();

                const $button = $(this);
                const targetId = $button.data('tab');
                const $targetPanel = $tabPanels.filter('[data-tab="' + targetId + '"]');

                if ($targetPanel.length === 0) return;

                // Update buttons
                $tabButtons.removeClass('is-active').attr('aria-selected', 'false');
                $button.addClass('is-active').attr('aria-selected', 'true');

                // Update panels
                $tabPanels.removeClass('is-active').attr('aria-hidden', 'true');
                $targetPanel.addClass('is-active').attr('aria-hidden', 'false');
            });
        });
    }

    /**
     * Setup share buttons
     */
    function setupShareButtons() {
        if (DOM.shareButtons.length === 0) return;

        DOM.shareButtons.on('click', function(e) {
            e.preventDefault();

            const $btn = $(this);
            const shareType = $btn.data('share');
            const pageUrl = encodeURIComponent(window.location.href);
            const pageTitle = encodeURIComponent(document.title);

            let shareUrl = '';

            switch(shareType) {
                case 'facebook':
                    shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${pageUrl}`;
                    break;
                case 'twitter':
                    shareUrl = `https://twitter.com/intent/tweet?url=${pageUrl}&text=${pageTitle}`;
                    break;
                case 'whatsapp':
                    shareUrl = `https://api.whatsapp.com/send?text=${pageTitle}%20${pageUrl}`;
                    break;
                case 'linkedin':
                    shareUrl = `https://www.linkedin.com/sharing/share-offsite/?url=${pageUrl}`;
                    break;
                case 'email':
                    shareUrl = `mailto:?subject=${pageTitle}&body=Confira%20este%20curso:%20${pageUrl}`;
                    break;
            }

            if (shareUrl) {
                if (shareType === 'email') {
                    window.location.href = shareUrl;
                } else {
                    window.open(shareUrl, '_blank', 'width=600,height=400');
                }
            }
        });
    }

    /**
     * Sticky sidebar
     */
    function setupStickySidebar() {
        if (DOM.cursoSidebar.length === 0) return;

        const $sidebar = DOM.cursoSidebar;
        const sidebarTop = $sidebar.offset().top;
        const headerHeight = 100;

        $(window).on('scroll', function() {
            const scrollTop = $(window).scrollTop();

            if (scrollTop > sidebarTop - headerHeight) {
                $sidebar.addClass('is-sticky').css({
                    'top': headerHeight + 'px'
                });
            } else {
                $sidebar.removeClass('is-sticky').css({
                    'top': ''
                });
            }
        });
    }

    /**
     * Enroll button tracking
     */
    function setupEnrollButton() {
        if (DOM.enrollButton.length === 0) return;

        DOM.enrollButton.on('click', function(e) {
            const cursoId = $(this).data('curso-id');
            const cursoTitle = $(this).data('curso-title');

            // Google Analytics tracking (se disponível)
            if (typeof gtag !== 'undefined') {
                gtag('event', 'curso_enrollment_click', {
                    'event_category': 'Cursos',
                    'event_label': cursoTitle,
                    'value': cursoId
                });
            }

            // Facebook Pixel (se disponível)
            if (typeof fbq !== 'undefined') {
                fbq('track', 'Lead', {
                    content_name: cursoTitle,
                    content_category: 'Curso'
                });
            }
        });
    }

    /**
     * Initialize
     */
    function init() {
        if (!cacheDOMElements()) return;

        setupAccordion();
        setupTabs();
        setupShareButtons();
        setupStickySidebar();
        setupEnrollButton();

        console.log('✅ Camisa10 Single Curso: Inicializado');
    }

    /**
     * Document Ready
     */
    $(document).ready(init);

})(jQuery);
