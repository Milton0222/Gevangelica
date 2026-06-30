<x-app-layout>
    @section('header')
        <div class="page-header">
            <h1>Detalhes da Sala</h1>
            <p>Informações da sala.</p>
        </div>
    @endsection

    @section('contente')
        <div class="table-container">
            <h3>{{ $sala->n_sala }}</h3>
            <p><strong>Estado:</strong> {{ $sala->estado }}</p>
            <div class="modal-right-footer">
                <a href="{{ route('sala.index') }}" class="btn btn-secondary-outline">Voltar</a>
            </div>
        </div>
    @endsection
</x-app-layout>
