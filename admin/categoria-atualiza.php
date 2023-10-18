<?php 
require_once "../inc/cabecalho-admin.php";

use Microblog\Categoria;
$sessao->verificaAcessoAdmin();

$categoria = new Categoria;
$categoria->setId($_GET['id']);
$dadosCategoria = $categoria->listarUm();

if(isset($_POST['atualizar'])){
    $categoria->setNome($_POST['nome']);
	$categoria->atualizar();

    header("location:categorias.php");
}

/* Botão cancelar(besteira minha 🤓) */
if(isset($_POST['cancelar'])){
    header("location:categorias.php");
}
?>


<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">
		
		<h2 class="text-center">
		Atualizar dados da categoria
		</h2>
				
		<form class="mx-auto w-75" action="" method="post" id="form-atualizar" name="form-atualizar">

			<div class="mb-3">
				<label class="form-label" for="nome">Nome:</label>
				<input class="form-control" value="<?=$dadosCategoria["nome"]?>" type="text" id="nome" name="nome" required>
			</div>
			
			<button class="btn btn-primary" name="atualizar"><i class="bi bi-arrow-clockwise"></i> Atualizar</button>

			<button class="btn btn-danger" name="cancelar"><i class="bi bi-arrow-clockwise"></i> Cancelar</button>
		</form>
		
	</article>
</div>


<?php 
require_once "../inc/rodape-admin.php";
?>

