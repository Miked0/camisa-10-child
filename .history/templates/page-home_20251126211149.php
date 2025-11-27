<?php
/**
 * Template Name: Home Page
 * Versão: EMERGÊNCIA
 */

get_header();
?>

<main id="primary" class="site-main" style="padding: 100px 20px; min-height: 80vh;">
    
    <div style="max-width: 1200px; margin: 0 auto; text-align: center;">
        
        <!-- Hero Temporário -->
        <section style="background: linear-gradient(135deg, #0A3BE8 0%, #02FB9A 100%); padding: 80px 40px; border-radius: 16px; color: white; margin-bottom: 60px;">
            <h1 style="font-size: 3rem; font-weight: 900; margin-bottom: 20px;">
                Bem-vindo à Camisa 10
            </h1>
            <p style="font-size: 1.5rem; margin-bottom: 30px; opacity: 0.9;">
                Transforme seu jogo com nossos cursos de futebol
            </p>
            <a href="#cursos" style="display: inline-block; background: #FAF323; color: #000; padding: 16px 40px; border-radius: 8px; font-weight: bold; text-decoration: none; font-size: 1.2rem;">
                Ver Cursos
            </a>
        </section>

        <!-- Sobre -->
        <section style="margin-bottom: 80px;">
            <h2 style="font-size: 2.5rem; color: #0A3BE8; margin-bottom: 20px;">
                Sobre a Camisa 10
            </h2>
            <p style="font-size: 1.2rem; line-height: 1.8; max-width: 800px; margin: 0 auto; color: #333;">
                Somos uma plataforma dedicada ao desenvolvimento de jogadores de futebol através de cursos online de alta qualidade. Nossa missão é democratizar o acesso ao conhecimento técnico e tático do futebol.
            </p>
        </section>

        <!-- Cursos Placeholder -->
        <section id="cursos" style="margin-bottom: 80px;">
            <h2 style="font-size: 2.5rem; color: #0A3BE8; margin-bottom: 40px;">
                Nossos Cursos
            </h2>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">
                
                <!-- Curso 1 -->
                <div style="background: white; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.1); overflow: hidden; text-align: left;">
                    <div style="background: #0A3BE8; height: 200px; display: flex; align-items: center; justify-content: center;">
                        <span style="color: white; font-size: 4rem;">⚽</span>
                    </div>
                    <div style="padding: 24px;">
                        <h3 style="font-size: 1.5rem; margin-bottom: 12px; color: #0A3BE8;">
                            Fundamentos do Futebol
                        </h3>
                        <p style="color: #666; margin-bottom: 16px;">
                            Aprenda as bases essenciais do futebol moderno com técnicas comprovadas.
                        </p>
                        <div style="display: flex; gap: 12px; font-size: 0.9rem; color: #999; margin-bottom: 16px;">
                            <span>⏱️ 20 horas</span>
                            <span>📊 Iniciante</span>
                        </div>
                        <a href="#" style="display: inline-block; background: #FAF323; color: #000; padding: 12px 24px; border-radius: 6px; text-decoration: none; font-weight: bold;">
                            Saiba Mais
                        </a>
                    </div>
                </div>

                <!-- Curso 2 -->
                <div style="background: white; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.1); overflow: hidden; text-align: left;">
                    <div style="background: #02FB9A; height: 200px; display: flex; align-items: center; justify-content: center;">
                        <span style="color: #000; font-size: 4rem;">🎯</span>
                    </div>
                    <div style="padding: 24px;">
                        <h3 style="font-size: 1.5rem; margin-bottom: 12px; color: #0A3BE8;">
                            Tática e Estratégia
                        </h3>
                        <p style="color: #666; margin-bottom: 16px;">
                            Domine esquemas táticos e leitura de jogo para se destacar em campo.
                        </p>
                        <div style="display: flex; gap: 12px; font-size: 0.9rem; color: #999; margin-bottom: 16px;">
                            <span>⏱️ 30 horas</span>
                            <span>📊 Intermediário</span>
                        </div>
                        <a href="#" style="display: inline-block; background: #FAF323; color: #000; padding: 12px 24px; border-radius: 6px; text-decoration: none; font-weight: bold;">
                            Saiba Mais
                        </a>
                    </div>
                </div>

                <!-- Curso 3 -->
                <div style="background: white; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.1); overflow: hidden; text-align: left;">
                    <div style="background: #FAF323; height: 200px; display: flex; align-items: center; justify-content: center;">
                        <span style="color: #000; font-size: 4rem;">🏆</span>
                    </div>
                    <div style="padding: 24px;">
                        <h3 style="font-size: 1.5rem; margin-bottom: 12px; color: #0A3BE8;">
                            Alta Performance
                        </h3>
                        <p style="color: #666; margin-bottom: 16px;">
                            Prepare-se para o profissionalismo com treinos de elite.
                        </p>
                        <div style="display: flex; gap: 12px; font-size: 0.9rem; color: #999; margin-bottom: 16px;">
                            <span>⏱️ 40 horas</span>
                            <span>📊 Avançado</span>
                        </div>
                        <a href="#" style="display: inline-block; background: #FAF323; color: #000; padding: 12px 24px; border-radius: 6px; text-decoration: none; font-weight: bold;">
                            Saiba Mais
                        </a>
                    </div>
                </div>

            </div>
        </section>

        <!-- CTA -->
        <section style="background: #FAF323; padding: 60px 40px; border-radius: 16px;">
            <h2 style="font-size: 2.5rem; margin-bottom: 20px; color: #000;">
                Comece Sua Jornada Hoje
            </h2>
            <p style="font-size: 1.2rem; margin-bottom: 30px; color: #333;">
                Junte-se a milhares de jogadores que já transformaram seu jogo
            </p>
            <a href="#" style="display: inline-block; background: #0A3BE8; color: white; padding: 16px 40px; border-radius: 8px; font-weight: bold; text-decoration: none; font-size: 1.2rem;">
                Inscreva-se Agora
            </a>
        </section>

    </div>

    <?php if (current_user_can('administrator')) : ?>
    <!-- DEBUG INFO -->
    <div style="margin-top: 60px; background: #000; color: #0f0; padding: 20px; border-radius: 8px; font-family: monospace; font-size: 14px;">
        <strong>🔍 DEBUG (apenas admin):</strong><br><br>
        
        <strong>ACF Status:</strong> 
        <?php echo function_exists('get_field') ? '✅ ATIVO' : '❌ INATIVO - INSTALE!'; ?><br><br>
        
        <strong>Template:</strong> <?php echo get_page_template_slug(); ?><br><br>
        
        <?php if (function_exists('get_field')) : ?>
        <strong>Campos ACF:</strong><br>
        - hero_banner_slides: <?php echo get_field('hero_banner_slides') ? 'TEM' : 'VAZIO'; ?><br>
        - home_sobre_titulo: <?php echo get_field('home_sobre_titulo') ? 'TEM' : 'VAZIO'; ?><br>
        - home_cursos_titulo: <?php echo get_field('home_cursos_titulo') ? 'TEM' : 'VAZIO'; ?><br>
        <?php endif; ?>
    </div>
    <?php endif; ?>

</main>

<?php
get_footer();
