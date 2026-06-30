<x-app-layout>
    @section('header')
        <div class="page-header">
            <h1>Detalhes do Evento</h1>
            <p>Informações completas do evento.</p>
        </div>
    @endsection

    @section('contente')
        <div class="table-container">
            <h3>{{ $evento->nome }}</h3>
            <p><strong>Tipo:</strong> {{ $evento->tipo }}</p>
            <p><strong>Data:</strong> {{ $evento->data }}</p>
            <p><strong>Hora:</strong> {{ $evento->hora }}</p>
            <p><strong>Local:</strong> {{ $evento->local }}</p>
            <p><strong>Estado:</strong> {{ $evento->estado }}</p>
            <p><strong>Finalidade:</strong> {{ $evento->finalidade }}</p>
            <p><strong>Tema:</strong> {{ $evento->tema }}</p>
            <div class="modal-right-footer">
                <a href="{{ route('evento.index') }}" class="btn btn-secondary-outline">Voltar</a>
            </div>
        </div>
    @endsection
</x-app-layout>
