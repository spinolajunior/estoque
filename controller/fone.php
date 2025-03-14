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
        return $this-> pdo -> query("SELECT * from fone WHERE idFone = '$id'; ") ->fetchAll();  
    }
    
    public function post()
    {
    
        $id_Pessoa = $_POST['id_Pessoa'];
        $tel = $_POST['tel'];

        return $this-> pdo -> query("INSERT INTO fone 
        (id_pessoa,tel) 
        values 
        ('$id_Pessoa','$tel');");  
    
    }
    
    public function put($id)
    {
        global $_PUT;
        $id_Pessoa = $_POST['id_Pessoa'];
        $tel = $_POST['tel'];

       return $this-> pdo -> query("UPDATE fone SET 
       id_Pessoa = '$id_Pessoa',
       tel = '$tel' 
       where idFone = $id;");
    }
    
    public function delete($id)
    {
        $consulta = $this-> pdo -> query("SELECT idFone FROM fone WHERE idFone = $id");
        if($consulta)
            return $this-> pdo -> query("DELETE  FROM fone WHERE idFone = $id");
        else
            return false;
    }
    
}