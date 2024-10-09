<?php
 /* Classe TConnection 
 * gerencia conexões com banco de dados através de arquivos de configuração.
 */

 final class TConnection
 {
    /* Método __construct()
    * não exisirão instancias de TConnection, por isto estamos marcando-o como private
    */

    private function __construct(){}

    /* Método Open ()
    * recebe o nome do banco de dados e instancia o objeto PDO correspondente
    */

    public static function open($name){
        //verifica se existe arquivo de configuração para este banco de dados

        if(file_exists("{$name}.ini"))
        {
            // le o INI e retorna um Array
            
            $db = parse_ini_file("{$name}.ini");
        }
        else 
        {
            // se não existir, lança um erro
            throw new Exception("Arquivo.'$name' não encontrado");
        }

        // lê os arquivos e grava as informações contidas neles
        $user = isset($db['user']) ? $db['user'] :'NULL';
        $pass = isset($db['pass']) ? $db['pass'] :'NULL';
        $name = isset($db['name']) ? $db['name'] :'NULL';
        $host = isset($db['host']) ? $db['host'] :'NULL';
        $type = isset($db['type']) ? $db['type'] :'NULL';
        $port = isset($db['port']) ? $db['port']: 'NULL';

    

    // descobre qual o tipo de (driver) banco de dados a ser utilizado

    switch ($type){
        case 'pgsql':
            $port = $port ? $port: '5432';

            $conn = new PDO("pgsql:dbname={$name}; user={$user}: password={$pass}; host = $host; port = {$port}");
            break;

        case 'mysql':
            $port = $port ? $port : '3306';

            $conn = new PDO("mysql:host={$host};port={$port}; dbname={$name}",$user,$pass);
            break;
        
        case 'ibase':
            $conn = new PDO("firebird:dbname={$name}",$user,$pass);
            break;

        case 'oci8':
            $conn = new PDO("oci8:dbname={$name}",$user,$pass);
            break;

        case 'mssql':
            $conn = new PDO("mssql:host={$host},1433;dbname={$name}",$user,$pass);
            break;
        }

        //define para que o PDO lance excessões na ocorrencia de erros

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // retorna o objeto instanciado

        return $conn;
    }
 }

 
 






?>