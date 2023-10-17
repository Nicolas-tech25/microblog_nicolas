<?php
namespace Microblog;

final class ControleDeAcesso{
    public function __construct(){
       /* Se não EXISTIR uma sessão "em andamento" */
        if (!isset($_SESSION)) {
            // então inicialize uma sessão
            session_start();
        }
    }

    public function  verificaAcesso():void{
        /* Se não houver uma variavel de sessão chamada id ou seja ainda não houve um login por parte do uduário */
        if (!isset($_SESSION['id'])) {
            /* ...então destrua qualquer resquício da sessão, redirecione para o login(formulário) e pare completamente o script */
           session_destroy();
           header("location:../login.php");
           die(); // ou exit;
        }
    }
}
