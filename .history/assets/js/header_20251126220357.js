// ========================================
// HEADER CAMISA 10 - JAVASCRIPT
// ========================================

document.addEventListener('DOMContentLoaded', function() {
    
    // ============ VARIÁVEIS ============
    const header = document.querySelector('.site-header');
    const mobileToggle = document.querySelector('.mobile-menu-toggle');
    const mobileNav = document.querySelector('.mobile-nav');
    const body = document.body;
    
    // ============ SCROLL EFFECT ============
    let lastScroll = 0;
    
    window.addEventListener('scroll', function() {
        const currentScroll = window.pageYOffset;
        
        // Adiciona classe quando scrollar
        if (currentScroll > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
        
        // Hide/Show header ao scrollar (OPCIONAL - descomente para ativar)
        /*
        if (currentScroll > lastScroll && currentScroll > 100) {
            header.style.transform = 'translateY(-100%)';
        } else {
            header.style.transform = 'translateY(0)';
        }
        */
        
        lastScroll = currentScroll;
    });
    
    // ============ MOBILE MENU TOGGLE ============
    if (mobileToggle && mobileNav) {
        mobileToggle.addEventListener('click', function() {
            this.classList.toggle('active');
            mobileNav.classList.toggle('active');
            body.classList.toggle('mobile-menu-open');
        });
        
        // Fechar menu ao clicar fora
        document.addEventListener('click', function(e) {
            if (!mobileToggle.contains(e.target) && !mobileNav.contains(e.target)) {
                mobileToggle.classList.remove('active');
                mobileNav.classList.remove('active');
                body.classList.remove('mobile-menu-open');
            }
        });
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
            // Opção 1: Redirecionar para página de busca
            // window.location.href = '/busca';
            
            // Opção 2: Abrir modal de busca (implementar modal separadamente)
            // openSearchModal();
            
            // Opção 3: Expandir input de busca no header
            console.log('Busca ativada - implementar funcionalidade');
            alert('Funcionalidade de busca - implementar conforme necessidade');
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
                if (mobileNav.classList.contains('active')) {
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
        const linkPath = link.getAttribute('href');
        
        // Highlight exato ou se for uma subpágina
        if (linkPath === currentPath || 
            (linkPath !== '/' && currentPath.startsWith(linkPath))) {
            link.classList.add('active');
        }
    });
    
    // ============ CLOSE MOBILE MENU ON RESIZE ============
    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            if (window.innerWidth > 1024) {
                mobileNav.classList.remove('active');
                mobileToggle.classList.remove('active');
                body.classList.remove('mobile-menu-open');
            }
        }, 250);
    });
    
    // ============ PREVENT SCROLL WHEN MOBILE MENU OPEN ============
    const preventScroll = function(e) {
        if (body.classList.contains('mobile-menu-open')) {
            e.preventDefault();
        }
    };
    
    // ============ KEYBOARD ACCESSIBILITY ============
    // ESC para fechar menu mobile
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && mobileNav.classList.contains('active')) {
            mobileToggle.classList.remove('active');
            mobileNav.classList.remove('active');
            body.classList.remove('mobile-menu-open');
        }
    });
    
});

// ============ FUNÇÕES AUXILIARES ============

// Função para adicionar classe ao body quando header está fixo
function handleHeaderOffset() {
    const header = document.querySelector('.site-header');
    if (header) {
        document.body.style.paddingTop = header.offsetHeight + 'px';
    }
}

// Executar ao carregar
handleHeaderOffset();

// Executar ao redimensionar
window.addEventListener('resize', handleHeaderOffset);
