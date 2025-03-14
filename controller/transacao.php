<?php 

class TransacaoController extends Conexao{
    use controlador;
    function __construct(array $uri,$metodo){
        parent::__construct();
        echo "Controlador da classe Transacao";    
    
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
      return $this -> pdo -> query("SELECT * from transacao; ") ->fetchAll();
  }
  
  
  public function get($id)
  {
      return $this-> pdo -> query("SELECT * from transacao WHERE idTra = '$id'; ") ->fetchAll();  
  }
  
  public function post()
  {
  
      $nome = $_POST['nome'];
      return $this-> pdo -> query("insert into transacao (nome) values ('$nome');");  
  
  }
  
  public function put($id)
  {
      global $_PUT;
      $nome = $_PUT['nome'];
     return $this-> pdo -> query("UPDATE transacao SET nome = '$nome' where idTra = $id;");
  }
  
  public function delete($id)
  {
      $consulta = $this-> pdo -> query("SELECT idTra FROM transacao WHERE idTra = $id");
      if($consulta)
          return $this-> pdo -> query("DELETE  FROM transacao WHERE idTra = $id");
      else
          return false;
  }
  
}