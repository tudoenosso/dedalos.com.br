<?php

namespace Gmp\Models\helper;

use Helpers\Alerta;

// Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
if (!defined('C8L6K7E')) {    
    $urlRedirect = URL . "login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada<br>");
}

/**
 * Classe genérica para validar a senha
 *
 * @author Celke
 */
class GmpValSenha
{
    /** @var string $senha Recebe a senha que deve ser validada */
    private string $senha;

    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool $result;

    /**
     * @return bool Retorna true quando executar o processo com sucesso e false quando houver erro
     */
    function getResult(): bool
    {
        return $this->result;
    }

    /** 
     * Verificar se a senha possui aspas simples " ' ", retorna erro.
     * Verificar se a senha possui espaço em branco " ", retorna erro.
     * Instancia o método para validar a quantidade de caracteres a senha possui
     * 
     * @param string $senha Recebe a senha que deve ser validada.
     * 
     * @return void
     */
    public function validateSenha(string $senha): void
    {
        $this->senha = $senha;

        if (stristr($this->senha, "'")) {
            Alerta::alert("Caracter ( ' ) utilizado na senha inválido!", "erro");
            //$_SESSION['msg'] = "<p class='alert-danger'>Erro: Caracter ( ' ) utilizado na senha inválido!</p>";
            $this->result = false;
        } else {
            if (stristr($this->senha, " ")) {
                Alerta::alert("Erro: Proibido utilizar espaço em branco no campo senha!", "erro");

                //$_SESSION['msg'] = "<p class='alert-danger'>Erro: Proibido utilizar espaço em branco no campo senha!</p>";
                $this->result = false;
            } else {
                $this->valExtensaoSenha();
            }
        }
    }

    /** 
     * Verificar se a senha possui menos de 6 caracteres, retorna erro.
     * Instancia o método para validar os caracteres que a senha possui
     * 
     * @return void
     */
    private function valExtensaoSenha(): void
    {
        if (strlen($this->senha) < 6) {
            Alerta::alert("Erro: A senha deve ter no mínimo 6 caracteres!", "erro");
            //$_SESSION['msg'] = "<p class='alert-danger'>Erro: A senha deve ter no mínimo 6 caracteres!</p>";
            $this->result = false;
        } else {
            $this->valValueSenha();
        }
    }

    /** 
     * Verificar se a senha possui letra e números na senha.
     * 
     * @return void
     */
    private function valValueSenha(): void
    {
        if(preg_match('/^(?=.*[0-9])(?=.*[a-zA-Z])[a-zA-Z0-9-@#$%;*]{6,}$/', $this->senha)){
            $this->result = true;
        }else{
            Alerta::alert("Erro: A senha deve ter letras e números!", "erro");
            //$_SESSION['msg'] = "<p class='alert-danger'>Erro: A senha deve ter letras e números!</p>";
            $this->result = false;
        }
    }
}
