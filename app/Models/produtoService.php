<?php 
    class ProdutoService{

        private $db;
        private $produto; 

        public function __construct(Connection $db,Produto $produto){
            $this->db = $db->connect();
            $this->produto = $produto;
        }

        public function cadastrarProduto(){

            try {
                
                    //cadastra nomeProduto e Descrição
                    $query = '
                    INSERT INTO
                        produtos(nome_produto, descricao) 
                    VALUES
                        (:produto,:descricao);
                ';
                $stmt = $this->db->prepare($query);
                $stmt->bindValue(':produto',$this->produto->__get('nomeProduto'));
                $stmt->bindValue(':descricao',$this->produto->__get('descricao'));
                $stmt->execute();
                //pega o Id do Produto cadastrado pra usar no cadastro das Imagens
                $idProduto = $this->db->lastInsertId();

                //Pegando Array de Fotos
                $imagens = $this->produto->__get('fotos');
                
                
                $qtdFotos = count($imagens);
                // VERIFICANDO se o $Fotos E NULO OU NAO
                //SALVA NOMES FOTOS NO BANCO DE DADOS
                if(!$this->produto->fotos == null){//SE NAO FOR NULO ENTRA AQUI

                    
                    //SALVA AS FOTOS NO BANCO DE DADOS
                    for($i=0 ;$i < $qtdFotos; $i++){
                        //INSERINDO UMA IMAGEM
                            //alterar o id do array de acordo com o FOR
                            $nomeFoto = $imagens[$i]['nomeFoto'];
                            
                            $query = '
                                INSERT INTO 
                                    imagens(nome_IMAGEM, fk_id_produto)
                                VALUES
                                    (:nomeImagem,:idProduto);
                            ';
                            $stmt = $this->db->prepare($query);
                            $stmt->bindvalue(':nomeImagem',$nomeFoto);
                            $stmt->bindvalue(':idProduto',$idProduto);
                            $stmt->execute();
                    }
                }
            } catch (\Throwable $th) {
                header("Location:index.php?error=cadastrarProduto");
            }
        
        }

        public function listarProdutos(){

            //query
            /*
            $query = ' SELECT * FROM produtos INNER JOIN imagens
                ON produtos.id_produto = imagens.fk_id_produto;
            ';
            */
            $query = '
                SELECT *
                FROM produtos;
            ';
            //prepare->PDO
            $stmt = $this->db->prepare($query);
            //execute
            $stmt->execute();
            //return
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function buscarUmaImagemProduto($idProduto){
            
            $this->produto = $idProduto;
            $idImagem = $this->produto->__get('idProduto');
            
            //query
            $query = '
                SELECT 
                    id_imagem,nome_IMAGEM
                FROM 
                    imagens
                WHERE 
                    fk_id_produto = :id
                LIMIT 1;
            ';
            $stmt = $this->db->prepare($query);
            //bindvalue
            $stmt->bindValue(':id',$idImagem);
            $stmt->execute();
            //retorna o Array
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
        
        //buscar todas as imagens
        public function listaImagem($idProduto){
            //echo 'chegou';
            $this->produto = $idProduto;
            $idImagem = $this->produto->__get('idProduto');
             
            //query
            $query = '
                SELECT 
                    id_imagem,nome_IMAGEM
                FROM 
                    imagens
                WHERE 
                    fk_id_produto = :id;
            ';
            $stmt = $this->db->prepare($query);
            //bindvalue
            $stmt->bindValue(':id',$idImagem);
            $stmt->execute();
            //retorna o Array
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function verProduto(){
            //recupera Id
            $idProduto = $this->produto->__get('idProduto');
            //recupera dados do produto
                //QUERY
                $query = '
                SELECT * FROM produtos WHERE id_produto = :idProduto;
                ';
                //prepara
                $stmt = $this->db->prepare($query);
                //add valor
                $stmt->bindValue(':idProduto',$idProduto);
                //executa
                $stmt->execute();
                //retorna
                return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

    
    
    }
?>