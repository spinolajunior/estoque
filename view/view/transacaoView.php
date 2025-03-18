<?php 

class TransacaoView{
private $controlador,$retorno,$uri;
function __construct($uri,$metodo)
{
    $this->uri = $uri;
    $this-> controlador = new TransacaoController($uri,$metodo);
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
public function listar($transacao)
    {

        echo "<b> Transações Cadastradas </b>";
    
        foreach($transacao as $query)
        {
                echo "<br>";
                echo  'ID = '.$query['idTra']." | ";
                echo  'Transação = '.$query['nome']." |";
        } 
    }
    
    public function get($transacao)
    {
        if($transacao){
        echo "<b> Transação Cadastrada com o id = </b>".$this->uri[1];
        foreach($transacao as $query)
        {
                echo "<br>";
                echo  'ID = '.$query['idTra']." | ";
                echo  'Transação = '.$query['nome']." |";
        }
        } else{
            echo "<b>Transação com o id = </b>".$this->uri[1]."<b> não existe.</b>";
        }
        

    }

    public function post($transacao)
    {
        if ($transacao)
            echo "Transação cadastrada com sucesso!";
        else
            echo "Erro";
    }
    
    
    public function put($transacao)
    {
        if ($transacao)
            echo "Transação alterada com sucesso!";
        else
            echo "Erro na atualização da Transação!";
    }
    
    public function delete($transacao)
    {
        if($transacao)
            echo "Transação id = ".$this->uri[1]." Deletada com sucesso!";
        else
            echo "deu erro!";
    }
}