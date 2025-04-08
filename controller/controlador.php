<?php 

trait Controlador {
    public function despachar($uri,$metodo)
    {
        parent::__construct(); #chama o construtor do pai conexão
        

        if(count($uri) == 1){
            if($metodo == 'GET')
                return $this->listar();
            elseif($metodo == 'POST')
                return $this->post();
        }elseif(count($uri) ==2){
            if($metodo == 'GET')
                return $this->get($uri[1]);
            elseif($metodo == 'PUT')
                return $this->put($uri[1]);
            elseif($metodo == 'DELETE')
                return $this->delete($uri[1]);
        }
    }

    public function validarID($id): bool{
        $regex = "/^[0-9]{1,}$/";
        if(preg_match($regex,$id) and $id != 0){
            return true;
        }
        return false;
    }
        
}