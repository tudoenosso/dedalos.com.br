<?php

namespace Helpers;



// Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
if (!defined('C8L6K7E')) {
    $urlRedirect = URL . "login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada<br>");
}

class GmpValidaCampo
{
    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data = [];

    /** @var array $dataForm Recebe os dados do formulario */
    private array|null $dataForm;

    /** @var array $dataForm Recebe os dados do formulario */
    private bool $result;

    public function getResult()
    {
        return $this->result;
    }
    public function validaCampo(array $data = null)
    {
        $this->data = $data;
        $this->data = array_map('strip_tags', $this->data);
        $this->data = array_map('trim', $this->data);
        if(in_array('', $this->data)){
            Alerta::alert("Necessário preencher todos os campos!", "erro");
            
            $this->result = false;
        }else{
            $this->result = true;
        }

        
        
            
            
       

        
    }


    
}
