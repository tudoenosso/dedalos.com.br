<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
        color: #111111;
    }

    th,
    td {
        padding: 7px 10px 10px 10px;
    }

    th {
        text-transform: uppercase;
        letter-spacing: 0.1em;
        font-size: 90%;
        border-bottom: 2px solid #111111;
        border-top: 1px solid #999;
        text-align: left;
    }

    #descricao {
        width: 700px;
    }

    .medida {
        width: 50px;
        text-align: center;
    }

    .estoque {

        text-align: right;
    }

    tr:hover {
        background-color: #F0E48C;
    }
</style>

<main>
    <div class="container p-3">

        <?php
        //var_dump($this->data['produtos']);

        use Helpers\Alerta;

        if (isset($this->data['form'])) {
            $valorForm = $this->data['form'];
        }

        ?>


        <div class="card text-center">
            <div class="card-header bg-success">
                <h4 class="text-white">Pesquisar Produto</h4>
            </div>
            <div class="card-body">
            <?php if (isset($_SESSION['alert'])) {
                    echo  $_SESSION['alert'];
                    unset($_SESSION['alert']);
                } ?>
                <form class="row" method="GET">
                    <?php
                    $descricao = "";
                    if (isset($valorForm['descricao'])) {
                        $descricao = $valorForm['descricao'];
                    }
                    ?>

                    <div class="col-md-12  text-start">
                        <div class="input-group mb-3">

                            <input type="search" name="descricao" id="descricao" value="<?php echo $descricao; ?>" class="form-control" placeholder="Informe a descrição do produto">
                            <button type="submit" name="SendPesquisar" value="SendPesquisar" class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg></button>
                        </div>
                    </div>

                    <div class="col-md-4 text-start">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Modelo</span>
                            <select name="fk_modelo" id="fk_modelo" class="form-select">
                                <option value="" selected>Selecione</option>
                                <?php
                                foreach ($this->data['modelos'] as $listaModelos) {
                                    extract($listaModelos);
                                    if ((isset($valorForm['fk_modelo'])) and ($valorForm['fk_modelo'] == $id)) {
                                        echo " <option value='$id' selected >$modelo</option>";
                                    } else {
                                        echo "<option value='{$id}'>{$modelo}</option>";
                                    }
                                }
                                ?>
                            </select>
                            <button type="submit" name="SendPesquisar" value="SendPesquisar" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg></button>
                        </div>
                    </div>

                    <div class="col-md-4 text-start">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Marca</span>
                            <select name="fk_marca" id="fk_marca" class="form-select">
                                <option value="" selected>Selecione</option>
                                <?php
                                foreach ($this->data['marcas'] as $listaMarcas) {
                                    extract($listaMarcas);
                                    if ((isset($valorForm['fk_marca'])) and ($valorForm['fk_marca'] == $id)) {
                                        echo " <option value='$id' selected >$marca</option>";
                                    } else {
                                        echo "<option value='{$id}'>{$marca}</option>";
                                    }
                                }
                                ?>
                            </select>
                            <button type="submit" name="SendPesquisar" value="SendPesquisar" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg></button>
                        </div>
                    </div>

                    <div class="col-md-4 text-start">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Categoria</span>
                            <select name="fk_categoria" id="fk_categoria" class="form-select">
                                <option value="" selected>Selecione</option>
                                <?php
                                foreach ($this->data['categorias'] as $listaCategorias) {
                                    extract($listaCategorias);
                                   
                                    if ((isset($valorForm['fk_categoria'])) and ($valorForm['fk_categoria'] == $id)) {
                                        echo " <option value='$id' selected >$categoria</option>";
                                    } else {
                                        echo "<option value='{$id}'>{$categoria}</option>";
                                    }
                                }
                                ?>
                            </select>
                            <button type="submit" name="SendPesquisar" value="SendPesquisar" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg></button>
                        </div>
                    </div>
                    <a class="btn btn-danger btn-sm" href="<?php echo URL; ?>listar-produtos/index">Limpar</a>
                </form>
            </div>
        </div>
    </div>
</main>

<div class="container p-3">

    <div class="table-responsive p-1">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>

                    <th scope="col" id="descricao">Produto</th>
                    <th scope="col">Modelo</th>
                    <th scope="col">Marca</th>
                    <th scope="col" class="estoque">Estoque</th>
                    <th scope="col" class="medida">Medida</th>
                    <th scope="col" class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($this->data['produtos']) {
                    foreach ($this->data['produtos'] as $listaProdutos) {
                        extract($listaProdutos);
                ?>
                        <tr>
                            <td><?php echo $descricao ?></td>
                            <td><?php echo $modelo ?></td>
                            <td><?php echo $marca ?></td>
                            <td class="estoque"><?php echo $estoque ?></td>
                            <td class="medida"><?php echo $medida ?></td>
                            <td class="input-group input-group-sm">
                                <div class="btn-group">
                                    <a class="btn btn-outline-primary btn-sm" aria-current="page" href="<?php echo URL; ?>visualizar-produto/index/<?php echo $id; ?>">Visualizar</a>
                                    <a class="btn btn-outline-danger btn-sm" aria-current="page" href="<?php echo URL; ?>deletar-produto/index/<?php echo $id; ?>">Excluir</a>
                                </div>
                            </td>

                        </tr>
                <?php }
                } else {
                    //Alerta::alert("Nenhum produto encontrado!", "erro");
                    echo isset($_SESSION['alert']) ? $_SESSION['alert'] : "";
                    unset($_SESSION['alert']);
                }
                ?>


            </tbody>
        </table>
    </div>