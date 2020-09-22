<?php //CONNECTION DATABASE

    class Connection{
        
        private $host="localhost";
        private $dbName="formulario_produto";
        private $user="root";
        private $pass="";

        public function connect(){

            try{
                
                $connect = new PDO(
                    "mysql:host=$this->host;dbname=$this->dbName",
                    "$this->user",
                    "$this->pass"
                );

            }catch(PDOException $e){
                echo '<p>'. $e .'</p>';
            }

            return $connect;


        }
    }

?>