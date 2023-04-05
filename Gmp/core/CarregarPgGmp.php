<?php
namespace CoreGmp;

use Helpers\Alerta;

// Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
if (!defined('C8L6K7E')) {    
    $urlRedirect = URL . "login/index";
    header("Location: $urlRedirect");
    die("Erro: Página não encontrada<br>");
}

/**
 * Verificar se existe a classe
 * Carregar a CONTROLLER
 * @author Cesar <cesar@celke.com.br>
 */
class CarregarPgGmp
{
    /** @var string $urlController Recebe da URL o nome da controller */
    private string $urlController;
    /** @var string $urlMetodo Recebe da URL o nome do método */
    private string $urlMetodo;
    /** @var string $urlParamentro Recebe da URL o parâmetro */
    private string $urlParameter;
    /** @var string $classLoad Controller que deve ser carregada */
    private string $classLoad;
    /** @var string $urlSlugController Recebe o controller tratada */
    //private string $urlSlugController;
    /** @var string $urlSlugMetodo Recebe o metodo tratado */
    //private string $urlSlugMetodo;

    private array $listPgPublic;
    private array $listPgPrivate;


    /**
     * Verificar se existe a classe
     * @param string $urlController Recebe da URL o nome da controller
     * @param string $urlMetodo Recebe da URL o método
     * @param string $urlParamentro Recebe da URL o parâmetro
     */

    public function loadPage(string|null $urlController, string|null $urlMetodo, string|null $urlParameter): void
    {
        $this->urlController = $urlController;
        $this->urlMetodo = $urlMetodo;
        $this->urlParameter = $urlParameter;

        //unset($_SESSION['user_id']);
        
        $this->pgPublic();

        if (class_exists($this->classLoad)) {
            $this->loadMetodo();
        } else {
            $this->loadClassSts();
            //die("Erro - 003: Por favor tente novamente. Caso o problema persista, entre em contato o administrador " . EMAILADM);
            
        }
    }
    
    /**
     * Verificar se existe a classe ou a pagina no pacote sts
     *
     * @return void
     */
    private function loadClassSts(): void
    {
        $this->classLoad = "\\Sts\\Controllers\\" . $this->urlController;
        if (class_exists($this->classLoad)) {
            $this->loadMetodo();
        } else {
            die("Erro - 007: Por favor tente novamente. Caso o problema persista, entre em contato o administrador " . EMAILADM);
        }
    }

    /**
     * Verificar se existe o método e carregar a página
     *
     * @return void
     */
    private function loadMetodo(): void
    {
        $classLoad = new $this->classLoad();
        if (method_exists($classLoad, $this->urlMetodo)) {
            $classLoad->{$this->urlMetodo}($this->urlParameter);
        } else {
            die("Erro - 004: Por favor tente novamente. Caso o problema persista, entre em contato o administrador " . EMAILADM);
        }
    }

