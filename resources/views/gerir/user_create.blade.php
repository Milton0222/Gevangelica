<x-app-layout>
    @section('header')
        <div class="page-header">
            <h1>Criar Utilizador</h1>
            <p>Registe um novo utilizador do sistema.</p>
        </div>
    @endsection

    @section('contente')
        <div class="table-container">
            <form action="{{ route('usuario.store') }}" method="POST" class="space-y-4">
                @csrf
                <div class="form-group">
                    <label for="name">Nome Completo</label>
                    <input type="text" name="name" id="name" required>
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" id="email" required>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" required>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirmar Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="isAdmin">Administrador</label>
                        <select name="isAdmin" id="isAdmin">
                            <option value="0">Não</option>
                            <option value="1">Sim</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="isMembro">Membro</label>
                        <select name="isMembro" id="isMembro">
                            <option value="0">Não</option>
                            <option value="1">Sim</option>
                        </select>
                    </div>
                </div>
                <div class="modal-right-footer">
                    <a href="{{ route('usuario.index') }}" class="btn btn-secondary-outline">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    @endsection
</x-app-layout>
