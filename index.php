<?php
require_once "controller/categoria.php";
require_once "controller/fone.php";
require_once "controller/local_armazenamento.php";
require_once "controller/movimentacao.php";
require_once "controller/pessoa.php";
require_once "controller/produto.php";
require_once "controller/tipopessoa.php";
require_once "controller/transacao.php";

$metodo = $_SERVER['REQUEST_METHOD'];
$uri = explode("$",$_SERVER['REQUEST_URI'])[0];
$uri = preg_replace(['/\/{2,}/','/\/$/','/^\//'],['/','',''],$uri);
$uri = explode('/',$uri);

if($metodo == 'PUT'){
	parse_str(file_get_contents('php://input'), $_PUT);
	
}
array_shift($uri);
var_dump($uri);
echo "<br> $metodo";
echo "<br>";

if ($uri[0] == "categoria"){
	$controlador = new Categoria($uri, $metodo);
	
}elseif($uri[0] == "fone"){
	$controlador = new Fone($uri, $metodo);
	
}elseif($uri[0] == "local_armazenamento"){
	$controlador = new Local_armazenamento($uri, $metodo);
	
}elseif($uri[0] == "movimentacao"){
	$controlador = new Movimentacao($uri, $metodo);
	
}elseif($uri[0] == "pessoa"){
	$controlador = new Pessoa($uri, $metodo);
	
}elseif($uri[0] == "produto"){
	$controlador = new Produto($uri, $metodo);
	
}elseif($uri[0] == "tipopessoa"){
	$controlador = new TipoPessoa($uri, $metodo);
	
}elseif($uri[0] == "transacao"){
	$controlador = new Transacao($uri, $metodo);
}
?>