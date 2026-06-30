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

    
});