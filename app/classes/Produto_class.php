<?php 

    class Produto_class{

        private $pdo;

        public function __construct($dbname, $host, $user, $senha){
            
           try{

                $this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host, $user, $senha);

           } catch(PDOexception $e)
           {
                echo 'Erro com o banco de dados: '.$e->getMessage();
           }catch(Exception $e)
           {
                echo 'Erro Generico: '.$e->getMessage();
           }

        }

        public function enviarProduto($nome, $descricao, $fotos = array()){
            //INSERINDO O PRODUTO (TABELA PRODUTOS)
            $cmd = $this->pdo->prepare('INSERT INTO produtos(nome_produto, descricao)
                VALUES(:n,:d)');
            $cmd->bindValue(':n',$nome);
            $cmd->bindValue(':d',$descricao);
            $cmd->execute();
            //recupera o id do produto inserido
            $id_produto = $this->pdo->lastInsertId();

            if(count($fotos) > 0){//VEIO IMAGENS ?????????
                //CAPTURA O ID
                for($i=0; $i < count($fotos); $i++){
                    //captura a foto de acordo com Array
                    $nome_foto = $fotos[$i];
                    
                    //inserindo as imagens ( TABELA IMAGENS )
                    $cmd = $this->pdo->prepare('INSERT INTO imagens(nome_imagem, fk_id_produtos) VALUES(:n, :fk)');
                    $cmd->bindValue(':n',$nome_foto);
                    $cmd->bindValue(':fk',$id_produto);
                    $cmd->execute();
            }
                
            }
            
        }

        public function buscarProdutos(){// BUSCA TODOS

            $cmd = $this->pdo->query('SELECT *,
            (SELECT nome_imagem FROM imagens WHERE fk_id_produto = produtos.id_produto LIMIT 1)
             as foto_capa
            FROM produtos');

            // -> $cmd->rowCount()  =  FUNÇAO DO PDO QUE CONTA QUANTAS LINHAS VIERAM DA DATABASE
            if($cmd->rowCount() > 0){
                //PEGA O QUE VEIO E COLOCA EM -> $DADOS
                $dados = $cmd->fetchAll(PDO::FETCH_ASSOC);

            }else{//caso nao venha e criado a variavel vazia pra nao gerar erro
                $dados = array();
            }
            return $dados;
        }

        public function buscarProdutoPorId($id){// BUSCA APENAS 1

            $cmd = $this->pdo->prepare('SELECT * FROM produtos WHERE id_produto = :id');
            $cmd->bindValue(':id',$id);
            $cmd->execute();
            if($cmd->rowCount() >0){
                $dados = $cmd->fetchAll(PDO::FETCH_ASSOC);
            }else{
                //cria a variavel para nao dar erro
                $dados = array();
            }
            //retorna o array com o conteudo;
            return $dados;

        }

        public function buscarImagensPorId($id){
            $cmd = $this->pdo->prepare('SELECT nome_imagem FROM imagens WHERE fk_id_produto = :id');
            $cmd->bindValue(":id",$id);
            $cmd->execute();

            //verifica se existe o array se houve retorno
            if($cmd->rowCount() > 0){
                $dados = $cmd->fetchAll(PDO::FETCH_ASSOC);
            }else{
                //recebe um array para nao dar erro
                $dados = array();
            }
            return $dados;
        }


    }



?>