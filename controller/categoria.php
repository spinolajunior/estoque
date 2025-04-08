<?php 
    
class CategoriaControler extends Conexao{
    use Controlador;
    function __construct($uri,$metodo){
        parent::__construct();
    }
  

public function listar()
{
    return $this -> pdo -> query("SELECT * from categoria; ") ->fetchAll();
}


public function get($id)
{
    $regex = '/^[0-9]{1,}$/';

    if(preg_match($regex,$id) and $id != 0)
    {
        return $this-> pdo -> query("SELECT * from categoria WHERE idCategoria = '$id'; ") ->fetchAll();
    }return array("02" => "Informe um Id numerico com no minimo 1 digito! maior que 0.");
}

public function post()
{
    $regex = '/^[a-zA-Z\s]{4,}$/';
    $nome = $_POST['nome'];
    if(preg_match($regex,$nome))
    {
        if($this-> pdo -> query("insert into categoria (nome) values ('$nome');"))
            return array("01"=>"Cadastro com sucesso");  
    }
    return array("02"=>"Por favor informe un nome valido somente Letras são permitidas!, min 4 digitos.");
}

public function put($id)
{

    if($this->validarID($id));
    else return array("02" => "ID $id invalido informe um id numerico maior que 0. ");
    
    global $_PUT;
    $regex = '/^[a-zA-Z\s]{4,}$/';
    $nome = $_PUT['nome'];
    if(preg_match($regex,$nome))
    {
        $this-> pdo -> query("UPDATE categoria SET nome = '$nome' where idCategoria = $id;");
        return array("01" => "Produto Cadastrado Com Sucesso!");
    }
    return array("02" => "Por favor informe un nome valido somente Letras são permitidas!, min 4 digitos.");
}

public function delete($id)
{   
    $regex = '/^[0-9]{1,}$/';

    if(preg_match($regex,$id) and $id != 0){
        if($this -> pdo -> query("SELECT idCategoria FROM categoria WHERE idCategoria = $id")->fetch()){
            if($this-> pdo -> query("DELETE  FROM categoria WHERE idCategoria = $id")){
                return array("01" => "Categoria ID = $id Deletado com sucesso!");
            } return array("02" => "Erro");
        } return array("03" => "Não existe Categoria cadastrado com esse ID = $id");
    } return array("04" => "Informe um Id numerico com no minimo 1 digito! maior que 0.");
}
        
}

