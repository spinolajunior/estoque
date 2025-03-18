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
                echo "<br>";
                echo  $query['codBarras']." | ";
                echo  $query['nome']." |";
                echo  $query['validade']." |";
                echo  $query['quantidade']." |";
        } 
    }
    
    public function get($produto)
    {
        echo "<b>Produto cadastrado com o id </b>".$this->uri[1];
        foreach($produto as $query)
        {
                echo "<br>";
                echo  $query['nome']." |";
                echo  $query['codBarras']." | ";
                echo  $query['validade']." |";
                echo  $query['quantidade']." |<br> ";
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
            echo "<b>Produto com o id = ".$this->uri." Deletado com sucesso!</b>";
        }else{
            echo "<b>Produto com o id = ".$this->uri." Não existe!</b>";
        }
    }

}


?>