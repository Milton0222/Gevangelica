<x-app-layout>
    @section('header')
        <div class="page-header">
            <h1>Gestão de Departamentos</h1>
            <p>Controle dos departamentos e líderes.</p>
        </div>
        <a href="{{ route('departamento.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Novo Departamento
        </a>
    @endsection

    @section('contente')
        <div class="filter-container">
            <form class="filter-form">
                <div class="form-group">
                    <label>Pesquisar por Nome</label>
                    <input type="text" placeholder="Ex: Louvor">
                </div>
            </form>
        </div>

        <div class="table-container">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Líder</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($departamentos as $departamento)
                        <tr>
                            <td><strong>{{ $departamento->nome }}</strong></td>
                            <td>{{ $departamento->lider->name ?? 'N/A' }}</td>
                            <td class="text-center">
                                <div class="table-actions">
                                    <a href="{{ route('departamento.show', $departamento) }}" class="btn-action edit" title="Ver"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('departamento.edit', $departamento) }}" class="btn-action edit" title="Editar"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('departamento.destroy', $departamento) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action delete" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endsection
</x-app-layout>
