<x-app-layout>
    @section('header')
    <div class="page-header">
        <h1>Gestão de Salas</h1>
        <p>Controle das salas e estados de ocupação.</p>
    </div>
    <button class="btn btn-primary" id="btnAbrirCadastro">
        <i class="fas fa-plus"></i> Nova Sala
    </button>
    <!--<a href="{{ route('sala.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Nova Sala
    </a>-->
    @endsection

    @section('contente')
    <div class="filter-container">
        <form class="filter-form">
            <div class="form-group">
                <label>Pesquisar por Nome</label>
                <input type="number" placeholder="Ex: 1" id="filltersala">
            </div>
            <div class="form-group">
                <label>Estado</label>
                <select id="fillterestado">
                    <option value="">Selecionar</option>
                    <option value="Livre">Disponível</option>
                    <option value="Reservado">Reservado</option>
                    <option value="Pendente">Pendente</option>
                    <option value="all">Todas</option>
                </select>
            </div>
        </form>
    </div>

    <div class="table-container">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>Identificador</th>
                    <th>Estado</th>
                    <th>Regitado</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($salas as $sala)
                <tr>
                    <td><strong>S0{{ $sala->n_sala }}</strong></td>
                    <td>{{ $sala->estado }}</td>
                    <th>{{$sala->created_at}}</th>
                    <td class="text-center">
                        <div class="table-actions">
                            <a href="{{ route('sala.show', $sala) }}" class="btn-action edit" title="Ver"><i class="fas fa-eye"></i></a>
                            <a onclick="actualizar('{{$sala->id}}','{{$sala->n_sala}}','{{$sala->estado}}')" class="btn-action edit" title="Editar"><i class="fas fa-edit"></i></a>
                            <button class="btn-action delete" onclick="apagar('{{$sala->id}}','{{$sala->n_sala}}')"><i class="fas fa-trash-alt"></i></button>

                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endsection
</x-app-layout>
<div class="modal-right-overlay" id="modalCadastro">
    <div class="modal-right">
        <div class="modal-right-header">
            <h2 id="modal-title"><i class="fas fa-key"></i> Registar Nova Sala</h2>
            <button class="close-modal-btn" id="btnFecharCadastro">&times;</button>
        </div>
        <div class="modal-right-body">
            <form action="{{ route('sala.store') }}" method="POST" id="form-cadastro">
                @csrf
                <div class="form-group">
                    <label for="n_sala">Identificador da Sala</label>
                    <input type="number" name="n_sala" id="n_sala" required>
                </div>
                <div id="corpo">
                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <select name="estado" id="estado">
                            <option value="">Selecionar</option>
                            <option value="Livre">Disponível</option>
                            <option value="Reservado">Reservado</option>
                            <option value="Pendente">Pendente</option>
                        </select>
                    </div>

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
    document.getElementById('corpo').style.display = 'none';

   
   //filtrar
   function filtrar(){
        const sala=document.getElementById('filltersala').value;
        const estado=document.getElementById('fillterestado').value;

        if(!sala && !estado)return;

        const parans=new URLSearchParams();

        if(estado)parans.append('estado',estado);
        if(sala)parans.append('sala',sala);
        window.location.href='/salas?'+parans.toString();

   }
   //listenner para os filtros
   document.getElementById('filltersala').addEventListener('input',filtrar);
   document.getElementById('fillterestado').addEventListener('change',filtrar);

    //atualizar dados

    function actualizar(id, sala, estado) {
        //abrir modal
        document.getElementById('modalCadastro').classList.add("active");

        //exibir div estado 
        document.getElementById('corpo').style.display = 'block';

        //mudificar o headeer da modal cadtro
        document.getElementById('modal-title').textContent = `Editando dados da sala ${sala}`;
        document.getElementById('estado').value = estado;
        document.getElementById('n_sala').value = sala;

        //altera as opcoes do for

        const formEdit = document.getElementById('form-cadastro')
        formEdit.action = `/salas/${id}`;
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

    //apagar 
    function apagar(id, sala) {
        if (confirm(`Deseja apagar a sala com os seguintes dados:\nIdentificador: ${sala}\nCodigo de registo: ${id}`)) {

            // Criar formulário para enviar DELETE via POST (Laravel)
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/salas/${id}`;

            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = '_token';
            input.value = csrfToken ? csrfToken.getAttribute('content') : '';

            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';

            form.appendChild(input);
            form.appendChild(methodInput);
            document.body.appendChild(form);
            form.submit();
        }
    }
</script>