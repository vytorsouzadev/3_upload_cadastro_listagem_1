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
    // 1--> RECUPERAR PRODUTOS

            //INSTANCIA A CLASSE PRODUTO
            $produto = new Produto();
            //INSTANCIA PRODUTOSERVICE
            $produtoService = new ProdutoService($db,$produto);
            //RECUPERA LISTARPRODUTOS
            $produtos = $produtoService->listarProdutos();

    // 2--> GUARDAR PRODUTOS EM UM ARRAY   
        
            //ARRAY PRA GUARDAR OS PRODUTOS
            $listaProdutos = array();
                //coloca os produtos dentro do Array
                foreach ($produtos as $id){
                    //PEGA ID, NOME, DESCRICAO -> PRODUTO
                    $idPdt = $id->id_produto;
                    $nomePdt = $id->nome_produto;
                    $descricaoPdt = $id->descricao;
                    //recupera 1 imagem do ProdutoSelecionado
                    $idPR = new produto();
                    $idPR->__set('idProduto',$idPdt);
                    $imgCapa = $produtoService->buscarUmaImagemProduto($idPR);
                    //VARIAVEL QUE VAI RECEBER A URL DA IMAGEM
                    $imagemCapaProduto;
                    foreach ($imgCapa as $key) {
                        //ACESSA E PASSA A URL DA IMAGEM DO PRODUTO
                        $imagemCapaProduto = $key->nome_IMAGEM;
                    }
                    //insere os Dados na ---> $listaProdutos
                    $listaProdutos[]=array(
                        'idProduto' => $idPdt,
                        'nomeProduto' => $nomePdt,
                        'descricaoProduto'=>$descricaoPdt,
                        'imagemCapaProduto'=>$imagemCapaProduto);
                    
                }
                
        
    }elseif($acao == "verProduto"){
        //echo 'Voce Solicitou Listagem de Produtos<hr>';
        //recuperar Id Produto
        $idProduto = $_GET['id'];
        //INSTANCIA CLASSE PRODUTO
        $produto = new Produto();
        $produto->__set('idProduto',$idProduto);
        //INSTANCIA PRODUTOSERVICE
        $produtoService = new ProdutoService($db,$produto);
        //busca Produtos!
        $dadosProduto = $produtoService->verProduto();
        //busca imagens do produto
        $imgProduto = $produtoService->listaImagem($produto);

    }

?>