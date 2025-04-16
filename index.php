<?php
session_start(); /* Iniciamos a sessão!*/
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
require 'controller/mov_produto.php';
require 'controller/email.php';
require 'controller/usuario.php';
require 'controller/senha.php';
require 'view/view/emailView.php';
require 'view/view/usuarioView.php';
require 'view/view/senhaView.php';
require 'view/view/categoriaView.php';
require 'view/view/foneView.php';
require 'view/view/local_armazenamentoView.php';
require 'view/view/pessoaView.php';
require 'view/view/produtoView.php';
require 'view/view/tipopessoaView.php';
require 'view/view/transacaoView.php';
require 'view/view/mov_produtoView.php';
require 'view/view/movimentacaoView.php';
?>

<!doctype html>
<html lang="pt">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="style.css">
  </head>
  <?php 
  	$index = new Conexao();	/* Instancia um objeto conexão para acessar a função logar e clean!*/
	if(isset($_POST['usuario']) and isset($_POST['senha'])) /* verifica se existe um formulario de usuario e senha no POST!  */
	{
		$usuario = $_POST['usuario'];
		$senha = $_POST['senha'];
		if($index->logar($usuario,$senha)) /* Se o retorno dessa função for True , significa que existe o usuario informado e que a senha passada pelo formulario é Vinculada ao usuario!*/
			$_SESSION["logado"]=$usuario; /* Apos isso Criamos a associação logado que armazena o nome do usuario!  */
	}

	if (isset($_GET["logout"]))  /* Verificamos se existe logouth na url */
    {
        session_destroy(); /*Se sim destruimos a sessão e iniciamos uma em sequencia */
		session_start();
    }	
		 
	if(!isset($_SESSION["logado"] )){  /* Se a sessão logado não existir geramos o formulario para o usuario realizar login! */
			
		?>
  <body class="container-fluid row justify-content-center align-items-center vh-100 p-0">
	  <form  action="." method="POST" class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-4 border rounded p-3">
		  <div class="mb-3 row">
			<label for="staticEmail" class="col-sm-2 col-form-label">Usuario</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" id="staticEmail" name="usuario" required>
			</div>
		  </div>
		  <div class="mb-3 row">
			<label for="inputPassword" class="col-sm-2 col-form-label">Senha</label>
			<div class="col-sm-10">
			  <input type="password" class="form-control" id="inputPassword" name="senha" required>
			</div>
		  </div>
		  <div class="d-flex justify-content-end">
			<input type="submit" value="Login" style="color : white;background-color: green; border-radius:2px; border:none;"></input>
		  </div>
	  </form>
	  <p class="d-flex justify-content-center">Usuario: juniorspinola , senha: 0000000Tr'1</p>
  </body>
</html> 
		<?php 
		}else{ /* Caso a sessão logado existir disponibilizamos uma div para informar o usuario logado e um um link para deslogar o usuario!*/
		?>
		<div class='d-flex row justify-content-center align-items-center col-3 p-3 border bg-light vh-20  mt-3'>
                <h2 style="text-align: center;">Logado</h2>
				<h3 style="text-align: center;">Usuario: <?php echo $_SESSION['logado'];?></h3>

                <a  href='?logout'>
                    Sair
                </a>
                </div>
				
		<?php 
		}
		?>
	
</html>



<?php 

$cleanUri = $index->sanitize($_SERVER['REQUEST_URI']);


$metodo = $_SERVER['REQUEST_METHOD'];    /*coletamos a uri ! e realizamos tratamento !*/
$uri = explode("$",$cleanUri)[0];
//$uri = explode("$",$_SERVER['REQUEST_URI'])[0];
$uri = preg_replace(['/\/{2,}/','/\/$/','/^\//'],['/','',''],$uri);
$uri = explode('/',$uri);

if($metodo == 'PUT'){  /*Criando a Variavel Global $_PUT*/
	parse_str(file_get_contents('php://input'), $_PUT);
	
}
array_shift($uri); /*Remove a primeiro elemento do array uri ou seja a primeira barra(/) */


try
{	


if(isset($_SESSION['logado']))  /*Somente sera possivel acessar as viewers e seus controladores se o sistema estiver logado!*/
{
	
	if(isset($uri[0]))
		{

		$nome = ucfirst($uri[0]).'View';
		if(class_exists($nome))
			$controle = new $nome($uri,$metodo);
		else
			throw new Exception("a classe $nome não existe!");

		}		
}
}catch(Exception $e)
{
	echo "Erro! ".$e->getMessage();
}




?>