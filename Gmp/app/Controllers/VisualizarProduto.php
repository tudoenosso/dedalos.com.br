<?php

namespace Gmp\Controllers;

use Helpers\Alerta;

// Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
if (!defined('C8L6K7E')) {
    $urlRedirect = URL . "login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada<br>");
}

class VisualizarProduto
{

    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data = [];

    /** @var array $dataForm Recebe os dados do formulario */
    private array|null $dataForm;

    /** @var array $id Recebe o id do registro */
    private int|string|null $id;


    public function index(int|null|string $id = null): void
    {
        echo "View Produto Controller2<br>";


        if (!empty($id)) {


            $this->id = (int) $id;

            echo "<br>Existe ID: {$this->id}<br>";

            $viewProduto = new \Gmp\Models\GmpViewProduto();
            $viewProduto->viewProduto($this->id);

            if ($viewProduto->getResult()) {
                $this->data['viewProduto'] = $viewProduto->getResultBd();
                $this->renderView();
            } else {
                $urlRedirect = URL . "listar-produtos/index";
                header("Location: $urlRedirect");
                die("Erro: Página não encontrada<br>");
            }

        } else {
            //echo "Não existe ID<br>";
            Alerta::alert("Produto não encontrado!", "erro");
            $urlRedirect = URL . "listar-produtos/index";
            header("Location: $urlRedirect");
            die("Erro: Página não encontrada<br>");
        }


      
    }


    private function renderView(): void
    {
        $loadView = new \CoreGmp\ConfigView("Views/produto/viewProduto", $this->data);
        $loadView->loadView();
    }
}
