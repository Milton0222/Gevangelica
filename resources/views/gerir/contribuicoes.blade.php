<x-app-layout>
    @section('header')
        <div class="page-header">
            <h1>Gestão de Contribuições</h1>
            <p>Registo e acompanhamento das contribuições da igreja.</p>
        </div>
        <a href="{{ route('contribuicao.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nova Contribuição
        </a>
    @endsection

    @section('contente')
        <div class="filter-container">
            <form class="filter-form">
                <div class="form-group">
                    <label>Pesquisar por Tipo</label>
                    <input type="text" placeholder="Ex: Dízimo">
                </div>
            </form>
        </div>

        <div class="table-container">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Valor</th>
                        <th>Membro</th>
                        <th>Registado por</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contribuicoes as $contribuicao)
                        <tr>
                            <td><strong>{{ $contribuicao->tipo }}</strong></td>
                            <td>{{ $contribuicao->valor }}</td>
                            <td>{{ $contribuicao->membro->nome ?? 'N/A' }}</td>
                            <td>{{ $contribuicao->usuario->name ?? 'N/A' }}</td>
                            <td class="text-center">
                                <div class="table-actions">
                                    <a href="{{ route('contribuicao.show', $contribuicao) }}" class="btn-action edit" title="Ver"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('contribuicao.edit', $contribuicao) }}" class="btn-action edit" title="Editar"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('contribuicao.destroy', $contribuicao) }}" method="POST" style="display:inline;">
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
