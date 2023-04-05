<?php

if (!defined('C8L6K7E')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}
?>

<style>
    .dropdown-item:hover{
        background-color: #2F4F4F;
        color: white;
        
    }
</style>

<nav class="navbar sticky-top navbar-expand-sm navbar-dark" style="background-color: #51358C;">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo URL; ?>dashboard/index"><img src="<?php echo URL; ?>assets/image/logo/logo2.png" alt="HOME" width="40" height="40"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- Menu Produto -->
                <li class="nav-item dropdown">
                    <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Produto
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo URL; ?>novo-produto/index">Novo</a></li>
                        <li><a class="dropdown-item" href="<?php echo URL; ?>listar-produtos/index">Pesquisar</a></li>                        
                        <li><a class="dropdown-item" href="#">Saldo</a></li>                        
                        <li><a class="dropdown-item" href="#">Deletar</a></li>
                    </ul>
                </li>
                <!-- Fim menu Produto -->

                <!-- Menu Cliente -->

                <li class="nav-item dropdown">
                    <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Cliente
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo URL; ?>novo-produto/index">Novo</a></li>
                        <li><a class="dropdown-item" href="#">Pesquisar</a></li>                        
                        <li><a class="dropdown-item" href="#">Deletar</a></li>
                    </ul>
                </li>
                <!--Fim menu Cliente -->


                <!-- Menu Usuário -->

                <li class="nav-item dropdown">
                    <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Usuário
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo URL ?>novo-usuario/index">Novo</a></li>
                        <li><a class="dropdown-item" href="<?php echo URL ?>listar-usuario/index">Pesquisar</a></li>                        
                        
                    </ul>
                </li>
                <!--Fim menu Cliente -->

            </ul>

            <ul class="navbar-nav me-start mb-2 mb-lg-2">

                <li class="nav-item dropdown ">
                    <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Joca
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Perfil</a></li>
                        <li><a class="dropdown-item" href="#">Configurações</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item text-danger" href="<?php echo URL; ?>logout/index"><b>Sair</b></a></li>
                    </ul>
                </li>

            </ul>


        </div>
    </div>
</nav>