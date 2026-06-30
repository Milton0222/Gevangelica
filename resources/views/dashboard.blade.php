<x-app-layout>
       @section('header')
        <div class="page-header">
                        <h1>Dashboard</h1>
                        <p>Controle o crescimento da plataforma de forma integrada.</p>
                    </div>

    @endsection

    @section('contente')
    <div class="dashboard-cards">
        <div class="card">
            <div class="card-icon"><i class="fas fa-users"></i></div>
            <div class="card-info">
                <h3>Total de Membros</h3>
                <p>1,248</p>
            </div>
        </div>
        <div class="card">
            <div class="card-icon male"><i class="fas fa-mars"></i></div>
            <div class="card-info">
                <h3>Homens</h3>
                <p>542</p>
            </div>
        </div>
        <div class="card">
            <div class="card-icon female"><i class="fas fa-venus"></i></div>
            <div class="card-info">
                <h3>Mulheres</h3>
                <p>706</p>
            </div>
        </div>
        <div class="card">
            <div class="card-icon active-member"><i class="fas fa-check-circle"></i></div>
            <div class="card-info">
                <h3>Membros Ativos</h3>
                <p>94%</p>
            </div>
        </div>
    </div>

    <div class="charts-container">
        <div class="chart-card">
            <h3>Crescimento de Membros (Últimos 6 meses)</h3>
            <canvas id="growthChart"></canvas>
        </div>
        <div class="chart-card">
            <h3>Distribuição por Faixa Etária</h3>
            <canvas id="demographicChart"></canvas>
        </div>
    </div>

    @endsection
</x-app-layout>