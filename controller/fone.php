<?php 
class FoneControler extends Conexao{
    use Controlador;
    function __construct($uri,$metodo){
        parent::__construct();   
    
    }
  

    public function listar()
    {
        return $this -> pdo -> query("SELECT * from fone; ") ->fetchAll();
    }
    
    
    public function get($id)
    {

        if($this->validarID($id))
            if($this-> pdo -> query("SELECT * from fone WHERE idFone = '$id'; ") -> rowCount() > 0)
                return $this-> pdo -> query("SELECT * from fone WHERE idFone = '$id'; ")->fetch();
            else return array('02' => "Não existe Fone cadastrado com este ID = $id.");
        else 
            return array("03" => "Informe um Id numerico com no minimo 1 digito! maior que 0.");

        
    } 
    
    
    public function post()
    {
        
        $regex = '/^[0-9]{10,}$/';
        $regex1 = '/^[0-9]{1,}$/';
        $id_Pessoa = $_POST['id_Pessoa'];
        $tel = $_POST['tel'];
        if(preg_match($regex,$tel)){
            if(preg_match($regex1,$id_Pessoa)){
                if($this->pdo->query("SELECT id_Pessoa FROM pessoa WHERE id_Pessoa=$id_Pessoa")->fetch()){
                    $this-> pdo -> query("INSERT INTO fone (id_pessoa,tel) values ('$id_Pessoa','$tel');");
                    return array('01' => "Fone Cadastrado!");  
                }else{ return array('02' => "Não existe pessoa cadastrada com este id!");}
            }else{ return array('03' => "ID invalido informe um id numerico maior que 0.");}
        }else {return array('04' => "Informe um numero de telefone valido! somente numeros, min 10 digitos.");}
    
    }
    
    public function put($id)
    {
        if($this->validarID($id));          
        else return array("02" => "Informe um Id numerico com no minimo 1 digito! maior que 0.");

        global $_PUT;
        $id_Pessoa = $_PUT['id_Pessoa'];
        $tel = $_PUT['tel'];
        $regex = '/^[0-9]{10,}$/';
        $regex1 = '/^[0-9]{1,}$/';

        if(preg_match($regex1,$id_Pessoa)){
            if(preg_match($regex,$tel)){
                if($this->pdo->query("SELECT idFone FROM fone WHERE idFone = $id")->fetch()){
                    if($this-> pdo -> query("SELECT id_Pessoa from pessoa where id_pessoa = $id_Pessoa")->fetch()){

                        $this-> pdo -> query("UPDATE fone SET 
                        id_Pessoa = '$id_Pessoa',
                        tel = '$tel' 
                        where idFone = $id;");
                        return array('01' => "Fone $id Atualizado com sucesso!");
                    }else{ return array('02' => "Não existe pessoa cadastrada com este ID");}

                }else{ return array('03' => "Não existe Fone cadastrado com o id = $id .");}

            }else{ return array('04' => "O numero $tel é invalido, Informe um numero de telefone valido! somente numeros, min 10 digitos.");}

        }else{ return array ('05' => "idPessoa = $id_Pessoa é invalido informe um id numerico maior que 0.");}
    }
    
    public function delete($id)
    {
        $regex = '/^[0-9]{1,}$/';

        if(preg_match($regex,$id) and $id != 0){
            if($this -> pdo -> query("SELECT idFone FROM fone WHERE idFone = $id")->fetch()){
                if($this-> pdo -> query("DELETE  FROM fone WHERE idFone = $id")){
                    return array("01" => "Fone ID = $id Deletado com sucesso!");
                } return array("02" => "Erro");
            } return array("03" => "Não existe Fone cadastrado com esse ID = $id");
        } return array("04" => "Informe um Id numerico com no minimo 1 digito! maior que 0.");

    }   
}