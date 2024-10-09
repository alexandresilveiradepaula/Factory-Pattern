<?php

/* Classe TSqlUpdate
* Essa classe provê meios para manipulação de uma instrução UPDATE nos
* bancos de dados
*/

final class TSqlUpdate extends TSqlInstruction {
    
    private $columnValues;

    /* Método setRowData()
    * Atribui valores a determiadas colunas no banco de dados que serão modificadas
    * @param $column = coluna da tabela
    * @param $value = valor a ser armazenado
    */
    
    public function setRowData($column,$value){

        // verifica se um dado é escalar (string, inteiro...)
        if(is_scalar($value)){
            if(is_string($value) and (!empty($value))){
                // adiciona \ em aspas
                $value = addslashes($value);
                
                // caso seja uma string
                $this->columnValues[$column] = "'$value'";
    }
    else if (is_bool($value)) {
        //caso seja um booleano
        $this->columnValues[$column] = $value ?'TRUE':'FALSE';
    }
    else if ($value!=='') {
        // caso seja um tipo de dado
        $this ->columnValues[$column] = $value;
    }
    else
    {
        // caso seja NULL
        $this->columnValues[$column] = "NULL";
    }
}
    }


    /* Método getInstruction()
    * retorna a instrução UPDATE em forma de string
    */

    public function getInstruction() {
        // monta a string UPDATE
        $this->sql = "UPDATE {$this->entity}";
        // monta os pares: coluna=valor
        if($this->columnValues){
            foreach ($this->columnValues as $column=>$value){

                $set[] = "{$column} = {$value}";
            }
        }
        $this->sql .= 'SET' . implode (',', $set);
        // retorna a clausula where do objeto $this->criteria

        if($this->criteria){
            $this->sql .= 'WHERE'. $this->criteria->dump();
        }
        return $this->sql;
    }
}

?>