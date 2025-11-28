/**
 * Custom Home Scripts - Camisa 10 (Atualizado)
 * JavaScript complementar para page-home.php
 * @package OneKorse Child
 * @since 2.0.0
 */

(function($) {
    'use strict';

    const Camisa10HomePage = {

        /**
         * Inicializa todos os módulos
         */
        init: function() {
            console.log('🚀 Camisa 10 Homepage Scripts v2.0 carregados');

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
         * Hero Carousel Bootstrap 5
         */
        heroCarousel: function() {
            const carouselEl = document.getElementById('heroCarousel');

            if (!carouselEl) {
                console.warn('⚠️ Hero Carousel não encontrado');
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
                    wrap: true,
                    keyboard: true,
                    touch: true
                });

                console.log('✅ Hero Carousel inicializado');

                // Event tracking
                carouselEl.addEventListener('slide.bs.carousel', function(e) {
                    console.log('📊 Carousel slide:', e.to);
                });

            } catch (error) {
                console.error('❌ Erro ao inicializar carousel:', error);
            }
        },

        /**
         * Manipulação de filtros
         */
        filterHandling: function() {
            const filterForm = document.getElementById('course-filter-form');

            if (!filterForm) return;

            filterForm.addEventListener('submit', function(e) {
                console.log('🔍 Filtros enviados');

                // Google Analytics tracking
                if (typeof gtag !== 'undefined') {
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
                console.warn('⚠️ Slick Slider não carregado');
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

            console.log('✅ Testimonials Slider inicializado');
        },

        /**
         * Contador animado para estatísticas
         */
        statisticsCounter: function() {
            const counters = document.querySelectorAll('.stat-number[data-count]');

            if (counters.length === 0) return;

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

            console.log('✅ Statistics Counter inicializado');
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
                    console.log('❤️ Curso adicionado aos favoritos:', courseId);
                } else {
                    $btn.find('i').removeClass('fas').addClass('far');
                    console.log('💔 Curso removido dos favoritos:', courseId);
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
        },

        /**
         * Smooth Scroll
         */
        smoothScroll: function() {
            $('a[href^="#"]').on('click', function(e) {
                const target = $(this.getAttribute('href'));

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
        }
    };

    // Inicialização ao carregar DOM
    $(document).ready(function() {
        Camisa10HomePage.init();
    });

    // Validação final após carregamento completo
    $(window).on('load', function() {
        console.log('═══════════════════════════════════════');
        console.log('✅ CAMISA 10 HOMEPAGE - TOTALMENTE CARREGADA');
        console.log('═══════════════════════════════════════');
    });

})(jQuery);
