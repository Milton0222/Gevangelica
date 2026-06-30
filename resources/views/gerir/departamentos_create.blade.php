<x-app-layout>
    @section('header')
        <div class="page-header">
            <h1>Criar Departamento</h1>
            <p>Registe um novo departamento.</p>
        </div>
    @endsection

    @section('contente')
        <div class="table-container">
            <form action="{{ route('departamento.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" id="nome" required>
                </div>
                <div class="form-group">
                    <label for="lider_id">Líder</label>
                    <select name="lider_id" id="lider_id">
                        @foreach($lideres as $lider)
                            <option value="{{ $lider->id }}">{{ $lider->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-right-footer">
                    <a href="{{ route('departamento.index') }}" class="btn btn-secondary-outline">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    @endsection
</x-app-layout>
