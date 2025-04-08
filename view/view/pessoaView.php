<?php 

class PessoaView{
private $controlador,$retorno;
function __construct($uri,$metodo)
{
    $this-> controlador = new PessoaControler($uri,$metodo);
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
public function listar($pessoa)
    {

        echo "<b> Pessoas Cadastradas </b>";
        echo "<br><hr>";
        foreach($pessoa as $query)
        {
                echo  'ID = '.$query['id_Pessoa']." | ";
                echo  'Nome = '.$query['nome']." | ";
                echo  'Tipo = '.$query['idTipo_pessoa']." | ";
                echo  'cpf/cnpj= '.$query['cnpj_cpf']." | ";
                echo '<hr>';
        } 
    }
    
    public function get($pessoa,$uri)
    {
        if(isset($pessoa['02']) or isset($pessoa['03']) or isset($pessoa['04']) or isset($pessoa['05'])){
            foreach($pessoa as $x){
                echo $x;
            }
        }else{
            echo "<b> Pessoa ID = </b>".$uri[1]."<hr>";

            foreach($pessoa as $query)
            {
                
                echo  'ID = '.$query['id_Pessoa']." | ";
                echo  'Nome = '.$query['nome']." |";
                echo  'Tipo = '.$query['idTipo_pessoa']." |";
                echo  'cpf/cnpj= '.$query['cnpj_cpf']." |<hr>";
            }
        }        
    }

    public function post($pessoa)
    {
        foreach($pessoa as $x){
            echo $x;
        }
    }
    
    
    public function put($pessoa)
    {
        foreach($pessoa as $x){
            echo $x;
        }
    }
    
    public function delete($pessoa,$uri)
    {
        foreach($pessoa as $x){
            echo $x;
        }
    }
}