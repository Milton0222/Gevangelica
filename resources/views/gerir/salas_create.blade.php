<x-app-layout>
    @section('header')
        <div class="page-header">
            <h1>Criar Sala</h1>
            <p>Registe uma nova sala.</p>
        </div>
    @endsection

    @section('contente')
        <div class="table-container">
            <form action="{{ route('sala.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="n_sala">Nome da Sala</label>
                    <input type="text" name="n_sala" id="n_sala" required>
                </div>
                <div class="form-group">
                    <label for="estado">Estado</label>
                    <select name="estado" id="estado">
                        <option value="disponível">Disponível</option>
                        <option value="ocupada">Ocupada</option>
                        <option value="manutenção">Manutenção</option>
                    </select>
                </div>
                <div class="modal-right-footer">
                    <a href="{{ route('sala.index') }}" class="btn btn-secondary-outline">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    @endsection
</x-app-layout>
