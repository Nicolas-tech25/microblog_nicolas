<?php 
require_once "../vendor/autoload.php";
require_once "../inc/cabecalho-admin.php";

use Microblog\Usuario;

$usuario = new Usuario;

$usuario->setId($_GET['id']);
$DadosUsuario = $usuario->listarUm();

// $usuario->setId($_GET['id']);

if(isset($_POST['atualizar'])){
    $usuario->setNome($_POST['nome']);
    $usuario->setEmail($_POST['email']);
    $usuario->setTipo($_POST['tipo']);
    header("location:visualizar.php");
}
?>


<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">
		
		<h2 class="text-center">
		Atualizar dados do usuário
		</h2>
				
		<form class="mx-auto w-75" action="" method="post" id="form-atualizar" name="form-atualizar">

			<div class="mb-3">
				<label class="form-label" for="nome">Nome: </label>
				<input class="form-control" value="<?=$DadosUsuario["nome"]?>" type="text" id="nome" name="nome" required>
			</div>

			<div class="mb-3">
				<label class="form-label" for="email">E-mail:</label>
				<input class="form-control" value="<?=$DadosUsuario["email"]?>" type="email" id="email" name="email" required>
			</div>

			<div class="mb-3">
				<label class="form-label" for="senha">Senha:</label>
				<input class="form-control" type="password" id="senha" name="senha" placeholder="Preencha apenas se for alterar">
			</div>

			<div class="mb-3">
				<label class="form-label" for="tipo">Tipo:</label>
				<select class="form-select" value="<?=$DadosUsuario["tipo"]?>" name="tipo" id="tipo" required>
					<option value=""></option>

					<option <?php if($DadosUsuario['tipo'] === 'editor') echo "selected";  ?>
					value="<?=$DadosUsuario["tipo"]?>">Editor</option>
					
					<option <?php if($DadosUsuario['tipo'] === 'editor') echo "selected";  ?>
					 value="<?=$DadosUsuario["tipo"]?>">Administrador</option>
					 
				</select>
			</div>
			
			<button class="btn btn-primary" name="atualizar"><i class="bi bi-arrow-clockwise"></i> Atualizar</button>
		</form>
		
	</article>
</div>


<?php 
require_once "../inc/rodape-admin.php";
?>

