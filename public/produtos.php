<!DOCTYPE html>
<html lang="en">
    <head>
        <title>PRODUTOS</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            section{
                width: 70%;
                margin: auto;
                font-family: arial;
            }
            div{
                width: 15%;
                float: left;
                padding: 1%;
                background-color: rgb(123,104,238,.4);
                margin: 10px;
            }
            img{
                width: 100%;
                height:150px;
            }
            h2{
                font-size: 12pt;
                color: white;
                text-align: center;
                background-color: rgba(0,0,0,0.5);
                font-weight: normal;
            }
            p{
                font-size: 10pt;
            }
        </style>
    </head>
    <body>
        <section>
            <?php /*
                //importa a classe
                require_once("classes/Produto_class.php");
                //INSTANCIA A CLASSE
                $p = new Produto_class('formulario_produto','localhost','root','');
                //ACESSAR O METODO DE LISTAR PRODUTOS
                $dadosProduto = $p->buscarProdutos();

                if(!empty($dadosProduto)){
                    echo 'Ainda nao existe Produtos Cadastrados';
                }else{
                    foreach($dadosProduto as $value){
                        ?>
                            <a href="exibir_produto.php?id=<?=$value['id_produto']?>">
                                <div>
                                    <img src="imagens/<?=$value['foto_capa'];?>">
                                    <h2><?=$value['nome_produto']?></h2>
                                </div>
                            </a>
                        <?php
                    }
                }
                */
            ?>
            <a href="exibir_produto.php?id=<?//$value['id_produto']?>">
                                <div>
                                    <img src="./../imagens/img_1.png">
                                    <h2>Camisetas PUMA</h2>
                                </div>
                            </a>

           
        </section>

    </body>
</html>