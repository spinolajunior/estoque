<?php 

class Local_armazenamentoController extends Conexao{
    use Controlador;
    function __construct($uri,$metodo){
        parent::__construct();    
  }

  public function listar()
  {
      return $this -> pdo -> query("SELECT * from local_arm ; ") ->fetchAll();
  }
  
  
  public function get($id)
  {
    $regex = '/^[0-9]{1,}$/';

    if(preg_match($regex,$id) and $id != 0)
    {
         if($this-> pdo -> query("SELECT * from local_arm WHERE idLocal_arm = $id;") ->fetchAll())
            return $this-> pdo -> query("SELECT * from local_arm WHERE idLocal_arm = $id; ") ->fetchAll();
        else return array("03" => "Local armazenamento ID = $id não existe!");
    }return array("02" => "Informe um Id numerico com no minimo 1 digito! maior que 0.");
  }
  public function post()
  {
        $regex = '/^[A-Z,a-z]{5,}$/';
        $local = $_POST['local'];
        if(preg_match($regex,$local)){
                if($this-> pdo -> query("INSERT INTO local_arm (local) values ('$local');"))
                    return array('01' => "Local armazenamento $local cadastrado com sucesso!");
                else return array('02' => "Falha ao realizar INSERT!");
                }return array('03' => "Somente Letras são permitidas , Min 5 digitos!");
        
  }
  
  public function put($id)
  {
    if($this->validarID($id)){
        global $_PUT;
        $regex = '/^[A-Z,a-z]{5,}$/';
        $local = $_PUT['local'];
        if ($this->pdo->query("SELECT idLocal_arm FROM local_arm WHERE idLocal_arm = $id")->fetch()){
            if($this->pdo->query("UPDATE local_arm SET local = '$local' where idLocal_arm = $id;")){
                return array('01' => "Local armazenamento $local atualizado com sucesso!");
            }return array('02' => "Falha ao realizar UPDATE!" );
        }return array('03' => "Local armazenamento ID = $id não existe!" );
    }return array("02" => "Informe um Id numerico com no minimo 1 digito! maior que 0.");
  }
  
  public function delete($id)
  {
    $regex = '/^[0-9]{1,}$/';

    if(preg_match($regex,$id) and $id != 0){
        if($this -> pdo -> query("SELECT idLocal_arm FROM local_arm WHERE idLocal_arm = $id")->fetch()){
            if($this-> pdo -> query("DELETE  FROM local_arm WHERE idLocal_arm = $id")){
                return array("01" => "Local de armazenamento ID = $id Deletado com sucesso!");
            } return array("02" => "Erro");
        } return array("03" => "Não existe Local de armazenamento cadastrado com ID = $id");
    } return array("04" => "Informe um Id numerico com no minimo 1 digito! maior que 0.");
  }
  
}