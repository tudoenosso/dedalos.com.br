<?php


session_start(); // Iniciar a sessão
ob_start(); // Buffer de saida

//Constante que define que o usuário está acessando páginas internas através da página "index.php".
define('C8L6K7E', true);

//Carregar o Composer
require '../vendor/autoload.php';

//Instanciar a classe ConfigController, responsável em tratar a URL
$url = new \CoreGmp\ConfigController();

//Instanciar o método para carregar a página/controller
$url->loadPage();