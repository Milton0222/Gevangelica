<x-app-layout>
    @section('header')
        <div class="page-header">
            <h1>Editar Classe</h1>
            <p>Atualize os dados da classe.</p>
        </div>
    @endsection

    @section('contente')
        <div class="table-container">
            <form action="{{ route('classe.update', $classe) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="grupo">Grupo</label>
                    <input type="text" name="grupo" id="grupo" value="{{ $classe->grupo }}" required>
                </div>
                <div class="form-group">
                    <label for="frequencia">Frequência</label>
                    <select name="frequencia" id="frequencia">
                        <option value="semanal" {{ $classe->frequencia == 'semanal' ? 'selected' : '' }}>Semanal</option>
                        <option value="mensal" {{ $classe->frequencia == 'mensal' ? 'selected' : '' }}>Mensal</option>
                        <option value="diária" {{ $classe->frequencia == 'diária' ? 'selected' : '' }}>Diária</option>
                        <option value="trimestral" {{ $classe->frequencia == 'trimestral' ? 'selected' : '' }}>Trimestral</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="evento_id">Evento</label>
                    <select name="evento_id" id="evento_id">
                        @foreach($eventos as $evento)
                            <option value="{{ $evento->id }}" {{ $classe->evento_id == $evento->id ? 'selected' : '' }}>{{ $evento->nome }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="professor_id">Professor</label>
                    <select name="professor_id" id="professor_id">
                        @foreach($professores as $professor)
                            <option value="{{ $professor->id }}" {{ $classe->professor_id == $professor->id ? 'selected' : '' }}>{{ $professor->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-right-footer">
                    <a href="{{ route('classe.index') }}" class="btn btn-secondary-outline">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Atualizar</button>
                </div>
            </form>
        </div>
    @endsection
</x-app-layout>
