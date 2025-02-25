<?php 

class PessoaControler extends Conexao{
    function __construct(array $uri,$metodo){
        parent::__construct();
        echo "Controlador da classe Pessoa";    
    
        if((count($uri) == 1)){
            if($metodo == "GET"){
                echo "<br> Listar";
                $this->listar();
            }elseif($metodo == "POST"){
                echo "<br> Post";
                $this->post();
            }
        }elseif((count($uri) == 2)){
            if($metodo == "GET"){
                echo "<br> Get";
                $this->get($uri[1]);
            }elseif($metodo == "PUT"){
                echo "<br> Put";
                $this->put($uri[1]);
            }elseif($metodo == "DELETE"){
                echo "<br> Delete";
                $this->delete($uri[1]);
            }
    }
  }

public function listar()
{
    $pessoa = $this-> pdo ->  query("SELECT * from pessoa;") ->fetchAll();
    $itens = count($pessoa);
    echo "<br>**** Pessoas Cadastradas ****<br>";

    for ($num = 0; $num < $itens;$num += 1)
    {
            echo  $pessoa[$num]['id_Pessoa']." | ";
            echo  $pessoa[$num]['nome']." | <br> ";
    }

}

public function get($id)
{
    $pessoa = $this-> pdo -> query("SELECT * from pessoa WHERE id_Pessoa = '$id'; ") ->fetchAll();

    foreach($pessoa as $task)
    {
            echo "<br>";
            echo  $task['id_Pessoa']." | ";
            echo  $task['nome']." |<br> ";
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

    $query = $this -> pdo -> query("INSERT INTO pessoa (`nome`) VALUES ('$_POST[nome]')");

        if($query){
            echo "<br> Sucesso";
        }else{
            echo "<br> Erro";
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
    $query = $this -> pdo -> query("UPDATE pessoa SET nome = '$_PUT[nome]'  WHERE id_user ='$id';");
    if($query){
        echo "<br> Sucesso";
    }else{
        echo "<br> Erro";
    }
}


public function delete($id)
{
    echo "Deletar: $id";
        
    $query = $this -> pdo -> query("SELECT id_Pessoa FROM pessoa WHERE id_pessoa='$id'; ");
    
    if($query){
        $query = $this -> pdo -> query("DELETE FROM pessoa WHERE id_Pessoa ='$id';");
        if($query){
            echo "<br> Sucesso! ID: $id deletado.";
        }else{
            echo "<br> Erro!";
        }
    }else{
        echo "<br> Erro: usuario com ID $id não encontrada.";
    }
   
}
}