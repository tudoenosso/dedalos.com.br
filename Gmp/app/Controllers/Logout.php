<?php

namespace Gmp\Controllers;

use Helpers\Alerta;

// Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
if (!defined('C8L6K7E')) {
    $urlRedirect = URL . "login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada<br>");
}


class Logout
{
    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data = [];

    /** @var array $dataForm Recebe os dados do formulario */
    private array|null $dataForm;

    /**
     * Destruir as sessões do usuário logado
     * @return void
     */
    public function index(): void
    {
        echo "Logout Controller2<br>";
        unset($_SESSION['user_id'], $_SESSION['user_nome'], $_SESSION['user_acesso'], $_SESSION['user_setor'], $_SESSION['user_email'], $_SESSION['user_image']);

        Alerta::alert("Logout realizado com sucesso!", "sucesso");
        $urlRedirect = URL . "login/index";
        header("Location: $urlRedirect");
        
    }
}
