<x-app-layout>
    @section('header')
        <div class="page-header">
            <h1>Gestão de Classes</h1>
            <p>Controle das classes, frequências e professores.</p>
        </div>
       <!-- <a href="{{ route('classe.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nova Classe
        </a>-->
         <button class="btn btn-primary" id="btnAbrirCadastro">
        <i class="fas fa-user-plus"></i>Nova Classe
    </button>
    @endsection

    @section('contente')
        <div class="filter-container">
            <form class="filter-form">
                <div class="form-group">
                    <label>Pesquisar por Grupo</label>
                    <input type="text" id="filltergrupo" placeholder="Informe o nome do grupo">
                </div>
                <div class="form-group">
                    <label>Frequência</label>
                    <select id="fillterfrequencia">
                      
                        <option value="">Selecionar</option>
                         <option value="semanal">Semanal</option>
                        <option value="mensal">Mensal</option>
                        <option value="diária">Diária</option>
                        <option value="trimestral">Trimestral</option>
                          <option value="all">Todas</option>
                    </select>
                </div>
            </form>
        </div>

        <div class="table-container">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Grupo</th>
                        <th>Frequência</th>
                        <th>Evento</th>
                        <th>Professor</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($classes as $classe)
                        <tr>
                            <td><strong>{{ $classe->grupo }}</strong></td>
                            <td>{{ $classe->frequencia }}</td>
                            <td>{{ $classe->evento->nome ?? 'N/A' }}</td>
                            <td>{{ $classe->professor->nome ?? 'N/A' }}</td>
                            <td class="text-center">
                                <div class="table-actions">
                                    <a href="{{ route('classe.show', $classe->id) }}" class="btn-action edit" title="Ver membros"><i class="fas fa-eye"></i></a>
                                    <a onclick="actualizar('{{$classe->id}}','{{$classe->grupo}}','{{$classe->frequencia}}','{{$classe->evento_id}}','{{$classe->professor_id}}')" class="btn-action edit" title="Editar"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('classe.destroy', $classe) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="confirm(`Deseja eliminar a classe selecionado?`)" class="btn-action delete" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
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
            <h2 id="modal-title"><i class="fas fa-user-plus"></i> Registe uma nova classe da escola sabatina.</h2>
            <button class="close-modal-btn" id="btnFecharCadastro">&times;</button>
        </div>
        <div class="modal-right-body">
           
                <form action="{{ route('classe.store') }}" id="form-editar" method="POST">
                @csrf
                <div class="form-group">
                    <label for="grupo">Grupo</label>
                    <input type="text" name="grupo" id="grupo" required placeholder="Informe o grupo de acordo a faixa etária">
                </div>
                <div class="form-group">
                    <label for="frequencia">Frequência</label>
                    <select name="frequencia" id="frequencia" required>
                        <option value="">Selecionar</option>
                        <option value="semanal">Semanal</option>
                        <option value="mensal">Mensal</option>
                        <option value="diária">Diária</option>
                        <option value="trimestral">Trimestral</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="evento_id">Evento</label>
                    <select name="evento_id" id="evento_id">
                        <option value="">Selecionar</option>
                        @foreach($eventos as $evento)
                            <option value="{{ $evento->id }}">{{ $evento->nome }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="professor_id">Professor</label>
                    <select name="professor_id" id="professor_id">
                        <option value="">Selecionar</option>
                        @foreach($professores as $professor)
                            <option value="{{ $professor->id }}">{{ $professor->nome }}</option>
                        @endforeach
                    </select>
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
   
       function actualizar(id, grupo, frequencia, evento_id,professor_id){
               //abrir modal
        document.getElementById('modalCadastro').classList.add("active");

        //mudificar o headeer da modal cadtro
        document.getElementById('modal-title').textContent = `Editando dados da classe ${grupo}`;


        //alterar dados dos input 
        document.getElementById('grupo').value=grupo;
        document.getElementById('frequencia').value=frequencia;
        document.getElementById('evento_id').value=evento_id;
        document.getElementById('professor_id').value=professor_id;

          //altera as opcoes do for

        const formEdit = document.getElementById('form-editar')
        formEdit.action = `/classes/${id}`;
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
          const grupo= document.getElementById('filltergrupo').value;
          const frequencia= document.getElementById('fillterfrequencia').value;

          if(!grupo && !frequencia) return;

          const parans=new URLSearchParams();
          if(grupo)parans.append('grupo', grupo);
          if(frequencia)parans.append('frequencia', frequencia);
          window.location.href='/classes?'+parans.toString();
       }

       //listenner 

        document.getElementById('filltergrupo')?.addEventListener('input', filltrar);
        document.getElementById('fillterfrequencia')?.addEventListener('change', filltrar);
</script>