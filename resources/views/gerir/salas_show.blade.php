<x-app-layout>
    @section('header')
        <div class="page-header">
            <h1>Detalhes da Sala</h1>
            <p>Informações da sala.</p>
        </div>
    @endsection

    @section('contente')
        <div class="table-container">
            <h3><strong>Codigo de registo:</strong> {{ $sala->id}}</h3>
            <p><strong>Estado:</strong> {{ $sala->estado }}</p>
             <h4>{{$sala->created_at}}</h4>
            <div class="modal-right-footer">
                <a href="{{ route('sala.index') }}" class="btn btn-secondary-outline">Voltar</a>
            </div>
        </div>

        <div class="table-container">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>Sala</th>
                    <th>Data</th>
                    <th>Departamento</th>
                    <th>Horário</th>
                    <th class="text-center">Finalidade</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($historico as $aluguer)

                <tr>
                    <td><strong>S0{{$aluguer->sala->n_sala}}</strong></td>
                    <td>{{$aluguer->data}}</td>
                    <th>{{$aluguer->departamento->nome}}</th>
                    <th>{{$aluguer->hora_inicio}} <strong>á</strong> {{$aluguer->hora_fim}}</th>
                    <td class="text-center">
                        {{$aluguer->finalidade}}
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>


    @endsection
</x-app-layout>
