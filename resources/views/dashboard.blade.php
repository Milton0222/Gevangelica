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
                <p>{{$membros_c}}</p>
            </div>
        </div>
        <div class="card">
            <div class="card-icon male"><i class="fas fa-mars"></i></div>
            <div class="card-info">
                <h3>Homens</h3>
                <p>{{$m}}</p>
            </div>
        </div>
        <div class="card">
            <div class="card-icon female"><i class="fas fa-venus"></i></div>
            <div class="card-info">
                <h3>Mulheres</h3>
                <p>{{$f}}</p>
            </div>
        </div>
        <div class="card">
            <div class="card-icon active-member"><i class="fas fa-check-circle"></i></div>
            <div class="card-info">
                <h3>Membros Ativos</h3>
                <p>{{$membros_a}}</p>
            </div>
        </div>
    </div>

    <div class="charts-container">
        <div class="chart-card">
            <h3>Novos Membros por Mês (Últimos 6 meses)</h3>
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
    const ctxGrowth = document.getElementById('growthChart').getContext('2d');
    new Chart(ctxGrowth, {
        type: 'line',
        data: {
            labels: @json($growthLabels),
            datasets: [{
                label: 'Novos Membros',
                data: @json($growthData),
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                tension: 0.3,
                fill: true
            }]
        },
        options: { responsive: true, plugins: { legend: { display: false } } }
    });

    const ctxDemo = document.getElementById('demographicChart').getContext('2d');
    new Chart(ctxDemo, {
        type: 'doughnut',
        data: {
            labels: @json($ageLabels),
            datasets: [{
                data: @json($ageData),
                backgroundColor: ['#38bdf8', '#a855f7', '#3b82f6', '#1e293b']
            }]
        },
        options: { responsive: true }
    });
</script>