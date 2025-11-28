/**
 * Camisa 10 - Header Navigation
 * Versão: 2.0 (corrigida)
 * Dependências: jQuery
 */

(function($) {
    'use strict';

    // State management
    const HeaderState = {
        isMenuOpen: false,
        isScrolled: false,
        lastScrollPosition: 0,
        isSubmenuOpen: false
    };

    // DOM Cache
    let DOM = {};

    /**
     * Initialize DOM elements
     */
    function cacheDOMElements() {
        DOM = {
            header: $('#masthead'),
            menuToggle: $('.menu-toggle'),
            mobileMenu: $('.mobile-menu'),
            navMenu: $('.main-navigation'),
            menuItems: $('.menu-item-has-children'),
            body: $('body'),
            searchToggle: $('.search-toggle'),
            searchForm: $('.search-form'),
            overlay: $('.menu-overlay')
        };

        // Validar elementos críticos
        if (DOM.header.length === 0) {
            console.warn('Camisa10 Header: Elemento #masthead não encontrado');
            return false;
        }

        return true;
    }

    /**
     * Toggle mobile menu
     */
    function toggleMobileMenu(e) {
        if (e) {
            e.preventDefault();
            e.stopPropagation(); // Prevenir bubbling
        }

        HeaderState.isMenuOpen = !HeaderState.isMenuOpen;

        if (HeaderState.isMenuOpen) {
            openMenu();
        } else {
            closeMenu();
        }
    }

    /**
     * Open mobile menu
     */
    function openMenu() {
        DOM.mobileMenu.addClass('is-active').attr('aria-hidden', 'false');
        DOM.menuToggle.addClass('is-active').attr('aria-expanded', 'true');
        DOM.body.addClass('menu-open');
        DOM.overlay.addClass('is-active');

        // Trap focus no menu
        trapFocus(DOM.mobileMenu[0]);
    }

    /**
     * Close mobile menu
     */
    function closeMenu() {
        DOM.mobileMenu.removeClass('is-active').attr('aria-hidden', 'true');
        DOM.menuToggle.removeClass('is-active').attr('aria-expanded', 'false');
        DOM.body.removeClass('menu-open');
        DOM.overlay.removeClass('is-active');

        // Fechar todos os submenus
        DOM.menuItems.removeClass('is-open');
        DOM.menuItems.find('.sub-menu').slideUp(200);

        // Restaurar foco
        DOM.menuToggle.focus();
    }

    /**
     * Handle submenu toggle
     */
    function toggleSubmenu(e) {
        e.preventDefault();
        e.stopPropagation();

        const $menuItem = $(this).parent();
        const $submenu = $menuItem.find('> .sub-menu');
        const isOpen = $menuItem.hasClass('is-open');

        // Fechar outros submenus
        DOM.menuItems.not($menuItem).removeClass('is-open')
            .find('.sub-menu').slideUp(200);

        // Toggle atual
        if (isOpen) {
            $menuItem.removeClass('is-open');
            $submenu.slideUp(200);
        } else {
            $menuItem.addClass('is-open');
            $submenu.slideDown(200);
        }
    }

    /**
     * Handle scroll behavior
     */
    function handleScroll() {
        const scrollPosition = $(window).scrollTop();
        const scrollThreshold = 100;

        // Adicionar classe quando scrollar
        if (scrollPosition > scrollThreshold && !HeaderState.isScrolled) {
            DOM.header.addClass('is-scrolled');
            HeaderState.isScrolled = true;
        } else if (scrollPosition <= scrollThreshold && HeaderState.isScrolled) {
            DOM.header.removeClass('is-scrolled');
            HeaderState.isScrolled = false;
        }

        // Hide/Show header no scroll
        const delta = scrollPosition - HeaderState.lastScrollPosition;

        if (delta > 5 && scrollPosition > 300) {
            // Scrolling down - hide header
            DOM.header.addClass('header-hidden');
        } else if (delta < -5) {
            // Scrolling up - show header
            DOM.header.removeClass('header-hidden');
        }

        HeaderState.lastScrollPosition = scrollPosition;
    }

    /**
     * Handle search toggle
     */
    function toggleSearch(e) {
        e.preventDefault();
        
        if (!DOM.searchForm.length) return;

        DOM.searchForm.toggleClass('is-active');
        
        if (DOM.searchForm.hasClass('is-active')) {
            DOM.searchForm.find('input[type="search"]').focus();
        }
    }

    /**
     * Close menu on overlay click
     */
    function handleOverlayClick() {
        if (HeaderState.isMenuOpen) {
            closeMenu();
        }
    }

    /**
     * Close menu on ESC key
     */
    function handleEscKey(e) {
        if (e.keyCode === 27 && HeaderState.isMenuOpen) {
            closeMenu();
        }
    }

    /**
     * Trap focus dentro do menu (acessibilidade)
     */
    function trapFocus(element) {
        const focusableElements = element.querySelectorAll(
            'a[href], button:not([disabled]), textarea, input, select'
        );
        
        if (focusableElements.length === 0) return;

        const firstElement = focusableElements[0];
        const lastElement = focusableElements[focusableElements.length - 1];

        element.addEventListener('keydown', function(e) {
            if (e.key !== 'Tab') return;

            if (e.shiftKey) {
                if (document.activeElement === firstElement) {
                    lastElement.focus();
                    e.preventDefault();
                }
            } else {
                if (document.activeElement === lastElement) {
                    firstElement.focus();
                    e.preventDefault();
                }
            }
        });
    }

    /**
     * Debounce function
     */
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    /**
     * Bind all events
     */
    function bindEvents() {
        // Menu toggle - PREVENIR DUPLICAÇÃO
        DOM.menuToggle.off('click.camisa10').on('click.camisa10', toggleMobileMenu);

        // Submenu toggle
        DOM.menuItems.find('> a').off('click.camisa10').on('click.camisa10', toggleSubmenu);

        // Overlay
        if (DOM.overlay.length) {
            DOM.overlay.off('click.camisa10').on('click.camisa10', handleOverlayClick);
        }

        // Search toggle
        if (DOM.searchToggle.length) {
            DOM.searchToggle.off('click.camisa10').on('click.camisa10', toggleSearch);
        }

        // Scroll (com debounce)
        $(window).off('scroll.camisa10').on('scroll.camisa10', debounce(handleScroll, 10));

        // ESC key
        $(document).off('keydown.camisa10').on('keydown.camisa10', handleEscKey);

        // Resize - fechar menu
        $(window).off('resize.camisa10').on('resize.camisa10', debounce(function() {
            if ($(window).width() >= 1024 && HeaderState.isMenuOpen) {
                closeMenu();
            }
        }, 250));
    }

    /**
     * Initialize header
     */
    function init() {
        // Cache DOM
        if (!cacheDOMElements()) {
            console.error('Camisa10 Header: Falha ao inicializar - elementos DOM faltando');
            return;
        }

        // Bind events
        bindEvents();

        // Initial scroll check
        handleScroll();

        console.log('✅ Camisa10 Header: Inicializado com sucesso');
    }

    /**
     * Document Ready
     */
    $(document).ready(function() {
        init();
    });

})(jQuery);
