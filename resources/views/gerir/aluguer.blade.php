<x-app-layout>
    @section('header')
    <div class="page-header">
        <h1>Painel de Reserva de Salas</h1>
        <p>Selecione a sala e o departamento e selcione os dados temporais.</p>
    </div>
    @endsection



    @section('contente')
    <div class="filter-container">
     
            <h2 id="modal-title"></h2>
      
        <form class="filter-form" id="form-aluguer" action="{{route('alugueres.store')}}" method="post">
            @csrf
            <div class="form-group">
                <label>Salas Disponiveis</label>
                <select name="sala_id" id="sala_id" required>
                   
                    <option value="">Selecionar</option>
                        @foreach ($salas as $sala)
                        <option value="{{$sala->id}}">S0{{$sala->n_sala}}-{{$sala->estado}}</option>

                        @endforeach
                  
                </select>
            </div>
            <div class="form-group">
                <label>Departamento</label>
                <select id="depa_id" name="depa_id" required>
                    <option value="">Selecionar</option>
                    @foreach ($departamentos as $depa)
                    <option value="{{$depa->id}}">{{$depa->nome}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Data</label>
                <input type="date" name="data" id="data" required>
            </div>
            <div class="form-group">
                <label for="">Hora Inicio</label>
                <input type="time" name="hora_inicio" id="hora_inicio" required>
            </div>
            <div class="form-group">
                <label for="">Hora Fim</label>
                <input type="time" name="hora_fim" id="hora_fim" required>
            </div>
            <div class="form-group">
                <label for="">Finalidade</label>
                <input type="text" name="finalidade" id="finalidade" required>
            </div>

            <div class="modal-right-footer">
                <button type="reset" class="btn btn-secondary-outline">Limpar</button>
                <button type="submit" id="salvar" class="btn btn-primary">Reservar</button>
            </div>


        </form>
    </div>

    <div class="table-container">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>Sala</th>
                    <th>Data</th>
                    <th>Departamento</th>
                    <th>Horário</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($alugueres as $aluguer)

                <tr>
                    <td><strong>S0{{$aluguer->sala->n_sala}}</strong></td>
                    <td>{{$aluguer->data}}</td>
                    <th>{{$aluguer->departamento->nome}}</th>
                    <th>{{$aluguer->hora_inicio}} <strong>á</strong> {{$aluguer->hora_fim}}</th>
                    <td class="text-center">
                        <div class="table-actions">
                            <a href="{{ route('sala.show', $aluguer->sala) }}" class="btn-action edit" title="Ver"><i class="fas fa-eye"></i></a>
                           <!-- <a class="btn-action edit" onclick="actualizar('{{$aluguer->data}}','{{$aluguer->sala_id}}','{{$aluguer->depa_id}}','{{$aluguer->hora_inicio}}','{{$aluguer->hora_fim}}','{{$aluguer->finalidade}}')" title="Editar"><i class="fas fa-edit"></i></a>-->
                            <button class="btn-action delete" onclick="apagar('{{$aluguer->sala_id}}','{{$aluguer->depa_id}}')"><i class="fas fa-trash-alt"></i></button>

                        </div>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    @endsection
</x-app-layout>

<script>
    //atualizar dados

    function actualizar(data,sala,depa,hora_i,hora_f,finalidade){
       
       // document.getElementById('modalCadastro').classList.add('active');

       document.getElementById('modal-title').textContent=`Editando dados do Aluguer marcado para ${data}`;

        document.getElementById('depa_id').value=depa;
        document.getElementById('data').value=data;
        document.getElementById('hora_inicio').value=hora_i;
        document.getElementById('hora_fim').value=hora_f;
        document.getElementById('finalidade').value=finalidade;
        document.getElementById('salvar').textContent='Editar';
        document.getElementById('sala_id').value=sala;


        //altera as opcoes do for

        const formEdit = document.getElementById('form-aluguer')
        formEdit.action = `/alugueres/${sala}`;
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

    function apagar(sala,depa){
    

        if(confirm(`Desejas apagar o aluguer:\nSala ID:${sala}\nDepartamento ID: ${depa}`)){
             // Criar formulário para enviar DELETE via POST (Laravel)
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/alugueres/${sala}/${depa}`;

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

    //frechar modal

    function fechar(){
        document.getElementById('modalCadastro').classList.remove('active');
    }
    document.getElementById('btnFecharCadastro').addEventListener('click', fechar);
    document.getElementById('btnCancelarCadastro').addEventListener('click', fechar);
</script>

