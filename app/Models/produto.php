<?php 
    class Produto{

        private $id_produto;
        private $nome_produto;
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