<?php

class ProdutoControler extends Conexao{
    use Controlador;

    
    public function listar()
{
    return $this -> pdo -> query("SELECT * from categoria; ") ->fetchAll();
}


public function get($id)
{
    return $this-> pdo -> query("SELECT * from categoria WHERE idCategoria = '$id'; ") ->fetchAll();  
}

public function post()
{

    $nome = $_POST['nome'];
    return $this-> pdo -> query("insert into categoria (nome) values ('$nome');");  

}

public function put($id)
{
    global $_PUT;
    $novo = $_PUT['nome'];
   return $this-> pdo -> query("UPDATE categoria SET nome = '$novo' where idCategoria = $id;");
}

public function delete($id)
{
    $consulta = $this-> pdo -> query("SELECT idCategoria FROM categoria WHERE idCategoria = $id");
    if($consulta)
        return $this-> pdo -> query("DELETE  FROM categoria WHERE idCategoria = $id");
    else
        return false;
}

}
    

