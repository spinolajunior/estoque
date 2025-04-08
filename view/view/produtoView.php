<?php 
class ProdutoView {
    private $controlador,$retorno;
    function __construct($uri,$metodo)
    {
        $this->controlador = new ProdutoControler();
        $retorno = $this->controlador->despachar($uri,$metodo);


        if(count($uri)==1){
            if($metodo == 'GET')
            return $this -> listar($retorno,$uri);
            elseif ($metodo == 'POST')
            return  $this -> post($retorno,$uri);
            
        }
        elseif(count($uri)==2){
            if($metodo == 'GET')
            return $this -> get($retorno,$uri);
        
            elseif ($metodo == 'PUT')
            return  $this -> put($retorno,$uri);
            
            elseif ($metodo == 'DELETE')
            return  $this -> delete($retorno,$uri);
            
        }
    }

    public function listar($produto)
    {

        echo "<b> Produtos Cadastrados </b>";
    
        foreach($produto as $query)
        {
                echo "<hr>";
                echo  $query['nome']." | ";
                echo  'Codigo de Barras | '.$query['codBarras']." | ";
                echo  $query['validade']." | ";
                echo  $query['quantidade']." | ";
                echo "<hr>";
        } 
    }
    
    public function get($produto,$uri)
    {
       if(isset($produto['02']) or isset($produto['03']))
       {
            foreach($produto as $x){
                echo $x;
            }
       }else
       {

            echo "<b>Produto  = </b>".$uri[1];
            foreach($produto as $query)
            {
                echo "<hr>";
                echo  "Produto = ". $query['nome']." | ";
                echo  'Codigo de Barras = '.$query['codBarras']." | ";
                echo  'Validade = '.$query['validade']." | ";
                echo  'Quantidade = '.$query['quantidade']." | ";
                echo "<hr>";
            } 
        }
        
        
    }

    public function post($produto)  
    {
       
        foreach($produto as $x){
            echo $x;
        }
    }
    
    
    public function put($produto)
    {
        foreach($produto as $x){
            echo $x;
        }
    }
    
    public function delete($produto,$uri)
    {
        foreach($produto as $x){
            echo $x;
        }
    }

}


?>