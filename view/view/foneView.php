<?php 

class FoneView{
    private $controlador,$retorno;
    function __construct($uri,$metodo)
    {
        $this->controlador = new FoneControler($uri,$metodo);
        $retorno = $this->controlador->despachar($uri,$metodo);
    }

function 
}