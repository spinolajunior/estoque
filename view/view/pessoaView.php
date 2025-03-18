<?php 

class PessoaView{
private $controlador,$retorno,$uri;
function __construct($uri,$metodo)
{
    $this->uri = $uri;
    $this-> controlador = new PessoaControler($uri,$metodo);
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
public function listar($pessoa)
    {

        echo "<b> Pessoas Cadastradas </b>";
    
        foreach($pessoa as $query)
        {
                echo "<br>";
                echo '<hr>';
                echo  'ID = '.$query['id_Pessoa']." | ";
                echo  'Nome = '.$query['nome']." | ";
                echo  'Tipo = '.$query['idTipo_pessoa']." | ";
                echo  'cpf/cnpj= '.$query['cnpj_cpf']." | ";
                echo '<hr>';
        } 
    }
    
    public function get($pessoa)
    {
        if($pessoa){
        echo "<b> Pessoa Cadastrada  com o id = </b>".$this->uri[1];
        foreach($pessoa as $query)
        {
            echo "<br>";
            echo  'ID = '.$query['id_Pessoa']." | ";
            echo  'Nome = '.$query['nome']." |";
            echo  'Tipo = '.$query['idTipo_pessoa']." |";
            echo  'cpf/cnpj= '.$query['cnpj_cpf']." |";
        }
        } else{
            echo "<b> Pessoa com o id = </b>".$this->uri[1]."<b> não existe.</b>";
        }
        

    }

    public function post($pessoa)
    {
        if ($pessoa)
            echo "Pessoa cadastrada com sucesso!";
        else
            echo "Erro";
    }
    
    
    public function put($pessoa)
    {
        if ($pessoa)
            echo "Pessoa alterada com sucesso!";
        else
            echo "Erro na atualização da Pessoa!";
    }
    
    public function delete($pessoa)
    {
        if($pessoa)
            echo "Pessoa id ".$this->uri[1]." Deletada com sucesso!";
        else
            echo "deu erro!";
    }
}