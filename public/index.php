<!DOCTYPE html>
<html lang="en">
    <head>
        <title>REGISTER PRODUCT</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/cadastroProduto.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
      <link href='https://fonts.googleapis.com/css?family=Lato:400,300,700' rel='stylesheet' type='text/css'>
    </head>
    
    <body>
        <form method="POST" enctype="multipart/form-data" action="controller.php?acao=cadastrarProduto">
        <div id="container-dad" class="">
            <div id="navbar" class="border-bt container">
                <h2>Cadastro de Produtos</h2>
            </div>
            
            <a class="container botao-pdt" href="listar_produtos.php"><h2>Ver produto</h2></a>
            
            <div id="CaixaUploadImg" class="container white border-tp">
                <div id="esquerdo-cima" class="cinza-back border-r"> 
                    <div id="caixa" class="" >
                        <div id="nome" class="">
                            <h3 class="gray-c">Faça o <span>Upload</span> das Imagens</h3>
                        </div>
                        <div id="img" class="white container border-r">
                            <img src="img/ilustracao-upload.svg">
                        </div>
                        <div id="botao" >
                            <!--BOTAO DE UPLOAD-->
                            <input class="" type="file" name="foto[]" multiple id="foto" hidden>
                            <label for="foto" id="foto">
                                <span class="material-icons">
                                    cloud_upload
                                </span>&nbsp
                                <div id="texto" class="gray-c">UPLOAD</div>
                            </label>
                        </div>
                        
                    </div>
                </div>
                
            </div>
            <div id="ladoDireito" class="container white">
                <div id="caixa" class="cinza-back border-r">
                    <input id="nome" type="text" name="nomeProduto" placeholder="NOME PRODUTO">
                    <textarea id="descricao" type="text" name="descricao" placeholder="DESCRIÇÃO" cols="30" rows="10"></textarea>
                    <input id="botao" type="submit" name="Enviar">
                </div>
            </div>
        </div>
    </form>
        

    </body>
</html>
