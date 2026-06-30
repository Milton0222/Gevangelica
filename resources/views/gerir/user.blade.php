<x-app-layout>
    @section('header')
    <div class="page-header">
        <h1>Gestão de Utilizadores</h1>
        <p>Controle de registos, consultas e definição de perfil.</p>
    </div>
    <button class="btn btn-primary" id="btnAbrirCadastro">
        <i class="fas fa-user-plus"></i> Novo Utilizador
    </button>
    @endsection

    @section('contente')
    <div class="filter-container">
        <form class="filter-form">
            <div class="form-group">
                <label>Pesquisar por Nome</label>
                <input type="text" placeholder="Ex: Nome do membro...">
            </div>
            <div class="form-group">
                <label>Tipos</label>
                <select>
                    <option value="">Todos</option>
                    <option value="ativo">Ativo</option>
                    <option value="inativo">Inativo</option>
                </select>
            </div>

            <!-- <div class="form-group btn-filter-align">
                            <button type="submit" class="btn btn-secondary"><i class="fas fa-search"></i> Filtrar</button>
                        </div>-->
        </form>
    </div>

    <div class="table-container">
        <table class="custom-table">
            <thead>
                <tr>
                    <th></th>
                    <th>Nome Completo</th>
                    <th>User Name</th>
                    <th>Acessos</th>

                    <th>Status</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $user)
                <tr>
                    <td>
                        <div class="avatar">MA</div>
                    </td>
                    <td><strong>{{$user->name}}</strong></td>
                    <td>{{$user->email}}</td>
                    <td><span class="badge badge-info">
                            @if($user->isAdmin==1)
                               Admin
                            @elseif($user->isPastar==1)
                                Pastor
                            @elseif($user->isMembro==1)
                                Membro
                            @elseif($user->isSecretario==1)
                                Secretario(a)
                            @elseif ($user->isTesoureiro==1)
                                Tesoureiro
                            @elseif ($user->isLider==1)
                                Lider
                            @endif
                        </span></td>
                    <td><span class="badge badge-success">Ativo</span></td>
                    <td class="text-center">
                        <div class="table-actions">
                            <button class="btn-action edit" onclick="actualizar('{{$user->id}}','{{$user->name}}','{{$user->email}}')" title="Editar"><i class="fas fa-edit"></i></button>
                            <button class="btn-action delete" onclick="apagar('{{$user->id}}','{{$user->name}}','{{$user->email}}')" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
                            <a class="btn-action edit" href="{{route('usuario.desabilitar',$user->id)}}" title="Desabilitar/habilitar"><i class="fas fa-check-circle"></i></a>
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
            <h2 id="modal-title"><i class="fas fa-user-plus"></i> Registar Novo Utilizador</h2>
            <button class="close-modal-btn" id="btnFecharCadastro">&times;</button>
        </div>
        <div class="modal-right-body">
            <form action="{{route('usuario.store')}}" method="POST" id="form-cadastro">
                @csrf
                <div class="form-group">
                    <label for="nome">Nome Completo *</label>
                    <input type="text" id="name" required name="name" placeholder="Insira o nome completo">
                </div>
                <div class="form-group">
                    <label for="genero">Email *</label>
                    <input type="email" name="email" id="email" required placeholder="exemplo@gmail.com">
                </div>
                <label for="data_nasc" style="margin-left: 40%; margin-top: 20px;">Tipo de Utilizador</label>

                <div class="from-group">
                    <label for="">Lider</label>
                    <input type="checkbox" name="isLider" id="">
                </div>
                <div class="from-group">
                    <label for="">Pastor</label>
                    <input type="checkbox" name="isPastar" id="">
                </div>
                <div class="from-group">
                    <label for="">Membro</label>
                    <input type="checkbox" name="isMembro" id="">
                </div>
                <div class="from-group">
                    <label for="">Tesoureiro</label>
                    <input type="checkbox" name="isTesoureiro" id="">
                </div>
                <div class="from-group">
                    <label for="">Secretario(a)</label>
                    <input type="checkbox" name="isSecretario" id="">
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
    //actualizar dados 
    function actualizar(id, name, email) {
        //abrir modal
        document.getElementById('modalCadastro').classList.add("active");

        //mudificar o headeer da modal cadtro
        document.getElementById('modal-title').textContent = `Editando dados de ${name}`;


        //aterar o value dos inputs
        document.getElementById('name').value = name;
        document.getElementById('email').value = email;

        //altera as opcoes do for

        const formEdit = document.getElementById('form-cadastro')
        formEdit.action = `/usuarios/${id}`;
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
    //apagar utilizador

    function apagar(id, name, email) {
        if (confirm(`Desejas apagar o utilizador\nID: ${id}\nNome:${name}\nUserName:${email}`)) {
            // Criar formulário para enviar DELETE via POST (Laravel)
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/usuarios/${id}`;

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