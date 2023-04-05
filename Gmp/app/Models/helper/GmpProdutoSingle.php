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
class GmpProdutoSingle
{
    /** @var string $produto Recebe o usuário que deve ser validado */
    private string $produto;

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
    public function validateProdutoSingle(string $produto, bool|null $edit = null, int|null $id = null): void
    {
        $this->produto = $produto;
        $this->edit = $edit;
        $this->id = $id;

        $valProdutoSingle = new \Gmp\Models\helper\GmpRead();
        if(($this->edit == true) and (!empty($this->id))){
            $valProdutoSingle->fullRead("SELECT id FROM gmp_produtos WHERE (descricao =:produto) AND id <>:id LIMIT :limit", "produto={$this->produto}&id={$this->id}&limit=1");
        }else{
            $valProdutoSingle->fullRead("SELECT id FROM gmp_produtos WHERE descricao =:produto LIMIT :limit", "produto={$this->produto}&limit=1");
        }

        $this->resultBd = $valProdutoSingle->getResult();
        if(!$this->resultBd){
            $this->result = true;
        }else{
            Alerta::alert("Erro 017: Já existe um produto com essa descricao. Não é permitido duplicação de registro", "erro");
            
            $this->result = false;
        }
    }
}
