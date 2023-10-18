<?php
require_once "../inc/cabecalho-admin.php";
use Microblog\Usuario;

/* Verificando se quem está acessando esta pagina pode acessar
(se o if do metodo abaixo for verdadeiro então significa que o usuario não é um admin portanto esta página não será autorizada🔒) */
$sessao->verificaAcessoAdmin();

use Microblog\Utilitarios;

$usuarios = new Usuario;
$listaDeUsuario = $usuarios->listar();

// Utilitarios::dump($listaDeUsuario);
?>


<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">

		<h2 class="text-center">
			Usuários <span class="badge bg-dark"><?=count($listaDeUsuario)?></span>
		</h2>

		<p class="text-center mt-5">
			<a class="btn btn-primary" href="usuario-insere.php">
				<i class="bi bi-plus-circle"></i>
				Inserir novo usuário</a>
		</p>

		<div class="table-responsive">

			<table class="table table-hover">
				<thead class="table-light">
					<tr>
						<th>Nome</th>
						<th>E-mail</th>
						<th>Tipo</th>
						<th class="text-center">Operações</th>
					</tr>
				</thead>

				<?php foreach($listaDeUsuario as $itemUsuario){?>
				<tbody>

					<tr>
						<td><?=$itemUsuario["nome"]?></td>
						<td> <?=$itemUsuario["email"]?> </td>
						<td> <?=$itemUsuario["tipo"]?> </td>
						<td class="text-center">
							<a class="btn btn-warning" href="usuario-atualiza.php?id=<?=$itemUsuario["id"]?>">
								<i class="bi bi-pencil"></i> Atualizar
							</a>

							<a class="btn btn-danger excluir" href="usuario-exclui.php?id=<?=$itemUsuario["id"]?>">
								<i class="bi bi-trash"></i> Excluir
							</a>
						</td>
					</tr>

				</tbody>
				<?php }	?>
			</table>
		</div>

	</article>
</div>


<?php
require_once "../inc/rodape-admin.php";
?>