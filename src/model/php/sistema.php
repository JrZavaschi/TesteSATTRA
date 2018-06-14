<?php
include_once "conexao.php";
ob_start();

date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y');
$hora = date('H:i:s');
$date = date('Y-m-d');
$time = date('H:i:s');
$datetime = date('Y-m-d H:i:s');
$datahora = date('d/m/Y H:i:s');

class Sistema {
   
   static function getConexao($transacao = true) {
      $conexao = Conexao::getInstancia();
      
      if ($transacao) {
         $conexao->beginTransaction();
      }
      
      return $conexao;
   }
   
   static function getFiltroSuperGlobal($superGlobal, $variavel, $tipoVariavel) {
      return filter_input($superGlobal, $variavel, $tipoVariavel);
   }

   static function getPost($variavel, $tipoVariavel = FILTER_SANITIZE_STRING) {
      return self::getFiltroSuperGlobal(INPUT_POST, $variavel, $tipoVariavel);
   }
   
   static function getGet($variavel, $tipoVariavel = FILTER_SANITIZE_STRING) {
      return self::getFiltroSuperGlobal(INPUT_GET, $variavel, $tipoVariavel);
   }

   static function getServer($variavel, $tipoVariavel = FILTER_SANITIZE_STRING) {
      return self::getFiltroSuperGlobal(INPUT_SERVER, $variavel, $tipoVariavel);
   }
}

?>