<?php 

class Local_armazenamentoController extends Conexao{
    use Controlador;
    function __construct(array $uri,$metodo){
        parent::__construct();
        echo "Controlador da classe Local_armazenamento";    
    
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
      return $this -> pdo -> query("SELECT * from local_arm ; ") ->fetchAll();
  }
  
  
  public function get($id)
  {
      return $this-> pdo -> query("SELECT * from local_arm WHERE idLocal_arm = '$id'; ") ->fetchAll();  
  }
  
  public function post()
  {
  
      $local = $_POST['local'];
      return $this-> pdo -> query("INSERT INTO local_arm (local) values ('$local');");  
  
  }
  
  public function put($id)
  {
      global $_PUT;
      $local = $_POST['local'];
     return $this-> pdo -> query("UPDATE local_arm SET local = '$local' where idLocal_arm = $id;");
  }
  
  public function delete($id)
  {
      $consulta = $this-> pdo -> query("SELECT idLocal_arm FROM local_arm WHERE idLocal_arm = $id");
      if($consulta)
          return $this-> pdo -> query("DELETE  FROM local_arm WHERE idLocal_arm = $id");
      else
          return false;
  }
  
}