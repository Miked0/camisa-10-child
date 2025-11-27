/**
 * Camisa 10 - Home Page Interactions
 * Versão: 2.0 (corrigida)
 * Dependências: jQuery, hero-banner.js
 */

(function($) {
    'use strict';

    // Configuration
    const CONFIG = {
        scrollOffset: 100,
        animationDuration: 600,
        lazyLoadOffset: 200,
        statsAnimationDuration: 2000
    };

    // State
    let pageState = {
        isScrolling: false,
        animatedSections: [],
        statsAnimated: false,
        cursosLoaded: false
    };

    // DOM Cache
    let DOM = {};

    /**
     * Cache DOM elements com validação
     */
    function cacheDOMElements() {
        DOM = {
            window: $(window),
            body: $('body'),
            // Hero section
            heroSection: $('.hero-banner-section'),
            // Sobre section
            sobreSection: $('.sobre-section'),
            // Cursos section
            cursosSection: $('.cursos-section'),
            cursosGrid: $('.cursos-grid'),
            cursosLoadMore: $('.cursos-load-more'),
            // Depoimentos section
            depoimentosSection: $('.depoimentos-section'),
            depoimentosSlider: $('.depoimentos-slider'),
            // Stats/números
            statsSection: $('.stats-section'),
            statsNumbers: $('.stat-number'),
            // CTA section
            ctaSection: $('.cta-section'),
            ctaButton: $('.cta-button'),
            // Scroll to top
            scrollTopBtn: $('.scroll-to-top'),
            // Formulário
            newsletterForm: $('.newsletter-form')
        };

        // Validação mínima
        if (DOM.body.length === 0) {
            console.error('Camisa10 Home: Body não encontrado');
            return false;
        }

        return true;
    }

    /**
     * Animate on scroll - Intersection Observer
     */
    function setupScrollAnimations() {
        const animatableElements = document.querySelectorAll(
            '.animate-on-scroll, .curso-card, .depoimento-item, .stat-item'
        );

        if (animatableElements.length === 0) return;

        const observerOptions = {
            root: null,
            rootMargin: '0px 0px -100px 0px',
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const $element = $(entry.target);
                    
                    // Delay baseado no index (efeito cascata)
                    const index = $element.index();
                    const delay = index * 100;

                    setTimeout(() => {
                        $element.addClass('is-visible');
                    }, delay);

                    // Parar de observar após animar
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        animatableElements.forEach(el => observer.observe(el));
    }

    /**
     * Animate statistics numbers (contagem crescente)
     */
    function animateStats() {
        if (pageState.statsAnimated) return;
        if (DOM.statsNumbers.length === 0) return;

        pageState.statsAnimated = true;

        DOM.statsNumbers.each(function() {
            const $stat = $(this);
            const targetValue = parseInt($stat.data('value')) || parseInt($stat.text());
            const duration = CONFIG.statsAnimationDuration;
            const startValue = 0;
            const startTime = Date.now();

            // Função de easing
            const easeOutQuad = t => t * (2 - t);

            function updateNumber() {
                const elapsed = Date.now() - startTime;
                const progress = Math.min(elapsed / duration, 1);
                const easedProgress = easeOutQuad(progress);
                const currentValue = Math.floor(startValue + (targetValue - startValue) * easedProgress);

                $stat.text(currentValue.toLocaleString('pt-BR'));

                if (progress < 1) {
                    requestAnimationFrame(updateNumber);
                } else {
                    // Adicionar sufixo se existir
                    const suffix = $stat.data('suffix') || '';
                    $stat.text(targetValue.toLocaleString('pt-BR') + suffix);
                }
            }

            requestAnimationFrame(updateNumber);
        });
    }

    /**
     * Setup stats animation trigger
     */
    function setupStatsAnimation() {
        if (DOM.statsSection.length === 0) return;

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !pageState.statsAnimated) {
                    animateStats();
                }
            });
        }, { threshold: 0.3 });

        observer.observe(DOM.statsSection[0]);
    }

    /**
     * Setup depoimentos slider (se existir e não for hero-banner)
     */
    function setupDepoimentosSlider() {
        if (DOM.depoimentosSlider.length === 0) return;
        if (typeof Swiper === 'undefined') {
            console.warn('Camisa10 Home: Swiper não disponível para depoimentos');
            return;
        }

        new Swiper(DOM.depoimentosSlider[0], {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev'
            },
            breakpoints: {
                768: {
                    slidesPerView: 2
                },
                1024: {
                    slidesPerView: 3
                }
            }
        });
    }

    /**
     * Load more cursos (AJAX)
     */
    function loadMoreCursos() {
        if (!DOM.cursosLoadMore.length) return;

        DOM.cursosLoadMore.on('click', function(e) {
            e.preventDefault();

            const $btn = $(this);
            const page = $btn.data('page') || 1;
            const maxPages = $btn.data('max-pages') || 1;

            if (page >= maxPages) {
                $btn.fadeOut();
                return;
            }

            // Loading state
            $btn.addClass('is-loading').text('Carregando...');

            // AJAX call
            $.ajax({
                url: camisa10Ajax.ajaxurl,
                type: 'POST',
                data: {
                    action: 'load_more_cursos',
                    page: page + 1,
                    nonce: camisa10Ajax.nonce
                },
                success: function(response) {
                    if (response.success && response.data.html) {
                        const $newCursos = $(response.data.html);
                        
                        // Adicionar com animação
                        $newCursos.hide().appendTo(DOM.cursosGrid).fadeIn(600);

                        // Atualizar page counter
                        $btn.data('page', page + 1);

                        // Reset button
                        $btn.removeClass('is-loading').text('Carregar mais cursos');

                        // Esconder se chegou no final
                        if ((page + 1) >= maxPages) {
                            $btn.fadeOut();
                        }

                        // Trigger scroll animation nos novos elementos
                        setupScrollAnimations();
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Erro ao carregar cursos:', error);
                    $btn.removeClass('is-loading').text('Erro. Tente novamente');
                }
            });
        });
    }

    /**
     * Smooth scroll to section
     */
    function setupSmoothScroll() {
        $('a[href^="#"]').on('click', function(e) {
            const target = $(this).attr('href');
            
            if (target === '#') return;

            const $target = $(target);
            
            if ($target.length === 0) return;

            e.preventDefault();

            $('html, body').animate({
                scrollTop: $target.offset().top - CONFIG.scrollOffset
            }, 800, 'swing');
        });
    }

    /**
     * Scroll to top button
     */
    function setupScrollToTop() {
        if (DOM.scrollTopBtn.length === 0) return;

        DOM.window.on('scroll', debounce(function() {
            if (DOM.window.scrollTop() > 500) {
                DOM.scrollTopBtn.addClass('is-visible');
            } else {
                DOM.scrollTopBtn.removeClass('is-visible');
            }
        }, 100));

        DOM.scrollTopBtn.on('click', function(e) {
            e.preventDefault();
            $('html, body').animate({ scrollTop: 0 }, 800);
        });
    }

    /**
     * Newsletter form validation e submit
     */
    function setupNewsletterForm() {
        if (DOM.newsletterForm.length === 0) return;

        DOM.newsletterForm.on('submit', function(e) {
            e.preventDefault();

            const $form = $(this);
            const $email = $form.find('input[type="email"]');
            const $submitBtn = $form.find('button[type="submit"]');
            const email = $email.val().trim();

            // Validação
            if (!isValidEmail(email)) {
                showFormMessage($form, 'Por favor, insira um e-mail válido', 'error');
                return;
            }

            // Loading state
            $submitBtn.prop('disabled', true).addClass('is-loading');

            // AJAX submit
            $.ajax({
                url: camisa10Ajax.ajaxurl,
                type: 'POST',
                data: {
                    action: 'newsletter_subscribe',
                    email: email,
                    nonce: camisa10Ajax.nonce
                },
                success: function(response) {
                    if (response.success) {
                        showFormMessage($form, 'Inscrição realizada com sucesso!', 'success');
                        $form[0].reset();
                    } else {
                        showFormMessage($form, response.data.message || 'Erro ao inscrever', 'error');
                    }
                },
                error: function() {
                    showFormMessage($form, 'Erro no servidor. Tente novamente', 'error');
                },
                complete: function() {
                    $submitBtn.prop('disabled', false).removeClass('is-loading');
                }
            });
        });
    }

    /**
     * Validate email
     */
    function isValidEmail(email) {
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regex.test(email);
    }

    /**
     * Show form message
     */
    function showFormMessage($form, message, type) {
        const $messageEl = $form.find('.form-message');
        
        if ($messageEl.length === 0) {
            $form.append(`<div class="form-message ${type}">${message}</div>`);
        } else {
            $messageEl.removeClass('success error').addClass(type).text(message).show();
        }

        setTimeout(() => {
            $messageEl.fadeOut();
        }, 5000);
    }

    /**
     * Lazy load images
     */
    function setupLazyLoad() {
        const images = document.querySelectorAll('img[data-src]');
        
        if (images.length === 0) return;
        if ('IntersectionObserver' in window === false) {
            // Fallback para navegadores antigos
            images.forEach(img => {
                img.src = img.dataset.src;
                img.removeAttribute('data-src');
            });
            return;
        }

        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.removeAttribute('data-src');
                    img.classList.add('loaded');
                    imageObserver.unobserve(img);
                }
            });
        }, {
            rootMargin: `${CONFIG.lazyLoadOffset}px`
        });

        images.forEach(img => imageObserver.observe(img));
    }

    /**
     * Debounce utility
     */
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func(...args), wait);
        };
    }

    /**
     * Initialize all home page features
     */
    function init() {
        // Cache DOM
        if (!cacheDOMElements()) {
            console.error('Camisa10 Home: Falha ao inicializar');
            return;
        }

        // Setup features
        setupScrollAnimations();
        setupStatsAnimation();
        setupDepoimentosSlider();
        loadMoreCursos();
        setupSmoothScroll();
        setupScrollToTop();
        setupNewsletterForm();
        setupLazyLoad();

        console.log('✅ Camisa10 Home: Inicializado com sucesso');
    }

    /**
     * Document Ready
     */
    $(document).ready(function() {
        // Aguardar hero-banner carregar primeiro
        setTimeout(init, 100);
    });

})(jQuery);
