<?php

class ProdutoControler extends Conexao{
    use Controlador;

    
    public function listar()
    {
        return $this ->pdo->query("SELECT * from produto; ") ->fetchAll();
    }

    public function get($id)
    {
        return $this->pdo ->query("SELECT * from produto WHERE codBarras = '$id'; ") ->fetchAll();
    
    }
    
    public function post()
    {    
        
        return $this->pdo ->query("INSERT INTO produtos (`nome`) VALUES ('{$_POST['nome']}')");     
    }
    
    public function put($id)
    {
        global $_PUT;
    $this-> pdo ->query("UPDATE produto SET nome = '{$_PUT['nome']}'  WHERE id_user ='$id';");
    }
    
    public function delete($id)
    {
        $query = $this->$this->pdo ->query("SELECT codBarras FROM produto WHERE codBarras='$id'; ");
        
    }

}
    

