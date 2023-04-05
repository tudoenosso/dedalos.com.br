<?php

// Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
if (!defined('C8L6K7E')) {
    $urlRedirect = URL . "login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada<br>");
}

//Pega dados do Formulário
if (isset($this->data['form'])) {
    $valorForm = $this->data['form'];
}
$descricao = "";
if ($valorForm['descricao']) {
    $descricao = $valorForm['descricao'];
}
$fk_medida = "";
if ($valorForm['fk_medida']) {
    $fk_medida = $valorForm['fk_medida'];
}
$fk_modelo = "";
if ($valorForm['fk_modelo']) {
    $descricao = $valorForm['fk_modelo'];
}
$fk_marca = "";
if ($valorForm['fk_marca']) {
    $fk_marca = $valorForm['fk_marca'];
}
$fk_categoria = "";
if ($valorForm['fk_categoria']) {
    $fk_categoria = $valorForm['fk_categoria'];
}
$desc_completa = "";
if ($valorForm['desc_completa']) {
    $desc_completa = $valorForm['desc_completa'];
}

/*

if ($this->data['medidas']) {
    foreach ($this->data['medidas'] as $listaMedidas) {
        extract($listaMedidas);
        echo $id . "" . $medida;
    }
} else {
    $listaMedidas = [];
}
var_dump($listaMedidas);
*/
?>

<div class="container p-5 ">
    <div class="card text-center">
        <div class="card-header bg-success">
            <h4 class="text-white">Novo Produto</h4>
        </div>
        <div class="card-body">
            <!-- Imprime Alerta -->
            <?php if (isset($_SESSION['alert'])) echo $_SESSION['alert'];
            unset($_SESSION['alert']); ?>
            <!-- Fim - Imprime Alerta -->
            <!-- Imprime Alerta -->


            <form name="form-new-produto" id="form-new-produto" method="POST" class="row g-3 text-start">
                <div class="col-md-12 ">
                    <label for="descricao" class="form-label">Descricao</label>
                    <input type="text" name="descricao" class="form-control" id="descricao" value="<?php echo $descricao ?>" require>
                    <span id="desc_error"></span>

                </div> 



                <div class="col-md-6">
                    <label for="fk_medida" class="form-label">Medida</label>
                    <select name="fk_medida" id="fk_medida" class="form-select">
                        <option value="" selected>Selecione</option>
                        <?php
                        foreach ($this->data['medidas'] as $listaMedidas) {
                            extract($listaMedidas);
                            echo "<option value='{$id}'>{$medida}</option>";
                        }                
                        ?>
                    </select>
                    <span id="medida_error"></span>
                </div>

                <div class="col-md-6">
                    <label for="fk_modelo" class="form-label">Modelo</label>
                    <select value="<?php echo $fk_modelo ?>" id="fk_modelo" class="form-select">
                        <option value="" selected>Selecione</option>
                        <?php
                        foreach ($this->data['modelos'] as $listaModelos) {
                            extract($listaModelos);
                            echo "<option value='{$id}'>{$modelo}</option>";
                        }                
                        ?>
                    </select>
                    <span id="modelo_error"></span>
                </div>

                <div class="col-md-6">
                    <label for="fk_marca" class="form-label">Marca</label>
                    <select value="<?php echo $fk_marca ?>" id="fk_marca" class="form-select">
                        <option value="" selected>Selecione</option>
                        <?php
                        foreach ($this->data['marcas'] as $listaMarcas) {
                            extract($listaMarcas);
                            echo "<option value='{$id}'>{$marca}</option>";
                        }                
                        ?>
                    </select>
                    <span id="marca_error"></span>
                </div>

                <div class="col-md-6">
                    <label for="fk_categoria" class="form-label">Categoria</label>
                    <select value="<?php echo $fk_categoria ?>" id="fk_categoria" class="form-select">
                        <option value="" selected>Selecione</option>
                        <?php
                        foreach ($this->data['categorias'] as $listaCategorias) {
                            extract($listaCategorias);
                            echo "<option value='{$id}'>{$categoria}</option>";
                        }                
                        ?>
                    </select>
                    <span id="categoria_error"></span>
                </div>

                <div class="col-md-12">
                    <label for="desc_completa" class="form-label">Descrição Completa</label>
                    <textarea name="desc_completa" class="form-control" id="desc_completa" rows="5"><?php echo $desc_completa ?></textarea>
                    <span id="desc_completa_error"></span>
                </div>


                <div class="col-12">

                    <input type="submit" name="SendNewUser" value="Cadastrar" class="btn btn-outline-success">
                    <input type="reset" name="Limpar" value="Limpar" class="btn btn-outline-danger">
                    <!--
                    <a class="btn btn-outline-primary" href="<?php echo URL; ?>novo-produto/index">Novo</a>    
                -->


                </div>
            </form>
        </div>

    </div>


</div>




<script src="<?php echo URL; ?>assets/js/gmpNewProduto.js"></script>