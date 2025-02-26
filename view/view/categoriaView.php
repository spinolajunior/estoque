<?php 

class CategoriaView{
private $controlador,$retorno,$uri;
function __construct($uri,$metodo)
{
    $this->uri=$uri;
    $this-> controlador = new CategoriaControler($uri,$metodo);
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
public function listar($categoria)
    {

        echo "<b> Categorias Cadastradas </b>";
    
        foreach($categoria as $query)
        {
                echo "<br>";
                echo  'ID = '.$query['idCategoria']." | ";
                echo  'Categoria = '.$query['nome']." |";
        } 
    }
    
    public function get($categoria)
    {
        
        foreach($categoria as $query)
        {
                echo "<br>";
                echo  'ID = '.$query['idCategoria']." | ";
                echo  'Categoria = '.$query['nome']." |";
        } 
    }

    public function post($categoria)
    {
        if ($categoria)
            echo "Categoria cadastrada com sucesso!";
        else
            echo "Erro";
    }
    
    
    public function put($categoria)
    {
        if ($categoria)
            echo "Categoria alterada com sucesso!";
        else
            echo "Erro na atualização da categoria!";
    }
    
    public function delete($categoria)
    {
        if($categoria)
            echo "Categoria id {$this->uri[1]} Deletada com sucesso!";
        else
            echo "deu erro!";
    }
}