<?php
require_once "../vendor/autoload.php";

use Microblog\Usuario;

$usuario = new Usuario;
$usuario->setId($_GET['id']);
$usuario->excluir();
header("location:Usuarios.php");