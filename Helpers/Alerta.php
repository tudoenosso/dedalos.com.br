<?php


namespace Helpers;


abstract class Alerta
{
    public static function alert(string $msg, string $tipo = null)
    {
      switch($tipo){
        case 'sucesso':
          $tipo = 'success';
          break;
        case 'erro':
          $tipo = 'danger';
          break;
        default:
          $tipo = 'warning';
      }

        $_SESSION['alert'] = "<div class='alert alert-{$tipo} text-start' role='alert'>
        {$msg}
      </div>";
    }
}