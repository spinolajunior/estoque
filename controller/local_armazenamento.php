<?php 

class Local_armazenamentoController extends Conexao{
    function __construct(array $uri,$metodo){
        parent::__construct();
        echo "Controlador da classe Local_armazenamento";    
    
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
    $local_armazenamento = $this -> pdo -> query("SELECT * from local_arm; ") ->fetchAll();

    foreach($local_armazenamento as $query)
    {
            echo "<br>";
            echo  $query['idLocal_arm']." | ";
            echo  $query['local']." |";
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

    $query = $this -> pdo -> query("INSERT INTO local_arm (`local`) VALUES ('$_POST[local]')");

        if($query){
            echo "<br> Sucesso";
        }else{
            echo "<br> Erro";
        }
}

public function get($id)
{
    $local_armazenamento = $this -> pdo -> query("SELECT * from local_arm where idLocal_arm = $id ; ") ->fetchAll();

    foreach($local_armazenamento as $query)
    {
            echo "<br>";
            echo  $query['idLocal_arm']." | ";
            echo  $query['local']." |";
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
    $query = $this -> pdo -> query("UPDATE local_arm SET local = '$_PUT[local]'  WHERE idLocal_arm ='$id';");
    if($query){
        echo "<br> Sucesso";
    }else{
        echo "<br> Erro";
    }
}

public function delete($id)
{
    echo "Deletar: $id";
        
    $query = $this -> pdo -> query("SELECT idLocal_arm FROM local_arm WHERE idLocal_arm='$id'; ");
    
    if($query){
        $query = $this -> pdo -> query("DELETE FROM fone WHERE idFone ='$id';");
        if($query){
            echo "<br> Sucesso! Local armazenamento ID: $id deletado.";
        }else{
            echo "<br> Erro!";
        }
    }else{
        echo "<br> Erro: local armazenamento com ID = $id não encontrado.";
    }
}
}