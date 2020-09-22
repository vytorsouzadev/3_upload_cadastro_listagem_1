<?php 
    class ProdutoService{

        private $db;
        private $produto; 

        public function __construct(Connection $db,Produto $produto){
            $this->db = $db;
            $this->produto = $produto;
        }

        public function CadastraProduto(){

            echo '<br/> Voce Chegou ao CadastraProduto<hr>';

        }

    }
?>