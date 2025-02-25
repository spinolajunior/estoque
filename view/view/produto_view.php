<?php 
class ProdutoView {
    private $controlador,$retorno;
    function __construct($uri,$metodo)
    {
        $this->controlador = new ProdutoControler();
        $retorno = $this->controlador->despachar($uri,$metodo);
        $retorno;
    }

    public function listar()
    {
        $produto = $this->controlador->$this->pdo ->query("SELECT * from produto; ") ->fetchAll();
    
        foreach($produto as $query)
        {
                echo "<br>";
                echo  $query['codBarras']." | ";
                echo  $query['nome']." |";
                echo  $query['validade']." |";
                echo  $query['quantidade']." |";
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
    
        $query = $this->controlador->$this->pdo ->query("INSERT INTO produtos (`nome`) VALUES ('$_POST[nome]')");
    
            if($query){
                echo "<br> Sucesso";
            }else{
                echo "<br> Erro";
            }
    }
    
    public function get($id)
    {
        $produto = $this->controlador->$this->pdo ->query("SELECT * from produto WHERE codBarras = '$id'; ") ->fetchAll();
    
        foreach($produto as $query)
        {
                echo "<br>";
                echo  $query['codBarras']." | ";
                echo  $query['nome']." |";
                echo  $query['validade']." |";
                echo  $query['quantidade']." |<br> ";
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
        $query = $this->controlador->$this->pdo ->query("UPDATE produto SET nome = '$_PUT[nome]'  WHERE id_user ='$id';");
        if($query){
            echo "<br> Sucesso";
        }else{
            echo "<br> Erro";
        }
    }
    
    public function delete($id)
    {
        echo "Deletar: $id";
            
        $query = $this->controlador->$this->pdo ->query("SELECT codBarras FROM produto WHERE codBarras='$id'; ");
        
        if($query){
            $query = $this->controlador->$this->pdo ->query("DELETE FROM produto WHERE codBarras ='$id';");
            if($query){
                echo "<br> Sucesso! ID: $id deletado.";
            }else{
                echo "<br> Erro!";
            }
        }else{
            echo "<br> Erro: Produto com cod Barras ID = $id não encontrada.";
        }
    }

}


?>