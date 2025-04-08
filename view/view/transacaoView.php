<?php 

class TransacaoView{
private $controlador,$retorno;
function __construct($uri,$metodo)
{
    $this-> controlador = new TransacaoController($uri,$metodo);
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
public function listar($transacao)
    {

        echo "<b> Transações Cadastradas </b>";
    
        foreach($transacao as $query)
        {
                echo "<hr>";
                echo  'ID = '.$query['idTra']." | ";
                echo  'Transação = '.$query['nome']." |<hr>";
        } 
    }
    
    public function get($transacao,$uri)
    {
        if(isset($transacao['02']) or isset($transacao['03'])){
            foreach ($transacao as $x){
                echo $x;
            }
        }else{

            echo "<b> Transação id = </b>".$uri[1];
            foreach($transacao as $query)
            {
                    echo "<hr>";
                    echo  'ID = '.$query['idTra']." | ";
                    echo  'Transação = '.$query['nome']." |<hr>";
            }   
        }  

    }

    public function post($transacao)
    {
        foreach($transacao as $x){
            echo $x;
        }
    }
    
    
    public function put($transacao)
    {
        foreach($transacao as $x){
            echo $x;
        }
    }
    
    public function delete($transacao)
    {
        foreach($transacao as $x){
            echo $x;
        }
    }
}