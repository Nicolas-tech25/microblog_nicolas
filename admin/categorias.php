<?php 
require_once "../inc/cabecalho-admin.php";

use Microblog\Categoria;

$sessao->verificaAcessoAdmin();
$categoria = new Categoria;
$listaDecategorias = $categoria->listar();
?>


<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">
		
		<h2 class="text-center">
		Categorias <span class="badge bg-dark"><?=count($listaDecategorias)?></span>
		</h2>

		<p class="text-center mt-5">
			<a class="btn btn-primary" href="categoria-insere.php">
			<i class="bi bi-plus-circle"></i>	
			Inserir nova categoria</a>
		</p>
				
		<div class="table-responsive">
		
			<table class="table table-hover">
				<thead class="table-light">
					<tr>
						<th>Nome</th>
						<th class="text-center">Operações</th>
					</tr>
				</thead>

				<?php foreach($listaDecategorias as $itemcategoria){?>
				<tbody>

					<tr>
						<td> <?=$itemcategoria["nome"]?> </td>
						
						<td class="text-center">
							<a class="btn btn-warning" 
							href="categoria-atualiza.php?id=<?=$itemcategoria["id"]?>">
							<i class="bi bi-pencil"></i> Atualizar
							</a>
						
							<a class="btn btn-danger excluir" 
							href="categoria-exclui.php?id=<?=$itemcategoria["id"]?>">
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

