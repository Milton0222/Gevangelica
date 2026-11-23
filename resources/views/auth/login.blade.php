<x-guest-layout>
    <main class="login-screen">
        <div class="login-shell">
            <section class="login-intro" aria-labelledby="login-intro-title">
                <a class="login-brand" href="{{ url('/') }}">
                    <i class="fas fa-church" aria-hidden="true"></i>
                    <span>EcclesiaDigital</span>
                </a>

                <div class="login-intro-content">
                    <span class="login-eyebrow">GESTÃO ECLESIAL</span>
                    <h1 id="login-intro-title">A sua comunidade, mais próxima e organizada.</h1>
                    <p>
                        Aceda a uma plataforma criada para simplificar a gestão da igreja,
                        acompanhar os membros e organizar as atividades da comunidade.
                    </p>

                    <div class="login-security">
                        <h2><i class="fas fa-shield-alt" aria-hidden="true"></i> Segurança e boas práticas</h2>
                        <ul>
                            <li>
                                <i class="fas fa-lock" aria-hidden="true"></i>
                                <span>As tentativas de acesso são limitadas para ajudar a proteger a sua conta.</span>
                            </li>
                            <li>
                                <i class="fas fa-user-shield" aria-hidden="true"></i>
                                <span>A autenticação em dois fatores está disponível para reforçar a proteção.</span>
                            </li>
                            <li>
                                <i class="fas fa-key" aria-hidden="true"></i>
                                <span>Use uma palavra-passe única e nunca a partilhe com outras pessoas.</span>
                            </li>
                            <li>
                                <i class="fas fa-sign-out-alt" aria-hidden="true"></i>
                                <span>Termine a sessão quando utilizar um dispositivo partilhado.</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <p class="login-brand-footer">Tecnologia ao serviço da comunidade.</p>
            </section>

            <section class="login-form-panel" aria-labelledby="login-title">
                <a class="login-back-link" href="{{ url('/') }}">
                    <i class="fas fa-arrow-left" aria-hidden="true"></i>
                    Página inicial
                </a>

                <div class="login-header">
                    <span class="login-form-eyebrow">ÁREA RESERVADA</span>
                    <h2 id="login-title">Iniciar sessão</h2>
                    <p>Introduza as suas credenciais para continuar.</p>
                </div>

                <x-validation-errors class="login-validation-errors mb-4" />

                <form class="login-form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="login-group">
                        <label for="email">E-mail</label>
                        <div class="input-icon-wrapper">
                            <i class="fas fa-envelope" aria-hidden="true"></i>
                            <x-input type="email" id="email" placeholder="exemplo@igreja.com" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        </div>
                    </div>

                    <div class="login-group">
                        <label for="password">Palavra-passe</label>
                        <div class="input-icon-wrapper">
                            <i class="fas fa-lock" aria-hidden="true"></i>
                            <x-input type="password" id="password" name="password" placeholder="Introduza a sua palavra-passe" required autocomplete="current-password" />
                        </div>
                    </div>

                    <div class="login-helpers">
                        <label class="login-remember">
                            <input type="checkbox" name="remember" value="1">
                            <span>Lembrar-me</span>
                        </label>
                        <a href="{{ route('password.request') }}">Esqueceu a palavra-passe?</a>
                    </div>

                    <button type="submit" class="btn btn-submit-login">
                        Entrar
                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                    </button>
                </form>

                <p class="login-register-link">
                    Ainda não tem acesso?
                    <a href="{{ route('register') }}">Solicitar acesso</a>
                </p>
            </section>
        </div>
    </main>
</x-guest-layout>
