<?php

namespace CoreSts;

// Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
if (!defined('C7E3L8K9E5')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Configurações básicas do site.
 *
 * @author Cesar <cesar@celke.com.br>
 */

abstract class Config
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
    protected function config(): void
    {
        //URL do projeto
        define('URL', 'http://192.168.1.4/');
        define('URLADM', 'http://192.168.1.4/adm/');

        define('CONTROLLER', 'Home');
        define('CONTROLLERERRO', 'Erro');

        //Credenciais do banco de dados
        define('HOST', '172.20.90.154');
        define('USER', 'tudoenosso');
        define('PASS', 'Z3us@424');
        define('DBNAME', 'sigep_bd');
        define('PORT', 3306);

        define('EMAILADM', 'tudoenosso@hotmail.com');
    }
}
