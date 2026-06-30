<x-app-layout>
    @section('header')
        <div class="page-header">
            <h1>Editar Sala</h1>
            <p>Atualize os dados da sala.</p>
        </div>
    @endsection

    @section('contente')
        <div class="table-container">
            <form action="{{ route('sala.update', $sala) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="n_sala">Nome da Sala</label>
                    <input type="text" name="n_sala" id="n_sala" value="{{ $sala->n_sala }}" required>
                </div>
                <div class="form-group">
                    <label for="estado">Estado</label>
                    <select name="estado" id="estado">
                        <option value="disponível" {{ $sala->estado == 'disponível' ? 'selected' : '' }}>Disponível</option>
                        <option value="ocupada" {{ $sala->estado == 'ocupada' ? 'selected' : '' }}>Ocupada</option>
                        <option value="manutenção" {{ $sala->estado == 'manutenção' ? 'selected' : '' }}>Manutenção</option>
                    </select>
                </div>
                <div class="modal-right-footer">
                    <a href="{{ route('sala.index') }}" class="btn btn-secondary-outline">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Atualizar</button>
                </div>
            </form>
        </div>
    @endsection
</x-app-layout>
