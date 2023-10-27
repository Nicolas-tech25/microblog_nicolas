<?php

use Microblog\Utilitarios;

require_once "inc/cabecalho.php";
$noticia->setTermo($_GET["busca"]);
$resultados = $noticia->busca();
?>


<div class="row bg-white rounded shadow my-1 py-4">
    <h2 class="col-12 fw-light">
        Você procurou por <span class="badge bg-dark"><?=$noticia->getTermo()?></span> e
        obteve <span class="badge bg-info"><?=count($resultados)?></span> resultados
    </h2>
    
    <div class="col-12 my-1">
       
    
    
    <?php foreach($resultados as $itemNoticia){ ?>
        <article class="card">
            <div class="card-body">
            
                <h3 class="fs-4 card-title fw-light"><?=$itemNoticia["titulo"]?></h3>
                <p class="card-text">
                    <time><?=Utilitarios::formataData($itemNoticia['data'])?></time> - 
                    <?=$itemNoticia["resumo"]?>
                </p>
                
                <a href="noticia.php?id=<?=$itemNoticia["id"]?>" class="btn btn-primary btn-sm">Continuar lendo</a>
            </div>
        </article>
    <?php } ?>
    
    

</div>        

<?php 
require_once "inc/todas.php";
require_once "inc/rodape.php";
?>

