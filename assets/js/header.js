/**
 * Header JavaScript - Camisa 10
 * Controla comportamento do header fixo e menu mobile
 * 
 * @package OneKorse Child
 * @since 1.0.0
 * @updated 2025-11-26 - Corrigido: Throttle implementado para scroll, event listeners organizados
 */

document.addEventListener('DOMContentLoaded', function() {
    
    // ============ UTILITÁRIOS ============
    
    /**
     * Throttle - Limita execução de função
     * @param {Function} func - Função a ser executada
     * @param {Number} limit - Tempo mínimo entre execuções (ms)
     */
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
    
    // ============ VARIÁVEIS ============
    const header = document.querySelector('.site-header');
    const mobileToggle = document.querySelector('.mobile-menu-toggle');
    const mobileNav = document.querySelector('.mobile-nav');
    const body = document.body;
    
    // ============ SCROLL EFFECT (COM THROTTLE) ============
    let lastScroll = 0;
    
    const handleScroll = function() {
        const currentScroll = window.pageYOffset;
        
        // Adiciona classe quando scrollar
        if (currentScroll > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
        
        lastScroll = currentScroll;
    };
    
    // ✅ Aplicar throttle (60fps = ~16ms)
    window.addEventListener('scroll', throttle(handleScroll, 16));
    
    // ============ MOBILE MENU TOGGLE ============
    if (mobileToggle && mobileNav) {
        const toggleMobileMenu = function() {
            mobileToggle.classList.toggle('active');
            mobileNav.classList.toggle('active');
            body.classList.toggle('mobile-menu-open');
        };
        
        mobileToggle.addEventListener('click', toggleMobileMenu);
        
        // Fechar menu ao clicar fora
        const closeMenuOnClickOutside = function(e) {
            if (!mobileToggle.contains(e.target) && !mobileNav.contains(e.target)) {
                mobileToggle.classList.remove('active');
                mobileNav.classList.remove('active');
                body.classList.remove('mobile-menu-open');
            }
        };
        
        document.addEventListener('click', closeMenuOnClickOutside);
    }
    
    // ============ SUBMENU MOBILE ============
    const mobileDropdowns = document.querySelectorAll('.mobile-menu .has-dropdown');
    
    mobileDropdowns.forEach(function(dropdown) {
        dropdown.addEventListener('click', function(e) {
            e.preventDefault();
            const submenu = this.nextElementSibling;
            if (submenu && submenu.classList.contains('mobile-submenu')) {
                submenu.classList.toggle('active');
                
                // Rotacionar ícone (se tiver)
                const icon = this.querySelector('i');
                if (icon) {
                    icon.style.transform = submenu.classList.contains('active') 
                        ? 'rotate(180deg)' 
                        : 'rotate(0deg)';
                }
            }
        });
    });
    
    // ============ SEARCH FUNCTIONALITY ============
    const searchBtn = document.querySelector('.search-btn');
    
    if (searchBtn) {
        searchBtn.addEventListener('click', function() {
            // TODO: Implementar funcionalidade de busca
            console.log('Busca ativada - implementar conforme necessidade');
        });
    }
    
    // ============ SMOOTH SCROLL ============
    const smoothScrollLinks = document.querySelectorAll('a[href^="#"]');
    
    smoothScrollLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            const targetId = this.getAttribute('href');
            
            // Ignorar se for apenas "#"
            if (targetId === '#') return;
            
            e.preventDefault();
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                const headerHeight = header.offsetHeight;
                const targetPosition = targetElement.offsetTop - headerHeight;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
                
                // Fechar menu mobile se estiver aberto
                if (mobileNav && mobileNav.classList.contains('active')) {
                    mobileToggle.classList.remove('active');
                    mobileNav.classList.remove('active');
                    body.classList.remove('mobile-menu-open');
                }
            }
        });
    });
    
    // ============ ACTIVE MENU HIGHLIGHT ============
    const currentPath = window.location.pathname;
    const navLinks = document.querySelectorAll('.nav-link');
    
    navLinks.forEach(function(link) {
        const linkPath = new URL(link.href).pathname;
        
        // Highlight exato ou se for uma subpágina
        if (linkPath === currentPath || 
            (linkPath !== '/' && currentPath.startsWith(linkPath))) {
            link.classList.add('active');
        }
    });
    
    // ============ CLOSE MOBILE MENU ON RESIZE ============
    let resizeTimer;
    const handleResize = function() {
        if (window.innerWidth > 1024 && mobileNav) {
            mobileNav.classList.remove('active');
            if (mobileToggle) {
                mobileToggle.classList.remove('active');
            }
            body.classList.remove('mobile-menu-open');
        }
    };
    
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(handleResize, 250);
    });
    
    // ============ KEYBOARD ACCESSIBILITY ============
    // ESC para fechar menu mobile
    const closeMenuOnEsc = function(e) {
        if (e.key === 'Escape' && mobileNav && mobileNav.classList.contains('active')) {
            mobileToggle.classList.remove('active');
            mobileNav.classList.remove('active');
            body.classList.remove('mobile-menu-open');
        }
    };
    
    document.addEventListener('keydown', closeMenuOnEsc);
    
});

// ============ FUNÇÕES AUXILIARES ============

/**
 * Adiciona padding ao body para compensar header fixo
 */
function handleHeaderOffset() {
    const header = document.querySelector('.site-header');
    if (header) {
        document.body.style.paddingTop = header.offsetHeight + 'px';
    }
}

// Executar ao carregar
handleHeaderOffset();

// Executar ao redimensionar (com throttle)
const throttleResize = (func, limit) => {
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

window.addEventListener('resize', throttleResize(handleHeaderOffset, 250));
