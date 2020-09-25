<?php 
   //nao precisa da var controla PQ ela so e solicita e ja recebe via GET
    require_once("controller.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Exibir Produto</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            section{
                width: 70%;
                margin: auto;
                font-family:arial;
            }
            h1{
                color: rgba(0,0,0,.8);
                border-bottom: 1px solid rgba(0,0,0,.1);
                height:60px;
                line-height: 70px;
                margin-bottom: 40px;
            }
            #imagens {
                background-color: red;
            }
            .caixa-img{
                width: 15%;
                float: left;
                padding: 1%;
                background-color: rgb(123,104,238,.4);
                margin: 10px;
                height: 150px;
                cursor:pointer;
            }
            img{
                width: 100%;
            }
            p{
                width: 70%;
                text-align: justify;
                line-height: 30px;
            }

        </style>
    </head>
    <body>
        <section>
        <div>
            <h1><?=strtoupper($dadosProduto[0]->nome_produto)?></h1>
            <p><b>Descrição: </b><?=ucwords($dadosProduto[0]->descricao)?></p>
        </div>
            <?foreach($imgProduto as $item){?>
                <?$diretorioIMG="./../app/src/img/"?>
                <div id="imagens">
                        <div class="caixa-img">
                            <img src="<?=$diretorioIMG?><?=$item->nome_IMAGEM?>">
                        </div>
                </div>

            <?}?>
            
        </section>
    </body>
</html>