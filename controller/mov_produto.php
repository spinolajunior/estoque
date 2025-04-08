<?php 
class Mov_produtoController extends Conexao{
use Controlador;
function __construct($uri,$metodo) 
{
    parent::__construct();
}
public function listar()
{
    return $this -> pdo -> query("SELECT * FROM mov_produto") -> fetchAll();
}
public function get($id)
{
    $regex = '/^[0-9]{1,}$/';

    if(preg_match($regex,$id) and $id != 0)
    {
         if($this-> pdo -> query("SELECT idMov from mov_produto WHERE idMov = $id;") ->fetchAll())
            return $this-> pdo -> query("SELECT * from mov_produto WHERE idMov = $id; ") ->fetchAll();
        else return array("02" => "Local armazenamento ID = $id não existe!");
    }return array("03" => "Informe um Id numero com no minimo 1 digito! maior que 0.");

}

public function post()
{  
    $validaID = '/^[0-9]{1,}$/';
    $validaCB = '/^[0-9]{13,13}$/';
    $validaQuantidade = '/^[0-9]{1,}$/';
    $idMov = $_POST['idMov'];
    $codBarras = $_POST['codBarras'];
    $quantidade = $_POST['quantidade'];

    if(preg_match($validaID,$idMov)){
        if(preg_match($validaCB,$codBarras)){
            if(preg_match($validaQuantidade,$quantidade)){
                if($this -> pdo -> query("INSERT INTO mov_produto (idMov,codBarras,quantidade) 
                VALUES ('$idMov','$codBarras','$quantidade');")){
                   return array('01' => "Movimentação Cadastrada!"); 
                }return array('02' => "'INSERT' ERRO!!!!");
            }return array('03' => "Entrada invalida , informe uma quantidade valida max 2 digitos!");
        }return array('04' => "Codigo de barras invalido informe um codigo de 13 digitos numericos!");
    }return array('05' => "ID movimentação invalido!");
        
}

public function put($id)
{
    global $_PUT;
    $validaID = '/^[0-9]{1,}$/';
    $validaCB = '/^[0-9]{13,13}$/';
    $validaQuantidade = '/^[0-9]{1,}$/';
    $idMov = $_PUT['idMov'];
    $codBarras = $_PUT['codBarras'];
    $quantidade = $_PUT['quantidade'];

    if(preg_match($validaID,$idMov)){
        if(preg_match($validaCB,$codBarras)){
            if(preg_match($validaQuantidade,$quantidade)){

                if($this -> pdo -> query(
                    "UPDATE mov_produto 
                        SET idMov = '$idMov',
                                codBarras = '$codBarras',
                                    quantidade = '$quantidade'
                                        WHERE idMov = $id;"))

                    { return array('01' => "Movimentação Cadastrada!"); 
                }return array('02' => "'UPDATE' ERRO!!!!"); 
            }return array('03' => "Entrada invalida , informe uma quantidade valida max 2 digitos!");
        }return array('04' => "Codigo de barras invalido informe um codigo de 13 digitos numericos!");
    }return array('05' => "ID movimentação invalido!"); 
}

public function delete($id)
{
    $regex = '/^[0-9]{1,}$/';

        if(preg_match($regex,$id) and $id != 0){
            if($this -> pdo -> query("SELECT idMov FROM mov_produto WHERE idMov = $id")->fetch()){
                if($this-> pdo -> query("DELETE  FROM mov_produto WHERE idMov = $id")){
                    return array("01" => "Movimentação-Produto ID = $id Deletado com sucesso!");
                } return array("02" => "Erro");
            } return array("03" => "Não existe Movimentação-Produto com este ID = $id");
        } return array("04" => "Informe um Id numerico com no minimo 1 digito! maior que 0.");
}

}