<?php

include_once "../../controller/php/bancoDados.php";

class Conexao extends BancoDados {

   public static $instancia;

   private function __construct() {
      parent::__construct();
   }

   public static function getInstancia() {
      if (!isset(self::$instancia)) {
         try {
            self::$instancia = new PDO(BancoDados::getDns(), BancoDados::getUsuario(), BancoDados::getSenha());
            self::$instancia->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         }
         catch (Exception $ex) {
			 session_destroy();
			 session_start();

			 json_encode('[retorno: Não foi possível conectar ao banco de dados, verifique as configurações conforme readme.txt]');
         }
      }

      return self::$instancia;
   }
}