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
<script>
    // --- INICIALIZAÇÃO DOS GRÁFICOS (CHART.JS) ---
    
    // Gráfico 1: Crescimento de Membros (Linha)
    const ctxGrowth = document.getElementById('growthChart').getContext('2d');
    new Chart(ctxGrowth, {
        type: 'line',
        data: {
            labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun'],
            datasets: [{
                label: 'Novos Membros',
                data: [12, 19, 15, 25, 22, 30],
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                tension: 0.3,
                fill: true
            }]
        },
        options: { responsive: true, plugins: { legend: { display: false } } }
    });

    // Gráfico 2: Faixa Etária (Donut)
    const ctxDemo = document.getElementById('demographicChart').getContext('2d');
    new Chart(ctxDemo, {
        type: 'doughnut',
        data: {
            labels: ['Crianças', 'Jovens', 'Adultos', 'Idosos'],
            datasets: [{
                data: [15, 45, 30, 10],
                backgroundColor: ['#38bdf8', '#3b82f6', '#1e293b', '#a855f7']
            }]
        },
        options: { responsive: true }
    });
</script>