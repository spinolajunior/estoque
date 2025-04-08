<?php 

class Local_armazenamentoView{
private $controlador,$retorno;
function __construct($uri,$metodo)
{
    $this-> controlador = new Local_armazenamentoController($uri,$metodo);
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

public function listar($armazenamento)
    {

        echo "<b> Local de armazenamento cadastrados. </b>";

        foreach($armazenamento as $query)
        {
                echo "<br>";
                echo  'ID = '.$query['idLocal_arm']." | ";
                echo  'Local = '.$query['local'];
        } 
    }
    
    public function get($armazenamento,$uri)
    {
        if(isset($armazenamento['02']) or isset($armazenamento['03'])){
            foreach($armazenamento as $x){
                echo $x;
            }

        } else{
            echo "<b> Local de armazenamento Cadastrado  com o id = </b>".$uri[1];
        foreach($armazenamento as $query)
        {
                echo "<br>";
                echo  'ID = '.$query['idLocal_arm']." | ";
                echo  'Local = '.$query['local']." |";
        }
        }
        

    }

    public function post($armazenamento)
    {
        foreach ($armazenamento as $x)
        {
            echo $x;
        }
    }
    
    
    public function put($armazenamento)
    {
        foreach ($armazenamento as $x)
        {
            echo $x;
        }
    }
    
    public function delete($armazenamento,$uri)
    {
        foreach ($armazenamento as $x)
        {
            echo $x;
        }
    }
}