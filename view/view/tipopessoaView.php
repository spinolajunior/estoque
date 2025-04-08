<?php 

class TipopessoaView{
private $controlador,$retorno;
function __construct($uri,$metodo)
{
    $this-> controlador = new Tipo_pessoaController($uri,$metodo);
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
    
    public function get($tipopessoa,$uri)
    {
        if(isset($tipopessoa['02']) or isset($tipopessoa['03'])){
            foreach ($tipopessoa as $x){
                echo $x;
            }
        }else{
            echo "<b> Tipo de pessoa Cadastrado com o id = </b>".$uri[1];
            foreach($tipopessoa as $query)
        {
                echo "<br><hr>";
                echo  'ID = '.$query['idTipo']." | ";
                echo  'Tipo = '.$query['nome']." |<hr>";
        }
        }
    }

    public function post($tipopessoa)
    {
        foreach($tipopessoa as $x){
            echo $x;
        }
    }
    
    
    public function put($tipopessoa)
    {
        foreach($tipopessoa as $x){
            echo $x;
        }
    }
    
    public function delete($tipopessoa)
    {
        foreach($tipopessoa as $x){
            echo $x;
        }
    }
}