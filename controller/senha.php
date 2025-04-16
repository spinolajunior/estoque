<?php 
    
class SenhaControler extends Conexao{
    use Controlador;
    function __construct($uri,$metodo){
        parent::__construct();
    }
  

public function listar()
{
    return $this -> pdo -> query("SELECT * from senha; ") ->fetchAll();
}


public function get($id)
{
    $regex = '/^[0-9]{1,}$/';

    if(preg_match($regex,$id) and $id != 0)
    {
        return $this-> pdo -> query("SELECT * from senha WHERE idSenha = $id; ") ->fetchAll();
    }return array("02" => "Informe um Id numerico com no minimo 1 digito! maior que 0.");
}

public function post()
{
    $regexId = "/^[0-9]{1,}$/";
    $regexSenha = '^(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z0-9]).{12,}$';
    $senha = $_POST['senha'];
    $idUsuario = $_POST['idUsuario'];
    if(preg_match($regexId,$idUsuario)){
        if(preg_match($regexSenha,$senha)){
            if($this-> pdo -> query("INSERT into senha(idUsuario,senha) values ($idUsuario,'$senha');")){
                return array("01"=>"Cadastro com sucesso");  
            }else{return array("02"=>"INSER ERROO!");}
        }else{return array("03"=>"Senha invalido!");}
    }else{return array("04"=>"Usuario invalido");}
}

public function put($id)
{
    global $_PUT;
    $regexId = "/^[0-9]{1,}$/";
    $regexSenha = '^(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z0-9]).{12,30}$';
    $senha = $_PUT['senha'];
    $idUsuario = $_PUT['idUsuario'];
    $idSenha =  $_PUT['idSenha'];

    if(preg_match($regexId,$idSenha)){
        if(preg_match($regexId,$idUsuario)){
            if(preg_match($regexSenha,$senha)){
                if($this-> pdo -> query("UPDATE produto SET idUsuario = $idUsuario, idSenha = $idSenha, senha='$senha' where idSenha = $idSenha")){
                    return array("01"=>"Cadastro com sucesso");  
                }else{return array("02"=>"INSER ERROO!");}
            }else{return array("03"=>"Senha invalida!");}
        }else{return array("04"=>"ID usuario invalido");}
    }else{return array('05' =>"ID senha invalido");}
}


public function delete($id)
{   
    $regex = '/^[0-9]{1,}$/';

    if(preg_match($regex,$id) and $id != 0){
        if($this -> pdo -> query("SELECT idSenha FROM senha WHERE idSenha = $id")->fetch()){
            if($this-> pdo -> query("DELETE  FROM senha WHERE idSenha = $id")){
                return array("01" => "Senha ID = $id Deletado com sucesso!");
            } return array("02" => "Erro");
        } return array("03" => "Não existe Senha cadastrado com esse ID = $id");
    } return array("04" => "Informe um Id numerico com no minimo 1 digito! maior que 0.");
}
        
}

