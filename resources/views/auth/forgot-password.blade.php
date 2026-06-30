<x-guest-layout>
    
  <div class="login-overlay" id="loginModal">
        <x-validation-errors class="mb-4" />
        <div class="login-card">
            <button class="close-login" id="btnFecharLogin"></button>
            <a href="/">
                <div class="login-header">
                    <i class="fas fa-church"></i>
                    <h2>RECUPERAR SENHA</h2>
                    <p> {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</p>
                </div>
            </a>
            <form class="login-form" method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="login-group">
                    <label for="email">E-mail ou Utilizador</label>
                    <div class="input-icon-wrapper">
                        <i class="fas fa-envelope"></i>
                        <x-input type="email" id="email" placeholder="exemplo@igreja.com" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    </div>
                </div>
                <x-button type="submit" class="btn btn-submit-login">
                    {{ __('Email Password Reset Link') }}
                </x-button>
             
            </form>
        </div>
    </div>
  
</x-guest-layout>
