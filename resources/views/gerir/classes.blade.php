<x-app-layout>
    @section('header')
        <div class="page-header">
            <h1>Gestão de Classes</h1>
            <p>Controle das classes, frequências e professores.</p>
        </div>
        <a href="{{ route('classe.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nova Classe
        </a>
    @endsection

    @section('contente')
        <div class="filter-container">
            <form class="filter-form">
                <div class="form-group">
                    <label>Pesquisar por Grupo</label>
                    <input type="text" placeholder="Ex: Jovens">
                </div>
                <div class="form-group">
                    <label>Frequência</label>
                    <select>
                        <option value="">Todas</option>
                        <option value="semanal">Semanal</option>
                        <option value="mensal">Mensal</option>
                    </select>
                </div>
            </form>
        </div>

        <div class="table-container">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Grupo</th>
                        <th>Frequência</th>
                        <th>Evento</th>
                        <th>Professor</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($classes as $classe)
                        <tr>
                            <td><strong>{{ $classe->grupo }}</strong></td>
                            <td>{{ $classe->frequencia }}</td>
                            <td>{{ $classe->evento->nome ?? 'N/A' }}</td>
                            <td>{{ $classe->professor->name ?? 'N/A' }}</td>
                            <td class="text-center">
                                <div class="table-actions">
                                    <a href="{{ route('classe.show', $classe) }}" class="btn-action edit" title="Ver"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('classe.edit', $classe) }}" class="btn-action edit" title="Editar"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('classe.destroy', $classe) }}" method="POST" style="display:inline;">
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
