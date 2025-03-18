<?php 

class Mov_produtoView {
private $controlador,$retorno,$uri;
function __construct($uri,$metodo)
{
    $this->uri = $uri;
    $this-> controlador = new Mov_produtoControler($uri,$metodo);
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
public function listar($movimentacao)
    {

        echo "<b> movimentacao Cadastradas </b>";
    
        foreach($movimentacao as $query)
        {
                echo "<br>";
                echo  'ID Movimentação = '.$query['idMov']." | ";
                echo  'Codigo Produto = '.$query['codBarras']." |";
                echo  'Quantidade = '.$query['quantidade']." |";
        } 
    }
    
    public function get($movimentacao)
    {
        if($movimentacao){
        echo "<b> movimentacao  com o id = </b>".$this->uri[1];
        foreach($movimentacao as $query)
        {
            echo "<br>";
            echo  'ID Movimentação = '.$query['idMov']." | ";
            echo  'Codigo Produto = '.$query['codBarras']." |";
            echo  'Quantidade = '.$query['quantidade']." |";
        }
        } else{
            echo "<b> movimentacao com o id = </b>".$this->uri[1]."<b> não existe.</b>";
        }
        

    }

    public function post($movimentacao)
    {
        if ($movimentacao)
            echo "Movimentação cadastrada com sucesso!";
        else
            echo "Erro";
    }
    
    
    public function put($movimentacao)
    {
        if ($movimentacao)
            echo "Movimentação alterada com sucesso!";
        else
            echo "Erro na atualização da Movimentação!";
    }
    
    public function delete($movimentacao)
    {
        if($movimentacao)
            echo "Movimentação id = ".$this->uri[1]." Deletada com sucesso!";
        else
            echo "deu erro!";
    }
}