    /**
     * Verificar se a página é pública e carregar a mesma
     *
     * @return void
     */
    private function pgPublic(): void
    {
        $this->listPgPublic = ["Login", "Erro", "Logout", "ConfEmail", "NewConfEmail", "RecoverPassword", "UpdatePassword"];

        if (in_array($this->urlController, $this->listPgPublic)) {
            $this->classLoad = "\\Gmp\\Controllers\\" . $this->urlController;
        } else {
            $this->pgPrivate();
        }
    }
/**
     * Verificar se a página é privada e chamar o método para verificar se o usuário está logado
     *
     * @return void
     */
    private function pgPrivate():void
    {
        $this->listPgPrivate = ["Dashboard", "NovoProduto", "VisualizarProduto", "ListarProdutos", "NovoUsuario", "VisualizarUsuario"];
        if(in_array($this->urlController, $this->listPgPrivate)){
            $this->verifyLogin();
        }else{
            //die("Erro - 006: Por favor tente novamente. Caso o problema persista, entre em contato o administrador " . EMAILADM);
            //$_SESSION['msg'] = "<p class='alert-danger'>Erro: Página não encontrada!</p>";
            Alerta::alert("Erro 14: Página não encontrada!", "erro"); 
            $urlRedirect = URL . "login/index";
            header("Location: $urlRedirect");
        }


        /*
        $this->listPgPrivate = ["Dashboard", "ListUsers", "ViewUsers", "AddUsers", "EditUsers", "EditUsersPassword", "EditUsersImage", "DeleteUsers", "ViewProfile", "EditProfile", "EditProfilePassword", "EditProfileImage", "ListSitsUsers", "ViewSitsUsers", "AddSitsUsers", "EditSitsUsers", "DeleteSitsUsers", "ListColors", "ViewColors", "AddColors", "EditColors", "DeleteColors", "ListConfEmails", "ViewConfEmails", "AddConfEmails", "EditConfEmails", "EditConfEmailsPassword", "DeleteConfEmails", "ViewPageHome", "EditHomeTop", "EditHomeServ", "EditHomePrem", "EditHomeTopImg", "EditHomePremImg", "ListAboutsComp", "ViewAboutsComp", "AddAboutsComp", "EditAboutsComp", "EditAboutsCompImage", "DeleteAboutsComp", "ViewPageContact", "EditPageContact", "ListContactsMsgs", "ViewContactsMsgs", "AddContactsMsgs", "EditContactsMsgs", "DeleteContactsMsgs", "ListSituations", "ViewSituations", "AddSituations", "EditSituations", "DeleteSituations", "ViewFooter", "EditFooter"];
        if(in_array($this->urlController, $this->listPgPrivate)){
            $this->verifyLogin();
        }else{
            //die("Erro - 006: Por favor tente novamente. Caso o problema persista, entre em contato o administrador " . EMAILADM);
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Página não encontrada!</p>";
            $urlRedirect = URL . "login/index";
            header("Location: $urlRedirect");
        }
        */
    }

    /**
     * Verificar se o usuário está logado e carregar a página
     *
     * @return void
     */
    private function verifyLogin(): void
    {
        if((isset($_SESSION['user_id'])) and (isset($_SESSION['user_nome']))  and (isset($_SESSION['user_email'])) ){
            $this->classLoad = "\\Gmp\\Controllers\\" . $this->urlController;
        }else{
            Alerta::alert("Erro 15: Para acessar a página realize o login", "erro");
            //$_SESSION['msg'] = "<p class='alert-danger'>Erro: Para acessar a página realize o login!</p>";
            $urlRedirect = URL . "login/index";
            header("Location: $urlRedirect");
        }
    }

    /**
     * Converter o valor obtido da URL "view-users" e converter no formato da classe "ViewUsers".
     * Utilizado as funções para converter tudo para minúsculo, converter o traço pelo espaço, converter cada letra da primeira palavra para maiúsculo, retirar os espaços em branco
     *
     * @param string $slugController Nome da classe
     * @return string Retorna a controller "view-users" convertido para o nome da Classe "ViewUsers"
     */
    /*
    private function slugController(string $slugController): string
    {
        $this->urlSlugController = $slugController;
        // Converter para minusculo
        $this->urlSlugController = strtolower($this->urlSlugController);
        // Converter o traco para espaco em braco
        $this->urlSlugController = str_replace("-", " ", $this->urlSlugController);
        // Converter a primeira letra de cada palavra para maiusculo
        $this->urlSlugController = ucwords($this->urlSlugController);
        // Retirar espaco em branco        
        $this->urlSlugController = str_replace(" ", "", $this->urlSlugController);
        //var_dump($this->urlSlugController);
        return $this->urlSlugController;
    }
    */

    /**
     * Tratar o método
     * Instanciar o método que trata a controller
     * Converter a primeira letra para minusculo
     *
     * @param string $urlSlugMetodo
     * @return string
     */
    /*
    private function slugMetodo(string $urlSlugMetodo): string
    {
        $this->urlSlugMetodo = $this->slugController($urlSlugMetodo);
        //Converter para minusculo a primeira letra
        $this->urlSlugMetodo = lcfirst($this->urlSlugMetodo);
        //var_dump($this->urlSlugMetodo);
        return $this->urlSlugMetodo;
    }
    */
}
