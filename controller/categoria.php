<?php 
require_once "conexao.php";

class Categoria extends Conexao{
    function __construct(array $uri,$metodo){
        parent::__construct();
        echo "Controlador da classe Produto";    
    
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
    echo "<br>**** Listar Categoria ****";
    $categoria = $this -> pdo -> query("SELECT * from categoria; ") ->fetchAll();
 
    foreach($categoria as $query)
    {
            echo "<br>";
            echo  $query['idCategoria']." | ";
            echo  $query['nome']." |";
            
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

    $query = $this -> pdo -> query("INSERT INTO categoria (`nome`) VALUES ('$_POST[nome]')");

        if($query){
            echo "<br> Sucesso";
        }else{
            echo "<br> Erro";
        }
}

public function get($id)
{
    $categoria = $this-> pdo -> query("SELECT * from categoria WHERE idCategoria = '$id'; ") ->fetchAll();

    foreach($categoria as $query)
    {
            echo "<br>";
            echo  $query['idCategoria']." | ";
            echo  $query['nome']." |";

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
    $query = $this -> pdo -> query("UPDATE categoria SET nome = '$_PUT[nome]'  WHERE id_user ='$id';");
    if($query){
        echo "<br> Sucesso";
    }else{
        echo "<br> Erro";
    }
}

public function delete($id)
{
    echo "Deletar: $id";
        
    $query = $this -> pdo -> query("SELECT idCategoria FROM categoria WHERE idCategoria='$id'; ");
    
    if($query){
        $query = $this -> pdo -> query("DELETE FROM categoria WHERE idCategoria ='$id';");
        if($query){
            echo "<br> Sucesso! categoria ID: $id deletado.";
        }else{
            echo "<br> Erro!";
        }
    }else{
        echo "<br> Erro: Categoria com ID = $id não encontrada.";
    }
  }
}