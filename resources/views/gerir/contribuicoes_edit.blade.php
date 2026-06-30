<x-app-layout>
    @section('header')
        <div class="page-header">
            <h1>Editar Contribuição</h1>
            <p>Atualize os dados da contribuição.</p>
        </div>
    @endsection

    @section('contente')
        <div class="table-container">
            <form action="{{ route('contribuicao.update', $contribuicao) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="tipo">Tipo</label>
                    <select name="tipo" id="tipo">
                        <option value="dízimo" {{ $contribuicao->tipo == 'dízimo' ? 'selected' : '' }}>Dízimo</option>
                        <option value="oferta" {{ $contribuicao->tipo == 'oferta' ? 'selected' : '' }}>Oferta</option>
                        <option value="doação" {{ $contribuicao->tipo == 'doação' ? 'selected' : '' }}>Doação</option>
                        <option value="subscrição" {{ $contribuicao->tipo == 'subscrição' ? 'selected' : '' }}>Subscrição</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="valor">Valor</label>
                    <input type="number" step="0.01" name="valor" id="valor" value="{{ $contribuicao->valor }}" required>
                </div>
                <div class="form-group">
                    <label for="membro_id">Membro</label>
                    <select name="membro_id" id="membro_id">
                        @foreach($membros as $membro)
                            <option value="{{ $membro->id }}" {{ $contribuicao->membro_id == $membro->id ? 'selected' : '' }}>{{ $membro->nome }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="user_id">Registado por</label>
                    <select name="user_id" id="user_id">
                        @foreach($usuarios as $usuario)
                            <option value="{{ $usuario->id }}" {{ $contribuicao->user_id == $usuario->id ? 'selected' : '' }}>{{ $usuario->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="obs">Observação</label>
                    <textarea name="obs" id="obs">{{ $contribuicao->obs }}</textarea>
                </div>
                <div class="modal-right-footer">
                    <a href="{{ route('contribuicao.index') }}" class="btn btn-secondary-outline">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Atualizar</button>
                </div>
            </form>
        </div>
    @endsection
</x-app-layout>
