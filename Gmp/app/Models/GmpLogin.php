<?php

namespace Gmp\Models;

use Helpers\Alerta;

// Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
if (!defined('C8L6K7E')) {    
    $urlRedirect = URL . "login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada<br>");
}

/**
 * Validar os dados do login
 *
 * @author Celke
 */
class GmpLogin
{

    /** @var array|null $data Recebe as informações do formulário */
    private array|null $data;

    /** @var array|null $resultBd Recebe os registros do banco de dados */
    private array|null $resultBd;

    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool $result = false;

    /**
     * @return bool Retorna true quando executar o processo com sucesso e false quando houver erro
     */
    function getResult(): bool
    {
        return $this->result;
    }

    /** 
     * Recebe os valores do formulário.
     * Recupera as informações do usuário no banco de dados
     * Quando encontrar o usuário no banco de dados instanciar o método "valEmailPerm" para validar a situação do usuário
     * Retorna FALSE quando não encontrar usuário no banco de dados
     * 
     * @param array $data Recebe as informações do formulário
     * 
     * @return void
     */
    public function logon(array $data = null): void
    {
        $this->data = $data;

        $viewUser = new \Gmp\Models\helper\GmpRead();
        $viewUser->fullRead("SELECT id, nome, email, senha, fk_situacao, fk_niv_acesso,  imagem FROM gmp_usuarios WHERE email =:email LIMIT :limit", "email={$this->data['email']}&limit=1");

        $this->resultBd = $viewUser->getResult();
        if ($this->resultBd) {
            $this->valEmailSituacao();
            
        } else {            
            Alerta::alert("Erro 9: Usuário ou senha incorretos!", "erro");
            //$_SESSION['msg'] = "<p class='alert-danger'>Erro 10: Usuário ou a senha incorreta!</p>";
            $this->result = false;
        }
    }    

    /**
     * Metodo valida a situação do usuário
     * Se a situação for 1, chama chama a função valPassword para validar a senha
     * Se a situação for 3, retorna falso, pois, o usuario precisar confirmar o e-mail.
     * Se a situação for 5, retorna falso, pois, o e-mail do usuário foi descadastrado.
     * Se a situação for 2, retorna falso, pois, o e-mail esta inativo
     * @return void
     */
    private function valEmailSituacao(): void
    {
        if ($this->resultBd[0]['fk_situacao'] == 1) {
           $this->valPassword();
        }elseif($this->resultBd[0]['fk_situacao'] == 2){
            Alerta::alert("Erro 10: Usuário inativo. Contate o administrador!", "erro");
            $this->result = false;
        }elseif($this->resultBd[0]['fk_situacao'] == 3){
            Alerta::alert("Erro 11: Usuário bloqueado. Contate o administrador!", "erro");
            $this->result = false;
        }else{
            Alerta::alert("Erro 12: Contate o administrador para regularizar sua situação!", "erro");
            $this->result = false;
        }
        
        
    }
    private function valEmailPerm(): void
    {
        

        /*
        if ($this->resultBd[0]['adms_sits_user_id'] == 1) {
            $this->valPassword();
        } elseif ($this->resultBd[0]['adms_sits_user_id'] == 3) {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Necessário confirmar o e-mail, solicite novo link <a href='".URLADM."new-conf-email/index'>Clique aqui</a>!</p>";
            $this->result = false;
        } elseif ($this->resultBd[0]['adms_sits_user_id'] == 5) {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: E-mail descadastrado, entre em contato com a empresa!</p>";
            $this->result = false;
        } elseif ($this->resultBd[0]['adms_sits_user_id'] == 2) {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: E-mail inativo, entre em contato com a empresa!</p>";
            $this->result = false;
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: E-mail inativo, entre em contato com a empresa!</p>";
            $this->result = false;
        }
        */
    }


    /** 
     * Compara a senha enviado pelo usuário com a senha que está salva no banco de dados
     * Retorna TRUE quando os dados estão corretos e salva as informações do usuário na sessão
     * Retorna FALSE quando a senha está incorreta
     * 
     * @return void
     */
    private function valPassword(): void
    {
        if (password_verify($this->data['senha'], $this->resultBd[0]['senha'])) {
            $_SESSION['user_id'] = $this->resultBd[0]['id'];
            $_SESSION['user_nome'] = $this->resultBd[0]['nome'];
            $_SESSION['user_acesso'] = $this->resultBd[0]['fk_niv_acesso'];
            $_SESSION['user_setor'] = $this->resultBd[0]['fk_setor'];
            $_SESSION['user_email'] = $this->resultBd[0]['email'];
            $_SESSION['user_image'] = $this->resultBd[0]['imagem'];
            $this->result = true;
        } else {
            Alerta::alert("Erro 13: Usuário ou senha incorretos!", "erro");
            //$_SESSION['msg'] = "<p class='alert-danger'>Erro: Usuário ou a senha incorreta!</p>";
            $this->result = false;
        }
    }
}
