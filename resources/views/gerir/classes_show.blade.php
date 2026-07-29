<x-app-layout>
    @section('header')
    <div class="page-header">
        <h1>Detalhes da Classe</h1>
        <p>Informações da classe e membros associados.</p>
    </div>
    @endsection

    @section('contente')

    <div class="table-container">
        <form action="{{ route('classe.membro', $classe->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="evento_id">Membro</label>
                <select name="membro_id" id="membro_id" required>
                    <option value="">Selecionar</option>
                    @foreach($membros as $membro)
                    <option value="{{ $membro->id }}">{{ $membro->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div class="modal-right-footer">
                <a href="{{ route('classe.index') }}" class="btn btn-secondary-outline">Cancelar</a>
                <button type="submit" class="btn btn-primary">Adicionar</button>
            </div>
        </form>
    </div>
    
    <div class="table-container">
        <table class="custom-table">
            <thead>
                <tr>
                  
                    <th>Nome</th>
                    <th>Idade</th>
                    <th>Telefone</th>
                    <th>Data de Baptismo</th>
                   
                </tr>
            </thead>
            <tbody>
                @foreach ($classe_membros as $lista)
                  <tr>
                    <td>{{$lista->nome}}</td>
                    <td>{{$lista->data_nascimento}}</td>
                    <td>{{$lista->telefone}}</td>
                    <td>{{$lista->data_batismo ?? 'N/Batizado'}}</td>
                  </tr>
                    
                @endforeach

            </tbody>

        </table>
    </div>
    @endsection
</x-app-layout>