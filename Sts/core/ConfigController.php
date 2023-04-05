<?php

namespace CoreSts;

// Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
if (!defined('C7E3L8K9E5')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Recebe a URL e manipula
 * Carregar a CONTROLLER
 * 
 * @author Cesar <cesar@celke.com.br>
 */
class ConfigController extends Config
{
    /** @var string $url Recebe a URL do .htaccess */
    private string $url;
    /** @var array $urlArray Recebe a URL convertida para array */
    private array $urlArray;
    /** @var string $urlController Recebe da URL o nome da controller */
    private string $urlController;
    /** @var string $urlParamentro Recebe da URL o parâmetro */
    /*private string $urlParameter;*/
    private string $urlSlugController;
    /** @var array $format Recebe o array de caracteres especiais que devem ser substituido */
    private array $format;
    /** @var string $classe Recebe a classe */
    private string $classLoad;

    /**
     * Recebe a URL do .htaccess
     * Validar a URL
     */
    public function __construct()
    {
        $this->config();
        if (!empty(filter_input(INPUT_GET, 'url', FILTER_DEFAULT))) {
            $this->url = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);

            $this->clearUrl();

            $this->urlArray = explode("/", $this->url);

            if (isset($this->urlArray[0])) {
                $this->urlController = $this->slugController($this->urlArray[0]);
            } else {
                $this->urlController = $this->slugController(CONTROLLERERRO);
            }
        } else {
            $this->urlController = $this->slugController(CONTROLLER);
        }

        echo "Controller: {$this->urlController} <br>";
        //echo "Metodo: {$this->urlMetodo} <br>";
        //echo "Paramentro: {$this->urlParameter} <br>";
    }



    /**
     * Método privado não pode ser instanciado fora da classe
     * Limpara a URL, elimando as TAG, os espaços em brancos, retirar a barra no final da URL e retirar os caracteres especiais
     *
     * @return void
     */
    private function clearUrl(): void
    {
        //Eliminar as tag
        $this->url = strip_tags($this->url);
        //Eliminar espaços em branco
        $this->url = trim($this->url);
        //Eliminar a barra no final da URL
        $this->url = rtrim($this->url, "/");
        $this->format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]?;:.,\\\'<>°ºª ';
        $this->format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr-------------------------------------------------------------------------------------------------';
        //Trata as conversoes de UTF8
        //$this->url = strtr(utf8_decode($this->url), utf8_decode($this->format['a']), $this->format['b']);
        $this->url = strtr($this->utf8decodePHP($this->url), $this->utf8decodePHP($this->format['a']), $this->format['b']);


    }
    /**Substituta da função utf8_decode() */
    private function utf8decodePHP(string $string): string
    {
        $s = (string) $string;
        $len = \strlen($s);

        for ($i = 0, $j = 0; $i < $len; ++$i, ++$j) {
            switch ($s[$i] & "\xF0") {
                case "\xC0":
                case "\xD0":
                    $c = (\ord($s[$i] & "\x1F") << 6) | \ord($s[++$i] & "\x3F");
                    $s[$j] = $c < 256 ? \chr($c) : '?';
                    break;

                case "\xF0":
                    ++$i;
                    // no break

                case "\xE0":
                    $s[$j] = '?';
                    $i += 2;
                    break;

                default:
                    $s[$j] = $s[$i];
            }
        }

        return substr($s, 0, $j);
    }


    /**
     * Converter o valor obtido da URL "sobre-empresa" e converter no formato da classe "SobreEmpresa".
     * Utilizado as funções para converter tudo para minúsculo, converter o traço pelo espaço, converter cada letra da primeira palavra para maiúsculo, retirar os espaços em branco
     *
     * @param string $slugController Nome da classe
     * @return string Retorna a controller "sobre-empresa" convertido para o nome da Classe "SobreEmpresa"
     */
    private function slugController($slugController): string
    {
        //Converter para minusculo
        $this->urlSlugController = strtolower($slugController);
        //Converter o traco para espaco em braco
        $this->urlSlugController = str_replace("-", " ", $this->urlSlugController);
        //Converter a primeira letra de cada palavra para maiusculo
        $this->urlSlugController = ucwords($this->urlSlugController);
        //Retirar espaco em branco
        $this->urlSlugController = str_replace(" ", "", $this->urlSlugController);
        return $this->urlSlugController;
    }

    /**
     * Carregar as Controllers.
     * Instanciar as classes da controller e carregar o método index.
     *
     * @return void
     */
    public function loadPage(): void
    {
        $this->classLoad = "\\Sts\\Controllers\\" . $this->urlController;
        if (class_exists($this->classLoad)) {
            $this->loadClass();
        } else {
            $this->loadPageGmp();
            //$this->urlController = $this->slugController(CONTROLLERERRO);
            //$this->loadPage();
        }
    }
    /**
     * Carregar as Controllers.
     * Instanciar as classes da controller e carregar o método index.
     *
     * @return void
     */
    public function loadPageGmp(): void
    {
        $this->classLoad = "\\Gmp\\Controllers\\" . $this->urlController;
        echo $this->classLoad. "<br>";
        
        if (class_exists($this->classLoad)) {
            $this->loadClass();
        } else {
            $this->urlController = $this->slugController(CONTROLLERERRO);
            $this->loadPage();
        }
        
    }

    /**  
     * Verificar se o método existe, existindo o método carrega a página;
     * Não existindo o método, para o carregamento e apresenta mensagem de erro.
     * 
     * @return void
     */
    private function loadClass(): void
    {
        $classPage = new $this->classLoad();
        if (method_exists($classPage, "index")) {
            $classPage->index();
        } else {
            die("Erro: Por favor tente novamente. Caso o problema persista, entre em contato o administrador " . EMAILADM);
        }
    }
}
