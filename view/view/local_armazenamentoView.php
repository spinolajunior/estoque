<?php 

class Local_armazenamentoView{
private $controlador,$retorno,$uri;
function __construct($uri,$metodo)
{
    $this->uri = $uri;
    $this-> controlador = new Local_armazenamentoController($uri,$metodo);
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
    
    public function get($armazenamento)
    {
        if($armazenamento){
        echo "<b> Local de armazenamento Cadastrado  com o id = </b>".$this->uri[1];
        foreach($armazenamento as $query)
        {
                echo "<br>";
                echo  'ID = '.$query['idLocal_arm']." | ";
                echo  'Local = '.$query['local']." |";
        }
        } else{
            echo "<b> Local de armazenamento com o id = </b>".$this->uri[1]."<b> não existe.</b>";
        }
        

    }

    public function post($armazenamento)
    {
        if ($armazenamento)
            echo "Local de armazenamento cadastrado com sucesso!";
        else
            echo "Erro";
    }
    
    
    public function put($armazenamento)
    {
        if ($armazenamento)
            echo "Local de armazenamento alterado com sucesso!";
        else
            echo "Erro na atualização do local de armazenamento!";
    }
    
    public function delete($armazenamento)
    {
        if($armazenamento)
            echo "Local de armazenamento id = ".$this->uri[1]." Deletado com sucesso!";
        else
            echo "deu erro!";
    }
}