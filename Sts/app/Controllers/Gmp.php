<?php

namespace Sts\Controllers;


use CoreGmp\ConfigGmp;

// Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php

if (!defined('C7E3L8K9E5')) {
    //$this->configGmp();
    $urlRedirect = URL . "Gmp/login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada<br>");
}

class Gmp
{
    public function __construct()
    {
        //$this->configGmp();
        echo "Erro Controller2<br>";
        $urlRedirect = URL . "Gmp/login/index";
        header("Location: $urlRedirect");
        die("Erro: Página não encontrada<br>");
    }
}
