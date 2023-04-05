
const formAddUser = document.getElementById("form-add-user");
if (formAddUser) {
    formAddUser.addEventListener("submit", async(e) => {
        //Receber o valor do campo
        var nome = document.querySelector("#nome").value;
        // Verificar se o campo esta vazio
        if (nome === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-danger text-start' role='alert'>Erro: Necessário preencher o campo nome!</p>";
            return;
        }

        //Receber o valor do campo
        var email = document.querySelector("#email").value;
        // Verificar se o campo esta vazio
        if (email === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-danger text-start' role='alert'>Erro: Necessário preencher o campo email!</p>";
            return;
        }

        //Receber o valor do campo
        var senha = document.querySelector("#senha").value;
        // Verificar se o campo esta vazio
        if (senha === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-danger text-start' role='alert'>Erro: Necessário preencher o campo senha!</p>";
            return;
        }       
       
        // Verificar se o campo senha possui 6 caracteres
        if (senha.length < 6) {
            e.preventDefault();
            document.getElementById("msg").innerHTML ="<p class='alert alert-danger text-start' role='alert'>Erro: A senha deve ter no mínimo 6 caracteres!</p>";
            return;
        }
        // Verificar se o campo senha não possui números repetidos
        if (senha.match(/([1-9]+)\1{1,}/)) {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-danger text-start' role='alert'>Erro: A senha não deve ter números repetidos!</p>";
            return;
        }
        // Verificar se o campo senha possui letras
        if (!senha.match(/[A-Za-z]/)) {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-danger text-start' role='alert'>Erro: A senha deve ter pelo menos uma letra!</p>";
            return;
        }

        //Receber o valor do campo
        var confirmaSenha = document.querySelector("#confirma_senha").value;
        // Verificar se o campo esta vazio
        if (confirmaSenha === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-danger text-start' role='alert'>Erro: Necessário preencher o campo confirma senha!</p>";
            return;
        }      
        // Verificar se o campo esta vazio
        if (confirmaSenha != senha) {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert alert-danger text-start' role='alert'>Erro: Senhas não conferem! Redigite os campos senha e confirma senha!</p>";
            return;
        } else {
            document.getElementById("msg").innerHTML = "<p></p>";
            return;
        }      
    });
}