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
 * Listar os usuários do banco de dados
 *
 * @author Celke
 */
class GmpListProdutos
{
    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool $result;

    /** @var array|null $resultBd Recebe os registros do banco de dados */
    private array|null $resultBd;

    /** @var int $page Recebe o número página */
    private int $page;

    /** @var int $page Recebe a quantidade de registros que deve retornar do banco de dados */
    private int $limitResult = 40;

    /** @var string|null $page Recebe a páginação */
    private string|null $resultPg;

    /** @var array Recebe as informações que serão usadas no dropdown do formulário*/
    private array $listSelect;

    /** @var string|null $searchName Recebe o nome do usuario */
    private string|null $searchName;

    /** @var string|null $searchEmail Recebe o email do usuario */
    private string|null $searchEmail;

    /** @var string|null $searchNameValue Recebe o nome do usuario */
    private string|null $searchNameValue;

    /** @var string|null $searchEmailValue Recebe o e-mail do usuario */
    private string|null $searchEmailValue;

    /** @var string|null $searchEmailValue Recebe o e-mail do usuario */
    private array|null $data;

    /** @var string|null $searchEmailValue Recebe o e-mail do usuario */
    private string|null $query = null;

    /** @var string|null $searchEmailValue Recebe o e-mail do usuario */
    private string|null $where = null;




    /**
     * @return bool Retorna true quando executar o processo com sucesso e false quando houver erro
     */
    public function getResult(): bool
    {
        return $this->result;
    }

    /**
     * @return bool Retorna os registros do BD
     */
    public function getResultBd(): array|null
    {
        return $this->resultBd;
    }

    /**
     * @return bool Retorna a paginação
     */
    public function getResultPg(): string|null
    {
        return $this->resultPg;
    }

