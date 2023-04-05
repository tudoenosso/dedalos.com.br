/** Formulário Novo Produto */
const formNewProduto = document.getElementById("form-new-produto");
if (formNewProduto) {
    formNewProduto.addEventListener("submit", async(e) => {
        //Receber o valor do campo
        var descricao = document.querySelector("#descricao").value;
        // Verificar se o campo esta vazio
        if (descricao === "") {
            e.preventDefault();
            document.getElementById("desc_error").innerHTML = "<p style='color: #f00;'>Erro: Preencha o campo descrição!</p>";
            return;
        }        

        //Receber o valor do campo
        var medida = document.querySelector("#fk_medida").value;
        // Verificar se o campo esta vazio
        if (medida === "") {
            e.preventDefault();
            document.getElementById("medida_error").innerHTML = "<p style='color: #f00;'>Erro: Necessário preencher o campo medida!</p>";
            return;
        }
       
        //Receber o valor do campo
        var modelo = document.querySelector("#fk_modelo").value;
        // Verificar se o campo esta vazio
        if (modelo === "") {
            e.preventDefault();
            document.getElementById("modelo_error").innerHTML = "<p style='color: #f00;'>Erro: Necessário preencher o campo modelo!</p>";
            return;
        }
        

        //Receber o valor do campo
        var marca = document.querySelector("#fk_marca").value;
        // Verificar se o campo esta vazio
        if (marca === "") {
            e.preventDefault();
            document.getElementById("marca_error").innerHTML = "<p style='color: #f00;'>Erro: Necessário preencher o campo marca!</p>";
            return;
        }
        //Receber o valor do campo
        var categoria = document.querySelector("#fk_categoria").value;
        // Verificar se o campo esta vazio
        if (categoria === "") {
            e.preventDefault();
            document.getElementById("categoria_error").innerHTML = "<p style='color: #f00;'>Erro: Necessário preencher o campo categoria!</p>";
            return;
        }
        //Receber o valor do campo
        var desc_completa = document.querySelector("#desc_completa").value;
        // Verificar se o campo esta vazio
        if (desc_completa === "") {
            e.preventDefault();
            document.getElementById("desc_completa_error").innerHTML = "<p style='color: #f00;'>Erro: Necessário preencher o campo Descrição completa!</p>";
            return;
        }

       
    });
}

/** Fim - Formulário Novo Produto */


