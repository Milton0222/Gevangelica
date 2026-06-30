document.addEventListener("DOMContentLoaded", function() {
    
    // Captura dos elementos do Modal de Login
    const loginModal = document.getElementById("loginModal");
    const btnAbrirLogin = document.getElementById("btnAbrirLogin");
    const btnFecharLogin = document.getElementById("btnFecharLogin");

    // Função para abrir o modal de login
    function abrirModal() {
        loginModal.classList.add("active");
        document.body.style.overflow = "hidden"; // Impede o scroll de fundo
    }

    // Função para fechar o modal de login
    function fecharModal() {
        loginModal.classList.remove("active");
        document.body.style.overflow = "auto"; // Restaura o scroll
    }

    // Event Listeners
    btnAbrirLogin.addEventListener("click", abrirModal);
    btnFecharLogin.addEventListener("click", fecharModal);

    // Fechar ao clicar fora do cartão de Login (na área escurecida)
    loginModal.addEventListener("click", function(e) {
        if (e.target === loginModal) {
            fecharModal();
        }
    });

    // Fechar o modal caso carregue na tecla 'Escape'
    window.addEventListener("keydown", function(e) {
        if (e.key === "Escape" && loginModal.classList.contains("active")) {
            fecharModal();
        }
    });

    // Simulação de Submissão de Formulário de Login (Para conectar ao Laravel)
    const loginForm = document.querySelector(".login-form");
    loginForm.addEventListener("submit", function(e) {
        // e.preventDefault(); // Comente esta linha quando ligar a rota real do Laravel
        console.log("A autenticar utilizador...");
    });
});