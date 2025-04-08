<?php 

class MovimentacaoController extends Conexao{
    use Controlador;
    function __construct($uri,$metodo){
        parent::__construct();  

  }

public function listar()
{
    return $this->pdo->query("SELECT * FROM movimentacao;")->fetchAll();
}

public function get($id)
{
    $regex = '/^[0-9]{1,}$/';

    if(preg_match($regex,$id) and $id != 0)
    {
        if($this-> pdo -> query("SELECT idMov from movimentacao WHERE idMov = $id;") ->fetchAll())
            return $this-> pdo -> query("SELECT * from movimentacao WHERE idMov = $id; ") ->fetchAll();
        else return array("02" => "Movimentação ID = $id não existe!");
    }return array("03" => "Informe um Id valido, numerico com no minimo 1 digito! maior que 0.");

}

public function post()
{


    $validaId = '/^[0-9]{1,}$/';
    
    $idMov = $_POST['idMov'];
    $idTra = $_POST['idTra'];
    $idPessoa = $_POST['idPessoa'];

    if(preg_match($validaId,$idMov)){
        if(preg_match($validaId,$idTra)){
            if(preg_match($validaId,$idPessoa)){
                if($this -> pdo -> query("INSERT INTO movimentacao (idMov,idTra,idPessoa) 
                VALUES ($idMov,$idTra,$idPessoa);")){
                   return array('01' => "Movimentação Cadastrada!"); 
                }return array('02' => "'INSERT' ERRO!!!!");
            }return array('03' => "ID Pessoa invalido!, informe um id numerico maior que 0.");
        }return array('04' => "ID Transação invalido!, informe um id numerico maior que 0.");
    }return array('05' => "ID movimentação invalido!, informe um id numerico maior que 0.");

}

public function put($id)
{
    global $_PUT;
    $validaId = '/^[0-9]{1,}$/';
    
    $idMov = $_PUT['idMov'];
    $idTra = $_PUT['idTra'];
    $idPessoa = $_PUT['idPessoa'];

    if(preg_match($validaId,$idMov)){
        if(preg_match($validaId,$idTra)){
            if(preg_match($validaId,$idPessoa)){
                if($this -> pdo -> query("UPDATE movimentacao SET idMov = $idMov,idTra = $idTra,idPessoa = $idPessoa Where idMov = $id;")){
                   return array('01' => "Movimentação Atualizada!"); 
                }return array('02' => "'UPDATE' ERRO!!!!");
            }return array('03' => "ID Pessoa invalido!, informe um id numerico maior que 0.");
        }return array('04' => "ID Transação invalido!, informe um id numerico maior que 0.");
    }return array('05' => "ID movimentação invalido!, informe um id numerico maior que 0.");

}

public function delete($id)
{
    $regex = '/^[0-9]{1,}$/';

    if(preg_match($regex,$id) and $id != 0){
        if($this -> pdo -> query("SELECT idMov FROM movimentacao WHERE idMov = $id")->fetch()){
            if($this-> pdo -> query("DELETE  FROM movimentacao WHERE idMov = $id")){
                return array("01" => "Movimentação ID = $id Deletado com sucesso!");
            } return array("02" => "'DELETE' ERROOO!");
        } return array("03" => "Não existe Movimentação com ID = $id");
    } return array("04" => "Informe um Id numerico com no minimo 1 digito! maior que 0.");
}
}