<?php 

class Tipo_pessoaController extends Conexao{
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
    $tipoPessoa = $this -> pdo -> query("SELECT * from tipopessoa; ") ->fetchAll();

    foreach($tipoPessoa as $query)
    {
            echo "<br>";
            echo  $query['idTipo']." | ";
            echo  $query['nome']." |";
    }
}

public function post()
{
    $teste = ['nome'];
    foreach ($teste as $campo) 
    {
        if (!isset($_POST[$campo]) || empty($_POST[$campo])) 
        {
            echo "<br>Erro: O campo '$campo' é obrigatório e não pode estar vazio.";
            return;
        }
    }

    $query = $this -> pdo -> query("INSERT INTO tipopessoa (`nome`) VALUES ('$_POST[nome]')");

        if($query){
            echo "<br> Sucesso";
        }else{
            echo "<br> Erro";
        }
}

public function get($id)
{
    $tipoPessoa = $this -> pdo -> query("SELECT * from tipopessoa WHERE idTipo = '$id'; ") ->fetchAll();

    foreach($tipoPessoa as $query)
    {
            echo "<br>";
            echo  $query['idtipo']." | ";
            echo  $query['nome']." |";
    }
}

public function put($id)
{
    global $_PUT;

    echo "Atualizar: $id";
    
    $teste = ['nome'];

    foreach ($teste as $campo) {
        if (!isset($_PUT[$campo]) || empty($_PUT[$campo])) {
            echo "<br>Erro: O campo '$campo' é obrigatório e não pode estar vazio.";
            return;
        }
    }
    $query = $this -> pdo -> query("UPDATE tipopessoa SET nome = '$_PUT[nome]'  WHERE idTipo ='$id';");
    if($query){
        echo "<br> Sucesso";
    }else{
        echo "<br> Erro";
    }
}

public function delete($id)
{
    echo "Deletar: $id";
        
    $query = $this -> pdo -> query("SELECT idTipo FROM tipopessoa WHERE idTipo='$id'; ");
    
    if($query){
        $query = $this -> pdo -> query("DELETE FROM tipopessoa WHERE idTipo ='$id';");
        if($query){
            echo "<br> Sucesso! Transação ID: $id deletado.";
        }else{
            echo "<br> Erro!";
        }
    }else{
        echo "<br> Erro: Transação com ID = $id não encontrada.";
    }
}
}