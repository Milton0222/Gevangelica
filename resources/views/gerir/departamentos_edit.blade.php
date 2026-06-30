<x-app-layout>
    @section('header')
        <div class="page-header">
            <h1>Editar Departamento</h1>
            <p>Atualize os dados do departamento.</p>
        </div>
    @endsection

    @section('contente')
        <div class="table-container">
            <form action="{{ route('departamento.update', $departamento) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" id="nome" value="{{ $departamento->nome }}" required>
                </div>
                <div class="form-group">
                    <label for="lider_id">Líder</label>
                    <select name="lider_id" id="lider_id">
                        @foreach($lideres as $lider)
                            <option value="{{ $lider->id }}" {{ $departamento->lider_id == $lider->id ? 'selected' : '' }}>{{ $lider->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-right-footer">
                    <a href="{{ route('departamento.index') }}" class="btn btn-secondary-outline">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Atualizar</button>
                </div>
            </form>
        </div>
    @endsection
</x-app-layout>
