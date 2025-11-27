/**
 * Hero Banner Slider - VERSÃO CORRIGIDA
 * Camisa 10
 */

(function($) {
    'use strict';
    
    // Variável global para debug
    window.heroSwiper = null;
    
    $(document).ready(function() {
        
        console.log('🚀 Iniciando Hero Slider...');
        
        // ===== VERIFICAR DEPENDÊNCIAS =====
        if (typeof Swiper === 'undefined') {
            console.error('❌ Swiper.js não está carregado!');
            console.log('Verifique se o CDN está correto no functions.php');
            return;
        }
        
        if (!$('.hero-swiper').length) {
            console.error('❌ Elemento .hero-swiper não encontrado no DOM!');
            return;
        }
        
        console.log('✅ Swiper.js carregado');
        console.log('✅ Elemento .hero-swiper encontrado');
        
        // ===== INICIALIZAR SWIPER =====
        try {
            window.heroSwiper = new Swiper('.hero-swiper', {
                // Loop infinito
                loop: true,
                
                // Velocidade de transição
                speed: 800,
                
                // Efeito de fade (crossfade)
                effect: 'fade',
                fadeEffect: {
                    crossFade: true
                },
                
                // Autoplay
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true,
                },
                
                // ✅ NAVEGAÇÃO CORRIGIDA
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                    disabledClass: 'swiper-button-disabled',
                },
                
                // ✅ PAGINAÇÃO CORRIGIDA
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                    type: 'bullets',
                    dynamicBullets: false,
                },
                
                // Teclado
                keyboard: {
                    enabled: true,
                    onlyInViewport: true,
                },
                
                // Mousewheel (opcional)
                mousewheel: false,
                
                // Eventos de debug
                on: {
                    init: function() {
                        console.log('✅ Swiper inicializado!');
                        console.log('📊 Total de slides:', this.slides.length);
                        console.log('🎯 Slide ativo:', this.realIndex);
                        
                        // Verificar navegação
                        const prevBtn = document.querySelector('.swiper-button-prev');
                        const nextBtn = document.querySelector('.swiper-button-next');
                        
                        console.log('🔘 Botão Prev:', prevBtn ? '✅ OK' : '❌ NÃO ENCONTRADO');
                        console.log('🔘 Botão Next:', nextBtn ? '✅ OK' : '❌ NÃO ENCONTRADO');
                        
                        // Adicionar event listeners manuais (backup)
                        if (prevBtn) {
                            prevBtn.addEventListener('click', () => {
                                console.log('🖱️ Clique manual no Prev');
                                this.slidePrev();
                            });
                        }
                        
                        if (nextBtn) {
                            nextBtn.addEventListener('click', () => {
                                console.log('🖱️ Clique manual no Next');
                                this.slideNext();
                            });
                        }
                        
                        // Inicializar AOS se disponível
                        if (typeof AOS !== 'undefined') {
                            AOS.init({
                                duration: 600,
                                once: false,
                                mirror: true,
                            });
                        }
                    },
                    
                    slideChange: function() {
                        console.log('🔄 Slide mudou para:', this.realIndex);
                        
                        // Refresh AOS
                        if (typeof AOS !== 'undefined') {
                            setTimeout(() => AOS.refresh(), 100);
                        }
                    },
                    
                    slideChangeTransitionStart: function() {
                        console.log('▶️ Transição iniciada');
                    },
                    
                    slideChangeTransitionEnd: function() {
                        console.log('⏸️ Transição concluída');
                    },
                    
                    navigationNext: function() {
                        console.log('➡️ Navegação: Next');
                    },
                    
                    navigationPrev: function() {
                        console.log('⬅️ Navegação: Prev');
                    },
                    
                    click: function(swiper, event) {
                        console.log('👆 Clique detectado em:', event.target);
                    }
                }
            });
            
            // ===== VERIFICAR SE FOI CRIADO =====
            if (!window.heroSwiper) {
                throw new Error('Swiper não foi inicializado corretamente');
            }
            
            console.log('✅ Swiper instance criada:', window.heroSwiper);
            
        } catch (error) {
            console.error('❌ Erro ao criar Swiper:', error);
            return;
        }
        
        // ===== MODAL DE VÍDEO =====
        const $videoModal = $('#video-modal');
        const $videoIframe = $('#video-iframe');
        
        $('.btn-gradient[data-video-id]').on('click', function(e) {
            e.preventDefault();
            const videoId = $(this).data('video-id');
            const videoUrl = `https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0`;
            
            $videoIframe.attr('src', videoUrl);
            $videoModal.addClass('active');
            $('body').css('overflow', 'hidden');
            
            if (window.heroSwiper && window.heroSwiper.autoplay) {
                window.heroSwiper.autoplay.stop();
            }
        });
        
        function closeVideoModal() {
            $videoIframe.attr('src', '');
            $videoModal.removeClass('active');
            $('body').css('overflow', '');
            
            if (window.heroSwiper && window.heroSwiper.autoplay) {
                window.heroSwiper.autoplay.start();
            }
        }
        
        $('.video-modal-close, .video-modal-overlay').on('click', closeVideoModal);
        
        $(document).on('keydown', function(e) {
            if (e.key === 'Escape' && $videoModal.hasClass('active')) {
                closeVideoModal();
            }
        });
        
        // ===== BUSCA =====
        $('.search-form').on('submit', function(e) {
            const searchValue = $(this).find('.search-input').val().trim();
            if (searchValue === '') {
                e.preventDefault();
                $(this).find('.search-input').focus().addClass('shake');
                setTimeout(() => {
                    $(this).find('.search-input').removeClass('shake');
                }, 500);
            }
        });
        
        // ===== TESTE MANUAL DAS SETAS (DEBUG) =====
        $('.swiper-button-prev, .hero-prev').on('click', function(e) {
            e.preventDefault();
            console.log('🖱️ Clique detectado: PREV');
            if (window.heroSwiper) {
                window.heroSwiper.slidePrev();
            }
        });
        
        $('.swiper-button-next, .hero-next').on('click', function(e) {
            e.preventDefault();
            console.log('🖱️ Clique detectado: NEXT');
            if (window.heroSwiper) {
                window.heroSwiper.slideNext();
            }
        });
        
        // ===== CONSOLE DE DEBUG =====
        console.log('═══════════════════════════════════════');
        console.log('🎯 HERO SLIDER - STATUS FINAL');
        console.log('═══════════════════════════════════════');
        console.log('Swiper Instance:', window.heroSwiper);
        console.log('Autoplay Running:', window.heroSwiper?.autoplay?.running);
        console.log('Total Slides:', window.heroSwiper?.slides?.length);
        console.log('Current Slide:', window.heroSwiper?.realIndex);
        console.log('═══════════════════════════════════════');
        
    }); // End document ready
    
})(jQuery);
