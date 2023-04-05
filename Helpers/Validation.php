<?php


namespace Helpers;


abstract class Validation
{
  public static function validaCampo(string $msg, string $tipo = null)
  {
    switch ($tipo) {
      case 'sucesso':
        $tipo = 'valid';
        break;      
      default:
        $tipo = 'invalid';
    }
    $_SESSION['valid'] = "<div class='{$tipo}-feedback'>{$msg}</div>";
  }
}
