<?php

namespace Gmp\Controllers;

use Helpers\Alerta;

// Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
if (!defined('C8L6K7E')) {
    $urlRedirect = URL . "login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada<br>");
}

class ListarProdutos
{
    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data = null;

    /** @var array $dataForm Recebe os dados do formulario */
    private array|null $dataForm;

    /** @var string|int|null $page Recebe o número página */
    private string|int|null $page;

    /** @var string|null $searchName Recebe o nome do usuario */
    private string|null $searchName;

    /** @var string|null $searchEmail Recebe o email do usuario */
    private string|null $searchEmail;

    public function index()
    {
        //echo "Listar Produtos Controller2<br>";
        $this->dataForm = filter_input_array(INPUT_GET, FILTER_DEFAULT);

        //Instancia a classe que recupera a lista de inventário de produtos
        $listarProdutos = new \Gmp\Models\GmpListProdutos();
        $listarProdutos->listProdutos($this->dataForm);

        if (!empty($this->dataForm['SendPesquisar'])) {
            unset($this->dataForm['SendPesquisar']);

            if ($listarProdutos->getResult()) {
                $this->data['produtos'] = $listarProdutos->getResultBd();
                //var_dump( $this->data['produtos']);
            } else {
                $this->data['form'] = $this->dataForm;
                $this->data['produtos'] = [];
            }
            $this->data['form'] = $this->dataForm;
            $this->renderView();
        } else {

            if ($listarProdutos->getResult()) {
                $this->data['produtos'] = $listarProdutos->getResultBd();
                //var_dump( $this->data['produtos']);
            } else {
                $this->data['form'] = $this->dataForm;
                $this->data['produtos'] = [];
            }
            $this->data['form'] = $this->dataForm;
            $this->renderView();
        }

        /*


        $listarProdutos = new \Gmp\Models\GmpListProdutos();
        $listarProdutos->listProdutos($this->dataForm);
        if ($listarProdutos->getResult()) {
            $this->data['produtos'] = $listarProdutos->getResultBd();
            //var_dump( $this->data['produtos']);
        } else {
            $this->data['produtos'] = [];
        }
        */
    }


    private function renderView()
    {
        $listSelect = new \Gmp\Models\GmpNewProduto();
        $this->data['modelos'] = $listSelect->listModelos();

        $listSelect = new \Gmp\Models\GmpNewProduto();
        $this->data['marcas'] = $listSelect->listMarcas();

        $listSelect = new \Gmp\Models\GmpNewProduto();
        $this->data['categorias'] = $listSelect->listCategorias();

        $loadView = new \CoreGmp\ConfigView("Views/produto/listProdutos", $this->data);
        $loadView->loadView();
    }
    public function __call($name, $arguments)
    {
        // Note: value of $name is case sensitive.
        echo "Calling object method '$name' "
            . implode(', ', $arguments) . "\n";
    }

    public static function __callStatic($name, $arguments)
    {
        // Note: value of $name is case sensitive.
        echo "Calling static method '$name' "
            . implode(', ', $arguments) . "\n";
    }
}
