<x-app-layout>
    @section('header')
        <div class="page-header">
            <h1>Detalhes do Membro</h1>
            <p>Informações completas do registo selecionado.</p>
        </div>
    @endsection

    @section('contente')
        <div class="table-container">
            <h3>{{ $membro->nome }}</h3>
            <p><strong>Telefone:</strong> {{ $membro->telefone }}</p>
            <p><strong>Estado Civil:</strong> {{ $membro->estado_civil }}</p>
            <p><strong>Situação:</strong> {{ $membro->situcao }}</p>
            <p><strong>Data de Batismo:</strong> {{ $membro->data_batismo }}</p>
            <p><strong>Morada:</strong> {{ $membro->morada }}</p>
            <p><strong>Cargo:</strong> {{ $membro->cargo ?? 'Nenhum' }}</p>
            <div class="modal-right-footer">
                <a href="{{ route('membro.index') }}" class="btn btn-secondary-outline">Voltar</a>
            </div>
        </div>
    @endsection
</x-app-layout>
