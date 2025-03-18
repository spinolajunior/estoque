<?php 

class FoneView{
    private $controlador,$retorno,$uri;
    function __construct($uri,$metodo)
    {

        $this->uri = $uri;
        $this-> controlador = new FoneControler($uri,$metodo);
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
        if($fone){
        echo "<b> Telefones Cadastrados  com o id = </b>".$this->uri[1];
        foreach($fone as $query)
        {
            echo "<br>";
            echo  'ID = '.$query['idFone']." | ";
            echo  'Fone = '.$query['tel']." |";
            echo 'ID-pessoa = '.$query['id_Pessoa'].' |';
        }
        } else{
            echo "<b> Telefone com o id = </b>".$this->uri[1]."<b> não existe.</b>";
        }
        

    }

    public function post($fone)
    {
        if ($fone)
            echo "Telefone cadastrado com sucesso!";
        else
            echo "Erro";
    }
    
    
    public function put($fone)
    {
        if ($fone)
            echo "Telefone id = ".$this->uri[1]." alterado com sucesso!";
        else
            echo "Erro na atualização do Telefone";
    }
    
    public function delete($fone)
    {
        if($fone)
            echo "Fone id = ".$this->uri[1]." Deletada com sucesso!";
        else
            echo "deu erro!";
    }
}