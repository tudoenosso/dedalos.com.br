<?php

namespace CoreGmp;
// Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
if (!defined('C8L6K7E')) {    
    $urlRedirect = URL . "login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada<br>");
}

/**
 * Configurações básicas do site.
 *
 * @author Cesar <cesar@celke.com.br>
 */


abstract class ConfigGmp
{

    /**
     * Possui as constantes com as configurações.
     * Configurações de endereço do projeto.
     * Página principal do projeto.
     * Credenciais de acesso ao banco de dados
     * E-mail do administrador.
     * 
     * @return void
     */
    protected function configGmp(): void
    {
        //URL do projeto
        define('URL', 'http://192.168.1.4/Gmp/');
        define('URLADM', 'http://192.168.1.4/adm/gmp/');

        define('CONTROLLER', 'Login');
        define('METODO', 'index');
        define('CONTROLLERERRO', 'Login');

        //Credenciais do banco de dados
        define('HOST', '192.168.1.4');
        define('USER', 'tudoenosso');
        define('PASS', 'Z3us@424');
        define('DBNAME', 'sigep_bd');
        define('PORT', 3306);

        define('EMAILADM', 'tudoenosso@hotmail.com');
    }
}
