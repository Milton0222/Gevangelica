document.addEventListener("DOMContentLoaded", function() {
    
    // --- CONTROLO DOS DROPDOWNS DA SIDEBAR ---
    const dropdownButtons = document.querySelectorAll(".dropdown-btn");
    dropdownButtons.forEach(button => {
        button.addEventListener("click", function() {
            const dropdownContainer = this.nextElementSibling;
            const arrow = this.querySelector(".arrow");

            this.classList.toggle("active-btn");
            dropdownContainer.classList.toggle("show-dropdown");
            if (arrow) arrow.classList.toggle("rotate-arrow");
        });
    });

    // --- CONTROLO DA MODAL DIREITA (DRAWER) ---
    const modal = document.getElementById("modalCadastro");
    const btnAbrir = document.getElementById("btnAbrirCadastro");
    const btnFechar = document.getElementById("btnFecharCadastro");
    const btnCancelar = document.getElementById("btnCancelarCadastro");

    function abrirModal() { modal.classList.add("active"); }
    function fecharModal() { modal.classList.remove("active"); }

    btnAbrir.addEventListener("click", abrirModal);
    btnFechar.addEventListener("click", fecharModal);
    btnCancelar.addEventListener("click", fecharModal);

    // Fechar se clicar fora da área branca da modal
    modal.addEventListener("click", function(e) {
        if(e.target === modal) fecharModal();
    });

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
});