<?php 

class SenhaView{
private $controlador,$retorno;
function __construct($uri,$metodo)
{
    $this-> controlador = new SenhaControler($uri,$metodo);
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
public function listar($senha)
    {

        echo "<b> Senhas cadastradas </b>";
        echo "<br>";
        foreach($senha as $query)
        {
                echo '<hr>';
                echo  'ID senha = '.$query['idSenha']." | ";
                echo  'Senha = '.$query['senha']." |";
                echo  'ID usuario = '.$query['idUsuario']." |";
                echo '<hr>';

        } 
    }
    
    public function get($senha,$uri)
    {  
    
        if(isset($senha['02'])){
            echo $senha['02'];
        }else{
            echo "<b> Categoria com o id = </b>".$uri[1];
            foreach($senha as $query)
            {
                echo "<br>";
                echo  'ID = '.$query['idCategoria']." | ";
                echo  'Categoria = '.$query['nome']." |";
            }
        }
    }

    public function post($senha)
    {
        
        if (isset($senha['02'])){
            echo $senha['02'];
        }else{
            echo $senha['01'];
        }
    }
    
    
    public function put($senha)
    {
        if (isset($senha['02'])){
            echo $senha['02'];
        }else{
            echo $senha['01'];
        }
    }
    
    public function delete($senha)
    {
        if (isset($senha['02']) or isset($senha['03']) or isset($senha['04'] )){
            foreach($senha as $x)
            {
                echo $x;
            }
        }else{
            echo $senha['01'];
        }
         
    }
}