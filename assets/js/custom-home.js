/**
 * Custom Home Scripts - Camisa 10
 * JavaScript complementar para page-home.php
 * 
 * @package OneKorse Child
 * @since 2.0.0
 * @updated 2025-11-26 - Corrigido: Sistema de debug condicional, localStorage com try-catch, cleanup de observers
 */

(function($) {
    'use strict';

    // ========================================
    // SISTEMA DE DEBUG CONDICIONAL
    // ========================================
    const DEBUG = window.location.hostname === 'localhost' || 
                  window.location.hostname === '127.0.0.1' ||
                  window.location.search.includes('debug=true');
    
    const log = function(...args) {
        if (DEBUG) {
            console.log(...args);
        }
    };
    
    const warn = function(...args) {
        if (DEBUG) {
            console.warn(...args);
        }
    };
    
    const error = function(...args) {
        // Erros sempre logam (críticos para troubleshooting)
        console.error(...args);
    };

    // ========================================
    // UTILITÁRIOS - localStorage SEGURO
    // ========================================
    
    /**
     * Acesso seguro ao localStorage (compatível com private mode)
     */
    const getSafeLocalStorage = function(key) {
        try {
            return localStorage.getItem(key);
        } catch (e) {
            warn('localStorage não disponível (modo privado?):', e);
            return null;
        }
    };

    const setSafeLocalStorage = function(key, value) {
        try {
            localStorage.setItem(key, value);
            return true;
        } catch (e) {
            warn('Não foi possível salvar no localStorage:', e);
            return false;
        }
    };

    // ========================================
    // OBJETO PRINCIPAL
    // ========================================
    const Camisa10HomePage = {
        
        // Array para guardar observers (cleanup posterior)
        observers: [],

        /**
         * Inicializa todos os módulos
         */
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
        },

        /**
         * Hero Carousel Bootstrap 5 com Fallback
         */
        heroCarousel: function() {
            const carouselEl = document.getElementById('heroCarousel');

            if (!carouselEl) {
                warn('⚠️ Hero Carousel não encontrado');
                return;
            }

            if (typeof bootstrap === 'undefined') {
                error('❌ Bootstrap 5 não carregado');
                return;
            }

            try {
                const carousel = new bootstrap.Carousel(carouselEl, {
                    interval: 5000,
                    pause: 'hover',
                    wrap: true,
                    keyboard: true,
                    touch: true
                });

                log('✅ Hero Carousel inicializado');

                // Event tracking (apenas em debug)
                if (DEBUG) {
                    carouselEl.addEventListener('slide.bs.carousel', function(e) {
                        log('📊 Carousel slide:', e.to);
                    });
                }

            } catch (err) {
                error('❌ Erro ao inicializar carousel:', err);
                
                // ✅ FALLBACK: Mostrar primeira imagem estática
                const firstSlide = carouselEl.querySelector('.carousel-item');
                if (firstSlide) {
                    firstSlide.classList.add('active');
                    carouselEl.style.minHeight = '600px';
                    
                    // Ocultar controles que não funcionarão
                    const controls = carouselEl.querySelectorAll('.carousel-control-prev, .carousel-control-next, .carousel-indicators');
                    controls.forEach(control => control.style.display = 'none');
                    
                    log('⚠️ Carousel em modo fallback (imagem estática)');
                }
            }
        },

        /**
         * Manipulação de filtros
         */
        filterHandling: function() {
            const filterForm = document.getElementById('course-filter-form');

            if (!filterForm) return;

            filterForm.addEventListener('submit', function(e) {
                log('🔍 Filtros enviados');

                // Google Analytics tracking (apenas se consentimento OK)
                const hasConsent = getSafeLocalStorage('cookie_consent') === 'true';
                if (hasConsent && typeof gtag !== 'undefined') {
                    gtag('event', 'filter_courses', {
                        'event_category': 'Engagement',
                        'event_label': 'Course Filter'
                    });
                }
            });
        },

        /**
         * Slider de Depoimentos (Slick)
         */
        testimonialsSlider: function() {
            if (typeof $.fn.slick === 'undefined') {
                warn('⚠️ Slick Slider não carregado');
                return;
            }

            const $slider = $('.testimonials-slider');

            if ($slider.length === 0) return;

            // Destruir slider anterior se existir
            if ($slider.hasClass('slick-initialized')) {
                $slider.slick('unslick');
            }

            // Configuração
            $slider.slick({
                dots: true,
                arrows: true,
                infinite: true,
                speed: 600,
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 6000,
                pauseOnHover: true,
                pauseOnFocus: true,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            arrows: true
                        }
                    }
                ]
            });

            log('✅ Testimonials Slider inicializado');
        },

        /**
         * Contador animado para estatísticas
         */
        statisticsCounter: function() {
            const counters = document.querySelectorAll('.stat-number[data-count]');

            if (counters.length === 0) return;

            const animateCounter = function(counter) {
                const target = parseInt(counter.getAttribute('data-count'));
                const duration = 2000;
                const increment = target / (duration / 16);
                let current = 0;
                let animationFrameId = null;

                const updateCounter = function() {
                    current += increment;

                    if (current < target) {
                        counter.textContent = Math.floor(current).toLocaleString('pt-BR');
                        animationFrameId = requestAnimationFrame(updateCounter);
                    } else {
                        counter.textContent = target.toLocaleString('pt-BR');
                        if (animationFrameId) {
                            cancelAnimationFrame(animationFrameId);
                        }
                    }
                };

                updateCounter();
            };

            // Observador de interseção
            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        animateCounter(entry.target);
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });

            counters.forEach(function(counter) {
                observer.observe(counter);
            });
            
            // ✅ Guardar referência para cleanup
            Camisa10HomePage.observers.push(observer);

            log('✅ Statistics Counter inicializado');
        },

        /**
         * Animação ao scroll
         */
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
                elements.forEach(function(el) {
                    observer.observe(el);
                });
                
                // ✅ Guardar referência para cleanup
                Camisa10HomePage.observers.push(observer);

                log('✅ Animate on Scroll ativado para', elements.length, 'elementos');
            }
        },

        /**
         * Wishlist/Favoritos - VANILLA JS
         */
        wishlistHandling: function() {
            const wishlistBtns = document.querySelectorAll('.wishlist-btn');
            
            wishlistBtns.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    const courseId = this.dataset.courseId;
                    this.classList.toggle('active');
                    
                    const icon = this.querySelector('i');
                    if (this.classList.contains('active')) {
                        icon.classList.replace('far', 'fas');
                        log('❤️ Curso adicionado aos favoritos:', courseId);
                    } else {
                        icon.classList.replace('fas', 'far');
                        log('💔 Curso removido dos favoritos:', courseId);
                    }
                    
                    // Google Analytics (com consentimento)
                    const hasConsent = getSafeLocalStorage('cookie_consent') === 'true';
                    if (hasConsent && typeof gtag !== 'undefined') {
                        gtag('event', 'wishlist_toggle', {
                            'event_category': 'Engagement',
                            'event_label': 'Course ' + courseId,
                            'value': this.classList.contains('active') ? 1 : 0
                        });
                    }
                });
            });
        },

        /**
         * Smooth Scroll
         */
        smoothScroll: function() {
            const smoothLinks = document.querySelectorAll('a[href^="#"]');
            
            smoothLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    const targetId = this.getAttribute('href');
                    
                    if (targetId === '#') return;
                    
                    const target = document.querySelector(targetId);
                    
                    if (target) {
                        e.preventDefault();
                        
                        const headerHeight = document.querySelector('.site-header')?.offsetHeight || 80;
                        const targetPosition = target.offsetTop - headerHeight;
                        
                        window.scrollTo({
                            top: targetPosition,
                            behavior: 'smooth'
                        });
                    }
                });
            });
        },

        /**
         * Lazy Load de Imagens
         */
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
                lazyImages.forEach(function(img) {
                    imageObserver.observe(img);
                });
                
                // ✅ Guardar referência para cleanup
                Camisa10HomePage.observers.push(imageObserver);

                if (lazyImages.length > 0) {
                    log('✅ Lazy Loading ativado para', lazyImages.length, 'imagens');
                }
            }
        },
        
        /**
         * ✅ Cleanup - Desconectar todos os observers
         */
        cleanup: function() {
            if (this.observers && this.observers.length > 0) {
                this.observers.forEach(observer => {
                    observer.disconnect();
                });
                this.observers = [];
                log('🧹 Observers desconectados');
            }
        }
    };

    // ========================================
    // INICIALIZAÇÃO
    // ========================================
    $(document).ready(function() {
        Camisa10HomePage.init();
    });

    // Validação final após carregamento completo
    $(window).on('load', function() {
        if (DEBUG) {
            console.log('═══════════════════════════════════════');
            console.log('✅ CAMISA 10 HOMEPAGE - TOTALMENTE CARREGADA');
            console.log('═══════════════════════════════════════');
        }
    });
    
    // ✅ Cleanup ao sair da página
    window.addEventListener('beforeunload', function() {
        Camisa10HomePage.cleanup();
    });

})(jQuery);
