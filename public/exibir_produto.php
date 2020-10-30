<?php 
   //nao precisa da var controla PQ ela so e solicita e ja recebe via GET
    require_once("controller.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Produto: <?=strtoupper($dadosProduto[0]->nome_produto)?> </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="exibirProduto.css">
        <script>
            function imagem(url){
                //receber o id da imagem e setar ela no lugar da imagem principal
                const img = document.querySelector("#imgProduto");
                img.src=url;
            }
        </script>
    </head>
    <body>



    <div id="container-dad">
            
            <!-- NavBar -->
            <div id="navbar" class="container border-bt">
                <h2>Produto</h2>
            </div>
            <!-- Botao Listar Produtos -->
            <a class="container botao-verProduto" href="listar_produtos.php"><h2>Todos os Produtos</h2></a>
            
            <div id="container-produtos" class=" container">
                <!-- Card Geral -->
                <div class="container containerPdt">
                    <!-- Card da Imagens -->
                    <div class="cardImagem container">


                        <!-- Imagem Pricipal do Produto -->
                        <div class="imagemProduto">
                            <?$diretorioIMG="./../app/src/img/"?>
                            
                            <img id="imgProduto" src="<?=$diretorioIMG="./../app/src/img/"?><?=$imgProduto[0]->nome_IMAGEM?>" alt="" >
                        </div>

                        <!-- Imagens do Produtos -->
                        <div class="imgensPequenas ">
                            <?$diretorioIMG="./../app/src/img/"?>

                            <?foreach($imgProduto as $item){?>
                                <?$diretorioIMG="./../app/src/img/"?>
                                <img  onCLick="imagem('<?=$diretorioIMG?><?=$item->nome_IMAGEM?>')" src="<?=$diretorioIMG?><?=$item->nome_IMAGEM?>" alt="">

                            <?}?>


                        </div>
                    </div>
                    <div class="container" ><br/></div>
                    <div id="" class=" container nomeProduto">
                        <h2> <a href="#4"><?=strtoupper($dadosProduto[0]->nome_produto)?></a></h2>
                    </div>
                    <div class="container" ><br/></div>
                    <div id="" class=" container descricaoProduto">
                        <h2>Descrição</h2>
                        <p>
                            <?=ucwords($dadosProduto[0]->descricao)?>
                        </p>
                    </div>
                    
                </div>

        </div>

    </body>
</html>