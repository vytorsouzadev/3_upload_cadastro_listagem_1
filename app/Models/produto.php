<?php 
    class Produto{

        private $idProduto;
        private $nomeProduto;
        private $descricao;
        private $fotos = array();

        public function __set($atributo, $valor){

            $this->$atributo = $valor;

        }

        public function __get($atributo){

            return $this->$atributo;
        }

    }
?>