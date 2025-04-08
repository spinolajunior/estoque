<?php 

class FoneView{
    private $controlador,$retorno;
    function __construct($uri,$metodo)
    {
        $this-> controlador = new FoneControler($uri,$metodo);
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
public function listar($fone)
    {

        echo "<b> Telefones Cadastrados </b>";
    
        foreach($fone as $query)
        {
                echo "<br>";
                echo  'ID = '.$query['idFone']." | ";
                echo  'Fone = '.$query['tel']." |";
                echo 'ID-pessoa = '.$query['id_Pessoa'].' |';
        } 
    }
    
    public function get($fone)
    {
        if(isset($fone['02']) or isset($fone['03'])){
            foreach($fone as $x){
                echo $x;
            }
           
        }else{

            echo "<b> Telefones Cadastrados </b>";
            var_dump($fone);
           foreach ($fone as $x){
            echo "ID Fone = {$fone['idFone']}, Tel = {$fone['tel']}, ID pessoa = {$fone['id_Pessoa']}. <hr><br>";
           }
        }
        
    }

    public function post($fone)
    {
        foreach ($fone as $x)
        {
            echo $x;
        }
    }

    public function put($fone)
    {
        foreach ($fone as $x)
        {
            echo $x;
        }
    }
    
    public function delete($fone,$uri)
    {
        foreach ($fone as $x)
        {
            echo $x;
        }
    }
}