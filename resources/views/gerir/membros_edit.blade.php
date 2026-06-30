<x-app-layout>
    @section('header')
        <div class="page-header">
            <h1>Editar Membro</h1>
            <p>Atualize os dados do membro selecionado.</p>
        </div>
    @endsection

    @section('contente')
        <div class="table-container">
            <form action="{{ route('membro.update', $membro) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div class="form-row">
                    <div class="form-group">
                        <label for="nome">Nome Completo</label>
                        <input type="text" name="nome" id="nome" value="{{ $membro->nome }}" required>
                    </div>
                    <div class="form-group">
                        <label for="genero">Género</label>
                        <select name="genero" id="genero">
                            <option value="masculino" {{ $membro->genero == 'masculino' ? 'selected' : '' }}>Masculino</option>
                            <option value="feminino" {{ $membro->genero == 'feminino' ? 'selected' : '' }}>Feminino</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="telefone">Telefone</label>
                        <input type="text" name="telefone" id="telefone" value="{{ $membro->telefone }}">
                    </div>
                    <div class="form-group">
                        <label for="data_nascimento">Data de Nascimento</label>
                        <input type="date" name="data_nascimento" id="data_nascimento" value="{{ $membro->data_nascimento }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="estado_civil">Estado Civil</label>
                        <select name="estado_civil" id="estado_civil">
                            <option value="solteiro" {{ $membro->estado_civil == 'solteiro' ? 'selected' : '' }}>Solteiro</option>
                            <option value="casado" {{ $membro->estado_civil == 'casado' ? 'selected' : '' }}>Casado</option>
                            <option value="viúvo" {{ $membro->estado_civil == 'viúvo' ? 'selected' : '' }}>Viúvo</option>
                            <option value="divorciado" {{ $membro->estado_civil == 'divorciado' ? 'selected' : '' }}>Divorciado</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="situcao">Situação</label>
                        <select name="situcao" id="situcao">
                            <option value="ativo" {{ $membro->situcao == 'ativo' ? 'selected' : '' }}>Ativo</option>
                            <option value="inativo" {{ $membro->situcao == 'inativo' ? 'selected' : '' }}>Inativo</option>
                            <option value="afastado" {{ $membro->situcao == 'afastado' ? 'selected' : '' }}>Afastado</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="data_batismo">Data de Batismo</label>
                        <input type="date" name="data_batismo" id="data_batismo" value="{{ $membro->data_batismo }}">
                    </div>
                    <div class="form-group">
                        <label for="morada">Morada</label>
                        <input type="text" name="morada" id="morada" value="{{ $membro->morada }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="cargo">Cargo</label>
                    <input type="text" name="cargo" id="cargo" value="{{ $membro->cargo }}">
                </div>
                <div class="modal-right-footer">
                    <a href="{{ route('membro.index') }}" class="btn btn-secondary-outline">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Atualizar</button>
                </div>
            </form>
        </div>
    @endsection
</x-app-layout>
