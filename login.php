<?php
require_once "inc/cabecalho.php";

use Microblog\Usuario;
use Microblog\ControleDeAcesso;
use Microblog\Utilitarios;

/* Programação das mensagens de feedback (campos obrigatorios dados incorretos ou que saiu do sistema) */

if (isset($_GET["campos_obrigatorios"])) {
	$feedback = "Preencha email e senha";
} elseif (isset($_GET['dados_incorretos'])) {
	$feedback = "Email e senha incorretos";
} elseif(isset($_GET['logout'])){
	$feedback = "você saiu do sistema!";
}elseif (isset($_GET['acesso_proibido'])) {
	$feedback = "você deve logar primeiro";
}
?>


<div class="row">
	<div class="bg-white rounded shadow col-12 my-1 py-4">
		<h2 class="text-center fw-light">Acesso à área administrativa</h2>

		<form action="" method="post" id="form-login" name="form-login" class="mx-auto w-50">

			<?php if (isset($feedback)) { ?>
				<p class="my-2 alert alert-danger text-center"><?= $feedback ?></p>
			<?php } ?>

			<div class="mb-3">
				<label for="email" class="form-label">E-mail:</label>
				<input class="form-control" type="email" id="email" name="email">
			</div>
			<div class="mb-3">
				<label for="senha" class="form-label">Senha:</label>
				<input class="form-control" type="password" id="senha" name="senha">
			</div>

			<button class="btn btn-primary btn-lg" name="entrar" type="submit">Entrar</button>

		</form>

		<?php
		if (isset($_POST['entrar'])) {
			// verificar se os campos foram preenchidos
			if (empty($_POST['email']) || empty($_POST['senha'])) {
				header("location:login.php?campos_obrigatorios");
			} else {
				//capturar o email
				$usuario = new Usuario;
				$usuario->setEmail($_POST['email']);
				// Buscar o usuário/email no banco de dados
				$dados = $usuario->buscar();
				// Utilitarios::dump($dados);

				// se não existir o usuario continuará em login.php
				if (!$dados) { // OU if($dados === false)
					header("location:login.php?dados_incorretos");
				} else {
					// se existir:
					// - verificar a senha
					if (password_verify($_POST['senha'], $dados['senha'])) {
						// - está correta? iniciar processo de login:
						$sessao = new ControleDeAcesso;
						$sessao->login($dados['id'],$dados['nome'],$dados['tipo']);
						header("location:admin/index.php");
					} else {
						// - não está? continuará em login
						header("location:longin.php?dados_incorretos");
					}
				}
				//se não existir o usuário continuará em login							
			}
		}
		?>
	</div>


</div>






<?php
require_once "inc/rodape.php";
?>