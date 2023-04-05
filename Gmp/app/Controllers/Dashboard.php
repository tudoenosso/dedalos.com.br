<?php

namespace Gmp\Controllers;

// Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
if (!defined('C8L6K7E')) {
    $urlRedirect = URL . "login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada<br>");
}

class Dashboard
{
    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data = [];

    /** @var array $dataForm Recebe os dados do formulario */
    private array|null $dataForm;
    public function index()
    {

        //echo "Dashboard Controller2<br>";

        $this->renderView();
    }


    private function renderView()
    {
        $loadView = new \CoreGmp\ConfigView("Views/dashboard/dashboard", $this->data);
        $loadView->loadView();
    }
}
