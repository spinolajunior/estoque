<?php 
class Conexao{
    
     public $pdo;
    function __construct(){
        
        try{
        $host = "127.0.0.1";
        $dbName = "estoque";
        $userName = "root";
        $password = "";

        $this->pdo = new PDO("mysql:host=$host;dbname=$dbName",$userName,$password);

        #echo "conexao bem sucedida ao banco de dados <b>$dbName</b>. <br>";

        }catch(PDOException $e){
        echo "Erro ao conectar ao banco de dados: $dbName. <br>";
    }
    }

    public function logar($usuario,$senha){
           
        if(isset($_POST['usuario']) and isset($_POST['senha'])){
            $usuario = $_POST['usuario'];
            $senha = $_POST['senha']; 
            
            $sql = "SELECT senha.senha 
                    FROM usuario 
                    JOIN senha ON senha.idUsuario = usuario.idUsuario 
                    WHERE usuario.usuario = '$usuario'";

            $logar = $this->pdo->query($sql)->fetch();
            
            if(isset($logar['senha']))
            if($logar['senha'] == $senha){
              return True;                       
            } return false;  
            
        }
    }

    public function sanitize($string) {
        // Remove espaços extras nas bordas
        $string = trim($string);
    
        // Remove tags HTML e PHP
        $string = strip_tags($string);
    
        // Converte caracteres especiais para entidades HTML (proteção contra XSS)
        $string = htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    
        // Opcional: remove caracteres não imprimíveis
        $string = preg_replace('/[\x00-\x1F\x7F]/u', '', $string);
    
        return $string;
    }
}

?>