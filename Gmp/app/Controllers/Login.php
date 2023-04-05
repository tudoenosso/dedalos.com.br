<?php

namespace Gmp\Controllers;

use Helpers\Alerta;

// Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
if (!defined('C8L6K7E')) {
    $urlRedirect = URL . "login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada<br>");
}

class Login
{
    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data = [];

    /** @var array $dataForm Recebe os dados do formulario */
    private array|null $dataForm;

    public function index()
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        //var_dump($this->dataForm);    

        if (!empty($this->dataForm['SendLogin'])) {            
            $valLogin = new \Gmp\Models\GmpLogin();
            $valLogin->logon($this->dataForm);
            if($valLogin->getResult()){                 
                $urlRedirect = URL . "dashboard/index";
                header("Location: $urlRedirect");               
            }else{
                $this->data['form'] = $this->dataForm;
                
            }   
            
        }


        $this->renderView();
    }


    private function renderView()
    {
        $loadView = new \CoreGmp\ConfigView("Views/login/login", $this->data);
        $loadView->loadViewLogin();
    }
}
