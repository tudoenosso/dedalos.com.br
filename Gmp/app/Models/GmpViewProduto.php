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
 * Visualizar o usuário no banco de dados
 *
 * @author Celke
 */
class GmpViewProduto
{

    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool $result = false;

    /** @var array|null $resultBd Recebe os registros do banco de dados */
    private array|null $resultBd;

    /** @var int|string|null $id Recebe o id do registro */
    private int|string|null $id;

    /**
     * @return bool Retorna true quando executar o processo com sucesso e false quando houver erro
     */
    function getResult(): bool
    {
        return $this->result;
    }

    /**
     * @return bool Retorna os detalhes do registro
     */
    function getResultBd(): array|null
    {
        return $this->resultBd;
    }

    /**
     * Metodo para visualizar os detalhes do usuário
     * Recebe o ID do usuário que será usado como parametro na pesquisa
     * Retorna FALSE se houver algum erro
     * @param integer $id
     * @return void
     */
    public function viewProduto(int $id): void
    {
        $this->id = $id;

        $viewProduto = new \Gmp\Models\helper\GmpRead();
        $viewProduto->fullRead("SELECT id, descricao, estoque 
            FROM gmp_produtos
            WHERE id=:id
            LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultBd = $viewProduto->getResult();
        if ($this->resultBd) {
            $this->result = true;
            var_dump($this->resultBd);
        } else {
            Alerta::alert("Erro 26: Produto não encontrado!", "erro");
            //$_SESSION['msg'] = "<p class='alert-danger'>Erro: Usuário não encontrado!</p>";
            $this->result = false;
        }
        /*
        
        $viewProduto = new \Gmp\Models\helper\GmpRead();
        $viewProduto->fullRead("SELECT usr.id, usr.name AS name_usr, usr.nickname, usr.email, usr.user, usr.image, usr.created, usr.modified,
                            sit.name AS name_sit,
                            col.color
                            FROM adms_users AS usr
                            INNER JOIN adms_sits_users AS sit ON sit.id=usr.adms_sits_user_id
                            INNER JOIN adms_colors AS col ON col.id=sit.adms_color_id
                            WHERE usr.id=:id
                            LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultBd = $viewProduto->getResult();        
        if ($this->resultBd) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Usuário não encontrado!</p>";
            $this->result = false;
        }
        */
    }
}
