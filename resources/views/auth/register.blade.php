<x-guest-layout>
     <div class="login-overlay" id="loginModal">
             <x-validation-errors class="mb-4" />
        <div class="login-card">
            <button class="close-login" id="btnFecharLogin"></button>
            <div class="login-header">
                <i class="fas fa-church"></i>
                <h2>SOLICITAR ACESSO</h2>
                <p>Introduza seus dados para solicitar acesso ao sistema</p>
            </div>
            <form class="login-form" method="POST" action="{{ route('register') }}">
                @csrf
                 <div class="login-group">
                    <label for="email">Nome completo</label>
                    <div class="input-icon-wrapper">
                        <i class="fas fa-envelope"></i>
                        <x-input type="text" id="name" placeholder="Celsio Weza" name="name" :value="old('name')" required autofocus autocomplete="name"/>
                    </div>
                </div>
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
                <div class="login-group">
                    <label for="password">Comfirmar Palavra-passe</label>
                    <div class="input-icon-wrapper">
                        <i class="fas fa-lock"></i>
                        <x-input type="password" id="password_confirmation" name="password_confirmation" placeholder="••••••••" required autocomplete="new-password"/>
                    </div>
                </div>
                <div class="login-helpers">
                    <label id="info"><input type="checkbox"> Lembrar-me</label>
                   
                     <a href="{{route('login')}}">Já tenho uma conta</a>
                </div>
                <button type="submit" class="btn btn-submit-login">Enviar Solicitação</button>
            </form>
        </div>
    </div>

        

</x-guest-layout>
<script>
      function verificar(){
               
            if(document.getElementById('password_confirmation').value==document.getElementById('password').value){
                 document.getElementById('info').textContent='Senha validada.';
            }else{
                document.getElementById('info').textContent='Senha invalida.';
            }
      }
      document.getElementById('password_confirmation').addEventListener('input',verificar);
</script>
