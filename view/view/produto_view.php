<?php 
class ProdutoView {
    private $controlador,$retorno;
    function __construct($uri,$metodo)
    {
        $this->controlador = new ProdutoControler();
        $retorno = $this->controlador->despachar($uri,$metodo);


        if(count($uri)==1){
            if($metodo == 'GET')
            return $this -> listar($retorno);
            elseif ($metodo == 'POST')
            return  $this -> post($retorno);
            
        }
        elseif(count($uri)==2){
            if($metodo == 'GET')
            return $this -> get($retorno);
        
            elseif ($metodo == 'PUT')
            return  $this -> put($retorno);
            
            elseif ($metodo == 'DELETE')
            return  $this -> delete($retorno);
            
        }
    }

    public function listar($produto)
    {

        echo "<b> Produtos Cadastrados </b>";
    
        foreach($produto as $query)
        {
                echo "<br>";
                echo  $query['codBarras']." | ";
                echo  $query['nome']." |";
                echo  $query['validade']." |";
                echo  $query['quantidade']." |";
        } 
    }
    
    public function get($produto)
    {
        
        foreach($produto as $query)
        {
                echo "<br>";
                echo  $query['codBarras']." | ";
                echo  $query['nome']." |";
                echo  $query['validade']." |";
                echo  $query['quantidade']." |<br> ";
        }
    }

    public function post($produto)
    {
        
    }
    
    
    public function put($id)
    {
        
    }
    
    public function delete($id)
    {
        
    }

}


?>