<?php 

class TransacaoController extends Conexao{
    use controlador;
    function __construct(array $uri,$metodo){
        parent::__construct();
  }

  public function listar()
  {
      return $this -> pdo -> query("SELECT * from transacao; ") ->fetchAll();
  }
  
  
  public function get($id)
  {
    $regex = '/^[0-9]{1,}$/';

    if(preg_match($regex,$id) and $id != 0)
    {
         if($this-> pdo -> query("SELECT idTra from transacao WHERE idTra = $id;") ->fetchAll())
            return $this-> pdo -> query("SELECT * from transacao WHERE idTra = '$id'; ") ->fetchAll();
        else return array("02" => "Transação ID = $id não existe!");
    }return array("03" => "Informe um Id numerico com no minimo 1 digito! maior que 0.");        

  }
  
  public function post()
  {
  
    $regexNome = '/^[a-zA-Z]{5,}$/';
    $nome = $_POST['nome'];
    if(preg_match($regexNome,$nome)){
        if($this-> pdo -> query("INSERT into transacao (nome) values ('$nome');")){
            return array('01' => "Transação $nome cadastrada com sucesso!");
        }return array('02' => "'INSERT' ERROR");
    }return array('03' => "Transação = $nome, invalido, informe um nome a-Z min 5 digitos.");

  
  }
  
  public function put($id)
  {
    global $_PUT;
    $regexNome = '/^[a-zA-Z]{5,}$/';
    $nome = $_PUT['nome'];
    if(preg_match($regexNome,$nome)){
        if($this-> pdo -> query("UPDATE transacao SET nome = '$nome' where idTra = $id;")){
            return array('01' => "Transação $nome cadastrada com sucesso!");
        }return array('02' => "'UPDATE' ERROR");
    }return array('03' => "Transação = $nome, invalido, informe um nome a-Z min 5 digitos.");

  }
  
  public function delete($id)
  {
    $regex = '/^[0-9]{1,}$/';

    if(preg_match($regex,$id) and $id != 0){
        if($this -> pdo -> query("SELECT idTra FROM transacao WHERE idTra = $id")->fetch()){
            if($this-> pdo -> query("DELETE  FROM transacao WHERE idTra = $id")){
                return array("01" => "Transação ID = $id Deletada com sucesso!");
            } return array("02" => "'DELETE' ERROO");
        } return array("03" => "Não existe Transação com este ID = $id");
    } return array("04" => "Informe um Id numerico com no minimo 1 digito! maior que 0.");
  }
  
}