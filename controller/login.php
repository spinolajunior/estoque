<?php {
    class Login{
    
        public function logar($login,$senha){
            if(isset($_POST['usuario']) and isset($_POST['senha'])){
                $usuario = $_POST['usuario'];
                $senha = $_POST['senha']; 
                
                $sql = "SELECT senha.senha 
                        FROM usuario 
                        JOIN senha ON senha.idUsuario = usuario.idUsuario 
                        WHERE usuario.usuario = '$usuario'";

                $logar = $this->pdo->query($sql)->fetch();
                
                
                if($logar){
                    $_SESSION["logado"]=$usuario; 
                    var_dump($_POST);}
            }  
        }
        }
    }   
      

?>
