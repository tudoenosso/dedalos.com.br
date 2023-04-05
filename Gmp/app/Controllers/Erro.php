<?php

namespace Gmp\Controllers;

// Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
if (!defined('C8L6K7E')) {
    $urlRedirect = URL . "login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada<br>");
}

class Erro
{
    public function index()
    {
        echo "Erro Controller2<br>";
    }
}