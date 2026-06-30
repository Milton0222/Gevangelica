<x-app-layout>
    @section('header')
        <div class="page-header">
            <h1>Detalhes da Contribuição</h1>
            <p>Informações da contribuição registada.</p>
        </div>
    @endsection

    @section('contente')
        <div class="table-container">
            <h3>{{ $contribuicao->tipo }}</h3>
            <p><strong>Valor:</strong> {{ $contribuicao->valor }}</p>
            <p><strong>Membro:</strong> {{ $contribuicao->membro->nome ?? 'N/A' }}</p>
            <p><strong>Registado por:</strong> {{ $contribuicao->usuario->name ?? 'N/A' }}</p>
            <p><strong>Observação:</strong> {{ $contribuicao->obs }}</p>
            <div class="modal-right-footer">
                <a href="{{ route('contribuicao.index') }}" class="btn btn-secondary-outline">Voltar</a>
            </div>
        </div>
    @endsection
</x-app-layout>
