<x-app-layout>
    @section('header')
        <div class="page-header">
            <h1>Criar Membro</h1>
            <p>Registe um novo membro na congregação.</p>
        </div>
    @endsection

    @section('contente')
        <div class="table-container">
            <form action="{{ route('membro.store') }}" method="POST" class="space-y-4">
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <label for="nome">Nome Completo</label>
                        <input type="text" name="nome" id="nome" required>
                    </div>
                    <div class="form-group">
                        <label for="genero">Género</label>
                        <select name="genero" id="genero">
                            <option value="masculino">Masculino</option>
                            <option value="feminino">Feminino</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="telefone">Telefone</label>
                        <input type="text" name="telefone" id="telefone">
                    </div>
                    <div class="form-group">
                        <label for="data_nascimento">Data de Nascimento</label>
                        <input type="date" name="data_nascimento" id="data_nascimento">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="estado_civil">Estado Civil</label>
                        <select name="estado_civil" id="estado_civil">
                            <option value="solteiro">Solteiro</option>
                            <option value="casado">Casado</option>
                            <option value="viúvo">Viúvo</option>
                            <option value="divorciado">Divorciado</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="situcao">Situação</label>
                        <select name="situcao" id="situcao">
                            <option value="ativo">Ativo</option>
                            <option value="inativo">Inativo</option>
                            <option value="afastado">Afastado</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="data_batismo">Data de Batismo</label>
                        <input type="date" name="data_batismo" id="data_batismo">
                    </div>
                    <div class="form-group">
                        <label for="morada">Morada</label>
                        <input type="text" name="morada" id="morada">
                    </div>
                </div>
                <div class="form-group">
                    <label for="cargo">Cargo</label>
                    <input type="text" name="cargo" id="cargo">
                </div>
                <div class="form-group">
                    <label for="user_id">Utilizador associado</label>
                    <select name="user_id" id="user_id">
                        <option value="">Nenhum</option>
                        @foreach($users ?? [] as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-right-footer">
                    <a href="{{ route('membro.index') }}" class="btn btn-secondary-outline">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    @endsection
</x-app-layout>
