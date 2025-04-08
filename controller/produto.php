<?php

class ProdutoControler extends Conexao{
    use Controlador;

    
    public function listar()
{
    return $this -> pdo -> query("SELECT * from produto; ") ->fetchAll();
}


public function get($id)
{
    $validaCB = '/^[0-9]{13,13}$/';
    if(preg_match($validaCB,$id)){
        if ($this-> pdo -> query("SELECT codBarras from produto WHERE codBarras = $id; ") ->fetch()){
            return $this-> pdo -> query("SELECT * from produto WHERE codBarras = $id; ") ->fetchAll();
        } return array('02' => "Não existe produto Cod = $id no Banco de dados!.");
    } return array('03' => "Cod de barras = $id Invalido,informe um codigo numerico com 13 digitos!.");
}

public function post()
{
    $regexCB = '/^[0-9]{13,13}$/';
    $regexNome = '/^[a-zA-Z]{5,}$/';
    $regexValidade = '/^\d{4}-\d{2}-\d{2}$/';
    $regexQuantidade = '/^[0-9]{1,}$/';
    $regexId = '/^[0-9]{1,}$/';

    $codBarras = $_POST['codBarras'];
    $nome = $_POST['nome'];
    $validade = $_POST['validade'];
    $quantidade = $_POST['quantidade'];
    $idLocal_arm = $_POST['idLocal_arm'];
    $idCategoria = $_POST['idCategoria'];
    if(preg_match($regexCB,$codBarras)){
        if(preg_match($regexNome,$nome)){
            if (preg_match($regexValidade,$validade)){
                if(preg_match($regexQuantidade,$quantidade)){
                    if(preg_match($regexId,$idLocal_arm)){
                        if(preg_match($regexId,$idCategoria)){
                            if($this-> pdo -> query("INSERT INTO produto (nome,codBarras,validade,quantidade,idLocal_arm,idCategoria) values ('$nome','$codBarras','$validade','$quantidade','$idLocal_arm','$idCategoria');")){
                                return array('01' => "Produto $nome , $codBarras adicionado com sucesso!");
                            } return array('02' => "'INSERT' ERROO!");
                        } return array('03' => "ID Invalido!");
                    } return array('04' => "ID Invalido!");
                } return array('05' => "Quantidade Invalida!");
            } return array('06' => "Data Invalida!");
        } return array('07' => "Nome Invalido min 5 digitos a-Z");
    } return array('08' => "Codigo de barras Invalido, informe um codigo com 13 digitos numericos.");


}

public function put($id)
{
    global $_PUT;
    $regexCB = '/^[0-9]{13,13}$/';
    $regexNome = '/^[a-zA-Z]{5,}$/';
    $regexValidade = '/^\d{4}-\d{2}-\d{2}$/';
    $regexQuantidade = '/^[0-9]{1,}$/';
    $regexId = '/^[0-9]{1,}$/';

    $codBarras = $_PUT['codBarras'];
    $nome = $_PUT['nome'];
    $validade = $_PUT['validade'];
    $quantidade = $_PUT['quantidade'];
    $idLocal_arm = $_PUT['idLocal_arm'];
    $idCategoria = $_PUT['idCategoria'];
    if(preg_match($regexCB,$codBarras)){
        if(preg_match($regexNome,$nome)){
            if (preg_match($regexValidade,$validade)){
                if(preg_match($regexQuantidade,$quantidade)){
                    if(preg_match($regexId,$idLocal_arm)){
                        if(preg_match($regexId,$idCategoria)){
                            if($this-> pdo -> query("UPDATE produto SET codBarras = '$codBarras', nome = '$nome',
                                validade = '$validade', quantidade = '$quantidade', idLocal_arm = '$idLocal_arm',
                                idCategoria = '$idCategoria' where codBarras = $id;")){
                                return array('01' => "Produto $nome , $codBarras Atualizado com sucesso!");
                            } return array('02' => "'UPDATE' ERROO!");
                        } return array('03' => "ID Invalido!");
                    } return array('04' => "ID Invalido!");
                } return array('05' => "Quantidade Invalida!");
            } return array('06' => "Data Invalida!");
        } return array('07' => "Nome Invalido min 5 digitos a-Z");
    } return array('08' => "Codigo de barras Invalido, informe um codigo com 13 digitos numericos.");

}

public function delete($id)
{
    $regex = '/^[0-9]{13,13}$/';

    if(preg_match($regex,$id)){
        if($this -> pdo -> query("SELECT codBarras FROM produto WHERE codBarras = $id")->fetch()){
            if($this-> pdo -> query("DELETE  FROM produto WHERE codBarras = $id")){
                return array("01" => "Produto cod = $id Deletado com sucesso!");
            } return array("02" => "'DELETE' ERROO");
        } return array("03" => "Não existe Produto Com este codigo! = $id");
    } return array("04" => "Codigo de barras Invalido, informe um codigo com 13 digitos numericos.");
}

}
    

