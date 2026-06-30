<x-app-layout>
    @section('header')
        <div class="page-header">
            <h1>Gestão de Salas</h1>
            <p>Controle das salas e estados de ocupação.</p>
        </div>
        <a href="{{ route('sala.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nova Sala
        </a>
    @endsection

    @section('contente')
        <div class="filter-container">
            <form class="filter-form">
                <div class="form-group">
                    <label>Pesquisar por Nome</label>
                    <input type="text" placeholder="Ex: Sala 1">
                </div>
            </form>
        </div>

        <div class="table-container">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Estado</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($salas as $sala)
                        <tr>
                            <td><strong>{{ $sala->n_sala }}</strong></td>
                            <td>{{ $sala->estado }}</td>
                            <td class="text-center">
                                <div class="table-actions">
                                    <a href="{{ route('sala.show', $sala) }}" class="btn-action edit" title="Ver"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('sala.edit', $sala) }}" class="btn-action edit" title="Editar"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('sala.destroy', $sala) }}" method="POST" style="display:inline;">
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
