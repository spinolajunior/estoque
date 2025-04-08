<?php 

class CategoriaView{
private $controlador,$retorno;
function __construct($uri,$metodo)
{
    $this-> controlador = new CategoriaControler($uri,$metodo);
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
        return  $this -> put($retorno);
        
        elseif ($metodo == 'DELETE')
        return  $this -> delete($retorno,$uri);
        
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
    
    public function get($categoria,$uri)
    {  
    
        if(isset($categoria['02'])){
            echo $categoria['02'];
        }else{
            echo "<b> Categoria com o id = </b>".$uri[1];
            foreach($categoria as $query)
            {
                echo "<br>";
                echo  'ID = '.$query['idCategoria']." | ";
                echo  'Categoria = '.$query['nome']." |";
            }
        }
    }

    public function post($categoria)
    {
        
        if (isset($categoria['02'])){
            echo $categoria['02'];
        }else{
            echo $categoria['01'];
        }
    }
    
    
    public function put($categoria)
    {
        if (isset($categoria['02'])){
            echo $categoria['02'];
        }else{
            echo $categoria['01'];
        }
    }
    
    public function delete($categoria)
    {
        if (isset($categoria['02']) or isset($categoria['03']) or isset($categoria['04'] )){
            foreach($categoria as $x)
            {
                echo $x;
            }
        }else{
            echo $categoria['01'];
        }
         
    }
}