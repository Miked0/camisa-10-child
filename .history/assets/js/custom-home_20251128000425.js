/**
 * Custom Home Scripts - Camisa 10
 * JavaScript complementar para page-home.php
 * 
 * @package OneKorse Child
 * @since 2.0.0
 * @requires jQuery, Bootstrap 5, Slick Slider
 * @updated 2025-11-27 - CORRIGIDO: Duplicações, métodos faltando, sintaxe
 */

(function($) {
    'use strict';

    // ============================================
    // SISTEMA DE DEBUG CONDICIONAL
    // ============================================
    const DEBUG = window.location.hostname === 'localhost' ||
                  window.location.hostname === '127.0.0.1' ||
                  window.location.search.includes('debug=true');

    const log = function(...args) {
        if (DEBUG) console.log(...args);
    };

    // ============================================
    // LOCALSTORAGE SEGURO
    // ============================================
    const getSafeLocalStorage = function(key) {
        try {
            return localStorage.getItem(key);
        } catch (e) {
            log('⚠️ LocalStorage não disponível');
            return null;
        }
    };

    const setSafeLocalStorage = function(key, value) {
        try {
            localStorage.setItem(key, value);
            return true;
        } catch (e) {
            log('⚠️ Não foi possível salvar no LocalStorage');
            return false;
        }
    };

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
    // OBJETO PRINCIPAL (UMA ÚNICA VEZ)
    // ============================================
    const Camisa10HomePage = {
        observers: [],

        /**
         * Inicializa todos os módulos
         */
        init: function() {
            if (!checkDependencies()) {
                console.error('❌ Não é possível inicializar - dependências faltando');
                return;
            }

            log('🚀 Camisa 10 Homepage Scripts v2.0 carregados');

            // Inicializar todos os módulos
            this.heroCarousel();
            this.testimonialsSlider();
            this.statisticsCounter();
            this.animateOnScroll();
            this.wishlistHandling();
            this.smoothScroll();
            this.lazyLoadImages();
            this.accordionTracking();

            console.log('✅ Todos os módulos inicializados');
        },

        /**
         * Hero Carousel (Bootstrap)
         */
        heroCarousel: function() {
            const carouselEl = document.getElementById('heroCarousel');
            if (!carouselEl) {
                log('⚠️ #heroCarousel não encontrado');
                return;
            }

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

        /**
         * Testimonials Slider (Slick)
         */
        testimonialsSlider: function() {
            if (typeof $.fn.slick === 'undefined') {
                log('⚠️ Slick Slider não carregado');
                return;
            }

            const $slider = $('.testimonials-slider');
            if ($slider.length === 0) {
                log('⚠️ .testimonials-slider não encontrado');
                return;
            }

            // Destruir slider anterior se existir
            if ($slider.hasClass('slick-initialized')) {
                $slider.slick('unslick');
            }

            // Configuração do Slick
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
                        settings: {
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            arrows: false,
                            dots: true
                        }
                    }
                ]
            });

            log('✅ Testimonials Slider inicializado');
        },

        /**
         * Statistics Counter (animação de números)
         */
        statisticsCounter: function() {
            const counters = document.querySelectorAll('.stat-number[data-count]');
            if (counters.length === 0) {
                log('⚠️ Nenhum .stat-number encontrado');
                return;
            }

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
            if ('IntersectionObserver' in window) {
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
                log('✅ Statistics Counter ativado para', counters.length, 'elementos');
            }
        },

        /**
         * Animate on Scroll
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
                elements.forEach(el => observer.observe(el));
                Camisa10HomePage.observers.push(observer);
                
                if (elements.length > 0) {
                    log('✅ Animate on Scroll ativado para', elements.length, 'elementos');
                }
            }
        },

        /**
         * Wishlist Handling
         */
        wishlistHandling: function() {
            const wishlistBtns = document.querySelectorAll('.wishlist-btn');
            
            wishlistBtns.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    const courseId = this.getAttribute('data-course-id');
                    this.classList.toggle('active');
                    
                    const icon = this.querySelector('i');
                    if (this.classList.contains('active')) {
                        icon.classList.replace('far', 'fas');
                        
                        // Salvar no localStorage
                        const wishlistStr = getSafeLocalStorage('camisa10_wishlist') || '[]';
                        let wishlist = JSON.parse(wishlistStr);
                        if (!wishlist.includes(courseId)) {
                            wishlist.push(courseId);
                            setSafeLocalStorage('camisa10_wishlist', JSON.stringify(wishlist));
                        }
                    } else {
                        icon.classList.replace('fas', 'far');
                        
                        // Remover do localStorage
                        const wishlistStr = getSafeLocalStorage('camisa10_wishlist') || '[]';
                        let wishlist = JSON.parse(wishlistStr);
                        wishlist = wishlist.filter(id => id !== courseId);
                        setSafeLocalStorage('camisa10_wishlist', JSON.stringify(wishlist));
                    }
                    
                    // Google Analytics
                    if (typeof gtag !== 'undefined') {
                        gtag('event', 'wishlist_toggle', {
                            'event_category': 'Engagement',
                            'event_label': 'Course ' + courseId,
                            'value': this.classList.contains('active') ? 1 : 0
                        });
                    }
                });
            });

            // Restaurar favoritos do localStorage
            const wishlistStr = getSafeLocalStorage('camisa10_wishlist') || '[]';
            const wishlist = JSON.parse(wishlistStr);
            wishlist.forEach(function(courseId) {
                const btn = document.querySelector('.wishlist-btn[data-course-id="' + courseId + '"]');
                if (btn) {
                    btn.classList.add('active');
                    const icon = btn.querySelector('i');
                    if (icon) {
                        icon.classList.replace('far', 'fas');
                    }
                }
            });

            if (wishlistBtns.length > 0) {
                log('✅ Wishlist ativado para', wishlistBtns.length, 'cursos');
            }
        },

        /**
         * Smooth Scroll
         */
        smoothScroll: function() {
            const smoothLinks = document.querySelectorAll('a[href^="#"]');
            
            smoothLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    const targetId = this.getAttribute('href');
                    if (targetId === '#' || targetId === '#!') return;
                    
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

            if (smoothLinks.length > 0) {
                log('✅ Smooth Scroll ativado para', smoothLinks.length, 'links');
            }
        },

        /**
         * Lazy Load Images
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
                lazyImages.forEach(img => imageObserver.observe(img));
                Camisa10HomePage.observers.push(imageObserver);
                
                if (lazyImages.length > 0) {
                    log('✅ Lazy Loading ativado para', lazyImages.length, 'imagens');
                }
            }
        },

        /**
         * Accordion Tracking (Google Analytics)
         */
        accordionTracking: function() {
            const accordionBtns = document.querySelectorAll('.accordion-button');
            
            accordionBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const question = this.textContent.trim();
                    if (typeof gtag !== 'undefined') {
                        gtag('event', 'faq_click', {
                            'event_category': 'Engagement',
                            'event_label': question
                        });
                    }
                });
            });

            if (accordionBtns.length > 0) {
                log('✅ Accordion tracking ativado para', accordionBtns.length, 'items');
            }
        },

        /**
         * Cleanup (desconectar observers ao sair)
         */
        cleanup: function() {
            if (this.observers && this.observers.length > 0) {
                this.observers.forEach(observer => observer.disconnect());
                this.observers = [];
                log('🧹 Observers desconectados');
            }
        }
    };

    // ============================================
    // INICIALIZAÇÃO
    // ============================================
    $(document).ready(function() {
        Camisa10HomePage.init();
    });

    // Cleanup ao sair da página
    window.addEventListener('beforeunload', function() {
        Camisa10HomePage.cleanup();
    });

    // Exportar para uso global (debug)
    window.Camisa10HomePage = Camisa10HomePage;

})(jQuery);
