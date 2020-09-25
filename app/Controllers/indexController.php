<?php 
     class IndexController{

        private $url;
        private $acao;

        public function getAcao(){
            return $this->acao;
        }

        //configura A Rota
        public function configRoutes($url){
            //Rotas da Aplicação Ficam Aqui

            //Recebe True Se A rota Existir
            $existeRota = false;

            //GUARDA AS ROTAS DA APLICAÇÃO
            $rotas = array(
                //Adiciona As Rotas Aqui
                array('acao' => 'cadastrarProduto'),  
                array('acao' => 'listarProdutos'),
                array('acao' => 'verProduto'),
                array('acao' => 'dois'),
                array('acao' => 'tres'),
            );

            //checa se A Rota passa Existe
            //configura ELa se Existir

            foreach($rotas as $key => $item){

                $rota = $item['acao'];
                //echo '<br/><hr>Rota: '.$rota;

                //Acessa as Rotas Configuradas e verifica Qual ea do Contexto
                //Se Ela Existir Configura Ela pra ser Usada na varivel = $acao
                //Se Não Existir REDIRECIONA
                if($rota == $url){
                    //echo '<-Essa EA ATUAL->';
                    //CONFIGURA ROTA
                    $this->acao = $rota;
                    //informa que existe Rota = true
                    $existeRota = true;
                    //seta  A rota na Ação que sera Recupera Depois pela Função -> getAcao();
                    $this->acao = $url;
                }
            }

            //--------------------------------------//
                // Se Nao Existir Redireciona O Usuario!//
                //--------------------------------------//
                if($existeRota == false){
                    //redireciona o Usuario se A rota Passada Nao existir nas Rotas da Aplicação!
                    header("Location:index.php");
                    //echo '<br/><hr>Rota nao Consta<hr>';
                }
            



        }

        public function initRoutes($controla){
            

            if(isset($_GET['acao'])){ //SIM -> checa se esta setada
                
                //checa se a Rota Acao-> esta Setada
                if($_GET['acao']){
                    //Recebe A Rota
                    $url = $_GET['acao'];

                    //Passa A rota
                    Return $this->configRoutes($url);

                }else{//nao esta Setada -> Redireciona o Usuario
                    header("Location:index.php");

                }
            
            }elseif($controla){//usa a variavel $controla;

                //recebe A rota
                $url = $controla;
                //Passa A Rota
                return $this->configRoutes($url);

            }else{//redireciona o Usuario
                //nao existe $_GET['acao'];
                header("Location:index.php");
            }

        }

     }

?>