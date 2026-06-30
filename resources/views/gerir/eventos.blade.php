<x-app-layout>
    @section('header')
        <div class="page-header">
            <h1>Gestão de Eventos</h1>
            <p>Controle dos eventos da igreja.</p>
        </div>
        <a href="{{ route('evento.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Novo Evento
        </a>
    @endsection

    @section('contente')
        <div class="filter-container">
            <form class="filter-form">
                <div class="form-group">
                    <label>Pesquisar por Nome</label>
                    <input type="text" placeholder="Ex: Culto">
                </div>
            </form>
        </div>

        <div class="table-container">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Tipo</th>
                        <th>Data</th>
                        <th>Local</th>
                        <th>Estado</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($eventos as $evento)
                        <tr>
                            <td><strong>{{ $evento->nome }}</strong></td>
                            <td>{{ $evento->tipo }}</td>
                            <td>{{ $evento->data }}</td>
                            <td>{{ $evento->local }}</td>
                            <td>{{ $evento->estado }}</td>
                            <td class="text-center">
                                <div class="table-actions">
                                    <a href="{{ route('evento.show', $evento) }}" class="btn-action edit" title="Ver"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('evento.edit', $evento) }}" class="btn-action edit" title="Editar"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('evento.destroy', $evento) }}" method="POST" style="display:inline;">
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
