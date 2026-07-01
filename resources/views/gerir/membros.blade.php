<x-app-layout>
    @section('header')
    <div class="page-header">
        <h1>Gestão de Membros</h1>
        <p>Controle de registos, consultas e estatísticas da congregação.</p>
    </div>
    <button class="btn btn-primary" id="btnAbrirCadastro">
        <i class="fas fa-user-plus"></i> Novo Membro
    </button>
    @endsection

    @section('contente')

    <div class="filter-container">
        <form class="filter-form">
            <div class="form-group">
                <label>Pesquisar por Nome</label>
                <input type="text" id="fillternome" placeholder="Ex: Nome do membro...">
            </div>
            <div class="form-group">
                <label>Estado</label>
                <select id="fillterestado">
                    <option value="">selecionar</option>
                    <option value="Activo">Ativo</option>
                    <option value="Inativo">Inativo</option>
                    <option value="Transferido">Transferido</option>
                    <option value="all">Todos</option>
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
                    <th>Nome</th>
                    <th>Telefone</th>
                    <th>Data de Batismo</th>
                    <th>Idade</th>
                    <th>Estado</th>
                    <th>Registado</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                @php
                $idade=0;
                @endphp
                @foreach ($membros as $meb)
                <tr>
                    <td>
                        <div class="avatar">MA</div>
                    </td>
                    <td><strong>{{$meb->nome}}</strong></td>
                    <td>+244 {{$meb->telefone}}</td>
                    <td>
                        @if($meb->data_batismo==null)
                        N/Batizado.
                        @else
                        {{$meb->data_batismo}}
                        @endif
                    </td>
                    <td><span class="badge badge-info">
                            @php
                            $data_nas=explode('-',$meb->data_nascimento);
                            $idade=date('Y')-$data_nas[0];

                            @endphp
                            {{$idade}}</span></td>
                    <td><span class="badge badge-success">{{$meb->situacao}}</span></td>
                    <td>{{$meb->user->name}}</td>
                    <td class="text-center">
                        <div class="table-actions">
                            <button class="btn-action edit" onclick="actualizar('{{$meb->id}}','{{$meb->nome}}','{{$meb->email}}','{{$meb->morada}}','{{$meb->data_nascimento}}','{{$meb->data_batismo}}','{{$meb->genero}}','{{$meb->situacao}}','{{$meb->cargo}}','{{$meb->estado_civil}}','{{$meb->telefone}}')" title="Editar"><i class="fas fa-edit"></i></button>
                            <button class="btn-action delete" onclick="apagar('{{$meb->id}}','{{$meb->nome}}')" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
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
            <h2 id="modal-title"><i class="fas fa-user-plus"></i> Registar Novo Membro</h2>
            <button class="close-modal-btn" id="btnFecharCadastro">&times;</button>
        </div>
        <div class="modal-right-body">
            <form action="{{ route('membro.store') }}" method="POST" id="form-membro">
                @csrf
                <div class="form-group">
                    <label for="nome">Nome Completo *</label>
                    <input type="text" id="nome" name="nome" required placeholder="Insira o nome completo">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="genero">Género</label>
                        <select id="genero" name="genero" required>
                            <option value="">Selecionar</option>
                            <option value="M">Masculino</option>
                            <option value="F">Feminino</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="data_nasc">Data de Nascimento</label>
                        <input type="date" id="data_nascimento" name="data_nascimento" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="telefone">Telefone / Contacto *</label>
                    <input type="tel" maxlength="9" pattern="[0-9]+" id="telefone" name="telefone" required placeholder="Ex: 923000000">
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" required placeholder="exemplo@igreja.com">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="data_batismo">Data de Batismo</label>
                        <input type="date" id="data_batismo" name="data_batismo">
                    </div>
                    <div class="form-group">
                        <label for="status">Estado Membro *</label>
                        <select id="situacao" name="situacao">
                            <option value="">Seleciona</option>
                            <option value="Activo">Ativo</option>
                            <option value="Inativo">Inativo</option>
                            <option value="Transferido">Transferido</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="ministerio">Estado civil</label>
                    <select id="estado_civil" name="estado_civil" required>
                        <option value="">Selecionar</option>
                        <option value="Casado">Casado(a)</option>
                        <option value="Solteiro">Solteiro(a)</option>
                        <option value="Viuvo">Viúvo(a)</option>
                        <option value="Divorciado">Divorciado(a)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="morada">Morada (Bairro / Cidade)</label>
                    <input type="text" maxlength="20" id="morada" name="morada" placeholder="Ex: Zona A, Benguela" required>
                </div>
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">

                <div class="modal-right-footer">
                    <button type="button" class="btn btn-secondary-outline" id="btnCancelarCadastro">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar Registo</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

    //filtrar dados
    function fillter(){
        const nome=document.getElementById('fillternome').value;
        const situacao=document.getElementById('fillterestado').value;

        if(!nome && !situacao) return;

        const parans=new URLSearchParams();
        if(nome)parans.append('nome',nome);
        if(situacao)parans.append('situacao',situacao);
        window.location.href='/membros?'+parans.toString();
    }
    document.getElementById('fillternome').addEventListener('input',fillter);
    document.getElementById('fillterestado').addEventListener('change',fillter);

    //atualizar dados

    function actualizar(id,nome,email,morada,data_nascimento,data_batismo,genero,situacao,cargo,estado_civil,telefone){
          document.getElementById('modalCadastro').classList.add("active");

          document.getElementById('modal-title').textContent=`Editando dados de ${nome}`;

          document.getElementById('nome').value=nome;
          document.getElementById('email').value=email;
          document.getElementById('morada').value=morada;
          document.getElementById('data_nascimento').value=data_nascimento;
          document.getElementById('data_batismo').value=data_batismo;
          document.getElementById('genero').value=genero;
          document.getElementById('situacao').value=situacao;
          document.getElementById('estado_civil').value=estado_civil;
          document.getElementById('telefone').value=telefone;

           //altera as opcoes do for

        const formEdit = document.getElementById('form-membro')
        formEdit.action = `/membros/${id}`;
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

    //apagar membro

    function apagar(id,nome){

    if(confirm(`Desejas apagar o membro registado como:\n${nome} com o código ${id}`)){

       // Criar formulário para enviar DELETE via POST (Laravel)
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/membros/${id}`;

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