<?php 
require_once "conexao.php";

class Fone extends Conexao{
    function __construct(array $uri,$metodo){
        parent::__construct();
        echo "Controlador da classe Fone";    
    
        if((count($uri) == 1)){
            if($metodo == "GET"){
                $this->listar();
            }elseif($metodo == "POST"){
                $this->post();
            }
        }elseif((count($uri) == 2)){
            if($metodo == "GET"){
                $this->get($uri[1]);
            }elseif($metodo == "PUT"){
                $this->put($uri[1]);
            }elseif($metodo == "DELETE"){
                $this->delete($uri[1]);
            }
    }
  }

public function listar()
{
    $fone = $this -> pdo -> query("SELECT * from fone; ") ->fetchAll();

    foreach($fone as $query)
    {
            echo "<br>";
            echo  $query['idFone']." | ";
            echo  $query['id_Pessoa']." |";
            echo  $query['tel']." |";
    }
}

public function post()
{
    $teste = ['nome'];
    foreach ($teste as $campo) 
    {
        if (!isset($_POST[$campo]) || empty($_POST[$campo])) 
        {
            echo "<br>Erro: O campo '$campo' é obrigatório e não pode estar vazio.";
            return;
        }
    }

    $query = $this -> pdo -> query("INSERT INTO fone (`tel`) VALUES ('$_POST[nome]')");

        if($query){
            echo "<br> Sucesso";
        }else{
            echo "<br> Erro";
        }
}

public function get($id)
{
    $fone = $this -> pdo -> query("SELECT * from fone WHERE idFone = '$id'; ") ->fetchAll();

    foreach($fone as $query)
    {
            echo "<br>";
            echo  $query['idFone']." | ";
            echo  $query['id_Pessoa']." |";
            echo  $query['tel']." |";
    }
}

public function put($id)
{
    global $_PUT;

    echo "Atualizar: $id";
    
    $teste = ['nome'];

    foreach ($teste as $campo) {
        if (!isset($_PUT[$campo]) || empty($_PUT[$campo])) {
            echo "<br>Erro: O campo '$campo' é obrigatório e não pode estar vazio.";
            return;
        }
    }
    $query = $this -> pdo -> query("UPDATE fone SET tel = '$_PUT[tel]'  WHERE id_user ='$id';");
    if($query){
        echo "<br> Sucesso";
    }else{
        echo "<br> Erro";
    }
}

public function delete($id)
{
    echo "Deletar: $id";
        
    $query = $this -> pdo -> query("SELECT idFone FROM fone WHERE idFone='$id'; ");
    
    if($query){
        $query = $this -> pdo -> query("DELETE FROM fone WHERE idFone ='$id';");
        if($query){
            echo "<br> Sucesso! Fone ID: $id deletado.";
        }else{
            echo "<br> Erro!";
        }
    }else{
        echo "<br> Erro: Fone com ID = $id não encontrada.";
    }
}
}