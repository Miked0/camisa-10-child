/**
 * Camisa 10 - Hero Banner Component
 * Versão: 2.0 (corrigida)
 * Dependências: jQuery
 */

(function($) {
    'use strict';

    // Configuration
    const CONFIG = {
        autoplaySpeed: 5000,
        animationDuration: 600,
        enableAutoplay: true,
        pauseOnHover: true
    };

    // State
    let bannerState = {
        currentSlide: 0,
        totalSlides: 0,
        isAnimating: false,
        autoplayTimer: null,
        isPaused: false
    };

    // DOM Cache
    let DOM = {};

    /**
     * Cache DOM elements
     */
    function cacheDOMElements() {
        DOM = {
            heroBanner: $('.hero-banner'),
            slides: $('.hero-slide'),
            dots: $('.hero-dots .dot'),
            prevBtn: $('.hero-prev'),
            nextBtn: $('.hero-next'),
            playPauseBtn: $('.hero-play-pause')
        };

        // Validação crítica
        if (DOM.heroBanner.length === 0) {
            console.warn('Camisa10 Hero: Elemento .hero-banner não encontrado no DOM');
            return false;
        }

        if (DOM.slides.length === 0) {
            console.warn('Camisa10 Hero: Nenhum slide encontrado');
            return false;
        }

        bannerState.totalSlides = DOM.slides.length;
        return true;
    }

    /**
     * Go to specific slide
     */
    function goToSlide(index, direction = 'next') {
        // Validação
        if (bannerState.isAnimating) return;
        if (index < 0 || index >= bannerState.totalSlides) return;
        if (index === bannerState.currentSlide) return;

        bannerState.isAnimating = true;

        const $currentSlide = DOM.slides.eq(bannerState.currentSlide);
        const $nextSlide = DOM.slides.eq(index);

        // Animation classes
        const outClass = direction === 'next' ? 'slide-out-left' : 'slide-out-right';
        const inClass = direction === 'next' ? 'slide-in-right' : 'slide-in-left';

        // Animate out
        $currentSlide.addClass(outClass);

        setTimeout(() => {
            $currentSlide.removeClass('is-active').removeClass(outClass);
            
            // Animate in
            $nextSlide.addClass(inClass).addClass('is-active');

            setTimeout(() => {
                $nextSlide.removeClass(inClass);
                bannerState.isAnimating = false;
            }, CONFIG.animationDuration);

        }, CONFIG.animationDuration / 2);

        // Update state
        bannerState.currentSlide = index;

        // Update dots
        updateDots();

        // Update ARIA
        updateARIA();
    }

    /**
     * Next slide
     */
    function nextSlide() {
        const nextIndex = (bannerState.currentSlide + 1) % bannerState.totalSlides;
        goToSlide(nextIndex, 'next');
    }

    /**
     * Previous slide
     */
    function prevSlide() {
        const prevIndex = bannerState.currentSlide === 0 
            ? bannerState.totalSlides - 1 
            : bannerState.currentSlide - 1;
        goToSlide(prevIndex, 'prev');
    }

    /**
     * Update dots indicator
     */
    function updateDots() {
        if (DOM.dots.length === 0) return;

        DOM.dots.removeClass('is-active').eq(bannerState.currentSlide).addClass('is-active');
    }

    /**
     * Update ARIA attributes
     */
    function updateARIA() {
        DOM.slides.attr('aria-hidden', 'true');
        DOM.slides.eq(bannerState.currentSlide).attr('aria-hidden', 'false');
    }

    /**
     * Start autoplay
     */
    function startAutoplay() {
        if (!CONFIG.enableAutoplay) return;
        if (bannerState.autoplayTimer) return; // Já está rodando

        bannerState.autoplayTimer = setInterval(() => {
            if (!bannerState.isPaused) {
                nextSlide();
            }
        }, CONFIG.autoplaySpeed);

        bannerState.isPaused = false;
        DOM.playPauseBtn.removeClass('is-paused');
    }

    /**
     * Stop autoplay
     */
    function stopAutoplay() {
        if (bannerState.autoplayTimer) {
            clearInterval(bannerState.autoplayTimer);
            bannerState.autoplayTimer = null;
        }

        bannerState.isPaused = true;
        DOM.playPauseBtn.addClass('is-paused');
    }

    /**
     * Toggle play/pause
     */
    function togglePlayPause() {
        if (bannerState.isPaused) {
            startAutoplay();
        } else {
            stopAutoplay();
        }
    }

    /**
     * Handle keyboard navigation
     */
    function handleKeyboard(e) {
        if (!DOM.heroBanner.is(':focus')) return;

        switch(e.keyCode) {
            case 37: // Left arrow
                e.preventDefault();
                prevSlide();
                break;
            case 39: // Right arrow
                e.preventDefault();
                nextSlide();
                break;
            case 32: // Space
                e.preventDefault();
                togglePlayPause();
                break;
        }
    }

    /**
     * Handle touch/swipe
     */
    function handleSwipe() {
        let touchStartX = 0;
        let touchEndX = 0;

        DOM.heroBanner.on('touchstart', function(e) {
            touchStartX = e.changedTouches[0].screenX;
        });

        DOM.heroBanner.on('touchend', function(e) {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipeGesture();
        });

        function handleSwipeGesture() {
            const swipeThreshold = 50;
            const diff = touchStartX - touchEndX;

            if (Math.abs(diff) < swipeThreshold) return;

            if (diff > 0) {
                // Swipe left - next
                nextSlide();
            } else {
                // Swipe right - prev
                prevSlide();
            }
        }
    }

    /**
     * Lazy load images
     */
    function lazyLoadImages() {
        DOM.slides.each(function(index) {
            const $slide = $(this);
            const $img = $slide.find('img[data-src]');

            if ($img.length === 0) return;

            // Preload first 2 slides
            if (index < 2) {
                const src = $img.data('src');
                $img.attr('src', src).removeAttr('data-src');
            }
        });
    }

    /**
     * Preload next slide image
     */
    function preloadNextImage() {
        const nextIndex = (bannerState.currentSlide + 1) % bannerState.totalSlides;
        const $nextSlide = DOM.slides.eq(nextIndex);
        const $img = $nextSlide.find('img[data-src]');

        if ($img.length > 0) {
            const src = $img.data('src');
            $img.attr('src', src).removeAttr('data-src');
        }
    }

    /**
     * Bind events
     */
    function bindEvents() {
        // Navigation buttons
        if (DOM.prevBtn.length) {
            DOM.prevBtn.on('click', function(e) {
                e.preventDefault();
                prevSlide();
                stopAutoplay(); // Pausar ao interagir
            });
        }

        if (DOM.nextBtn.length) {
            DOM.nextBtn.on('click', function(e) {
                e.preventDefault();
                nextSlide();
                stopAutoplay();
            });
        }

        // Dots
        if (DOM.dots.length) {
            DOM.dots.on('click', function(e) {
                e.preventDefault();
                const index = $(this).index();
                const direction = index > bannerState.currentSlide ? 'next' : 'prev';
                goToSlide(index, direction);
                stopAutoplay();
            });
        }

        // Play/Pause button
        if (DOM.playPauseBtn.length) {
            DOM.playPauseBtn.on('click', togglePlayPause);
        }

        // Pause on hover
        if (CONFIG.pauseOnHover) {
            DOM.heroBanner.on('mouseenter', function() {
                bannerState.isPaused = true;
            }).on('mouseleave', function() {
                bannerState.isPaused = false;
            });
        }

        // Keyboard
        $(document).on('keydown', handleKeyboard);

        // Touch/Swipe
        handleSwipe();

        // Preload images após slide change
        DOM.heroBanner.on('slideChanged', preloadNextImage);

        // Pause quando tab está inativo
        $(document).on('visibilitychange', function() {
            if (document.hidden) {
                stopAutoplay();
            } else {
                if (CONFIG.enableAutoplay) {
                    startAutoplay();
                }
            }
        });
    }

    /**
     * Initialize hero banner
     */
    function init() {
        // Cache DOM
        if (!cacheDOMElements()) {
            console.warn('Camisa10 Hero: Não inicializado - elementos DOM faltando');
            return;
        }

        // Setup initial state
        if (bannerState.totalSlides > 0) {
            DOM.slides.eq(0).addClass('is-active').attr('aria-hidden', 'false');
            DOM.slides.not(':first').attr('aria-hidden', 'true');
        }

        // Lazy load
        lazyLoadImages();

        // Bind events
        bindEvents();

        // Start autoplay
        if (CONFIG.enableAutoplay && bannerState.totalSlides > 1) {
            startAutoplay();
        }

        console.log('✅ Camisa10 Hero Banner: Inicializado com ' + bannerState.totalSlides + ' slides');
    }

    /**
     * Document Ready
     */
    $(document).ready(function() {
        init();
    });

    // Public API
    window.Camisa10Hero = {
        next: nextSlide,
        prev: prevSlide,
        goTo: goToSlide,
        play: startAutoplay,
        pause: stopAutoplay
    };

})(jQuery);
