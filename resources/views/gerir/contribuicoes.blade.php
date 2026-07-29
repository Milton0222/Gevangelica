<x-app-layout>
    @section('header')
        <div class="page-header">
            <h1>Gestão de Contribuições</h1>
            <p>Registo e acompanhamento das contribuições da igreja.</p>
        </div>
       <!-- <a href="{{ route('contribuicao.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nova Contribuição
        </a>-->
          <button class="btn btn-primary" id="btnAbrirCadastro">
        <i class="fas fa-user-plus"></i> Nova Contribuição
    </button>
    @endsection

    @section('contente')
        <div class="filter-container">
            <form class="filter-form">
                <div class="form-group">
                    <label>Pesquisar por Data</label>
                    <input type="date" id="fillterdate">
                </div>
                <div class="form-group">
                    <label for="">Tipo</label>
                    <select id="filltertipo">
                        <option value="">Selecionar</option>
                        <option value="Oferta"><i class="fas fa-heart"></i>Ofertas</option>
                        <option value="Dizimo"><i class="fas fa-coins"></i>Dízimos</option>
                        <option value="all">Todos</option>
                    </select>
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
                                   <!-- <a href="{{ route('contribuicao.show', $contribuicao) }}" class="btn-action edit" title="Ver"><i class="fas fa-eye"></i>ver</a>-->
                                    <a onclick="actualizar('{{$contribuicao->id}}','{{$contribuicao->tipo}}','{{$contribuicao->valor}}','{{$contribuicao->obs}}','{{$contribuicao->membro_id}}')" class="btn-action edit" title="Editar"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('contribuicao.destroy', $contribuicao->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="confirm(`Desejas apagar o contribuição selecionada?`)" class="btn-action delete" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
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

<!--modal cadstro contribuiçoes--> 

<div class="modal-right-overlay" id="modalCadastro">
    <div class="modal-right">
        <div class="modal-right-header">
            <h2 id="modal-title"><i class="fas fa-user-plus"></i> Registar Nova Contribuição</h2>
            <button class="close-modal-btn" id="btnFecharCadastro">&times;</button>
        </div>
        <div class="modal-right-body">
             <form action="{{ route('contribuicao.store') }}" id="form-editar" method="POST">
                @csrf
                <div class="form-group">
                    <label for="tipo">Tipo</label>
                    <select name="tipo" id="tipo" required>
                        <option value="">Selecionar</option>
                        <option value="Dizimo">Dízimo</option>
                        <option value="Oferta">Oferta</option>
                     
                    </select>
                </div>
                <div class="form-group">
                    <label for="valor">Valor</label>
                    <input type="number" step="0.01" name="valor" id="valor" required placeholder="Informe o valor da contribuição">
                </div>
                <div class="form-group">
                    <label for="membro_id">Membro</label>
                    <select name="membro_id" id="membro_id" required>
                        <option value="">Selecionar</option>
                        @foreach($membros as $membro)
                            <option value="{{ $membro->id }}">{{ $membro->nome }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="user_id">Registado por</label>
                    <select name="user_id" id="user_id">
                            <option selected value="{{Auth::user()->id }}">{{Auth::user()->name }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="obs">Observação</label>
                    <textarea name="obs" id="obs"></textarea>
                </div>
                <div class="modal-right-footer">
                    <button type="button" class="btn btn-secondary-outline" id="btnCancelarCadastro">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar Registo</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
       function actualizar(id, tipo, valor, obs,membro_id){
               //abrir modal
        document.getElementById('modalCadastro').classList.add("active");

        //mudificar o headeer da modal cadtro
        document.getElementById('modal-title').textContent = `Editando dados de ${tipo}`;


        //alterar dados dos input 
        document.getElementById('tipo').value=tipo;
        document.getElementById('valor').value=valor;
        document.getElementById('obs').value=obs;
        document.getElementById('membro_id').value=membro_id;

          //altera as opcoes do for

        const formEdit = document.getElementById('form-editar')
        formEdit.action = `/contribuicoes/${id}`;
        formEdit.method = 'post';

        //aleterar o method para put

        let methodInput = formEdit.querySelector('input[name="_method"]');
        if (!methodInput) {
            methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            formEdit.appendChild(methodInput);
        }
        methodInput.value = 'PUT';


       }

       //filtrar

       function filltrar(){
          const data= document.getElementById('fillterdate').value;
          const tipo= document.getElementById('filltertipo').value;

          if(!data && !tipo) return;

          const parans=new URLSearchParams();
          if(data)parans.append('data', data);
          if(tipo)parans.append('tipo', tipo);
          window.location.href='/contribuicoes?'+parans.toString();
       }

       //listenner 

        document.getElementById('fillterdate')?.addEventListener('input', filltrar);
        document.getElementById('filltertipo')?.addEventListener('change', filltrar);
</script>
