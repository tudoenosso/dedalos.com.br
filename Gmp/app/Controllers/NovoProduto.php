<?php

namespace Gmp\Controllers;

use Helpers\Alerta;

// Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
if (!defined('C8L6K7E')) {
    $urlRedirect = URL . "login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada<br>");
}


class NovoProduto
{
      /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
      private array|string|null $data = [];

      /** @var array $dataForm Recebe os dados do formulario */
      private array|null $dataForm;
  
      /**
       * Método cadastrar usuário
       * Receber os dados do formulário.
       * Quando o usuário clicar no botão "cadastrar" do formulário da página novo usuário. Acessa o IF e instância a classe "AdmsAddUsers" responsável em cadastrar o usuário no banco de dados.
       * Usuário cadastrado com sucesso, redireciona para a página listar registros.
       * Senão, instância a classe responsável em carregar a View e enviar os dados para View.
       * 
       * @return void
       */
      public function index(): void
      {
          $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);  
          if ($this->dataForm['SendNewProduto']) {
            unset($this->dataForm['SendNewProduto']);
           
            var_dump($this->dataForm);
            $addProduto = new \Gmp\Models\GmpNewProduto();
            $addProduto->create($this->dataForm);
            if ($addProduto->getResult()) {
                $urlRedirect = URL . "visualizar-produto/index/{$addProduto->getResult()}";
                header("Location: $urlRedirect");

            } else {
                
                $this->data['form'] = $this->dataForm;
                $this->renderView();
            }
        } else {
            $this->renderView();
        }
          
          
  
      }

      
    private function renderView()
    {
        $listSelect = new \Gmp\Models\GmpNewProduto();
        $this->data['medidas'] = $listSelect->listMedidas();

        $listSelect = new \Gmp\Models\GmpNewProduto();
        $this->data['modelos'] = $listSelect->listModelos();

        $listSelect = new \Gmp\Models\GmpNewProduto();
        $this->data['marcas'] = $listSelect->listMarcas();

        $listSelect = new \Gmp\Models\GmpNewProduto();
        $this->data['categorias'] = $listSelect->listCategorias();
        
        
        $loadView = new \CoreGmp\ConfigView("Views/produto/newProduto", $this->data);
        $loadView->loadView();
    }
  
     
  }
  