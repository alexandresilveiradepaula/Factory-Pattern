<?php

spl_autoload_register(function ($classe) {
    $filename = "{$classe}.class.php";
    if (file_exists($filename)) {
        include_once $filename;
    } else {
        throw new Exception("Classe {$classe} não encontrada.");
    }
});

    // cria a instrução de SELECT

    $sql = new TSqlSelect;
     
    //define o nome da entidade
    $sql->setEntity('famosos');

    // acrescenta colunas a consulta
    $sql->addColumn('codigo');
    $sql->addColumn('nome');

    // crio o critario de seleção 
    $criteria = new TCriteria;

    //obtem a pessoa código "1"
    $criteria->add(new TFilter('codigo','=',1));

    // atribui o criterio de seleção 
    $sql->setCriteria($criteria);

    try {
        // abre conexão com banco de dados my_livro(mysql)
        $conn = TConnection::open('my_livro');

        

        // executa a instrução sql
        $result = $conn->query($sql->getInstruction());
        if ($result){
            $row = $result->fetch(PDO::FETCH_ASSOC);
            // exibe os resultados 

            echo $row['codigo'] .'-'. $row['nome'] ."<br>\n";
                    }

            // fecha a conexão 

                $conn = null;
    }
    catch (PDOException $e) {
        // exibe a mensagem de erro 

        print "ERRO!:".$e->getMessage()."<br>\n";
        die();
    }
    try
    {
        // abre conexão com a base pg_livro 
        $conn = TConnection::open('pg_livro');

        // executa a instrução SQL 
        $result = $conn->query($sql->getInstruction());
        if ($result){

            $row = $result->fetch(PDO::FETCH_ASSOC);
            // exibe as resultados

            echo $row['codigo'].'-'.$row['nome']."<br>\n";
        }
        // fecho a conexão  
        $conn = null;
    }

    catch (Exception $e){
        // exibe a mensagem de erro 
        print "ERRO!:".$e->getMessage()."<br>\n";
        die();
    }
?>



