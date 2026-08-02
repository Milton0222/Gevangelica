<x-app-layout>
    @section('header')
    <div class="page-header">
        <h1>Detalhes da Classe</h1>
        <p>Informações da classe e membros associados.</p>
    </div>
    @endsection

    @section('contente')
    <!-- Menu de Abas Completas -->
    <div class="nav">
        <button class="tab-btn active" onclick="switchView('secretaria')">Lista nominal</button>
        <button class="tab-btn" onclick="switchView('medico')">Mapa de Marcação de Faltas</button>
        <button class="tab-btn" onclick="switchView('relatorios')">Mapa de Assiduidade</button>
    </div>

    <section id="panel-secretaria">
        <div class="table-container">
            <form action="{{ route('classe.membro', $classe->id) }}" method="POST" class="form-up">
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
                    @forelse ($classe_membros as $lista)
                    <tr>
                        <td>{{$lista->nome}}</td>
                        <td>{{$lista->data_nascimento}}</td>
                        <td>{{$lista->telefone}}</td>
                        <td>{{$lista->data_batismo ?? 'N/Batizado'}}</td>
                    </tr>
@empty
    <td colspan="{{ $classe_membros->count() + 2 }}" class="empty-state">Nenhuma membro registado nesta classe. Seleciona os membros para adicionar a classe</td>
                    @endforelse

                </tbody>

            </table>
        </div>
    </section>

    <section class="presencas" id="panel-medico">

        <div class="table-container">
            <form action="{{route('classe.presenca')}}" method="post">
                @csrf
                <input type="hidden" name="classe_id" value="{{$classe->id}}">
                <table class="custom-table">
                    <thead>
                        <tr>

                            <th>Nome</th>
                            <th>P</th>
                            <th>F</th>

                        </tr>
                    </thead>
                    <tbody>

                        @forelse($classe_membros as $lista)
                        <tr>
                            <td>{{$lista->nome}}</td>
                            <td><input type="radio" name="presenca[{{$lista->id}}]"  value="P" checked></td>
                            <td><input type="radio" name="presenca[{{$lista->id}}]"  value="F"></td>
                        </tr>
                        @empty
                        <td colspan="{{ $classe_membros->count() + 2 }}" class="empty-state">Nenhuma membro registado nesta classe.</td>
                        @endforelse

                    </tbody>
                </table>
                <div class="modal-right-footer">
                    <button type="reset" class="btn btn-secondary-outline">Limpar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </section>

    <section class="presencas" id="panel-relatorios">
         <div class="table-container">
            <table class="custom-table">
                <thead>
                    <tr>

                        <th>Nome</th>
                        <th>P</th>
                        <th>F</th>
                       

                    </tr>
                </thead>
                <tbody>
                    @forelse ($presencas as $lista)
                    <tr>
                        <td>{{$lista->membro}}</td>
                        <td>{{$lista->presencas}}</td>
                        <td>{{$lista->faltas}}</td>
                    </tr>
                    @empty
<td colspan="{{ $presencas->count() + 2 }}" class="empty-state">Nenhuma presença registada nesta classe.</td>

                    @endforelse

                </tbody>

            </table>
        </div>



    </section>

    @endsection
</x-app-layout>

<script>
    //document.getElementById('panel-secretaria').style.display = 'none';
    document.getElementById('panel-medico').style.display = 'none';
    document.getElementById('panel-relatorios').style.display = 'none';

    // Alternador de Abas do Sistema (SPA View)
    function switchView(view) {
        //alert('ola');
        document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));


        if (view === 'secretaria') {
            document.querySelectorAll('.tab-btn')[0].classList.add('active');
            document.getElementById('panel-secretaria').style.display = 'block';
            document.getElementById('panel-medico').style.display = 'none';
            document.getElementById('panel-relatorios').style.display = 'none';
          
        } else if (view === 'medico') {
            document.querySelectorAll('.tab-btn')[1].classList.add('active');
            document.getElementById('panel-secretaria').style.display = 'none';
            document.getElementById('panel-medico').style.display = 'block';
            document.getElementById('panel-relatorios').style.display = 'none';
        
        } else if (view === 'relatorios') {
            document.querySelectorAll('.tab-btn')[2].classList.add('active');
            document.getElementById('panel-secretaria').style.display = 'none';
            document.getElementById('panel-medico').style.display = 'none';
            document.getElementById('panel-relatorios').style.display = 'block';
            updateKPIs();
          
        }
    }
</script>