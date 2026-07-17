<x-app-layout>
    @section('header')
    <div class="page-header">
        <h1>Gestão de Eventos</h1>
        <p>Controle dos eventos da igreja.</p>
    </div>
    <button class="btn btn-primary" id="btnAbrirCadastro">
        <i class="fas fa-user-plus"></i> Novo Evento
    </button>
    <!--
        <a href="{{ route('evento.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Novo Evento
        </a>-->
    @endsection

    @section('contente')
    <div class="filter-container">
        <form class="filter-form">
            <div class="form-group">
                <label>Pesquisar por Nome</label>
                <input type="text" placeholder="Ex: Culto">
            </div>
        </form>
    </div>

    <!-- 'Congressos','Evangelisação',
            'Vigílias','Oração','Seminário','Programas especiais','Estudos bíblicos'-->

    <div class="table-container">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Tipo</th>
                    <th>Data</th>
                    <th>Local</th>
                    <th>Estado</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($eventos as $evento)
                <tr>
                    <td><strong>{{ $evento->nome }}</strong></td>
                    <td>{{ $evento->tipo }}</td>
                    <td>{{ $evento->data }}</td>
                    <td>{{ $evento->local }}</td>
                    <td>{{ $evento->estado }}</td>
                    <td class="text-center">
                        <div class="table-actions">
                            <a href="{{ route('evento.show', $evento) }}" class="btn-action edit" title="Ver"><i class="fas fa-eye"></i>Ver</a>
                            <a onclick="atualizar('{{$evento->id}}','{{$evento->nome}}','{{$evento->tipo}}','{{$evento->data}}','{{$evento->estado}}','{{$evento->local}}','{{$evento->hora}}','{{$evento->finalidade}}','{{$evento->tema}}','{{$evento->depa_id}}')" class="btn-action edit" title="Editar"><i class="fas fa-edit"></i>Editar</a>
                            <button onclick="apagar('{{$evento->id}}','{{$evento->nome}}')" class="btn-action delete" title="Eliminar"><i class="fas fa-trash-alt"></i>apagar</button>

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
            <h2 id="modal-title"><i class="fas fa-user-plus"></i> Registar Evento</h2>
            <button class="close-modal-btn" id="btnFecharCadastro">&times;</button>
        </div>
        <div class="modal-right-body">
            <form action="{{ route('evento.store') }}" method="POST" id="form-membro">
                @csrf
                <div class="form-group">
                    <label for="nome">Designação do evento</label>
                    <input type="text" name="nome" id="nome" required placeholder="Informe o nome do evento">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="tipo">Tipo</label>
                        <select name="tipo" id="tipo" required>
                            <option value="">Selecionar</option>
                            <option value="Evangelisação">Evangelisação</option>
                            <option value="Vigílias">Vigílias</option>
                            <option value="Oração">Oração</option>
                            <option value="Seminário">Seminário</option>
                            <option value="Congressos">Congressos</option>
                            <option value="Estudos bíblicos">Estudos bíblicos</option>
                            <option value="Programas especiais">Programas especiais</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <select name="estado" id="estado">

                            <option selected value="Pendente">Pendente</option>
                            <option value="Realizado">Realizado</option>
                            <option value="Cancelado">Cancelado</option>

                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="data">Data do evento</label>
                        <input type="date" name="data" id="data" required>
                    </div>
                    <div class="form-group">
                        <label for="hora">Hora do evento</label>
                        <input type="time" name="hora" id="hora" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="local">Local do evento</label>
                    <input type="text" name="local" id="local" required>
                </div>
                <div class="form-group">
                    <label for="finalidade">Finalidade do evento</label>
                    <textarea name="finalidade" id="finalidade"></textarea>
                </div>
                <div class="form-group">
                    <label for="tema">Tema do evento</label>
                    <input type="text" placeholder="Informe o tema do evento" name="tema" id="tema">
                </div>
                <div class="form-group">
                    <label for="">Organizador(Departamento)</label>
                    <select name="depa_id" id="depa_id">
                        <option value="">Selecionar</option>
                        @foreach ($departamentos as $depa)
                        <option value="{{$depa->id}}">{{$depa->nome}}</option>
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
    function atualizar(id, nome, tipo, data, estado, local, hora, finalidade, tema, depa) {

        document.getElementById('modalCadastro').classList.add("active");

        document.getElementById('modal-title').textContent = `Editando dados de ${nome}`;

        document.getElementById('nome').value=nome;
        document.getElementById('tipo').value=tipo;
        document.getElementById('data').value=data;
        document.getElementById('estado').value=estado;
        document.getElementById('local').value=local;
        document.getElementById('hora').value=hora;
        document.getElementById('finalidade').value=finalidade;
        document.getElementById('tema').value=tema;
        document.getElementById('depa_id').value=depa;


        const formEdit = document.getElementById('form-membro')
        formEdit.action = `/eventos/${id}`;
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

    function apagar(id, nome) {
        if (confirm(`Desejas a pagar o evento:\nID: ${id}\nDesignação:${nome}`)) {
            // Criar formulário para enviar DELETE via POST (Laravel)
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/eventos/${id}`;

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