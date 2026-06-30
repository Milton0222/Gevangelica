<x-app-layout>
    @section('header')
        <div class="page-header">
            <h1>Criar Evento</h1>
            <p>Registe um novo evento.</p>
        </div>
    @endsection

    @section('contente')
        <div class="table-container">
            <form action="{{ route('evento.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" id="nome" required>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="tipo">Tipo</label>
                        <input type="text" name="tipo" id="tipo" required>
                    </div>
                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <select name="estado" id="estado">
                            <option value="planejado">Planejado</option>
                            <option value="em_andamento">Em Andamento</option>
                            <option value="finalizado">Finalizado</option>
                            <option value="cancelado">Cancelado</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="data">Data</label>
                        <input type="date" name="data" id="data" required>
                    </div>
                    <div class="form-group">
                        <label for="hora">Hora</label>
                        <input type="time" name="hora" id="hora" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="local">Local</label>
                    <input type="text" name="local" id="local" required>
                </div>
                <div class="form-group">
                    <label for="finalidade">Finalidade</label>
                    <textarea name="finalidade" id="finalidade"></textarea>
                </div>
                <div class="form-group">
                    <label for="tema">Tema</label>
                    <input type="text" name="tema" id="tema">
                </div>
                <div class="modal-right-footer">
                    <a href="{{ route('evento.index') }}" class="btn btn-secondary-outline">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    @endsection
</x-app-layout>
