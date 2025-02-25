<?php 

trait Controlador {
    public function despachar($uri,$metodo)
    {
        parent::__construct(); #chama o construtor do pai conexão
        echo "Controlador da classe ".get_class($this);

        if(count($uri) == 1){
            if($metodo == 'GET')
                $this->listar();
            elseif($metodo == 'POST')
                $this->post();
        }elseif(count($uri) ==2){
            if($metodo == 'GET')
                $this->get();
            elseif($metodo == 'PUT')
                $this->put();
            elseif($metodo == 'Delete')
                $this->delete();
        }
    }
}