<?php 

class Local_armazenamentoController extends Conexao{
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