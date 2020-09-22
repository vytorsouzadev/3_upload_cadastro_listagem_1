<?php 
    //caminho diretorio App
    $diretorioApp = './../app/';
    
    //IMPORT connection Database
    require_once($diretorioApp."Models/connection.php");
    //IMPORT ProdutoService
    require_once($diretorioApp."Models/produtoService.php");
    //IMPORT Arquivo de Config ->indexController.php
    require_once($diretorioApp."Controllers/indexController.php");


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
        echo 'Eba VAmos Cadastrar Seus Produtos';
    }elseif($acao == 'listarProdutos'){
        echo 'Vamos Listar Seus Produtos';
    }

?>