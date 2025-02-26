<?php
require 'controller/conexao.php';
require 'controller/controlador.php';
require 'controller/categoria.php';
require 'controller/fone.php';
require 'controller/local_armazenamento.php';
require 'controller/movimentacao.php';
require 'controller/pessoa.php';
require 'controller/produto.php';
require 'controller/tipopessoa.php';
require 'controller/transacao.php';
require 'view/view/produto_view.php';
require 'view/view/categoriaView.php';

$metodo = $_SERVER['REQUEST_METHOD'];
$uri = explode("$",$_SERVER['REQUEST_URI'])[0];
$uri = preg_replace(['/\/{2,}/','/\/$/','/^\//'],['/','',''],$uri);
$uri = explode('/',$uri);

if($metodo == 'PUT'){
	parse_str(file_get_contents('php://input'), $_PUT);
	
}
array_shift($uri);


try
{
	if(isset($uri[0]))
		{

		$nome = ucfirst($uri[0]).'View';
		if(class_exists($nome))
			$controle = new $nome($uri,$metodo);
		else
			throw new Exception("a classe $nome não existe!");

		}
		else 
			throw new Exception("Erro no indice!");
}catch(Exception $e)
{
	echo "Erro! ".$e->getMessage();
}


?>