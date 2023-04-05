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
<style>
    .container{
        width: 100%;
    }
</style>




<div class="container text-center p-5">

    <div class="col-md-6 col-sm-12 offset-md-3 offset-sm-3">
        <div class="card text-center">
            <div class="card-header bg-success">
                <b class="text text-white">LOGIN</b>
            </div>
            <div class="card-body">
                <?php if (isset($_SESSION['alert'])) {
                    echo  $_SESSION['alert'];
                    unset($_SESSION['alert']);
                } ?>
                <form name="form-login" method="POST" id="form-login" class="text-start">
                    <?php
                    $user = "";
                    if (isset($valorForm['email'])) {
                        $user = $valorForm['email'];
                    }
                    ?>
                    <div class="mb-3">
                        <label for="email" class="form-label">Seu email</label>
                        <input type="email" name="email" value="<?php echo $user; ?>" class="form-control" id="email" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">exemplo@gmail.com</div>
                    </div>
                    <?php
                    $password = "";
                    if (isset($valorForm['senha'])) {
                        $password = $valorForm['senha'];
                    }
                    ?>
                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" name="senha" value="<?php echo $password; ?>" class="form-control" id="senha">
                        <div id="emailHelp" class="form-text">Informe a senha!</div>
                    </div>
            </div>
            <div class="card-footer text-body-secondary">
                <div class="d-grid gap-2">
                    <input type="submit" name="SendLogin" class="btn btn-outline-success" value="ENTRAR">
                </div>
                <div class="signup-link">
                    <a href="<?php echo URL; ?>novo-usuario/index">Cadastrar</a> - <a href="<?php echo URL; ?>recover-password/index">Esqueceu a senha?</a>
                </div>
                </form>
            </div>
        </div>
    </div>
    Usuário: joca@gmail.com<br>
    Senha: 123456
</div>