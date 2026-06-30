<x-app-layout>
    @section('header')
        <div class="page-header">
            <h1>Detalhes do Departamento</h1>
            <p>Informações do departamento e líder.</p>
        </div>
    @endsection

    @section('contente')
        <div class="table-container">
            <h3>{{ $departamento->nome }}</h3>
            <p><strong>Líder:</strong> {{ $departamento->lider->name ?? 'N/A' }}</p>
            <div class="modal-right-footer">
                <a href="{{ route('departamento.index') }}" class="btn btn-secondary-outline">Voltar</a>
            </div>
        </div>
    @endsection
</x-app-layout>
