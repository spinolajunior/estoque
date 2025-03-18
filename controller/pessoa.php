<?php 

class PessoaControler extends Conexao{
    use controlador;
    function __construct(array $uri,$metodo){
        parent::__construct();  
    }

  public function listar()
  {
      return $this -> pdo -> query("SELECT * from pessoa; ") ->fetchAll();
  }
  
  
  public function get($id)
  {
      return $this-> pdo -> query("SELECT * from pessoa WHERE id_Pessoa = '$id'; ") ->fetchAll();  
  }
  
  public function post()
  {
  
      $nome = $_POST['nome'];
      $idTipo_pessoa = $_POST['idTipo_pessoa'];
      $cnpj_cpf = $_POST['cnpj_cpf'];

      return $this-> pdo -> query("INSERT INTO pessoa (nome,idTipo_pessoa,cnpj_cpf) values ('$nome','$idTipo_pessoa','$cnpj_cpf');");  
  
  }
  
  public function put($id)
  {
      global $_PUT;
      $nome = $_PUT['nome'];
      $idTipo_pessoa = $_PUT['idTipo_pessoa'];
      $cnpj_cpf = $_PUT['cnpj_cpf'];
     return $this-> pdo -> query("UPDATE pessoa SET nome = '$nome',
     idTipo_pessoa = '$idTipo_pessoa',
     cnpj_cpf = '$cnpj_cpf'
     where id_Pessoa = $id;");
  }
  
  public function delete($id)
  {
      $consulta = $this-> pdo -> query("SELECT id_Pessoa FROM pessoa WHERE id_Pessoa = $id");
      if($consulta)
          return $this-> pdo -> query("DELETE  FROM pessoa WHERE id_Pessoa = $id");
      else
          return false;
  }
  
}