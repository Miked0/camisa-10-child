/**
 * Custom Home Scripts - Camisa 10
 * JavaScript complementar para page-home.php
 * @package OneKorse Child
 * @since 2.0.0
 * @requires jQuery, Bootstrap 5, Slick Slider
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
         * Slider de Depoimentos (Slick)
         */
        testimonialsSlider: function() {
            const $slider = $('.testimonials-slider');
            
            if ($slider.length === 0) {
                return;
            }

            // Destruir slider anterior se existir
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
                            arrows: false,
                            dots: true
                        }
                    }
                ]
            });

            console.log('✅ Testimonials Slider inicializado');
        },

        /**
         * Contador animado para estatísticas
         */
        statisticsCounter: function() {
            const counters = document.querySelectorAll('.stat-number[data-count]');
            
            if (counters.length === 0) {
                return;
            }

            const animateCounter = function(counter) {
                const target = parseInt(counter.getAttribute('data-count'));
                const duration = 2000; // 2 segundos
                const increment = target / (duration / 16); // 60fps
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

            counters.forEach(function(counter) {
                observer.observe(counter);
            });

            console.log('✅ Statistics Counter ativado para', counters.length, 'elementos');
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

                console.log('✅ Animate on Scroll ativado para', elements.length, 'elementos');
            }
        },

        /**
         * Wishlist/Favoritos
         */
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
            });

            // Restaurar favoritos do localStorage ao carregar
            const wishlist = JSON.parse(localStorage.getItem('camisa10_wishlist') || '[]');
            wishlist.forEach(function(courseId) {
                $('.wishlist-btn[data-course-id="' + courseId + '"]')
                    .addClass('active')
                    .find('i').removeClass('far').addClass('fas');
            });
        },

        /**
         * Smooth Scroll
         */
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

                if (lazyImages.length > 0) {
                    console.log('✅ Lazy Loading ativado para', lazyImages.length, 'imagens');
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
    $(document).ready(function() {
        Camisa10HomePage.init();
    });

    // Validação final após carregamento completo
    $(window).on('load', function() {
        console.log('═══════════════════════════════════════');
        console.log('✅ CAMISA 10 HOMEPAGE - TOTALMENTE CARREGADA');
        console.log('═══════════════════════════════════════');
    });

    // Exportar para uso global (debug)
    window.Camisa10HomePage = Camisa10HomePage;

})(jQuery);
