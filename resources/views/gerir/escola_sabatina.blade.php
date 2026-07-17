<x-app-layout>

    @section('header')
    <div class="page-header">
        <h1>Gestão da escola sabatina</h1>
        <p>Area responsável pela organização das classes de estudo bíblico e  grupos de aprendizagem.</p>
    </div>
    <button class="btn btn-primary" id="btnAbrirCadastro">
        <i class="fas fa-user-plus"></i> Novo Evento
    </button>
    @endsection


     @section('contente')
    <div class="filter-container">
        <form class="filter-form">
            <div class="form-group">
                <label>Pesquisar pela data</label>
                <input type="date" placeholder="Ex: Culto" id="datafillter">
            </div>
        </form>
    </div>

    @endsection
</x-app-layout>