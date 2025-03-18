<?php 
class ProdutoView {
    private $controlador,$retorno,$uri;
    function __construct($uri,$metodo)
    {
        $this->uri=$uri;
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
                echo "<hr>";
                echo  $query['nome']." | ";
                echo  'Codigo de Barras | '.$query['codBarras']." | ";
                echo  $query['validade']." | ";
                echo  $query['quantidade']." | ";
                echo "<hr>";
        } 
    }
    
    public function get($produto)
    {
        if($produto){
            echo "<b>Produto cadastrado com o codigo de barras = </b>".$this->uri[1];
        foreach($produto as $query)
        {
            echo "<hr>";
            echo  $query['nome']." | ";
            echo  'Codigo de Barras | '.$query['codBarras']." | ";
            echo  $query['validade']." | ";
            echo  $query['quantidade']." | ";
            echo "<hr>";
        } 
        }else{
            echo "<b>Produto com o codigo de Barras = ".$this->uri[1]." não existe. </b>";  
        }
    }

    public function post($produto)  
    {
       
        if($produto){
            echo 'Produto cadastrado com sucesso';
        }else{
            echo 'Falha ao cadastrar o produto';
        }
    }
    
    
    public function put($produto)
    {
        if($produto){
            echo 'Produto atualizado com sucesso';
        }else{
            echo 'Falha ao atualizar o produto';
        }
    }
    
    public function delete($produto)
    {
        if($produto){
            echo "<b>Produto com o id = ".$this->uri[1]." Deletado com sucesso!</b>";
        }else{
            echo "<b>Produto com o id = ".$this->uri[1]." Não existe!</b>";
        }
    }

}


?>