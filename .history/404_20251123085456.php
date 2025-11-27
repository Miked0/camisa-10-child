<?php
/**
 * Template Name: 404 Error Page
 * Description: Página de erro 404 personalizada - Camisa 10
 */

get_header(); 
?>

<style>
/* ==== ESTILOS DA PÁGINA 404 - CAMISA 10 ==== */

.error-404-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #ffffff;
    padding: 40px 20px;
    font-family: 'Gill Sans Nova', 'Gill Sans', Arial, sans-serif;
}

.error-404-content {
    max-width: 800px;
    width: 100%;
    text-align: center;
    position: relative;
}

/* Título Principal */
.error-404-title {
    font-family: 'Chillax', 'Gill Sans Nova', sans-serif;
    font-weight: 700;
    font-size: 24px;
    color: #000000;
    margin-bottom: 16px;
    letter-spacing: -0.5px;
}

/* Subtítulo */
.error-404-subtitle {
    font-family: 'Gill Sans Nova', sans-serif;
    font-weight: 400;
    font-size: 16px;
    color: #282828;
    margin-bottom: 48px;
    line-height: 1.5;
}

/* Container do Número 404 e Mascote */
.error-404-visual {
    position: relative;
    margin: 0 auto 48px;
    max-width: 500px;
}

/* Número 404 */
.error-404-number {
    font-family: 'Chillax', sans-serif;
    font-weight: 800;
    font-size: clamp(120px, 25vw, 280px);
    color: #0a3be8;
    line-height: 1;
    margin: 0;
    position: relative;
    z-index: 1;
}

/* Mascote Capivara */
.error-404-mascot {
    position: absolute;
    bottom: -20px;
    right: 10%;
    width: clamp(180px, 35%, 280px);
    height: auto;
    z-index: 2;
}

/* Ilustração SVG da Capivara */
.capivara-illustration {
    width: 100%;
    height: auto;
    filter: drop-shadow(0 4px 12px rgba(0, 0, 0, 0.08));
}

/* Botão de Voltar */
.error-404-button {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background-color: #0a3be8;
    color: #ffffff;
    font-family: 'Gill Sans Nova', sans-serif;
    font-weight: 600;
    font-size: 16px;
    padding: 14px 32px;
    border-radius: 8px;
    text-decoration: none;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.error-404-button:hover {
    background-color: #0f5ce3;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(10, 59, 232, 0.25);
    color: #ffffff;
}

.error-404-button:active {
    transform: translateY(0);
}

.error-404-button svg {
    width: 20px;
    height: 20px;
    transition: transform 0.3s ease;
}

.error-404-button:hover svg {
    transform: translateX(-4px);
}

/* Pattern de Fundo (opcional) */
.error-404-pattern {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0.03;
    pointer-events: none;
    z-index: 0;
}

/* Responsividade */
@media (max-width: 768px) {
    .error-404-title {
        font-size: 20px;
        margin-bottom: 12px;
    }
    
    .error-404-subtitle {
        font-size: 14px;
        margin-bottom: 32px;
    }
    
    .error-404-number {
        font-size: clamp(100px, 30vw, 180px);
    }
    
    .error-404-mascot {
        bottom: -15px;
        right: 5%;
        width: clamp(140px, 40%, 200px);
    }
    
    .error-404-button {
        font-size: 14px;
        padding: 12px 24px;
    }
}

@media (max-width: 480px) {
    .error-404-container {
        padding: 30px 15px;
    }
    
    .error-404-title {
        font-size: 18px;
    }
    
    .error-404-subtitle {
        font-size: 13px;
    }
}
</style>

<div class="error-404-container">
    <div class="error-404-content">
        
        <!-- Título e Subtítulo -->
        <h1 class="error-404-title">Ops!...</h1>
        <p class="error-404-subtitle">Algo deu errado por aqui...<br>Parece que essa página resolveu tirar um dia de folga!</p>
        
        <!-- Número 404 com Mascote -->
        <div class="error-404-visual">
            <h2 class="error-404-number">404</h2>
            
            <!-- Mascote Capivara -->
            <div class="error-404-mascot">
                <svg class="capivara-illustration" viewBox="0 0 280 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <!-- Sombra/Base -->
                    <ellipse cx="140" cy="185" rx="100" ry="12" fill="#e5dede" opacity="0.5"/>
                    
                    <!-- Corpo da Capivara -->
                    <path d="M80 120C80 100 90 85 110 85H170C190 85 200 100 200 120V150C200 165 190 175 170 175H110C90 175 80 165 80 150V120Z" fill="#54a163"/>
                    
                    <!-- Barriga -->
                    <ellipse cx="140" cy="145" rx="45" ry="30" fill="#02fb9a" opacity="0.3"/>
                    
                    <!-- Cabeça -->
                    <circle cx="140" cy="95" r="40" fill="#269900"/>
                    
                    <!-- Orelhas -->
                    <ellipse cx="120" cy="75" rx="12" ry="18" fill="#269900"/>
                    <ellipse cx="160" cy="75" rx="12" ry="18" fill="#269900"/>
                    <ellipse cx="120" cy="78" rx="6" ry="10" fill="#54a163"/>
                    <ellipse cx="160" cy="78" rx="6" ry="10" fill="#54a163"/>
                    
                    <!-- Olhos -->
                    <circle cx="128" cy="92" r="8" fill="#000000"/>
                    <circle cx="152" cy="92" r="8" fill="#000000"/>
                    <circle cx="131" cy="89" r="3" fill="#ffffff"/>
                    <circle cx="155" cy="89" r="3" fill="#ffffff"/>
                    
                    <!-- Focinho -->
                    <ellipse cx="140" cy="105" rx="18" ry="12" fill="#02fb9a" opacity="0.4"/>
                    <circle cx="140" cy="108" r="5" fill="#000000"/>
                    
                    <!-- Bigodes -->
                    <line x1="115" y1="100" x2="95" y2="98" stroke="#000000" stroke-width="1.5" stroke-linecap="round"/>
                    <line x1="115" y1="105" x2="95" y2="107" stroke="#000000" stroke-width="1.5" stroke-linecap="round"/>
                    <line x1="165" y1="100" x2="185" y2="98" stroke="#000000" stroke-width="1.5" stroke-linecap="round"/>
                    <line x1="165" y1="105" x2="185" y2="107" stroke="#000000" stroke-width="1.5" stroke-linecap="round"/>
                    
                    <!-- Patas -->
                    <rect x="95" y="165" width="20" height="25" rx="10" fill="#269900"/>
                    <rect x="125" y="165" width="20" height="25" rx="10" fill="#269900"/>
                    <rect x="135" y="165" width="20" height="25" rx="10" fill="#269900"/>
                    <rect x="165" y="165" width="20" height="25" rx="10" fill="#269900"/>
                    
                    <!-- Detalhes de textura -->
                    <path d="M100 130C100 130 105 125 110 130" stroke="#02fb9a" stroke-width="2" stroke-linecap="round" opacity="0.3"/>
                    <path d="M170 130C170 130 175 125 180 130" stroke="#02fb9a" stroke-width="2" stroke-linecap="round" opacity="0.3"/>
                </svg>
            </div>
        </div>
        
        <!-- Botão de Voltar -->
        <a href="<?php echo esc_url(home_url('/')); ?>" class="error-404-button">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19 12H5M5 12L12 19M5 12L12 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Voltar
        </a>
        
    </div>
</div>

<?php get_footer(); ?>
