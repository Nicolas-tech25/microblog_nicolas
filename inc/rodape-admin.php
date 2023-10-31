    </div>
</main>

<footer class="footer mt-auto py-3 bg-dark border-top">
    <div class="container text-center text-white">
        Microblog é um site fictício desenvolvido para fins didáticos | Senac Penha &copy; 2023
    </div>
</footer>


<script src="../js/confirma-exclusao.js"></script> 

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

<?php 
switch($pagina){
    case 'usuarios.php':
    case 'noticias.php':
    case 'categorias.php':
?>
<script src="js/confirm.js"></script>
<?php
    break;

    case 'noticia-insere.php':
    case 'noticia-atualiza.php':
?>
<script src="js/contador.js"></script>
<?php
    break;
}
?>

</body>
</html>

<?php ob_end_flush(); ?>