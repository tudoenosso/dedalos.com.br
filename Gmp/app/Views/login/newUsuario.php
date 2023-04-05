<?php
// Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
if (!defined('C8L6K7E')) {
    $urlRedirect = URL . "login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada<br>");
}

if (isset($this->data['form'])) {
    $valorForm = $this->data['form'];
}


?>


<div class="container p-5 ">
    <div class="card text-center">
        <div class="card-header bg-success">
            <h4 class="text-white">Novo Usuário</h4>
        </div>
        <div class="card-body">
            <?php if (isset($_SESSION['alert'])) {
                echo  $_SESSION['alert'];
                unset($_SESSION['alert']);
            } ?>

            <span id="msg"></span>

            <form name="form-add-user" id="form-add-user" method="POST" class="row g-3 text-start">
                <?php
                $nome = "";
                if (isset($valorForm['nome'])) {
                    $nome = $valorForm['nome'];
                }
                ?>

                <div class="col-md-6">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" name="nome" class="form-control" id="nome" value="<?php echo $nome; ?>" placeholder="Nome Completo">
                </div>
                <?php
                $email = "";
                if (isset($valorForm['email'])) {
                    $email = $valorForm['email'];
                }
                ?>
                <div class="col-md-6">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" name="email" class="form-control" id="email" value="<?php echo $email; ?>" placeholder="Seu melhor e-mail">
                </div>
                
                <?php
                $senha = "";
                if (isset($valorForm['senha'])) {
                    $senha = $valorForm['senha'];
                }
                ?>
                <div class="col-md-6">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" name="senha" class="form-control" id="senha" value="<?php echo $senha; ?>" placeholder="Mínimo de 6 caracteres">
                </div>
                <?php
                $confirma_senha = "";
                if (isset($valorForm['confirma_senha'])) {
                    $confirma_senha = $valorForm['confirma_senha'];
                }
                ?>
                <div class="col-md-6">
                    <label for="confirma_senha" class="form-label">Confirma Senha</label>
                    <input type="password" name="confirma_senha" class="form-control" id="confirma_senha" value="<?php echo $confirma_senha; ?>" placeholder="Mínimo de 6 caracteres">
                </div>

                <div class="col-12">
                    <input type="submit" name="SendNewUser" valuee="Cadastrar" class="btn btn-success btn-sm">

                    <button type="reset" class="btn btn-danger btn-sm">Limpar</button>
                </div>
            </form>

        </div>

        <div class="card-footer text-body-secondary text-start">

            <p><a href="<?php echo URL; ?>login/index">Login</a> - <a href="<?php echo URL; ?>recuperar-senha/index">Esqueceu a senha?</a></p>
        </div>
    </div>


</div>





<script src="<?php echo URL; ?>assets/js/gmpNewUser.js"></script>