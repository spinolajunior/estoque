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

        echo "conexao bem sucedida ao banco de dados <b>$dbName</b>. <br>";

        }catch(PDOException $e){
        echo "Erro ao conectar ao banco de dados: $dbName. <br>";
    }
    }

}
?>