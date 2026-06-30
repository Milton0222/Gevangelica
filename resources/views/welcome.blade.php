<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Bem-vindo ao EclesiaDigital</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="stylesheet" href="{{asset('assets/css/welcome.css')}}">
    </head>
    <body class="antialiased">
       <!--  @include('sweetalert::alert')--> 
          <header class="navbar">
        <div class="nav-logo">
            <i class="fas fa-church"></i> <span>EcclesiaDigital</span>
        </div>
        <nav class="nav-menu">
            <a href="#inicio">Início</a>
            <a href="#modulos">Módulos</a>
            <a href="#institucional">Sobre Nós</a>
            <a href="#eventos">Eventos</a>
            <a href="#localizacao">Contacto</a>
        </nav>
        <div class="nav-actions">
            <button class="btn btn-login" id="btnAbrirLogin"><i class="fas fa-sign-in-alt"></i> Entrar</button>
        </div>
        <div class="menu-toggle" id="mobile-menu"><i class="fas fa-bars"></i></div>
    </header>

     <section class="hero-section" id="inicio">
        <div class="hero-content">
            <h1>Gestão Eclesial Inteligente e Simplificada</h1>
            <p>Uma plataforma moderna para conectar ministérios, organizar a administração, gerir finanças e aproximar a comunidade.</p>
            <a href="#modulos" class="btn btn-primary-welcome">Conhecer Módulos</a>
        </div>
    </section>

    <section class="section-container" id="modulos">
        <div class="section-header">
            <h2>Módulos do Sistema</h2>
            <p>Tudo o que precisa para gerir a sua congregação num único lugar.</p>
        </div>
        <div class="modules-grid">
            <div class="module-card">
                <div class="mod-icon"><i class="fas fa-users"></i></div>
                <h3>Gestão de Membros</h3>
                <p>Registo completo, consultas rápidas, atualizações de dados, batismos e relatórios demográficos.</p>
            </div>
            <div class="module-card">
                <div class="mod-icon finance"><i class="fas fa-hand-holding-usd"></i></div>
                <h3>Finanças Eclesiais</h3>
                <p>Controle rigoroso de dízimos, ofertas, entradas especiais e relatórios financeiros transparentes.</p>
            </div>
            <div class="module-card">
                <div class="mod-icon events"><i class="fas fa-calendar-alt"></i></div>
                <h3>Eventos e Espaços</h3>
                <p>Agendamento de cultos, escalas, estudos bíblicos e controle de aluguer de salas.</p>
            </div>
            <div class="module-card">
                <div class="mod-icon users"><i class="fas fa-user-shield"></i></div>
                <h3>Utilizadores</h3>
                <p>Níveis de acesso seguros e personalizados para pastores, tesoureiros e secretários.</p>
            </div>
        </div>
    </section>

    <section class="section-container bg-alt" id="institucional">
        <div class="about-grid">
            <div class="about-card">
                <div class="about-icon"><i class="fas fa-bullseye"></i></div>
                <h3>Nossa Missão</h3>
                <p>Oferecer soluções tecnológicas de excelência que otimizem os processos administrativos e pastorais das igrejas, permitindo que a liderança foque no crescimento espiritual da comunidade.</p>
            </div>
            <div class="about-card">
                <div class="about-icon"><i class="fas fa-eye"></i></div>
                <h3>Nossa Visão</h3>
                <p>Ser a plataforma de referência em gestão eclesial em Angola, reconhecida pela robustez, simplicidade de uso e suporte contínuo à modernização das comunidades cristãs.</p>
            </div>
        </div>
    </section>

    <section class="section-container" id="eventos">
        <div class="section-header">
            <h2>Agenda e Horários</h2>
            <p>Fique por dentro das nossas atividades regulares e eventos especiais.</p>
        </div>
        <div class="events-table-wrapper">
            <table class="events-table">
                <thead>
                    <tr>
                        <th>Atividade / Evento</th>
                        <th>Dia da Semana</th>
                        <th>Horário</th>
                        <th>Localização</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Culto de Celebração e Adoração</strong></td>
                        <td>Domingo</td>
                        <td>09:00h - 11:30h</td>
                        <td>Nave Principal</td>
                    </tr>
                    <tr>
                        <td>Estudo Bíblico Coletivo</td>
                        <td>Terça-Feira</td>
                        <td>18:30h - 20:00h</td>
                        <td>Sala Polivalente</td>
                    </tr>
                    <tr>
                        <td>Reunião de Oração e Intercessão</td>
                        <td>Sexta-Feira</td>
                        <td>18:00h - 19:30h</td>
                        <td>Capela Menor</td>
                    </tr>
                    <tr>
                        <td>Encontro Geral de Jovens</td>
                        <td>Sábado</td>
                        <td>16:00h - 18:00h</td>
                        <td>Auditório Superior</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <section class="section-container bg-alt" id="localizacao">
        <div class="contact-grid">
            <div class="contact-info">
                <h2>Onde Estamos</h2>
                <p>Venha visitar-nos e conhecer de perto o nosso trabalho comunitário.</p>
                <div class="info-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <p>Rua de Benguela, Próximo ao Hospital Geral, Benguela - Angola</p>
                </div>
                <div class="info-item">
                    <i class="fas fa-phone-alt"></i>
                    <p>+244 923 000 000 / +244 912 000 000</p>
                </div>
                <div class="info-item">
                    <i class="fas fa-envelope"></i>
                    <p>contacto@ecclesiadigital.ao</p>
                </div>
            </div>
            <div class="contact-map">
                <div class="map-placeholder">
                    <i class="fas fa-map-marked-alt"></i>
                    <p>Mapa Interativo Integrado</p>
                    <span style="font-size: 0.8rem; color: #94a3b8;">Benguela, Angola</span>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-brand">
                <h3><i class="fas fa-church"></i> EcclesiaDigital</h3>
                <p>Tecnologia ao serviço do Reino.</p>
            </div>
            <div class="footer-socials">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
                <a href="#"><i class="fab fa-whatsapp"></i></a>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2026 EcclesiaDigital. Todos os direitos reservados.</p>
        </div>
    </footer>

    <div class="login-overlay" id="loginModal">
        <div class="login-card">
            <button class="close-login" id="btnFecharLogin">&times;</button>
            <div class="login-header">
                <i class="fas fa-church"></i>
                <h2>Acesso ao Sistema</h2>
                <p>Introduza as suas credenciais para continuar</p>
            </div>
             <form class="login-form" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="login-group">
                    <label for="email">E-mail ou Utilizador</label>
                    <div class="input-icon-wrapper">
                        <i class="fas fa-envelope"></i>
                        <x-input type="email" id="email" placeholder="exemplo@igreja.com" name="email" :value="old('email')" required autofocus autocomplete="username"/>
                    </div>
                </div>
                <div class="login-group">
                    <label for="password">Palavra-passe</label>
                    <div class="input-icon-wrapper">
                        <i class="fas fa-lock"></i>
                        <x-input type="password" id="password" name="password" placeholder="••••••••" required/>
                    </div>
                </div>
                <div class="login-helpers">
                    <label><input type="checkbox"> Lembrar-me</label>
                    <a href="{{ route('password.request') }}">Esqueceu a senha?</a>
                     <a href="{{route('register')}}">Solicitar acesso?</a>
                </div>
                <button type="submit" class="btn btn-submit-login">Autenticar</button>
            </form>
        </div>
    </div>

      <script src="{{asset('assets/js/welcome.js')}}"></script>
    </body>
</html>
