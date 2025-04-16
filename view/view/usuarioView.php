<?php 

class UsuarioView{
private $controlador,$retorno;
function __construct($uri,$metodo)
{
    $this-> controlador = new UsuarioControler($uri,$metodo);
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
public function listar($usuario)
    {

        echo "<b> Usuarios Cadastrados </b>";
        echo "<br>";
        foreach($usuario as $query)
        {
                echo '<hr>';
                echo  'ID usuario = '.$query['idUsuario']." | ";
                echo  'usuario = '.$query['usuario']." |";
                echo '<hr>';
        } 
    }
    
    public function get($usuario,$uri)
    {  
    
        if(isset($usuario['02'])){
            
            foreach($usuario as $x){
                echo $x;
            }
        }else{
            echo "<b> Usuario com o id = </b>".$uri[1];
            echo "<br>";
            foreach($usuario as $query)
            {
                echo "<hr>";
                echo  'ID usuario = '.$query['idUsuario']." | ";
                echo  'Usuario = '.$query['usuario']." |";
                echo "<hr>";
            }
        }
    }

    public function post($usuario)
    {
        
        if (!isset($usuario['01'])){
            foreach($usuario as $x){
                echo $x;
            }
        }else{
            echo $usuario['01'];
        }
    }
    
    
    public function put($usuario)
    {
        if (!isset($usuario['01'])){
            foreach($usuario as $x){
                echo $x;
            }
        }else{
            echo $usuario['01'];
        }
    }
    
    public function delete($usuario)
    {
        if (!isset($usuario['02'])){
            foreach($usuario as $x){
                echo $x;
            }
        }else{
            echo $usuario['01'];
        }
         
    }
}