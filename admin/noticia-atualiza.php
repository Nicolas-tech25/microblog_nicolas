<?php
require_once "../inc/cabecalho-admin.php";
use Microblog\Noticia;
use Microblog\Utilitarios;

$noticia = new Noticia;



// Carregando os dados de quem está logado
$noticia->usuario->setId($_SESSION['id']);
$noticia->usuario->setTipo($_SESSION['tipo']);
$noticia->setId($_GET['id']);
$noticiaDeCategorias = $noticia->categoria->listar();
$dados = $noticia->listarUm();

if (isset($_POST["atualizar"])) {
    $noticia->setTitulo($_POST["titulo"]);
    $noticia->setTexto($_POST["texto"]);
    $noticia->setResumo($_POST["resumo"]);
    $noticia->setDestaque($_POST["destaque"]);
    $noticia->categoria->setId($_POST["categoria"]);

    /* Lógica/algoritimo para atualizar a foto se necessário */

    /* Seo campo imagem tiver vazio, então o usuario vai manter a versão antiga. Portanto vamos deixar a imagem já existente  */
    if (empty($_FILES["imagem"] ["name"])) {
        $noticia->setImagem(($_POST["imagem-existente"]));
    } else {
         /* Caso contrario cvamos pegar a referencia da nova imagem (nome e extensão) , fazer o upload do novo arquivo e enviar a referencia para o objeto usando settter*/

         $noticia->upload($_FILES["imagem"]);
         $noticia->setImagem($_FILES["imagem"]["name"]);
    }
    
    $noticia->atualizar();
    header("location:noticias.php");
   


}

?>


<div class="row">
    <article class="col-12 bg-white rounded shadow my-1 py-4">

        <h2 class="text-center">
            Atualizar dados da notícia
        </h2>

        <form class="mx-auto w-75" action="" method="post" id="form-atualizar" name="form-atualizar" enctype="multipart/form-data">

            <div class="mb-3">
                <label class="form-label" for="categoria">Categoria:</label>
                <select class="form-select" name="categoria" id="categoria" required>
                <option 
                 value=""></option>	
				<?php foreach($noticiaDeCategorias as $categoria){?>
						<option 
                        <?php if($dados["categoria_id"] === $categoria["id"]) echo "selected" ?> 
                        value="<?=$categoria["id"]?>"><?=$categoria["nome"]?></option>
					<?php }	?> 
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label" for="titulo">Título:</label>
                <input value="<?=$dados['titulo']?>" class="form-control" required type="text" id="titulo" name="titulo">
            </div>

            <div class="mb-3">
                <label class="form-label" for="texto">Texto:</label>
                <textarea class="form-control" required name="texto" id="texto" cols="50" rows="6"><?=$dados['texto']?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label" for="resumo">Resumo (máximo de 300 caracteres):</label>
                <span id="maximo" class="badge bg-danger">0</span>
                <textarea  class="form-control" required name="resumo" id="resumo" cols="50" rows="2" maxlength="300"><?=$dados['resumo']?></textarea>
            </div>

            <div class="mb-3">
                <label for="imagem-existente" class="form-label">Imagem da notícia:</label>
                <!-- campo somente leitura, meramente informativo -->
                <input value="<?=$dados['imagem']?>" class="form-control" type="text" id="imagem-existente" name="imagem-existente" readonly>
            </div>

            <div class="mb-3">
                <label for="imagem" class="form-label">Caso queira mudar, selecione outra imagem:</label>
                <input class="form-control" type="file" id="imagem" name="imagem" accept="image/png, image/jpeg, image/gif, image/svg+xml">
            </div>

            <div class="mb-3">
                <p>Deixar a notícia em destaque?
                    <input
                    <?php if($dados["destaque"] === "nao") echo "checked" ?>
                    type="radio" class="btn-check" name="destaque" id="nao" autocomplete="off" checked value="nao">
                    <label class="btn btn-outline-danger" for="nao">Não</label>

                    <input
                    <?php if($dados["destaque"] === "sim") echo "checked" ?>
                    type="radio" class="btn-check" name="destaque" id="sim" autocomplete="off" value="sim">
                    <label class="btn btn-outline-success" for="sim">Sim</label>
                </p>
            </div>

            <button class="btn btn-primary" name="atualizar"><i class="bi bi-arrow-clockwise"></i> Atualizar</button>
        </form>

    </article>
</div>


<?php
require_once "../inc/rodape-admin.php";
?>