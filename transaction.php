<?php

/*

spl_autoload_register(function ($classe) {
  $filename = "{$classe}.class.php";
  if (file_exists($filename)) {
      include_once $filename;
  } else {
      throw new Exception("Classe {$classe} não encontrada.");
  }
});

try { 
  // abre uma transação 
  TTransaction::open('my_livro');

  //cria uma instrução de insert  
  $sql = new TSqlInsert;
  // define o nome da entidade 
  $sql->setEntity('famosos');
  // atribui o valor de cada coluna
  $sql->setRowData('codigo',8);
  $sql->setRowData('nome','Galileu');

  //obtem a conexão ativa
  $conn = TTransaction::get() ; 
  // executa a instrução sql
  $result = $conn->Query($sql->getInstruction()) ;

  // cria uma instrução Update
  $sql = new TSqlUpdate;
  //define o valor da entidade
  $sql->setEntity('famosos'); 
  //atribui o valor de cada coluna
  $sql->setRowData('nome','Galileu Galilei');

  //cria um critério de seleção de dados
  $criteria = new TCriteria;
  //obtem a pessoa de código "8"
  $criteria->add(new TFilter('codigo','=','8'));

  // atribui o criterio de seleção 
  $sql->setCriteria($criteria) ;  

  //obtem a conexão ativa
  $conn = TTransaction::get() ; 
  // executa a instrução SQL
  $result = $conn->Query($sql->getInstruction()) ;

  //fecha a transação aplicando todas as operações
  TTransaction::close();

}
catch (Exception $e) {
  // exibe a mensagem de erro 
   echo $e->getMessage();
   //desfaz operações realizadas durante a transação 
   TTransaction::rollback();
}






// Função para autoload das classes
spl_autoload_register(function ($classe) {
    $filename = "{$classe}.class.php";
    if (file_exists($filename)) {
        include_once $filename;
    } else {
        throw new Exception("Classe {$classe} não encontrada.");
    }
});

try {
    // Abre uma transação com o banco de dados 'my_livro'
    TTransaction::open('my_livro');

    // Cria uma instrução de INSERT
    $sqlInsert = new TSqlInsert;
    // Define o nome da entidade (tabela)
    $sqlInsert->setEntity('famosos');
    // Atribui valores às colunas
    $sqlInsert->setRowData('codigo', 8);
    $sqlInsert->setRowData('nome', 'Galileu');

    // Obtém a conexão ativa uma única vez
    $conn = TTransaction::get();
    // Executa a instrução SQL de INSERT
    $result = $conn->query($sqlInsert->getInstruction());
/*
    // Cria uma instrução de UPDATE
    $sqlUpdate = new TSqlUpdate;
    // Define o nome da entidade (tabela)
    $sqlUpdate->setEntity('famosos');
    // Atribui valores às colunas
    $sqlUpdate->setRowData('nome', 'Galileu Galilei');  

    // Cria um critério de seleção de dados
    $criteria = new TCriteria;
    // Filtra pelo código igual a 8
    $criteria->add(new TFilter('codigo', '=', '8'));

    // Atribui o critério à instrução SQL de UPDATE
    $sqlUpdate->setCriteria($criteria);

    // Executa a instrução SQL de UPDATE
    $result = $conn->query($sqlUpdate->getInstruction());
 
    // Fecha a transação aplicando todas as operações
    TTransaction::close();
}
catch (PDOException $e) {
    // Tratamento de exceções relacionadas ao banco de dados
    echo "Erro de banco de dados: " . $e->getMessage();
    TTransaction::rollback(); // Desfaz as operações realizadas durante a transação
}
catch (Exception $e) {
    // Tratamento de outras exceções
    echo "Erro geral: " . $e->getMessage();
    TTransaction::rollback(); // Desfaz as operações realizadas durante a transação
}

*/

// Função para autoload das classes
spl_autoload_register(function ($classe) {
    $filename = "{$classe}.class.php";
    if (file_exists($filename)) {
        include_once $filename;
    } else {
        throw new Exception("Classe {$classe} não encontrada.");
    }
});

try {
    // Abre uma conexão com o banco MariaDB
    TTransaction::open('mariaDB_connection'); // Nome da conexão MariaDB

    // Cria a instrução SQL de INSERT
    $sqlInsert = new TSqlInsert;
    $sqlInsert->setEntity('famosos');
    $sqlInsert->setRowData('codigo', 8);
    $sqlInsert->setRowData('nome', 'Galileu');

    $conn = TTransaction::get(); // Obtém a conexão ativa
    $conn->query($sqlInsert->getInstruction()); // Executa o INSERT

    // Cria a instrução SQL de UPDATE
    $sqlUpdate = new TSqlUpdate;
    $sqlUpdate->setEntity('famosos');
    $sqlUpdate->setRowData('nome', 'Galileu Galilei');

    $criteria = new TCriteria;
    $criteria->add(new TFilter('codigo', '=', '8'));
    $sqlUpdate->setCriteria($criteria);

    $conn->query($sqlUpdate->getInstruction()); // Executa o UPDATE

    TTransaction::close(); // Fecha a transação
}
catch (PDOException $e) {
    echo "Erro de banco de dados: " . $e->getMessage();
    TTransaction::rollback();
}
catch (Exception $e) {
    echo "Erro geral: " . $e->getMessage();
    TTransaction::rollback();
}

?>