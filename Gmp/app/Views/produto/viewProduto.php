<div class="container p-5">

    <h1>View Produto</h1>


    <?php

    //var_dump($this->data['viewProduto']);

    if ($this->data['viewProduto']) {
        foreach ($this->data['viewProduto'] as $produto) {
            extract($produto);
            echo "ID: {$id}<br>";
            echo "ID: {$descricao}<br>";
            echo "ID: {$estoque}<br>";
           
        }
    }
    ?>
  
   


</div>


            