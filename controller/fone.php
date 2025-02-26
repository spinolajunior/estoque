<?php 
class FoneControler extends Conexao{
    use Controlador;
    function __construct(array $uri,$metodo){
        parent::__construct();   
    
    }
  

public function listar()
{
    return $this -> pdo -> query("SELECT * from fone; ") ->fetchAll();
}



public function get($id)
{
    return $this -> pdo -> query("SELECT * from fone WHERE idFone = '$id'; ") ->fetchAll();
}

public function post()
{
   
}

public function put($id)
{
    
}

public function delete($id)
{
    
}
}