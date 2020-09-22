
<!DOCTYPE html>
<html lang="en">
    <head>
        <title> Cadastro produtos</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            body{
                font-family:arial;
            }
            section{
                background-color:rgb(123,104,238,.4);
                min-width: 331px;
                width:80%;
                margin: auto;
                overflow: hidden;
            }
            input, label, textarea{
                display:block;
                width:100%;
                height:30px;
            }
            label{
                line-height: 30px;
                margin-top:10px;
            }
            textarea{
                height: 150px;
            }
            form{
                width: 60%;
                margin: auto;
                box-sizing: border-box;
                padding: 20px;
            }
            #botao{
                margin-bottom: 10px;
                width: 50%;
                background-color:rgba(0,0,0,.8);
                color:white;
                height:40px;
                cursor: pointer;
                border: none;
                font-size: 15pt;
            }
            h1{
                text-align: center;
            }
            #foto{
                margin-top:20px;
                margin-bottom:20px;
            }
            a{
                background-color:rgba(0,255,127);
                display:block;
                width: 220px;
                height: 50px;
                color:black;
                text-decoration:none;
                float:right;
                text-align:center;
                line-height:50px;
                margin:20px;
                border: 1px solid rgba(0,0,0,.2);
            }

        </style>
    </head>
    <body>
        <section>
            <a href="produtos.php">Ver Todos os Produtos</a>
            <form method="POST" enctype="multipart/form-data" action="controller.php?acao=cadastrarProduto">
                <h1>ENVIO DE IMAGENS</h1>
                <label for="nome">Nome do Produto</label>
                <input type="text" name="nome" id="nome">
                <label for="des">Descrição</label>
                <textarea name="desc" id="desc"></textarea>
                <input type="file" name="foto[]" multiple id="foto">
                <input type="submit" id="botao">
            </form>
        </section>

    </body>
</html>

<?php 
/*
    if($isset($_POST['nome'])){
        //addslashes  =  e uma proteção - pesquisa isso depois
        $nome = addslashes($_POST['nome']);
        $descricao = addslashes($_POST['desc']);
        $fotos = array();
        if(isset($_FILES['foto'])){
            for($i=0; $i < count($_FILES['foto']['name']); $i++){
                
                //salvando dentro da pasta imagens
                $nome_arquivo = md5($_FILES['foto']['name'][$i].rand(1,9999)).".jpg";
                move_uploaded_file($_FILES['foto']['tmp_name'][$i], 'imagens/'.$nome_arquivo);

                //SALVANDO NOMES PARA ENVIAR PARA O BANCO DE DADOS
                array_push($fotos, $nome_arquivo);
            };
        };

        //VERIFICA SE FOI ´PREENCHIDO TODOS OS CAMPOS
        if(!empty($nome) && !empty($descricao)){

            //importa a classe responsavel por fazer o crud
            require_once('classes/Produto_class.php');
            //cria  a instacia da classe do crude
            $p = new Produto_class('formulario_produto','localhost','root','');
            $p->enviarProduto($nome, $descricao, $fotos);
      /*      
            //fecha o php
            ?>
            <!--Começa codigo HTML-->
            */
           // echo "<script>alert('Produto Cadastrado com Sucesso!');</script>";
            /*
            <!--Termina codigo hmlt-->
            <?php
            */
        //}else{
            //fecha a tag do php

       // }
        

   // };
  
   
        
    
?>