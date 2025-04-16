<?php 

class EmailView{
private $controlador,$retorno;
function __construct($uri,$metodo)
{
    $this-> controlador = new EmailControler($uri,$metodo);
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
public function listar($email)
    {

        echo "<b> E-mail cadastrados </b>";
        echo "<br>";
        foreach($email as $query)
        {
                echo '<hr>';
                echo  'ID E-mail = '.$query['idEmail']." | ";
                echo  'ID usuario = '.$query['idUsuario']." |";
                echo  'Email = '.$query['email']." | ";
                echo '<hr>';
        } 
    }
    
    public function get($email,$uri)
    {  
    
        if(isset($email['02']) or isset($email['03'])){
            foreach($email as $x){
                echo $x;  
            }
           
        }else{
            echo "<b> E-mail com o id = </b>".$uri[1];
            foreach($email as $query)
            {   
                
                echo '<hr>';
                echo  'ID E-mail = '.$query['idEmail']." | ";
                echo  'E-mail = '.$query['email']." |";
                echo  'ID usuario = '.$query['idUsuario']." |";
                echo '<hr>';
            }
        }
    }

    public function post($email)
    {
        
        if (!isset($email['01'])){
            foreach($email as $x){
                echo $x;
            };
        }else{
            echo $email['01'];
        }
    }
    
    
    public function put($email)
    {
        if (isset($email['02'])){
            echo $email['02'];
        }else{
            echo $email['01'];
        }
    }
    
    public function delete($email)
    {
        if (isset($email['02']) or isset($email['03']) or isset($email['04'] )){
            foreach($email as $x)
            {
                echo $x;
            }
        }else{
            echo $email['01'];
        }
         
    }
}