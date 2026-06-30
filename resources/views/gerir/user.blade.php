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
                            <tr>
                                <td><div class="avatar">MA</div></td>
                                <td><strong>Milton Augusto Francisco</strong></td>
                              
                                <td>12/10/2018</td>
                                <td><span class="badge badge-info">Mídias / TI</span></td>
                                <td><span class="badge badge-success">Ativo</span></td>
                                <td class="text-center">
                                    <div class="table-actions">
                                        <button class="btn-action edit" title="Editar"><i class="fas fa-edit"></i></button>
                                        <button class="btn-action delete" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><div class="avatar">sc</div></td>
                                <td>Sara Camati</td>
                            
                                <td>24/05/2021</td>
                                <td><span class="badge badge-info">Louvor</span></td>
                                <td><span class="badge badge-success">Ativo</span></td>
                                <td class="text-center">
                                    <div class="table-actions">
                                        <button class="btn-action edit"><i class="fas fa-edit"></i></button>
                                        <button class="btn-action delete"><i class="fas fa-trash-alt"></i></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>


    @endsection
</x-app-layout>
<div class="modal-right-overlay" id="modalCadastro">
        <div class="modal-right">
            <div class="modal-right-header">
                <h2><i class="fas fa-user-plus"></i> Registar Novo Utilizador</h2>
                <button class="close-modal-btn" id="btnFecharCadastro">&times;</button>
            </div>
            <div class="modal-right-body">
                <form action="#" method="POST">
                    <div class="form-group">
                        <label for="nome">Nome Completo *</label>
                        <input type="text" id="name" required name="name" placeholder="Insira o nome completo">
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="genero">Email</label>
                            <input type="email" name="email" id="email" required placeholder="exemplo@gmail.com">
                        </div>
                        <div class="form-group">
                            <label for="data_nasc">Tipo de Utilizador</label>
                          <select id="tipo" name="tipo">
                                <option value="ativo">Ativo</option>
                                <option value="inativo">Inativo</option>
                                <option value="transferido">Transferido</option>
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