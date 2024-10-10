<?php

/* Classe TTransaction
* essa classe provê métodos necessários para manipular transações
*/

final class TTransaction
{
  private static $conn; // conexção ativa

  /* Metodo __construct()
  * Está declarando como private para impedir que se crie instância de TTransaction
  */

  private function __construct() {}

    /* Método open()
    * Abre uma transação e conexão com o BD
    * @param $database = nome do banco de dados. 
    */
    
    public  static function open($database)
    { 
      // abre uma conexão com o banco de dadose armazena na propriedade estática $conn
      if(empty(self::$conn)) {
        self::$conn = TConnection::open($database);

    }
  }


  /* Método get()
  * retorna a conexão ativa da transação 
  */

  public static function get() 
  {
    // retorna a conexão ativa
    return self::$conn;
  }


  /*
  * Méotodo  rollback
  * desfaz as operações realizadas na transação 
  */

  public static function rollback() 
  {
    if(self::$conn) { 
      // desfaz as operações realizadas durante a transação 

      self::$conn->rollback();
      self::$conn = null;
    }
  }

  /* Metodo Close()
  * Aplica todas as operações realizadas e fecha a transação 
  */

  public static function close()
  {
    if(self::$conn) {
      // aplica as operações realizadas durante a transação

      self::$conn->commit();
      self::$conn = null;
    }
  }
}

?>