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
 * Classe genêrica para validar o e-mail único, somente um cadatrado pode utilizar o e-mail
 *
 * @author Celke
 */
class GmpUserSingle
{
    /** @var string $email Recebe o usuário que deve ser validado */
    private string $email;

    /** @var bool|null $edit Recebe a informação que é utilizada para verificar se é para validar usuário para cadastro ou edição */
    private bool|null $edit;

    /** @var int|null $id Recebe o id do usuário que deve ser ignorado quando estiver validando o usuário para edição */
    private int|null $id;

    /** @var array|null $resultBd Recebe os registros do banco de dados */
    private array|null $resultBd;

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
     * Validar o usuário único.
     * Recebe o usuário que deve ser verificado se o mesmo já está cadastrado no banco de dados.
     * Acessa o IF quando estiver validando o usuário para o formulário editar.
     * Acessa o ELSE quando estiver validando o usuário para o formulário cadastrar.
     * Retorna TRUE quando não encontrar outro nenhum usuário utilizando o usuário em questão.
     * Retorna FALSE quando o usuário já está sendo utilizado por outro usuário.
     * 
     * @param string $usuário Recebe o usuário que deve ser validado.
     * @param bool|null $edit Recebe TRUE quando deve validar o usuário para formulário editar.
     * @param int|null $id Recebe o ID do usuário quando deve validar o usuário para formulário editar.
     * 
     * @return void
     */
    public function validateUserSingle(string $email, bool|null $edit = null, int|null $id = null): void
    {
        $this->email = $email;
        $this->edit = $edit;
        $this->id = $id;

        $validateEmailSingle = new \Gmp\Models\helper\GmpRead();
        if(($this->edit == true) and (!empty($this->id))){
            $validateEmailSingle->fullRead("SELECT id FROM gmp_usuarios WHERE (email =:email) AND id <>:id LIMIT :limit", "email={$this->email}&id={$this->id}&limit=1");
        }else{
            $validateEmailSingle->fullRead("SELECT id FROM gmp_usuarios WHERE email =:email LIMIT :limit", "email={$this->email}&limit=1");
        }

        $this->resultBd = $validateEmailSingle->getResult();
        if(!$this->resultBd){
            $this->result = true;
        }else{
            Alerta::alert("Erro 020: Esse e-mail já está cadastrado. Utilize outro ou recupere sua senha.", "erro");
            
            $this->result = false;
        }
    }
}
