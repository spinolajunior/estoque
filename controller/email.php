<?php 
    
class EmailControler extends Conexao{
    use Controlador;
    function __construct($uri,$metodo){
        parent::__construct();
    }
  

public function listar()
{
    return $this -> pdo -> query("SELECT * from email; ") ->fetchAll();
}


public function get($id)
{
    $regex = '/^[0-9]{1,}$/';

    if(preg_match($regex,$id) and $id != 0)
    {   
        if($this-> pdo -> query("SELECT * from email WHERE idEmail = $id; ") ->fetchAll()){
            return $this-> pdo -> query("SELECT * from email WHERE idEmail = $id; ") ->fetchAll();
        }
        return array("02" => "Não existe email cadastrado com este ID: $id");
    }return array("03" => "Informe um Id numerico com no minimo 1 digito! maior que 0.");
}

public function post()
{
    $regexEmail = "/^(?![._-])(?:[a-zA-Z0-9]+[._-]?)*[a-zA-Z0-9]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*\.[a-zA-Z]{2,}$/";
    $regexID = '/^[0-9]{1,}$/';

    $idEmail = $_POST['idEmail'];
    $idUsuario = $_POST['idUsuario'];
    $email = $_POST['email'];

    if(preg_match($regexID,$idEmail)){
        if(preg_match($regexID,$idUsuario)){
            if(preg_match($regexEmail,$email)){
                if($this->pdo->query("SELECT from email where email = '$email' ")){
                    $this->pdo->query("INSERT INTO email (idEmail,idUsuario,email) Values($idEmail,$idUsuario,'$email')");
                    return array("01" => "E-mail cadastrado Com sucesso!");
                }else{return array("02" => "Falha! ,ja existe o $email cadastrado!");}
            }else{return array("03" => "Por favor informe um email Valido!");}
        }else{return array("04" => "ID usuario: $idUsuario invalido,informe um Id numerico com no minimo 1 digito! maior que 0.");}
    }else{return array("04" => "ID usuario: $idEmail invalido,informe um Id numerico com no minimo 1 digito! maior que 0.");}
    
}

public function put($id)
{

    if($this->validarID($id));
    else return array("02" => "ID $id para cadastro invalido!,informe um id numerico maior que 0. ");
    
    global $_PUT;
    $regexEmail = "/^(?![._-])(?:[a-zA-Z0-9]+[._-]?)*[a-zA-Z0-9]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*\.[a-zA-Z]{2,}$/";
    $regexID = '/^[0-9]{1,}$/';
    $idEmail = $_PUT['idEmail'];
    $idUsuario = $_PUT['idUsuario'];
    $email = $_PUT['email'];

    if(preg_match($regexID,$idEmail)){
        if(preg_match($regexID,$idUsuario)){
            if(preg_match($regexEmail,$email)){
                if($this->pdo->query("SELECT idEmail FROM email WHERE idEmail = $id;")){
                    $this->pdo->query("UPDATE email SET idEmail = $idEmail,idUsuario = $idUsuario,email = $email");
                    return array('01' => "Update Realizado com sucesso!");
                }else{array('02' => "Não existe email com este ID!");}
            }else{array('03' => "Por favor informe um email valido!");}
        }else{array('04' => "ID usuario: $idUsuario invalido,informe um Id numerico com no minimo 1 digito! maior que 0.");}
    }else{array('05' => "ID email: $idEmail invalido,informe um Id numerico com no minimo 1 digito! maior que 0.");}
}

public function delete($id)
{   
    $regex = '/^[0-9]{1,}$/';

    if(preg_match($regex,$id) and $id != 0){
        if($this -> pdo -> query("SELECT idEmail FROM email WHERE idEmail = $id")->fetch()){
            if($this-> pdo -> query("DELETE  FROM email WHERE idEmail = $id")){
                return array("01" => "Email ID = $id Deletado com sucesso!");
            } return array("02" => "Erro");
        } return array("03" => "Não existe email cadastrado com esse ID = $id");
    } return array("04" => "Informe um Id numerico com no minimo 1 digito! maior que 0.");
}
        
}

