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

        




    
    
    
    }
?>