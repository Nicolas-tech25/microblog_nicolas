<?php
require_once "../vendor/autoload.php";

use Microblog\Usuario;
use Microblog\ControleDeAcesso;

$sessao  = new ControleDeAcesso;
$sessao->verificaAcesso();

$usuario = new Usuario;
$usuario->setId($_GET['id']);
$usuario->excluir();
header("location:Usuarios.php");