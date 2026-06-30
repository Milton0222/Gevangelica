<x-app-layout>
    @section('header')
        <div class="page-header">
            <h1>Criar Contribuição</h1>
            <p>Registe uma nova contribuição.</p>
        </div>
    @endsection

    @section('contente')
        <div class="table-container">
            <form action="{{ route('contribuicao.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="tipo">Tipo</label>
                    <select name="tipo" id="tipo">
                        <option value="dízimo">Dízimo</option>
                        <option value="oferta">Oferta</option>
                        <option value="doação">Doação</option>
                        <option value="subscrição">Subscrição</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="valor">Valor</label>
                    <input type="number" step="0.01" name="valor" id="valor" required>
                </div>
                <div class="form-group">
                    <label for="membro_id">Membro</label>
                    <select name="membro_id" id="membro_id">
                        @foreach($membros as $membro)
                            <option value="{{ $membro->id }}">{{ $membro->nome }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="user_id">Registado por</label>
                    <select name="user_id" id="user_id">
                        @foreach($usuarios as $usuario)
                            <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="obs">Observação</label>
                    <textarea name="obs" id="obs"></textarea>
                </div>
                <div class="modal-right-footer">
                    <a href="{{ route('contribuicao.index') }}" class="btn btn-secondary-outline">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    @endsection
</x-app-layout>
