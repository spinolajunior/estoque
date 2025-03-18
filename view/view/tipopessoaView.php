<?php 

class TipopessoaView{
private $controlador,$retorno,$uri;
function __construct($uri,$metodo)
{
    $this->uri = $uri;
    $this-> controlador = new Tipo_pessoaController($uri,$metodo);
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
public function listar($tipopessoa)
{
        echo "<b> Tipo pessoa Cadastrado </b>";
    
        foreach($tipopessoa as $query)
        {
                echo "<br>";
                echo  'ID = '.$query['idTipo']." | ";
                echo  'Tipo = '.$query['nome']." |";
        } 
    }
    
    public function get($tipopessoa)
    {
        if($tipopessoa){
        echo "<b> Tipo de pessoa Cadastrado com o id = </b>".$this->uri[1];
        foreach($tipopessoa as $query)
        {
                echo "<br>";
                echo  'ID = '.$query['idTipo']." | ";
                echo  'Tipo = '.$query['nome']." |";
        }
        } else{
            echo "<b> Tipo de pessoa com o id = </b>".$this->uri[1]."<b> não existe.</b>";
        }
        

    }

    public function post($tipopessoa)
    {
        if ($tipopessoa)
            echo "Tipo de pessoa cadastrado com sucesso!";
        else
            echo "Erro";
    }
    
    
    public function put($tipopessoa)
    {
        if ($tipopessoa)
            echo "Tipo de pessoa alterado com sucesso!";
        else
            echo "Erro na atualização do Tipo de pessoa!";
    }
    
    public function delete($tipopessoa)
    {
        if($tipopessoa)
            echo "Tipo de pessoa id = ".$this->uri[1].", Deletado com sucesso!";
        else
            echo "deu erro!";
    }
}