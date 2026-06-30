<x-app-layout>
    @section('header')
        <div class="page-header">
            <h1>Editar Utilizador</h1>
            <p>Atualize os dados do utilizador.</p>
        </div>
    @endsection

    @section('contente')
        <div class="table-container">
            <form action="{{ route('usuario.update', $usuario) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nome Completo</label>
                    <input type="text" name="name" id="name" value="{{ $usuario->name }}" required>
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" id="email" value="{{ $usuario->email }}" required>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="password">Nova Password</label>
                        <input type="password" name="password" id="password">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirmar Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation">
                    </div>
                </div>
                <div class="modal-right-footer">
                    <a href="{{ route('usuario.index') }}" class="btn btn-secondary-outline">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Atualizar</button>
                </div>
            </form>
        </div>
    @endsection
</x-app-layout>
