/**
 * Custom Home Scripts - Camisa 10
 * JavaScript complementar para page-home.php
 * 
 * @package OneKorse Child
 * @since 2.0.0
 * @updated 2025-11-26 - Corrigido: Debug condicional, localStorage seguro, cleanup observers
 */

(function($) {
    'use strict';

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
            if (typeof $.fn.slick === 'undefined') return;

            const $slider = $('.testimonials-slider');
            if ($slider.length === 0) return;

            if ($slider.hasClass('slick-initialized')) {
                $slider.slick('unslick');
            }

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
                        settings: { slidesToShow: 1 }
                    }
                ]
            });

            log('✅ Testimonials Slider inicializado');
        },

        statisticsCounter: function() {
            const counters = document.querySelectorAll('.stat-number[data-count]');
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

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        animateCounter(entry.target);
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });

            counters.forEach(counter => observer.observe(counter));
            Camisa10HomePage.observers.push(observer);

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
        },

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

})(jQuery);
