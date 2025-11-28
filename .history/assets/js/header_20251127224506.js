/**
 * Header JavaScript - Camisa 10 (CORRIGIDO)
 * Controla comportamento do header fixo e menu mobile
 * 
 * @package OneKorse Child
 * @since 1.0.0
 * @updated 2025-11-27 - Corrigido: Sem referências fantasmas
 */

document.addEventListener('DOMContentLoaded', function() {
    // Throttle - Limita execução de função
    const throttle = (func, limit) => {
        let inThrottle;
        return function() {
            const args = arguments;
            const context = this;
            if (!inThrottle) {
                func.apply(context, args);
                inThrottle = true;
                setTimeout(() => inThrottle = false, limit);
            }
        };
    };

    // Variáveis
    const header = document.querySelector('.site-header');
    const mobileToggle = document.querySelector('.mobile-menu-toggle');
    const mobileNav = document.querySelector('.mobile-nav');
    const body = document.body;

    // Validação de elementos
    if (!header) {
        console.warn('Header não encontrado no DOM');
        return;
    }

    // Scroll effect com throttle
    let lastScroll = 0;
    const handleScroll = function() {
        if (!header) return;
        
        const currentScroll = window.pageYOffset;
        if (currentScroll > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
        lastScroll = currentScroll;
    };

    // Aplicar throttle (60fps = ~16ms)
    window.addEventListener('scroll', throttle(handleScroll, 16));

    // Mobile menu toggle
    if (mobileToggle && mobileNav) {
        const toggleMobileMenu = function() {
            mobileToggle.classList.toggle('active');
            mobileNav.classList.toggle('active');
            body.classList.toggle('mobile-menu-open');
        };

        mobileToggle.addEventListener('click', toggleMobileMenu);

        // Fechar menu ao clicar fora
        document.addEventListener('click', function(e) {
            if (!mobileToggle.contains(e.target) && !mobileNav.contains(e.target)) {
                mobileToggle.classList.remove('active');
                mobileNav.classList.remove('active');
                body.classList.remove('mobile-menu-open');
            }
        });
    }

    // Smooth scroll
    const smoothScrollLinks = document.querySelectorAll('a[href^="#"]');
    smoothScrollLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            e.preventDefault();
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                const headerHeight = header ? header.offsetHeight : 80;
                const targetPosition = targetElement.offsetTop - headerHeight;
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });

                // Fechar menu mobile
                if (mobileNav && mobileNav.classList.contains('active')) {
                    mobileToggle.classList.remove('active');
                    mobileNav.classList.remove('active');
                    body.classList.remove('mobile-menu-open');
                }
            }
        });
    });

    // Active menu highlight
    const currentPath = window.location.pathname;
    const navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(function(link) {
        try {
            const linkPath = new URL(link.href).pathname;
            if (linkPath === currentPath || (linkPath !== '/' && currentPath.startsWith(linkPath))) {
                link.classList.add('active');
            }
        } catch(e) {
            console.warn('Erro ao processar link:', link.href);
        }
    });

    // Close mobile menu on resize
    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            if (window.innerWidth > 1024 && mobileNav) {
                mobileNav.classList.remove('active');
                if (mobileToggle) mobileToggle.classList.remove('active');
                body.classList.remove('mobile-menu-open');
            }
        }, 250);
    });

    // ESC para fechar menu
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && mobileNav && mobileNav.classList.contains('active')) {
            mobileToggle.classList.remove('active');
            mobileNav.classList.remove('active');
            body.classList.remove('mobile-menu-open');
        }
    });

    console.log('✅ Header.js carregado com sucesso');
});