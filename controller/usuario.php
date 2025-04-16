<?php 
    
class UsuarioControler extends Conexao{
    use Controlador;
    function __construct($uri,$metodo){
        parent::__construct();
    }
  

public function listar()
{
    return $this -> pdo -> query("SELECT * from usuario; ") ->fetchAll();
}


public function get($id)
{
    
    $regex = '/^[0-9]{1,}$/';

    if(preg_match($regex,$id) and $id != 0){
        return $this-> pdo -> query("SELECT * from usuario WHERE idUsuario = $id; ") ->fetchAll();
    }return array("02" => "ID: $id invalido! ,Informe um Id numerico com no minimo 1 digito! maior que 0.");
}

public function post()
{
    $regexUsuario = '^[a-zA-Z][a-zA-Z0-9_-]{10,19}$';
    $usuario = $_POST['usuario'];
    if(preg_match($regexUsuario,$usuario)){
        if($this-> pdo -> query("SELECT usuario from usuario where usuario = '$usuario';")){
            $this-> pdo -> query("INSERT into usuario (usuario) values ('$usuario');");
            return array("01"=>"Cadastro com sucesso");
        }else{return array('02' => "Já existe $usuario cadastrado! informe outro!");}
    }else{return array("03"=>"Usuario $usuario invalido! por favor informe um usuario com no minimo 10 digitos <br> somente letras maiusculas e minusculas, somente - _ são permitidos!.");}
        
    
}

public function put($id)
{

    if($this->validarID($id));
    else return array("02" => "ID $id invalido informe um id numerico maior que 0. ");
    
    global $_PUT;
    $regexId = "/^[0-9]{1,}$/";
    $regexUsuario = '^(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z0-9]).{12,}$';
    $usuario = $_PUT['usuario'];
    $idUsuario = $_PUT['idUsuario'];

    if(preg_match($regexUsuario,$usuario)){
        if(preg_match($regexId,$idUsuario)){
            if($this-> pdo -> query("SELECT usuario from usuario where usuario = '$usuario';")){
                if($this-> pdo -> query("UPDATE usuario Set idUsuario = idUsuario, usuario = '$usuario' where idUsuario = $id;")){
                    return array("01"=>"Cadastro com sucesso");
                }else{ return array('02' => "Update ERRO!");}
            }else{return array('03' => "Já existe $usuario cadastrado!, informe outro!");}
        }else{return array("04"=>"Usuario $usuario invalido! por favor informe um usuario com no minimo 12 digitos <br> no minimo 1 letra maiuscula 1 caractere especial e 1 numero!.");}
    }else{return array("05"=>"ID $id invalido informe um id numerico maior que 0. ");}
    
}
public function delete($id)
{   
    $regex = '/^[0-9]{1,}$/';

    if(preg_match($regex,$id) and $id != 0){
        if($this -> pdo -> query("SELECT idUsuario FROM usuario WHERE idUsuario = $id")->fetch()){
            if($this-> pdo -> query("DELETE  FROM usuario WHERE idUsuario= $id")){
                return array("01" => "Usuario ID = $id Deletado com sucesso!");
            } return array("02" => "Erro");
        } return array("03" => "Não existe Usuario cadastrado com esse ID = $id");
    } return array("04" => "Informe um Id numerico com no minimo 1 digito! maior que 0.");
}
        
}

