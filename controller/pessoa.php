<?php 

class PessoaControler extends Conexao{
    use controlador;
    function __construct($uri,$metodo){
        parent::__construct();  
    }

  public function listar()
  {
      return $this -> pdo -> query("SELECT * from pessoa; ") ->fetchAll();
  }
  
  
  public function get($id)
  {

    $regex = '/^[0-9]{1,}$/';

    if(preg_match($regex,$id) and $id != 0)
    {
         if($this-> pdo -> query("SELECT id_Pessoa from pessoa WHERE id_Pessoa = $id;") ->fetchAll())
            return $this-> pdo -> query("SELECT * from pessoa WHERE id_Pessoa = $id; ") ->fetchAll();
        else return array("02" => "Pessoa ID = $id não existe!");
    }return array("03" => "Informe um Id numerico com no minimo 1 digito! maior que 0.");

  }
  
  public function post()
  {
    $regexNome = '/^[a-z,A-Z]{10,}$/';
    $regexIdTipoPessoa = '/^[0-9]{1,}$/';
    $regexCnpj_cpf = '/^[0-9]{11,}$/';

    $idTipo_pessoa = $_POST['idTipo_pessoa'];
    $cnpj_cpf = $_POST['cnpj_cpf'];
    $nome = $_POST['nome'];

    if(preg_match($regexNome,$nome)){
        if(preg_match($regexIdTipoPessoa,$idTipo_pessoa)){
            if(preg_match($regexCnpj_cpf,$cnpj_cpf)){
                if($this-> pdo -> query("INSERT INTO pessoa (nome,idTipo_pessoa,cnpj_cpf) values ('$nome','$idTipo_pessoa','$cnpj_cpf');")){
                    return array('01' => "Pessoa cadastrada com sucesso!");
                } return array('02' => "'Insert' ERROO!");
            } return array('03' => "CNPJ,CPF Invalido!");
        } return array('04' => "ID tipo-pessoa = $idTipo_pessoa invalido, informe um id numerico maior que 0. ");
    } return array('05' => "Nome = $nome invalido, informe um nome A-Z, minimo 10 digitos!.");
  }
  
  public function put($id)
  {
    global $_PUT;
    $regexNome = '/^[a-zA-Z]{10,}$/';
    $regexIdTipoPessoa = '/^[0-9]{1,}$/';
    $regexCnpj_cpf = '/^[0-9]{11,}$/';

    $idTipo_pessoa = $_PUT['idTipo_pessoa'];
    $cnpj_cpf = $_PUT['cnpj_cpf'];
    $nome = $_PUT['nome'];

    if(preg_match($regexNome,$nome)){
        if(preg_match($regexIdTipoPessoa,$idTipo_pessoa)){
            if(preg_match($regexCnpj_cpf,$cnpj_cpf)){
                if($this-> pdo -> query("UPDATE pessoa SET nome = '$nome',idTipo_pessoa = $idTipo_pessoa,cnpj_cpf = '$cnpj_cpf'
                where id_Pessoa = $id;")){
                    return array('01' => "Pessoa atualizada com sucesso!");
                } return array('02' => "'UPDATE' ERROO!");
            } return array('03' => "CNPJ,CPF Invalido!");
        } return array('04' => "ID tipo-pessoa = $idTipo_pessoa invalido, informe um id numerico maior que 0. ");
    } return array('05' => "Nome = $nome invalido, informe um nome A-Z, minimo 10 digitos!.");


  }
  
  public function delete($id)
  {
    $regex = '/^[0-9]{1,}$/';

    if(preg_match($regex,$id) and $id != 0){
        if($this -> pdo -> query("SELECT id_Pessoa FROM pessoa WHERE id_Pessoa = $id")->fetch()){
            if($this-> pdo -> query("DELETE  FROM pessoa WHERE id_Pessoa = $id")){
                return array("01" => "Pessoa ID = $id Deletada com sucesso!");
            } return array("02" => "'DELETE' ERROO");
        } return array("03" => "Não existe PESSOA com este ID = $id");
    } return array("04" => "Informe um Id numerico com no minimo 1 digito! maior que 0.");
  }
  
}