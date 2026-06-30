<x-app-layout>
    @section('header')
        <div class="page-header">
            <h1>Editar Evento</h1>
            <p>Atualize os dados do evento.</p>
        </div>
    @endsection

    @section('contente')
        <div class="table-container">
            <form action="{{ route('evento.update', $evento) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" id="nome" value="{{ $evento->nome }}" required>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="tipo">Tipo</label>
                        <input type="text" name="tipo" id="tipo" value="{{ $evento->tipo }}" required>
                    </div>
                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <select name="estado" id="estado">
                            <option value="planejado" {{ $evento->estado == 'planejado' ? 'selected' : '' }}>Planejado</option>
                            <option value="em_andamento" {{ $evento->estado == 'em_andamento' ? 'selected' : '' }}>Em Andamento</option>
                            <option value="finalizado" {{ $evento->estado == 'finalizado' ? 'selected' : '' }}>Finalizado</option>
                            <option value="cancelado" {{ $evento->estado == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="data">Data</label>
                        <input type="date" name="data" id="data" value="{{ $evento->data }}" required>
                    </div>
                    <div class="form-group">
                        <label for="hora">Hora</label>
                        <input type="time" name="hora" id="hora" value="{{ $evento->hora }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="local">Local</label>
                    <input type="text" name="local" id="local" value="{{ $evento->local }}" required>
                </div>
                <div class="form-group">
                    <label for="finalidade">Finalidade</label>
                    <textarea name="finalidade" id="finalidade">{{ $evento->finalidade }}</textarea>
                </div>
                <div class="form-group">
                    <label for="tema">Tema</label>
                    <input type="text" name="tema" id="tema" value="{{ $evento->tema }}">
                </div>
                <div class="modal-right-footer">
                    <a href="{{ route('evento.index') }}" class="btn btn-secondary-outline">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Atualizar</button>
                </div>
            </form>
        </div>
    @endsection
</x-app-layout>
