<?php 
class MovimentacaoView{
private $controlador,$retorno;
function __construct($uri,$metodo)
{
    $this->controlador = new MovimentacaoController($uri,$metodo);
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

public function listar($movimentacao)
{
    echo "<b> MOVIMENTAÇÃO! </b><hr>";

        foreach($movimentacao as $query)
        {
                echo  'ID Movimentação = '.$query['idMov']." | ";
                echo  'ID Transação = '.$query['idTra']." | ";
                echo  'ID Pessoa = '.$query['idPessoa']." | <hr>";               
        } 
}

public function get($movimentacao,$uri)
{   

    if(isset($movimentacao['02']) or isset($movimentacao['03'])){
        foreach ($movimentacao as $x){
            echo $x;
        }
    }else{ 

        echo "<b> MOVIMENTAÇÃO! {$uri[1]} </b><hr>";
        foreach($movimentacao as $query)
        {
                echo  'ID Movimentação = '.$query['idMov']." | ";
                echo  'ID Transação = '.$query['idTra']." | ";
                echo  'ID Pessoa = '.$query['idPessoa']." | <hr>";               
        }
    }
}

public function post($movimentacao)
{
    foreach($movimentacao as $x){
        echo $x;
    }
}

public function put($movimentacao)
{
    foreach($movimentacao as $x){
        echo $x;
    }
}

public function delete($movimentacao)
{
    foreach($movimentacao as $x){
        echo $x;
    }
}


}
?>