<?php

namespace Gmp\Models;


use Helpers\Alerta;
use Helpers\Validation;

// Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
if (!defined('C8L6K7E')) {
    $urlRedirect = URL . "login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada<br>");
}


/**
 * Cadastrar o usuário no banco de dados
 *
 * @author Celke
 */
class GmpNewProduto
{
    /** @var array|null $data Recebe as informações do formulário */
    private array|null $data;

    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool|int $result;

    /** @var array Recebe as informações que serão usadas no dropdown do formulário*/
    private array $listSelect;

    /**
     * @return bool Retorna true quando executar o processo com sucesso e false quando houver erro
     */
    function getResult(): bool|int
    {
        return $this->result;
    }

    /** 
     * Recebe os valores do formulário.
     * Instancia o helper "AdmsValEmptyField" para verificar se todos os campos estão preenchidos 
     * Verifica se todos os campos estão preenchidos e instancia o método "valInput" para validar os dados dos campos
     * Retorna FALSE quando algum campo está vazio
     * 
     * @param array $data Recebe as informações do formulário
     * 
     * @return void
     */
    public function create(array $data = null)
    {
        $this->data = $data;

        $valEmptyField = new \Helpers\GmpValidaCampo();
        $valEmptyField->validaCampo($this->data);
        if ($valEmptyField->getResult()) {
            $this->valInput();
        } else {
            $this->result = false;
        }
    }

    /** 
     * Instanciar o helper "AdmsValEmail" para verificar se o e-mail válido
     * Instanciar o helper "AdmsValEmailSingle" para verificar se o e-mail não está cadastrado no banco de dados, não permitido cadastro com e-mail duplicado
     * Instanciar o helper "validatePassword" para validar a senha
     * Instanciar o helper "validateUserSingleLogin" para verificar se o usuário não está cadastrado no banco de dados, não permitido cadastro com usuário duplicado
     * Instanciar o método "add" quando não houver nenhum erro de preenchimento 
     * Retorna FALSE quando houve algum erro
     * 
     * @return void
     */
    private function valInput(): void
    {
        $valProdutoSingle = new \Gmp\Models\helper\GmpProdutoSingle();
        $valProdutoSingle->validateProdutoSingle($this->data['descricao']);        

        if (($valProdutoSingle->getResult())) {
            $this->addProduto();
        } else {
            $this->result = false;
        }
    }

    /** 
     * Cadastrar usuário no banco de dados
     * Retorna TRUE quando cadastrar o usuário com sucesso
     * Retorna FALSE quando não cadastrar o usuário
     * 
     * @return void
     */
    private function addProduto(): void
    {
       
        $this->data['cadastro'] = date("Y-m-d H:i:s");

        $createUser = new \Gmp\Models\helper\GmpCreate();
        $createUser->exeCreate("gmp_produtos", $this->data);

        if ($createUser->getResult()) {
            Alerta::alert("Produto cadastrado com sucesso!", "sucesso");
            //$_SESSION['msg'] = "<p class='alert-success'>Usuário cadastrado com sucesso!</p>";
            $this->result = $createUser->getResult();
        } else {
            Alerta::alert("Erro 018: Não foi possível cadastrar o produto. Tente novamente ou contate o administrador!", "erro");
            //$_SESSION['msg'] = "<p class='alert-danger'>Erro: Usuário não cadastrado com sucesso!</p>";
            $this->result = false;
        }
    }

    /**
     * Metodo para pesquisar as informações que serão usadas no select do formulário
     *
     * @return array
     */
    public function listMedidas(): array
    {
        $list = new \Gmp\Models\helper\GmpRead();
        $list->fullRead("SELECT id, medida FROM gmp_medidas ORDER BY medida ASC");
        $this->listSelect = $list->getResult(); 
        return $this->listSelect;
    }
    /**
     * Metodo para pesquisar as informações que serão usadas no select do formulário
     *
     * @return array
     */
    public function listModelos(): array
    {
        $list = new \Gmp\Models\helper\GmpRead();
        $list->fullRead("SELECT id, modelo FROM gmp_modelos ORDER BY modelo ASC");
        $this->listSelect = $list->getResult(); 
        return $this->listSelect;
    }
    /**
     * Metodo para pesquisar as informações que serão usadas no select do formulário
     *
     * @return array
     */
    public function listMarcas(): array
    {
        $list = new \Gmp\Models\helper\GmpRead();
        $list->fullRead("SELECT id, marca FROM gmp_marcas ORDER BY marca ASC");
        $this->listSelect = $list->getResult(); 
        return $this->listSelect;
    }
    /**
     * Metodo para pesquisar as informações que serão usadas no select do formulário
     *
     * @return array
     */
    public function listCategorias(): array
    {
        $list = new \Gmp\Models\helper\GmpRead();
        $list->fullRead("SELECT id, categoria FROM gmp_categorias ORDER BY categoria ASC");
        $this->listSelect = $list->getResult(); 
        return $this->listSelect;
    }
}