    /**
     * Metodo faz a pesquisa dos usuários na tabela adms_users e lista as informações na view
     * Recebe o paramentro "page" para que seja feita a paginação do resultado
     * @param integer|null $page
     * @return void
     */
    public function listProdutos(array $data = null): void
    {
        $this->data = $data;

        //echo "<hr>";
        //print_r($this->data);
        // $this->data = array_map('strip_tags', $this->data);
        // $this->data['indicador'] = (int) 0;

        $listProdutos = new \Gmp\Models\helper\GmpRead();

        $this->query = "SELECT  gmp_produtos.id, gmp_produtos.descricao, gmp_medidas.medida, 
        gmp_modelos.modelo, gmp_marcas.marca, gmp_produtos.estoque
        FROM gmp_produtos 
        INNER JOIN gmp_medidas ON gmp_produtos.fk_medida = gmp_medidas.id
        INNER JOIN gmp_modelos ON gmp_produtos.fk_modelo = gmp_modelos.id        
        INNER JOIN gmp_marcas ON gmp_produtos.fk_marca = gmp_marcas.id";




        if (!empty($this->data['descricao'])) {
            if (!empty($this->data['fk_modelo'])) {
                if (!empty($this->data['fk_marca'])) {
                    if (!empty($this->data['fk_categoria'])) {
                        //echo "Com descricao e modelo e marca e categoria 1<br>";
                        $this->data['indicador'] = 1;
                        $this->pesquisarProduto();
                    } else {
                        //echo "Com descricao, modelo e marca 2<br>";
                        $this->data['indicador'] = 2;
                        $this->pesquisarProduto();
                    }
                } else {
                    if (!empty($this->data['fk_categoria'])) {
                        //echo "Com descricao, modelo e categoria 3<br>";
                        $this->data['indicador'] = 3;
                        $this->pesquisarProduto();
                    } else {
                        //echo "Com descricao modelo 4<br>";
                        $this->data['indicador'] = 4;
                        $this->pesquisarProduto();
                    }
                }
            } else {
                if (!empty($this->data['fk_marca'])) {
                    if (!empty($this->data['fk_categoria'])) {
                        //echo "Com descricao, marca e categoria 5<br>";
                        $this->data['indicador'] = 5;
                        $this->pesquisarProduto();
                    } else {
                        //echo "Com descricao e marca 6<br>";
                        $this->data['indicador'] = 6;
                        $this->pesquisarProduto();
                    }
                } else {
                    if (!empty($this->data['fk_categoria'])) {
                        //echo "Com descricao e categoria 7<br>";
                        $this->data['indicador'] = 7;
                        $this->pesquisarProduto();
                    } else {
                        //echo "Com descricao 8<br>";
                        $this->data['indicador'] = 8;
                        $this->pesquisarProduto();
                    }
                }
            }
        } else {
            if (!empty($this->data['fk_modelo'])) {
                if (!empty($this->data['fk_marca'])) {
                    if (!empty($this->data['fk_categoria'])) {
                        //echo "Com modelo e marca e categoria 9<br>";
                        $this->data['indicador'] = 9;
                        $this->pesquisarProduto();
                    } else {
                        //echo "Com  modelo e marca 10<br>";
                        $this->data['indicador'] = 10;
                        $this->pesquisarProduto();
                    }
                } else {
                    if (!empty($this->data['fk_categoria'])) {
                        //echo "Com modelo e categoria 11<br>";
                        $this->data['indicador'] = 11;
                        $this->pesquisarProduto();
                    } else {
                        //echo "Com modelo 12<br>";
                        $this->data['indicador'] = 12;
                        $this->pesquisarProduto();
                    }
                }
            } else {
                if (!empty($this->data['fk_marca'])) {
                    if (!empty($this->data['fk_categoria'])) {
                        //echo "Com marca e categoria 13<br>";
                        $this->data['indicador'] = 13;
                        $this->pesquisarProduto();
                    } else {
                        echo "marca 14<br>";
                        $this->data['indicador'] = 14;
                        $this->pesquisarProduto();
                    }
                } else {
                    if (!empty($this->data['fk_categoria'])) {
                        //echo "categoria 15<br>";
                        $this->data['indicador'] = 15;
                        $this->pesquisarProduto();
                    } else {
                        Alerta::alert("Envie uma parâmetro para pesquisar!", "aviso");
                        //echo "sem descricao, sem modelo, sem marca, sem categoria16<br>";
                        $this->data['indicador'] = 16;
                    }
                }
            }
        }



        $listProdutos->fullRead("{$this->query}", "{$this->where}");
        $this->resultBd = $listProdutos->getResult();
        if ($this->resultBd) {
            $this->result = true;
        } else {
            Alerta::alert("Nenhum produto encontrado!...", "erro");
            //$_SESSION['msg'] = "<p style='color: #f00'>Erro: Nenhum usuário encontrado!</p>";
            $this->result = false;
        }
    }


