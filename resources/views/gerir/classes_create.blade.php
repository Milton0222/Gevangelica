<x-app-layout>
    @section('header')
        <div class="page-header">
            <h1>Criar Classe</h1>
            <p>Registe uma nova classe.</p>
        </div>
    @endsection

    @section('contente')
        <div class="table-container">
            <form action="{{ route('classe.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="grupo">Grupo</label>
                    <input type="text" name="grupo" id="grupo" required>
                </div>
                <div class="form-group">
                    <label for="frequencia">Frequência</label>
                    <select name="frequencia" id="frequencia">
                        <option value="semanal">Semanal</option>
                        <option value="mensal">Mensal</option>
                        <option value="diária">Diária</option>
                        <option value="trimestral">Trimestral</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="evento_id">Evento</label>
                    <select name="evento_id" id="evento_id">
                        @foreach($eventos as $evento)
                            <option value="{{ $evento->id }}">{{ $evento->nome }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="professor_id">Professor</label>
                    <select name="professor_id" id="professor_id">
                        @foreach($professores as $professor)
                            <option value="{{ $professor->id }}">{{ $professor->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-right-footer">
                    <a href="{{ route('classe.index') }}" class="btn btn-secondary-outline">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    @endsection
</x-app-layout>
