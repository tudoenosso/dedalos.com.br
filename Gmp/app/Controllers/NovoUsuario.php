<?php

namespace Gmp\Controllers;

// Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
if (!defined('C8L6K7E')) {
    $urlRedirect = URL . "login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada<br>");
}


class NovoUsuario
{
    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data = [];

    /** @var array $dataForm Recebe os dados do formulario */
    private array|null $dataForm;
    
    public function index()
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        
        if (!empty($this->dataForm['SendNewUser'])) {
            unset($this->dataForm['SendNewUser']);
           
            $addUsuario = new \Gmp\Models\GmpNewUser();
            $addUsuario->create($this->dataForm);
            if ($addUsuario->getResult()) {
                $urlRedirect = URL . "visualizar-usuario/index/{$addUsuario->getResult()}";
                header("Location: $urlRedirect");
            } else {

                $this->data['form'] = $this->dataForm;
                $this->renderView();
            }
            
        } else {
            $this->renderView();
        }
    }


    private function renderView()
    {
        $loadView = new \CoreGmp\ConfigView("Views/login/newUsuario", $this->data);
        $loadView->loadView();
    }
}