    private function pesquisarProduto()
    {



        switch ($this->data['indicador']) {
            case '1':
                $this->query .= "  WHERE gmp_produtos.fk_modelo =:modelo";
                $this->query .= "  AND gmp_produtos.fk_marca =:marca";
                $this->query .= "  AND gmp_produtos.fk_categoria =:categoria";
                $this->query .= "  AND gmp_produtos.descricao LIKE :produto";

                $this->where .= "modelo={$this->data['fk_modelo']}";
                $this->where .= "&marca={$this->data['fk_marca']}";
                $this->where .= "&categoria={$this->data['fk_categoria']}";
                $this->where .= "&produto=%{$this->data['descricao']}%";
                break;

            case '2':
                $this->query .= "  WHERE gmp_produtos.fk_modelo =:modelo";
                $this->query .= "  AND gmp_produtos.fk_marca =:marca";
                $this->query .= "  AND gmp_produtos.descricao LIKE :produto";

                $this->where .= "modelo={$this->data['fk_modelo']}";
                $this->where .= "&marca={$this->data['fk_marca']}";
                $this->where .= "&produto=%{$this->data['descricao']}%";
                break;

            case '3':
                $this->query .= "  WHERE gmp_produtos.fk_modelo =:modelo";
                $this->query .= "  AND gmp_produtos.fk_categoria =:categoria";
                $this->query .= "  AND gmp_produtos.descricao LIKE :produto";

                $this->where .= "modelo={$this->data['fk_modelo']}";
                $this->where .= "&categoria={$this->data['fk_categoria']}";
                $this->where .= "&produto=%{$this->data['descricao']}%";
                break;

            case '4':
                $this->query .= "  WHERE gmp_produtos.fk_modelo =:modelo";
                $this->query .= "  AND gmp_produtos.descricao LIKE :produto";

                $this->where .= "modelo={$this->data['fk_modelo']}";
                $this->where .= "&produto=%{$this->data['descricao']}%";
                break;

            case '5':
                $this->query .= "  WHERE gmp_produtos.fk_marca =:marca";
                $this->query .= "  AND gmp_produtos.fk_categoria =:categoria";
                $this->query .= "  AND gmp_produtos.descricao LIKE :produto";

                $this->where .= "&marca={$this->data['fk_marca']}";
                $this->where .= "&categoria={$this->data['fk_categoria']}";
                $this->where .= "&produto=%{$this->data['descricao']}%";
                break;

            case '6':
                $this->query .= "  WHERE gmp_produtos.fk_marca =:marca";
                $this->query .= "  AND gmp_produtos.descricao LIKE :produto";

                $this->where .= "&marca={$this->data['fk_marca']}";
                $this->where .= "&produto=%{$this->data['descricao']}%";
                break;

            case '7':
                $this->query .= "  WHERE gmp_produtos.fk_categoria =:categoria";
                $this->query .= "  AND gmp_produtos.descricao LIKE :produto";

                $this->where .= "&categoria={$this->data['fk_categoria']}";
                $this->where .= "&produto=%{$this->data['descricao']}%";
                break;

            case '8':
                $this->query .= "  WHERE gmp_produtos.descricao LIKE :produto";

                $this->where .= "produto=%{$this->data['descricao']}%";
                break;

            case '9':
                $this->query .= "  WHERE gmp_produtos.fk_modelo =:modelo";
                $this->query .= "  AND gmp_produtos.fk_marca =:marca";
                $this->query .= "  AND gmp_produtos.fk_categoria =:categoria";

                $this->where .= "modelo={$this->data['fk_modelo']}";
                $this->where .= "&marca={$this->data['fk_marca']}";
                $this->where .= "&categoria={$this->data['fk_categoria']}";
                break;

            case '10':
                $this->query .= "  WHERE gmp_produtos.fk_modelo =:modelo";
                $this->query .= "  AND gmp_produtos.fk_marca =:marca";

                $this->where .= "modelo={$this->data['fk_modelo']}";
                $this->where .= "&marca={$this->data['fk_marca']}";
                break;

            case '11':
                $this->query .= "  WHERE gmp_produtos.fk_modelo =:modelo";
                $this->query .= "  AND gmp_produtos.fk_categoria =:categoria";

                $this->where .= "modelo={$this->data['fk_modelo']}";
                $this->where .= "&categoria={$this->data['fk_categoria']}";
                break;

            case '12':
                $this->query .= "  WHERE gmp_produtos.fk_modelo =:modelo";
                $this->where .= "modelo={$this->data['fk_modelo']}";
                break;

            case '13':
                $this->query .= "  WHERE gmp_produtos.fk_marca =:marca";
                $this->query .= "  AND gmp_produtos.fk_categoria =:categoria";

                $this->where .= "marca={$this->data['fk_marca']}";
                $this->where .= "&categoria={$this->data['fk_categoria']}";
                break;

            case '14':
                $this->query .= "  WHERE gmp_produtos.fk_marca =:marca";

                $this->where .= "marca={$this->data['fk_marca']}";

                break;

            case '15':
                $this->query .= "  WHERE gmp_produtos.fk_categoria =:categoria";
                $this->where .= "categoria={$this->data['fk_categoria']}";
                break;
           
                
        }
    }
}
