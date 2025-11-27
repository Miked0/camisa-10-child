/**
 * Custom Home Scripts - Camisa 10
 * JavaScript complementar para page-home.php
 * 
 * @package OneKorse Child
 * @since 2.0.0
 * @requires jQuery, Bootstrap 5, Slick Slider
 * @updated 2025-11-26 - Corrigido: Debug condicional, localStorage seguro, cleanup observers
 */

(function($) {
    'use strict';

    // ============================================
    // VERIFICAÇÃO DE DEPENDÊNCIAS
    // ============================================
    const checkDependencies = function() {
        const missing = [];
        
        if (typeof $ === 'undefined') {
            missing.push('jQuery');
        }
        if (typeof bootstrap === 'undefined') {
            missing.push('Bootstrap 5');
        }
        if (typeof $.fn.slick === 'undefined') {
            missing.push('Slick Slider');
        }
        
        if (missing.length > 0) {
            console.error('❌ Dependências faltando:', missing.join(', '));
            return false;
        }
        
        return true;
    };

    // ============================================
    // OBJETO PRINCIPAL
    // ============================================
    const Camisa10HomePage = {
        
        /**
         * Inicializa todos os módulos
         */
        init: function() {
            if (!checkDependencies()) {
                console.error('❌ Não é possível inicializar - dependências faltando');
                return;
            }
            
            console.log('🚀 Camisa 10 Homepage Scripts v2.0');
            
            // Inicializar módulos
    // Sistema de debug condicional
    const DEBUG = window.location.hostname === 'localhost' || 
                  window.location.hostname === '127.0.0.1' ||
                  window.location.search.includes('debug=true');
    
    const log = function(...args) {
        if (DEBUG) console.log(...args);
    };
    
    // localStorage seguro (compatível com private mode)
    const getSafeLocalStorage = function(key) {
        try {
            return localStorage.getItem(key);
        } catch (e) {
            return null;
        }
    };

    const setSafeLocalStorage = function(key, value) {
        try {
            localStorage.setItem(key, value);
            return true;
        } catch (e) {
            return false;
        }
    };

    // Objeto principal
    const Camisa10HomePage = {
        
        observers: [],

        init: function() {
            log('🚀 Camisa 10 Homepage Scripts v2.0 carregados');

            this.heroCarousel();
            this.filterHandling();
            this.testimonialsSlider();
            this.statisticsCounter();
            this.animateOnScroll();
            this.wishlistHandling();
            this.smoothScroll();
            this.lazyLoadImages();
            this.accordionTracking();
            
            console.log('✅ Todos os módulos inicializados');
        },

        heroCarousel: function() {
            const carouselEl = document.getElementById('heroCarousel');
            if (!carouselEl) return;

            if (typeof bootstrap === 'undefined') {
                console.error('❌ Bootstrap 5 não carregado');
                return;
            }

            try {
                const carousel = new bootstrap.Carousel(carouselEl, {
                    interval: 5000,
                    pause: 'hover',
                    wrap: true
                });
                log('✅ Hero Carousel inicializado');
            } catch (err) {
                console.error('❌ Erro ao inicializar carousel:', err);
                
                // Fallback: mostrar primeira imagem
                const firstSlide = carouselEl.querySelector('.carousel-item');
                if (firstSlide) {
                    firstSlide.classList.add('active');
                    log('⚠️ Carousel em modo fallback');
                }
            }
        },

        testimonialsSlider: function() {
            const $slider = $('.testimonials-slider');
            
            if ($slider.length === 0) {
                return;
            }

            // Destruir slider anterior se existir
            if (typeof $.fn.slick === 'undefined') return;

            const $slider = $('.testimonials-slider');
            if ($slider.length === 0) return;

            if ($slider.hasClass('slick-initialized')) {
                $slider.slick('unslick');
            }

            // Configuração corrigida
            $slider.slick({
                dots: true,
                arrows: true,
                infinite: true,
                speed: 600,
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 6000,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: { slidesToShow: 2 }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            arrows: false,
                            dots: true
                        }
                        settings: { slidesToShow: 1 }
                    }
                ]
            });

            log('✅ Testimonials Slider inicializado');
        },

        statisticsCounter: function() {
            const counters = document.querySelectorAll('.stat-number[data-count]');
            
            if (counters.length === 0) {
                return;
            }
            if (counters.length === 0) return;

            const animateCounter = function(counter) {
                const target = parseInt(counter.getAttribute('data-count'));
                const duration = 2000;
                const increment = target / (duration / 16);
                let current = 0;

                const updateCounter = function() {
                    current += increment;
                    if (current < target) {
                        counter.textContent = Math.floor(current).toLocaleString('pt-BR');
                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.textContent = target.toLocaleString('pt-BR');
                    }
                };
                updateCounter();
            };

            // Intersection Observer para iniciar animação quando visível
            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting && !entry.target.classList.contains('counted')) {
                        entry.target.classList.add('counted');
                        animateCounter(entry.target);
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });

            counters.forEach(counter => observer.observe(counter));
            Camisa10HomePage.observers.push(observer);

            console.log('✅ Statistics Counter ativado para', counters.length, 'elementos');
            log('✅ Statistics Counter inicializado');
        },

        animateOnScroll: function() {
            if ('IntersectionObserver' in window) {
                const observer = new IntersectionObserver(function(entries) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('animate-in');
                        }
                    });
                }, {
                    threshold: 0.1,
                    rootMargin: '0px 0px -100px 0px'
                });

                const elements = document.querySelectorAll('.animate-on-scroll');
                elements.forEach(el => observer.observe(el));
                
                Camisa10HomePage.observers.push(observer);
                log('✅ Animate on Scroll ativado');
            }
        },

        wishlistHandling: function() {
            $('.wishlist-btn').on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                const $btn = $(this);
                const courseId = $btn.data('course-id');

                $btn.toggleClass('active');

                if ($btn.hasClass('active')) {
                    $btn.find('i').removeClass('far').addClass('fas');
                    
                    // Salvar no localStorage
                    let wishlist = JSON.parse(localStorage.getItem('camisa10_wishlist') || '[]');
                    if (!wishlist.includes(courseId)) {
                        wishlist.push(courseId);
                        localStorage.setItem('camisa10_wishlist', JSON.stringify(wishlist));
                    }
                } else {
                    $btn.find('i').removeClass('fas').addClass('far');
                    
                    // Remover do localStorage
                    let wishlist = JSON.parse(localStorage.getItem('camisa10_wishlist') || '[]');
                    wishlist = wishlist.filter(id => id !== courseId);
                    localStorage.setItem('camisa10_wishlist', JSON.stringify(wishlist));
                }

                // Google Analytics
                if (typeof gtag !== 'undefined') {
                    gtag('event', 'wishlist_toggle', {
                        'event_category': 'Engagement',
                        'event_label': 'Course ' + courseId,
                        'value': $btn.hasClass('active') ? 1 : 0
                    });
                }
            const wishlistBtns = document.querySelectorAll('.wishlist-btn');
            
            wishlistBtns.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    this.classList.toggle('active');
                    const icon = this.querySelector('i');
                    if (this.classList.contains('active')) {
                        icon.classList.replace('far', 'fas');
                    } else {
                        icon.classList.replace('fas', 'far');
                    }
                });
            });

            // Restaurar favoritos do localStorage ao carregar
            const wishlist = JSON.parse(localStorage.getItem('camisa10_wishlist') || '[]');
            wishlist.forEach(function(courseId) {
                $('.wishlist-btn[data-course-id="' + courseId + '"]')
                    .addClass('active')
                    .find('i').removeClass('far').addClass('fas');
            });
        },

        smoothScroll: function() {
            $('a[href^="#"]').on('click', function(e) {
                const href = $(this).attr('href');
                
                // Ignorar links vazios ou só com #
                if (href === '#' || href === '#!') {
                    return;
                }
                
                const target = $(href);
                
                if (target.length) {
                    e.preventDefault();
                    
                    $('html, body').stop().animate({
                        scrollTop: target.offset().top - 80
                    }, 800, 'swing');
                }
            const smoothLinks = document.querySelectorAll('a[href^="#"]');
            
            smoothLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;
                    
                    const target = document.querySelector(targetId);
                    if (target) {
                        e.preventDefault();
                        const headerHeight = document.querySelector('.site-header')?.offsetHeight || 80;
                        window.scrollTo({
                            top: target.offsetTop - headerHeight,
                            behavior: 'smooth'
                        });
                    }
                });
            });
        },

        lazyLoadImages: function() {
            if ('IntersectionObserver' in window) {
                const imageObserver = new IntersectionObserver(function(entries) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            const img = entry.target;
                            const src = img.getAttribute('data-src');
                            
                            if (src) {
                                img.src = src;
                                img.removeAttribute('data-src');
                                img.classList.add('loaded');
                                imageObserver.unobserve(img);
                            }
                        }
                    });
                });

                const lazyImages = document.querySelectorAll('img[data-src]');
                lazyImages.forEach(img => imageObserver.observe(img));
                
                Camisa10HomePage.observers.push(imageObserver);
                if (lazyImages.length > 0) {
                    log('✅ Lazy Loading ativado para', lazyImages.length, 'imagens');
                }
            }
        },

        /**
         * Tracking de FAQ (Google Analytics)
         */
        accordionTracking: function() {
            $('.accordion-button').on('click', function() {
                const question = $(this).text().trim();
                
                if (typeof gtag !== 'undefined') {
                    gtag('event', 'faq_click', {
                        'event_category': 'Engagement',
                        'event_label': question
                    });
                }
            });
        }
    };

    // ============================================
    // INICIALIZAÇÃO
    // ============================================
    
    // Inicializar quando DOM estiver pronto
        
        cleanup: function() {
            if (this.observers && this.observers.length > 0) {
                this.observers.forEach(observer => observer.disconnect());
                this.observers = [];
                log('🧹 Observers desconectados');
            }
        }
    };

    $(document).ready(function() {
        Camisa10HomePage.init();
    });

    $(window).on('load', function() {
        if (DEBUG) {
            console.log('✅ CAMISA 10 HOMEPAGE - TOTALMENTE CARREGADA');
        }
    });
    
    window.addEventListener('beforeunload', function() {
        Camisa10HomePage.cleanup();
    });

    // Exportar para uso global (debug)
    window.Camisa10HomePage = Camisa10HomePage;

})(jQuery);
