<?php 
    //caminho diretorio App
    $diretorioApp = './../app/';
    
    //IMPORT connection Database
    require_once($diretorioApp."Models/connection.php");
    //IMPORT ProdutoService
    require_once($diretorioApp."Models/produtoService.php");
    //IMPORT Arquivo de Config ->indexController.php
    require_once($diretorioApp."Controllers/indexController.php");
    //IMPORT Class Produto
    require_once($diretorioApp."Models/produto.php");


    //Instancia -> indexController.php
    $controller = new IndexController();

    //ESTRUTA QUE Ajuda A Iniciar A ROTA 
    //Caso Nao tenha $_GET Ele pega o Valor da VARIAVEL -> $controla -> Da Pagina 
    //-------------------------------------------------------------//
    //CRIAR UMA VARIAVEL NAS PAGINAS QUE PRECISAM DE LISTAGEM
    // CRIA COM O NOME ----> $controla
    //-------------------------------------------------------------//
    
    if(isset($_GET['acao'])){//Para Paginas que Fazem POST
        //echo 'Existe Rota: '.$_GET['acao'];
        //inicia e verifica e Configura Rotas
        $controller->initRoutes(null);
    }else{//Para Paginas que Apenas Listam Itens
        $controller->initRoutes($controla);
    }

    //Recebe A Rota do IndexController.php->initRoutes;
    $acao = $controller->getAcao();

    

    //Connection DataBase
    $db = new Connection();



    //Rotas da Aplicação
    if($acao == "cadastrarProduto"){
        //-----------------------------//
        //Recebe os Dados do Front-End //
        //-----------------------------//
        $nomeProduto = $_POST['nomeProduto'];
        $descricao = $_POST['descricao'];
        $fotos = array();
        //Se Exisitir Foto Pega A quatidade Delas
        //VERIFICA SE EXISTE FOTOS DENTRO DO Array
        if(count($_FILES['foto']['name']) && $_FILES['foto']['name'][0] != ""){
            
            $qtdFotos = count($_FILES['foto']['name']);
            //echo '<hr>QTD: '.$qtdFotos."<hr>";
            
            $nomeFoto = $_FILES['foto']['name'];
            $tipoFoto = $_FILES['foto']['type'];
            $caminhoFoto = $_FILES['foto']['tmp_name'];
            $formato;
            //COLOCA AS FOTOS NO ARRAY
            for($i=0;$i < $qtdFotos; $i++){
                //tipo da Foto
                if($tipoFoto[$i] == "image/jpeg"){
                    
                    $formato = ".jpg";
                    echo 'tipo JPG<br/>';

                }elseif($tipoFoto[$i] == "image/png"){
                    echo 'tipo PNG<br/>';
                    $formato = ".png";

                }
                $dado = array();
                $dado['nomeFoto']=md5($nomeFoto[$i].rand(1,9999)).$formato;
                $dado['tipoFoto'] = $tipoFoto[$i];
                $dado['caminhoFoto'] = $caminhoFoto[$i];
                //Passa as Fotos Pro Array $fotos;
                $fotos[] = $dado;

                //faz Upload das Fotos Pro Servidor
                    //faz upload da Foto Atual
                    move_uploaded_file($dado['caminhoFoto'],$diretorioApp."src/img/".$dado['nomeFoto']);
            }
        }



        //INSTANCIA CLASSE PRODUTO
        $produto = new Produto();
        //passa os dados para classe Produto
        $produto->__set('nomeProduto',$nomeProduto);
        $produto->__set('descricao',$descricao);
        $produto->__set('fotos',$fotos);
        
        //Produto Service
        $produtoService = new ProdutoService($db,$produto);
        //chama o metodo CadastrarProduto
        $produtoService->cadastrarProduto();

        //redireciona Apos cadastrar
        header("Location:index.php?cadastro=1");


    }elseif($acao == 'listarProdutos'){
        echo 'Vamos Listar Seus Produtos';
    }

?>