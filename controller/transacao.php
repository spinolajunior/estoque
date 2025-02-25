<?php 

class TransacaoController extends Conexao{
    function __construct(array $uri,$metodo){
        parent::__construct();
        echo "Controlador da classe Transacao";    
    
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
    $transacao = $this -> pdo -> query("SELECT * from transacao; ") ->fetchAll();

    foreach($transacao as $query)
    {
            echo "<br>";
            echo  $query['idTra']." | ";
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

    $query = $this -> pdo -> query("INSERT INTO transacao (`nome`) VALUES ('$_POST[nome]')");

        if($query){
            echo "<br> Sucesso";
        }else{
            echo "<br> Erro";
        }
}

public function get($id)
{
    $fone = $this -> pdo -> query("SELECT * from transacao WHERE idTra = '$id'; ") ->fetchAll();

    foreach($fone as $query)
    {
            echo "<br>";
            echo  $query['idTra']." | ";
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
    $query = $this -> pdo -> query("UPDATE transacao SET nome = '$_PUT[nome]'  WHERE idTra ='$id';");
    if($query){
        echo "<br> Sucesso";
    }else{
        echo "<br> Erro";
    }
}

public function delete($id)
{
    echo "Deletar: $id";
        
    $query = $this -> pdo -> query("SELECT idTra FROM transacao WHERE idTra='$id'; ");
    
    if($query){
        $query = $this -> pdo -> query("DELETE FROM transacao WHERE idTra ='$id';");
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