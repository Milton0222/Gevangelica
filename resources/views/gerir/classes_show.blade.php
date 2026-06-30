<x-app-layout>
    @section('header')
        <div class="page-header">
            <h1>Detalhes da Classe</h1>
            <p>Informações da classe e membros associados.</p>
        </div>
    @endsection

    @section('contente')
        <div class="table-container">
            <h3>{{ $classe->grupo }}</h3>
            <p><strong>Frequência:</strong> {{ $classe->frequencia }}</p>
            <p><strong>Evento:</strong> {{ $classe->evento->nome ?? 'N/A' }}</p>
            <p><strong>Professor:</strong> {{ $classe->professor->name ?? 'N/A' }}</p>
            <div class="modal-right-footer">
                <a href="{{ route('classe.index') }}" class="btn btn-secondary-outline">Voltar</a>
            </div>
        </div>
    @endsection
</x-app-layout>
