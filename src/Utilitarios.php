<?php
namespace Microblog;
abstract class Utilitarios{
    /* Sobre o parametro $dados com tipo array/bool quando im parametro pode receber tres tipos de dados diferentes de acordo com a chamada do metodo usando o operador | ou entre as opções de tipos */
    public static function dump(array | bool $dados) : void {
        echo "<pre>";
        var_dump($dados);
        echo "</pre>";
    }
    public function codificaSenha(string $senha):string {
        return password_hash($senha, PASSWORD_DEFAULT);

    }
    
}