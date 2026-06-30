<x-guest-layout>


    <div class="login-overlay" id="loginModal">
        <x-validation-errors class="mb-4" />
        <div class="login-card">
            <button class="close-login" id="btnFecharLogin"></button>
            <a href="/">
                <div class="login-header">
                    <i class="fas fa-church"></i>
                    <h2>ACESSO AO SISTEMA</h2>
                    <p>Introduza as suas credenciais para continuar</p>
                </div>
            </a>
            <form class="login-form" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="login-group">
                    <label for="email">E-mail ou Utilizador</label>
                    <div class="input-icon-wrapper">
                        <i class="fas fa-envelope"></i>
                        <x-input type="email" id="email" placeholder="exemplo@igreja.com" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    </div>
                </div>
                <div class="login-group">
                    <label for="password">Palavra-passe</label>
                    <div class="input-icon-wrapper">
                        <i class="fas fa-lock"></i>
                        <x-input type="password" id="password" name="password" placeholder="••••••••" required />
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

</x-guest-layout>