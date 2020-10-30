<?php
    //controla a rota
    $controla = 'listarProdutos';
    //importa controller
    require_once("controller.php");
    //listagem Produtos
    /*
    echo '<pre>';
    print_r($listaProdutos);
    echo '</pre>';
    */
    
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>PRODUTOS</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="stylesheet" href="listarProdutos.css">
    </head>
    <body>
    <div id="container-dad">
            <div id="navbar" class="container border-bt">
                <h2>Todos Os Produtos</h2>
            </div>
            <a class="container botao-verProduto" href="index.php"><h2>Cadastrar Produto</h2></a>
           
           <!--container de Produtos-->
            <div id="container-produtos" class=" container">

                <!--CArd de Produtos-->

                <?php
            //SE EXISTIR ITEM DENTRO DO ARRAY DE PRODUTOS ENTRA AQUI
            if(isset($listaProdutos[0])){
                foreach($listaProdutos as $item){?>

                <div class="container containerPdt">
                    <div class="cardProduto container">
                        <div class="imagemProduto">
                            <?$diretorioIMG="./../app/src/img/"?>
                            <img src="<?=$diretorioIMG?><?=$item['imagemCapaProduto']?>" alt="" >
                        </div>
                        <div id="" class="tituloProduto"><h2> <a href="exibir_produto.php?acao=verProduto&id=<?=$item['idProduto']?>"><?=$item['nomeProduto']?></a></h2></div>
                    </div>
                </div>

                <?php
                }
                
            }
                
            ?>
        </div>
    </body>
</html>