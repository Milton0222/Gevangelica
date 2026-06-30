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
                            <input type="text" placeholder="Ex: Nome do membro...">
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select>
                                <option value="">Todos</option>
                                <option value="ativo">Ativo</option>
                                <option value="inativo">Inativo</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Ministério/Departamento</label>
                            <select>
                                <option value="">Todos</option>
                                <option value="louvor">Louvor</option>
                                <option value="jovens">Jovens</option>
                                <option value="intercessao">Intercessão</option>
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
                                <th>Foto</th>
                                <th>Nome Completo</th>
                                <th>Telefone</th>
                                <th>Data de Batismo</th>
                                <th>Ministério</th>
                                <th>Status</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><div class="avatar">MA</div></td>
                                <td><strong>Milton Augusto Francisco</strong></td>
                                <td>+244 9XX XXX XXX</td>
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
                                <td>+244 9XX XXX XXX</td>
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
                <h2><i class="fas fa-user-plus"></i> Registar Novo Membro</h2>
                <button class="close-modal-btn" id="btnFecharCadastro">&times;</button>
            </div>
            <div class="modal-right-body">
                <form action="#" method="POST">
                    <div class="form-group">
                        <label for="nome">Nome Completo *</label>
                        <input type="text" id="nome" required placeholder="Insira o nome completo">
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="genero">Género</label>
                            <select id="genero">
                                <option value="M">Masculino</option>
                                <option value="F">Feminino</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="data_nasc">Data de Nascimento</label>
                            <input type="date" id="data_nasc">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="telefone">Telefone / Contacto *</label>
                        <input type="tel" id="telefone" required placeholder="Ex: 923000000">
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" placeholder="exemplo@igreja.com">
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="data_batismo">Data de Batismo</label>
                            <input type="date" id="data_batismo">
                        </div>
                        <div class="form-group">
                            <label for="status">Estado Membro</label>
                            <select id="status">
                                <option value="ativo">Ativo</option>
                                <option value="inativo">Inativo</option>
                                <option value="transferido">Transferido</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ministerio">Ministério / Departamento</label>
                        <select id="ministerio">
                            <option value="">Nenhum</option>
                            <option value="louvor">Louvor</option>
                            <option value="intercessao">Intercessão</option>
                            <option value="ti">Mídias & TI</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="morada">Morada (Bairro / Cidade)</label>
                        <input type="text" id="morada" placeholder="Ex: Zona A, Benguela">
                    </div>
                    
                    <div class="modal-right-footer">
                        <button type="button" class="btn btn-secondary-outline" id="btnCancelarCadastro">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar Registo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>