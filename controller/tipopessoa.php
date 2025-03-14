<?php 

class Tipo_pessoaController extends Conexao{
    use controlador;
    function __construct(array $uri,$metodo){
        parent::__construct();
        echo "Controlador da classe TipoPessoa";    
    
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
      return $this -> pdo -> query("SELECT * from tipopessoa; ") ->fetchAll();
  }
  
  
  public function get($id)
  {
      return $this-> pdo -> query("SELECT * from tipopessoa WHERE idTipo = '$id'; ") ->fetchAll();  
  }
  
  public function post()
  {
  
      $nome = $_POST['nome'];
      return $this-> pdo -> query("INSERT INTO  tipopessoa (nome) values ('$nome');");  
  
  }
  
  public function put($id)
  {
      global $_PUT;
      $nome = $_PUT['nome'];
     return $this-> pdo -> query("UPDATE tipopessoa SET nome = '$nome' where idTipo = $id;");
  }
  
  public function delete($id)
  {
      $consulta = $this-> pdo -> query("SELECT idTipo FROM tipopessoa WHERE idTipo = $id");
      if($consulta)
          return $this-> pdo -> query("DELETE  FROM tipopessoa WHERE idTipo = $id");
      else
          return false;
  }
  
}