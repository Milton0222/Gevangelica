<x-app-layout>
    @section('header')
    <div class="page-header">
        <h1>Gestão de Departamentos</h1>
        <p>Controle dos departamentos e líderes.</p>
    </div>
    <button class="btn btn-primary" id="btnAbrirCadastro">
        <i class="fas fa-plus"></i>Novo Departamento
    </button>
    <!--<a href="{{ route('departamento.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Novo Departamento
    </a>-->
    @endsection

    @section('contente')
    <div class="filter-container">
        <form class="filter-form">
            <div class="form-group">
                <label>Pesquisar por Nome</label>
                <input type="text" id="fillternome" placeholder="Ex: Louvor">
            </div>
            <div class="form-group">
                <label for="lider_id">Líder</label>
                <select name="lider_id" id="fillterlider">
                    <option value="">Selecionar</option>
                   
                    @foreach($lideres as $lider)
                    <option value="{{ $lider->id }}">{{ $lider->nome }}</option>
                    @endforeach
                     <option value="all">Todos</option>
                </select>
            </div>
        </form>
    </div>

    <div class="table-container">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Líder</th>
                    <th>REgistado</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($departamentos as $departamento)
                <tr>
                    <td><strong>{{ $departamento->nome }}</strong></td>
                    <td>{{ $departamento->lider->nome ?? 'N/A' }}</td>
                    <td>{{$departamento->created_at}}</td>
                    <td class="text-center">
                        <div class="table-actions">
                            <a href="{{ route('departamento.show', $departamento) }}" class="btn-action edit" title="Ver"><i class="fas fa-eye"></i></a>
                            <a onclick="actualizar('{{$departamento->id}}','{{$departamento->nome}}','{{$departamento->lider_id}}')" class="btn-action edit" title="Editar"><i class="fas fa-edit"></i></a>

                            <button onclick="apagar('{{$departamento->id}}','{{$departamento->nome}}','{{$departamento->lider_id}}')" class="btn-action delete" title="Eliminar"><i class="fas fa-trash-alt"></i></button>

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
            <form action="{{route('departamento.store')}}" method="POST" id="form-cadastro">
                @csrf
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" id="nome" placeholder="Inform o nomedo departamento" required>
                </div>
                <div class="form-group">
                    <label for="lider_id">Líder</label>
                    <select name="lider_id" id="lider_id">
                        <option value="">Selecionar</option>
                        @foreach($lideres as $lider)
                        <option value="{{ $lider->id }}">{{ $lider->nome }}</option>
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
    //filter
    function filtrar() {

    const nome =document.getElementById('fillternome').value;
    const lider =document.getElementById('fillterlider').value;

    if(!nome && !lider)return;

    const parans=new URLSearchParams();

    if(nome)parans.append('nome',nome);
    if(lider)parans.append('lider',lider);
    window.location.href='/departamentos?'+parans.toString();

    }

    //listnner
    document.getElementById('fillternome').addEventListener('input',filtrar);
    document.getElementById('fillterlider').addEventListener('change',filtrar);
    //atualizar dados

    function actualizar(id, nome, lider) {
        //abrir modal
        document.getElementById('modalCadastro').classList.add("active");



        //mudificar o headeer da modal cadtro
        document.getElementById('modal-title').textContent = `Editando dados de ${nome}`;
        document.getElementById('nome').value = nome;
        document.getElementById('lider_id').value = lider;

        //altera as opcoes do for

        const formEdit = document.getElementById('form-cadastro')
        formEdit.action = `/departamentos/${id}`;
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

    //apagar dados

    function apagar(id, nome, lider) {

        if (confirm(`Desejas apagar o departamento com os seguintes dados:\nNome: ${nome}\nCodigo de registo: ${id}`)) {

            // Criar formulário para enviar DELETE via POST (Laravel)
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/departamentos/${id}`;

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