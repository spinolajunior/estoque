<?php

class ProdutoControler extends Conexao{
    use Controlador;

    
    public function listar()
{
    return $this -> pdo -> query("SELECT * from produto; ") ->fetchAll();
}


public function get($id)
{
    return $this-> pdo -> query("SELECT * from produto WHERE codBarras = '$id'; ") ->fetchAll();  
}

public function post()
{

    $codBarras = $_POST['codBarras'];
    $nome = $_POST['nome'];
    $validade = $_POST['validade'];
    $quantidade = $_POST['quantidade'];
    $idLocal_arm = $_POST['idLocal_arm'];
    $idCategoria = $_POST['idCategoria'];
    return $this-> pdo -> query("INSERT INTO produto (nome,codBarras,validade,quantidade,idLocal_arm,idCategoria) values ('$nome','$codBarras','$validade','$quantidade','$idLocal_arm','$idCategoria');");  

}

public function put($id)
{
    global $_PUT;
    $codBarras = $_PUT['codBarras'];
    $nome = $_PUT['nome'];
    $validade = $_PUT['validade'];
    $quantidade = $_PUT['quantidade'];
    $idLocal_arm = $_PUT['idLocal_arm'];
    $idCategoria = $_PUT['idCategoria'];
   return $this-> pdo -> query("UPDATE produto
    SET codBarras = '$codBarras',
    nome = '$nome',
    validade = '$validade',
    quantidade = '$quantidade',
    idLocal_arm = '$idLocal_arm',
    idCategoria = '$idCategoria'
    where codBarras = $id;");
}

public function delete($id)
{
    $consulta = $this-> pdo -> query("SELECT codBarras FROM produto WHERE codBarras = $id");

    if($consulta and $consulta->rowCount() > 0)
        return $this-> pdo -> query("DELETE  FROM produto WHERE codBarras = $id");
    else
        return false;
}

}
    

